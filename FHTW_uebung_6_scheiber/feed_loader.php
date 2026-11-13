<?php
// feed_loader.php - AJAX endpoint for loading RSS/Atom feeds

header('Content-Type: text/html; charset=UTF-8');

if (!isset($_POST['feedUrl']) || empty($_POST['feedUrl'])) {
    echo '<p class="error">Keine Feed-URL angegeben!</p>';
    exit;
}

$feedUrl = is_string($_POST['feedUrl']) ? trim($_POST['feedUrl']) : '';

// Enable error reporting for debugging
libxml_use_internal_errors(true);

/**
 * Checks that a URL uses http or https and that its host resolves only to public IPv4 addresses.
 * Returns [host, port, ip] or false. The page runs on a public server, so it must not fetch
 * internal addresses such as 127.0.0.1, the database host or private networks (SSRF).
 */
function checkPublicUrl($url) {
    $parts = parse_url($url);
    if ($parts === false || !isset($parts['scheme'], $parts['host'])) {
        return false;
    }
    $scheme = strtolower($parts['scheme']);
    if (($scheme !== 'http' && $scheme !== 'https') || isset($parts['user']) || isset($parts['pass'])) {
        return false;
    }
    $host = $parts['host'];
    $port = isset($parts['port']) ? (int)$parts['port'] : ($scheme === 'https' ? 443 : 80);
    $ips = filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? [$host] : gethostbynamel($host);
    if (empty($ips)) {
        return false;
    }
    foreach ($ips as $ip) {
        $public = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
        $cgnat = (ip2long($ip) & 0xFFC00000) === (ip2long('100.64.0.0') & 0xFFC00000);
        if (!$public || $cgnat) {
            return false;
        }
    }
    return [$host, $port, $ips[0]];
}

/**
 * Fetches a public http(s) URL with cURL. Redirects are followed by hand (at most 5) so that
 * every target is checked again. Certificates are verified and the body is limited to 5 MB.
 */
function fetchFeed($url, &$error) {
    $maxBytes = 5 * 1024 * 1024;
    for ($hop = 0; $hop <= 5; $hop++) {
        $target = checkPublicUrl($url);
        if ($target === false) {
            $error = 'Nur öffentliche http- und https-Adressen sind erlaubt.';
            return false;
        }
        list($host, $port, $ip) = $target;
        $body = '';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RESOLVE, [$host . ':' . $port . ':' . $ip]); // use the checked address
        curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTP | CURLPROTO_HTTPS);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $chunk) use (&$body, $maxBytes) {
            $body .= $chunk;
            return strlen($body) > $maxBytes ? 0 : strlen($chunk); // returning 0 aborts the transfer
        });
        $ok = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $redirect = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
        $error = curl_error($ch);
        curl_close($ch);

        if ($ok === false) {
            return false;
        }
        if ($httpCode >= 300 && $httpCode < 400 && !empty($redirect)) {
            $url = $redirect;
            continue;
        }
        return $httpCode >= 400 ? false : $body;
    }
    $error = 'Zu viele Weiterleitungen.';
    return false;
}

/**
 * Only http(s) links from the feed are used in href and src attributes.
 */
function safeUrl($url) {
    $scheme = strtolower((string)parse_url($url, PHP_URL_SCHEME));
    return ($scheme === 'http' || $scheme === 'https') ? $url : '#';
}

$error = '';
$feedContent = function_exists('curl_init') ? fetchFeed($feedUrl, $error) : false;

if ($feedContent === false || empty($feedContent)) {
    echo '<p class="error">❌ Fehler: Der Feed konnte nicht geladen werden.<br>';
    echo 'Mögliche Ursachen:<br>';
    echo '• Die URL ist nicht erreichbar<br>';
    echo '• Der Server blockiert den Zugriff<br>';
    echo '• Die URL ist ungültig<br>';
    echo 'Bitte überprüfen Sie die URL und versuchen Sie es erneut.</p>';
    if (isset($error) && !empty($error)) {
        echo '<p class="error" style="font-size: 12px;">cURL Fehler: ' . htmlspecialchars($error) . '</p>';
    }
    exit;
}

// Try to parse as XML
$xml = @simplexml_load_string($feedContent);

if ($xml === false) {
    $errors = libxml_get_errors();
    echo '<p class="error">❌ Fehler: Der Feed konnte nicht als XML geparst werden.<br>';
    echo 'Dies ist kein gültiges RSS- oder Atom-Feed-Format.<br>';
    if (!empty($errors)) {
        echo '<small>XML-Fehler: ' . htmlspecialchars($errors[0]->message) . '</small>';
    }
    echo '</p>';
    libxml_clear_errors();
    exit;
}

// Detect feed type (RSS or Atom)
$feedType = detectFeedType($xml);

if ($feedType === 'atom') {
    echo '<div style="background-color: #e8f5e9; padding: 10px; border-radius: 4px; margin-bottom: 20px; color: #2e7d32;">';
    echo '✅ <strong>Atom-Feed erfolgreich geladen</strong>';
    echo '</div>';
    displayAtomFeed($xml);
} elseif ($feedType === 'rss') {
    echo '<div style="background-color: #e8f5e9; padding: 10px; border-radius: 4px; margin-bottom: 20px; color: #2e7d32;">';
    echo '✅ <strong>RSS-Feed erfolgreich geladen</strong>';
    echo '</div>';
    displayRssFeed($xml);
} else {
    echo '<p class="error">❌ Fehler: Unbekanntes Feed-Format. Nur RSS und Atom werden unterstützt.</p>';
}

/**
 * Detect if the feed is RSS or Atom
 */
function detectFeedType($xml) {
    // Check for Atom namespace
    if (isset($xml->entry) || $xml->getName() === 'feed') {
        return 'atom';
    }
    // Check for RSS channel
    if (isset($xml->channel) || isset($xml->item)) {
        return 'rss';
    }
    return 'unknown';
}

/**
 * Display RSS Feed
 */
function displayRssFeed($xml) {
    $items = isset($xml->channel->item) ? $xml->channel->item : $xml->item;
    
    if (empty($items)) {
        echo '<p class="error">Keine Einträge im Feed gefunden.</p>';
        return;
    }
    
    $totalItems = count($items);
    $displayLimit = min($totalItems, 10);
    echo '<p style="color: #666; font-size: 14px; margin-bottom: 20px;">';
    echo '📰 Zeige ' . $displayLimit . ' von ' . $totalItems . ' Einträgen';
    echo '</p>';
    
    $count = 0;
    foreach ($items as $item) {
        if ($count >= 10) break; // Limit to 10 items
        
        $title = isset($item->title) ? (string)$item->title : 'Kein Titel';
        $description = isset($item->description) ? (string)$item->description : '';
        $link = isset($item->link) ? (string)$item->link : '#';
        $pubDate = isset($item->pubDate) ? (string)$item->pubDate : '';
        
        // Try to find image in various places
        $imageUrl = '';
        
        // Check for media:thumbnail or media:content
        $media = $item->children('http://search.yahoo.com/mrss/');
        if (isset($media->thumbnail)) {
            $imageUrl = (string)$media->thumbnail->attributes()->url;
        } elseif (isset($media->content)) {
            $imageUrl = (string)$media->content->attributes()->url;
        }
        
        // Check for enclosure
        if (empty($imageUrl) && isset($item->enclosure)) {
            $enclosureType = (string)$item->enclosure->attributes()->type;
            if (strpos($enclosureType, 'image') !== false) {
                $imageUrl = (string)$item->enclosure->attributes()->url;
            }
        }
        
        // Strip HTML tags from description but keep text
        $cleanDescription = strip_tags($description);
        $cleanDescription = html_entity_decode($cleanDescription, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Truncate description if too long
        if (strlen($cleanDescription) > 300) {
            $cleanDescription = substr($cleanDescription, 0, 300) . '...';
        }
        
        echo '<div class="feed-item">';
        
        if (!empty($imageUrl)) {
            echo '<img src="' . htmlspecialchars(safeUrl($imageUrl)) . '" alt="' . htmlspecialchars($title) . '" class="feed-image">';
        }
        
        echo '<div class="feed-title">' . htmlspecialchars($title) . '</div>';
        
        if (!empty($pubDate)) {
            $formattedDate = date('d.m.Y H:i', strtotime($pubDate));
            echo '<div style="color: #999; font-size: 12px; margin-bottom: 8px;">📅 ' . htmlspecialchars($formattedDate) . ' Uhr</div>';
        }
        
        if (!empty($cleanDescription)) {
            echo '<div class="feed-description">' . htmlspecialchars($cleanDescription) . '</div>';
        }
        
        echo '<a href="' . htmlspecialchars(safeUrl($link)) . '" class="feed-link" target="_blank">📖 Zum Artikel →</a>';
        echo '<div style="clear: both;"></div>';
        echo '</div>';
        
        $count++;
    }
    
    if ($count === 0) {
        echo '<p class="error">Keine Einträge im Feed gefunden.</p>';
    }
}

/**
 * Display Atom Feed
 */
function displayAtomFeed($xml) {
    // Register Atom namespace
    $xml->registerXPathNamespace('atom', 'http://www.w3.org/2005/Atom');
    $entries = $xml->xpath('//atom:entry');
    
    if (empty($entries)) {
        // Try without namespace
        $entries = isset($xml->entry) ? $xml->entry : [];
    }
    
    if (empty($entries)) {
        echo '<p class="error">Keine Einträge im Feed gefunden.</p>';
        return;
    }
    
    $totalItems = count($entries);
    $displayLimit = min($totalItems, 10);
    echo '<p style="color: #666; font-size: 14px; margin-bottom: 20px;">';
    echo '📰 Zeige ' . $displayLimit . ' von ' . $totalItems . ' Einträgen';
    echo '</p>';
    
    $count = 0;
    foreach ($entries as $entry) {
        if ($count >= 10) break; // Limit to 10 items
        
        $title = isset($entry->title) ? (string)$entry->title : 'Kein Titel';
        $published = isset($entry->published) ? (string)$entry->published : (isset($entry->updated) ? (string)$entry->updated : '');
        
        // Get summary or content
        $description = '';
        if (isset($entry->summary)) {
            $description = (string)$entry->summary;
        } elseif (isset($entry->content)) {
            $description = (string)$entry->content;
        }
        
        // Get link
        $link = '#';
        if (isset($entry->link)) {
            if (is_array($entry->link) || $entry->link->count() > 1) {
                foreach ($entry->link as $l) {
                    $rel = (string)$l->attributes()->rel;
                    if (empty($rel) || $rel === 'alternate') {
                        $link = (string)$l->attributes()->href;
                        break;
                    }
                }
            } else {
                $link = (string)$entry->link->attributes()->href;
            }
        }
        
        // Clean description
        $cleanDescription = strip_tags($description);
        $cleanDescription = html_entity_decode($cleanDescription, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        if (strlen($cleanDescription) > 300) {
            $cleanDescription = substr($cleanDescription, 0, 300) . '...';
        }
        
        echo '<div class="feed-item">';
        echo '<div class="feed-title">' . htmlspecialchars($title) . '</div>';
        
        if (!empty($published)) {
            $formattedDate = date('d.m.Y H:i', strtotime($published));
            echo '<div style="color: #999; font-size: 12px; margin-bottom: 8px;">📅 ' . htmlspecialchars($formattedDate) . ' Uhr</div>';
        }
        
        if (!empty($cleanDescription)) {
            echo '<div class="feed-description">' . htmlspecialchars($cleanDescription) . '</div>';
        }
        
        echo '<a href="' . htmlspecialchars(safeUrl($link)) . '" class="feed-link" target="_blank">📖 Zum Artikel →</a>';
        echo '</div>';
        
        $count++;
    }
    
    if ($count === 0) {
        echo '<p class="error">Keine Einträge im Feed gefunden.</p>';
    }
}
?>

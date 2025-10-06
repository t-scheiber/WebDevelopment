<?php
// feed_loader.php - AJAX endpoint for loading RSS/Atom feeds

header('Content-Type: text/html; charset=UTF-8');

if (!isset($_POST['feedUrl']) || empty($_POST['feedUrl'])) {
    echo '<p class="error">Keine Feed-URL angegeben!</p>';
    exit;
}

$feedUrl = $_POST['feedUrl'];

// Enable error reporting for debugging
libxml_use_internal_errors(true);

// Try to load the feed with proper headers and SSL handling
$feedContent = false;

// First, try using cURL (more reliable for HTTPS)
if (function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $feedUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Allow self-signed certificates
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
    
    $feedContent = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($feedContent === false || $httpCode >= 400) {
        $feedContent = false;
    }
} 

// Fallback to file_get_contents with proper context
if ($feedContent === false) {
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36\r\n",
            'follow_location' => true,
            'max_redirects' => 5,
            'timeout' => 30
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);
    
    $feedContent = @file_get_contents($feedUrl, false, $context);
}

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
            echo '<img src="' . htmlspecialchars($imageUrl) . '" alt="' . htmlspecialchars($title) . '" class="feed-image">';
        }
        
        echo '<div class="feed-title">' . htmlspecialchars($title) . '</div>';
        
        if (!empty($pubDate)) {
            $formattedDate = date('d.m.Y H:i', strtotime($pubDate));
            echo '<div style="color: #999; font-size: 12px; margin-bottom: 8px;">📅 ' . htmlspecialchars($formattedDate) . ' Uhr</div>';
        }
        
        if (!empty($cleanDescription)) {
            echo '<div class="feed-description">' . htmlspecialchars($cleanDescription) . '</div>';
        }
        
        echo '<a href="' . htmlspecialchars($link) . '" class="feed-link" target="_blank">📖 Zum Artikel →</a>';
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
        
        echo '<a href="' . htmlspecialchars($link) . '" class="feed-link" target="_blank">📖 Zum Artikel →</a>';
        echo '</div>';
        
        $count++;
    }
    
    if ($count === 0) {
        echo '<p class="error">Keine Einträge im Feed gefunden.</p>';
    }
}
?>

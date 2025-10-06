<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
	<link rel="icon" type="image/svg+xml" href="favicon.svg">
	<link rel="alternate icon" href="favicon.ico" type="image/x-icon">
	
	<title>Web Development - Übung 6a</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
			background-color: #f5f5f5;
		}
		h1 {
			color: #333;
			text-align: center;
			margin-bottom: 30px;
		}
		.section {
			max-width: 1000px;
			margin: 0 auto 40px auto;
			background-color: white;
			border-radius: 8px;
			padding: 30px;
			box-shadow: 0 2px 4px rgba(0,0,0,0.1);
		}
		.section h2 {
			color: #4CAF50;
			border-bottom: 2px solid #4CAF50;
			padding-bottom: 10px;
			margin-bottom: 20px;
		}
		
		/* Student List Styles */
		.student-card {
			background-color: #f9f9f9;
			border-radius: 8px;
			padding: 20px;
			margin-bottom: 20px;
			border-left: 4px solid #4CAF50;
		}
		.student-name {
			font-size: 20px;
			font-weight: bold;
			color: #4CAF50;
			margin-bottom: 10px;
		}
		.student-info {
			display: grid;
			grid-template-columns: 150px 1fr;
			gap: 8px;
			margin-bottom: 15px;
		}
		.info-label {
			font-weight: bold;
			color: #555;
		}
		.info-value {
			color: #333;
		}
		.lv-list {
			background-color: white;
			padding: 10px;
			border-radius: 4px;
		}
		.lv-list h3 {
			margin-top: 0;
			color: #555;
			font-size: 16px;
		}
		.lv-list ul {
			margin: 0;
			padding-left: 20px;
		}
		.lv-list li {
			margin: 5px 0;
			color: #333;
		}
		
		/* Feed Reader Styles */
		.feed-form {
			margin-bottom: 30px;
		}
		.form-group {
			display: flex;
			gap: 10px;
			align-items: center;
			margin-bottom: 20px;
		}
		.form-group label {
			font-weight: bold;
			color: #555;
			min-width: 60px;
		}
		.form-group input[type="text"] {
			flex: 1;
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 4px;
			font-size: 14px;
		}
		.form-group button {
			padding: 10px 30px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 14px;
			font-weight: bold;
		}
		.form-group button:hover {
			background-color: #45a049;
		}
		#feedContent {
			min-height: 100px;
		}
		.feed-item {
			margin-bottom: 30px;
			padding-bottom: 20px;
			border-bottom: 1px solid #eee;
		}
		.feed-item:last-child {
			border-bottom: none;
		}
		.feed-title {
			font-size: 18px;
			font-weight: bold;
			color: #333;
			margin-bottom: 10px;
		}
		.feed-description {
			color: #666;
			line-height: 1.6;
			margin-bottom: 10px;
		}
		.feed-link {
			color: #0066cc;
			text-decoration: none;
		}
		.feed-link:hover {
			text-decoration: underline;
		}
		.feed-image {
			max-width: 200px;
			float: right;
			margin-left: 15px;
			margin-bottom: 10px;
		}
		.loading {
			text-align: center;
			color: #999;
			padding: 20px;
		}
		.error {
			color: #d32f2f;
			padding: 15px;
			background-color: #ffebee;
			border-radius: 4px;
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
	<h1>Web Development – Übung 6a <span style="float: right;">BSA – 2017</span></h1>
	
	<!-- XML Student List -->
	<div class="section">
		<h2>Studentenliste (XML Parsing)</h2>
		<?php
			$filename = "studentslist.xml";
			
			if (!file_exists($filename)) {
				echo "<p class='error'>Fehler: Die Datei '$filename' wurde nicht gefunden!</p>";
			} else {
				$xmlDoc = simplexml_load_file($filename);
				
				if ($xmlDoc === false) {
					echo "<p class='error'>Fehler: Die XML-Datei konnte nicht geladen werden!</p>";
				} else {
					foreach ($xmlDoc->student as $student) {
						echo '<div class="student-card">';
						echo '<div class="student-name">' . htmlspecialchars($student->vorname) . ' ' . htmlspecialchars($student->nachname) . '</div>';
						
						echo '<div class="student-info">';
						echo '<div class="info-label">Matrikelnummer:</div>';
						echo '<div class="info-value">' . htmlspecialchars($student->matnr) . '</div>';
						
						echo '<div class="info-label">Kürzel:</div>';
						echo '<div class="info-value">' . htmlspecialchars($student->kuerzel) . '</div>';
						
						echo '<div class="info-label">Studiengang:</div>';
						echo '<div class="info-value">' . htmlspecialchars($student->studiengang) . '</div>';
						
						echo '<div class="info-label">Semester:</div>';
						echo '<div class="info-value">' . htmlspecialchars($student->semester) . '</div>';
						echo '</div>';
						
						if (isset($student->lvs) && $student->lvs->lv) {
							echo '<div class="lv-list">';
							echo '<h3>Lehrveranstaltungen:</h3>';
							echo '<ul>';
							foreach ($student->lvs->lv as $lv) {
								echo '<li>' . htmlspecialchars($lv) . '</li>';
							}
							echo '</ul>';
							echo '</div>';
						}
						
						echo '</div>';
					}
				}
			}
		?>
	</div>
	
	<!-- Task 3: RSS/Atom Feed Reader -->
	<div class="section">
		<h2>BWI WET2 Feedreader</h2>
		<div class="feed-form">
			<div class="form-group">
				<label for="feedUrl">URL:</label>
				<input type="text" id="feedUrl" name="feedUrl" value="https://www.heise.de/rss/heise-atom.xml" placeholder="Feed URL eingeben...">
				<button onclick="loadFeed()">Senden</button>
			</div>
			<div style="margin-top: 10px; font-size: 13px; color: #666;">
				<strong>Beispiel-Feeds:</strong><br>
				<a href="#" onclick="setFeed('https://www.heise.de/rss/heise-atom.xml'); return false;" style="color: #0066cc; text-decoration: none; margin-right: 15px;">Heise (Atom)</a>
				<a href="#" onclick="setFeed('https://rss.orf.at/news.xml'); return false;" style="color: #0066cc; text-decoration: none; margin-right: 15px;">ORF (RSS)</a>
				<a href="#" onclick="setFeed('https://www.derstandard.at/rss'); return false;" style="color: #0066cc; text-decoration: none; margin-right: 15px;">Der Standard (RSS)</a>
			</div>
		</div>
		<div id="feedContent"></div>
	</div>
	
	<script>
		function setFeed(url) {
			document.getElementById('feedUrl').value = url;
			loadFeed();
		}
		
		function loadFeed() {
			const url = document.getElementById('feedUrl').value.trim();
			const feedContent = document.getElementById('feedContent');
			
			if (!url) {
				feedContent.innerHTML = '<p class="error">Bitte geben Sie eine Feed-URL ein!</p>';
				return;
			}
			
			// Basic URL validation
			if (!url.startsWith('http://') && !url.startsWith('https://')) {
				feedContent.innerHTML = '<p class="error">Ungültige URL. Die URL muss mit http:// oder https:// beginnen.</p>';
				return;
			}
			
			// Show loading message
			feedContent.innerHTML = '<p class="loading">📡 Feed wird geladen...</p>';
			
			// AJAX request
			const xhr = new XMLHttpRequest();
			xhr.open('POST', 'feed_loader.php', true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			
			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						if (xhr.responseText.trim().length > 0) {
							feedContent.innerHTML = xhr.responseText;
						} else {
							feedContent.innerHTML = '<p class="error">Der Server hat keine Daten zurückgegeben.</p>';
						}
					} else {
						feedContent.innerHTML = '<p class="error">Fehler beim Laden des Feeds (HTTP Status: ' + xhr.status + '). Bitte überprüfen Sie die URL oder versuchen Sie es später erneut.</p>';
					}
				}
			};
			
			xhr.onerror = function() {
				feedContent.innerHTML = '<p class="error">Netzwerkfehler beim Laden des Feeds. Bitte überprüfen Sie Ihre Internetverbindung.</p>';
			};
			
			xhr.ontimeout = function() {
				feedContent.innerHTML = '<p class="error">Zeitüberschreitung beim Laden des Feeds. Der Server antwortet nicht.</p>';
			};
			
			xhr.timeout = 30000; // 30 seconds timeout
			
			try {
				xhr.send('feedUrl=' + encodeURIComponent(url));
			} catch (e) {
				feedContent.innerHTML = '<p class="error">Fehler beim Senden der Anfrage: ' + e.message + '</p>';
			}
		}
		
		// Load default feed on page load
		window.addEventListener('DOMContentLoaded', function() {
			loadFeed();
		});
		
		// Allow Enter key to submit
		document.addEventListener('DOMContentLoaded', function() {
			document.getElementById('feedUrl').addEventListener('keypress', function(e) {
				if (e.key === 'Enter') {
					e.preventDefault();
					loadFeed();
				}
			});
		});
	</script>
</body>
</html>
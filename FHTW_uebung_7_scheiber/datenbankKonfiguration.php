<?php
// Reads the database settings. They are not stored in the repository.
//
// Lookup order:
// 1. the PHP file named in the environment variable FHTW7_DB_CONFIG
// 2. fhtw7-db-config.php in the folder above the web root (on Hostinger: next to public_html)
// 3. the environment variables DB_HOST, DB_NAME, DB_USER and DB_PASSWORD
//
// The config file returns an array:
// <?php return ['host' => 'localhost', 'name' => '...', 'user' => '...', 'pass' => '...'];
function datenbankKonfiguration()
{
	$dateien = [];
	if (getenv('FHTW7_DB_CONFIG')) {
		$dateien[] = getenv('FHTW7_DB_CONFIG');
	}
	if (!empty($_SERVER['DOCUMENT_ROOT'])) {
		$dateien[] = dirname($_SERVER['DOCUMENT_ROOT']) . '/fhtw7-db-config.php';
	}
	foreach ($dateien as $datei) {
		if (is_file($datei)) {
			$konfiguration = require $datei;
			if (is_array($konfiguration)) {
				return $konfiguration;
			}
		}
	}
	if (getenv('DB_NAME')) {
		return [
			'host' => getenv('DB_HOST') ?: 'localhost',
			'name' => getenv('DB_NAME'),
			'user' => getenv('DB_USER'),
			'pass' => getenv('DB_PASSWORD'),
		];
	}
	return null;
}

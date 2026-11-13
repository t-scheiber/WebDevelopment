<?php
// Opens the mysqli connection used by the login in inc/header.inc.php.
// The settings come from datenbankKonfiguration.php, not from this file.
require_once __DIR__ . '/datenbankKonfiguration.php';

$konfiguration = datenbankKonfiguration();
$db = null;

if ($konfiguration !== null) {
	mysqli_report(MYSQLI_REPORT_OFF);
	$verbindung = @mysqli_connect($konfiguration['host'], $konfiguration['user'], $konfiguration['pass'], $konfiguration['name']);
	if ($verbindung) {
		mysqli_set_charset($verbindung, 'utf8mb4');
		$db = $verbindung;
	}
}

if ($db === null) {
	// The error details are not shown on the page: they can contain host and user names.
	echo "<div style='padding: 20px; background-color: #ffdddd; border-left: 6px solid #f44336; margin: 20px;'>";
	echo "<h3>Datenbankverbindungsfehler</h3>";
	echo "<p>Die Verbindung zur Datenbank konnte nicht hergestellt werden.</p>";
	echo "</div>";
}
?>

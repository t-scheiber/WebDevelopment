<?php
// Enable error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection - HOSTINGER SETTINGS
$db_host = "localhost";  // Host is always "localhost" for Hostinger
$db_user = "u233867969_fhtw_ueb_7_usr";  // Your database username
$db_pass = "3ru6dRO9~eM*";  // Your database password
$db_name = "u233867969_fhtw_uebung_7";  // Your database name

$db = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if(!$db)
{
  // Display a user-friendly error message
  echo "<div style='padding: 20px; background-color: #ffdddd; border-left: 6px solid #f44336; margin: 20px;'>";
  echo "<h3>Datenbankverbindungsfehler</h3>";
  echo "<p>Die Verbindung zur Datenbank konnte nicht hergestellt werden.</p>";
  echo "<p><strong>Fehler:</strong> " . mysqli_connect_error() . "</p>";
  echo "<p><em>Bitte überprüfen Sie die Datenbankeinstellungen in datenbankVerbindung.php</em></p>";
  echo "</div>";
  $db = null; // Set to null instead of exiting so page can still render
}
?>
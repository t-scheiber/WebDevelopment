<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- Favicon -->
	<link rel="icon" type="image/svg+xml" href="favicon.svg">
	<link rel="alternate icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	
	<style>
		/* Compact vertical spacing - fits on one page */
		header {
			margin-bottom: 10px;
		}
		nav {
			margin-bottom: 10px;
		}
		main {
			padding: 10px 0;
		}
		footer {
			margin-top: 15px;
			padding: 10px 0;
		}
		body {
			padding-top: 10px;
		}
		/* Registration form spacing */
		main h2 {
			margin-bottom: 15px;
			margin-top: 0;
		}
		form table {
			margin-top: 10px;
			margin-bottom: 10px;
		}
		form table tr {
			line-height: 1.5;
		}
		form table td {
			padding: 6px 10px;
		}
		form table th {
			padding-bottom: 10px;
		}
	</style>
	
	<title>Registrierung</title>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	// Enable error reporting for debugging
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	?>
	<header>
		<?php include 'inc/header.inc.php';?>
	</header>
	<nav>
		<?php include 'inc/navi.inc.php';?>
	</nav>
	<main class="container">
		<h2>Registrierung</h2>
		<?php
		$db_host = "localhost";  // Host is always "localhost" for Hostinger
		$db_user = "u233867969_fhtw_ueb_7_usr";  // Your database username
		$db_pass = "3ru6dRO9~eM*";  // Your database password
		$db_name = "u233867969_fhtw_uebung_7";  // Your database name
		
		try {
			$pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db_available = true;
		} catch(PDOException $e) {
			echo "<div style='padding: 20px; background-color: #ffdddd; border-left: 6px solid #f44336; margin: 20px;'>";
			echo "<h3>Datenbankverbindungsfehler</h3>";
			echo "<p>Die Verbindung zur Datenbank konnte nicht hergestellt werden.</p>";
			echo "<p><strong>Fehler:</strong> " . $e->getMessage() . "</p>";
			echo "<p><em>Bitte überprüfen Sie die Datenbankeinstellungen.</em></p>";
			echo "</div>";
			$db_available = false;
		}
		?>
		<?php if($db_available): ?>
		<form action="register.php" method="post">
	<table>
		<tr>
			<td>
				Vorname
			</td>
			<td>
				<input type="text" name="vorname" required="required">
			</td>
		</tr>
		<tr>
			<td>
				Nachname
			</td>
			<td>
				<input type="text" name="nachname" required="required">
			</td>
		</tr>
		<tr>
			<td>
				Geburtsdatum
			</td>
			<td>
				<input type="date" name="gebdat" required="required">
			</td>
		</tr>
		<tr>
			<td>
				E-Mail-Adresse
			</td>
			<td>
				<input type="email" name="email" required="required">
			</td>
		</tr>
		<tr>
			<td>
				Passwort
			</td>
			<td>
				<input type="password" name="passwort" required="required">
			</td>
		</tr>
		<tr>
			<td>
				<input type="reset" name="reset">
			</td>
			<td>
				<input type="submit" name="registered" value="senden">
			</td>
		</tr>
	</table>
</form>
<?php else: ?>
<p style='color: red;'>Das Registrierungsformular ist derzeit nicht verfügbar.</p>
<?php endif; ?>

<?php
if(isset($_POST['registered']) && $db_available)
{
$vorname=$_POST['vorname'];
$nachname=$_POST['nachname'];
$gebdat=$_POST['gebdat'];
$emailadresse=$_POST['email'];
$password=md5($_POST['passwort']);
$neuer_user = array();
$neuer_user['sid']= NULL;
$neuer_user['vorname'] = $vorname;
$neuer_user['nachname'] = $nachname;
$neuer_user['gebdat'] = $gebdat;
$neuer_user['email'] = $emailadresse;
$neuer_user['passwort'] = $password;
$statement = $pdo->prepare("INSERT INTO studentenliste (sid, vorname, nachname, geburtsdatum, emailadresse, passwort) VALUES (:sid, :vorname, :nachname,:gebdat, :email, :passwort)");
$statement->execute($neuer_user);
header('Location: index.php?registered=erfolgreich');
}
?>
	</main>
	<footer class="bg-dark">
		<?php include 'inc/footer.inc.php';?>
	</footer>
</body>
</html>
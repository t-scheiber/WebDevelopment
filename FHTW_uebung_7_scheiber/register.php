<?php
// Registration with PDO and a prepared statement. The settings come from datenbankKonfiguration.php.
// The insert runs before any output so that errors and the result can be shown in the page.
require_once __DIR__ . '/datenbankKonfiguration.php';

$db_available = false;
$registrierungErfolgreich = false;
$meldung = '';
$konfiguration = datenbankKonfiguration();
if ($konfiguration !== null) {
	try {
		$pdo = new PDO("mysql:host={$konfiguration['host']};dbname={$konfiguration['name']};charset=utf8mb4", $konfiguration['user'], $konfiguration['pass']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db_available = true;
	} catch (PDOException $e) {
		$db_available = false;
	}
}

// The page is public, so registration is limited: rows other than the demo rows are deleted
// after 7 days, the table accepts at most 200 rows, and every field has a maximum length.
if (isset($_POST['registered']) && $db_available) {
	$feld = function ($name, $max) {
		$wert = $_POST[$name] ?? '';
		return (is_string($wert) && trim($wert) !== '' && mb_strlen($wert) <= $max) ? trim($wert) : null;
	};
	$vorname = $feld('vorname', 50);
	$nachname = $feld('nachname', 50);
	$gebdat = $feld('gebdat', 10);
	$emailadresse = $feld('email', 100);
	$passwort = $feld('passwort', 72);
	$datum = $gebdat ? DateTime::createFromFormat('!Y-m-d', $gebdat) : false;

	if (!$vorname || !$nachname || !$passwort || !$datum || $datum->format('Y-m-d') !== $gebdat || !filter_var((string)$emailadresse, FILTER_VALIDATE_EMAIL)) {
		$meldung = 'Bitte alle Felder korrekt ausfüllen.';
	} else {
		try {
			$pdo->exec("DELETE FROM studentenliste WHERE ist_demo = 0 AND registriert_am < NOW() - INTERVAL 7 DAY");
			$anzahl = (int)$pdo->query("SELECT COUNT(*) FROM studentenliste")->fetchColumn();
			if ($anzahl >= 200) {
				$meldung = 'Die Registrierung ist derzeit voll. Bitte später erneut versuchen.';
			} else {
				$neuer_user = array();
				$neuer_user['sid'] = NULL;
				$neuer_user['vorname'] = $vorname;
				$neuer_user['nachname'] = $nachname;
				$neuer_user['gebdat'] = $gebdat;
				$neuer_user['email'] = $emailadresse;
				$neuer_user['passwort'] = password_hash($passwort, PASSWORD_DEFAULT); // replaces the unsalted MD5 hash
				$statement = $pdo->prepare("INSERT INTO studentenliste (sid, vorname, nachname, geburtsdatum, emailadresse, passwort) VALUES (:sid, :vorname, :nachname,:gebdat, :email, :passwort)");
				$statement->execute($neuer_user);
				$registrierungErfolgreich = true;
			}
		} catch (PDOException $e) {
			$meldung = $e->getCode() == 23000 ? 'Diese E-Mail-Adresse ist bereits registriert.' : 'Die Registrierung ist fehlgeschlagen.';
		}
	}
}
?>
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
	<header>
		<?php include 'inc/header.inc.php';?>
	</header>
	<nav>
		<?php include 'inc/navi.inc.php';?>
	</nav>
	<main class="container">
		<h2>Registrierung</h2>
		<?php
		if (!$db_available) {
			// The error details are not shown on the page: they can contain host and user names.
			echo "<div style='padding: 20px; background-color: #ffdddd; border-left: 6px solid #f44336; margin: 20px;'>";
			echo "<h3>Datenbankverbindungsfehler</h3>";
			echo "<p>Die Verbindung zur Datenbank konnte nicht hergestellt werden.</p>";
			echo "</div>";
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
if ($registrierungErfolgreich) {
	echo "<p class='schrifterfolg'>Erfolgreich registriert! <a href='index.php'>Zur Anmeldung</a></p>";
} elseif ($meldung !== '') {
	echo "<p style='color: red;'>" . htmlspecialchars($meldung) . "</p>";
}
?>
	</main>
	<footer class="bg-dark">
		<?php include 'inc/footer.inc.php';?>
	</footer>
</body>
</html>
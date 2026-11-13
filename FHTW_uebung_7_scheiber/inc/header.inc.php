<?php 
if(file_exists("datenbankVerbindung.php")) {
	include("datenbankVerbindung.php");
} else {
	echo "<div style='padding: 20px; background-color: #ffdddd; border-left: 6px solid #f44336; margin: 20px;'>";
	echo "<p>Konfigurationsdatei nicht gefunden!</p>";
	echo "</div>";
	$db = null;
}
?>
<style type='text/css'>
	.buttons
	{
		text-align: center;
	}
	#reset
	{
		margin-right: 10px;
	}
	form td
	{
		padding: 8px 10px;
	}
	form th
	{
		padding-bottom: 10px;
	}
	.zentriert
	{
		margin: 15px auto 15px auto;
	}
	.schrifterfolg
	{
		text-align: center;
		color: #05D400;
		font-weight: bold;
		font-size: 14pt;
		margin-top: 10px;
		padding: 10px;
	}
	.container > p {
		margin-top: 15px;
		margin-bottom: 15px;
	}
</style>
<div class='container'>
<?php
if (!isset($_POST['submit'])) {
	echo("
	<form action='index.php' method='post'>
		<table class='zentriert'>
			<tr>
				<th colspan='2'>Anmelden:</th>
			</tr>
			<tr>
				<td>E-Mail:</td><td><input type='email' name='user' required='required'></td>
			</tr>
			<tr>
				<td>Passwort:</td><td><input type='password' name='pwd' required='required'></td>
			</tr>
			<tr class='buttons'>
				<td colspan='2'><input type='reset' id='reset' value='Reset'><input type='submit' name='submit' value='Login'></td>
			</tr>");

			if (empty($registrierungErfolgreich))
			{
				echo ("
					<tr>
						<td colspan='2'>Sie sind noch nicht registiert? <a href='register.php'>Registrieren</a></td>
					</tr>
				");
			}
	echo("
		</table>
		<div class='schrifterfolg'>
	");
			if (!empty($registrierungErfolgreich)) {
				echo "Erfolgreich registiert!";
			}

			?>
		</div>
	</form>
<?php
}
else
	{
	if($db === null) {
		echo "<p style='color: red;'>Datenbankverbindung nicht verfügbar. Bitte kontaktieren Sie den Administrator.</p>";
	} else {
		$eingabefeld1 = is_string($_POST['user'] ?? null) ? $_POST['user'] : '';
		$eingabefeld2 = is_string($_POST['pwd'] ?? null) ? $_POST['pwd'] : '';

		// Prepared statement: the email address is sent as a parameter, not joined into the SQL text.
		$abfrage = mysqli_prepare($db, "SELECT sid, vorname, nachname, emailadresse, passwort FROM studentenliste WHERE emailadresse = ?");
		$ergebnis = false;
		if ($abfrage) {
			mysqli_stmt_bind_param($abfrage, 's', $eingabefeld1);
			mysqli_stmt_execute($abfrage);
			$ergebnis = mysqli_stmt_get_result($abfrage);
		}

	echo "<p>";
	while($ergebnis && $row = mysqli_fetch_array($ergebnis)){

		if (password_verify($eingabefeld2, $row['passwort'])) {
			echo 'Willkommen, ' . htmlspecialchars($row['vorname']) . ' ' . htmlspecialchars($row['nachname']) . '!<br>';
			echo 'Ihre ID lautet ' . (int)$row['sid'] . ' und ihre E-Mail-Adresse ist: ' . htmlspecialchars($row['emailadresse']) . '<br>';
			$eingeloggt = 1;
		}
	}
	if ($abfrage) {
		mysqli_stmt_close($abfrage);
	}
		if(isset($eingeloggt))
		{
		echo "Sie haben sich erfolgreich angemeldet.";
		}
		else
		{
			echo "Falscher Username und/oder Passwort.";
		}
	}
	}
?>
</div>






<!DOCTYPE html>
<html lang="de">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>&copy; Thomas Scheiber</title>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		
	</head>
	<body>
		<form action="auswertung.php" method="get">
		<h1>Patientenverwaltung</h1>
		<p>Willkommen im BSA-KIS (BSA Krankenhausinformationssystem)!</p>
		<h2>Neuen Patienten anlegen</h2>
		<fieldset style="width:30%; margin: 0px auto 0px auto; text-align: left;">
			<LEGEND>Bitte Formular ausfüllen</LEGEND>
			<table>
				<tr>
					<td><label for="vorname">Vorname:</label></td>
					<td><input type="text" name="vn" id="vorname" placeholder="Vorname" autofocus="autofocus" maxlength="40" required="required" />*</td>
				</tr>
				<tr>
					<td><label for="nachname">Nachname:</label></td>
					<td><input type="text" name="nn" id="nachname" placeholder="Nachname" maxlength="40" required="required" />*</td>
				</tr>
				<tr>
					<td><label for="email">E-Mail</label></td>
					<td><input type="email" name="email" id="email" placeholder="E-Mail" maxlength="40" required="required" />*</td>
				</tr>
				<tr>
					<td><label for="svn">SVN:</label></td>
					<td><input type="text" id="svn" name="svn" size="4" placeholder="SV Nr" maxlength="40" required="required" />*</td>
				</tr>
				<tr>
					<td><label for="gebdat">Geburtsdatum:</label></td>
					<td><input type="date" name="gebdat" id="gebdat" required="required" />*</td>
				</tr>
				<tr>
					<td><label for="m">Geschlecht:</label></td>
					<td><input type="radio" name="geschlecht" id="m" value="m" required="required"> m 
					  <input type="radio" name="geschlecht" id="w" value="w" required="required"> w 
					  <input type="radio" name="geschlecht" id="ka" value="ka" required="required"> keine Angabe</td>
				</tr>
				<tr>
					<td><label for="diabd">Diastolischer Blutdruck:</label></td>
					<td><input type="number" name="diabd" id="diabd" /></td>
				</tr>
				<tr>
					<td><label for="sysbd">Systolischer Blutdruck:</label></td>
					<td><input type="number" name="sysbd" id="sysbd" /></td>
				</tr>
				<tr>
					<td><label for="puls">Puls:</label></td>
					<td><input type="number" name="puls" id="puls" /></td>
				</tr>
				<tr>
					<td><label for="anmerkungen">Anmerkungen:</label></td>
					<td><textarea name="anmerkungen" id="anmerkungen" placeholder="Anmerkungen..."></textarea></td>
				</tr>
				<tr>
					<td><input type="reset" name="abbrechen" id="abbrechen" value="Abbrechen" /></td>
					<td><input type="submit" name="Senden" id="senden" value="senden" /></td>
				</tr>
			</table>
		</fieldset>
	</form>
	</body>
</html>
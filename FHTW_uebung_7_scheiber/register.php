<?php
$pdo = new PDO('mysql:host=localhost;dbname=studenten', 'root', '');
?>
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
<?php
if(isset($_POST['registered']))
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
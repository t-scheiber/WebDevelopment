<?php include("datenbankVerbindung.php"); ?>
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
		padding: 10px;
	}
	.zentriert
	{
		margin: 10px auto 10px auto;
	}
	.schrifterfolg
	{
		text-align: center;
		color: #05D400;
		font-weight: bold;
		font-size: 14pt;
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

			if (!isset($_POST['registered']))
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
			if (isset($_POST['registered'])) {
				echo "Erfolgreich registiert!";
			}

			?>
		</div>
	</form>
<?php
}
else
	{
	$eingabefeld1=$_POST['user'];
	$eingabefeld2=$_POST['pwd'];

	$gehasht=md5($eingabefeld2);

	$sql = "SELECT * FROM studentenliste";
	$sql1 = "SELECT emailadresse FROM studentenliste WHERE emailadresse = " . $eingabefeld1;

	$ergebnis=mysqli_query($db, $sql);
	$usernameselect=mysqli_query($db, $sql1);

	//$result=mysqli_fetch_array($ergebnis);
	echo "<p>";
	while($row = mysqli_fetch_array($ergebnis)){

		if ($row['emailadresse']==$eingabefeld1 && $row['passwort']==$gehasht) {
			echo 'Willkommen, ' . $row['vorname'] . ' ' . $row['nachname'] . '!<br>';
			echo 'Ihre ID lautet ' . $row['sid'] . ' und ihre E-Mail-Adresse ist: ' . $row['emailadresse'] . '<br>';
			$eingeloggt = 1;
		}
		else{
			
		}
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
?>
</div>






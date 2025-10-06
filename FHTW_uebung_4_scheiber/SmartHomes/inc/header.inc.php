<script type='text/javascript' src='./res/script/script.js'></script>
<?php
	if(!isset($_GET['pw'])) {
		echo "
		<form action='index.php' method='get'>
			<table style='margin: 0px auto 10px auto;'>
				<tr>
					<th colspan='2' style='height: 50px; font-size: 24pt;'>Login-Formular</th>
				</tr>
				<tr style='height: 30px;'>
					<td style='width: 200px;'><label for='un'>Benutzername:</label></td>
					<td style='width: 200px;'><input type='text' name='un' id='un' placeholder='Benutzername' required='required' /></td>
				</tr>
				<tr style='height: 30px;'>
					<td style='width: 200px;'><label for='pw'>Passwort:</label></td>
					<td style='width: 200px;'><input type='password' name='pw' id='pw' placeholder='Passwort' required='required' /></td>
				</tr>
				<tr style='text-align: center; height: 40px;'>
					<td><input type='reset' name='Zurücksetzen' id='reset'></td>
					<td><input type='submit' name='Senden' id='senden'></td>
				</tr>
			</table>
			<input type='hidden' name='menu' value='Home'>
		</form>
		";
	}
	else
	{
		
		if ($_GET['un']=='admin' && $_GET['pw']=='admin') {
			echo "<div class='login'>Willkommen, ", $_GET['un'], "!<a class='logoutLink' href='index.php?menu=Home'>Logout</a></div>";
		}
		else
		{
			echo "<div class='login'>Ungültiger Username und/oder Passwort<a class='logoutLink' href='index.php?menu=Home'>Retry</a></div>";
		}
	}
?>
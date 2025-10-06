<?php
	if(!isset($_GET['un']) && !isset($_GET['pw']) && !isset($_COOKIE['user']))  {
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
				<tr>
					<td colspan='2'><input type='checkbox' name='stay' value='stay' id='stay'> Angemeldet bleiben</td>
				</tr>
				<tr style='text-align: center; height: 40px;'>
					<td><input type='reset' name='Zurücksetzen' id='reset'></td>
					<td><input type='submit' name='Senden' id='senden' value='Senden'></td>
				</tr>
			</table>
			<input type='hidden' name='menu' value='Home'>
		</form>
		";
	}
	else
	{
		if(!isset($_COOKIE['user']))
		{
			$_SESSION['un']=$_GET['un'];
			$_SESSION['pw']=$_GET['pw'];

			if ($_SESSION["un"]=='admin' && $_SESSION["pw"]=='admin') {
					echo "<div class='login'>Willkommen, ", $_SESSION["un"], "! <a class='logoutLink' href='logout.php'>Logout</a></div>";		
			}
			else
			{
				echo "<div class='login'>Ungültiger Username und/oder Passwort <a class='logoutLink' href='logout.php'>Retry</a></div>";
			}
			if (isset($_GET['stay']) && $_SESSION["un"]=='admin' && $_SESSION["pw"]=='admin' && !isset($_COOKIE['user']))
			{
				setcookie('user', 'admin', time() + 600);
				
			}
		}
		else
		{
			echo "<div class='login'>Willkommen, ", $_COOKIE['user'], "! <a class='logoutLink' href='logout.php'>Logout</a></div>";
		}
	}
?>
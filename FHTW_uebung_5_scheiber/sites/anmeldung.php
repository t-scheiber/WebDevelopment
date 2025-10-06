<script type="text/javascript" src="../res/script/script.js"></script>
<?php
session_start();

	$_SESSION['un']=$_GET['un'];
	$_SESSION['un']=$_GET['pw'];
	if ($username=="admin" && $passwort=="admin")
	{
		echo "<h1>Sie sind eingeloggt als: $username</h1>";
	}
	else
	{
		echo "<h1>Falscher Username und/oder Passwort</h1>";
?>
	<a href='javascript:goback()'>Zurück</a>
<?php
	}
?>
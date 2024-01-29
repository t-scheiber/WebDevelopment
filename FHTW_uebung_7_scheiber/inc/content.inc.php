<?php
		if (!empty($_GET["menu"])) {
		switch ($_GET["menu"]) {
			case 'Home':
				include 'sites/home.php';
				break;
			case 'Studenteninfo':
				include 'sites/studenteninfo.php';
				break;
			case 'Hochschulinfo':
				include 'sites/hochschulinfo.php';
				break;
			default:
				include 'sites/home.php';
				break;
			}
		}
		if (!isset($_GET["menu"])) {
			include "sites/home.php";
		}
?>
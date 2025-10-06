<?php
	if (!empty($_GET["menu"])) {
		switch ($_GET["menu"]) {
			case 'Home':
				include 'sites/home.php';
				break;
			case 'Schlafzimmer':
				include 'sites/schlafzimmer.php';
				break;
			case 'Wohnzimmer':
				include 'sites/wohnzimmer.php';
				break;
			case 'Esszimmer':
				include 'sites/esszimmer.php';
				break;
			case 'Kueche':
				include 'sites/kueche.php';
				break;
			case 'Aussenbereich':
				include 'sites/aussenbereich.php';
				break;
			case 'Kontakt':
				'mailto:sa19b025@technikum-wien.at';
				break;
			case 'Impressum':
				include 'sites/impressum.php';
				break;
				case 'Zimmerliste':
				include 'sites/zimmerliste.php';
				break;
				case 'NeuerRaum':
				include 'sites/neuerRaum.php';
				break;
				case 'RESTAPI':
				include 'RESTServices/getPatientData.php';
				break;
			default:
				include 'sites/home.php';
				break;
		}
	}
	if (empty($_GET['menu'])) {
		include 'sites/home.php';
	}
?>
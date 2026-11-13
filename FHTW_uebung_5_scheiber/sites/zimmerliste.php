<?php
	if (isset($_SESSION['zimmerliste']))
	{	
	$arraygroesse=sizeof($_SESSION['zimmerliste'])-1;
	}
	if (isset($_GET['id'])) {
		$idvomletzteneintrag=$_GET['id'];
		$idvomletztenarrayeintrag=$_SESSION['zimmerliste'][$arraygroesse ?? 0]['id'] ?? null;
	}
	if(isset($_GET['add']) && !isset($_SESSION['zimmerliste'])){
		$groesse = 0;
		$_SESSION['zimmerliste']=array();
		$_SESSION['zimmerliste'][$groesse] = array('id' => $_GET['id'], 'titel' => $_GET['titel'], 'qm' => $_GET['qm'], 'licht' => $_GET['licht'], 'temperatur' => $_GET['temperatur'], 'hintergrundbild' => $_GET['hintergrundbild'], 'beschreibung' => $_GET['beschreibung']);
	}
	elseif(isset($_GET['add']) && isset($_SESSION['zimmerliste']) && $_GET['id']==$_SESSION['zimmerliste'][$arraygroesse]['id'])
	{
		#nichts // falls user seite aktualisiert soll nicht jedes mal ein neuer eintrag gemacht werden
	}
	elseif(isset($_GET['add']) && isset($_SESSION['zimmerliste']) && $idvomletzteneintrag!=$idvomletztenarrayeintrag && sizeof($_SESSION['zimmerliste']) < 50) // at most 50 rooms per session
	{
		$groesse = sizeof($_SESSION['zimmerliste']);
		$_SESSION['zimmerliste'][$groesse] = array('id' => $_GET['id'], 'titel' => $_GET['titel'], 'qm' => $_GET['qm'], 'licht' => $_GET['licht'], 'temperatur' => $_GET['temperatur'], 'hintergrundbild' => $_GET['hintergrundbild'], 'beschreibung' => $_GET['beschreibung']);
	}
?>
<link rel="stylesheet" type="text/css" href="res/css/style.css">
<div class="container">
<table border="1" class="zimmerliste">
	<tr>
		<th>ID</th><th>Titel</th><th>Raumgröße</th><th>Licht an</th><th>Temperatur</th><th>Hintergrundbild</th><th>Beschreibung</th><th>löschen</th>
	</tr>
	<?php
	if(!empty($_SESSION['zimmerliste']))
	{
		for($i=0;$i+1<=sizeof($_SESSION['zimmerliste']);$i++){
			echo "<tr>";
			echo "<td>", htmlspecialchars((string)$_SESSION['zimmerliste'][$i]['id'], ENT_QUOTES, 'UTF-8'), "</td>";
			echo "<td>", htmlspecialchars((string)$_SESSION['zimmerliste'][$i]['titel'], ENT_QUOTES, 'UTF-8'), "</td>";
			echo "<td>", htmlspecialchars((string)$_SESSION['zimmerliste'][$i]['qm'], ENT_QUOTES, 'UTF-8'), "</td>";
			echo "<td>", htmlspecialchars((string)$_SESSION['zimmerliste'][$i]['licht'], ENT_QUOTES, 'UTF-8'), "</td>";
			echo "<td>", htmlspecialchars((string)$_SESSION['zimmerliste'][$i]['temperatur'], ENT_QUOTES, 'UTF-8'), "</td>";
			echo "<td>", htmlspecialchars((string)$_SESSION['zimmerliste'][$i]['hintergrundbild'], ENT_QUOTES, 'UTF-8'), "</td>";
			echo "<td>", htmlspecialchars((string)$_SESSION['zimmerliste'][$i]['beschreibung'], ENT_QUOTES, 'UTF-8'), "</td>";
			echo "<td><a href='logout.php'>x</a></td>";
			echo "</tr>";
		}
	}
	?>
	</table>
</div>
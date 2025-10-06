<div class="kopf">
	<img src="pics/Logo.png" />
	<h1>Web Tunes!</h1>
	<h2>Willkommen!</h2>
</div>
<?php
	$filename = "res/sounds.xml";
	$xmlDoc = simplexml_load_file($filename);
	$id = 1;

	if(isset($_POST['suche']))
		{
			$suchstring = $_POST['suche'];
		}
?>
<table>
	<tr>
		<th>#ID</th>
		<th>Name</th>
		<th>Details</th>
		<th>Wave</th>
		<th>Soundfile</th>
	</tr>
	<?php
		if(!isset($suchstring)){
			foreach ($xmlDoc as $oneEntry ) {
				echo"<tr>";
					echo "<td> <a href='#'>" . $id . "</a></td>";
					echo "<td>" . $oneEntry->name . "</td>";
					echo "<td>" . $oneEntry->details . "</td>";
					echo "<td><img src='pics/audio" . $id . ".png' /></td>";
					echo "<td><audio controls src='res/" . $oneEntry->soundfile . "' type='audio/mp3'></audio></td>";
				echo "</tr>";
			}
		}
		else {
			foreach ($xmlDoc as $oneEntry ) {
				if (strpos($oneEntry->name, $suchstring)!==false) {
					echo"<tr>";
						echo "<td> <a href='#'>" . $id . "</a></td>";
						echo "<td>" . $oneEntry->name . "</td>";
						echo "<td>" . $oneEntry->details . "</td>";
						echo "<td><img src='pics/audio" . $id . ".png' /></td>";
						echo "<td><audio controls src='res/" . $oneEntry->soundfile . "' type='audio/mp3'></audio></td>";
					echo "</tr>";
				}
			}
		}
	?>

</table>

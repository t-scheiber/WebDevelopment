<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<title>WEB Projekt &copy; Thomas Scheiber</title>
	<link rel="icon" type="image/svg+xml" href="./favicon.svg">
	<link rel="icon" type="image/png" href="./favicon.png">
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/myStyle.css" />
</head>

<body>
	<div class="container">
		<navi>
			<?php include 'inc/menu.inc.php'; ?>
		</navi>
		<header>
			<img src="pics/Logo.png" /><br>
			<h1>Web Tunes</h1>
			<h2>Willkommen!</h2>
		</header>
		<?php
		$filename = "res/sounds.xml";
		$xmlDoc = simplexml_load_file($filename);
		$id = 1;

		if (isset($_POST['suche'])) {
			$suchstring = $_POST['suche'];
		}
		?>
		<table class="table table-striped table-hover">
			<tr>
				<th>#ID</th>
				<th>Name</th>
				<th>Details</th>
				<th>Wave</th>
				<th>Soundfile</th>
			</tr>
			<?php
			if (!isset($suchstring)) {
				foreach ($xmlDoc as $oneEntry) {
					echo "<tr>";
					echo "<td> <a href='playlist.php?soundfile=" . $oneEntry->soundfile . "'>" . $id . "</a></td>";
					echo "<td>" . $oneEntry->name . "</td>";
					echo "<td>" . $oneEntry->details . "</td>";
					echo "<td><img src='pics/audio" . $id . ".png' /></td>";
					echo "<td><audio controls src='res/" . $oneEntry->soundfile . "' type='audio/mp3'></audio></td>";
					echo "</tr>";
					$id++;
				}
			} elseif (!empty($suchstring)) {
				foreach ($xmlDoc as $oneEntry) {
					if (strpos($oneEntry->name, $suchstring) !== false) {
						echo "<tr>";
						echo "<td> <a href='playlist.php?soundfile=" . $oneEntry->soundfile . "'>" . $id . "</a></td>";
						echo "<td>" . $oneEntry->name . "</td>";
						echo "<td>" . $oneEntry->details . "</td>";
						echo "<td><img src='pics/audio" . $id . ".png' /></td>";
						echo "<td><audio controls src='res/" . $oneEntry->soundfile . "' type='audio/mp3'></audio></td>";
						echo "</tr>";
						$id++;
					}
				}
			}
			?>
		</table>
	</div>
	<footer></footer>
</body>

</html>
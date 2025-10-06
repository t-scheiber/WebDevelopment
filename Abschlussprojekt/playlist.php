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
		
		<title>WEB Projekt</title>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/myStyle.css" />
</head>
<body>
	<div class="container">
		<navi>
			<?php include 'inc/menu.inc.php'; ?>
		</navi>
		<h1>Playlist</h1>
			<?php
				if(isset($_GET['soundfile']))
				{
					$meinString = $_GET['soundfile'];
					$findMich = ".mp3";
					$check = strpos($meinString, $findMich);

					if(isset($_SESSION['stringarray']))
					{
					array_push($_SESSION['stringarray'], $meinString);
					}
					elseif (isset($_GET['soundfile'])) {
						$_SESSION['stringarray'] = array($_GET['soundfile']);
					}					
				}
			if (isset($_SESSION['stringarray'])) {
				$laenge=sizeof($_SESSION['stringarray']);
				echo "<ul class='liste list-group'>";
				for($i=0;$i<$laenge;$i++)
					{
					echo "<li class='list-group-item list-group-item-action list-group-item-light'>" . $_SESSION['stringarray'][$i] . "";
					}
			}	echo "</ul>";
			?>
	</div>
	<footer></footer>
</body>
</html>
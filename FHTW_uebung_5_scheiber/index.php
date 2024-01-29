<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		
		<title>Smart Home Steuerung</title>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="res/css/style.css">
	</head>
	<body>
		<header>
			<?php include 'inc/header.inc.php';?>
		</header>
		<navi>
			<?php include 'inc/navi.inc.php';?>
		</navi>
		<content>
			<?php include 'inc/content.inc.php';?>
		</content>
		<footer class="bg-dark">
			<?php include 'inc/footer.inc.php';?>
		</footer>
	</body>
</html>
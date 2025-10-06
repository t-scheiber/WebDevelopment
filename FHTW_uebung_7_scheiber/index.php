<!DOCTYPE html>
<html lang="zxx">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- Favicon -->
	<link rel="icon" type="image/svg+xml" href="favicon.svg">
	<link rel="alternate icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	
	<style>
		/* Compact vertical spacing - fits on one page */
		header {
			margin-bottom: 10px;
		}
		nav {
			margin-bottom: 15px;
		}
		main {
			padding: 15px 0;
		}
		footer {
			margin-top: 20px;
			padding: 15px 0;
		}
		body {
			padding-top: 10px;
		}
	</style>
	
	<title>Studentenlogin</title>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	</head>
	<body>
		<?php
		// Enable error reporting for debugging
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		?>
		<header>
			<?php include 'inc/header.inc.php';?>
		</header>
	<nav>
		<?php include 'inc/navi.inc.php';?>
	</nav>
	<main>
		<?php include 'inc/content.inc.php';?>
	</main>
		<footer class="bg-dark">
			<?php include 'inc/footer.inc.php';?>
		</footer>
	</body>
</html>
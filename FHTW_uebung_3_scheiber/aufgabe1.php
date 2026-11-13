<!DOCTYPE html>
<html lang="de">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>&copy; Thomas Scheiber</title>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		
	</head>
	<body>
		<?php
				// phpinfo() is turned off on the public server because it lists paths, modules and server settings.
				// Call phpinfo() on a local PHP server to see the full output.
				echo "<p>PHP-Version: ", htmlspecialchars(phpversion()), "</p>";
				echo "<p>phpinfo() ist auf dem öffentlichen Server deaktiviert. Lokal zeigt <code>phpinfo();</code> die vollständige Ausgabe.</p>";
			?>
	</body>
</html>
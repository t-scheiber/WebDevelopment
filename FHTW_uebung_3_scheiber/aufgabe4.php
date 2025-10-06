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
			$wochentage = array("Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
			$wochentag = 3; //Dienstag
		?>
				<nav class="navbar nav-pills">
					<ul class="nav">
						<?php	
							for ($i=0; $i < 7; $i++)
							{
								if ($wochentag==$i) {
									
									echo"<li class='nav nav-item'><a class='nav-link active' href='#'>$wochentage[$i]</a></li>";

								}
								else
								{
									echo"<li class='nav nav-item'><a class='nav-link' href='#'>$wochentage[$i]</a></li>";
								}

							}
						?>
					</ul>
				</nav>
	</body>
</html>
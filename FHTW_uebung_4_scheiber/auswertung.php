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
			// Escape every submitted value before it is printed (prevents reflected XSS).
			function feld($name)
			{
				$wert = $_GET[$name] ?? '';
				return is_string($wert) ? htmlspecialchars($wert, ENT_QUOTES, 'UTF-8') : '';
			}
			$vorname=feld('vn');
			$nachname=feld('nn');
			$email=feld('email');
			$svn=feld('svn');
			$gebdat=feld('gebdat');
			$geschlecht=feld('geschlecht');
			$diastolbd=feld('diabd');
			$systolbd=feld('sysbd');
			$puls=feld('puls');
			$anmerkungen=feld('anmerkungen');
		?>
		
		<table border="1">
			<tr>
				<th colspan="2"><h1>Auswertung</h1></th>
			</tr>
			<tr>
				<th>Felder:</th>
				<th>Eingaben:</th>
			</tr>
			<tr>
				<td>Vorname:</td>
				
				<?php
					if (!empty($vorname))
					{
						echo "<td>", $vorname, "</td>";
					}
					else
					{
						echo "<td class='marked'></td>";
					}
				?>
				
			</tr>
			<tr>
				<td>Nachname:</td>

				<?php
					if (!empty($nachname))
					{
						echo "<td>", $nachname, "</td>";
					}
					else
					{
						echo "<td class='marked'></td>";
					}
				?>

			</tr>
			<tr>
				<td>E-Mail-Adresse:</td>
				<?php
					if (!empty($email))
					{
						echo "<td>", $email, "</td>";
					}
					else
					{
						echo "<td class='marked'></td>";
					}
				?>
			</tr>
			<tr>
				<td>Sozialversicherungsnummer:</td>
				<?php
					if (!empty($svn))
					{
						echo "<td>", $svn, "</td>";
					}
					else
					{
						echo "<td class='marked'></td>";
					}
				?>
			</tr>
			<tr>
				<td>Geburtsdatum:</td>
				<?php
					if (!empty($gebdat))
					{
						echo "<td>", $gebdat, "</td>";
					}
					else
					{
						echo "<td class='marked'></td>";
					}
				?>
			</tr>
			<tr>
				<td>Geschlecht:</td>
				<?php
					if (!empty($geschlecht))
					{
						echo "<td>", $geschlecht, "</td>";
					}
					else
					{
						echo "<td class='marked'></td>";
					}
				?>
			</tr>
			<tr>
				<td>Diastolischer Blutdruck:</td>
				<?php
					if (!empty($diastolbd))
					{
						echo "<td>", $diastolbd, "</td>";
					}
					else
					{
						echo "<td class='marked'></td>";
					}
				?>
			</tr>
			<tr>
				<td>Systolischer Blutdruck:</td>
				<?php
					if (!empty($systolbd))
					{
						echo "<td>", $systolbd, "</td>";
					}
					else
					{
						echo "<td class='marked'></td>";
					}
				?>
			</tr>
			<tr>
				<td>Puls:</td>
				<?php
					if (!empty($puls))
					{
						echo "<td>", $puls, "</td>";
					}
					else
					{
						echo "<td class='marked'></td>";
					}
				?>
			</tr>
			<tr>
				<td>Anmerkungen:</td>
				<?php
					if (!empty($anmerkungen))
					{
						echo "<td>", $anmerkungen, "</td>";
					}
					else
					{
						echo "<td class='marked'></td>";
					}
				?>
			</tr>
		</table>
		<div>
			<?php

				ob_start();
				var_dump($_GET);
				echo "<pre>", htmlspecialchars(ob_get_clean(), ENT_QUOTES, 'UTF-8'), "</pre>";

			?>
		</div>
	</body>
 </html>
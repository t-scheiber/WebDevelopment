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
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<table>
			<tr>
				<td>
					<table border="1">
						<tr>
							<th colspan="5">ohne Schleife</th>
						</tr>
						<tr>
							<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td>
						</tr>
						<tr>
							<td>6</td><td>7</td><td>8</td><td>9</td><td>10</td>
						</tr>
						<tr>
							<td>11</td><td>12</td><td>13</td><td>14</td><td>15</td>
						</tr>
					</table>
				</td>
				<td>
					<table border="1">
						<tr>
							<td colspan="5">for-Schleife
								<?php
										for ($i=1; $i < 16; $i++)
										{
											if ($i%2==1) {
												if ($i%5==1) {
													echo"</td></tr><tr><td class='odd'>",$i;
												}
												else
												{
													echo"</td><td class='odd'>",$i;
												}
											}
											else
											{
												if ($i%5==1) {
													echo"</td></tr><tr><td>",$i;
												}
												else
												{
													echo"</td><td>",$i;
												}
											}	
										}
								?>
							</td>
						</tr>
					</table>
				</td>
				<td>
					<table border="1">
						<tr>
							<td colspan="5">do-while-Schleife
								<?php
										$i=1;

										do {
											if ($i%2==1) {
												if ($i%5==1) {
													echo"</td></tr><tr><td class='odd'>",$i;
													$i++;
												}
												else
												{
													echo"</td><td class='odd'>",$i;
													$i++;
												}
											}
											else
											{
												if ($i%5==1) {
													echo"</td></tr><tr><td>",$i;
													$i++;
												}
												else
												{
													echo"</td><td>",$i;
													$i++;
												}
											}	
										} while ($i <= 15);
								?>
							</td>
						</tr>
					</table>
				</td>
				<td>
					<table border="1">
						<tr>
							<td colspan="5">while-Schleife
								<?php
										$i=1;

										while ($i <= 15) {
											if ($i%2==1) {
												if ($i%5==1) {
													echo"</td></tr><tr><td class='odd'>",$i;
													$i++;
												}
												else
												{
													echo"</td><td class='odd'>",$i;
													$i++;
												}
											}
											else
											{
												if ($i%5==1) {
													echo"</td></tr><tr><td>",$i;
													$i++;
												}
												else
												{
													echo"</td><td>",$i;
													$i++;
												}
											}	
										}
								?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>thomas</title>
</head>
<body>
	<?php
		$filename = "studentslist.xml";
		$xmlDoc = simplexml_load_file($filename);
		var_dump($xmlDoc);
		foreach ($xmlDoc as $oneStudent) {
            echo "<p>";
            echo $oneStudent->matnr . "<br>";
            echo $oneStudent->vorname . "<br>";
            echo $oneStudent->nachname . "<br>";
            echo $oneStudent->studiengang . "<br>";
            echo $oneStudent->semester . "<br>";
            echo "</p>";
        }
	?>
</body>
</html>
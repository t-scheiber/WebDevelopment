<?php
$_SESSION['patientendaten'] = array('Patientenname' => 'Max Mustermann', 'Geburtsdatum' => '01.01.1990', 'SV-Nummer' => 4545, 'Blutgruppe' => 'A+', 'Bludruck' => '180/110', 'Blutdruckstatus' => 'Hypertonie Grad 3');

$myJsonString = json_encode($_SESSION['patientendaten']);
echo $myJsonString;
?>
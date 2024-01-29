<?php
$db = mysqli_connect("localhost", "root", "", "studenten");
if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}
?>
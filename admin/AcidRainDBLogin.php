<?php 
// AcidRainDBLogin.php

$db = new mysqli('localhost', 'web', 'P@ssw0rd', 'acid_rain');
	if (mysqli_connect_error()){
		exit("Problem connecting to Database.". mysqli_connect_error());
    }
$devDB = new mysqli('localhost', 'devAdmin', 'P@ssw0rd', 'acid_rain');
	if (mysqli_connect_error()){
		exit("Problem connecting to Database.". mysqli_connect_error());
    }
?>
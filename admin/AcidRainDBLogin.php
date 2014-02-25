<?php 

// AcidRainDBLogin.php

$db = new mysqli('localhost', 'root', 'kingku610', 'acid_rain');
if (mysqli_connect_error()) {
	http_response_code(503);
	exit("Problem connecting to Database." . mysqli_connect_error());
}
	
?>

<?php 
// AcidRainDBLogin.php
$db = new mysqli('localhost:3306', 'web', 'P@ssw0rd', 'acid_rain');
	if (mysqli_connect_error())
		show_exit_message("Problem connecting to Database.", mysqli_connect_error());
?>
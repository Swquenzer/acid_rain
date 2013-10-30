<?php

session_start();
if( isset($_COOKIE['acidRainRememberLogin']) ) setcookie("acidRainRememberLogin", "", 1);
session_destroy();

header( "Location: index.php" );

?>
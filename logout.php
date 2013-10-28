<?php

session_start();
setcookie ("acidRainRememberLogin", "", time() - 3600);
session_destroy();

header( "Location: index.html" );

?>
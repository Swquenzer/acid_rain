<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Project Acid Rain</title>
	<meta name="description" content="Project Acid Rain">
	<meta name="author" content="Stephen Quenzer">
	<link rel="stylesheet" href="css/main.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style type="text/css">
	</style>
</head>
<body>
	<header>
		<span class="center">
			<h1><img src="gfx/head_icon.gif" width="150px" height="150px">Chemical Database</h1>
			<nav id="navMenu">
				<ul>
					<li><a class="activePage" id="homeLink" href="index.php">Home</a></li>|
					<li><a id="infoLink" href="./help">Documentation</a></li>|
					<?php if( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) { ?>
					<li><a id="loginLink" href="spreadsheet.php">Spreadsheet</a></li><?php } else { ?>
					<li><a id="loginLink" href="login.php">Login</a></li><?php } ?>
				</ul>
			</nav>
		</span>
	</header>
	<div id="wrapper">
		<section id="main">
			<h1>Home Page</h1>
			<hr>
			<span id="content">
				<h2>General Info</h2>
				<p>Welcome. AcidRain is a database application project that allows the EMU Science Department the ability to keep track of their chemicals in an orderly, systematic way. 
				   Rather than working with hard copies of thousands of records, AcidRain gives you easy, efficient processing of chemical records. It is designed in a simple way to allow
                   you to view, add, delete, or modify records.
				<h2>Who is it for?</h2>
				<p>In order to preserve the integrity of the data and keep it secure, AcidRain can only be used by EMU faculty and students that have been given the correct authorization
				   and credentials. If you have these, then go ahead and head over to the <a href="login.php" style="color:black">login page</a> and log in to view what we call the "spreadsheet" (the table
				   of records) if you haven't already.</p>
				<h2>Fire Department</h2>
				<p>In case of emergency, fire-code regulation requires that necessary chemical information be provided to members of the Harrisonburg Fire Department to equip them with
				   knowledge about the presence, location, and amount of any and all chemicals in the building to ensure their safety and effectiveness before they enter the building.
				   AcidRain is designed to help with this in case the need arises.</p>
				<h2>AcidRain Team</h2>
				<p>AcidRain is a project created in the Fall of 2013 by EMU students Stephen Quenzer, Isaac Tice, and Josiah Driver, for their semester project in Software Engineering
				   with Charles Cooley. For additional help and information, visit the <a href="./help">documentation page</a>.</p>
			</span>
			<hr>
		</section>
	</div><!--End Wrapper-->
	<footer>
	<span id="footerContent">
	<a href="http://www.emu.edu"><img src="gfx/emu.png" width="200px" height="80px"></a>
	<!--<ul>
		<li><a href="#">Link 1</a></li>
		<li> &nbsp; | &nbsp; <a href="#">Link 2</a></li>
		<li> &nbsp; | &nbsp; <a href="#">Link 3</a></li>
		<li> &nbsp; | &nbsp; <a href="#">Link 4</a></li>
	</ul>-->
	</span>
	</footer>
<!-- KEEP JAVASCRIPT AT END OF BODY -->
<script src="js/scripts.js"></script>
</body>
</html>
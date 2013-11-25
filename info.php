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
		#infoLink {
			color: #1B291B !important;
		}
	</style>
</head>
<body>
	<header>
		<span class="center">
			<h1><img src="gfx/head_icon.gif" width="150px" height="150px">Chemical Database</h1>
			<nav id="navMenu">
				<ul>
					<li><a href="index.php">Home</a></li>|
					<li><a class="activePage" href="./help">Documentation</a></li>|
					<?php if( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) { ?>
					<li><a id="loginLink" href="spreadsheet.php">Spreadsheet</a></li><?php } else { ?>
					<li><a id="loginLink" href="login.php">Login</a></li><?php } ?>
				</ul>
			</nav>
		</span>
	</header>
	<div id="wrapper">
		<section id="main">
			<h1>Information</h1>
			<hr>
			<span id="content">
				<h2>General Info</h2>
				<p>Information to any general users who have accessed this page. Who is it for? What types of information and tools are available?
				<h2>Faculty Usage</h2>
				<p>EMU faculty can use this application for the purpose of....</p>
				<h2>Fire Department</h2>
				<p>In case of emergency, fire-code regulation requires that necessary chemical information be provided...</p>
				<h2>Etc</h2>
				<p>More content.....</p>
			</span>
			<hr>
		</section>
	</div><!--End Wrapper-->
	<footer>
	<span id="footerContent">
	<a href="http://www.emu.edu"><img src="gfx/emu.png" width="200px" height="80px"></a>
	<ul>
		<li><a href="#">Link 1</a></li>
		<li> &nbsp; | &nbsp; <a href="#">Link 2</a></li>
		<li> &nbsp; | &nbsp; <a href="#">Link 3</a></li>
		<li> &nbsp; | &nbsp; <a href="#">Link 4</a></li>
	</ul>
	</span>
	</footer>
<!-- KEEP JAVASCRIPT AT END OF BODY -->
<script src="js/scripts.js"></script>
</body>
</html>
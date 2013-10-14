<?php
session_start();
$errorMessage = "";

if( isset( $_POST["submit"] ) )
{
    if( $_REQUEST["password"] == "testpassword" )
	{
        $_SESSION["loggedIn"] = true;
        header( "Location: spreadsheet.php" );
	}

    else
    {
        $errorMessage = "Invalid username or password.";
    }
}

?>
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
</head>
<body>
	<header>
		<span class="center">
			<h1><img src="gfx/head_icon.gif" width="150px" height="150px">Chemical Database</h1>
			<nav id="navMenu">
				<ul>
					<li><a href="index.html">Home</a></li>|
					<li><a href="info.html">Info</a></li>|
					<li><a href="spreadsheet.php">Spreadsheet</a></li>
				</ul>
			</nav>
		</span>
	</header>
	<div id="wrapper">
		<section id="main">
			<h1>Login</h1>
			<p id="errorMessage"><?php echo $errorMessage; ?></p>
			<form id="inputField" action="login.php" method="post">
				<fieldset>
					<p><span class="inputFieldCenter">
						<label for="password">Enter Password: </label>
						<input type="password" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" />
						<input type="submit" name="submit" value="Login" />
					</span></p>
				</fieldset>
			</form>
		</section>
	</div><!--End Wrapper-->
	<footer>
	<span id="footerContent">
	<a href="http://www.emu.edu"><img src="gfx/emu.png" width="200px" height="80px"></a>
	</span>
	</footer>
<!-- KEEP JAVASCRIPT AT END OF BODY -->
<script src="js/scripts.js"></script>
</body>
</html>
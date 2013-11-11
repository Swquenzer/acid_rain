<?php

session_start();

if(isset($_COOKIE['acidRainRememberLogin']) && $_COOKIE['acidRainRememberLogin'] == "8a409cc44e752b72df5598d5240c23752b60888059961c2966754fa711845e25")
{
	$_SESSION["loggedIn"] = true;
}

if( !isset( $_SESSION["loggedIn"] ) )
{
    header( "Location: login.php" );
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
	<script src="js/main.js"></script>
    <script src="js/spreadSheet.js"></script>
	<script src="js/jquery.tablesorter.js"></script>
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
					<li><a href="index.php">Home</a></li>|
					<li><a href="info.php">Info</a></li>|
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav>
		</span>
	</header>
	<div id="wrapper">
		<section id="main">
			<form class="inputField" action="" method="post">
				<fieldset>
					<p><span class="inputFieldCenter">
						<label for="search">Chemical Search: </label>
						<input type="search" id="chemSearchInput" name="search" placeholder="Acenaphthene" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Acenaphthene'" />
						<input type="submit" value="Search" />
					</span></p>
				</fieldset>
			</form>
			<table id="chemical_spreadsheet" class="tablesorter">
				<thead>
					<tr>
						<th scope="col" id="th_left">Room</th>
						<th scope="col">Location</th>
						<th scope="col">Name</th>
						<th scope="col" id="th_right">Amount</th>
					</tr>
				</thead>
				<tbody id="chemical_spreadsheet_body">
					<tr>
						<td>35</td>
						<td>Refrigerator</td>
						<td>Acenaphthene</td>
						<td>40g</td>
					</tr>
					<tr>
						<td>25a</td>
						<td>Storeroom Front Rm</td>
						<td>Acetic Acid 45%</td>
						<td>2mg</td>
					</tr>
					<tr>
						<td>25a</td>
						<td>Refrigerator</td>
						<td>Acetone/Water</td>
						<td>200ml</td>
					</tr>
					<tr>
						<td>25b</td>
						<td>Refrigerator</td>
						<td>Acid Alcohol</td>
						<td>25ml</td>
					</tr>
					<tr>
						<td>39</td>
						<td>Storeroom Front Rm</td>
						<td>Agarose Type 1</td>
						<td>600ml</td>
					</tr>
					<tr>
						<td>54</td>
						<td>Flammable Cabinet</td>
						<td>Alcohol Reagent 50%</td>
						<td>1g</td>
					</tr>
					<tr>
						<td>35</td>
						<td>Refrigerator</td>
						<td>Acenaphthene</td>
						<td>40g</td>
					</tr>
					<tr>
						<td>25a</td>
						<td>Storeroom Front Rm</td>
						<td>Acetic Acid 45%</td>
						<td>2mg</td>
					</tr>
					<tr>
						<td>25a</td>
						<td>Refrigerator</td>
						<td>Acetone/Water</td>
						<td>200ml</td>
					</tr>
					<tr>
						<td>25b</td>
						<td>Refrigerator</td>
						<td>Acid Alcohol</td>
						<td>25ml</td>
					</tr>
					<tr>
						<td>39</td>
						<td>Storeroom Front Rm</td>
						<td>Agarose Type 1</td>
						<td>600ml</td>
					</tr>
					<tr>
						<td>54</td>
						<td>Flammable Cabinet</td>
						<td>Alcohol Reagent 50%</td>
						<td>1g</td>
					</tr><tr>
						<td>35</td>
						<td>Refrigerator</td>
						<td>Acenaphthene</td>
						<td>40g</td>
					</tr>
					<tr>
						<td>25a</td>
						<td>Storeroom Front Rm</td>
						<td>Acetic Acid 45%</td>
						<td>2mg</td>
					</tr>
					<tr>
						<td>25a</td>
						<td>Refrigerator</td>
						<td>Acetone/Water</td>
						<td>200ml</td>
					</tr>
					<tr>
						<td>25b</td>
						<td>Refrigerator</td>
						<td>Acid Alcohol</td>
						<td>25ml</td>
					</tr>
					<tr>
						<td>39</td>
						<td>Storeroom Front Rm</td>
						<td>Agarose Type 1</td>
						<td>600ml</td>
					</tr>
					<tr>
						<td>54</td>
						<td>Flammable Cabinet</td>
						<td>Alcohol Reagent 50%</td>
						<td>1g</td>
					</tr>
				</tbody>
			</table>
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
<!--<script src="js/scripts.js"></script>-->
</body>
</html>
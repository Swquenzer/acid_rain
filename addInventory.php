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
	<script src="js/main.js"></script>
	<script src="js/addInventory.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style>
		.inputField p {
			border: none;
		}
		.inputField label {
			display: block;
			width: 150px;
			float: left;
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
					<li><a href="info.php">Info</a></li>|
					<li><a href="login.php">Login</a></li>
				</ul>e
			</nav>
		</span>
	</header>
	<div id="wrapper">
		<section id="main">
			<form class="inputField" id="addInv" action="addNewInventory"><fieldset>
				<p>
				    <label id="manufacturerLbl">Manufacturer</label>
				    <input list="manufacturers" name="manufacturer" required/>
				</p><p>
				    <label id="chemicalsLbl">Chemical</label>
				    <input list="chemicals" name="chemical" />
				</p><p>
				    <label id="roomLbl">Room</label>
				    <input list="rooms" name="room" />
				</p><p>
				    <label id="locationLbl">Location</label>
				    <input list="locations" name="location" />
				</p><p>
				    <label id="quantLbl">Quantity</label>
				    <input type="text" id="quantity" />
				</p><p>
                    <label id="unitSizeLbl">Unit Size</label>
				    <input type="number" id="room" />
                </p><p>
                    <label id="unitLbl">Unit of Measure</label>
                    <input type="text" id="unit">
				</p><p>
				<input type="submit" name="submit">
				</p>
				<!--these will be filled by javascript when the page loads-->
				<datalist id="manufacturers">
				</datalist>
				<datalist id="chemicals">
				</datalist>
				<datalist id="rooms">
				</datalist>
				<datalist id="locations">
				</datalist>
			</fieldset></form>
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
	<div id="dialog-confirm" title="Suggested Manufacturers">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Some text, etc.</p>
	</div>
<!-- KEEP JAVASCRIPT AT END OF BODY -->
</body>
</html>
<?php
    if(isset($_POST['submit'])) {
        require("function/logger.php");

//  require a php file to create the connection to the sql server
        require('admin/AcidRainDBLogin.php');
//!*    
        include('function/DBUpdate.php');
        
         $stmt= $db->prepare('CALL find_mfr(?)');
            $stmt->bind_param("s",$_POST['manufacturer']);
            if($stmt->execute())
            {
                $stmt->bind_result($mfrID);
                $stmt->fetch();
                $stmt->close();
            }else
                slog($db->error);
            
            //check to see if a record was returned
            if($mfrID==null){
                $stmt= $db->prepare('CALL addManufacturer(?)');
                $stmt->bind_param("s",$_POST['manufacturer']);
                if($stmt->execute()){
                    $stmt->bind_result($mfrID);
                    $stmt->fetch();
                }else{
                    slog($db->error);
                    break;
                }
            }
            
            // find the chemical
            $stmt= $db->prepare('CALL Get_Chemical(?,?)');
            $stmt->bind_param("ss",$mfrID, $_POST['chemical']);
            if($stmt->execute())
            {
                $stmt->bind_result($chemID);
                $stmt->fetch();
                $stmt->close();
            }else
                slog($db->error);
            
            //check to see if a record was returned
            if($mfrID==null){
                // redirect to an add chemical form
            }
                
             
            /*$mfrID = null;
	        $stmt = $db->query("CALL Get_Manufacturer");
            if(!$stmt == false){
	         $shortest = -1;
	            while($man = $stmt->fetch_assoc()) {
		            $lev = levenshtein($_POST['manufacturer'], $man["ManufacturerName"]);
		            if($lev == 0) {
                        $mfrID = $man['ManufacturerID'];
			            return $mfrID;
		            }
            
		            else if ($lev <= $shortest || $shortest < 0) {
		            // set the closest match, and shortest distance
		                $closest  = $man;
		                $shortest = $lev;
	                }
	            }
	            #$closest contains the best match 
                if($mfrID==null && $shortest > 1){
                    $stmt= $db->prepare('CALL addManufacturer(?)');
                    $stmt->bind_param("s",$_POST['manufacturer']);
                    if($stmt->execute()){
                        $stmt->bind_result($mfrID);
                        $stmt->fetch();
                    }else
                        slog($db->error);
                } else
                    $mfrID = $man['ManufacturerID'];
                $stmt = $db->query("CALL Get_Chemical($mfrID)");
                if(!$stmt == false){
                    $chemList = $stmt->fetch_array(MYSQLI_BOTH); //BOTH is temperary
	                //$manRank[$manList.length];
	                $shortest = -1;
	                foreach($chemList as $man) {
		                $lev = levenshtein($_POST['chemical'], $man['ManufacturerName']);
		                if($lev == 0) {
                            $mfrID = $man['ManufacturerID'];
			                //They typed the correct name, continue on with search results
		                }
		                else if ($lev <= $shortest || $shortest < 0) {
		                // set the closest match, and shortest distance
		                $closest  = $man;
		                $shortest = $lev;
	                    }
	                }
                }
            }else
                slog($db->error);*/
    }
    
?>
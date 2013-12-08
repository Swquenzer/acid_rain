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

$message = "";
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
                                        <li><a href="./help">Documentation</a></li>|
                                        <li><a href="spreadsheet.php">Spreadsheet</a></li>|
                                        <li><a href="logout.php">Logout</a></li>
                                </ul>
                        </nav>
                </span>
        </header>
        <div id="wrapper">
                <section id="main">
				<?php
					if(isset($_POST['submit'])) {
						require('function/logger.php');
						require('admin/AcidRainDBLogin.php');
						
						#Validate
						require('function/validate.php');
						$errors = validateAddInventory($_POST['room'], $_POST['quant'], 0 /* No need for $chemID with Quick_fix */, $_POST['unitSize'], $_POST['unit']);
						
						if(empty($errors)) {
						
							#Get chemical id ( need to create better query with join later )
						
							#----- QUICKFIX:add manufacturer, chemical if not present ----#
							$query = $db->prepare("SELECT ID FROM 	manufacturer WHERE Name=?");
							$query->bind_param('s', $_POST['manufacturer']);
							$query->execute();
							$query->store_result();
							#If manufacturer not in database insert it
							if($query->num_rows() < 1 )
							{
								$query->close();
								$query = $db->prepare("INSERT INTO manufacturer (Name) VALUES (?)");
								$query->bind_param('s', $_POST['manufacturer']);
								if( !$query->execute() )
									slog($query->error);
							
								$query->close();
								
								#Now fetch manufacturer ID 
								$query = $db->prepare("SELECT ID FROM manufacturer WHERE Name=?");
								$query->bind_param('s', $_POST['manufacturer']);
								$query->execute();
							}
							$query->bind_result($manufacturerID);
							$query->fetch();
							$query->close();
						
							#Now, if chemical not in database insert it
							$query = $db->prepare("SELECT ID FROM chemical WHERE Name=?");
							$query->bind_param('s', $_POST['chemical']);
							$query->execute();
							$query->store_result();
							#If chemical not in database insert it
							if($query->num_rows() < 1 )
							{
								$query->close();
								$query = $db->prepare("INSERT INTO chemical (Name, MfrID) VALUES (?, ?)");
								$query->bind_param('ss', $_POST['chemical'], $manufacturerID);
								if( !$query->execute() )
									slog($query->error);
							
								$query->close();
								
								#Now fetch chemical ID 
								$query = $db->prepare("SELECT ID FROM chemical WHERE Name=?");
								$query->bind_param('s', $_POST['chemical']);
								$query->execute();
							}
							$query->bind_result($chemID);
							$query->fetch();
							$query->close();
						
							#----------------------- END OF QUICK FIX --------------------#
						
							#Insert record
							$query = $db->prepare("INSERT INTO inventory (Room, Location, ItemCount, ChemicalID, Size, Units, LastUpdated) VALUES (?, ?, ?, ?, ?, ?, ?)");
							$currentDate = date("Y-m-d H:i:s");
							$_POST['quant'] = (int) $_POST['quant'];
							$_POST['unitSize'] = (int) $_POST['unitSize'];
							$query->bind_param('ssiiiss', $_POST['room'], $_POST['location'], $_POST['quant'], $chemID, $_POST['unitSize'], $_POST['unit'], $currentDate);
							if(!$query->execute()) {
									slog('problem executing query in tbl.php: ' . $db->error);
							}
							
							else
							    $message = "Your record has been added.";
						}
					}
				?>
				<p style="text-align: center;"><?php echo $message; ?></p>
				<form class="inputField" id="addInv" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"><fieldset>
						<?php
							if(!empty($errors)) {
								echo "<span class='errMsg'><h3 style='margin-left: 20px;'>Errors:</h3><ul>";
								foreach($errors as $e) {
										echo "<li>$e</li>";
								}
								echo "</ul></span>";
							}
						?>
						<p>
						 <label id="manufacturerLbl">Manufacturer</label>
						 <input list="manufacturers" name="manufacturer" required />
						</p><p>
						 <label id="chemicalsLbl">Chemical</label>
						 <input list="chemicals" name="chemical" required />
						</p><p>
						 <label id="roomLbl">Room</label>
						 <input list="rooms" name="room" required />
						</p><p>
						 <label id="locationLbl">Location</label>
						 <input list="location" name="location" required />
						</p><p>
						 <label id="quantLbl">Quantity</label>
						 <input list="quantity" name="quant" required />
						</p><p>
						 <label id="unitSizeLbl">Unit Size</label>
						 <input type="number" name="unitSize" required />
						</p><p>
						 <label id="unitLbl">Unit of Measure</label>
						 <input type="text" name="unit"required >
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
						<datalist id="quantity">
						</datalist>
						<datalist id="location">
						</datalist>
				</fieldset></form>
			</section>
        </div><!--End Wrapper-->
        <footer>
        <span id="footerContent">
        <a href="http://www.emu.edu"><img src="gfx/emu.png" width="200px" height="80px"></a>
        </span>
        </footer>
        <div id="dialog-confirm" title="Suggested Manufacturers">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Some text, etc.</p>
        </div>
<!-- KEEP JAVASCRIPT AT END OF BODY -->
</body>
</html>
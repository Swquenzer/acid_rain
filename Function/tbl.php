<?php
if( isset($_REQUEST['callback'])){
//<summary>When this file is called with a callback function specified, process the request.</summary>
//**
    require("logger.php");

//  require a php file to create the connection to the sql server
    require('../admin/AcidRainDBLogin.php');
//!*    
    include('DBUpdate.php');
    
    
    //require('DBUpdate.php');
	switch(($_REQUEST['callback'])){
		case "returnTable":
			if (!isset($_REQUEST['page'])){
				$_REQUEST['page'] = 1;
			}
            $stmt =  $db->query("CALL Get_Spreadsheet()");
            if(!$stmt == false){
			    $numRecs = $stmt->num_rows;
			
			    $offset = 0; //$_SESSION['perPage'] * ($_REQUEST['page']-1);
			    if ($stmt->data_seek($offset)){
				    $rslt = array();
				    for($i=0; $i < $numRecs /* $_SESSION['perPage'] */; $i++){
					    $rslt[] = $stmt->fetch_array($resulttype= MYSQLI_ASSOC);
					    if ($rslt[$i] == null){
						    unset($rslt[$i]);
						    break;
					    }                       
				    }
				
				    $stmt->close();
				    echo $_REQUEST['callback'],"(" ,json_encode($rslt), ");";
                }
            } else{
                slog($db->error);
                echo "loadError();";
            }
                
			break;
         case "addInventoryLoad":
         
            $stmt =  $db->query("CALL Add_Inventory_preload()");
            if(!$stmt == false){
			    $numRecs = $stmt->num_rows;
                for($i=0; $i < $numRecs ; $i++){
					$rslt[] = $stmt->fetch_array();
					if ($rslt[$i] == null){
						unset($rslt[$i]);
						break;
					}                       
				}
				
				$stmt->close();
				echo $_REQUEST['callback'],"(" ,json_encode($rslt), ");";
            }else
                slog($db->error);
            break;
            
        break;
        
        case "addNewInventory":
            /*if(isset($_POST['submit'])) {
                $mfrID = null;
	            $stmt = $db->query("CALL Get_Manufacturer");
                if(!$stmt == false){
	                $manList = $stmt->fetch_array(MYSQLI_BOTH); //BOTH is temperary
	                //$manRank[$manList.length];
	                $shortest = -1;
	                foreach($manList as $man) {
		                $lev = levenshtein($_POST['manufacturer'], $man['ManufacturerName']);
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
                            
                }else
                    slog($db->error);
            }*/

            break;    
        case "simErr":
            echo "loadError();";
            break;
		case "alert":
			echo $_REQUEST['callback'],  "(\"testing\")";
			break;
		
	}
	
//$db->close();
}
if(isset($_POST['submit'])) {
        require('logger.php');
        require('../admin/AcidRainDBLogin.php');
        #Get chemical id ( need to create better query with join later )
        $query = $db->prepare("SELECT ID FROM chemical WHERE Name=?");
        var_dump($query);
        $query->bind_param('s', $_POST['chemical']);
        $query->execute(); //necessary?
        $result = $query->get_result(); //Error Checking Needed
        $result = $result->fetch_array(MYSQLI_BOTH);
        $chemID = $result[0];
        $query->close();
		#Validate
		require 'validate.php';
		$errors = validateAddInventory($_POST['room'], $_POST['quant'], $chemID, $_POST['unitSize'], $_POST['unit']);
		if(empty($errors)) {
			#Insert record
			$query = $db->prepare("INSERT INTO inventory (Room, Location, ItemCount, ChemicalID, Size, Units, LastUpdated)
													VALUES (?, ?, ?, ?, ?, ?, ?)");
			$currentDate = date("Y-m-d H:i:s");
			echo '<br><br>';
			var_dump($_POST);
			$_POST['quant'] = (int) $_POST['quant'];
			$_POST['unitSize'] = (int) $_POST['unitSize'];
			echo '<br><br>';
			var_dump($_POST);
			echo '<br><br>';
			var_dump($chemID);
			$query->bind_param('ssiiiss', $_POST['room'], $_POST['location'], $_POST['quant'], $chemID, $_POST['unitSize'], $_POST['unit'], $currentDate);
			if(!$query->execute()) {
					slog('problem executing query in tbl.php: ' . $db->error);
			}
		} else {
			echo "<h1>Errors: </h1><span class='errMsg'><ul>";
			foreach($errors as $e) {
					echo "<li>$e</li>";
			}
			echo "</ul></span>";
		}
		
        /* ### Levenshtein function for later if we have time
        $stmt = $db->query("CALL Get_Manufacturer()");
        $manList = $stmt->fetch_array(MYSQLI_BOTH); //BOTH is temporary
        printf("$result[0]: %s\n", $result[0]); //test
        printf("$result[1]: %s\n", $result[1]); //test
        //$manRank[$manList.length];
        $shortest = -1;
        foreach($manList as $man) {
                $lev = levenshtein($_POST['manufacturer'], $man);
                if($lev == 0) {
                        slog('IN');
                }
                if ($lev <= $shortest || $shortest < 0) {
                // set the closest match, and shortest distance
                $closest = $man;
                $shortest = $lev;
         }
        }
        #$closest contains the best match
        */
}
?>
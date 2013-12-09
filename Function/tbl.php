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
         
            $stmt =  $db->query("CALL Add_Inventory_Preload()");
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
?>
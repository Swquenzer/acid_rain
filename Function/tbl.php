<?php
if( isset($_REQUEST['callback'])){
//<summary>When this file is called with a callback function specified, process the request.</summary>
//**
require("logger.php");


//  require a php file to create the connection to the sql server
	require('../admin/AcidRainDBLogin.php');

	switch(($_REQUEST['callback'])){
		case "returnTable":
			if (!isset($_REQUEST['page'])){
				$_REQUEST['page'] = 1;
			}
            $stmt =  $db->query("CALL Get_Spreadsheet()");
            if(!$stmt == false){
                slog($db->error);
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
                slog("load Error");
                echo "loadError();";
            }
                
			break;
        /*case "addInventoryLoad":
            
        
        
        
            break;*/
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
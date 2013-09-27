<?php
if( isset($_REQUEST['callback'])){
//<summary>When this file is called with a callback function specified, process the request.</summary>
//**
require("logger.php");


//  require a php file to create the connection to the sql server
//	require('../admin/AcidRainDBLogin.php');

	switch(($_REQUEST['callback'])){
		case "returnTable":
			if (!isset($_REQUEST['page'])){
				$_REQUEST['page'] = 1;
				}
                //** the below string is an example of a json string for a single record
                $sampleStr = "[{\"Room\":35, \"Location\":\"room\", \"Name\":\"Acacia\", \"Size\":\"350\", \"Units\":\"g\"},{\"Room\":\"25a\", \"Location\":\"refrigirator door shelf 3\", \"Name\":\"Accrylamide\", \"Size\":\"300\", \"Units\":\"ml\"}]";
                echo $_REQUEST['callback'],"(",$sampleStr,");";
                //!*
                
				/*$sql="SELECT inventory.Room, invetory.Location, chemical.Name,inventory.Size, inventory.Units FROM inventory LEFT JOIN chemical ON inventory.ChemicalID = chemical.ID;";
                $stmt =  $db->query("CALL Get_Spreadsheet()");
				$numRecs = $stmt->num_rows;
               
				$offset = $_SESSION['perPage'] * ($_REQUEST['page']-1);
				if ($stmt->data_seek($offset)){
					$rslt = array();
					for($i=0; $i < $_SESSION['perPage']; $i++){
						$rslt[] = $stmt->fetch_array($resulttype= MYSQLI_ASSOC);
						if ($rslt[$i] == null){
							unset($rslt[$i]);
							break;
						}                       
					}
					$stmt->close();
					echo $_REQUEST['callback'],"(" ,json_encode($rslt), ");";
				}*/
                
			break;

		case "alert":
			echo $_REQUEST['callback'],  "(\"testing\")";
			break;
		
	}
//$db->close();
}
?>
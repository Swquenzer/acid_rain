<?php
// this script is intended to allow automated update of the stored queries
/*
$names = array('Get_Spreadsheet','Add_Inventory_Preload'); 
$queries[0] = <<<'EOD'
CREATE PROCEDURE `Get_Spreadsheet`() 
BEGIN 
SELECT `inventory`.`Room`, `inventory`.`Location`, `chemical`.`Name`, `inventory`.`Size`, `inventory`.`Units` 
FROM `inventory` LEFT JOIN `chemical` ON `inventory`.`ChemicalID` = `chemical`.`ID`; 
END 
EOD;

$queries[1] = <<<'EOD'
CREATE PROCEDURE `Add_Inventory_Preload`()
BEGIN
SELECT `Manufacturer`.`name` AS `manufacturers`, `Chemical`.`name` AS `chemicals`, `Inventory`.`Room` AS `rooms`
From `manufacturer`,`chemical`,`inventory`;
END
EOD;

for ($i =0;$i<count($queries);$i++){
    $devDB->query("DROP procedure IF EXISTS `$names[$i]`;");
    if(!$devDB->query($queries[$i]))
        slog($devDB->error);
}*/
?>
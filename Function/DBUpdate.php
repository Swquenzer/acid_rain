<?php
// this script is intended to allow automated update of the stored queries

$names[0] ='Get_Spreadsheet';
$queries[0] = <<<'EOD'
CREATE PROCEDURE `Get_Spreadsheet`() 
BEGIN 
SELECT `inventory`.`Room`, `inventory`.`Location`, `chemical`.`Name`, `inventory`.`Size`, `inventory`.`Units` 
FROM `inventory` LEFT JOIN `chemical` ON `inventory`.`ChemicalID` = `chemical`.`ID`; 
END 
EOD;

$names[1] ='Add_Inventory_Preload';
$queries[1] = <<<'EOD'
CREATE PROCEDURE `Add_Inventory_Preload`()
BEGIN
SELECT `Manufacturer`.`name` AS `manufacturers`, `Chemical`.`name` AS `chemicals`, `Inventory`.`Room` AS `rooms`
From `manufacturer`,`chemical`,`inventory`;
END
EOD;

$names[2] = 'Add_New_Inventory';
$queries[2] = <<<'EOD'
CREATE PROCEDURE `acid_rain`.`Add_New_Inventory` (ChemicalID int(10),Room varchar(45), Location varchar(45), ItemCount smallint(255), Size smallint(255), Unit varchar(45))
BEGIN
INSERT INTO `acid_rain`.`inventory`
(`ChemicalID`,`Room`,`Location`, `ItemCount`, `Size`, `Units`, `LastUpdated`)
VALUES(ChemicalID, Room, Location, ItemCount, Size, Unit, now());
END
EOD;

$names[3] = 'Get_Manufacturer';
$queries[3] = <<<'EOD'
CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Manufacturer`()
BEGIN
SELECT `manufacturer`.`ID` AS ManufacturerID, `manufacturer`.`Name` AS ManufacturerName
FROM `manufacturer`;
END
EOD;

$names[4]='Add_New_Inventory';
$queries[4] = <<<'EOD'
CREATE DEFINER=`devAdmin`@`%` PROCEDURE `Add_New_Inventory`(ChemicalID int(10),Room varchar(45), Location varchar(45), ItemCount smallint(255), Size smallint(255), Unit varchar(45))
BEGIN
INSERT INTO `acid_rain`.`inventory`
(`ChemicalID`,`Room`,`Location`, `ItemCount`, `Size`, `Units`, `LastUpdated`)
VALUES(ChemicalID, Room, Location, ItemCount, Size, Unit, now());
END
EOD;

$names[5] = 'addChemical';
$queries[5] =<<<'EOD'
CREATE DEFINER=`root`@`localhost` PROCEDURE `addChemical`(chemicalName varchar(60))
BEGIN
Insert INTO `chemical`(`Name`)
VALUES(chemicalName);
SET @Id = (SELECT LAST_INSERT_ID());
END
EOD;

$names[6] = 'addManufacturer';
$queries[6] = <<<'EOD'
CREATE DEFINER=`root`@`localhost` PROCEDURE `addManufacturer`(manufacturerName varchar(60))
BEGIN
Insert INTO `manufacturer`(`Name`)
VALUES(manufacturerName);
SET @Id = (SELECT LAST_INSERT_ID());
END
EOD;

$names[7]='Get_Chemical';
$queries[7] =<<<'EOD'
CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Chemical`(manufacturerID Int(11))
BEGIN
SELECT `Chemical`.`ID` AS ChemicalID, `Chemical`.`Name` AS ChemicalName
FROM `Chemical`
WHERE `chemical`.`MfrID` = manufacturerID;
END
EOD;

$names = 'Get_Manufacturer';
$queries[8] =<<<'EOD'
CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Manufacturer`()
BEGIN
SELECT `manufacturer`.`ID` AS ManufacturerID, `manufacturer`.`Name` AS ManufacturerName
FROM `manufacturer`;
END
EOD;
/*
$functionNames[0] = 'levenshtein';
$functions[0] = <<<'EOD'
CREATE DEFINER=`root`@`localhost` FUNCTION `levenshtein`( s1 VARCHAR(255), s2 VARCHAR(255) ) RETURNS int(11)
DETERMINISTIC
BEGIN
    DECLARE s1_len, s2_len, i, j, c, c_temp, cost INT;
    DECLARE s1_char CHAR;
    -- max strlen=255
    DECLARE cv0, cv1 VARBINARY(256);
    SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2), cv1 = 0x00, j = 1, i = 1, c = 0;
    IF s1 = s2 THEN
      RETURN 0;
    ELSEIF s1_len = 0 THEN
      RETURN s2_len;
    ELSEIF s2_len = 0 THEN
      RETURN s1_len;
    ELSE
      WHILE j <= s2_len DO
        SET cv1 = CONCAT(cv1, UNHEX(HEX(j))), j = j + 1;
      END WHILE;
      WHILE i <= s1_len DO
        SET s1_char = SUBSTRING(s1, i, 1), c = i, cv0 = UNHEX(HEX(i)), j = 1;
        WHILE j <= s2_len DO
          SET c = c + 1;
          IF s1_char = SUBSTRING(s2, j, 1) THEN 
            SET cost = 0; ELSE SET cost = 1;
          END IF;
          SET c_temp = CONV(HEX(SUBSTRING(cv1, j, 1)), 16, 10) + cost;
          IF c > c_temp THEN SET c = c_temp; END IF;
            SET c_temp = CONV(HEX(SUBSTRING(cv1, j+1, 1)), 16, 10) + 1;
            IF c > c_temp THEN 
              SET c = c_temp; 
            END IF;
            SET cv0 = CONCAT(cv0, UNHEX(HEX(c))), j = j + 1;
        END WHILE;
        SET cv1 = cv0, i = i + 1;
      END WHILE;
    END IF;
    RETURN c;
  END
EOD;

$functionNames[1] = 'levenshtein_ratio';
$functions[1] = <<<'EOD'
CREATE DEFINER=`root`@`localhost` FUNCTION `levenshtein_ratio`( s1 VARCHAR(255), s2 VARCHAR(255) ) RETURNS int(11)
    DETERMINISTIC
BEGIN
    DECLARE s1_len, s2_len, max_len INT;
    SET s1_len = LENGTH(s1), s2_len = LENGTH(s2);
    IF s1_len > s2_len THEN 
      SET max_len = s1_len; 
    ELSE 
      SET max_len = s2_len; 
    END IF;
    RETURN ROUND((1 - LEVENSHTEIN(s1, s2) / max_len) * 100);
  END
EOD;
*/

//$devDB->query('DELIMITER $$');
for ($i =0;$i<count($queries);$i++){
    if(!$devDB->query("DROP procedure IF EXISTS `$names[$i]`;"))
        slog($devDB->error);
    if(!$devDB->multi_query($queries[$i]))
        slog($devDB->error);
}
/*for ($i =0;$i<count($functions);$i++){
    if(!$devDB->query("DROP function IF EXISTS `$functionNames[$i]`;"))
        slog($devDB->error);
    if(!$devDB->query($functions[$i]))
        slog($devDB->error);
}*/
//$devDB->query('DELIMITER ;');
?>
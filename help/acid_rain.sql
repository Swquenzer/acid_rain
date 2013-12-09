-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2013 at 08:47 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `acid_rain`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`web`@`localhost` PROCEDURE `Add_Inventory_Preload`()
BEGIN
SELECT `Manufacturer`.`name` AS `manufacturers`, `Chemical`.`name` AS `chemicals`, `Inventory`.`Room` AS `rooms`
From `manufacturer`,`chemical`,`inventory`;
END$$

CREATE DEFINER=`web`@`localhost` PROCEDURE `Add_New_Inventory`(IN `ChemicalID` INT(10), IN `Room` VARCHAR(45), IN `Location` VARCHAR(45), IN `ItemCount` SMALLINT(255), IN `Size` SMALLINT(255), IN `Unit` VARCHAR(45))
BEGIN
INSERT INTO `acid_rain`.`inventory`
(`ChemicalID`,`Room`,`Location`, `ItemCount`, `Size`, `Units`, `LastUpdated`)
VALUES(ChemicalID, Room, Location, ItemCount, Size, Unit, now());
END$$

CREATE DEFINER=`web`@`localhost` PROCEDURE `DelInventory`(IN `location` VARCHAR(45), IN `chemical` VARCHAR(45), IN `amount` SMALLINT(255), IN `mfr` VARCHAR(60))
BEGIN
SELECT ID 
FROM `inventory`LEFT JOIN (`chemical` LEFT JOIN `manufacturer` on `chemical`.`MfrID`= `manufacturer`.`ID`) on `inventory`.`ChemicalID` = `chemical`.`ID`
WHERE `inventory`.`Location`= location AND `chemical`.`Name`= chemical AND `inventory`.`Size`= ammount AND `manufacturer`.`Name`=mfr;
END$$

CREATE DEFINER=`web`@`localhost` PROCEDURE `Find_Manufacturer`(IN `ManufacturerName` VARCHAR(60))
BEGIN
SELECT `manufacturer`.`ID` AS ManufacturerID, `manufacturer`.`Name` AS ManufacturerName
FROM `manufacturer`;
END$$

CREATE DEFINER=`web`@`localhost` PROCEDURE `Get_Manufacturer`()
BEGIN
SELECT `manufacturer`.`ID` AS ManufacturerID, `manufacturer`.`Name` AS ManufacturerName
FROM `manufacturer`;
END$$

CREATE DEFINER=`web`@`localhost` PROCEDURE `Get_Spreadsheet`()
BEGIN 
SELECT `inventory`.`Room`, `inventory`.`Location`, `chemical`.`Name`, `inventory`.`Size`, `inventory`.`Units`, `manufacturer`.`Name` AS mfr
FROM `inventory` LEFT JOIN (`chemical` LEFT JOIN `manufacturer` ON `chemical`.`MfrID`= `manufacturer`.`ID`) ON `inventory`.`ChemicalID` = `chemical`.`ID`; 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `chemical`
--

CREATE TABLE IF NOT EXISTS `chemical` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MfrProdID` varchar(45) DEFAULT NULL,
  `Name` varchar(45) NOT NULL,
  `MfrID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `CHEMICAL` (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Room` varchar(45) NOT NULL,
  `Location` varchar(45) NOT NULL,
  `ItemCount` smallint(255) unsigned NOT NULL,
  `ChemicalID` int(10) unsigned NOT NULL,
  `Size` smallint(255) unsigned NOT NULL,
  `Units` varchar(20) NOT NULL,
  `LastUpdated` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `ROOM` (`Room`),
  KEY `CHEMICAL` (`ChemicalID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(60) NOT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `MSDSBaseURL` varchar(255) DEFAULT NULL,
  `MSDSSearchInfo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

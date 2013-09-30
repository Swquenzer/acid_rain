-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2013 at 02:06 PM
-- Server version: 5.6.10-log
-- PHP Version: 5.4.9

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `Get_Spreadsheet`()
BEGIN
SELECT inventory.Room, invetory.Location, chemical.Name, inventory.Size, inventory.Units
FROM inventory LEFT JOIN chemical ON inventory.ChemicalID = chemical.ID; 
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `chemical`
--

INSERT INTO `chemical` (`ID`, `MfrProdID`, `Name`, `MfrID`) VALUES
(1, NULL, 'Acacia', 1);

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
  `LastUpdated` date NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `ROOM` (`Room`),
  KEY `CHEMICAL` (`ChemicalID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ID`, `Room`, `Location`, `ItemCount`, `ChemicalID`, `Size`, `Units`, `LastUpdated`) VALUES
(1, '35', 'room', 1, 1, 350, 'g', '2013-09-22');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`ID`, `Name`, `Website`, `MSDSBaseURL`, `MSDSSearchInfo`) VALUES
(1, 'Fisher', 'www.fishersci.com', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

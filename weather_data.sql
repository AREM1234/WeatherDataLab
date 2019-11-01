-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 01, 2019 at 12:16 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weather_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(45) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `AdminName`, `AdminPassword`) VALUES
(1, 'Admin', '$2y$10$u4auTjeHu.0wVHI.MuGS3.xdwfe4.37tN3hd7LUTSQwoIe8/IjQ4C');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `CityID` int(11) NOT NULL AUTO_INCREMENT,
  `CityName` varchar(60) NOT NULL,
  PRIMARY KEY (`CityID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`CityID`, `CityName`) VALUES
(1, 'Alfred'),
(2, 'Lodi'),
(3, 'Hornell'),
(4, 'Ovid'),
(5, 'Clevland'),
(6, 'Austin'),
(7, 'Rochester'),
(8, 'Albany');

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

DROP TABLE IF EXISTS `conditions`;
CREATE TABLE IF NOT EXISTS `conditions` (
  `ConditionID` int(11) NOT NULL AUTO_INCREMENT,
  `ConditionType` varchar(45) NOT NULL,
  PRIMARY KEY (`ConditionID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`ConditionID`, `ConditionType`) VALUES
(1, 'Light Rain'),
(2, 'Cloudy'),
(3, 'Clear'),
(4, 'Snow'),
(5, 'Heavy Rain'),
(6, 'Mostly Cloudy');

-- --------------------------------------------------------

--
-- Table structure for table `direction`
--

DROP TABLE IF EXISTS `direction`;
CREATE TABLE IF NOT EXISTS `direction` (
  `DirectionID` int(11) NOT NULL AUTO_INCREMENT,
  `Direction` varchar(2) NOT NULL,
  PRIMARY KEY (`DirectionID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `direction`
--

INSERT INTO `direction` (`DirectionID`, `Direction`) VALUES
(1, 'N'),
(2, 'S'),
(3, 'E'),
(4, 'W'),
(5, 'NE'),
(6, 'NW'),
(7, 'SE'),
(8, 'SW');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `LocationID` int(11) NOT NULL AUTO_INCREMENT,
  `City` int(11) NOT NULL,
  `State` int(11) NOT NULL,
  PRIMARY KEY (`LocationID`),
  KEY `city` (`City`),
  KEY `state` (`State`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationID`, `City`, `State`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 1),
(4, 2, 4),
(5, 6, 6),
(6, 7, 1),
(7, 8, 1),
(8, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `numbers`
--

DROP TABLE IF EXISTS `numbers`;
CREATE TABLE IF NOT EXISTS `numbers` (
  `Number` double NOT NULL,
  PRIMARY KEY (`Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `numbers`
--

INSERT INTO `numbers` (`Number`) VALUES
(0),
(0.1),
(0.2),
(0.3),
(0.4),
(0.6),
(0.7),
(1),
(2),
(3),
(4),
(5),
(7),
(8),
(10),
(11),
(12),
(14),
(15),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(35),
(40),
(42),
(43),
(45),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(66),
(67),
(68),
(70),
(83);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `StateID` int(11) NOT NULL AUTO_INCREMENT,
  `StateName` varchar(2) NOT NULL,
  PRIMARY KEY (`StateID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`StateID`, `StateName`) VALUES
(1, 'NY'),
(2, 'NJ'),
(3, 'NH'),
(4, 'CA'),
(5, 'OH'),
(6, 'TX');

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

DROP TABLE IF EXISTS `weather`;
CREATE TABLE IF NOT EXISTS `weather` (
  `WeatherID` int(11) NOT NULL AUTO_INCREMENT,
  `Location` int(11) NOT NULL,
  `MinTemp` double NOT NULL,
  `MaxTemp` double NOT NULL,
  `AverageTemp` double NOT NULL,
  `AverageWindSpeed` double NOT NULL,
  `WindDirection` int(11) NOT NULL,
  `Precipitation` double NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`WeatherID`),
  KEY `location` (`Location`),
  KEY `mintemp` (`MinTemp`),
  KEY `maxtemp` (`MaxTemp`),
  KEY `averagetemp` (`AverageTemp`),
  KEY `averagewindspeed` (`AverageWindSpeed`),
  KEY `winddirection` (`WindDirection`),
  KEY `precipitation` (`Precipitation`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weather`
--

INSERT INTO `weather` (`WeatherID`, `Location`, `MinTemp`, `MaxTemp`, `AverageTemp`, `AverageWindSpeed`, `WindDirection`, `Precipitation`, `Date`) VALUES
(1, 1, 35, 45, 42, 5, 5, 0.2, '2019-10-24'),
(2, 1, 40, 45, 43, 3, 5, 0.3, '2019-10-23'),
(3, 2, 40, 45, 43, 12, 6, 0, '2019-10-24'),
(4, 3, 45, 56, 55, 5, 2, 0, '2019-10-24'),
(5, 1, 22, 35, 26, 20, 7, 12, '2019-10-14'),
(6, 2, 62, 70, 67, 4, 8, 0.1, '2019-10-16'),
(7, 3, 43, 55, 52, 21, 6, 0.2, '2019-10-08'),
(9, 1, 60, 70, 66, 24, 4, 2, '2019-10-20'),
(10, 8, 5, 60, 57, 12, 1, 3, '2019-10-25'),
(11, 1, 54, 67, 62, 1, 6, 0, '2019-10-25');

-- --------------------------------------------------------

--
-- Table structure for table `weathersconditions`
--

DROP TABLE IF EXISTS `weathersconditions`;
CREATE TABLE IF NOT EXISTS `weathersconditions` (
  `Weather` int(11) NOT NULL,
  `WeatherCondition` int(11) NOT NULL,
  KEY `weather` (`Weather`),
  KEY `weathercondition` (`WeatherCondition`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weathersconditions`
--

INSERT INTO `weathersconditions` (`Weather`, `WeatherCondition`) VALUES
(1, 2),
(1, 1),
(2, 2),
(2, 1),
(2, 3),
(3, 2),
(3, 3),
(4, 3),
(4, 2),
(5, 5),
(5, 6),
(6, 1),
(6, 2),
(7, 6),
(7, 1),
(9, 2),
(9, 5),
(10, 2),
(10, 5),
(11, 2),
(11, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`City`) REFERENCES `city` (`CityID`),
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`State`) REFERENCES `state` (`StateID`);

--
-- Constraints for table `weather`
--
ALTER TABLE `weather`
  ADD CONSTRAINT `weather_ibfk_1` FOREIGN KEY (`AverageTemp`) REFERENCES `numbers` (`Number`),
  ADD CONSTRAINT `weather_ibfk_2` FOREIGN KEY (`AverageWindSpeed`) REFERENCES `numbers` (`Number`),
  ADD CONSTRAINT `weather_ibfk_3` FOREIGN KEY (`Location`) REFERENCES `location` (`LocationID`),
  ADD CONSTRAINT `weather_ibfk_4` FOREIGN KEY (`MaxTemp`) REFERENCES `numbers` (`Number`),
  ADD CONSTRAINT `weather_ibfk_5` FOREIGN KEY (`MinTemp`) REFERENCES `numbers` (`Number`),
  ADD CONSTRAINT `weather_ibfk_6` FOREIGN KEY (`Precipitation`) REFERENCES `numbers` (`Number`),
  ADD CONSTRAINT `weather_ibfk_7` FOREIGN KEY (`WindDirection`) REFERENCES `direction` (`DirectionID`);

--
-- Constraints for table `weathersconditions`
--
ALTER TABLE `weathersconditions`
  ADD CONSTRAINT `weathersconditions_ibfk_1` FOREIGN KEY (`Weather`) REFERENCES `weather` (`WeatherID`),
  ADD CONSTRAINT `weathersconditions_ibfk_2` FOREIGN KEY (`WeatherCondition`) REFERENCES `conditions` (`ConditionID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2016 at 06:03 PM
-- Server version: 5.6.34
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `malamodi_csc621`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE IF NOT EXISTS `Appointment` (
  `ApptID` int(11) NOT NULL AUTO_INCREMENT,
  `ApptDate` date NOT NULL,
  `ApptTime` time NOT NULL,
  `Comments` varchar(1000) DEFAULT NULL,
  `Prescription` varchar(500) DEFAULT NULL,
  `ApptStatus` varchar(400) DEFAULT NULL,
  `PatientID` int(11) NOT NULL,
  PRIMARY KEY (`ApptID`),
  KEY `PatientID` (`PatientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5603 ;

--
-- Dumping data for table `Appointment`
--

INSERT INTO `Appointment` (`ApptID`, `ApptDate`, `ApptTime`, `Comments`, `Prescription`, `ApptStatus`, `PatientID`) VALUES
(5601, '2016-10-12', '09:30:00', NULL, NULL, 'closed', 198001),
(5602, '2017-01-12', '10:15:00', NULL, NULL, NULL, 198001);

-- --------------------------------------------------------

--
-- Table structure for table `Bill`
--

CREATE TABLE IF NOT EXISTS `Bill` (
  `BillId` int(11) NOT NULL AUTO_INCREMENT,
  `PendingAmount` decimal(10,2) NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `Paid` decimal(10,2) NOT NULL,
  `ApptID` int(11) NOT NULL,
  PRIMARY KEY (`BillId`),
  KEY `ApptID` (`ApptID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=623002 ;

--
-- Dumping data for table `Bill`
--

INSERT INTO `Bill` (`BillId`, `PendingAmount`, `TotalAmount`, `Paid`, `ApptID`) VALUES
(623001, '100.00', '1000.00', '900.00', 5601);

-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE IF NOT EXISTS `Department` (
  `DeptId` int(11) NOT NULL AUTO_INCREMENT,
  `DeptName` varchar(50) NOT NULL,
  PRIMARY KEY (`DeptId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Department`
--

INSERT INTO `Department` (`DeptId`, `DeptName`) VALUES
(1, 'Surgeon'),
(2, 'Accounts'),
(3, 'Administration');

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE IF NOT EXISTS `Employee` (
  `EmpID` int(11) NOT NULL AUTO_INCREMENT,
  `EmpFName` varchar(40) NOT NULL,
  `EmpLName` varchar(40) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `EmpAddress` varchar(50) NOT NULL,
  `EmpType` varchar(15) NOT NULL,
  `Image` longblob,
  `DeptID` int(11) NOT NULL,
  PRIMARY KEY (`EmpID`),
  KEY `deptID` (`DeptID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12004 ;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`EmpID`, `EmpFName`, `EmpLName`, `StartDate`, `EndDate`, `EmpAddress`, `EmpType`, `Image`, `DeptID`) VALUES
(12001, 'Hemanth', 'Nalamothu', '2016-10-11', NULL, 'Penn', 'Doctor', NULL, 1),
(12002, 'Tom', 'Keen', '2016-09-13', NULL, 'New York', 'recep', NULL, 2),
(12003, 'John', 'Smith', '2016-08-16', NULL, '5600, City ave.', 'Admin', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Employee_Phone`
--

CREATE TABLE IF NOT EXISTS `Employee_Phone` (
  `Phone` varchar(15) NOT NULL,
  `EmpID` int(10) NOT NULL,
  PRIMARY KEY (`Phone`,`EmpID`),
  KEY `EmpID` (`EmpID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Employee_Phone`
--

INSERT INTO `Employee_Phone` (`Phone`, `EmpID`) VALUES
('5853551617', 12001),
('1234567890', 12002),
('1213456572', 12003);

-- --------------------------------------------------------

--
-- Table structure for table `LoginDetails`
--

CREATE TABLE IF NOT EXISTS `LoginDetails` (
  `ID` int(10) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Type` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LoginDetails`
--

INSERT INTO `LoginDetails` (`ID`, `Password`, `Type`) VALUES
(12001, 'ba3abb2c0cb388f3cd4e77de3c78ff51', 'Doctor'),
(12002, 'f6bc0623a4ab517ae89db46f368c09c4', 'recep'),
(12003, 'd2a9aaedbe3616c7be11e07856c29e2a', 'Admin'),
(198001, 'c6e53a7e82a4138b330b17c4a91267a1', 'Patient');

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE IF NOT EXISTS `Patient` (
  `PatientID` int(11) NOT NULL AUTO_INCREMENT,
  `PatientFName` varchar(25) NOT NULL,
  `PatientLName` varchar(25) NOT NULL,
  `PatientAddress` varchar(100) DEFAULT NULL,
  `DOB` date NOT NULL,
  `Image` longblob,
  PRIMARY KEY (`PatientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=198002 ;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`PatientID`, `PatientFName`, `PatientLName`, `PatientAddress`, `DOB`, `Image`) VALUES
(198001, 'Mohammed', 'Alamoudi', 'Lancaster Ave. , Philadelphia, Pa', '1990-12-11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Patient_Phone`
--

CREATE TABLE IF NOT EXISTS `Patient_Phone` (
  `Phone` char(15) NOT NULL,
  `PatientID` int(11) NOT NULL,
  PRIMARY KEY (`PatientID`,`Phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Patient_Phone`
--

INSERT INTO `Patient_Phone` (`Phone`, `PatientID`) VALUES
('0500111405', 198001),
('2156099039', 198001);

-- --------------------------------------------------------

--
-- Table structure for table `SeenBy`
--

CREATE TABLE IF NOT EXISTS `SeenBy` (
  `ApptID` int(11) NOT NULL,
  `EmpId` int(10) NOT NULL,
  PRIMARY KEY (`ApptID`,`EmpId`),
  KEY `EmpID` (`EmpId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SeenBy`
--

INSERT INTO `SeenBy` (`ApptID`, `EmpId`) VALUES
(5601, 12001);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `Patient` (`PatientID`) ON DELETE CASCADE;

--
-- Constraints for table `Bill`
--
ALTER TABLE `Bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`ApptID`) REFERENCES `Appointment` (`ApptID`) ON DELETE CASCADE;

--
-- Constraints for table `Employee`
--
ALTER TABLE `Employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`DeptID`) REFERENCES `Department` (`DeptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Employee_Phone`
--
ALTER TABLE `Employee_Phone`
  ADD CONSTRAINT `employee_phone_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `Employee` (`EmpID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Patient_Phone`
--
ALTER TABLE `Patient_Phone`
  ADD CONSTRAINT `patient_phone_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `Patient` (`PatientID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SeenBy`
--
ALTER TABLE `SeenBy`
  ADD CONSTRAINT `seenby_ibfk_1` FOREIGN KEY (`EmpId`) REFERENCES `Employee` (`EmpID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seenby_ibfk_2` FOREIGN KEY (`ApptID`) REFERENCES `Appointment` (`ApptID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

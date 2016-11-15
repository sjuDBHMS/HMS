-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2016 at 08:56 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `HMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE IF NOT EXISTS `Appointment` (
  `ApptID` int(11) NOT NULL,
  `AppDate` date NOT NULL,
  `AppTime` time NOT NULL,
  `Comments` varchar(1000) DEFAULT NULL,
  `Prescription` varchar(500) DEFAULT NULL,
  `ApptStatus` varchar(25) DEFAULT NULL,
  `PatientID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5603 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Appointment`
--

INSERT INTO `Appointment` (`ApptID`, `AppDate`, `AppTime`, `Comments`, `Prescription`, `ApptStatus`, `PatientID`) VALUES
(5601, '2016-11-01', '14:30:00', NULL, NULL, 'closed', 198002),
(5602, '2016-11-16', '10:41:00', NULL, NULL, NULL, 198001);

-- --------------------------------------------------------

--
-- Table structure for table `Bill`
--

CREATE TABLE IF NOT EXISTS `Bill` (
  `BillId` int(11) NOT NULL,
  `PendingAmount` decimal(10,2) NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `Paid` decimal(10,2) NOT NULL,
  `ApptID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=623002 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Bill`
--

INSERT INTO `Bill` (`BillId`, `PendingAmount`, `TotalAmount`, `Paid`, `ApptID`) VALUES
(623001, '150.00', '150.00', '0.00', 5601);

-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE IF NOT EXISTS `Department` (
  `DeptId` int(11) NOT NULL,
  `DeptName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Department`
--

INSERT INTO `Department` (`DeptId`, `DeptName`) VALUES
(1, 'Surgery'),
(2, 'Reception');

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE IF NOT EXISTS `Employee` (
  `EmpID` int(11) NOT NULL,
  `EmpFName` varchar(40) NOT NULL,
  `EmpLName` varchar(40) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `EmpAddress` varchar(50) NOT NULL,
  `EmpType` varchar(15) NOT NULL,
  `Image` longblob,
  `DeptID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12003 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`EmpID`, `EmpFName`, `EmpLName`, `StartDate`, `EndDate`, `EmpAddress`, `EmpType`, `Image`, `DeptID`) VALUES
(12001, 'Mohammed', 'Khaled', '2015-11-08', NULL, '6100 City Avenue, Philadelphia, PA 19131', 'doctor', NULL, 1),
(12002, 'kevin', 'james', '2016-11-01', NULL, '5600, city ave ,philadelphia', 'receptioni', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Employee_Phone`
--

CREATE TABLE IF NOT EXISTS `Employee_Phone` (
  `Phone` varchar(15) NOT NULL,
  `EmpID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LoginDetails`
--

CREATE TABLE IF NOT EXISTS `LoginDetails` (
  `LoginID` int(11) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Type` int(10) NOT NULL,
  `PatientID` varchar(50) DEFAULT NULL,
  `EmpID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LoginDetails`
--

INSERT INTO `LoginDetails` (`LoginID`, `Password`, `Type`) VALUES
(12001, '12001', 'doctor'),
(12002, '12002', 'receptionist'),
(198001, '198001', 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE IF NOT EXISTS `Patient` (
  `PatientID` int(11) NOT NULL,
  `PatientFName` varchar(25) NOT NULL,
  `PatientLName` varchar(25) NOT NULL,
  `PatientAddress` varchar(100) DEFAULT NULL,
  `DOB` date NOT NULL,
  `Image` longblob
) ENGINE=InnoDB AUTO_INCREMENT=198003 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`PatientID`, `PatientFName`, `PatientLName`, `PatientAddress`, `DOB`, `Image`) VALUES
(198001, 'John', 'Smith', '5600 City Ave, Philadelphia, PA 19131', '1990-07-10', NULL),
(198002, 'elizabeth', 'keen', '555 city ave Philadelphia', '1992-06-15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Patient_Phone`
--

CREATE TABLE IF NOT EXISTS `Patient_Phone` (
  `Phone` char(15) NOT NULL,
  `PatientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Patient_Phone`
--

INSERT INTO `Patient_Phone` (`Phone`, `PatientID`) VALUES
('215-111-2222', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `SeenBy`
--

CREATE TABLE IF NOT EXISTS `SeenBy` (
  `ApptID` int(11) NOT NULL,
  `EmpId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SeenBy`
--

INSERT INTO `SeenBy` (`ApptID`, `EmpId`) VALUES
(5601, 12002);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`ApptID`),
  ADD KEY `PatientID` (`PatientID`);

--
-- Indexes for table `Bill`
--
ALTER TABLE `Bill`
  ADD PRIMARY KEY (`BillId`),
  ADD KEY `ApptID` (`ApptID`);

--
-- Indexes for table `Department`
--
ALTER TABLE `Department`
  ADD PRIMARY KEY (`DeptId`);

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`EmpID`),
  ADD KEY `deptID` (`DeptID`);

--
-- Indexes for table `Employee_Phone`
--
ALTER TABLE `Employee_Phone`
  ADD PRIMARY KEY (`Phone`,`EmpID`),
  ADD KEY `EmpID` (`EmpID`);

--
-- Indexes for table `LoginDetails`
--
ALTER TABLE `LoginDetails`
  ADD PRIMARY KEY (`LoginID`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`PatientID`);

--
-- Indexes for table `Patient_Phone`
--
ALTER TABLE `Patient_Phone`
  ADD PRIMARY KEY (`PatientID`,`Phone`);

--
-- Indexes for table `SeenBy`
--
ALTER TABLE `SeenBy`
  ADD PRIMARY KEY (`ApptID`,`EmpId`),
  ADD KEY `EmpID` (`EmpId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Appointment`
--
ALTER TABLE `Appointment`
  MODIFY `ApptID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5603;
--
-- AUTO_INCREMENT for table `Bill`
--
ALTER TABLE `Bill`
  MODIFY `BillId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=623002;
--
-- AUTO_INCREMENT for table `Department`
--
ALTER TABLE `Department`
  MODIFY `DeptId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `EmpID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12003;
--
-- AUTO_INCREMENT for table `Patient`
--
ALTER TABLE `Patient`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=198003;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `Patient` (`PatientID`);

--
-- Constraints for table `Bill`
--
ALTER TABLE `Bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`ApptID`) REFERENCES `Appointment` (`ApptID`);

--
-- Constraints for table `Employee`
--
ALTER TABLE `Employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`DeptID`) REFERENCES `Department` (`DeptId`);

--
-- Constraints for table `Employee_Phone`
--
ALTER TABLE `Employee_Phone`
  ADD CONSTRAINT `employee_phone_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `Employee` (`EmpID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

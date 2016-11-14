-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2016 at 04:04 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `Appointment` (
  `ApptID` int(11) NOT NULL,
  `AppDate` date NOT NULL,
  `AppTime` char(20) NOT NULL,
  `Comments` varchar(1000) DEFAULT NULL,
  `Prescription` varchar(500) DEFAULT NULL,
  `ApptStatus` varchar(400) DEFAULT NULL,
  `PatientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `Appointment` (`ApptID`, `AppDate`, `AppTime`, `Comments`, `prescription`, `ApptStatus`, `PatientID`) VALUES
(1, '2016-11-10', '9:30 AM', NULL, NULL, 'completed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `Bill` (
  `BillID` int(11) NOT NULL,
  `PendingAmount` decimal(10,2) NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `Paid` decimal(10,2) NOT NULL,
  `ApptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `Bill` (`BillID`, `PendingAmount`, `TotalAmount`, `Paid`, `ApptID`) VALUES
(2, '0.00', '500.00', '200.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `Department` (
  `DeptID` int(11) NOT NULL,
  `DeptName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `Department` (`DeptID`, `DeptName`) VALUES
(1, 'Surgery');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `Employee` (
  `EmpID` varchar(50) NOT NULL,
  `EmpFName` varchar(40) NOT NULL,
  `EmpLName` varchar(40) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `EmpAddress` varchar(200) NOT NULL,
  `EmpType` varchar(10) NOT NULL,
  `Image` longblob,
  `DeptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `Employee` (`EmpID`, `EmpFName`, `EmpLName`, `StartDate`, `EndDate`, `EmpAddress`, `EmpType`, `Image`, `DeptID`) VALUES
(2, 'Mohammed', 'Khaled', '2015-11-08', NULL, '6100 City Avenue, Philadelphia, PA 19131', 'doctor', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_phone`
--

CREATE TABLE `Employee_Phone` (
  `Phone` varchar(15) NOT NULL,
  `EmpID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_phone`
--

INSERT INTO `Employee_Phone` (`Phone`, `EmpID`) VALUES
('215-777-2222', 2);

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `LoginDetails` (
  `ID` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Type` int(10) NOT NULL,
  `PatientID` varchar(50) DEFAULT NULL,
  `EmpID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `Logindetails` (`ID`, `Password`, `Type`, `PatientID`, `EmpID`) VALUES
('malduniawi', '12345', 1, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `Patient` (
  `PatientID` varchar(50) NOT NULL,
  `PatientFName` varchar(25) NOT NULL,
  `PatientLName` varchar(25) NOT NULL,
  `PatientAddress` varchar(100) DEFAULT NULL,
  `DOB` date NOT NULL,
  `Image` longblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `Patient` (`PatientId`, `PatientFName`, `PatientLName`, `PatientAddress`, `DOB`, `Image`) VALUES
(1, 'John', 'Smith', '5600 City Ave, Philadelphia, PA 19131', '1990-07-10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_phone`
--

CREATE TABLE `Patient_Phone` (
  `Phone` char(15) NOT NULL,
  `PatientID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_phone`
--

INSERT INTO `Patient_Phone` (`Phone`, `PatientID`) VALUES
('215-111-2222', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seenby`
--

CREATE TABLE `SeenBy` (
  `ApptID` int(11) NOT NULL,
  `EmpId` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seenby`
--

INSERT INTO `SeenBy` (`ApptID`, `EmpID`) VALUES
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`ApptID`),
  ADD KEY `PatientID` (`PatientID`);

--
-- Indexes for table `bill`
--
ALTER TABLE `Bill`
  ADD PRIMARY KEY (`BillID`),
  ADD KEY `ApptID` (`ApptId`);

--
-- Indexes for table `department`
--
ALTER TABLE `Department`
  ADD PRIMARY KEY (`DeptID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`EmpID`),
  ADD KEY `deptID` (`DeptID`);

--
-- Indexes for table `employee_phone`
--
ALTER TABLE `Employee_Phone`
  ADD PRIMARY KEY (`Phone`,`EmpID`),
  ADD KEY `EmpID` (`EmpID`);

--
-- Indexes for table `logindetails`
--
ALTER TABLE `LoginDetails`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `EmpID` (`EmpID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`PatientId`);

--
-- Indexes for table `patient_phone`
--
ALTER TABLE `Patient_Phone`
  ADD PRIMARY KEY (`PatientID`,`Phone`);

--
-- Indexes for table `seenby`
--
ALTER TABLE `SeenBy`
  ADD PRIMARY KEY (`ApptID`,`EmpID`),
  ADD KEY `EmpID` (`EmpId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `Appointment`
  MODIFY `ApptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `Bill`
  MODIFY `BillId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `Department`
  MODIFY `DeptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `Employee`
  MODIFY `EmpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `Patient`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `Appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `Patient` (`PatientID`);

--
-- Constraints for table `bill`
--
ALTER TABLE `Bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`ApptID`) REFERENCES `Appointment` (`ApptID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `Employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`DeptID`) REFERENCES `department` (`DeptId`);

--
-- Constraints for table `employee_phone`
--
ALTER TABLE `Employee_Phone`
  ADD CONSTRAINT `employee_phone_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `Employee` (`EmpID`);

--
-- Constraints for table `logindetails`
--
ALTER TABLE `LoginDetails`
  ADD CONSTRAINT `logindetails_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `Patient` (`PatientID`),
  ADD CONSTRAINT `logindetails_ibfk_2` FOREIGN KEY (`EmpID`) REFERENCES `Employee` (`EmpID`);

--
-- Constraints for table `patient_phone`
--
ALTER TABLE `Patient_Phone`
  ADD CONSTRAINT `patient_phone_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `Patient` (`PatientID`);

--
-- Constraints for table `seenby`
--
ALTER TABLE `SeenBy`
  ADD CONSTRAINT `seenby_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `Employee` (`EmpID`),
  ADD CONSTRAINT `seenby_ibfk_2` FOREIGN KEY (`ApptID`) REFERENCES `Appointment` (`ApptID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

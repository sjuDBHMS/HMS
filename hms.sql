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

CREATE TABLE `appointment` (
  `apptid` int(11) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` char(20) NOT NULL,
  `comments` varchar(1000) DEFAULT NULL,
  `prescription` varchar(500) DEFAULT NULL,
  `apptstatus` varchar(400) DEFAULT NULL,
  `patientid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`apptid`, `appdate`, `apptime`, `comments`, `prescription`, `apptstatus`, `patientid`) VALUES
(1, '2016-11-10', '9:30 AM', NULL, NULL, 'completed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `billid` int(11) NOT NULL,
  `pendingamount` decimal(10,2) NOT NULL,
  `totalamount` decimal(10,2) NOT NULL,
  `paid` decimal(10,2) NOT NULL,
  `apptid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`billid`, `pendingamount`, `totalamount`, `paid`, `apptid`) VALUES
(2, '0.00', '500.00', '200.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `deptid` int(11) NOT NULL,
  `deptname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptid`, `deptname`) VALUES
(1, 'Surgery');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empid` int(11) NOT NULL,
  `empfname` varchar(40) NOT NULL,
  `emplname` varchar(40) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date DEFAULT NULL,
  `empaddress` varchar(200) NOT NULL,
  `emptype` varchar(50) NOT NULL,
  `image` longblob,
  `deptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empid`, `empfname`, `emplname`, `startdate`, `enddate`, `empaddress`, `emptype`, `image`, `deptID`) VALUES
(2, 'Mohammed', 'Khaled', '2015-11-08', NULL, '6100 City Avenue, Philadelphia, PA 19131', 'doctor', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_phone`
--

CREATE TABLE `employee_phone` (
  `phone` varchar(15) NOT NULL,
  `empid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_phone`
--

INSERT INTO `employee_phone` (`phone`, `empid`) VALUES
('215-777-2222', 2);

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `id` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `type` int(11) NOT NULL,
  `patientid` int(11) DEFAULT NULL,
  `empid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`id`, `password`, `type`, `patientid`, `empid`) VALUES
('malduniawi', '12345', 1, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientid` int(11) NOT NULL,
  `patientfname` varchar(25) NOT NULL,
  `patientlname` varchar(25) NOT NULL,
  `patientaddress` varchar(100) DEFAULT NULL,
  `dob` date NOT NULL,
  `image` longblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `patientfname`, `patientlname`, `patientaddress`, `dob`, `image`) VALUES
(1, 'John', 'Smith', '5600 City Ave, Philadelphia, PA 19131', '1990-07-10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_phone`
--

CREATE TABLE `patient_phone` (
  `Phone` char(15) NOT NULL,
  `patientid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_phone`
--

INSERT INTO `patient_phone` (`Phone`, `patientid`) VALUES
('215-111-2222', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seenby`
--

CREATE TABLE `seenby` (
  `apptid` int(11) NOT NULL,
  `empid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seenby`
--

INSERT INTO `seenby` (`apptid`, `empid`) VALUES
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`apptid`),
  ADD KEY `patientid` (`patientid`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`billid`),
  ADD KEY `apptid` (`apptid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`deptid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empid`),
  ADD KEY `deptID` (`deptID`);

--
-- Indexes for table `employee_phone`
--
ALTER TABLE `employee_phone`
  ADD PRIMARY KEY (`phone`,`empid`),
  ADD KEY `empid` (`empid`);

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `empid` (`empid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientid`);

--
-- Indexes for table `patient_phone`
--
ALTER TABLE `patient_phone`
  ADD PRIMARY KEY (`patientid`,`Phone`);

--
-- Indexes for table `seenby`
--
ALTER TABLE `seenby`
  ADD PRIMARY KEY (`apptid`,`empid`),
  ADD KEY `empid` (`empid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `apptid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `billid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `deptid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patient` (`patientid`);

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`apptid`) REFERENCES `appointment` (`apptid`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`deptID`) REFERENCES `department` (`deptid`);

--
-- Constraints for table `employee_phone`
--
ALTER TABLE `employee_phone`
  ADD CONSTRAINT `employee_phone_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employee` (`empid`);

--
-- Constraints for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD CONSTRAINT `logindetails_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patient` (`patientid`),
  ADD CONSTRAINT `logindetails_ibfk_2` FOREIGN KEY (`empid`) REFERENCES `employee` (`empid`);

--
-- Constraints for table `patient_phone`
--
ALTER TABLE `patient_phone`
  ADD CONSTRAINT `patient_phone_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patient` (`patientid`);

--
-- Constraints for table `seenby`
--
ALTER TABLE `seenby`
  ADD CONSTRAINT `seenby_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employee` (`empid`),
  ADD CONSTRAINT `seenby_ibfk_2` FOREIGN KEY (`apptid`) REFERENCES `appointment` (`apptid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

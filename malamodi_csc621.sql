-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2016 at 10:31 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `malamodi_csc621`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `ApptID` int(11) NOT NULL,
  `ApptDate` date NOT NULL,
  `ApptTime` time NOT NULL,
  `Comments` varchar(1000) DEFAULT NULL,
  `Prescription` varchar(500) DEFAULT NULL,
  `ApptStatus` varchar(400) DEFAULT NULL,
  `PatientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`ApptID`, `ApptDate`, `ApptTime`, `Comments`, `Prescription`, `ApptStatus`, `PatientID`) VALUES
(5601, '2017-04-04', '09:30:00', NULL, NULL, 'closed', 198001),
(5602, '2017-01-16', '11:34:00', 'needs to pay', NULL, 'closed', 198002),
(5603, '2016-08-08', '08:36:00', NULL, 'placebo', 'closed', 198003),
(5604, '2016-02-10', '14:50:00', 'May reschedule', '2 bottles', '12008', 198004),
(5605, '2016-06-22', '11:32:00', NULL, '3.5 bottles', 'closed', 198005),
(5606, '2017-02-02', '14:45:00', 'Child', 'none', '12017', 198006),
(5607, '2017-02-08', '10:15:00', 'Needs to schedule another appointment', 'rest', '12018', 198007),
(5608, '2016-05-31', '13:30:00', NULL, NULL, 'closed', 198008),
(5609, '2017-01-05', '09:15:00', 'Needs to schedule for child', '1 bottle', '12004', 198009),
(5610, '2016-11-22', '11:15:00', NULL, NULL, '12005', 198010),
(5611, '2016-10-11', '13:15:00', 'x-rays needed', NULL, 'closed', 198011),
(5612, '2017-01-12', '10:15:00', 'none', '4 bottles', '12011', 198012),
(5613, '2016-06-29', '14:35:00', 'is a child', 'Children''s tylenol', '12017', 198013),
(5614, '2016-10-24', '10:15:00', 'Needs blood work done', '2 bottles', 'closed', 198014),
(5615, '2016-09-20', '09:30:00', NULL, 'physical rehab', 'closed', 198015),
(5616, '2017-02-02', '13:45:00', 'needs to schedule a physical', NULL, 'closed', 198016),
(5617, '2016-05-17', '15:30:00', 'issues with payment', NULL, 'closed', 198017),
(5618, '2017-06-14', '15:30:00', NULL, NULL, '12005', 198018),
(5619, '2017-04-21', '13:29:00', 'Needs to pay', NULL, '12008', 198019),
(5620, '2017-07-13', '10:15:00', NULL, NULL, '12011', 198020);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `BillId` int(11) NOT NULL,
  `PendingAmount` decimal(10,2) NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `Paid` decimal(10,2) NOT NULL,
  `ApptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`BillId`, `PendingAmount`, `TotalAmount`, `Paid`, `ApptID`) VALUES
(623001, '100.00', '1000.00', '900.00', 5601),
(623021, '50.00', '1000.00', '950.00', 5602),
(623022, '0.00', '10.00', '10.00', 5603),
(623023, '80.00', '100.00', '20.00', 5604),
(623024, '150.00', '300.00', '150.00', 5605),
(623025, '50.00', '100.00', '50.00', 5606),
(623026, '25.00', '50.00', '25.00', 5607),
(623027, '0.00', '100.00', '100.00', 5608),
(623028, '20.00', '40.00', '20.00', 5609),
(623029, '0.00', '750.00', '750.00', 5610),
(623030, '0.00', '700.00', '700.00', 5611),
(623031, '0.00', '600.00', '600.00', 5612),
(623032, '0.00', '730.00', '730.00', 5613),
(623033, '30.00', '90.00', '60.00', 5614),
(623034, '20.00', '80.00', '60.00', 5615),
(623035, '500.00', '1100.00', '600.00', 5616),
(623036, '25.00', '100.00', '75.00', 5617),
(623037, '20.00', '100.00', '80.00', 5618),
(623038, '75.00', '150.00', '75.00', 5619),
(623039, '0.00', '150.00', '150.00', 5620);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DeptId` int(11) NOT NULL,
  `DeptName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DeptId`, `DeptName`) VALUES
(1, 'Surgeon'),
(2, 'Accounts'),
(3, 'Administration');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmpID` int(11) NOT NULL,
  `EmpFName` varchar(40) NOT NULL,
  `EmpLName` varchar(40) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `EmpAddress` varchar(50) NOT NULL,
  `EmpType` varchar(15) NOT NULL,
  `Image` longblob,
  `DeptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmpID`, `EmpFName`, `EmpLName`, `StartDate`, `EndDate`, `EmpAddress`, `EmpType`, `Image`, `DeptID`) VALUES
(12001, 'Hemanth', 'Nalamothu', '2016-10-11', NULL, 'Penn', 'Doctor', NULL, 1),
(12002, 'Tom', 'Keen', '2016-09-13', NULL, 'New York', 'recep', NULL, 2),
(12003, 'John', 'Smith', '2016-08-16', NULL, '5600, City ave.', 'Admin', NULL, 3),
(12004, 'Jimmy', 'Carter', '2016-08-16', NULL, 'Lansdale avenue', 'Doctor', NULL, 1),
(12005, 'Monkey', 'Luffy', '2016-08-16', NULL, 'Grandline ave', 'Doctor', NULL, 1),
(12006, 'Roanoa', 'Zoro', '2015-04-15', '2016-08-09', 'New Jersey', 'Admin', NULL, 3),
(12007, 'Ryan', 'Howard', '2016-06-14', NULL, 'Philadelphia', 'recep', NULL, 2),
(12008, 'John', 'Jaskal', '2015-06-09', NULL, 'Jacksonville', 'Doctor', NULL, 1),
(12009, 'Michael', 'Johnson', '2016-01-04', '2016-12-01', 'Park Avenue', 'recep', NULL, 2),
(12010, 'Chris', 'Redfield', '2016-08-16', NULL, 'Jacksonville', 'Admin', NULL, 3),
(12011, 'will', 'Arnett', '2016-02-08', NULL, 'Kentucky', 'Doctor', NULL, 1),
(12012, 'Son', 'Goku', '2015-03-17', '2015-11-25', 'West City', 'recep', NULL, 2),
(12013, 'Jimmy', 'Neutron', '2016-03-06', NULL, 'Retroville', 'recep', NULL, 2),
(12014, 'Barack', 'Obama', '2015-02-01', '2016-12-01', 'Washington', 'Admin', NULL, 3),
(12015, 'Bill', 'Burr', '2016-02-08', NULL, 'Lancaster Ave', 'recep', NULL, 2),
(12016, 'Ryan', 'Reynolds', '2016-03-07', '2016-12-08', 'California', 'recep', NULL, 2),
(12017, 'Ronald', 'Mcdonald', '2015-12-16', NULL, 'New York', 'Doctor', NULL, 1),
(12018, 'Regina', 'King', '2015-09-21', NULL, 'Florida', 'Doctor', NULL, 1),
(12019, 'Kim', 'Possible', '2015-01-05', '2016-09-15', '5600, City ave.', 'Admin', NULL, 3),
(12020, 'John', 'Smith', '2016-08-16', NULL, '5600, City ave.', 'Admin', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee_phone`
--

CREATE TABLE `employee_phone` (
  `Phone` varchar(15) NOT NULL,
  `EmpID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_phone`
--

INSERT INTO `employee_phone` (`Phone`, `EmpID`) VALUES
('1009568348', 12010),
('1213456572', 12003),
('1234567890', 12002),
('2205683643', 12011),
('2348907685', 12019),
('2647692546', 12005),
('4280646386', 12009),
('4762107437', 12005),
('5439086574', 12017),
('5853551617', 12001),
('7094327654', 12013),
('7396738753', 12004),
('8096549876', 12014),
('8300348641', 12006),
('8569085423', 12018),
('9069872314', 12012),
('9081233243', 12016),
('9084532387', 12015),
('9094563214', 12020),
('9150275614', 12008),
('9351257642', 12007);

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `ID` int(10) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`ID`, `Password`, `Type`) VALUES
(12001, 'ba3abb2c0cb388f3cd4e77de3c78ff51', 'Doctor'),
(12002, 'f6bc0623a4ab517ae89db46f368c09c4', 'recep'),
(12003, 'd2a9aaedbe3616c7be11e07856c29e2a', 'Admin'),
(12004, 'dsjlkdhsdoiyhlkefjlkio8732667786423a', 'Doctor'),
(12005, '897hjghgftye453ryguhf78i6u8', 'Doctor'),
(12006, 'kjhuihiug765786gyufv756578tg7ub78g', 'Admin'),
(12007, 'kjbkhjg78tgiujb76476t998iuo987908yhouih', 'recep'),
(12008, 'jkhg7647564567c764576t786', 'Doctor'),
(12009, '876iughkjbyut76785674756456e56edjhfty7767', 'recep'),
(12010, 'kuhg87687678tgyvg7868hjkhg7868', 'Admin'),
(198001, 'c6e53a7e82a4138b330b17c4a91267a1', 'Patient'),
(198002, 'c787979eokjllksdjfo8d97f9asudofij', 'Patient'),
(198003, 'hsjdlfkajskldfj92387r98324759iuou985798', 'Patient'),
(198004, '7868sdf87sad6f87sdfsdaf', 'Patient'),
(198005, '8698y5iuhjkhsd9uifg6238974', 'Patient'),
(198006, '78678hjbvjhkg875786tg778g78buhbg', 'Patient'),
(198007, '78678hjbvjhkg875786tg778g78buhbg', 'Patient'),
(198008, 'kjh876897678tgbv876897', 'Patient'),
(198009, '987hjkjk8768676hu0897hjk', 'Patient'),
(198010, 'kjhg78687678ijkgh87587tui', 'Patient');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` int(11) NOT NULL,
  `PatientFName` varchar(25) NOT NULL,
  `PatientLName` varchar(25) NOT NULL,
  `PatientAddress` varchar(100) DEFAULT NULL,
  `DOB` date NOT NULL,
  `Image` longblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `PatientFName`, `PatientLName`, `PatientAddress`, `DOB`, `Image`) VALUES
(198001, 'Mohammed', 'Alamoudi', 'Lancaster Ave. , Philadelphia, Pa', '1990-12-11', NULL),
(198002, 'Victor', 'Logan', 'City Ave. , Philadelphia, Pa', '1994-03-11', NULL),
(198003, 'Jack', 'Johnson', 'Park ave, Pleasantville, Pa', '1997-09-10', NULL),
(198004, 'Jimmy', 'Carter', 'lapsely lane , Philadelphia, Pa', '1980-03-11', NULL),
(198005, 'Joel', 'Velez', 'Pierce Street , Philadelphia, Pa', '1995-02-11', NULL),
(198006, 'Emmanuel', 'Johnson', 'Pierce St. , Philadelphia, Pa', '1989-06-23', NULL),
(198007, 'Jimmy', 'Johnson', 'New York', '1991-05-16', NULL),
(198008, 'Jess', 'Carsel', 'Kentucky', '1989-08-08', NULL),
(198009, 'Mary', 'Krueger', 'Pennsylvania', '1991-04-18', NULL),
(198010, 'jennifer', 'Aniston', 'Pennsylvania ', '1989-04-09', NULL),
(198011, 'Sarah', 'Jones', 'New Jersey', '1991-08-13', NULL),
(198012, 'Will', 'Johnson', 'Massachusetts ', '1989-05-16', NULL),
(198013, 'Matt', 'Patt', 'Texas', '1993-04-21', NULL),
(198014, 'KYLE', 'Chambley', 'Pennsylvania ', '1989-10-18', NULL),
(198015, 'Gio', 'Vencenzo', 'New Jersey', '1991-04-16', NULL),
(198016, 'Bruce', 'Springsteen', 'California', '1989-06-06', NULL),
(198017, 'Jeff', 'Bakular', 'Pennsylvania', '1992-05-19', NULL),
(198018, 'Colonel', 'Sanders', 'Florida', '1989-11-21', NULL),
(198019, 'John', 'Richards', 'Pennsylvania ', '1989-01-19', NULL),
(198020, 'kim', 'Possible', 'New Jersey', '1990-07-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_phone`
--

CREATE TABLE `patient_phone` (
  `Phone` char(15) NOT NULL,
  `PatientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_phone`
--

INSERT INTO `patient_phone` (`Phone`, `PatientID`) VALUES
('0500111405', 198001),
('2156099039', 198002),
('9061438546', 198003),
('6450982314', 198004),
('7094386754', 198005),
('7094239876', 198006),
('5762097865', 198007),
('4397687456', 198008),
('9084897865', 198009),
('3908763409', 198010),
('6459086754', 198011),
('6472340987', 198012),
('7589072345', 198013),
('7684569567', 198014),
('7684989087', 198015),
('6547894567', 198016),
('7560983456', 198017),
('6785430989', 198018),
('8794560789', 198019),
('8795766987', 198020);

-- --------------------------------------------------------

--
-- Table structure for table `seenby`
--

CREATE TABLE `seenby` (
  `ApptID` int(11) NOT NULL,
  `EmpId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seenby`
--

INSERT INTO `seenby` (`ApptID`, `EmpId`) VALUES
(5601, 12001),
(5602, 12004),
(5603, 12005),
(5604, 12008),
(5605, 12011),
(5606, 12017),
(5607, 12018),
(5608, 12001),
(5609, 12004),
(5610, 12005),
(5611, 12008),
(5612, 12011),
(5613, 12017),
(5614, 12018),
(5615, 12001),
(5616, 12001),
(5617, 12004),
(5618, 12005),
(5619, 12008),
(5620, 12011);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`ApptID`),
  ADD KEY `PatientID` (`PatientID`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`BillId`),
  ADD KEY `ApptID` (`ApptID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DeptId`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmpID`),
  ADD KEY `deptID` (`DeptID`);

--
-- Indexes for table `employee_phone`
--
ALTER TABLE `employee_phone`
  ADD PRIMARY KEY (`Phone`,`EmpID`),
  ADD KEY `EmpID` (`EmpID`);

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PatientID`);

--
-- Indexes for table `patient_phone`
--
ALTER TABLE `patient_phone`
  ADD PRIMARY KEY (`PatientID`,`Phone`);

--
-- Indexes for table `seenby`
--
ALTER TABLE `seenby`
  ADD PRIMARY KEY (`ApptID`,`EmpId`),
  ADD KEY `EmpID` (`EmpId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `ApptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5621;
--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `BillId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=623040;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DeptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12021;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198021;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`) ON DELETE CASCADE;

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`ApptID`) REFERENCES `appointment` (`ApptID`) ON DELETE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`DeptID`) REFERENCES `department` (`DeptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_phone`
--
ALTER TABLE `employee_phone`
  ADD CONSTRAINT `employee_phone_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `employee` (`EmpID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_phone`
--
ALTER TABLE `patient_phone`
  ADD CONSTRAINT `patient_phone_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seenby`
--
ALTER TABLE `seenby`
  ADD CONSTRAINT `seenby_ibfk_1` FOREIGN KEY (`EmpId`) REFERENCES `employee` (`EmpID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seenby_ibfk_2` FOREIGN KEY (`ApptID`) REFERENCES `appointment` (`ApptID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

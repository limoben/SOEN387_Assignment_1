-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2022 at 11:48 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `ID` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `phoneNumber` text NOT NULL,
  `DOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`ID`, `firstName`, `lastName`, `address`, `email`, `phoneNumber`, `DOB`) VALUES
(1, 'qqq', 'www', 'asadad', 'qqww@123.com', '123521542', '2012-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `ID` varchar(25) NOT NULL,
  `title` text NOT NULL,
  `semester` text NOT NULL,
  `days` text NOT NULL,
  `time` text NOT NULL,
  `instructor` text NOT NULL,
  `room` text NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `adminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`ID`, `title`, `semester`, `days`, `time`, `instructor`, `room`, `startDate`, `endDate`, `adminID`) VALUES
('1', 'science', 'Fall', '90', '10:20', 'aacc', 'h615', '2022-09-01', '2022-12-29', 1),
('2', 'math', 'Winter', '90', '9:10', 'ccbbb', 's321', '2022-09-01', '2022-12-31', 1),
('3', 'english', 'Fall', '90', '12:50', 'aacc', 'f444', '2022-09-01', '2022-12-29', 1),
('4', 'java', 'Winter', '90', '16:50', 'ttt', 'h343', '2022-09-01', '2022-12-31', 1),
('5', 'c++', 'Fall', '60', '9:00', 'eee', 'h555', '2022-09-06', '2022-12-14', 1),
('6', 'c#', 'Fall', '30', '8:00', 'qqq', 'h333', '2022-09-01', '2022-11-08', 1),
('7', 'python', 'Fall', '40', '10:10', 'ggg', 'h123', '2022-09-02', '2022-11-09', 1),
('8', 'php', 'Fall', '50', '13:00', 'hhh', 'h345', '2022-09-06', '2022-12-07', 1),
('9', 'Database', 'Winter', '90', '11:30', 'ppp', 'h775', '2022-09-01', '2022-12-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `courseID` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `address` text NOT NULL,
  `email` text NOT NULL,
  `phoneNumber` text NOT NULL,
  `DOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `firstName`, `lastName`, `address`, `email`, `phoneNumber`, `DOB`) VALUES
(111, 'aaa', 'bb', 'aaabb', 'aaa@gmail.com', '5147895478', '2022-10-07'),
(222, 'bbb', 'cc', 'bbbcc', 'bbb@cc.com', '52415241254', '2002-05-04'),
(333, 'ddd', 'rrr', '333 drdr', 'ddrr@mail.com', '4389654215', '1997-10-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `administrator` (`ID`);

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`ID`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `course` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 09, 2024 at 09:01 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `audiomaterial`
--

DROP TABLE IF EXISTS `audiomaterial`;
CREATE TABLE IF NOT EXISTS `audiomaterial` (
  `AudioMaterialID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Format` varchar(50) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `FilePath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`AudioMaterialID`),
  KEY `CourseID` (`CourseID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audiomaterial`
--

INSERT INTO `audiomaterial` (`AudioMaterialID`, `Title`, `Format`, `CourseID`, `FilePath`) VALUES
(1, 'HW-1_Solution.pdf', 'pdf', 1, 'uploads/HW-1_Solution.pdf'),
(2, 'FCDO and DFAT comments_Results Framework_tree_LT_sept2020 -Aus-UK comments_jk.docx', 'docx', 1, 'uploads/FCDO and DFAT comments_Results Framework_tree_LT_sept2020 -Aus-UK comments_jk.docx'),
(3, '0001.mp3', 'mp3', 1, 'audio_files/0001.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `CourseID` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_description` text,
  `DepartmentID` int(11) DEFAULT NULL,
  `LecturerID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CourseID`),
  KEY `DepartmentID` (`DepartmentID`),
  KEY `LecturerID` (`LecturerID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `course_name`, `course_description`, `DepartmentID`, `LecturerID`) VALUES
(1, 'Calculus', 'Math', 2, 9),
(4, 'Leadership 1', 'Reading', 6, 8),
(8, 'Written and Oral Communication', 'Advanced Coding and Reading', 6, 0),
(11, 'Programming', 'Advanced Coding and Reading', 6, 13);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `DepartmentID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`DepartmentID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
CREATE TABLE IF NOT EXISTS `lecturer` (
  `LecturerID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`LecturerID`),
  KEY `DepartmentID` (`DepartmentID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentcourses`
--

DROP TABLE IF EXISTS `studentcourses`;
CREATE TABLE IF NOT EXISTS `studentcourses` (
  `StudentCoursesID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  PRIMARY KEY (`StudentCoursesID`),
  KEY `StudentID` (`StudentID`),
  KEY `CourseID` (`CourseID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `StudentID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  PRIMARY KEY (`StudentID`),
  KEY `DepartmentID` (`DepartmentID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `virtualkeyboardtracker`
--

DROP TABLE IF EXISTS `virtualkeyboardtracker`;
CREATE TABLE IF NOT EXISTS `virtualkeyboardtracker` (
  `TrackerID` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  PRIMARY KEY (`TrackerID`),
  KEY `StudentID` (`StudentID`),
  KEY `CourseID` (`CourseID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

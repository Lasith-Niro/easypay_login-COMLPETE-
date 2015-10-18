-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2015 at 12:28 ප.ව.
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `easypay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
  (1, 'Standard user', ''),
  (2, 'Administrator', '{"admin": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `New_Academic_Year`
--

CREATE TABLE IF NOT EXISTS `New_Academic_Year` (
  `transactionID` int(10) NOT NULL,
  `acaYear` int(4) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Use register for new academic year';

--
-- Dumping data for table `New_Academic_Year`
--

INSERT INTO `New_Academic_Year` (`transactionID`, `acaYear`, `status`) VALUES
  (8, 2015, 0),
  (8, 2015, 0),
  (9, 2015, 0),
  (9, 2015, 0),
  (0, 2015, 0),
  (12, 2015, 0),
  (18, 2015, 0),
  (22, 2015, 0),
  (27, 2015, 0),
  (29, 2015, 0),
  (0, 2015, 0),
  (31, 2015, 0),
  (32, 2015, 0),
  (33, 2015, 0),
  (34, 2015, 0),
  (35, 2015, 0),
  (36, 2015, 0),
  (37, 2015, 0),
  (38, 2015, 0),
  (39, 2015, 0),
  (0, 2015, 0),
  (41, 2015, 0),
  (52, 2015, 0),
  (53, 2015, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `nID` int(5) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL,
  `detail` longtext NOT NULL,
  `datetime` varchar(25) NOT NULL,
  PRIMARY KEY (`nID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='table for notifications' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`nID`, `topic`, `detail`, `datetime`) VALUES
  (1, 'new', 'new', '18/10/15 11:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `Repeat_Exam`
--

CREATE TABLE IF NOT EXISTS `Repeat_Exam` (
  `transactionID` int(10) NOT NULL,
  `Year` int(4) NOT NULL,
  `Semester` varchar(5) NOT NULL,
  `subjectCode` varchar(7) NOT NULL,
  `indexNumber` int(8) NOT NULL,
  `nameWithInitials` varchar(50) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `fixedPhone` varchar(10) NOT NULL,
  `subjectName` varchar(20) NOT NULL,
  `AssignmentComplete` varchar(3) NOT NULL,
  `gradeFirst` varchar(2) NOT NULL,
  `gradeSecond` varchar(2) NOT NULL,
  `gradeThird` varchar(2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='For repeat exam fees';

--
-- Dumping data for table `Repeat_Exam`
--

INSERT INTO `Repeat_Exam` (`transactionID`, `Year`, `Semester`, `subjectCode`, `indexNumber`, `nameWithInitials`, `fullName`, `fixedPhone`, `subjectName`, `AssignmentComplete`, `gradeFirst`, `gradeSecond`, `gradeThird`, `status`) VALUES
  (23, 1, '', '', 0, '', '', '', '', '', '', '', '', 0),
  (24, 1, '', '', 0, '', '', '', '', '', '', '', '', 0),
  (25, 1, '', '', 0, '', '', '', '', '', '', '', '', 0),
  (26, 2, 'SYS2', 'SCS1001', 13000829, 'K.H.M.L. Niroshan', 'Kottawa Hewa Manage Lasith Niroshan', '0712837662', 'FCS', 'yes', 'C', '', '', 0),
  (28, 2, 'FYS2', 'SCS2102', 13000829, 'K.H.M.L. Niroshan', 'Kottawa Hewa Manage Lasith Niroshan', '0712837662', 'SEII', 'yes', 'C', '-', '-', 0),
  (57, 1, 'FYS2', 'SCS2102', 13000829, 'K.H.M.L. Niroshan', 'Kottawa Hewa Manage Lasith Niroshan', '0712837662', 'SEII', 'no', 'C', '-', '-', 0),
  (57, 1, 'FYS2', 'SCS2103', 13000829, 'K.H.M.L. Niroshan', 'Kottawa Hewa Manage Lasith Niroshan', '0712837662', 'FCS', 'yes', 'D+', '-', '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `regNumber` varchar(9) NOT NULL,
  `year` int(1) NOT NULL,
  `subjectCode` varchar(7) NOT NULL,
  `semester` int(1) NOT NULL,
  `result` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is for integrate exam results with easypaysl.com ';

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` int(10) NOT NULL AUTO_INCREMENT,
  `payeeID` int(5) NOT NULL,
  `payerID` int(5) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `statusCode` int(2) NOT NULL,
  `walletRefID` int(20) NOT NULL,
  `statusDescription` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `payeeID`, `payerID`, `date`, `time`, `statusCode`, `walletRefID`, `statusDescription`, `amount`) VALUES
  (1, 2, 2, '2015-09-03', '01:25:22', 2, 55555, 'dvmkdlkgjd;gnmd;fklsdjgdk;', 10),
  (2, 3, 3, '2015-09-20', '01:10:22', 2, 55555, 'dvmkdlzzzzzzzzzzzzzzsdjgdk;', 3500),
  (3, 1, 1, '2015-09-09', '01:25:22', 5, 2147483647, 'Good', 20);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_TEMP`
--

CREATE TABLE IF NOT EXISTS `transaction_TEMP` (
  `traID` int(20) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`traID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `transaction_TEMP`
--

INSERT INTO `transaction_TEMP` (`traID`, `userID`) VALUES
  (1, 2),
  (2, 2),
  (3, 2),
  (4, 2),
  (5, 2),
  (6, 2),
  (7, 2),
  (8, 2),
  (9, 2),
  (10, 2),
  (11, 1),
  (12, 1),
  (13, 1),
  (14, 1),
  (15, 1),
  (16, 1),
  (17, 1),
  (18, 1),
  (19, 1),
  (20, 1),
  (21, 1),
  (22, 1),
  (23, 1),
  (24, 1),
  (25, 1),
  (26, 3),
  (27, 3),
  (28, 3),
  (29, 3),
  (30, 3),
  (31, 3),
  (32, 3),
  (33, 3),
  (34, 3),
  (35, 3),
  (36, 3),
  (37, 3),
  (38, 3),
  (39, 3),
  (40, 3),
  (41, 3),
  (42, 3),
  (43, 3),
  (44, 3),
  (45, 3),
  (46, 3),
  (47, 3),
  (48, 3),
  (49, 3),
  (50, 3),
  (51, 3),
  (52, 3),
  (53, 3),
  (54, 3),
  (55, 3),
  (56, 3),
  (57, 3);

-- --------------------------------------------------------

--
-- Table structure for table `UCSC_Registration`
--

CREATE TABLE IF NOT EXISTS `UCSC_Registration` (
  `transactionID` int(10) NOT NULL,
  `regYear` int(4) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='For first year registration';

--
-- Dumping data for table `UCSC_Registration`
--

INSERT INTO `UCSC_Registration` (`transactionID`, `regYear`, `status`) VALUES
  (8, 2016, 0),
  (13, 2016, 0),
  (14, 2016, 0),
  (15, 2016, 0),
  (16, 2016, 0),
  (17, 2016, 0),
  (19, 2016, 0),
  (0, 2016, 0),
  (21, 2016, 0),
  (0, 2016, 0),
  (51, 2016, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `regNumber` varchar(9) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `nic` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `year` int(2) NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regNumber` (`regNumber`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `regNumber`, `fname`, `lname`, `email`, `phone`, `nic`, `dob`, `year`, `group`) VALUES
  (1, 'lasith', '98f7494c30aaa7c55d7c8cad6d04cb0c08c93295310d6931c33a89dda28a47a3', '', 'lasith', 'niroshan', 'lasith2013.l2n@gmail', '0712837662', '923342699V', '1992-11-29', 1, 2),
  (2, 'shanika', '98f7494c30aaa7c55d7c8cad6d04cb0c08c93295310d6931c33a89dda28a47a3', '2013is012', 'shanika', 'surangi', 'sse@gmail.com', '0722235502', '923565488V', '1992-06-29', 2, 2),
  (3, 'nadeesh', '8412850906603b50d968536a6c0b1da6c1f52ae947e917e62de4f4662a62dce9', '2013cs088', 'nadeesh', 'dilanga', 'nadeesh092@gmail.com', '0770294331', '922970988v', '1992-10-14', 1, 1),
  (4, 'student1', '509e87a6c45ee0a3c657bf946dd6dc43d7e5502143be195280f279002e70f7d9', '2013cs085', 'student', 'student', 'student1@gmail.com', '0712837662', '9233426992', '1992-06-29', 2, 1),
  (9, 'student2', 'eb4b3111401df980f14f28ad6804ae096df1e1c6963c51eab4140be226f8c94c', '2013cs086', 'student2', 'student2', 'student2@gmail.com', '0712837662', '9233426992', '1992-10-14', 1, 1),
  (10, 'anjana', '8182e42c77b763a311306c7de924279ad89ddff152f003898c6ce100699f2610', '2013cs081', 'anjana', 'nisal', 'anjana@gmail.com', '0770336863', '9233426992', '1992-06-29', 2, 1),
  (11, 'lahiru', '0edf2f04a578ad4c1d44ccf0b5a1367b237b431d0fb2c309c11f642c6aa8feb2', '2013cs220', 'lahiru', 'rangitha', 'lahiru@gmail.com', '0770336863', '923342699V', '1992-06-29', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE IF NOT EXISTS `user_notification` (
  `nID` int(5) NOT NULL,
  `uID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
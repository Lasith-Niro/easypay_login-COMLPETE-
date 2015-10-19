-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2015 at 08:53 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easypay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard user', ''),
(2, 'Administrator', '{"admin": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `new_academic_year`
--

CREATE TABLE IF NOT EXISTS `new_academic_year` (
  `transactionID` int(10) NOT NULL,
  `acaYear` int(4) NOT NULL,
  `paymentStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Use register for new academic year';

--
-- Dumping data for table `new_academic_year`
--

INSERT INTO `new_academic_year` (`transactionID`, `acaYear`, `paymentStatus`) VALUES
(8, 2015, 0),
(8, 2015, 0),
(9, 2015, 0),
(9, 2015, 0),
(0, 2015, 0),
(12, 2015, 0),
(17, 2015, 0),
(18, 2015, 0),
(19, 2015, 0),
(23, 2015, 0),
(24, 2015, 0),
(26, 2015, 0),
(27, 2015, 0),
(34, 2015, 0),
(38, 2015, 0),
(39, 2015, 0),
(0, 2015, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `nID` int(5) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `detail` longtext NOT NULL,
  `datetime` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='table for notifications';

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`nID`, `topic`, `detail`, `datetime`) VALUES
(1, 'new', 'new', '18/10/15 11:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `repeat_exam`
--

CREATE TABLE IF NOT EXISTS `repeat_exam` (
  `transactionID` int(10) NOT NULL,
  `Year` int(4) NOT NULL,
  `Semester` varchar(5) NOT NULL,
  `subjectCode` varchar(7) NOT NULL,
  `indexNumber` varchar(9) NOT NULL,
  `nameWithInitials` varchar(50) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `fixedPhone` varchar(10) NOT NULL,
  `subjectName` varchar(20) NOT NULL,
  `AssignmentComplete` varchar(3) NOT NULL,
  `gradeFirst` varchar(2) NOT NULL,
  `gradeSecond` varchar(2) NOT NULL,
  `gradeThird` varchar(2) NOT NULL,
  `paymentStatus` int(1) NOT NULL,
  `adminStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='For repeat exam fees';

--
-- Dumping data for table `repeat_exam`
--

INSERT INTO `repeat_exam` (`transactionID`, `Year`, `Semester`, `subjectCode`, `indexNumber`, `nameWithInitials`, `fullName`, `fixedPhone`, `subjectName`, `AssignmentComplete`, `gradeFirst`, `gradeSecond`, `gradeThird`, `paymentStatus`, `adminStatus`) VALUES
(32, 4, 'FYS2', '1111', '2013cs088', 'NPLR Pathirana', 'lahiru rangitha', '0332293329', 'aaaa', 'yes', '10', '20', '30', 0, 0),
(32, 4, 'FYS2', '2222', '2013cs088', 'NPLR Pathirana', 'lahiru rangitha', '0332293329', 'bbbb', 'no', '40', '50', '60', 0, 0),
(32, 4, 'FYS2', '3333', '2013cs088', 'NPLR Pathirana', 'lahiru rangitha', '0332293329', 'cccc', 'yes', '70', '80', '90', 0, 0),
(33, 4, 'FYS2', '1111', '2013cs088', 'NPLR Pathirana', 'lahiru rangitha', '0332293329', 'aaaa', 'yes', '10', '20', '30', 0, 0),
(33, 4, 'FYS2', '2222', '2013cs088', 'NPLR Pathirana', 'lahiru rangitha', '0332293329', 'bbbb', 'yes', '40', '50', '60', 0, 0),
(33, 4, 'FYS2', '3333', '2013cs088', 'NPLR Pathirana', 'lahiru rangitha', '0332293329', 'cccc', 'no', '70', '80', '90', 0, 0),
(36, 2, 'FYS2', '6542e', '2013cs088', 'NPLR pathirana', 'abcd', '0332293329', 'ufuygi', 'yes', '43', '23', '46', 0, 0),
(36, 4, 'FYS2', '111111', '2013cs088', 'NPLR Pathirana', 'dhfhshfs', '0332293329', 'qqqqqqqq', 'yes', '13', '13', '31', 0, 0),
(37, 2, 'FYS2', '6542e', '2013cs088', 'NPLR pathirana', 'abcd', '0332293329', 'ufuygi', 'yes', '43', '23', '46', 0, 0),
(41, 4, 'FYS2', '6542e', '2013cs088', 'NPLR pathirana', 'abcd', '0332293329', 'bbbbbbbbbbbb', 'yes', '43', '23', '11', 0, 0),
(41, 4, 'FYS2', '6542e', '2013cs088', 'NPLR pathirana', 'abcd', '0332293329', 'qwerty', 'yes', '43', '23', '12', 0, 0),
(41, 4, 'FYS2', '11111', '2013cs088', 'NPLR pathirana', 'abcd', '0332293329', 'qaz', 'yes', '43', '23', '10', 0, 0),
(41, 4, 'FYS2', '222222', '22222222', 'NPLR pathirana', 'abcd', '0332293329', 'ufuygi', 'yes', '43', '56', '46', 0, 0),
(41, 4, 'FYS2', '222222', '2013cs088', 'NPLR pathirana', 'asfsdf', '0332293329', 'bbbbbbbbbbbb', 'yes', '43', '56', '1', 0, 0),
(43, 4, 'FYS2', '11111', '111111111', 'NPLR pathirana', 'asfsdf', '0332293329', 'bbbbbbbbbbbb', 'yes', '56', '56', '87', 0, 0),
(44, 4, 'FYS2', '11111', '111111111', 'NPLR pathirana', 'asfsdf', '0332293329', 'bbbbbbbbbbbb', 'yes', '56', '56', '87', 0, 0),
(44, 4, 'FYS2', '11111', '111111111', 'NPLR pathirana', 'asfsdf', '0332293329', 'bbbbbbbbbbbb', 'yes', '56', '56', '87', 0, 0),
(44, 4, 'FYS2', '11111', '111111111', 'NPLR pathirana', 'asfsdf', '0332293329', 'bbbbbbbbbbbb', 'yes', '56', '56', '87', 0, 0);

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
  `transactionID` int(10) NOT NULL,
  `payeeID` int(5) NOT NULL,
  `payerID` int(5) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `paymentType` varchar(20) NOT NULL,
  `statusCode` int(2) NOT NULL,
  `walletRefID` int(20) NOT NULL,
  `statusDescription` varchar(200) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `payeeID`, `payerID`, `date`, `time`, `paymentType`, `statusCode`, `walletRefID`, `statusDescription`, `amount`) VALUES
(1, 2, 2, '2015-09-03', '01:25:22', 'Repeat Exam', 2, 55555, 'good', 10),
(2, 3, 3, '2015-09-20', '01:10:22', 'Repeat Exam', 2, 55555, 'good', 3500),
(3, 1, 1, '2015-09-09', '01:25:22', 'Repeat Exam', 2, 21474, 'good', 20),
(4, 0, 3, '2015-10-03', '06:22:00', 'Repeat Exam', 2, 32434, 'good', 20),
(5, 0, 3, '2015-10-07', '05:27:30', 'Repeat Exam', 2, 57567, 'good', 20),
(6, 10, 3, '2015-10-03', '06:22:00', 'Repeat Exam', 2, 32434, 'good', 20),
(7, 11, 3, '2015-10-07', '05:27:30', 'Repeat Exam', 2, 57567, 'good', 20);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_temp`
--

CREATE TABLE IF NOT EXISTS `transaction_temp` (
  `traID` int(20) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_temp`
--

INSERT INTO `transaction_temp` (`traID`, `userID`) VALUES
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
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 10),
(27, 10),
(28, 11),
(29, 11),
(30, 11),
(31, 11),
(32, 11),
(33, 11),
(34, 11),
(35, 11),
(36, 11),
(37, 2),
(38, 11),
(39, 11),
(40, 11),
(41, 11),
(42, 11),
(43, 11),
(44, 11);

-- --------------------------------------------------------

--
-- Table structure for table `ucsc_registration`
--

CREATE TABLE IF NOT EXISTS `ucsc_registration` (
  `transactionID` int(10) NOT NULL,
  `regYear` int(4) NOT NULL,
  `paymentStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='For first year registration';

--
-- Dumping data for table `ucsc_registration`
--

INSERT INTO `ucsc_registration` (`transactionID`, `regYear`, `paymentStatus`) VALUES
(8, 2016, 0),
(13, 2016, 0),
(14, 2016, 0),
(15, 2016, 0),
(0, 2016, 0),
(21, 2016, 0),
(22, 2016, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
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
  `group` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

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
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_session`
--

INSERT INTO `users_session` (`id`, `user_id`, `hash`) VALUES
(1, 1, '6039c184a8667a2dd2f19f7de111c9b001bf4a4874904283d1936e2f3e6714b6');

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE IF NOT EXISTS `user_notification` (
  `nID` int(5) NOT NULL,
  `uID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`nID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionID`);

--
-- Indexes for table `transaction_temp`
--
ALTER TABLE `transaction_temp`
  ADD PRIMARY KEY (`traID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regNumber` (`regNumber`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `nID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transaction_temp`
--
ALTER TABLE `transaction_temp`
  MODIFY `traID` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

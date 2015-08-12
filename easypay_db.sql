-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 12, 2015 at 09:24 පෙ.ව.
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
-- Table structure for table `paymenttype`
--

CREATE TABLE IF NOT EXISTS `paymenttype` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` int(10) NOT NULL AUTO_INCREMENT,
  `payee` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` text,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `year` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regNumber` (`regNumber`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `regNumber`, `fname`, `lname`, `email`, `phone`, `nic`, `dob`, `year`, `group`) VALUES
(4, 'lasith', '9244e03a1a7c9c5507df47a73805ea5b5adcf48c0812fe0e5b4683d43a36df7d', '2013cs082', 'lasith', 'niroshan', 'lasith2013.l2n@gmail.com', '0722837663', '923342699V', '1992-11-29', 2, 2),
(5, 'shanika', '98f7494c30aaa7c55d7c8cad6d04cb0c08c93295310d6931c33a89dda28a47a3', '2013is012', 'shanika', 'surangi', 'sse@gmail.com', '0712854545', '923565488V', '1992-06-29', 2, 1),
(7, 'nadeesh', '8412850906603b50d968536a6c0b1da6c1f52ae947e917e62de4f4662a62dce9', '2013cs088', 'nadeesh', 'dilanga', 'nadeesh092@gmail.com', '0770294331', '922970988v', '1992-10-14', 2, 1),
(8, 'test', 'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae', '2013cs220', 'test', 'test', 'lasith2013.l2n@gmail.com', '0712837555', '9233426992', '1992-06-29', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

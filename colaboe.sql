-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2017 at 07:40 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gi`
--
-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `colaboe`.`accounts` (
  `uid` int(11) NOT NULL,
  `accname` varchar(64) NOT NULL,
  `accno` varchar(11) NOT NULL,
  `acctype` varchar(11) NOT NULL,
  `bname` varchar(64) NOT NULL,
  `block` tinyint(1) NOT NULL,
  `refs` tinyint(4) NOT NULL,
  `cycles` int(3) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `colaboe`.`accounts` (`uid`, `accname`, `accno`, `acctype`, `bname`, `block`, `refs`, `cycles`, `admin`) VALUES
(999, 'Chibueze Harry', '6551433884', 'savings', 'Fidelity Bank', 0, 0, 1, 3),
(1000, 'John Elueme Doe', '2372678609', 'Savings', 'Skye Bank', 0, 0, 1, 2),
(1001, 'Paul Otokolo', '0903232323', 'Savings', 'Diamond Bank', 0, 0, 0, 0),
(1002, 'John Bosco', '4199146667', 'Savings', 'Union Bank', 0, 0, 0, 1),
(1003, 'Food And Drink', '9092032322', 'Savings', 'Diamond Bank', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blist`
--

CREATE TABLE `colaboe`.`blist` (
  `uid` int(11) NOT NULL,
  `uid2` int(11) NOT NULL,
  `reason` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eaf`
--

CREATE TABLE `colaboe`.`eaf` (
  `uid` int(11) NOT NULL,
  `shak` text NOT NULL,
  `eof` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gethelp`
--

CREATE TABLE `colaboe`.`gethelp` (
  `uid` int(11) NOT NULL,
  `plan` tinyint(3) NOT NULL,
  `times` tinyint(5) NOT NULL,
  `time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `colaboe`.`persons` (
  `uid` int(11) NOT NULL,
  `fname` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persons`
--

INSERT INTO `colaboe`.`persons` (`uid`, `fname`, `lname`, `email`, `pass`, `phone`, `gender`, `regdate`) VALUES
(999, 'Chibueze', 'Harry', 'buezeharry@gmail.com', 'c136fcd206e65be2d68ad1c73a162cd4', '08107758090', 'male', '2017-03-27 11:07:26'),
(1000, 'John', 'Doe', 'john@doe.com', 'c136fcd206e65be2d68ad1c73a162cd4', '08403904393', 'male', '2017-03-27 11:18:13'),
(1001, 'Paul', 'Otokolo', 'paul@gmail.com', 'c136fcd206e65be2d68ad1c73a162cd4', '90789790808', 'male', '2017-03-27 11:20:31'),
(1002, 'John', 'Bosco', 'johnbosco@yahooyahoo.com', '26439ca089e58ca16d46efe71e91b81b', '4199140000', 'male', '2017-03-27 12:49:51'),
(1003, 'yahoo', 'sand', 'sandy@yahoo.com', 'c136fcd206e65be2d68ad1c73a162cd4', '90789090808', 'male', '2017-03-28 02:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `prohelp`
--

CREATE TABLE `colaboe`.`prohelp` (
  `uid` int(11) NOT NULL,
  `plan` tinyint(3) NOT NULL,
  `uid2` int(11) NOT NULL,
  `picture` varchar(64) NOT NULL,
  `time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `colaboe`.`accounts`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `persons`
--
ALTER TABLE `colaboe`.`persons`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `colaboe`.`persons`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

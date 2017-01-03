-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2015 at 12:08 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `indiainfotip`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_topic`
--

CREATE TABLE IF NOT EXISTS `blog_topic` (
`id` int(255) NOT NULL,
  `topic_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_topic`
--

INSERT INTO `blog_topic` (`id`, `topic_name`) VALUES
(1, 'Android'),
(2, 'Php'),
(3, 'WordPress'),
(4, 'Blogger'),
(5, 'Android'),
(6, 'Php');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`id` int(255) NOT NULL,
  `city_name` varchar(254) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`) VALUES
(1, 'bikaner'),
(2, 'Jaipur'),
(3, 'Churu'),
(4, 'Nokha'),
(5, ''),
(6, 'Array'),
(7, 'Android'),
(8, 'Php'),
(9, 'Photoshop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_topic`
--
ALTER TABLE `blog_topic`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_topic`
--
ALTER TABLE `blog_topic`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

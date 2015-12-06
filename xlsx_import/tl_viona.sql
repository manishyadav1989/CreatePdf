-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2015 at 02:10 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tl_viona`
--

-- --------------------------------------------------------

--
-- Table structure for table `tl_viona_data`
--

CREATE TABLE IF NOT EXISTS `tl_viona_data` (
`id` int(11) NOT NULL,
  `module-no` varchar(55) NOT NULL,
  `module-title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `contents` text NOT NULL,
  `requirements` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `information` varchar(255) NOT NULL,
  `information-key` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `school-key` varchar(255) NOT NULL,
  `graduation` varchar(255) NOT NULL,
  `duration-in-hour` varchar(255) NOT NULL,
  `duration-details` varchar(255) NOT NULL,
  `timeframe` varchar(255) NOT NULL,
  `teachingform` varchar(255) NOT NULL,
  `classifications` text NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(55) NOT NULL,
  `date-time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tl_viona_user`
--

CREATE TABLE IF NOT EXISTS `tl_viona_user` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `upload_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tl_viona_data`
--
ALTER TABLE `tl_viona_data`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_viona_user`
--
ALTER TABLE `tl_viona_user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tl_viona_data`
--
ALTER TABLE `tl_viona_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tl_viona_user`
--
ALTER TABLE `tl_viona_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2017 at 03:27 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `DENR_db`
--
CREATE DATABASE `DENR_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `DENR_db`;

-- --------------------------------------------------------

--
-- Table structure for table `trasaction_tb`
--

CREATE TABLE IF NOT EXISTS `trasaction_tb` (
  `transaction_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `Client number` varchar(500) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `trasaction_type` varchar(500) DEFAULT NULL,
  `counter` varchar(500) DEFAULT NULL,
  `called_status` varchar(500) DEFAULT NULL,
  `issued_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `called_time` varchar(500) DEFAULT NULL,
  `field1` varchar(500) DEFAULT NULL,
  `field2` varchar(500) DEFAULT NULL,
  `field3` varchar(500) DEFAULT NULL,
  `field4` varchar(500) DEFAULT NULL,
  `field5` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trasaction_tb`
--


-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE IF NOT EXISTS `users_tb` (
  `user_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `group_id` varchar(500) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `field1` varchar(500) DEFAULT NULL,
  `field2` varchar(500) DEFAULT NULL,
  `field3` varchar(500) DEFAULT NULL,
  `field4` varchar(500) DEFAULT NULL,
  `field5` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`user_id`, `username`, `password`, `group_id`, `description`, `field1`, `field2`, `field3`, `field4`, `field5`) VALUES
(1, 'registrar', 'admin', '1', 'registrar', NULL, NULL, NULL, NULL, NULL),
(2, 'registrar', 'password', '2', 'registrar', NULL, NULL, NULL, NULL, NULL),
(3, 'cashier', 'password', '2', 'cashier', NULL, NULL, NULL, NULL, NULL);

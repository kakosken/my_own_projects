-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05.06.2016 klo 21:30
-- Palvelimen versio: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calendar`
--
CREATE DATABASE IF NOT EXISTS `calendar` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `calendar`;

-- --------------------------------------------------------

--
-- Rakenne taululle `schema_detail`
--

DROP TABLE IF EXISTS `schema_detail`;
CREATE TABLE IF NOT EXISTS `schema_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` text NOT NULL,
  `use_of` text NOT NULL,
  `created` datetime NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `ects` text NOT NULL,
  `lasnaolopakko` text NOT NULL,
  `type_of_coursematerial` text NOT NULL,
  `max_count_of_participant` text NOT NULL,
  `attention_begin` datetime NOT NULL,
  `attention_end` datetime NOT NULL,
  `schema_begin` datetime NOT NULL,
  `schema_end` datetime NOT NULL,
  `owner_id` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `schema_detail`
--

INSERT INTO `schema_detail` (`id`, `parent_id`, `use_of`, `created`, `code`, `name`, `ects`, `lasnaolopakko`, `type_of_coursematerial`, `max_count_of_participant`, `attention_begin`, `attention_end`, `schema_begin`, `schema_end`, `owner_id`) VALUES
(1, '', 'In_Use', '2016-03-09 00:00:00', '', 'Testi', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-03-09 12:00:00', '2016-03-09 15:00:00', ''),
(2, '', 'In_Use', '2016-03-16 23:23:17', '', 'Testi8', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-03-08 14:00:00', '2016-03-08 16:00:00', ''),
(3, '', 'In_Use', '2016-03-09 00:00:00', '', 'Testi3', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-03-11 20:00:00', '2016-03-11 22:00:00', ''),
(4, '', 'In_Use', '2016-05-12 15:23:10', '', 'hklooo', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-03-11 16:00:00', '2016-03-11 18:00:00', ''),
(5, '', 'In_Use', '2016-03-16 23:04:22', '', 'Testi5', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-03-11 08:00:00', '2016-03-11 10:00:00', ''),
(6, '', 'In_Use', '2016-06-05 18:04:00', '', 'sdfgh', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-03-09 00:00:00', '2016-03-09 02:00:00', ''),
(7, '', 'Free', '0000-00-00 00:00:00', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-03-09 00:00:00', '2016-03-09 02:00:00', ''),
(8, '', 'Free', '0000-00-00 00:00:00', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-03-11 00:00:00', '2016-03-11 02:00:00', ''),
(9, '', 'Free', '0000-00-00 00:00:00', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-03-11 16:00:00', '2016-03-11 18:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

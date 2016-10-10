-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Palvelin: localhost
-- Luontiaika: 01.02.2013 klo 22:03
-- Palvelimen versio: 5.5.10
-- PHP:n versio: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Tietokanta: `shipshop`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `accountid` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `lastname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `account`
--

INSERT INTO `account` (`accountid`, `email`, `password`, `name`, `lastname`) VALUES
(180924, 'kk@gmail.com', '1234', 'Kalle', 'Koskenniemi'),
(1579981261, 'matti@mei.com', '4321', 'Matti', 'Meikäläinen'),
(1427834740, 'mat@moi.com', '1111', 'Matti', 'Moilanen');

-- --------------------------------------------------------

--
-- Rakenne taululle `account_info`
--

CREATE TABLE IF NOT EXISTS `account_info` (
  `idprofile1` text NOT NULL,
  `use_of` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `date_of_birth` text NOT NULL,
  `genre` text NOT NULL,
  `mobile_phone` decimal(10,0) NOT NULL,
  `location` text NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `postnumber` decimal(10,0) NOT NULL,
  `postoffice` text NOT NULL,
  `market_aspect` text NOT NULL,
  `championship_aspect` text NOT NULL,
  `getting_started_done` decimal(10,0) NOT NULL,
  `language_in_usage` text NOT NULL,
  `currency_in_usage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `account_info`
--


-- --------------------------------------------------------

--
-- Rakenne taululle `basic_info`
--

CREATE TABLE IF NOT EXISTS `basic_info` (
  `idprofile1` text NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `basic_info`
--


-- --------------------------------------------------------

--
-- Rakenne taululle `connectors_on_product`
--

CREATE TABLE IF NOT EXISTS `connectors_on_product` (
  `idproduct1` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `connector_id` text NOT NULL,
  `count` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `connectors_on_product`
--

INSERT INTO `connectors_on_product` (`idproduct1`, `datetime`, `connector_id`, `count`) VALUES
('10000000000002', '2012-09-29 23:10:52', '10000000000001', 1),
('10000000000000', '2012-10-02 23:41:14', '10000000000002', 1),
('10000000000004', '2012-12-01 23:40:40', '10000000000003', 1),
('10000000000005', '2012-12-05 23:12:36', '10000000000004', 1),
('10000000000006', '2012-12-05 23:12:43', '10000000000005', 1),
('10000000000007', '2012-12-05 23:12:49', '10000000000005', 1),
('10000000000008', '2012-12-06 00:42:58', '10000000000005', 1),
('10000000000009', '2012-12-06 01:07:37', '10000000000005', 1),
('10000000000020', '2012-12-06 16:09:13', '10000000000005', 1),
('10000000000010', '2012-12-06 17:06:10', '10000000000005', 1),
('10000000000011', '2012-12-06 17:06:33', '10000000000005', 1),
('10000000000012', '2012-12-06 17:06:55', '10000000000005', 1),
('10000000000013', '2012-12-06 17:07:08', '10000000000005', 1),
('10000000000014', '2012-12-06 18:14:28', '10000000000004', 1),
('10000000000015', '2012-12-06 18:15:02', '10000000000005', 1),
('10000000000016', '2012-12-06 18:15:16', '10000000000005', 1),
('10000000000017', '2012-12-06 18:16:37', '10000000000005', 1),
('10000000000018', '2012-12-06 18:18:34', '10000000000005', 1),
('10000000000019', '2012-12-06 18:19:38', '10000000000005', 1),
('10000000000021', '2012-12-06 18:19:52', '10000000000005', 1),
('10000000000022', '2012-12-06 18:20:14', '10000000000005', 1),
('10000000000023', '2012-12-25 22:04:33', '10000000000005', 2),
('10000000000024', '2012-12-25 22:42:10', '10000000000005', 5),
('10000000000025', '2013-01-05 05:04:26', '10000000000004', 2);

-- --------------------------------------------------------

--
-- Rakenne taululle `connector_info`
--

CREATE TABLE IF NOT EXISTS `connector_info` (
  `connector_id` text NOT NULL,
  `created_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `use_of` text NOT NULL,
  `gender` text NOT NULL,
  `name` text NOT NULL,
  `model` text NOT NULL,
  `specification` text NOT NULL,
  `year` decimal(11,0) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `connector_info`
--

INSERT INTO `connector_info` (`connector_id`, `created_stamp`, `last_updated`, `use_of`, `gender`, `name`, `model`, `specification`, `year`, `photo`) VALUES
('10000000000000', '2012-09-29 23:07:36', '0000-00-00 00:00:00', 'In_Use', 'male', 'usb', '', '', 2010, ''),
('10000000000001', '2012-09-29 23:09:49', '0000-00-00 00:00:00', 'In_Use', 'female', 'usb', '', '', 2010, ''),
('10000000000002', '2012-10-02 23:41:14', '0000-00-00 00:00:00', 'In_Use', 'female', 'usb', '', '', 2000, ''),
('10000000000003', '2012-12-01 23:40:40', '0000-00-00 00:00:00', 'In_Use', 'male', 'usb', '', '', 0, ''),
('10000000000004', '2012-12-05 22:48:18', '0000-00-00 00:00:00', 'In_Use', 'female', 'lattia', '', '', 0, ''),
('10000000000005', '2012-12-05 22:48:46', '0000-00-00 00:00:00', 'In_Use', 'male', 'lattia', '', '', 0, '');

-- --------------------------------------------------------

--
-- Rakenne taululle `connector_status_lookup`
--

CREATE TABLE IF NOT EXISTS `connector_status_lookup` (
  `idproduct1` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `connector_id` text NOT NULL,
  `reverse_connector_id` text NOT NULL,
  `converse_product_id` text NOT NULL,
  `connector_condition` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `connector_status_lookup`
--

INSERT INTO `connector_status_lookup` (`idproduct1`, `datetime`, `connector_id`, `reverse_connector_id`, `converse_product_id`, `connector_condition`) VALUES
('10000000000001', '2012-09-29 23:07:36', '10000000000000', '', '', ''),
('10000000000002', '2012-09-29 23:10:44', '10000000000001', '', '', ''),
('10000000000000', '2012-10-02 23:41:14', '10000000000002', '', '', ''),
('10000000000004', '2012-12-01 23:40:40', '10000000000003', '', '', ''),
('10000000000005', '2012-12-05 22:47:47', '10000000000004', '', '', ''),
('10000000000006', '2012-12-05 22:56:01', '10000000000005', '', '', ''),
('10000000000007', '2012-12-05 23:07:58', '10000000000005', '', '', ''),
('10000000000008', '2012-12-06 00:42:58', '10000000000005', '', '', ''),
('10000000000009', '2012-12-06 01:07:37', '10000000000005', '', '', ''),
('10000000000020', '2012-12-06 16:09:13', '10000000000005', '', '', ''),
('10000000000010', '2012-12-06 17:06:10', '10000000000005', '', '', ''),
('10000000000011', '2012-12-06 17:06:33', '10000000000005', '', '', ''),
('10000000000012', '2012-12-06 17:06:55', '10000000000005', '', '', ''),
('10000000000013', '2012-12-06 17:07:08', '10000000000005', '', '', ''),
('10000000000014', '2012-12-06 18:14:28', '10000000000004', '', '', ''),
('10000000000015', '2012-12-06 18:15:02', '10000000000005', '', '', ''),
('10000000000016', '2012-12-06 18:15:16', '10000000000005', '', '', ''),
('10000000000017', '2012-12-06 18:16:37', '10000000000005', '', '', ''),
('10000000000018', '2012-12-06 18:18:34', '10000000000005', '', '', ''),
('10000000000019', '2012-12-06 18:19:38', '10000000000005', '', '', ''),
('10000000000021', '2012-12-06 18:19:52', '10000000000005', '', '', ''),
('10000000000022', '2012-12-06 18:20:14', '10000000000005', '', '', ''),
('10000000000023', '2013-01-04 16:40:22', '10000000000005', '', '', ''),
('10000000000024', '2013-01-04 16:20:24', '10000000000005', '', '', ''),
('10000000000025', '2013-01-05 05:04:26', '10000000000004', '', '', '');

-- --------------------------------------------------------

--
-- Rakenne taululle `language_translation`
--

CREATE TABLE IF NOT EXISTS `language_translation` (
  `the_original_word` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `the_desired_language` text NOT NULL,
  `the_desired_word` text NOT NULL,
  `confirmed_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `language_translation`
--


-- --------------------------------------------------------

--
-- Rakenne taululle `market_scouting`
--

CREATE TABLE IF NOT EXISTS `market_scouting` (
  `idproduct1` text NOT NULL,
  `publish_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `buyer_id` text NOT NULL,
  `suggest_datetime` decimal(10,0) NOT NULL,
  `accept_price` decimal(10,0) NOT NULL,
  `accept_datetime` datetime NOT NULL,
  `pay_amount` decimal(10,0) NOT NULL,
  `pay_datetime` datetime NOT NULL,
  `delivery_datetime` datetime NOT NULL,
  `feedback` decimal(10,0) NOT NULL,
  `feedback_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `market_scouting`
--

INSERT INTO `market_scouting` (`idproduct1`, `publish_time`, `buyer_id`, `suggest_datetime`, `accept_price`, `accept_datetime`, `pay_amount`, `pay_datetime`, `delivery_datetime`, `feedback`, `feedback_datetime`) VALUES
('10000000000007', '2013-01-12 23:26:12', 'YNUQ-nly4p', 1, 10, '2013-01-12 23:26:20', 10, '2013-01-12 23:27:19', '2013-01-12 23:26:44', 1, '2013-01-12 23:27:19'),
('10000000000006', '2013-01-27 11:47:09', 'YNUQ-nly4p', 1, 10, '2013-01-27 11:47:13', 10, '2013-01-27 11:49:46', '2013-01-27 11:49:29', 1, '2013-01-27 11:49:45'),
('10000000000020', '2013-01-27 13:26:21', 'YNUQ-nly4p', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Rakenne taululle `multimedia`
--

CREATE TABLE IF NOT EXISTS `multimedia` (
  `idproduct1` text NOT NULL,
  `created_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `use_of` text NOT NULL,
  `object` text NOT NULL,
  `object_id` text NOT NULL,
  `object_type` text NOT NULL,
  `object_size` int(11) NOT NULL,
  `object_quality` text NOT NULL,
  `description` text NOT NULL,
  `album_name` text NOT NULL,
  `default_picture` tinyint(1) NOT NULL,
  `geometry_location` geometry NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `multimedia`
--

INSERT INTO `multimedia` (`idproduct1`, `created_stamp`, `use_of`, `object`, `object_id`, `object_type`, `object_size`, `object_quality`, `description`, `album_name`, `default_picture`, `geometry_location`) VALUES
('10000000000002', '2012-09-02 17:32:13', 'In_Use', '10000000000000.png', '10000000000000', 'image/png', 159, '', '', 'Default Album', 1, ''),
('10000000000001', '2012-09-02 17:35:49', 'In_Use', '10000000000000.jpg', '10000000000000', 'image/jpeg', 59, '', '', 'Default Album', 1, ''),
('10000000000000', '2012-09-03 14:04:19', 'In_Use', '10000000000000.JPG', '10000000000000', 'image/jpeg', 141, '', '', 'Default Album', 1, ''),
('10000000000003', '2012-09-04 19:22:01', 'In_Use', '10000000000004.jpg', '10000000000004', 'image/jpeg', 61, '', '', 'Default Album', 1, ''),
('10000000000020', '2012-12-06 15:37:49', 'In_Use', '10000000000005.JPG', '10000000000005', 'image/jpeg', 665, '', '', 'Default Album', 1, ''),
('10000000000006', '2012-12-06 16:54:06', 'In_Use', '10000000000005.JPG', '10000000000005', 'image/jpeg', 676, '', '', 'Default Album', 1, ''),
('10000000000007', '2012-12-06 16:54:42', 'In_Use', '10000000000006.JPG', '10000000000006', 'image/jpeg', 630, '', '', 'Default Album', 1, ''),
('10000000000008', '2012-12-06 16:56:10', 'In_Use', '10000000000007.JPG', '10000000000007', 'image/jpeg', 671, '', '', 'Default Album', 1, ''),
('10000000000009', '2012-12-06 16:57:46', 'In_Use', '10000000000008.JPG', '10000000000008', 'image/jpeg', 717, '', '', 'Default Album', 1, ''),
('10000000000010', '2012-12-06 16:59:45', 'In_Use', '10000000000009.JPG', '10000000000009', 'image/jpeg', 674, '', '', 'Default Album', 1, ''),
('10000000000011', '2012-12-06 17:01:48', 'In_Use', '10000000000010.JPG', '10000000000010', 'image/jpeg', 636, '', '', 'Default Album', 1, ''),
('10000000000012', '2012-12-06 17:02:24', 'In_Use', '10000000000011.JPG', '10000000000011', 'image/jpeg', 551, '', '', 'Default Album', 1, ''),
('10000000000013', '2012-12-06 17:03:25', 'In_Use', '10000000000012.JPG', '10000000000012', 'image/jpeg', 641, '', '', 'Default Album', 1, ''),
('10000000000015', '2012-12-06 17:40:33', 'In_Use', '10000000000013.JPG', '10000000000013', 'image/jpeg', 683, '', '', 'Default Album', 1, ''),
('10000000000016', '2012-12-06 17:41:00', 'In_Use', '10000000000014.JPG', '10000000000014', 'image/jpeg', 703, '', '', 'Default Album', 1, ''),
('10000000000017', '2012-12-06 17:42:59', 'In_Use', '10000000000015.JPG', '10000000000015', 'image/jpeg', 678, '', '', 'Default Album', 1, ''),
('10000000000018', '2012-12-06 18:09:44', 'In_Use', '10000000000016.JPG', '10000000000016', 'image/jpeg', 708, '', '', 'Default Album', 1, ''),
('10000000000019', '2012-12-06 18:10:36', 'In_Use', '10000000000017.JPG', '10000000000017', 'image/jpeg', 595, '', '', 'Default Album', 1, ''),
('10000000000021', '2012-12-06 18:11:17', 'In_Use', '10000000000018.JPG', '10000000000018', 'image/jpeg', 647, '', '', 'Default Album', 1, ''),
('10000000000022', '2012-12-06 18:13:51', 'In_Use', '10000000000019.JPG', '10000000000019', 'image/jpeg', 697, '', '', 'Default Album', 1, '');

-- --------------------------------------------------------

--
-- Rakenne taululle `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `idproduct1` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_name` text NOT NULL,
  `data_value` text NOT NULL,
  `data_object` text NOT NULL,
  `data_priority` text NOT NULL,
  `data_security` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `product`
--


-- --------------------------------------------------------

--
-- Rakenne taululle `product_connectors`
--

CREATE TABLE IF NOT EXISTS `product_connectors` (
  `idconnector` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `designed` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `hot_pluggable` int(11) NOT NULL,
  `cable` int(11) NOT NULL,
  `pins` int(11) NOT NULL,
  `connector` int(11) NOT NULL,
  `signal` int(11) NOT NULL,
  `max_voltage` int(11) NOT NULL,
  `max_current` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `product_connectors`
--


-- --------------------------------------------------------

--
-- Rakenne taululle `product_info`
--

CREATE TABLE IF NOT EXISTS `product_info` (
  `idproduct1` text NOT NULL,
  `created_stamp` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `use_of` text NOT NULL,
  `type_of_object` text NOT NULL,
  `parent_product` text NOT NULL,
  `item` text NOT NULL,
  `manufacturer` text NOT NULL,
  `model` text NOT NULL,
  `specification` text NOT NULL,
  `vintage_year` decimal(10,0) NOT NULL,
  `made_in` text NOT NULL,
  `location` text NOT NULL,
  `building` text NOT NULL,
  `room` text NOT NULL,
  `length` decimal(10,0) NOT NULL,
  `width` decimal(10,0) NOT NULL,
  `height` decimal(10,0) NOT NULL,
  `depth` decimal(10,0) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `capacity` decimal(10,0) NOT NULL,
  `capacity_unit` text NOT NULL,
  `diameter` decimal(10,0) NOT NULL,
  `skid_load` decimal(10,0) NOT NULL,
  `color` decimal(10,0) NOT NULL,
  `material` text NOT NULL,
  `cellural` int(11) NOT NULL,
  `wireless_connection` int(11) NOT NULL,
  `in_the_box` int(11) NOT NULL,
  `environmental_status_report` int(11) NOT NULL,
  `integrated_display` int(11) NOT NULL,
  `integrated_audio` int(11) NOT NULL,
  `integrated_headphones` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `camera` int(11) NOT NULL,
  `photos` int(11) NOT NULL,
  `language_support` int(11) NOT NULL,
  `mail_attachment_support` int(11) NOT NULL,
  `connectors` int(11) NOT NULL,
  `input_output` int(11) NOT NULL,
  `external_buttons` int(11) NOT NULL,
  `external_controls` int(11) NOT NULL,
  `sensors` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `environmental_requirements` int(11) NOT NULL,
  `wheels` int(11) NOT NULL,
  `transmission` int(11) NOT NULL,
  `suspension` int(11) NOT NULL,
  `brake` int(11) NOT NULL,
  `serialnumber` int(11) NOT NULL,
  `motornumber` int(11) NOT NULL,
  `framenumber` int(11) NOT NULL,
  `default_picture` text NOT NULL,
  `age_restriction` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `product_info`
--

INSERT INTO `product_info` (`idproduct1`, `created_stamp`, `last_updated`, `use_of`, `type_of_object`, `parent_product`, `item`, `manufacturer`, `model`, `specification`, `vintage_year`, `made_in`, `location`, `building`, `room`, `length`, `width`, `height`, `depth`, `weight`, `capacity`, `capacity_unit`, `diameter`, `skid_load`, `color`, `material`, `cellural`, `wireless_connection`, `in_the_box`, `environmental_status_report`, `integrated_display`, `integrated_audio`, `integrated_headphones`, `video`, `camera`, `photos`, `language_support`, `mail_attachment_support`, `connectors`, `input_output`, `external_buttons`, `external_controls`, `sensors`, `power`, `environmental_requirements`, `wheels`, `transmission`, `suspension`, `brake`, `serialnumber`, `motornumber`, `framenumber`, `default_picture`, `age_restriction`) VALUES
('10000000000000', '2012-08-29 00:41:18', '2012-12-25 23:39:31', 'In_Use', 'Stuff', '10000000000001', 'ATX-kotelo', 'Antec', '', '', 0, '', '', '', '', 1500, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000000.10000000000000.JPG', 0),
('10000000000001', '2012-08-29 00:43:14', '2012-12-25 23:39:31', 'In_Use', 'Stuff', '', 'Mopo', 'Solifer', '', '', 0, '', '', '', '', 1000, 500, 1000, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000001.10000000000000.jpg', 0),
('10000000000002', '2012-08-29 00:44:00', '2012-12-25 23:39:31', 'In_Use', 'Stuff', '10000000000001', 'Matkapuhelin', 'Apple', 'iPhone', '3G', 0, '', '', '', '', 112, 114, 115, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000002.10000000000000.png', 0),
('10000000000003', '2012-09-04 19:22:00', '2012-12-25 23:39:31', 'In_Use', 'Stuff', '', 'auto', 'Nissan', 'Skyline', '', 0, '', '', '', '', 4, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000003.10000000000004.jpg', 0),
('10000000000004', '2012-12-01 23:38:01', '2012-12-25 23:39:31', 'In_Use', 'Stuff', '10000000000002', 'Cooler', 'Bionaire', 'AirCooler', 'Tower', 2011, 'USA', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('10000000000005', '2012-12-05 22:16:56', '2013-01-04 15:49:40', 'In_Use', 'Room', '', 'Student room', 'KOAS', 'Cell room', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('10000000000006', '2012-12-06 16:54:06', '2013-01-27 11:49:44', 'In_Use', 'Stuff', '', 'Chair', 'Toimistotuoli', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000006.10000000000005.JPG', 0),
('10000000000007', '2012-12-06 16:54:42', '2013-01-12 23:40:28', 'In_Use', 'Stuff', '', 'Chair', 'Vierastuoli', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000007.10000000000006.JPG', 0),
('10000000000008', '2012-12-06 16:56:10', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000005', 'Cooler', 'Bionaire', 'AirCooler', 'Tower', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000008.10000000000007.JPG', 0),
('10000000000009', '2012-12-06 16:57:46', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000005', 'Computer table', 'ATK-pöytä', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000009.10000000000008.JPG', 0),
('10000000000010', '2012-12-06 16:59:45', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000005', 'Bed', 'Dreamzone', 'Plus', 'B 10', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000010.10000000000009.JPG', 0),
('10000000000011', '2012-12-06 17:01:48', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000005', 'Table lamp', 'Aneta', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000011.10000000000010.JPG', 0),
('10000000000012', '2012-12-06 17:02:24', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000005', 'Wardrobe', 'Vaatekaappi', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000012.10000000000011.JPG', 0),
('10000000000013', '2012-12-06 17:03:25', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000005', 'Chair', 'Toimistotuoli', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000013.10000000000012.JPG', 0),
('10000000000014', '2012-12-06 17:39:10', '2013-01-04 15:53:41', 'In_Use', 'Room', '', 'Student room', 'KOAS Yleistilat', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('10000000000015', '2012-12-06 17:40:33', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000014', 'Electric kettle', 'OBH Nordica', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000015.10000000000013.JPG', 0),
('10000000000016', '2012-12-06 17:41:00', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000014', 'Table', 'Ruokapöytä', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000016.10000000000014.JPG', 0),
('10000000000017', '2012-12-06 17:42:59', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000014', 'Chair', 'Tuoli', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000017.10000000000015.JPG', 0),
('10000000000018', '2012-12-06 18:09:44', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000014', 'Coffeemaker', 'Coffeemaker', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000018.10000000000016.JPG', 0),
('10000000000019', '2012-12-06 18:10:36', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000014', 'Microwave', 'Elram', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000019.10000000000017.JPG', 0),
('10000000000020', '2012-12-06 15:37:49', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000005', 'Cooler', 'Pöytätuuletin', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000020.10000000000005.JPG', 0),
('10000000000021', '2012-12-06 18:11:17', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000014', 'Hand towel', 'Käsipyyhe', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000021.10000000000018.JPG', 0),
('10000000000022', '2012-12-06 18:13:51', '2012-12-25 23:40:52', 'In_Use', 'Stuff', '10000000000014', 'Drapes', 'Keittiöverhot', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '10000000000022.10000000000019.JPG', 0),
('10000000000023', '2013-01-04 16:16:53', '2013-01-04 16:16:53', 'In_Use', 'Stuff', '', 'Light bulb', 'Lamppu', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('10000000000024', '2013-01-04 16:20:24', '2013-01-04 16:20:24', 'In_Use', 'Stuff', '', 'Light bulb', 'Lamppu', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('10000000000025', '2013-01-05 05:04:26', '2013-01-05 05:04:26', 'In_Use', 'Room', '', '', 'Olohuone', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('10000000000026', '2012-12-23 12:26:13', '2012-12-25 23:40:52', 'Free', 'Stuff', '', '', '', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('10000000000027', '2012-12-23 12:26:51', '2012-12-25 23:40:52', 'Free', 'Stuff', '', '', '', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0),
('10000000000028', '2012-12-23 13:45:47', '2012-12-25 23:40:52', 'Free', 'Stuff', '', '', '', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Rakenne taululle `product_technical_specification`
--

CREATE TABLE IF NOT EXISTS `product_technical_specification` (
  `idproduct1` text NOT NULL,
  `last_update` datetime NOT NULL,
  `length` decimal(10,0) NOT NULL,
  `width` text NOT NULL,
  `weight` text NOT NULL,
  `measurement` text NOT NULL,
  `engine_power_and_battery` text NOT NULL,
  `color` text NOT NULL,
  `material` text NOT NULL,
  `cellural_and_wireless_connection` text NOT NULL,
  `in_the_box` text NOT NULL,
  `environment` text NOT NULL,
  `display` text NOT NULL,
  `audio` text NOT NULL,
  `headphones` text NOT NULL,
  `video` text NOT NULL,
  `camera_and_photos` text NOT NULL,
  `language_support` text NOT NULL,
  `mail_attachment_support` text NOT NULL,
  `connectors_and_input_output` text NOT NULL,
  `external_buttons_and_controls` text NOT NULL,
  `sensors` text NOT NULL,
  `wheel_transmission_suspension_brake` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `product_technical_specification`
--

INSERT INTO `product_technical_specification` (`idproduct1`, `last_update`, `length`, `width`, `weight`, `measurement`, `engine_power_and_battery`, `color`, `material`, `cellural_and_wireless_connection`, `in_the_box`, `environment`, `display`, `audio`, `headphones`, `video`, `camera_and_photos`, `language_support`, `mail_attachment_support`, `connectors_and_input_output`, `external_buttons_and_controls`, `sensors`, `wheel_transmission_suspension_brake`) VALUES
('10000000000006', '2012-08-25 22:11:30', 113, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('10000000000005', '2012-08-25 22:54:15', 114, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('10000000000007', '2012-08-25 22:56:16', 20, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('10000000000008', '2012-08-25 23:14:04', 2000, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Rakenne taululle `product_unifying_factor`
--

CREATE TABLE IF NOT EXISTS `product_unifying_factor` (
  `idproduct1` text NOT NULL,
  `created_stamp` datetime NOT NULL,
  `updated_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `use_of` text NOT NULL,
  `item` text NOT NULL,
  `manufacturer` text NOT NULL,
  `model` text NOT NULL,
  `specification` text NOT NULL,
  `vintage_year` text NOT NULL,
  `made_in` text NOT NULL,
  `material` text NOT NULL,
  `location` text NOT NULL,
  `building` text NOT NULL,
  `room` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `product_unifying_factor`
--

INSERT INTO `product_unifying_factor` (`idproduct1`, `created_stamp`, `updated_stamp`, `use_of`, `item`, `manufacturer`, `model`, `specification`, `vintage_year`, `made_in`, `material`, `location`, `building`, `room`) VALUES
('10000000000000', '2012-08-10 19:25:56', '2012-08-29 00:18:10', 'Reserved', 'Matkapuhelin', 'Apple', 'iPhone', '3G', '2009', 'USA', 'Muovi', 'Jyväskylä, Finland', 'Kämppä', 'Solu');

-- --------------------------------------------------------

--
-- Rakenne taululle `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `idprofile1` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_name` text NOT NULL,
  `data_value` text NOT NULL,
  `data_object` text NOT NULL,
  `data_priority` text NOT NULL,
  `data_security` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `profile`
--

INSERT INTO `profile` (`idprofile1`, `datetime`, `data_name`, `data_value`, `data_object`, `data_priority`, `data_security`) VALUES
('OjASaBsbp3', '2012-02-08 11:07:14', 'email', 'root@root.fi', '0', '0', '0'),
('OjASaBsbp3', '2012-02-08 11:07:14', 'password', '1234', '0', '0', '1'),
('OjASaBsbp3', '2012-02-08 11:07:14', 'firstname', 'Kalle', '0', '0', '0'),
('OjASaBsbp3', '2012-02-08 11:07:14', 'lastname', 'Koskenniemi', '0', '0', '0'),
('YNUQ-nly4p', '2012-02-25 14:31:24', 'email', 'ok@hotmail.com', '0', '0', '0'),
('YNUQ-nly4p', '2012-02-25 14:31:24', 'password', '4321', '0', '0', '1'),
('YNUQ-nly4p', '2012-02-25 14:31:24', 'firstname', 'Otto', '0', '0', '0'),
('YNUQ-nly4p', '2012-02-25 14:31:24', 'lastname', 'Kivinen', '0', '0', '0'),
('OjASaBsbp3', '2012-08-29 00:41:18', 'product', 'owner', '10000000000000', '', 'Only Me'),
('OjASaBsbp3', '2012-08-29 00:44:00', 'product', 'owner', '10000000000002', '', 'Only Me'),
('YNUQ-nly4p', '2012-09-04 19:22:00', 'product', 'owner', '10000000000003', '', 'Only Me'),
('OjASaBsbp3', '2012-11-09 00:00:13', 'product', 'owner', '10000000000001', '', 'Only Me'),
('OjASaBsbp3', '2012-12-01 23:38:01', 'product', 'owner', '10000000000004', '', 'Only Me'),
('OjASaBsbp3', '2012-12-05 22:16:56', 'product', 'owner', '10000000000005', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 15:37:49', 'product', 'owner', '10000000000020', '', 'Only Me'),
('OjASaBsbp3', '2013-01-27 11:49:44', 'product', 'ex-owner', '10000000000006', '', 'Only Me'),
('OjASaBsbp3', '2013-01-12 23:27:19', 'product', 'ex-owner', '10000000000007', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 16:56:10', 'product', 'owner', '10000000000008', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 16:57:46', 'product', 'owner', '10000000000009', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 16:59:45', 'product', 'owner', '10000000000010', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 17:01:48', 'product', 'owner', '10000000000011', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 17:02:24', 'product', 'owner', '10000000000012', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 17:03:25', 'product', 'owner', '10000000000013', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 17:39:10', 'product', 'owner', '10000000000014', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 17:40:33', 'product', 'owner', '10000000000015', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 17:41:00', 'product', 'owner', '10000000000016', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 17:42:59', 'product', 'owner', '10000000000017', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 18:09:44', 'product', 'owner', '10000000000018', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 18:10:36', 'product', 'owner', '10000000000019', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 18:11:17', 'product', 'owner', '10000000000021', '', 'Only Me'),
('OjASaBsbp3', '2012-12-06 18:13:51', 'product', 'owner', '10000000000022', '', 'Only Me'),
('YNUQ-nly4p', '2013-01-04 16:16:53', 'product', 'owner', '10000000000023', '', 'Only Me'),
('YNUQ-nly4p', '2013-01-04 16:20:24', 'product', 'owner', '10000000000024', '', 'Only Me'),
('YNUQ-nly4p', '2013-01-05 05:04:26', 'product', 'owner', '10000000000025', '', 'Only Me'),
('YNUQ-nly4p', '2013-01-12 23:27:19', 'product', 'owner', '10000000000007', '', 'Only Me'),
('YNUQ-nly4p', '2013-01-27 11:49:45', 'product', 'ex-owner', '10000000000006', '', 'Only Me'),
('YNUQ-nly4p', '2013-01-27 11:49:45', 'product', 'owner', '10000000000006', '', 'Only Me');

-- --------------------------------------------------------

--
-- Rakenne taululle `session_tracker`
--

CREATE TABLE IF NOT EXISTS `session_tracker` (
  `idprofile1` text NOT NULL,
  `session_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hash_code` text NOT NULL,
  `host_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `session_tracker`
--


-- --------------------------------------------------------

--
-- Rakenne taululle `stalker`
--

CREATE TABLE IF NOT EXISTS `stalker` (
  `idprofile1` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `referred_url` text NOT NULL,
  `current_object` text NOT NULL,
  `move_times` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `stalker`
--


-- --------------------------------------------------------

--
-- Rakenne taululle `tracking`
--

CREATE TABLE IF NOT EXISTS `tracking` (
  `visit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` text NOT NULL,
  `dns_address` text NOT NULL,
  `browser` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `tracking`
--

INSERT INTO `tracking` (`visit_time`, `ip_address`, `dns_address`, `browser`) VALUES
('2012-08-22 16:05:13', '91.152.212.53', 'a91-152-212-53.elisa-laajakaista.fi', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)'),
('2012-08-22 16:10:31', '37.136.122.28', '37-136-122-28.nat.bb.dnainternet.fi', 'Mozilla/5.0 (Linux; U; Android 4.0.3; fi-fi; GT-I9100 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'),
('2012-08-22 16:10:35', '69.171.247.1', '69.171.247.1', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)'),
('2012-08-22 16:13:28', '91.152.212.53', 'a91-152-212-53.elisa-laajakaista.fi', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800)'),
('2012-08-22 16:20:01', '91.152.212.53', 'a91-152-212-53.elisa-laajakaista.fi', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800)'),
('2012-08-22 16:20:10', '91.152.212.53', 'a91-152-212-53.elisa-laajakaista.fi', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800)'),
('2012-08-22 17:53:48', '88.192.71.208', 'dsl-hkibrasgw5-ff47c000-208.dhcp.inet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-08-22 17:55:17', '88.192.71.208', 'dsl-hkibrasgw5-ff47c000-208.dhcp.inet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-08-27 21:04:13', '130.234.5.138', 'proxy3.cc.jyu.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:14.0) Gecko/20100101 Firefox/14.0.1'),
('2012-08-27 22:26:19', '88.192.71.208', 'dsl-hkibrasgw5-ff47c000-208.dhcp.inet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-08-27 23:01:21', '87.95.23.84', '87-95-23-84.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-08-27 23:01:29', '87.95.23.84', '87-95-23-84.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-08-27 23:23:13', '87.95.23.84', '87-95-23-84.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-08-31 19:38:10', '87.93.47.65', '87-93-47-65.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-08-31 19:38:22', '87.93.47.65', '87-93-47-65.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-08-31 23:59:38', '88.192.71.208', 'dsl-hkibrasgw5-ff47c000-208.dhcp.inet.fi', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0)'),
('2012-08-31 23:59:42', '69.171.247.2', '69.171.247.2', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)'),
('2012-09-01 00:02:08', '88.192.71.208', 'dsl-hkibrasgw5-ff47c000-208.dhcp.inet.fi', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0)'),
('2012-09-02 00:19:00', '88.192.71.208', 'dsl-hkibrasgw5-ff47c000-208.dhcp.inet.fi', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0)'),
('2012-09-02 00:19:36', '88.192.71.208', 'dsl-hkibrasgw5-ff47c000-208.dhcp.inet.fi', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0)'),
('2012-09-03 15:21:49', '87.93.67.82', '87-93-67-82.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-09-03 15:21:59', '87.93.67.82', '87-93-67-82.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-09-03 15:23:49', '87.93.67.82', '87-93-67-82.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.83 Safari/537.1'),
('2012-09-03 21:32:48', '91.157.32.174', '91-157-32-174.elisa-laajakaista.fi', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:12.0) Gecko/20100101 Firefox/12.0'),
('2012-09-11 13:35:05', '130.234.161.153', 'paja3.it.jyu.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.89 Safari/537.1'),
('2012-09-11 13:44:43', '130.234.161.153', 'paja3.it.jyu.fi', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)'),
('2012-09-11 13:45:33', '130.234.161.153', 'paja3.it.jyu.fi', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)'),
('2012-09-11 14:06:10', '130.234.254.78', 'vrl.jyu.fi', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Win64; x64; Trident/6.0)'),
('2012-09-11 14:07:32', '212.226.65.35', '212-226-65-35-nat.elisa-mobile.fi', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:12.0) Gecko/20100101 Firefox/12.0'),
('2012-09-11 19:32:27', '88.194.9.58', 'easy-ff09c200-58.dhcp.inet.fi', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:12.0) Gecko/20100101 Firefox/12.0'),
('2012-09-11 19:33:40', '88.194.9.58', 'easy-ff09c200-58.dhcp.inet.fi', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:12.0) Gecko/20100101 Firefox/12.0'),
('2012-09-11 19:52:52', '88.194.9.58', 'easy-ff09c200-58.dhcp.inet.fi', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:12.0) Gecko/20100101 Firefox/12.0'),
('2012-09-11 23:21:04', '188.67.177.148', '188-67-177-148.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.89 Safari/537.1'),
('2012-09-11 23:21:09', '69.171.247.4', '69.171.247.4', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)'),
('2012-09-11 23:21:40', '188.67.177.148', '188-67-177-148.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.89 Safari/537.1'),
('2012-09-12 00:03:41', '188.67.177.148', '188-67-177-148.bb.dnainternet.fi', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.89 Safari/537.1'),
('2012-09-14 12:17:22', '130.234.170.8', 'agora-open-gw.net170.jyu.fi', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.79 Safari/537.1'),
('2012-09-14 12:35:49', '130.234.170.8', 'agora-open-gw.net170.jyu.fi', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.79 Safari/537.1'),
('2012-09-14 12:43:33', '130.234.170.8', 'agora-open-gw.net170.jyu.fi', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.1 (KHTML, like Gecko) Chrome/21.0.1180.79 Safari/537.1'),
('2012-09-14 16:30:48', '130.234.148.136', 'dyn-130-234-148-136.dynamic.jyu.fi', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:15.0) Gecko/20100101 Firefox/15.0.1'),
('2012-10-30 23:26:38', '130.234.170.8', 'agora-open-gw.net170.jyu.fi', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:15.0) Gecko/20100101 Firefox/15.0.1'),
('2012-10-30 23:27:04', '130.234.170.8', 'agora-open-gw.net170.jyu.fi', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:15.0) Gecko/20100101 Firefox/15.0.1'),
('2012-11-08 23:15:16', '88.194.9.58', 'easy-ff09c200-58.dhcp.inet.fi', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:16.0) Gecko/20100101 Firefox/16.0'),
('2012-11-08 23:15:17', '66.220.158.118', 'zt118.tfbnw.net', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)'),
('2012-11-08 23:48:55', '88.194.9.58', 'easy-ff09c200-58.dhcp.inet.fi', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:16.0) Gecko/20100101 Firefox/16.0'),
('2012-11-11 17:46:59', '88.192.71.208', 'dsl-hkibrasgw5-ff47c000-208.dhcp.inet.fi', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11');

-- --------------------------------------------------------

--
-- Rakenne taululle `trade_agreement`
--

CREATE TABLE IF NOT EXISTS `trade_agreement` (
  `idprofile1` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_name` text NOT NULL,
  `data_value` text NOT NULL,
  `data_object` text NOT NULL,
  `data_priority` text NOT NULL,
  `data_security` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `trade_agreement`
--

INSERT INTO `trade_agreement` (`idprofile1`, `datetime`, `data_name`, `data_value`, `data_object`, `data_priority`, `data_security`) VALUES
('OjASaBsbp3', '2012-12-21 11:40:21', 'proprietor_status_change', 'sell', '10000000000001', '', 'Public');

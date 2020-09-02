-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2020 at 03:17 PM
-- Server version: 5.6.47-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connect_seller_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(255) NOT NULL,
  `status` enum('ACTIVE','NOT ACTIVE') NOT NULL DEFAULT 'NOT ACTIVE',
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `time_added`) VALUES
(1, 'residential', 'ACTIVE', '2018-06-19 18:35:58'),
(2, 'shop', 'ACTIVE', '2018-06-19 18:35:58'),
(3, 'office', 'ACTIVE', '2018-06-19 18:36:12'),
(4, 'apartment', 'ACTIVE', '2018-06-19 18:36:12'),
(5, 'villa', 'ACTIVE', '2018-06-19 18:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(255) NOT NULL,
  `value` char(255) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`, `time_added`) VALUES
(1, 'currency', '&#8358;', '2018-06-20 23:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('OFF MARKET','ON MARKET') NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `category` enum('HOT DEAL','SALE','RENT','MORTGAGE') NOT NULL DEFAULT 'HOT DEAL',
  `type` enum('FULLY DETACHED','SEMI DETACHED','TERRACES','TOWN HOUSES','BUNGALOW','FLATS','LAND') NOT NULL DEFAULT 'FLATS',
  `name` char(255) NOT NULL,
  `description` text NOT NULL,
  `bedroom` int(11) NOT NULL,
  `bathroom` int(11) NOT NULL,
  `toilet` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `price` float UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `land_size_unit` enum('Sq Ft','hectares','acres','perches','Sq M') NOT NULL DEFAULT 'Sq M',
  `land_size` float UNSIGNED NOT NULL,
  `state` char(255) NOT NULL,
  `street_number` char(255) NOT NULL,
  `street_name` char(255) NOT NULL,
  `area` char(255) NOT NULL,
  `lga` char(255) NOT NULL,
  `latitude` char(255) NOT NULL,
  `longitude` char(255) NOT NULL,
  `private_note` text NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `status`, `user_id`, `category`, `type`, `name`, `description`, `bedroom`, `bathroom`, `toilet`, `price`, `address`, `land_size_unit`, `land_size`, `state`, `street_number`, `street_name`, `area`, `lga`, `latitude`, `longitude`, `private_note`, `time_added`) VALUES
(16, 'ON MARKET', 0, 'SALE', 'TERRACES', 'Newly built 4 bedroom terrace with BQ for sale in Ajah Lekki Lagos Nigeria', 'Nice 4 bedroom terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 39000000, 'Doren hospital axis ', 'Sq M', 2000, 'Lagos State', '4', 'Thomas estate', 'Ajah', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG', '2019-04-01 07:00:00'),
(17, 'ON MARKET', 0, 'SALE', 'TERRACES', 'Newly built 3 bedroom terrace with BQ for sale in Awoyaya - Lakowe Lekki Lagos Nigeria', 'Nice 3 bedroom Terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nIdeal for residential and commercial uses as property is facing the express \r\nCall us Today!', 3, 3, 0, 30000000, 'Lakowe ', 'Sq M', 2000, 'Lagos State', '1', 'Lakowe', 'Ajah', 'Eti Osa', '0', '0', 'ConnectsellerNG', '2019-04-01 07:00:00'),
(18, 'ON MARKET', 0, 'HOT DEAL', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Chevron toll gate axis Lelkki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 65000000, 'Chevron Toll Gate axis ', 'Sq M', 300, 'Lagos State', '3', 'Chevron Toll gate axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-02 07:00:00'),
(19, 'ON MARKET', 0, 'SALE', 'TERRACES', 'Newly built 4 bedroom terrace with BQ for sale in Chevron toll gate axis Lekki Lagos Nigeria.', 'Nice 4 bedroom terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 40000000, 'Chevron toll gate ', 'Sq M', 2000, 'Lagos State', '4', 'Orchid hotel Axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-02 07:00:00'),
(20, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Chevron toll gate axis Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 80000000, 'Chevron toll gate axis ', 'Sq M', 400, 'Lagos State', '5', 'Orchid hotel axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-02 07:00:00'),
(21, 'ON MARKET', 0, 'HOT DEAL', 'TERRACES', 'Newly built 4 bedroom terrace with BQ for sale in Ajah Lekki Lagos Nigeria', 'Nice 4 bedroom terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 50000000, 'Ajah ', 'Sq M', 2500, 'Lagos State', '5', 'Thomas estate', 'Ajah', 'Eti Osa', '0', '0', 'Contact C0nnectsellerNG', '2019-04-02 07:00:00'),
(22, 'ON MARKET', 0, 'SALE', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in  Chevron Toll Gate axis, Lekki Lagos Ngeria.', 'Nice 4 bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 58000000, 'Chevron toll gate axis ', 'Sq M', 290, 'Lagos State', '3', 'Contact ConnectsellerNG', 'Chevron', '0', '0', '0', 'Contact ConnectsellerNG', '2019-04-02 07:00:00'),
(23, 'ON MARKET', 0, 'HOT DEAL', 'FULLY DETACHED', 'Newly built 4 bedroom fully detached duplex with BQ for sale in Ajah Lekki Lagos Nigeria', 'Nice 4  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 4, 4, 0, 5, 'Ajah- Addo- Ecobank axis ', 'Sq M', 350, 'Lagos State', '4', 'Lekki Palm city', 'Ajah', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-03 07:00:00'),
(24, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in ajah Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 65000000, 'Ajah- Addo - Ecobank Axis ', 'Sq M', 400, 'Lagos State', '5', 'Lekki Palm city', 'Ajah', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-03 07:00:00'),
(25, 'ON MARKET', 0, 'HOT DEAL', 'BUNGALOW', 'Newly built 3 bedroom bungalow with BQ for sale in Ajah Lekki Lagos Nigeria', 'Nice 3  bedroom fully detached bungalow with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 3, 3, 0, 35000000, 'Thomas estate ', 'Sq M', 250, 'Lagos State', '8', 'Thomas Estate', 'Ajah', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-03 07:00:00'),
(26, 'ON MARKET', 0, 'SALE', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in Ajah Lekki Lagos Nigeria.', 'Nice 4 bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 50000000, 'Thomas estate ', 'Sq M', 280, 'Lagos State', '5', 'Thomas Estate', 'Ajah', 'Eti osa', '0', '0', 'Contact ConnectsellerNG', '2019-04-03 07:00:00'),
(27, 'ON MARKET', 0, 'HOT DEAL', 'BUNGALOW', 'Newly built 3 bedroom bungalow with BQ for sale in Ajah Lekki Lagos Nigeria', 'Nice 3 bedroom fully detached bungalow with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 3, 3, 0, 35000000, 'Thomas Estate ', 'Sq M', 300, 'Lagos State', '5', 'Thomas estate', 'Ajah', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-03 07:00:00'),
(28, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Ajah Lekki Lagos Nigeria \r\n', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 62000000, 'Thomas Estate ', 'Sq M', 450, 'Lagos State Ajah', '4', 'Thomas estate', 'Ajah', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-03 07:00:00'),
(29, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Ajah Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 68000000, 'Thomas estate Ajah ', 'Sq M', 460, 'Lagos State', '5', 'Thomas estate', 'Ajah', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-03 07:00:00'),
(30, 'ON MARKET', 0, 'HOT DEAL', 'FLATS', 'Newly built 3 bedroom Flats with BQ for sale in  Ajah Lekki Lagos Nigeria', 'Nice 3 bedroom flats available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 68000000, 'Thomas estate Ajah ', 'Sq M', 400, 'Lagos State', '3', 'Thomas estate', 'Ajah', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG \r\n\r\n', '2019-04-10 07:00:00'),
(31, 'ON MARKET', 0, 'SALE', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in Osapa london estate Lekki Lagos Nigeria', 'Nice 4  bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 60000000, 'Osapa london Estate, Lekki. ', 'Sq M', 280, 'Lagos State', '9', 'Osapa london estate', 'Osapa', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-03 07:00:00'),
(33, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Osapa London Estate Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 75000000, 'Osapa London estate Lekki ', 'Sq M', 500, 'Lagos State', '3', 'Osapa London', 'Lekki', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-03 07:00:00'),
(34, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Osapa London estate Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 250000000, 'Osapa London Estate ', 'Sq M', 500, 'Lagos State', '9', 'Osapa London', 'Lekki', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-03 07:00:00'),
(35, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Osapa London Estate Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 115000000, 'Osapa London estate Lekki ', 'Sq M', 500, 'Lagos State', '3', 'Osapa London', 'Lekki', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG', '2019-04-04 07:00:00'),
(36, 'ON MARKET', 0, 'HOT DEAL', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in Osapa London Lekki Lagos Nigeria', 'Nice 4  bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 65000000, 'Osapa Lekki ', 'Sq M', 290, 'Lagos State', '4', 'Osapa London estate', 'Lekki', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG', '2019-04-04 07:00:00'),
(37, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Osapa London Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 95000000, 'Osapa London Lekki ', 'Sq M', 450, 'Lagos State', '11', 'Osapa London', 'Lekki', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-04 07:00:00'),
(38, 'ON MARKET', 0, 'HOT DEAL', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in Osapa London Estate Lekki Lagos Nigeria \r\n', 'Nice 4  bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 4, 4, 0, 65000000, 'Osapa London Lekki', 'Sq M', 300, 'Lagos State', '7', 'Osapa London', 'Lekki', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG', '2019-04-04 07:00:00'),
(39, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Osapa London axis, Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 90000000, 'Osapa Lekki Lagos Nigeria ', 'Sq M', 500, 'Lagos State', '2', 'Osapa Lekki', 'Lekki', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-09 07:00:00'),
(40, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Idado estate Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 95000000, 'Isado estate Lekki Lagos Nigeria ', 'Sq M', 450, 'Lagos State', '8', 'Idado estate', 'Lekki', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-09 07:00:00'),
(41, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Idado estate Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 85000000, 'Idado estate Lekki Lagos Nigeria ', 'Sq M', 400, 'Lagos State', '1', 'Idado estate', 'Lekki', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG', '2019-04-09 07:00:00'),
(42, 'ON MARKET', 0, 'SALE', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in Chevy View estate Lekki Lagos Nigeria', 'Nice 4  bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 60000000, 'Chevy View estate Lekki Lagos Nigeria ', 'Sq M', 300, 'Lagos State', '4', 'Chevy View estate', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG', '2019-04-09 07:00:00'),
(43, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Chevy view estate Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 90000000, 'Chevy view estate Lekki Lagos Nigeria ', 'Sq M', 450, 'Lagos State', '9', 'Chevy view estate', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG', '2019-04-09 07:00:00'),
(44, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Chevy View estate Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 97000000, 'Chevy view estate Lekki Lagos Nigeria ', 'Sq M', 450, 'Lagos State', '3', 'Chevy view estate Lekki', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-10 07:00:00'),
(45, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in CHevy view estate Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 110000000, 'Chevy view estate Lekki Lagos Nigeria ', 'Sq M', 600, 'Lagos State', '7', 'Chevy view estate', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG', '2019-04-10 07:00:00'),
(46, 'ON MARKET', 0, 'SALE', 'TERRACES', 'Newly built 4 bedroom terrace with BQ for sale in Chevron Lekki Lagos Nigeria', 'Nice 4  bedroom terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 100000000, 'Chevron Lekki Lagos Nigeria ', 'Sq M', 250, 'Lagos State', '8', 'Chevron - UBA axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG', '2019-04-10 07:00:00'),
(47, 'ON MARKET', 0, 'HOT DEAL', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Chevron Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 80000000, 'Chevron Lekki Lagos Nigeria ', 'Sq M', 400, 'Lagos State', '7', 'Chevron - UBA axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-10 07:00:00'),
(48, 'ON MARKET', 0, 'HOT DEAL', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in  Chevron Lekki Lagos Nigeria', 'Nice 4  bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 55000000, 'Chevron Lekki Lagos Nigeria ', 'Sq M', 300, 'Lagos State', '10', 'Chevron - UBA axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectselerNG ', '2019-04-12 07:00:00'),
(49, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Ikota villa estate Lekki Lagos Nigeria', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 5, 5, 0, 78000000, 'Ikota villa estate Lekki Lagos Nigeria ', 'Sq M', 500, 'Lagos State', '8', 'ikota villa estatre', 'Ikota', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-12 07:00:00'),
(50, 'ON MARKET', 0, 'SALE', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in Oral estate Lekki Lagos Nigeria', 'Nice 4  bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 58000000, 'Oral estate Lekki Lagos Nigeria ', 'Sq M', 300, 'Lagos State', '7', 'chevron toll gate- Oral estate axis', 'Ikota', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-12 07:00:00'),
(51, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Chevron toll gate axis Lekki Lagos Nigeria \r\n', 'Nice 5  bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 90000000, 'Oral estate Lekki Lagos Nigeria ', 'Sq M', 450, 'Lagos State', '5', 'Chevron Toll Gate- Lekki county homes axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-16 07:00:00'),
(52, 'ON MARKET', 0, 'HOT DEAL', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in  chevron toll gate axis Lekki Lagos Nigeria', 'Nice 4  bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 4, 4, 0, 58000000, 'Chevron toll gate -  Lekki county homes axis Lekki Lagos Nigeria ', 'Sq M', 300, 'Lagos State', '13', 'Chevron Toll gate axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-04-16 07:00:00'),
(53, 'ON MARKET', 0, 'SALE', 'TERRACES', 'Newly built 4 bedroom terraces for sale in Chevron drive, Lekki Lagos Nigeria', 'Nice 4 bedroom terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 65000000, 'Chevron Drive ', 'Sq M', 180, 'Lagos State', '5', 'Chevron-', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-03 07:00:00'),
(54, 'ON MARKET', 0, 'SALE', 'TERRACES', 'Newly built 4 bedroom terrace duplex with BQ for sale in Chevron toll gate axis Lekki Lagos Nigeria', 'Nice 4 bedroom terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 4, 4, 0, 42000000, 'Chevron toll gate axis- Orchid road ', 'Sq M', 150, 'Lagos State', '12', 'Orchid hotel road axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-03 07:00:00'),
(55, 'ON MARKET', 0, 'HOT DEAL', 'TERRACES', 'Newly built 4 bedroom terrace duplex with BQ for sale in Chevron Drive Lekki Lagos Nigeria \r\n\r\n', 'Nice 4 bedroom terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 4, 4, 0, 47000000, 'Chevron Drive Lekki ', 'Sq M', 200, 'Lagos State', '15', 'Chevron Drive -UBA', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG  ', '2019-10-03 07:00:00'),
(56, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Chevron Lekki Lagos Nigeria.', 'Nice  5 bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 73000000, 'Chevron Drive  Lekki ', 'Sq M', 400, 'Lagos State', '17', 'Chevron Drive- UBA axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-03 07:00:00'),
(57, 'ON MARKET', 0, 'SALE', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in Chevron drive Lekki Lagos Nigeria', 'Nice 4 bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 4, 4, 0, 55000000, 'Chevron drive Lekki ', 'Sq M', 200, 'Lagos State', '15', 'Chevron Drive- UBA road axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-03 07:00:00'),
(58, 'ON MARKET', 0, 'SALE', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale In Chevron Lekki Lagos Nigeria', 'Nice 4 bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 4, 4, 0, 55000000, 'Chevron Drive Lekki ', 'Sq M', 300, 'Lagos State', '15', 'Chevron Drive - UBA road Axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-03 07:00:00'),
(59, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Lekki Lagos Nigeria', 'Nice 5 bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n\r\n', 5, 5, 0, 62000000, 'Lekki county homes ikota ', 'Sq M', 400, 'Lagos State', '22', 'Lekki County homes', 'Ikota', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-03 07:00:00'),
(60, 'ON MARKET', 0, 'HOT DEAL', 'SEMI DETACHED', 'Newly built 4 bedroom semi detached duplex with BQ for sale in Chevron toll gate axis Lekki Lagos Nigeria', 'Nice 4 bedroom semi detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n\r\n', 4, 4, 0, 55000000, 'Orchid hotel road axis Lekki ', 'Sq M', 200, 'Lagos State', '28', 'Orchid hotel road Axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-03 07:00:00'),
(61, 'ON MARKET', 0, 'SALE', 'SEMI DETACHED', 'Newly built 4 bedroom terraces with BQ for sale in Chevron toll gate axis, Lekki Lagos Nigeria', 'Nice 4 bedroom terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!', 4, 4, 0, 50000000, 'Chevron toll gate axis, Lekki Lagos Nigeria ', 'Sq M', 190, 'Lagos State', '3', 'Orchid hotel axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnetsellerNG ', '2019-10-04 07:00:00'),
(62, 'ON MARKET', 0, 'SALE', 'TERRACES', 'Newly built 4 bedroom terraces with BQ for sale in Chevron toll gate axis, Lekki Lagos Nigeria', 'Nice 4 bedroom terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 4, 4, 0, 50000000, 'Chevron Toll gate axis Lekki Lagos Nigeria ', 'Sq M', 200, 'Lagos State', '4', 'Orchid hotel Road axis', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-07 07:00:00'),
(63, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Lekki County homes Axis, Lekki Lagos Nigeria', 'Nice 5 bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 75000000, 'Lekki County homes estate Lekki Lagos Nigeria ', 'Sq M', 400, 'Lagos State', '4', 'Oral Estate', 'Ikota', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-07 07:00:00'),
(64, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly built 5 bedroom fully detached duplex with BQ for sale in Osapa London estate Lekki Lagos Nigeria', 'Nice 5 bedroom fully detached duplex with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 90000000, 'Osapa London estate Lekki Lagos Nigeria ', 'Sq M', 400, 'Lagos State', '19', 'Osapa london', 'Osapa', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-07 07:00:00'),
(65, 'ON MARKET', 0, 'SALE', 'FULLY DETACHED', 'Newly Built 5 bedroom fully detached duplex with BQ for sale in Chevron toll gate Lekki Lagos Nigeria', 'Nice 4 bedroom terrace with BQ  available for sale. \r\nfully fitted and finished with adequate facilities to suite buyers taste.\r\nAll necessary documents are available for title verification and due diligence. \r\nLocated in a gated and secured estate with security and good drainage. \r\nCall us Today!\r\n', 5, 5, 0, 65000000, 'Orchid hotel road, Lekki Lagos Nigeria ', 'Sq M', 350, 'Lagos State', '9', 'Orchid Hotel road', 'Chevron', 'Eti Osa', '0', '0', 'Contact ConnectsellerNG ', '2019-10-07 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `properties_images`
--

CREATE TABLE `properties_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) NOT NULL,
  `image` char(255) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('ACTIVE','NOT ACTIVE') NOT NULL DEFAULT 'NOT ACTIVE',
  `first_name` char(255) NOT NULL,
  `last_name` char(255) NOT NULL,
  `agent_name` char(255) NOT NULL,
  `mobile` char(20) NOT NULL,
  `email` char(255) NOT NULL,
  `office` char(20) NOT NULL,
  `address` tinytext NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `status`, `first_name`, `last_name`, `agent_name`, `mobile`, `email`, `office`, `address`, `time_added`) VALUES
(1, 'ACTIVE', 'connectsellerNG', 'connectsellerNG', 'connectsellerNG', '+2348100403491', 'info@connectsellerng.com', '+2349304340359', 'connectsellerng', '2018-07-03 17:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL,
  `status` enum('ACTIVE','NOT ACTIVE') NOT NULL DEFAULT 'NOT ACTIVE',
  `name` char(255) NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `duration` enum('yearly','monthly','full payment') NOT NULL DEFAULT 'monthly',
  `tag` enum('for rent','for sale') NOT NULL DEFAULT 'for rent',
  `bedroom` tinyint(3) UNSIGNED NOT NULL,
  `bathroom` tinyint(3) UNSIGNED NOT NULL,
  `picture` char(255) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `order`, `status`, `name`, `price`, `duration`, `tag`, `bedroom`, `bathroom`, `picture`, `time_added`) VALUES
(7, 1, 'ACTIVE', 'Newly built 5 bedroom detached duplex with BQ for sale in oral estate Lekki Lagos Nigeria', 80000000, 'full payment', 'for sale', 5, 5, '4272a2bb2820299ec0c23b214fec1811.jpeg', '2019-04-01 07:00:00'),
(8, 2, 'ACTIVE', 'Newly built 5 bedroom detached duplex with BQ for sale in idado estate Lekki Lagos Nigeria', 90000000, 'full payment', 'for sale', 5, 5, '42b50207fcea059d9642ca3c74ede781.jpeg', '2019-04-01 07:00:00'),
(9, 3, 'ACTIVE', 'Newly built 4 bedroom terraced duplex with BQ for sale in chevron toll gate axis, Lekki Lagos Nigeria.', 60000000, 'full payment', 'for sale', 4, 4, '7cfe3515751cb79e81c2f59c10daf268.jpeg', '2019-04-01 07:00:00'),
(10, 4, 'ACTIVE', 'Newly built 4 bedroom terraced triplex with BQ for sale in Thomas estate ajah Lekki Lagos Nigeria', 50000000, 'full payment', 'for sale', 4, 0, '190d831ce28b7bd5a3e53dbf97049a08.jpeg', '2019-04-01 07:00:00'),
(11, 5, 'ACTIVE', 'Newly built 5 bedroom detached duplex with BQ for sale in Thomas estate, Ajah Lekki Lagos Nigeria.', 68000000, 'full payment', 'for sale', 5, 5, '5d518dbe80bbf525abafc3b83f4194f6.jpeg', '2019-04-01 07:00:00'),
(12, 6, 'ACTIVE', 'Newly built 5 bedroom detached duplex with BQ for sale in ikota villa estate Lekki Lagos Nigeria', 85000000, 'full payment', 'for rent', 5, 5, '1f0073c6c244b80ed86d0d6b12614616.jpeg', '2019-04-01 07:00:00'),
(13, 7, 'ACTIVE', 'Newly built 2 bedroom flat with BQ for sale in osapa London estate lekki Lagos Nigeria', 40000000, 'full payment', 'for sale', 2, 2, '2819b7e50de3b8cc0bfb2e8ea80c381c.jpeg', '2019-04-01 07:00:00'),
(14, 8, 'ACTIVE', 'Newly built 5 bedroom detached duplex with BQ for sale in Osapa London estate Lekki Lagos Nigeria', 68000000, 'full payment', 'for sale', 5, 5, '7219231b220f2c43f37a5a626a8b4573.jpeg', '2019-04-01 07:00:00'),
(15, 9, 'ACTIVE', 'Newly built 4 bedroom terraced duplex with BQ for sale in chevron, Lekki Lagos Nigeria', 90000000, 'full payment', 'for sale', 4, 4, 'f95c392fb37f7da59533321ee7212b7b.jpeg', '2019-04-01 07:00:00'),
(16, 10, 'ACTIVE', 'Newly built 5 bedroom detached duplex with BQ for sale in osapa London estate Lekki Lagos Nigeria.', 110000000, 'full payment', 'for sale', 5, 5, 'c575310e06d011dc052487782c023278.jpeg', '2019-04-01 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `telephone` char(20) NOT NULL,
  `confirmed_email` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `confirmed_telephone` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `telephone`, `confirmed_email`, `confirmed_telephone`, `time_added`) VALUES
(1, 'greendublin007@gmail.com', '224cb87c9e346bcb3833370ded5600e9a341e0402d558825873e53c44dc45d029868827201bf73c6c4cfc3ccc1f72bd00da2aae22df800accd108ec8e2f583d8', '08095060650', 'YES', 'YES', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties_images`
--
ALTER TABLE `properties_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `image` (`image`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telephone` (`telephone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `properties_images`
--
ALTER TABLE `properties_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

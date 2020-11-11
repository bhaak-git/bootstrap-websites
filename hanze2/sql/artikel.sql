-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: fdb7.biz.nf
-- Generation Time: Nov 04, 2015 at 10:15 AM
-- Server version: 5.5.38
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `1983959_dhg`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `artikelnummer` varchar(4) NOT NULL,
  `productnaam` varchar(45) NOT NULL,
  `categorie` varchar(80) NOT NULL,
  `prijs` int(11) NOT NULL,
  `voorraad` int(11) NOT NULL,
  `omschrijving` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`artikelnummer`),
  KEY `Voorraad` (`voorraad`),
  KEY `Omschrijving` (`omschrijving`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`artikelnummer`, `productnaam`, `categorie`, `prijs`, `voorraad`, `omschrijving`) VALUES
('H003', 'DownhatGym Hoodie Men', 'Hoodies', 50, 0, ''),
('S003', 'DownhatGym T-shirt Men', 'Shirts&Tankops', 25, 0, ''),
('S013', 'DownhatGym Tanktop Men', 'Shirts&Tanktops', 15, 0, ''),
('P003', 'DownhatGym Track Pants Men', 'Pants', 25, 0, ''),
('P013', 'DownhatGym Shorts Men', 'Pants', 20, 0, ''),
('H005', 'DownhatGym Hoodie Women', 'Hoodies', 50, 0, ''),
('S005', 'DownhatGym T-shirt Women', 'Shirts&Tanktops', 25, 0, ''),
('S015', 'DownhatGym Tanktop Women', 'Shirts&Tanktops', 10, 0, ''),
('P005', 'DownhatGym Track Pants Women', 'Pants', 25, 0, ''),
('P015', 'DownhatGym Shorts Women', 'Pants', 20, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

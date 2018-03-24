-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 24 mars 2018 à 19:24
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `worknshare`
--

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id_booking` int(11) NOT NULL AUTO_INCREMENT,
  `date_begin_booking` datetime DEFAULT NULL,
  `date_finish_booking` datetime DEFAULT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_booking`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `booking_equipment`
--

DROP TABLE IF EXISTS `booking_equipment`;
CREATE TABLE IF NOT EXISTS `booking_equipment` (
  `id_booking_equipment` int(11) NOT NULL AUTO_INCREMENT,
  `date_rent` datetime DEFAULT NULL,
  `date_return` datetime DEFAULT NULL,
  `id_equipment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_booking_equipment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` int(11) NOT NULL,
  `name_customer` varchar(80) NOT NULL,
  `surname_customer` varchar(80) NOT NULL,
  `phone_number` char(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code_customer` char(10) NOT NULL,
  `id_subscription` int(11) DEFAULT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `blocked` tinyint(4) NOT NULL DEFAULT '0',
  `name_customer` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name_customer` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone_number_customer` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_customer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pseudo_customer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_customer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code_customer` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `inside` tinyint(4) NOT NULL,
  `begin_subscription` datetime DEFAULT NULL,
  `end_subscription` datetime DEFAULT NULL,
  `id_subscription` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id_customer`, `is_admin`, `blocked`, `name_customer`, `last_name_customer`, `phone_number_customer`, `email_customer`, `pseudo_customer`, `password_customer`, `code_customer`, `inside`, `begin_subscription`, `end_subscription`, `id_subscription`) VALUES
(1, 1, 0, 'Bonjour', 'Hello', '0606060707', 'bonjour@hello.com', 'BonHe', '$2y$10$rfoG3PuonAkm8hAdnvdiFemd8987YxVX05d/EMeTJcDtI4HYRkcAK', 'VmiaYDUBlR', 0, NULL, NULL, NULL),
(2, 0, 0, 'Test', 'Oro', '0606060601', 'test@oro.com', 'testoro', '$2y$10$xEhe4XgaQSrGjAaGLKDQI.G3RZCk56T2iT/MHF6skfAxB3/7BrE9K', 'IOasxDNDRK', 0, NULL, NULL, NULL),
(3, 0, 0, 'Testo', 'Outo', '0606060602', 'test@outo.com', 'testoouto', '$2y$10$vevFzo5JcAsNShxg1RUSCeuaXb084KMzD4YMjMxLeRR8ARZgbx8e2', 'MkDLinfIcc', 0, NULL, NULL, NULL),
(4, 0, 0, 'Chalana', 'MENG', '0102030405', 'yolo.meng@gmail.com', 'yolo', '$2y$10$JVywN.0twh3QzBEJSkBJZOjLcikhDPM5UWcoagihS9HQqTt13YZN2', 'zcYHlSxaoA', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `id_equipment` int(11) NOT NULL AUTO_INCREMENT,
  `name_equipment` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_equipment`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id_history` int(11) NOT NULL AUTO_INCREMENT,
  `date_entry` datetime DEFAULT NULL,
  `date_sorty` datetime DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_history`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `town` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id_location`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`id_location`, `town`, `address`) VALUES
(1, 'Bastille', 'none'),
(2, 'Beaubourg', 'none'),
(3, 'Odéon', 'none'),
(4, 'Place d\'Italie', 'none\r\n'),
(5, 'République', 'none'),
(6, 'Ternes', 'none');

-- --------------------------------------------------------

--
-- Structure de la table `location_schedule`
--

DROP TABLE IF EXISTS `location_schedule`;
CREATE TABLE IF NOT EXISTS `location_schedule` (
  `id_location` int(11) NOT NULL,
  `id_schedule` int(11) NOT NULL,
  PRIMARY KEY (`id_location`,`id_schedule`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id_room` int(11) NOT NULL,
  `type_room` varchar(100) NOT NULL,
  `number_places` int(11) NOT NULL,
  `id_town` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `id_schedule` int(11) NOT NULL,
  `day` varchar(8) NOT NULL,
  `begin_schedule` time NOT NULL,
  `end_schedule` time NOT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_schedule`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id_staff` int(11) NOT NULL,
  `name_staff` varchar(80) NOT NULL,
  `surname_staff` varchar(80) NOT NULL,
  `hierarchy` int(11) NOT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_staff`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `staff_ticket`
--

DROP TABLE IF EXISTS `staff_ticket`;
CREATE TABLE IF NOT EXISTS `staff_ticket` (
  `id_staff` int(11) DEFAULT NULL,
  `id_ticket` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `id_subscription` int(11) NOT NULL,
  `type_subscription` int(11) NOT NULL,
  `date_begin_subscription` datetime NOT NULL,
  `date_finish_subscription` datetime NOT NULL,
  PRIMARY KEY (`id_subscription`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id_ticket` int(11) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `description` longtext NOT NULL,
  `id_equipment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

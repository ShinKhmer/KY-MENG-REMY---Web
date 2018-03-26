-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 26 mars 2018 à 10:22
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
  `id_room` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `begin_booking` datetime NOT NULL,
  `end_booking` datetime NOT NULL,
  PRIMARY KEY (`id_room`,`id_customer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `blockded` tinyint(4) NOT NULL DEFAULT '0',
  `name_customer` varchar(80) CHARACTER SET latin1 NOT NULL,
  `last_name_customer` varchar(80) CHARACTER SET latin1 NOT NULL,
  `phone_number_customer` char(10) CHARACTER SET latin1 NOT NULL,
  `email_customer` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pseudo_customer` varchar(80) CHARACTER SET latin1 NOT NULL,
  `password_customer` varchar(255) CHARACTER SET latin1 NOT NULL,
  `code_customer` varchar(10) CHARACTER SET latin1 NOT NULL,
  `inside` tinyint(4) NOT NULL,
  `begin_subscription` datetime DEFAULT NULL,
  `end_subscription` datetime DEFAULT NULL,
  `id_subscription` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id_customer`, `is_admin`, `blockded`, `name_customer`, `last_name_customer`, `phone_number_customer`, `email_customer`, `pseudo_customer`, `password_customer`, `code_customer`, `inside`, `begin_subscription`, `end_subscription`, `id_subscription`) VALUES
(1, 0, 0, 'test', 'oro', '0626733278', 'test@oro.com', 'test', '$2y$10$qb8OClH0FzUyAI1rTgaGp.tKNQglGiSjBuMlGzozQ5XoOvbDNMX9i', 'iMSJryZCOe', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `id_equipment` int(11) NOT NULL AUTO_INCREMENT,
  `name_equipment` varchar(100) CHARACTER SET latin1 NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_equipment`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `equipment`
--

INSERT INTO `equipment` (`id_equipment`, `name_equipment`, `quantity`, `id_location`) VALUES
(1, 'Ordinateur', 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id_history` int(11) NOT NULL AUTO_INCREMENT,
  `date_entry` datetime DEFAULT NULL,
  `date_exit` datetime DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_history`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id_location` int(11) NOT NULL AUTO_INCREMENT,
  `town` varchar(50) CHARACTER SET latin1 NOT NULL,
  `address` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_location`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`id_location`, `town`, `address`) VALUES
(1, 'Bastille', '5 place de la Bastille 75004 PARIS'),
(2, 'Beaubourg', '15 place Georges-Pompidou 75004 PARIS'),
(3, 'Odéon', '32 place de l’Odéon 75006 PARIS'),
(4, 'Place d’Italie', '13 place d’Italie 75013 PARIS'),
(5, 'République', '52 place de la République 75011 PARIS'),
(6, 'Ternes', '27 avenue des Ternes 75017 PARIS');

-- --------------------------------------------------------

--
-- Structure de la table `renting_equipment`
--

DROP TABLE IF EXISTS `renting_equipment`;
CREATE TABLE IF NOT EXISTS `renting_equipment` (
  `id_customer` int(11) NOT NULL,
  `id_equipment` int(11) NOT NULL,
  `date_rent` datetime DEFAULT NULL,
  `date_return` datetime DEFAULT NULL,
  PRIMARY KEY (`id_customer`,`id_equipment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id_room` int(11) NOT NULL AUTO_INCREMENT,
  `type_room` varchar(100) CHARACTER SET latin1 NOT NULL,
  `number_places` int(11) NOT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`id_room`, `type_room`, `number_places`, `id_location`) VALUES
(2, 'Salle de rÃ©union', 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `id_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(9) CHARACTER SET latin1 NOT NULL,
  `begin_schedule` time NOT NULL,
  `end_schedule` time NOT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_schedule`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `day`, `begin_schedule`, `end_schedule`, `id_location`) VALUES
(1, 'Lundi', '08:00:00', '21:00:00', 1),
(2, 'Mardi', '08:30:00', '20:30:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id_staff` int(11) NOT NULL AUTO_INCREMENT,
  `name_staff` varchar(80) CHARACTER SET latin1 NOT NULL,
  `surname_staff` varchar(80) CHARACTER SET latin1 NOT NULL,
  `nickname_staff` varchar(80) CHARACTER SET latin1 NOT NULL,
  `hierarchy` int(11) NOT NULL,
  `id_location` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_staff`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `staff_ticket`
--

DROP TABLE IF EXISTS `staff_ticket`;
CREATE TABLE IF NOT EXISTS `staff_ticket` (
  `id_staff` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  PRIMARY KEY (`id_staff`,`id_ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `id_subscription` int(11) NOT NULL AUTO_INCREMENT,
  `type_subscription` varchar(255) CHARACTER SET latin1 NOT NULL,
  `price_with_engagement` double DEFAULT NULL,
  `price_without_engagement` double DEFAULT NULL,
  `description` longtext CHARACTER SET latin1,
  PRIMARY KEY (`id_subscription`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `subscription`
--

INSERT INTO `subscription` (`id_subscription`, `type_subscription`, `price_with_engagement`, `price_without_engagement`, `description`) VALUES
(1, 'Sans abonnement', 0, 0, 'Description sans abonnement'),
(2, 'Abonnement simple', 24, 20, 'Description abonnement simple'),
(3, 'Abonnement rÃ©sident', 300, 252, 'Description abonnement rÃ©sident');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` longtext CHARACTER SET latin1 NOT NULL,
  `id_equipment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

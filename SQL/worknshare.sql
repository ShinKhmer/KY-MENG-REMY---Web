-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 19 Avril 2018 à 01:39
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `booking` (
  `id_room` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `begin_booking` datetime NOT NULL,
  `end_booking` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id_customer` int(11) NOT NULL,
  `blocked` tinyint(4) NOT NULL DEFAULT '0',
  `name_customer` varchar(80) NOT NULL,
  `last_name_customer` varchar(80) NOT NULL,
  `phone_number_customer` char(10) NOT NULL,
  `email_customer` varchar(255) NOT NULL,
  `pseudo_customer` varchar(80) NOT NULL,
  `password_customer` varchar(255) NOT NULL,
  `code_customer` varchar(10) NOT NULL,
  `token` char(32) DEFAULT NULL,
  `inside` tinyint(4) NOT NULL DEFAULT '0',
  `is_student` tinyint(4) NOT NULL DEFAULT '0',
  `begin_subscription` datetime DEFAULT NULL,
  `end_subscription` datetime DEFAULT NULL,
  `id_subscription` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `customers`
--

INSERT INTO `customers` (`id_customer`, `blocked`, `name_customer`, `last_name_customer`, `phone_number_customer`, `email_customer`, `pseudo_customer`, `password_customer`, `code_customer`, `token`, `inside`, `is_student`, `begin_subscription`, `end_subscription`, `id_subscription`) VALUES
(1, 0, 'test', 'oro', '0102030405', 'test.oro@work.com', 'test', '$2y$10$8DqJjOJTWKMRWMqs2TeizORdxdOaBwtHj7uTeXzykqKSNfIhwRxeW', 'noRVxdaCCo', '086304c32adcd41dcbcb3d4f93016e12', 0, 0, '2018-04-05 00:00:00', '2018-05-05 00:00:00', 2),
(2, 0, 'testo', 'oro', '0102030404', 'testo.oro@work.com', 'testo', '$2y$10$jREI4WhtB09ayJpAQiQkY.Q0Yd5Dj5avDX6bJZTtU3MqORY1FFrQO', 'XnIgzcsras', 'c42dff4ceac1fb2208bb8e983fadb860', 0, 0, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `equipment`
--

CREATE TABLE `equipment` (
  `id_equipment` int(11) NOT NULL,
  `name_equipment` varchar(100) NOT NULL,
  `reference` varchar(25) DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '1',
  `id_location` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `equipment`
--

INSERT INTO `equipment` (`id_equipment`, `name_equipment`, `reference`, `state`, `id_location`) VALUES
(1, 'Ordinateur', 'COBA1', 1, 1),
(2, 'Ordinateur', 'COBE1', 1, 2),
(4, 'Routeur', 'ROBA1', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `date_entry` datetime DEFAULT NULL,
  `date_exit` datetime DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_location` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `history`
--

INSERT INTO `history` (`id_history`, `date_entry`, `date_exit`, `id_customer`, `id_location`) VALUES
(1, '2018-03-26 19:54:01', '2018-03-26 19:54:08', 1, 1),
(2, '2018-03-26 20:00:38', '2018-03-26 20:00:40', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `id_location` int(11) NOT NULL,
  `town` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `location`
--

INSERT INTO `location` (`id_location`, `town`, `address`) VALUES
(1, 'Bastille', '5 place de la Bastille 75004 PARIS'),
(2, 'Beaubourg', '15 place Georges-Pompidou 75004 PARIS'),
(3, 'Odeon', '32 place de l’Odéon 75006 PARIS'),
(4, 'Place d\'Italie', '13 place d’Italie 75013 PARIS'),
(5, 'Republique', '52 place de la République 75011 PARIS'),
(6, 'Ternes', '27 avenue des Ternes 75017 PARIS');

-- --------------------------------------------------------

--
-- Structure de la table `renting_equipment`
--

CREATE TABLE `renting_equipment` (
  `id_customer` int(11) NOT NULL,
  `id_equipment` int(11) NOT NULL,
  `date_rent` datetime DEFAULT NULL,
  `date_return` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `type_room` varchar(100) NOT NULL,
  `number_places` int(11) NOT NULL,
  `booked` tinyint(4) NOT NULL DEFAULT '0',
  `id_location` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `room`
--

INSERT INTO `room` (`id_room`, `type_room`, `number_places`, `booked`, `id_location`) VALUES
(1, 'Salle de rÃ©union', 3, 0, 1),
(2, 'Salon cosy', 3, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` int(11) NOT NULL,
  `day` varchar(9) NOT NULL,
  `begin_schedule` time NOT NULL,
  `end_schedule` time NOT NULL,
  `id_location` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `day`, `begin_schedule`, `end_schedule`, `id_location`) VALUES
(1, 'lundi', '02:00:00', '10:00:00', 1),
(2, 'mardi', '00:00:00', '00:00:00', 1),
(3, 'mercredi', '00:00:00', '00:00:00', 1),
(4, 'jeudi', '00:00:00', '00:00:00', 1),
(5, 'vendredi', '00:00:00', '00:00:00', 1),
(6, 'samedi', '00:00:00', '00:00:00', 1),
(7, 'dimanche', '00:00:00', '00:00:00', 1),
(8, 'lundi', '14:00:00', '20:00:00', 2),
(9, 'mardi', '00:00:00', '00:00:00', 2),
(10, 'mercredi', '00:00:00', '00:00:00', 2),
(11, 'jeudi', '00:00:00', '00:00:00', 2),
(12, 'vendredi', '00:00:00', '00:00:00', 2),
(13, 'samedi', '00:00:00', '00:00:00', 2),
(14, 'dimanche', '00:00:00', '00:00:00', 2),
(15, 'lundi', '00:00:00', '00:00:00', 3),
(16, 'mardi', '00:00:00', '00:00:00', 3),
(17, 'mercredi', '00:00:00', '00:00:00', 3),
(18, 'jeudi', '00:00:00', '00:00:00', 3),
(19, 'vendredi', '00:00:00', '00:00:00', 3),
(20, 'samedi', '00:00:00', '00:00:00', 3),
(21, 'dimanche', '00:00:00', '00:00:00', 3),
(22, 'lundi', '00:00:00', '00:00:00', 4),
(23, 'mardi', '00:00:00', '00:00:00', 4),
(24, 'mercredi', '00:00:00', '00:00:00', 4),
(25, 'jeudi', '00:00:00', '00:00:00', 4),
(26, 'vendredi', '00:00:00', '00:00:00', 4),
(27, 'samedi', '00:00:00', '00:00:00', 4),
(28, 'dimanche', '00:00:00', '00:00:00', 4),
(29, 'lundi', '00:00:00', '00:00:00', 5),
(30, 'mardi', '00:00:00', '00:00:00', 5),
(31, 'mercredi', '00:00:00', '00:00:00', 5),
(32, 'jeudi', '00:00:00', '00:00:00', 5),
(33, 'vendredi', '00:00:00', '00:00:00', 5),
(34, 'samedi', '00:00:00', '00:00:00', 5),
(35, 'dimanche', '00:00:00', '00:00:00', 5),
(36, 'lundi', '00:00:00', '00:00:00', 6),
(37, 'mardi', '00:00:00', '00:00:00', 6),
(38, 'mercredi', '00:00:00', '00:00:00', 6),
(39, 'jeudi', '00:00:00', '00:00:00', 6),
(40, 'vendredi', '00:00:00', '00:00:00', 6),
(41, 'samedi', '00:00:00', '00:00:00', 6),
(42, 'dimanche', '00:00:00', '00:00:00', 6);

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

CREATE TABLE `staff` (
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `id_customer` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `staff`
--

INSERT INTO `staff` (`is_admin`, `id_customer`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `staff_ticket`
--

CREATE TABLE `staff_ticket` (
  `id_ticket` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `subscription`
--

CREATE TABLE `subscription` (
  `id_subscription` int(11) NOT NULL,
  `type_subscription` varchar(255) NOT NULL,
  `price_with_engagement` double DEFAULT NULL,
  `price_without_engagement` double DEFAULT NULL,
  `description` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `subscription`
--

INSERT INTO `subscription` (`id_subscription`, `type_subscription`, `price_with_engagement`, `price_without_engagement`, `description`) VALUES
(1, 'Sans abonnement', 0, 0, 'Description sans abonnement'),
(2, 'Abonnement simple', 24, 20, 'Description abonnement simple'),
(3, 'Abonnement rÃ©sident', 300, 252, 'Description abonnement rÃ©sident');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `date_creation` timestamp NULL DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_equipment` int(11) DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `subject`, `description`, `date_creation`, `id_customer`, `id_equipment`, `state`) VALUES
(1, 'Test', 'Ceci est un test', NULL, 1, 1, 0),
(2, 'ProblÃ¨me Ã©cran', 'L\'Ã©cran ne veut plus s\'allumer', NULL, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ticket_message`
--

CREATE TABLE `ticket_message` (
  `id_message` int(11) NOT NULL,
  `message` longtext,
  `id_ticket` int(11) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ticket_message`
--

INSERT INTO `ticket_message` (`id_message`, `message`, `id_ticket`, `id_customer`) VALUES
(1, NULL, 1, 1),
(2, NULL, 1, 1),
(3, NULL, 1, 1),
(4, NULL, 1, 1),
(5, 'Yo', 1, 1),
(6, 'Ceci est vraiment un test', 1, 1),
(7, 'Yo hÃ©hÃ©', 1, 1),
(8, 'Yo hehe', 1, 1),
(9, 'Yo !!!', 1, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_room`,`id_customer`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`);

--
-- Index pour la table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id_equipment`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id_location`);

--
-- Index pour la table `renting_equipment`
--
ALTER TABLE `renting_equipment`
  ADD PRIMARY KEY (`id_customer`,`id_equipment`);

--
-- Index pour la table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`);

--
-- Index pour la table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`);

--
-- Index pour la table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_customer`);

--
-- Index pour la table `staff_ticket`
--
ALTER TABLE `staff_ticket`
  ADD PRIMARY KEY (`id_ticket`,`id_customer`);

--
-- Index pour la table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id_subscription`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Index pour la table `ticket_message`
--
ALTER TABLE `ticket_message`
  ADD PRIMARY KEY (`id_message`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id_equipment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id_subscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `ticket_message`
--
ALTER TABLE `ticket_message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 10 Juin 2017 à 06:21
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `welcomed2`
--

-- --------------------------------------------------------

--
-- Structure de la table `ad`
--

CREATE TABLE `ad` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profession_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ad`
--

INSERT INTO `ad` (`id`, `user_id`, `profession_id`, `offer_id`, `city_id`, `detail`, `date_create`) VALUES
(1, 1, 1, 1, 9, 'hsdifhsijdhgijskjgjskogjosjgsjgmsfkgj', '2017-06-08 17:06:22');

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `city`
--

INSERT INTO `city` (`id`, `zipcode`, `name`) VALUES
(1, '', 'Ajoupa Bouillon'),
(2, '', 'Anse d\'Arlets'),
(3, '', 'Basse Pointe'),
(4, '', 'Carbet'),
(5, '', 'Case Pilote'),
(6, '', 'Diamant'),
(7, '', 'Ducos'),
(8, '', 'Fond Saint Denis'),
(9, '', 'Fort de France'),
(10, '', 'François'),
(11, '', 'Gros Morne'),
(12, '', 'Lamentin'),
(13, '', 'Lorrain'),
(14, '', 'Macouba'),
(15, '', 'Marigot'),
(16, '', 'Marin'),
(17, '', 'Morne Rouge'),
(18, '', 'Morne Vert'),
(19, '', 'Précheur'),
(20, '', 'Rivière Pilote'),
(21, '', 'Rivière Salée'),
(22, '', 'Robert'),
(23, '', 'Saint Anne'),
(24, '', 'Saint ESprit'),
(25, '', 'Saint Joseph'),
(26, '', 'Saint Luce'),
(27, '', 'Sainte Marie'),
(28, '', 'Saint Pierre'),
(29, '', 'Schoelcher'),
(30, '', 'Trinité'),
(31, '', 'Trois Ilets'),
(32, '', 'Vauclin'),
(33, '', 'Vert-Pré');

-- --------------------------------------------------------

--
-- Structure de la table `contact_advertiser`
--

CREATE TABLE `contact_advertiser` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `object` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `vu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `object` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `msgread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `lastname`, `firstname`, `email`, `object`, `message`, `msgread`) VALUES
(1, 'gdfghdfgdfgdg', 'dfgdfgdgdfg', 'fdgdfgdfg@fgffgdsg.fr', 'fdgdhgdhdhd', 'dhdfhgfhfhfjfljnhghkdfgjidfngd', 0),
(2, 'Jean-Toussaint', 'Cedric', 'hsdhishdgsgs@shusbgis.fr', 'judighsighishgishgsphgs', 'nhubdghibjkfnsdbhsbgdijsijdgnsigis', 0);

-- --------------------------------------------------------

--
-- Structure de la table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `kind` varchar(7) NOT NULL,
  `type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `offer`
--

INSERT INTO `offer` (`id`, `kind`, `type`) VALUES
(1, 'offre', 'assistanat'),
(2, 'offre', 'cession'),
(3, 'offre', 'remplacement'),
(4, 'offre', 'salariat'),
(5, 'demande', 'assistanat'),
(6, 'demande', 'cession'),
(7, 'demande', 'remplacement'),
(8, 'demande', 'salariat');

-- --------------------------------------------------------

--
-- Structure de la table `profession`
--

CREATE TABLE `profession` (
  `id` int(11) NOT NULL,
  `speciality` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `profession`
--

INSERT INTO `profession` (`id`, `speciality`) VALUES
(1, 'Chirurgien-Dentiste'),
(2, 'Infirmier/Infirmière'),
(3, 'Kinésithérapeute'),
(4, 'Médecin'),
(5, 'Orthophoniste'),
(6, 'Osthéopate'),
(7, 'Pédiatre');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `profession_id` int(11) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `department` varchar(255) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `wm_role` varchar(5) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `profession_id`, `profession`, `firstname`, `lastname`, `address`, `city`, `zipcode`, `department`, `telephone`, `email`, `password`, `wm_role`, `date_create`) VALUES
(1, 1, '', 'Patrice', 'LORTO', '5 rue du Maracana', 'Schoelcher', '97233', 'Martinique', '0696726070', 'patrice.lorto@gmail.com', '123456789', 'admin', '2017-06-08 16:46:55'),
(2, 2, 'Infirmier', 'Anne', 'Hidalgo', 'jshdfosdfjmsdjfs', 'knfsnflnslfdn', '75000', 'Ile de france', '0175887788', 'hfiushlfd@hhsbfs.fr', '123456789', 'user', '2017-06-10 04:01:26');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ad`
--
ALTER TABLE `ad`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profession`
--
ALTER TABLE `profession`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ad`
--
ALTER TABLE `ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `profession`
--
ALTER TABLE `profession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

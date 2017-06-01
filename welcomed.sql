-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 30 Mai 2017 à 01:13
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `welcomed`
--
CREATE DATABASE IF NOT EXISTS `welcomed` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `welcomed`;

-- --------------------------------------------------------

--
-- Structure de la table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kind` enum('demande','offre') NOT NULL,
  `type` enum('Assistanat','Cession','Remplacement','Salariat') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `details` text NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ads`
--

INSERT INTO `ads` (`id`, `user_id`, `kind`, `type`, `title`, `description`, `details`, `date_create`) VALUES
(1, 1, 'offre', 'Assistanat', 'Remplacement longue durée', 'Piur cause de départ en vacance, je recherche un médecin de ce type particulier pour me remplacer pour une période de 14 jours. Vous devez maitriser certaines choses et etre pret à vous mettre à d\'autre.', '{\"profession\":\"M\\u00e9decin\",\"department\":\"Martinique\",\"city\":\"Ajoupa Bouillon\",\"date_start\":\"01\\/02\\/2017\",\"date_end\":\"06\\/07\\/2017\",\"opening\":\"09:00\",\"closing\":\"17:00\",\"secr\\u00e9tariat\":\"on\",\"Carte_Bancaire\":\"on\",\"Ch\\u00e8que\":\"on\",\"Esp\\u00e8ces\":\"on\",\"Acc\\u00e8s_Handicap\\u00e9\":\"on\",\"cabinet\":\"on\",\"domicile\":\"on\",\"hour\\/week\":\"45\",\"patient\\/day\":\"12\",\"salary\\/month\":\"2540\",\"retrocession\":\"25\",\"exercise\":\"SCP\",\"nbPraticioner\":\"3\",\"software\":\"Truc\",\"name\":\"Antoine\",\"email\":\"user@user.com\",\"telephone\":\"0102030405\"}', '2017-05-24 01:32:45'),
(2, 1, 'offre', 'Assistanat', 'Titre de annonce', 'Voici une annonce trakil o klm pour remplir le truc bien comme il faut.\r\nLe contenu peut se mettre à compter et à chanter.En plus de cela, il faut résister à la tentation de jeter tout.', '{\"profession\":\"Kin\\u00e9sith\\u00e9rapeute\",\"department\":\"Martinique\",\"city\":\"Carbet\",\"date_start\":\"01\\/01\\/2017\",\"date_end\":\"01\\/06\\/2017\",\"opening\":\"09:00\",\"closing\":\"16:00\",\"hour\\/week\":\"12\",\"patient\\/day\":\"2\",\"salary\\/month\":\"2500\",\"retrocession\":\"25\",\"exercise\":\"SDF\",\"nbPraticioner\":\"3\",\"software\":\"Truc\",\"name\":\"Antoine\",\"email\":\"user@user.com\",\"telephone\":\"0102030405\"}', '2017-05-29 22:25:34');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `date_sent` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` int(11) NOT NULL,
  `vu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
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
  `role` varchar(5) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `profession`, `firstname`, `lastname`, `address`, `city`, `zipcode`, `department`, `telephone`, `email`, `password`, `role`, `date_create`) VALUES
(1, 'Médecin', 'Antoine', 'Pierre', '25, Rue du placebo', 'Medtown', '97211', 'Martinique', '0102030405', 'user@user.com', '$2y$10$cPBZexftRYBCFlsLWPvzae6WSlFiYPDmjZ10Ud9Sd2WZRcpCg4t.2', 'user', '2017-05-21 16:51:48');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

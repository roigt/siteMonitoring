-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 30 jan. 2023 à 23:28
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `modules`
--

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `etat` enum('active','inactive') NOT NULL DEFAULT 'active',
  `valeur_mesure` int(10) NOT NULL,
  `duree_fonctionnement` time NOT NULL,
  `donnee_envoye` int(11) NOT NULL,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2791 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `nom`, `type`, `etat`, `valeur_mesure`, `duree_fonctionnement`, `donnee_envoye`, `last_updated`) VALUES
(2777, 'Module 1', 'Temperature', 'active', 22, '05:53:40', 116, '2023-01-30 23:28:23'),
(2778, 'Module 2', 'Temperature', 'inactive', 15, '13:28:24', 369, '2023-01-30 23:28:23'),
(2779, 'Module 3', 'Temperature', 'inactive', 36, '07:56:28', 963, '2023-01-30 23:28:23'),
(2780, 'Module 4', 'Temperature', 'active', 40, '11:20:56', 646, '2023-01-30 23:28:23'),
(2781, 'Module 5', 'Temperature', 'active', 29, '14:57:49', 701, '2023-01-30 23:28:23'),
(2782, 'Module 6', 'Temperature', 'inactive', 30, '19:55:37', 607, '2023-01-30 23:28:23'),
(2783, 'Module 7', 'Temperature', 'active', 23, '20:26:25', 190, '2023-01-30 23:28:23'),
(2784, 'Module 8', 'Temperature', 'inactive', 19, '16:54:06', 295, '2023-01-30 23:28:23'),
(2785, 'Module 9', 'Temperature', 'active', 16, '23:30:51', 910, '2023-01-30 23:28:23'),
(2786, 'Module 10', 'Temperature', 'inactive', 36, '02:33:41', 519, '2023-01-30 23:28:23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

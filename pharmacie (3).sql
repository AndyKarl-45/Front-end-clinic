-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 20 mars 2024 à 12:05
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `c2164852c_clinic_syges`
--

-- --------------------------------------------------------

--
-- Structure de la table `pharmacie`
--

DROP TABLE IF EXISTS `pharmacie`;
CREATE TABLE IF NOT EXISTS `pharmacie` (
  `id_phar` int(16) NOT NULL AUTO_INCREMENT,
  `id_medi` int(16) DEFAULT '0',
  `nom_medi` varchar(255) DEFAULT 'N/A',
  `quantite` int(16) DEFAULT '0',
  `date_phar` date DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  `id_num_lot` varchar(255) DEFAULT 'N/A',
  `date_fab` date DEFAULT NULL,
  `date_exp` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  PRIMARY KEY (`id_phar`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

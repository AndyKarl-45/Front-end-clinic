-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 26 mars 2024 à 11:51
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `c2164852c_clinic_syges`
--

-- --------------------------------------------------------

--
-- Structure de la table `anesthesie`
--

DROP TABLE IF EXISTS `anesthesie`;
CREATE TABLE IF NOT EXISTS `anesthesie` (
  `id_anes` int(16) NOT NULL AUTO_INCREMENT,
  `ref_anes` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_type_anes` int(16) DEFAULT '0',
  `date_anes` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT 'N/A',
  `id_chirugien` int(16) DEFAULT '0',
  `id_fich` int(16) DEFAULT '0',
  `obs_anes` varchar(255) DEFAULT 'N/A',
  `open_close` int(16) DEFAULT '0',
  `etat` int(16) DEFAULT '0',
  PRIMARY KEY (`id_anes`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `anesthesie`
--

INSERT INTO `anesthesie` (`id_anes`, `ref_anes`, `id_patient`, `id_medecin`, `id_type_anes`, `date_anes`, `obs`, `id_chirugien`, `id_fich`, `obs_anes`, `open_close`, `etat`) VALUES
(1, 'ANE_2024_01_1', 1, 2, 0, '2024-01-12', '', 0, 0, 'N/A', 0, 0),
(2, 'ANE_2024_01_2', 2, 2, 1, '2024-01-17', '', 0, 0, 'N/A', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id_app` int(16) NOT NULL AUTO_INCREMENT,
  `ref_app` varchar(255) NOT NULL,
  `id_patient` int(16) DEFAULT '0',
  `id_depart` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_laboratin` int(16) DEFAULT '0',
  `date_app` date DEFAULT NULL,
  `time_app` time DEFAULT NULL,
  `patient_email` varchar(255) DEFAULT 'N/A',
  `patient_phone` varchar(255) DEFAULT 'N/A',
  `message` varchar(255) DEFAULT 'N/A',
  `statut_app` varchar(5) DEFAULT '1',
  `date_apt` date DEFAULT NULL,
  `time_apt` time DEFAULT NULL,
  PRIMARY KEY (`id_app`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`id_app`, `ref_app`, `id_patient`, `id_depart`, `id_medecin`, `id_laboratin`, `date_app`, `time_app`, `patient_email`, `patient_phone`, `message`, `statut_app`, `date_apt`, `time_apt`) VALUES
(1, 'APT_2024_01_11_1', 1, 3, 0, 1, '2024-01-12', '09:52:00', 'hosting@win-technology.net', '655010203', '', '1', '2024-01-11', '09:46:00'),
(2, 'APT_2024_03_19_2', 1, 20, 2, 0, '2024-03-19', '18:04:00', 'hosting@win-technology.net', '655010203', 'raison', '1', '2024-03-19', '16:04:00');

-- --------------------------------------------------------

--
-- Structure de la table `assurances`
--

DROP TABLE IF EXISTS `assurances`;
CREATE TABLE IF NOT EXISTS `assurances` (
  `id_ass` int(16) NOT NULL AUTO_INCREMENT,
  `ref_ass` varchar(255) DEFAULT 'N/A',
  `raison_social_ass` varchar(255) DEFAULT 'N/A',
  `email_ass` varchar(255) DEFAULT 'N/A',
  `pays_ass` int(16) DEFAULT '0',
  `ville_ass` varchar(255) DEFAULT 'N/A',
  `tel_ass` varchar(255) DEFAULT 'N/A',
  `personne_contact` varchar(255) DEFAULT '0',
  `tel_contact` varchar(255) DEFAULT 'N/A',
  `date_ass` date DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_ass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `autre`
--

DROP TABLE IF EXISTS `autre`;
CREATE TABLE IF NOT EXISTS `autre` (
  `id_autre` int(16) NOT NULL AUTO_INCREMENT,
  `ref_autre` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_autre_service` int(16) DEFAULT '0',
  `date_autre` date DEFAULT NULL,
  `etat` int(16) DEFAULT '0',
  `obs` varchar(255) DEFAULT 'N/A',
  `id_fich` int(16) DEFAULT '0',
  `obs_autre` varchar(255) DEFAULT 'N/A',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_autre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `autre`
--

INSERT INTO `autre` (`id_autre`, `ref_autre`, `id_patient`, `id_medecin`, `id_autre_service`, `date_autre`, `etat`, `obs`, `id_fich`, `obs_autre`, `open_close`) VALUES
(5, 'AUTRE_2024_02_2_5', 2, 2, 0, '2024-02-05', 1, '', 0, 'N/A', 0),
(6, 'AUTRE_2024_02_2_6', 2, 2, 0, '2024-02-05', 1, '', 0, 'N/A', 0);

-- --------------------------------------------------------

--
-- Structure de la table `autres_services`
--

DROP TABLE IF EXISTS `autres_services`;
CREATE TABLE IF NOT EXISTS `autres_services` (
  `id_autre_service` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT 'N/A',
  `prix_autre_service` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_autre_service`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `autres_services`
--

INSERT INTO `autres_services` (`id_autre_service`, `nom`, `prix_autre_service`, `open_close`) VALUES
(12, 'Autre', 1000, 1),
(13, 'Douala', 600, 1);

-- --------------------------------------------------------

--
-- Structure de la table `autre_exa`
--

DROP TABLE IF EXISTS `autre_exa`;
CREATE TABLE IF NOT EXISTS `autre_exa` (
  `id_autre_exa` int(16) NOT NULL AUTO_INCREMENT,
  `id_autre` int(16) DEFAULT '0',
  `ref_autre_exa` varchar(255) DEFAULT 'N/A',
  `remise` int(32) DEFAULT '0',
  `id_autre_service` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_depart` int(16) DEFAULT '0',
  `resultat_autre` varchar(255) DEFAULT 'N/A',
  `rang` varchar(255) DEFAULT 'N/A',
  `remarque` varchar(255) DEFAULT 'N/A',
  `qte_autre_exa` int(32) DEFAULT '0',
  `amount` int(32) DEFAULT '0',
  `payer` int(32) NOT NULL DEFAULT '0',
  `date_autre` date DEFAULT NULL,
  `etat` int(11) DEFAULT '0',
  `posologie` varchar(255) DEFAULT 'N/A',
  `traitement` varchar(255) DEFAULT 'N/A',
  PRIMARY KEY (`id_autre_exa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `autre_exa`
--

INSERT INTO `autre_exa` (`id_autre_exa`, `id_autre`, `ref_autre_exa`, `remise`, `id_autre_service`, `id_patient`, `id_medecin`, `id_depart`, `resultat_autre`, `rang`, `remarque`, `qte_autre_exa`, `amount`, `payer`, `date_autre`, `etat`, `posologie`, `traitement`) VALUES
(5, 5, 'AUTRE_2024_02_2_5', 0, 12, 2, 2, 0, 'N/A', 'N/A', 'N/A', 1, 1000, 1000, '2024-02-05', 1, 'N/A', 'N/A'),
(6, 6, 'AUTRE_2024_02_2_6', 0, 12, 2, 2, 0, 'N/A', 'N/A', 'N/A', 1, 1000, 1000, '2024-02-05', 1, 'N/A', 'N/A');

-- --------------------------------------------------------

--
-- Structure de la table `banque`
--

DROP TABLE IF EXISTS `banque`;
CREATE TABLE IF NOT EXISTS `banque` (
  `id_banque` int(16) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT 'N/A',
  `banque` varchar(255) DEFAULT 'N/A',
  `id_perso` int(16) DEFAULT '0',
  `solde` int(32) DEFAULT '0',
  `date_banque` date DEFAULT NULL,
  `date_modif` date DEFAULT NULL,
  `heure_modif` time DEFAULT NULL,
  `open_close` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_banque`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `banque`
--

INSERT INTO `banque` (`id_banque`, `code`, `banque`, `id_perso`, `solde`, `date_banque`, `date_modif`, `heure_modif`, `open_close`) VALUES
(1, 'BQ_354759', 'Mm2', 19, 0, '2024-01-17', '2024-01-17', '08:07:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `bloc_operatoire`
--

DROP TABLE IF EXISTS `bloc_operatoire`;
CREATE TABLE IF NOT EXISTS `bloc_operatoire` (
  `id_bloc_ope` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_bloc_ope`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `bloc_operatoire`
--

INSERT INTO `bloc_operatoire` (`id_bloc_ope`, `nom`) VALUES
(1, 'Bloc 1'),
(2, 'Bop');

-- --------------------------------------------------------

--
-- Structure de la table `caisse`
--

DROP TABLE IF EXISTS `caisse`;
CREATE TABLE IF NOT EXISTS `caisse` (
  `id_caisse` int(16) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT 'N/A',
  `caisse` varchar(255) DEFAULT 'N/A',
  `id_perso` int(16) DEFAULT '0',
  `type_caisse` int(16) DEFAULT '0',
  `solde` int(32) DEFAULT '0',
  `date_caisse` date DEFAULT NULL,
  `date_modif` date DEFAULT NULL,
  `heure_modif` time DEFAULT NULL,
  `open_close` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_caisse`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `caisse`
--

INSERT INTO `caisse` (`id_caisse`, `code`, `caisse`, `id_perso`, `type_caisse`, `solde`, `date_caisse`, `date_modif`, `heure_modif`, `open_close`) VALUES
(4, '1995', 'Afriland First Bank', 32, 0, 0, '2022-09-14', NULL, NULL, 1),
(7, '0001', '009', 19, 0, 361499, '2024-01-03', NULL, NULL, 0),
(8, '0016', '010', 19, 0, 4000, '2024-01-11', NULL, NULL, 1),
(9, '0016', '010', 20, 0, 129500, '2024-01-17', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cat_exa`
--

DROP TABLE IF EXISTS `cat_exa`;
CREATE TABLE IF NOT EXISTS `cat_exa` (
  `id_cat_exa` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_cat_exa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cat_exa`
--

INSERT INTO `cat_exa` (`id_cat_exa`, `nom`, `open_close`) VALUES
(1, 'Demo', 1),
(2, 'Examin', 0);

-- --------------------------------------------------------

--
-- Structure de la table `caution`
--

DROP TABLE IF EXISTS `caution`;
CREATE TABLE IF NOT EXISTS `caution` (
  `id_caution` int(16) NOT NULL AUTO_INCREMENT,
  `ref_caution` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `montant` int(32) DEFAULT '0',
  `date_caution` date DEFAULT NULL,
  `date_modif` date DEFAULT NULL,
  `heure_modif` time DEFAULT NULL,
  `open_close` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_caution`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `caution`
--

INSERT INTO `caution` (`id_caution`, `ref_caution`, `id_patient`, `id_perso`, `montant`, `date_caution`, `date_modif`, `heure_modif`, `open_close`) VALUES
(1, 'CAU_2024_01_1_', 1, 19, 10000, '2024-01-11', '2024-01-11', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `certi_medi`
--

DROP TABLE IF EXISTS `certi_medi`;
CREATE TABLE IF NOT EXISTS `certi_medi` (
  `id_certi_medi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_certi_medi` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `nb_jour` int(16) DEFAULT '0',
  `date_certi_medi` date DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_certi_medi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chambres`
--

DROP TABLE IF EXISTS `chambres`;
CREATE TABLE IF NOT EXISTS `chambres` (
  `id_chambre` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_chambre`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chambres`
--

INSERT INTO `chambres` (`id_chambre`, `nom`, `open_close`) VALUES
(1, 'Chambre1', 1),
(2, 'Post Natal Ward  I', 1),
(3, 'Post Natal Ward Ii', 1),
(4, 'Post Natal Ward Ii', 1),
(5, 'Post Natal Ward 02', 0),
(6, 'Post Natal Ward 01', 0),
(7, 'Mens Ward 01', 1),
(8, 'Womens Ward 01', 0),
(9, 'Pediatric Ward 01', 1),
(10, 'Mens Ward', 0),
(11, 'Pediatric Ward', 0),
(12, 'Women Ward', 0),
(13, 'Vip Room 1', 0),
(14, 'Privite Room 1', 0),
(15, 'Privite Room 2', 0),
(16, 'Privite Room 3', 0),
(17, 'Vip Room 2', 0),
(18, 'Isolation', 0),
(19, 'Neonatology', 0),
(20, 'Vip Ward 01', 0),
(21, 'Vip Ward 02', 0),
(22, 'Vip Ward 03', 0),
(23, 'Maison', 0);

-- --------------------------------------------------------

--
-- Structure de la table `chantier`
--

DROP TABLE IF EXISTS `chantier`;
CREATE TABLE IF NOT EXISTS `chantier` (
  `id_chantier` int(16) NOT NULL AUTO_INCREMENT,
  `id_marche` int(16) NOT NULL,
  `ref_marche` varchar(255) DEFAULT NULL,
  `objet_marche` varchar(255) DEFAULT NULL,
  `date_begin_marche` date DEFAULT NULL,
  `montant_ttc_marche` int(64) NOT NULL,
  `nom_chantier` varchar(255) DEFAULT NULL,
  `adresse_chantier` varchar(255) DEFAULT NULL,
  `tel_chantier` varchar(255) DEFAULT NULL,
  `id_personnel` int(16) NOT NULL,
  `id_pers_pointeur` int(16) NOT NULL,
  `id_pers_con` int(16) DEFAULT NULL,
  `id_pers_ges` int(16) DEFAULT NULL,
  `cout_h_moy_chantier` int(64) NOT NULL,
  `dure_chantier` int(32) NOT NULL,
  `objet_chantier` varchar(255) DEFAULT NULL,
  `date_begin_chantier` date DEFAULT NULL,
  `montant_ttc_chantier` int(255) NOT NULL,
  `etat` int(16) NOT NULL,
  `open_close` int(16) NOT NULL,
  PRIMARY KEY (`id_chantier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `chirugien`
--

DROP TABLE IF EXISTS `chirugien`;
CREATE TABLE IF NOT EXISTS `chirugien` (
  `id_chirugien` int(16) NOT NULL AUTO_INCREMENT,
  `nom_c` varchar(255) DEFAULT 'N/A',
  `type_c` char(5) DEFAULT 'N/A',
  `prenom_c` varchar(255) DEFAULT 'N/A',
  `user_c` varchar(255) DEFAULT 'N/A',
  `email_c` varchar(255) DEFAULT 'N/A',
  `id_depart` int(16) DEFAULT '0',
  `pass_c` varchar(255) DEFAULT '1234',
  `check_pass_c` varchar(255) DEFAULT 'N/A',
  `date_c` date DEFAULT NULL,
  `genre_c` varchar(2) DEFAULT NULL,
  `adress_c` varchar(255) DEFAULT 'N/A',
  `pays_c` varchar(255) DEFAULT 'N/A',
  `ville_c` varchar(255) DEFAULT 'N/A',
  `region_c` varchar(255) DEFAULT 'N/A',
  `code_c` varchar(255) DEFAULT 'N/A',
  `phone_c` varchar(255) DEFAULT 'N/A',
  `avatar_c` int(16) DEFAULT '0',
  `bio_c` varchar(255) DEFAULT 'N/A',
  `statut_c` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_chirugien`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chirugien`
--

INSERT INTO `chirugien` (`id_chirugien`, `nom_c`, `type_c`, `prenom_c`, `user_c`, `email_c`, `id_depart`, `pass_c`, `check_pass_c`, `date_c`, `genre_c`, `adress_c`, `pays_c`, `ville_c`, `region_c`, `code_c`, `phone_c`, `avatar_c`, `bio_c`, `statut_c`, `open_close`) VALUES
(1, 'NGOA MEYONG', 'N/A', 'Kizito', 'N/A', 'hosting@win-technology.net', 0, 'N/A', 'N/A', NULL, 'M', 'ELIG-ESSONO (MONTE HOTEL GRAND MOULIN', '0', 'YAOUNDE', 'N/A', 'N/A', '655010203', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_com` int(16) NOT NULL AUTO_INCREMENT,
  `ref_com` varchar(255) DEFAULT 'N/A',
  `id_four` int(16) DEFAULT '0',
  `id_medi` int(16) DEFAULT '0',
  `id_num_lot` varchar(255) DEFAULT 'NUMLOT0',
  `date_exp` date DEFAULT NULL,
  `date_fab` date DEFAULT NULL,
  `qt_com` int(32) DEFAULT '0',
  `prix_ht` int(32) DEFAULT '0',
  `frais` int(32) DEFAULT '0',
  `date_c_com` date DEFAULT NULL,
  `date_l_com` date DEFAULT NULL,
  `date_r_com` date DEFAULT NULL,
  `mode_paie` int(16) DEFAULT '0',
  `moment` varchar(100) DEFAULT 'N/A',
  `obs` varchar(100) DEFAULT 'N/A',
  `etat` int(11) DEFAULT '0',
  `date_valide` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  PRIMARY KEY (`id_com`),
  KEY `id_medi` (`id_medi`),
  KEY `id_four` (`id_four`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_com`, `ref_com`, `id_four`, `id_medi`, `id_num_lot`, `date_exp`, `date_fab`, `qt_com`, `prix_ht`, `frais`, `date_c_com`, `date_l_com`, `date_r_com`, `mode_paie`, `moment`, `obs`, `etat`, `date_valide`, `heure`) VALUES
(2, '0008976_2024_01_11_10_11_11', 0, 19, '879', '2024-01-01', '2024-01-30', 90, 0, 0, '2024-01-11', '2024-01-11', '2024-01-26', 2, 'N/A', '', 1, '2024-01-11', '10:12:00'),
(4, '0008976_2024_02_05_15_07_27', 1, 4, '879', '2024-02-05', '2024-02-22', 2, 0, 0, '2024-02-05', '2024-02-05', '2024-02-05', 2, 'N/A', '', 1, '2024-03-08', '13:51:00'),
(5, '0008976_2024_02_05_15_07_27', 1, 20, '872', '2024-02-05', '2024-02-29', 5, 0, 0, '2024-02-05', '2024-02-05', '2024-02-05', 2, 'N/A', '', 1, '2024-03-08', '13:51:00'),
(6, '0008976_2024_02_05_15_07_27', 1, 8, '878', '2024-02-05', '2024-02-29', 8, 0, 0, '2024-02-05', '2024-02-05', '2024-02-05', 2, 'N/A', '', 1, '2024-03-08', '13:51:00'),
(7, '0008976_2024_02_28_16_53_02', 1, 6, '', '2024-02-28', '2024-02-28', 12, 0, 0, '2024-02-28', '2024-02-28', '2024-02-28', 2, 'N/A', '', 1, '2024-02-28', '16:54:00'),
(8, '0008976_2024_02_28_16_53_02', 1, 11, '', '2024-02-28', '2024-02-28', 9, 0, 0, '2024-02-28', '2024-02-28', '2024-02-28', 2, 'N/A', '', 1, '2024-02-28', '16:54:00'),
(9, '0008976_2024_02_28_16_53_02', 1, 18, '', '2024-02-28', '2024-02-28', 5, 0, 0, '2024-02-28', '2024-02-28', '2024-02-28', 2, 'N/A', '', 1, '2024-02-28', '16:54:00'),
(10, '0008976_2024_02_28_16_53_02', 1, 23, '', '2024-02-28', '2024-02-28', 21, 0, 0, '2024-02-28', '2024-02-28', '2024-02-28', 2, 'N/A', '', 1, '2024-02-28', '16:54:00'),
(11, '0008976_2024_03_08_13_53_21', 1, 4, '879', '2024-03-08', '2024-03-08', 7, 0, 0, '2024-03-08', '2024-03-08', '2024-03-08', 2, 'N/A', '', 1, '2024-03-08', '13:55:00'),
(12, '0008976_2024_03_08_13_53_21', 1, 20, '8798', '2024-03-08', '2024-03-08', 4, 0, 0, '2024-03-08', '2024-03-08', '2024-03-08', 2, 'N/A', '', 1, '2024-03-08', '13:55:00'),
(13, '0008976_2024_03_08_13_53_21', 1, 23, '564', '2024-03-08', '2024-03-08', 9, 0, 0, '2024-03-08', '2024-03-08', '2024-03-08', 2, 'N/A', '', 1, '2024-03-08', '13:55:00'),
(14, '0008976_2024_03_08_14_01_57', 1, 17, '9876879', '2024-03-21', '2024-03-30', 50, 0, 0, '2024-03-08', '2024-03-08', '2024-03-08', 2, 'N/A', '', 1, '2024-03-08', '14:02:00'),
(15, '0008976_2024_03_08_14_01_57', 1, 9, '432178', '2024-03-22', '2024-04-03', 90, 0, 0, '2024-03-08', '2024-03-08', '2024-03-08', 2, 'N/A', '', 1, '2024-03-08', '14:02:00'),
(16, '0008976_2024_03_16_11_18_50', 1, 4, '9876879', '2024-03-05', '2024-04-04', 3, 0, 0, '2024-03-16', '2024-03-16', '2024-03-16', 7, 'N/A', '', 1, '2024-03-16', '11:18:00'),
(17, '4567_2024_03_18_22_12_46', 1, 20, '45667', '2024-03-04', '2024-05-04', 2, 0, 0, '2024-03-18', '2024-03-18', '2024-03-18', 2, 'N/A', '', 1, '2024-03-18', '22:12:00'),
(18, '4543_2024_03_18_22_18_29', 1, 8, '45667', '2024-02-27', '2024-04-04', 4, 0, 0, '2024-03-18', '2024-03-18', '2024-03-18', 2, 'N/A', '', 1, '2024-03-18', '22:18:00'),
(19, '4543_2024_03_18_22_43_25', 1, 20, '9876879', '2024-02-28', '2024-04-04', 10, 0, 0, '2024-03-18', '2024-03-18', '2024-03-18', 2, 'N/A', '', 1, '2024-03-18', '22:43:00'),
(20, '0008976000_2024_03_18_22_45_47', 1, 23, '879000', '2024-02-29', '2024-04-07', 9, 0, 0, '2024-03-18', '2024-03-18', '2024-03-18', 2, 'N/A', '', 1, '2024-03-18', '22:45:00'),
(21, '00089760666_2024_03_20_13_30_48', 1, 22, '8790000', '2024-03-05', '2024-03-31', 6, 0, 0, '2024-03-20', '2024-03-20', '2024-03-20', 0, 'N/A', '', 1, '2024-03-20', '13:30:00'),
(22, '00089760666_2024_03_20_13_30_48', 1, 4, '879001', '2024-02-27', '2024-03-31', 5, 0, 0, '2024-03-20', '2024-03-20', '2024-03-20', 0, 'N/A', '', 1, '2024-03-20', '13:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `commande_outil`
--

DROP TABLE IF EXISTS `commande_outil`;
CREATE TABLE IF NOT EXISTS `commande_outil` (
  `id_com_outil` int(16) NOT NULL AUTO_INCREMENT,
  `ref_com_outil` varchar(255) DEFAULT 'N/A',
  `id_four` int(16) DEFAULT '0',
  `id_outil` int(16) DEFAULT '0',
  `id_num_lot_outil` varchar(255) DEFAULT 'N/A',
  `date_exp` date DEFAULT NULL,
  `date_fab` date DEFAULT NULL,
  `qt_com_outil` int(32) DEFAULT '0',
  `prix_outil` int(32) DEFAULT '0',
  `frais` int(32) DEFAULT '0',
  `date_c_com` date DEFAULT NULL,
  `date_l_com` date DEFAULT NULL,
  `date_r_com` date DEFAULT NULL,
  `mode_paie` int(16) DEFAULT '0',
  `moment` varchar(100) DEFAULT 'N/A',
  `obs` varchar(100) DEFAULT 'N/A',
  `etat` int(11) DEFAULT '0',
  `date_valide` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  PRIMARY KEY (`id_com_outil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commission`
--

DROP TABLE IF EXISTS `commission`;
CREATE TABLE IF NOT EXISTS `commission` (
  `id_comi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_comi` varchar(255) DEFAULT 'N/A',
  `id_service` varchar(255) DEFAULT 'N/A',
  `id_entite` int(16) DEFAULT '0',
  `type_entite` varchar(16) DEFAULT 'N/A',
  `comi` int(32) DEFAULT '0',
  `date_comi` date DEFAULT NULL,
  `date_modif` date DEFAULT NULL,
  `heure_modif` time DEFAULT NULL,
  `open_close` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_comi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commission`
--

INSERT INTO `commission` (`id_comi`, `ref_comi`, `id_service`, `id_entite`, `type_entite`, `comi`, `date_comi`, `date_modif`, `heure_modif`, `open_close`) VALUES
(1, 'COMI_2024_01_11_10:31:06', '5', 1, 'C', 10, '2024-01-11', NULL, NULL, 0),
(2, 'COMI_2024_01_11_10:31:44', '2', 1, 'L', 15, '2024-01-11', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
  `id_con` int(16) NOT NULL AUTO_INCREMENT,
  `ref_con` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_depart` int(16) DEFAULT '0',
  `id_nurse` int(16) DEFAULT '0',
  `date_con` date DEFAULT NULL,
  `taille` int(16) DEFAULT '0',
  `poids` int(16) DEFAULT '0',
  `pression` varchar(150) DEFAULT 'N/A',
  `temp` varchar(16) DEFAULT '0',
  `sao` varchar(25) DEFAULT '0',
  `freq` varchar(25) DEFAULT '0',
  `poul` varchar(25) DEFAULT '0',
  `obs` varchar(255) DEFAULT 'N/A',
  `remise` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `obs_medecin` varchar(255) DEFAULT 'N/A',
  `date_obs_med` date DEFAULT NULL,
  `id_type_consul` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  `etat` int(5) DEFAULT '0',
  PRIMARY KEY (`id_con`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `consultation`
--

INSERT INTO `consultation` (`id_con`, `ref_con`, `id_patient`, `id_depart`, `id_nurse`, `date_con`, `taille`, `poids`, `pression`, `temp`, `sao`, `freq`, `poul`, `obs`, `remise`, `id_medecin`, `obs_medecin`, `date_obs_med`, `id_type_consul`, `open_close`, `etat`) VALUES
(1, 'CON_2024_01_1_1', 1, 0, 1, '2024-01-11', 0, 0, 'N/A', '0', '0', '0', '0', '', 0, 0, 'N/A', NULL, 0, 0, -1),
(2, 'CON_2024_01_1_2', 1, 17, 2, '2024-01-11', 150, 50, '9/12', '38', '12', '5', '5', '', 0, 0, 'N/A', NULL, 3, 0, 1),
(3, 'CON_2024_01_2_3', 2, 2, 2, '2024-01-17', 0, 0, 'N/A', '0', NULL, NULL, NULL, '', 0, 0, 'N/A', NULL, 5, 0, -1),
(4, 'CON_2024_03_2_4', 2, 0, 1, '2024-03-20', 5, 3, '2/3', '0', '0', '0', '0', '', 0, 0, 'N/A', NULL, 15, 0, 1),
(5, 'CON_2024_03_2_5', 2, 1, 1, '2024-03-21', 0, 0, 'N/A', '0', '0', '0', '0', '', 0, 0, 'N/A', NULL, 1, 0, -1),
(6, 'CON_2024_03_0_6', 0, 0, 2, '2024-03-21', 0, 0, 'N/A', '0', '0', '0', '0', '', 0, 0, 'N/A', NULL, 3, 0, -1);

-- --------------------------------------------------------

--
-- Structure de la table `demande_materiel`
--

DROP TABLE IF EXISTS `demande_materiel`;
CREATE TABLE IF NOT EXISTS `demande_materiel` (
  `id_ask_mat` int(16) NOT NULL AUTO_INCREMENT,
  `id_num_lot` varchar(255) DEFAULT 'N/A',
  `id_medi` int(16) DEFAULT '0',
  `date_debut_mat` varchar(32) DEFAULT NULL,
  `nom_salle` varchar(255) DEFAULT 'PHARMACY',
  `id_ask_medi` int(16) DEFAULT '0',
  `quantite` int(64) NOT NULL DEFAULT '0',
  `etat_src` int(11) NOT NULL DEFAULT '0',
  `emetteur` char(5) NOT NULL DEFAULT 'M',
  `receveur` char(5) NOT NULL DEFAULT 'P',
  `id_perso` int(16) DEFAULT '0',
  `responsable` varchar(255) DEFAULT 'N/A',
  `etat_dst` int(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ask_mat`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `demande_materiel`
--

INSERT INTO `demande_materiel` (`id_ask_mat`, `id_num_lot`, `id_medi`, `date_debut_mat`, `nom_salle`, `id_ask_medi`, `quantite`, `etat_src`, `emetteur`, `receveur`, `id_perso`, `responsable`, `etat_dst`) VALUES
(1, '879', 19, '2024-01-11', 'PHARMACY', 1, 2, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(2, '', 6, '2024-02-28', 'PHARMACY', 2, 12, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(3, '', 11, '2024-02-28', 'PHARMACY', 2, 9, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(4, '', 18, '2024-02-28', 'PHARMACY', 2, 5, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(5, '', 23, '2024-02-28', 'PHARMACY', 2, 21, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(6, '564', 23, '2024-03-08', 'PHARMACY', 3, 9, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(7, '872', 20, '2024-03-08', 'PHARMACY', 3, 5, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(8, '878', 8, '2024-03-08', 'PHARMACY', 3, 8, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(9, '432178', 9, '2024-03-08', 'PHARMACY', 3, 10, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(10, '9876879', 17, '2024-03-08', 'PHARMACY', 3, 50, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(11, '45667', 8, '2024-03-18', 'PHARMACY', 4, 1, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(12, '879000', 23, '2024-03-18', 'PHARMACY', 5, 5, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(13, '879001', 4, '2024-03-20', 'PHARMACY', 6, 4, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(14, '8790000', 22, '2024-03-20', 'PHARMACY', 6, 5, 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1);

-- --------------------------------------------------------

--
-- Structure de la table `demande_materiel_outil`
--

DROP TABLE IF EXISTS `demande_materiel_outil`;
CREATE TABLE IF NOT EXISTS `demande_materiel_outil` (
  `id_mat_outil` int(16) NOT NULL AUTO_INCREMENT,
  `id_num_lot_outil` varchar(255) DEFAULT NULL,
  `id_outil` int(16) DEFAULT '0',
  `date_debut_mat` varchar(32) DEFAULT NULL,
  `id_ask_outil` int(16) DEFAULT '0',
  `quantite` int(64) DEFAULT '0',
  `etat_src` int(3) DEFAULT '0',
  `etat_dst` int(3) DEFAULT '0',
  `id_perso_resp` int(16) DEFAULT '0',
  `responsable` varchar(255) DEFAULT 'N/A',
  `id_perso` int(16) DEFAULT '0',
  `id_nurse` int(16) DEFAULT '0',
  `id_med` int(16) DEFAULT '0',
  `id_chi` int(16) DEFAULT '0',
  `id_lab` int(16) DEFAULT '0',
  PRIMARY KEY (`id_mat_outil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `demande_medicament`
--

DROP TABLE IF EXISTS `demande_medicament`;
CREATE TABLE IF NOT EXISTS `demande_medicament` (
  `id_ask_medi` int(16) NOT NULL AUTO_INCREMENT,
  `nom_salle` varchar(32) DEFAULT 'PHARMACY',
  `date_debut` varchar(32) DEFAULT NULL,
  `heure_debut` varchar(25) DEFAULT 'N/A',
  `date_valide` varchar(32) DEFAULT NULL,
  `heure` varchar(32) DEFAULT NULL,
  `etat_src` int(11) DEFAULT '0',
  `emetteur` char(5) DEFAULT 'M',
  `receveur` char(5) DEFAULT 'P',
  `id_perso` int(16) DEFAULT '0',
  `responsable` varchar(255) DEFAULT 'N/A',
  `etat_dst` int(16) DEFAULT '0',
  PRIMARY KEY (`id_ask_medi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `demande_medicament`
--

INSERT INTO `demande_medicament` (`id_ask_medi`, `nom_salle`, `date_debut`, `heure_debut`, `date_valide`, `heure`, `etat_src`, `emetteur`, `receveur`, `id_perso`, `responsable`, `etat_dst`) VALUES
(1, 'PHARMACY', '2024-01-11', '10:14', '2024-03-08', '14:05', 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(2, 'PHARMACY', '2024-02-28', '16:56', '2024-03-08', '14:05', 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(3, 'PHARMACY', '2024-03-08', '14:06', '2024-03-08', '14:07', 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(4, 'PHARMACY', '2024-03-18', '22:20', '2024-03-18', '22:20', 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(5, 'PHARMACY', '2024-03-18', '22:47', '2024-03-18', '22:47', 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1),
(6, 'PHARMACY', '2024-03-20', '13:31', '2024-03-20', '13:32', 1, 'M', 'P', 19, 'KONDE JEAN FELIX', 1);

-- --------------------------------------------------------

--
-- Structure de la table `demande_outil`
--

DROP TABLE IF EXISTS `demande_outil`;
CREATE TABLE IF NOT EXISTS `demande_outil` (
  `id_ask_outil` int(16) NOT NULL AUTO_INCREMENT,
  `id_perso` int(16) DEFAULT '0',
  `id_med` int(16) DEFAULT '0',
  `id_nurse` int(16) DEFAULT '0',
  `id_lab` int(16) DEFAULT '0',
  `id_chi` int(16) DEFAULT '0',
  `date_debut` varchar(32) DEFAULT NULL,
  `date_valide` varchar(32) DEFAULT NULL,
  `heure_debut` varchar(32) DEFAULT NULL,
  `heure` varchar(25) DEFAULT NULL,
  `etat_src` int(3) DEFAULT '0',
  `id_perso_resp` int(16) DEFAULT '0',
  `responsable` varchar(255) DEFAULT 'N/A',
  `etat_dst` int(3) DEFAULT '0',
  PRIMARY KEY (`id_ask_outil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id_depart` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_depart`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id_depart`, `nom`, `open_close`) VALUES
(1, 'Dentist', 0),
(2, 'Neurology', 0),
(3, 'Laboratory', 0),
(4, 'Cardiologie', 0),
(7, 'General Medecine', 0),
(9, 'Gynaecological', 0),
(12, 'Physiotherapie', 0),
(13, 'X-ray And Echography', 0),
(14, 'ANC', 0),
(15, 'Neonatology', 0),
(16, 'Maternity', 0),
(17, 'Chirurgie', 0),
(20, 'Pharmacy', 0),
(21, 'Ent', 0),
(22, 'Dep', 0);

-- --------------------------------------------------------

--
-- Structure de la table `depense_caisse`
--

DROP TABLE IF EXISTS `depense_caisse`;
CREATE TABLE IF NOT EXISTS `depense_caisse` (
  `id_deps_caisse` int(16) NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) DEFAULT 'N/A',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_four` int(16) DEFAULT '0',
  `motif` varchar(255) DEFAULT 'N/A',
  `montant` int(32) DEFAULT '0',
  `etat` int(16) DEFAULT '0',
  `date_deps` date DEFAULT NULL,
  `date_valide` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `open_close` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_deps_caisse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ecographie`
--

DROP TABLE IF EXISTS `ecographie`;
CREATE TABLE IF NOT EXISTS `ecographie` (
  `id_eco` int(16) NOT NULL AUTO_INCREMENT,
  `ref_eco` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_type_eco` int(16) DEFAULT '0',
  `date_eco` date DEFAULT NULL,
  `etat` int(16) DEFAULT '0',
  `obs` varchar(255) DEFAULT 'N/A',
  `id_medecin2` int(16) DEFAULT '0',
  `id_fich` int(16) DEFAULT '0',
  `obs_eco` varchar(255) DEFAULT 'N/A',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_eco`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ecographie`
--

INSERT INTO `ecographie` (`id_eco`, `ref_eco`, `id_patient`, `id_medecin`, `id_type_eco`, `date_eco`, `etat`, `obs`, `id_medecin2`, `id_fich`, `obs_eco`, `open_close`) VALUES
(1, 'ECO_2024_01_1', 1, 2, 2, '2024-01-13', 1, '', 0, 0, 'N/A', 0),
(2, 'ECO_2024_01_2', 2, 2, 2, '2024-01-17', 1, '', 0, 0, 'N/A', 0);

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

DROP TABLE IF EXISTS `entreprises`;
CREATE TABLE IF NOT EXISTS `entreprises` (
  `id_ent` int(16) NOT NULL AUTO_INCREMENT,
  `ref_ent` varchar(255) DEFAULT 'N/A',
  `raison_social_ent` varchar(255) DEFAULT 'N/A',
  `email_ent` varchar(255) DEFAULT 'N/A',
  `pays_ent` int(16) DEFAULT '0',
  `ville_ent` varchar(255) DEFAULT 'N/A',
  `tel_ent` varchar(255) DEFAULT 'N/A',
  `personne_contact` varchar(255) DEFAULT '0',
  `tel_contact` varchar(255) DEFAULT 'N/A',
  `date_ent` date DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_ent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `examen`
--

DROP TABLE IF EXISTS `examen`;
CREATE TABLE IF NOT EXISTS `examen` (
  `id_exa` int(16) NOT NULL AUTO_INCREMENT,
  `ref_exa` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_type_exa` int(16) DEFAULT '0',
  `date_exa` date DEFAULT NULL,
  `etat` int(16) DEFAULT '0',
  `obs` varchar(255) DEFAULT 'N/A',
  `id_lab` int(16) DEFAULT '0',
  `date_exa_lab` date DEFAULT NULL,
  `id_fich` int(16) DEFAULT '0',
  `obs_exa` varchar(255) DEFAULT 'N/A',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_exa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `examen`
--

INSERT INTO `examen` (`id_exa`, `ref_exa`, `id_patient`, `id_medecin`, `id_type_exa`, `date_exa`, `etat`, `obs`, `id_lab`, `date_exa_lab`, `id_fich`, `obs_exa`, `open_close`) VALUES
(1, 'EXAM_2024_01_1_1', 1, 2, 0, '2024-01-11', 1, '', 0, NULL, 0, 'N/A', 0),
(2, 'EXAM_2024_01_2_2', 2, 2, 0, '2024-01-17', 1, '', 0, NULL, 0, 'N/A', 0);

-- --------------------------------------------------------

--
-- Structure de la table `examen_exa`
--

DROP TABLE IF EXISTS `examen_exa`;
CREATE TABLE IF NOT EXISTS `examen_exa` (
  `id_exam_exa` int(16) NOT NULL AUTO_INCREMENT,
  `id_exa` int(16) DEFAULT '0',
  `ref_exam_exa` varchar(255) DEFAULT 'N/A',
  `remise` int(32) DEFAULT '0',
  `id_type_exa` int(16) DEFAULT '0',
  `id_type_echantillon` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_lab` int(16) DEFAULT '0',
  `id_depart` int(16) DEFAULT '0',
  `resultat_exa` varchar(255) DEFAULT 'N/A',
  `rang` varchar(255) DEFAULT 'N/A',
  `remarque` varchar(255) DEFAULT 'N/A',
  `qte_exam_exa` int(32) DEFAULT '0',
  `amount` int(32) DEFAULT '0',
  `payer` int(32) NOT NULL DEFAULT '0',
  `date_exam` date DEFAULT NULL,
  `etat` int(11) DEFAULT '0',
  `posologie` varchar(255) DEFAULT 'N/A',
  `traitement` varchar(255) DEFAULT 'N/A',
  PRIMARY KEY (`id_exam_exa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `examen_exa`
--

INSERT INTO `examen_exa` (`id_exam_exa`, `id_exa`, `ref_exam_exa`, `remise`, `id_type_exa`, `id_type_echantillon`, `id_patient`, `id_medecin`, `id_lab`, `id_depart`, `resultat_exa`, `rang`, `remarque`, `qte_exam_exa`, `amount`, `payer`, `date_exam`, `etat`, `posologie`, `traitement`) VALUES
(1, 1, 'EXAM_2024_01_1_1', 0, 10, 0, 1, 2, 0, 0, 'N/A', 'N/A', 'N/A', 1, 2000, 2000, '2024-01-11', 1, 'N/A', 'N/A'),
(2, 2, 'EXAM_2024_01_2_2', 0, 1, 0, 2, 2, 0, 0, 'N/A', 'N/A', 'N/A', 1, 8000, 8000, '2024-01-17', 1, 'N/A', 'N/A'),
(3, 2, 'EXAM_2024_01_2_2', 0, 14, 0, 2, 2, 0, 0, 'N/A', 'N/A', 'N/A', 1, 1500, 1500, '2024-01-17', 1, 'N/A', 'N/A');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id_four` int(16) NOT NULL AUTO_INCREMENT,
  `ref_four` varchar(255) DEFAULT 'N/A',
  `raison_social_four` varchar(255) DEFAULT 'N/A',
  `email_four` varchar(255) DEFAULT 'N/A',
  `pays_four` int(16) DEFAULT '0',
  `ville_four` varchar(255) DEFAULT 'N/A',
  `tel_four` varchar(255) DEFAULT 'N/A',
  `personne_contact` int(32) DEFAULT '0',
  `tel_contact` varchar(255) DEFAULT 'N/A',
  `date_four` date DEFAULT NULL,
  PRIMARY KEY (`id_four`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id_four`, `ref_four`, `raison_social_four`, `email_four`, `pays_four`, `ville_four`, `tel_four`, `personne_contact`, `tel_contact`, `date_four`) VALUES
(1, 'Four_2024_01_11_1', 'Konde', '', 0, '0', '', 0, 'N/A', '2024-01-11'),
(2, 'Four_2024_01_29_2', 'Konde', '', 0, '0', '', 0, 'N/A', '2024-01-29');

-- --------------------------------------------------------

--
-- Structure de la table `historique_caisse`
--

DROP TABLE IF EXISTS `historique_caisse`;
CREATE TABLE IF NOT EXISTS `historique_caisse` (
  `id_hist_caisse` int(16) NOT NULL AUTO_INCREMENT,
  `id_caisse` int(16) DEFAULT '0',
  `ref_caisse` varchar(255) DEFAULT 'N/A',
  `montant_entre` int(32) DEFAULT '0',
  `montant_sortie` int(32) DEFAULT '0',
  `id_mode_paie` int(16) DEFAULT '0',
  `id_beneficiaire` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `type_beni` varchar(5) DEFAULT 'C',
  `service` int(16) DEFAULT '0',
  `statut` char(3) DEFAULT 'E',
  `date_hist` date DEFAULT NULL,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_hist_caisse`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `historique_caisse`
--

INSERT INTO `historique_caisse` (`id_hist_caisse`, `id_caisse`, `ref_caisse`, `montant_entre`, `montant_sortie`, `id_mode_paie`, `id_beneficiaire`, `id_perso`, `type_beni`, `service`, `statut`, `date_hist`, `time`) VALUES
(1, 7, 'N/A', 20000, 0, 2, 1, 19, 'P', 1, 'E', '2024-01-11', '2024-01-11 09:58:06'),
(2, 7, 'N/A', 1500, 0, 2, 1, 19, 'P', 2, 'E', '2024-01-11', '2024-01-11 09:58:51'),
(3, 7, 'N/A', 2000, 0, 2, 1, 19, 'P', 2, 'E', '2024-01-11', '2024-01-11 09:59:36'),
(4, 7, 'N/A', 330000, 0, 2, 1, 19, 'P', 5, 'E', '2024-01-11', '2024-01-11 10:00:45'),
(5, 7, 'N/A', 10000, 0, 2, 1, 19, 'P', 7, 'E', '2024-01-11', '2024-01-11 10:04:51'),
(6, 8, 'N/A', 4000, 0, 2, 1, 19, 'P', 1, 'E', '2024-01-11', '2024-01-11 11:53:08'),
(7, 9, 'N/A', 1000, 0, 2, 2, 20, 'P', 1, 'E', '2024-01-17', '2024-01-17 10:08:01'),
(8, 9, 'N/A', 1500, 0, 2, 2, 20, 'P', 2, 'E', '2024-01-17', '2024-01-17 10:08:41'),
(9, 9, 'N/A', 100000, 0, 2, 1, 20, 'P', 5, 'E', '2024-01-17', '2024-01-17 10:12:10'),
(10, 9, 'N/A', 500, 0, 2, 2, 20, 'P', 6, 'E', '2024-01-17', '2024-01-17 10:14:32'),
(11, 9, 'N/A', 10000, 0, 2, 2, 20, 'P', 7, 'E', '2024-01-17', '2024-01-17 10:16:26'),
(12, 9, 'N/A', 5000, 0, 2, 2, 19, 'P', 3, 'E', '2024-01-22', '2024-01-22 13:46:35'),
(13, 9, 'N/A', 2000, 0, 2, 1, 19, 'P', 3, 'E', '2024-01-28', '2024-01-28 08:11:08'),
(14, 7, 'N/A', 1000, 0, 2, 2, 19, 'P', 2, 'E', '2024-02-05', '2024-02-05 14:58:20'),
(15, 9, 'N/A', NULL, 0, 2, 2, 19, 'P', 2, 'E', '2024-02-05', '2024-02-05 15:10:17'),
(16, 9, 'N/A', 1000, 0, 2, 2, 19, 'P', 2, 'E', '2024-02-05', '2024-02-05 16:36:27'),
(17, 7, 'N/A', 500, 0, 2, 2, 19, 'P', 1, 'E', '2024-03-20', '2024-03-20 13:37:00'),
(18, 9, 'N/A', 500, 0, 2, 2, 19, 'P', 1, 'E', '2024-03-20', '2024-03-20 13:37:32'),
(19, 0, 'N/A', 0, 1000, 0, 0, 19, 'P', 2, 'S', '2024-03-24', '2024-03-24 14:01:37');

-- --------------------------------------------------------

--
-- Structure de la table `hospitalisation`
--

DROP TABLE IF EXISTS `hospitalisation`;
CREATE TABLE IF NOT EXISTS `hospitalisation` (
  `id_hosp` int(16) NOT NULL AUTO_INCREMENT,
  `ref_hosp` varchar(255) DEFAULT 'N/A',
  `id_service` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_nurse` int(16) DEFAULT '0',
  `chambre` varchar(255) DEFAULT 'N/A',
  `id_type_hosp` int(16) DEFAULT '0',
  `date_hosp` date DEFAULT NULL,
  `date_srt_hosp` date DEFAULT NULL,
  `nb_jour` int(16) DEFAULT '0',
  `lit` int(16) DEFAULT '0',
  `id_chambre` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  `etat` int(16) DEFAULT '0',
  PRIMARY KEY (`id_hosp`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `hospitalisation`
--

INSERT INTO `hospitalisation` (`id_hosp`, `ref_hosp`, `id_service`, `id_patient`, `id_medecin`, `id_nurse`, `chambre`, `id_type_hosp`, `date_hosp`, `date_srt_hosp`, `nb_jour`, `lit`, `id_chambre`, `open_close`, `etat`) VALUES
(1, 'HOSP_2024_01_11_1', 0, 1, 2, 2, 'Mens Ward', 1, '2024-01-11', '2024-01-13', 2, 22, 0, 0, 0),
(2, 'HOSP_2024_01_17_2', 0, 2, 2, 2, 'N/A', 1, '2024-01-17', '2024-01-19', 2, 0, 0, 0, 0),
(3, 'HOSP_2024_01_17_3', 0, 2, 2, 2, 'Vip Room 2', 2, '2024-01-17', '2024-01-19', 2, 55, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `laboratin`
--

DROP TABLE IF EXISTS `laboratin`;
CREATE TABLE IF NOT EXISTS `laboratin` (
  `id_laboratin` int(16) NOT NULL AUTO_INCREMENT,
  `nom_l` varchar(255) DEFAULT 'N/A',
  `type_l` char(5) DEFAULT 'N/A',
  `prenom_l` varchar(255) DEFAULT 'N/A',
  `user_l` varchar(255) DEFAULT 'N/A',
  `email_l` varchar(255) DEFAULT 'N/A',
  `id_depart` int(16) DEFAULT '0',
  `pass_l` varchar(255) DEFAULT '1234',
  `check_pass_l` varchar(255) DEFAULT 'N/A',
  `date_l` date DEFAULT NULL,
  `genre_l` varchar(2) DEFAULT NULL,
  `adress_l` varchar(255) DEFAULT 'N/A',
  `pays_l` varchar(255) DEFAULT 'N/A',
  `ville_l` varchar(255) DEFAULT 'N/A',
  `region_l` varchar(255) DEFAULT 'N/A',
  `code_l` varchar(255) DEFAULT 'N/A',
  `phone_l` varchar(255) DEFAULT 'N/A',
  `avatar_l` int(16) DEFAULT '0',
  `bio_l` varchar(255) DEFAULT 'N/A',
  `statut_l` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_laboratin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `laboratin`
--

INSERT INTO `laboratin` (`id_laboratin`, `nom_l`, `type_l`, `prenom_l`, `user_l`, `email_l`, `id_depart`, `pass_l`, `check_pass_l`, `date_l`, `genre_l`, `adress_l`, `pays_l`, `ville_l`, `region_l`, `code_l`, `phone_l`, `avatar_l`, `bio_l`, `statut_l`, `open_close`) VALUES
(1, 'NGOA MEYONG', 'N/A', 'Kizito', 'N/A', 'hosting@win-technology.net', 0, 'N/A', 'N/A', NULL, 'M', 'ELIG-ESSONO (MONTE HOTEL GRAND MOULIN', '0', 'YAOUNDE', 'N/A', 'N/A', '655010203', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `list_type_exa`
--

DROP TABLE IF EXISTS `list_type_exa`;
CREATE TABLE IF NOT EXISTS `list_type_exa` (
  `id_lte` int(16) NOT NULL AUTO_INCREMENT,
  `id_exa` int(16) DEFAULT '0',
  `ref_lte` varchar(255) DEFAULT 'N/A',
  `reduction` int(16) DEFAULT '0',
  `id_type_exa` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_lab` int(16) DEFAULT '0',
  `id_depart` int(16) DEFAULT '0',
  `qt_lte` int(32) DEFAULT '0',
  `date_lte` date DEFAULT NULL,
  `etat` int(11) DEFAULT '0',
  PRIMARY KEY (`id_lte`),
  KEY `id_patient` (`id_patient`),
  KEY `id_type_exa` (`id_type_exa`),
  KEY `id_medecin` (`id_medecin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lits`
--

DROP TABLE IF EXISTS `lits`;
CREATE TABLE IF NOT EXISTS `lits` (
  `id_lit` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `id_chambre` int(16) DEFAULT '0',
  `etat` int(5) DEFAULT '0',
  `date_fin` date DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_lit`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lits`
--

INSERT INTO `lits` (`id_lit`, `nom`, `id_chambre`, `etat`, `date_fin`, `open_close`) VALUES
(1, 'Aze', 0, 0, NULL, 1),
(2, 'Aze', 0, 0, NULL, 1),
(3, 'Aze', 0, 0, NULL, 1),
(4, '1', 0, 0, NULL, 1),
(5, '2', 0, 0, NULL, 1),
(6, '3', 0, 0, NULL, 1),
(7, '4', 0, 0, NULL, 0),
(8, '5', 0, 0, NULL, 0),
(9, '6', 0, 0, NULL, 0),
(10, '7', 0, 0, NULL, 1),
(11, '8', 0, 0, NULL, 1),
(12, '10', 0, 0, NULL, 1),
(13, '11', 0, 0, NULL, 1),
(14, '7', 0, 0, NULL, 0),
(15, '8', 0, 0, NULL, 0),
(16, '9', 0, 0, NULL, 0),
(17, '10', 0, 0, NULL, 1),
(18, '11', 0, 0, NULL, 1),
(19, '12', 0, 0, NULL, 1),
(20, 'Mens Ward 01     1er Lit', 0, 0, NULL, 1),
(21, 'Mens Ward 01   2e Lit', 0, 0, NULL, 1),
(22, 'Mens Ward 01  Lit No 3', 10, 1, '2024-01-13', 0),
(23, 'Mens Ward 01      Lit No 1', 10, 0, NULL, 0),
(24, 'Mens Ward 01 Lit No 4', 10, 0, '2023-02-20', 0),
(25, 'Mens Ward 01 Lit No 2', 10, 0, NULL, 0),
(26, 'Post Natal Ward 02 Lit No 1', 5, 0, NULL, 0),
(27, 'Post Natal Ward 02 Lit No 2', 5, 0, NULL, 0),
(28, 'Post Natal Ward 02 Lit No 3', 5, 0, NULL, 0),
(29, 'Post Natal Ward 02 Lit No 4', 5, 0, NULL, 0),
(30, 'Post Natal Ward 02 Lit No 5', 5, 0, NULL, 0),
(31, 'Post Natal Ward 02 Lit No 6', 5, 1, NULL, 0),
(32, 'Post Natal Ward 01 Lit No 1', 6, 0, NULL, 0),
(33, 'Post Natal Ward 01 Lit No 2', 6, 0, NULL, 0),
(34, 'Post Natal Ward 01 Lit No 3', 6, 0, NULL, 0),
(35, 'Post Natal Ward 01 Li No 4', 0, 0, NULL, 1),
(36, 'Post Natal Ward 01 Lit No 4', 6, 0, NULL, 0),
(37, 'Post Natal Ward 01 Lit No 5', 6, 0, NULL, 0),
(38, 'Post Natal Ward 01 Lit No 6', 6, 0, NULL, 0),
(39, 'Post Natal Ward 01 Lit No 7', 6, 0, NULL, 0),
(40, 'Post Natal Ward 01 Lit No 8', 6, 0, NULL, 0),
(41, 'Womens Ward 01 Lit No 1', 8, 0, NULL, 0),
(42, 'Womens Ward 01 Lit No 2', 8, 0, NULL, 0),
(43, 'Womens Ward 01 Lit No 3', 8, 0, NULL, 0),
(44, 'Womens Ward 01 Lit No 4', 8, 0, NULL, 0),
(45, 'Womens Ward 01 Lit No 5', 8, 0, NULL, 0),
(46, 'Womens Ward 01 Lit No 6', 8, 0, NULL, 0),
(47, 'Womens Ward 01 Lit No 7', 8, 0, NULL, 0),
(48, 'Womens Ward 01 Lit No 8', 8, 0, NULL, 0),
(49, 'Womens Ward 01 Li No 9', 8, 0, NULL, 0),
(50, 'Pediatric Ward 01 Lit No 1', 6, 0, NULL, 0),
(51, 'Pediatric Ward 01 Lit No 2', 6, 0, NULL, 0),
(52, 'Pediatric Ward 01 Lit No 3', 6, 0, NULL, 0),
(53, 'Pediatric Ward 01 Lit No 4', 6, 0, NULL, 0),
(54, 'Womens ward 01 lit no4', 0, 0, NULL, 1),
(55, '12', 17, 1, '2024-01-19', 0);

-- --------------------------------------------------------

--
-- Structure de la table `magasin`
--

DROP TABLE IF EXISTS `magasin`;
CREATE TABLE IF NOT EXISTS `magasin` (
  `id_mag` int(16) NOT NULL AUTO_INCREMENT,
  `ref_com` varchar(255) DEFAULT 'N/A',
  `id_four` int(16) DEFAULT '0',
  `id_medi` int(16) DEFAULT '0',
  `qt_com` int(32) DEFAULT '0',
  `prix_ht` int(32) DEFAULT '0',
  `date_c_com` date DEFAULT NULL,
  `date_l_com` date DEFAULT NULL,
  `date_r_com` date DEFAULT NULL,
  `etat` int(11) DEFAULT '0',
  `id_num_lot` varchar(255) DEFAULT 'N/A',
  `date_exp` date DEFAULT '0000-00-00',
  `date_fab` date DEFAULT '0000-00-00',
  PRIMARY KEY (`id_mag`),
  KEY `id_medi` (`id_medi`),
  KEY `id_four` (`id_four`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `magasin`
--

INSERT INTO `magasin` (`id_mag`, `ref_com`, `id_four`, `id_medi`, `qt_com`, `prix_ht`, `date_c_com`, `date_l_com`, `date_r_com`, `etat`, `id_num_lot`, `date_exp`, `date_fab`) VALUES
(2, '0008976_2024_03_16_11_18_50', 1, 4, 3, 0, '2024-03-16', '2024-03-16', '2024-03-16', 0, '9876879', '2024-03-05', '2024-04-04'),
(3, '4567_2024_03_18_22_12_46', 1, 20, 1, 0, '2024-03-18', '2024-03-18', '2024-03-18', 0, '45667', '2024-03-04', '2024-05-04'),
(4, '4543_2024_03_18_22_18_29', 1, 8, 3, 0, '2024-03-18', '2024-03-18', '2024-03-18', 0, '45667', '2024-02-27', '2024-04-04'),
(6, '0008976000_2024_03_18_22_45_47', 1, 23, 1, 0, '2024-03-18', '2024-03-18', '2024-03-18', 0, '879000', '2024-02-29', '2024-04-07'),
(7, '00089760666_2024_03_20_13_30_48', 1, 22, 1, 0, '2024-03-20', '2024-03-20', '2024-03-20', 0, '8790000', '2024-03-05', '2024-03-31'),
(8, '00089760666_2024_03_20_13_30_48', 1, 4, 1, 0, '2024-03-20', '2024-03-20', '2024-03-20', 0, '879001', '2024-02-27', '2024-03-31');

-- --------------------------------------------------------

--
-- Structure de la table `magasin_outil`
--

DROP TABLE IF EXISTS `magasin_outil`;
CREATE TABLE IF NOT EXISTS `magasin_outil` (
  `id_mag_outil` int(16) NOT NULL AUTO_INCREMENT,
  `ref_com_outil` varchar(255) DEFAULT 'N/A',
  `id_four` int(16) DEFAULT '0',
  `id_outil` int(16) DEFAULT '0',
  `qt_com_outil` int(32) DEFAULT '0',
  `prix_outil` int(32) DEFAULT '0',
  `date_c_com` date DEFAULT NULL,
  `date_l_com` date DEFAULT NULL,
  `date_r_com` date DEFAULT NULL,
  `etat` int(3) DEFAULT '0',
  `id_num_lot_outil` varchar(255) DEFAULT NULL,
  `date_exp` date DEFAULT NULL,
  `date_fab` date DEFAULT NULL,
  PRIMARY KEY (`id_mag_outil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id_medecin` int(16) NOT NULL AUTO_INCREMENT,
  `nom_m` varchar(255) DEFAULT 'N/A',
  `prenom_m` varchar(255) DEFAULT 'N/A',
  `user_m` varchar(255) DEFAULT 'N/A',
  `email_m` varchar(255) DEFAULT 'N/A',
  `id_spe` int(16) DEFAULT '0',
  `type_m` char(5) DEFAULT 'N/A',
  `pass_m` varchar(255) DEFAULT '1234',
  `check_pass_m` varchar(255) DEFAULT 'N/A',
  `date_m` date DEFAULT NULL,
  `genre_m` varchar(2) DEFAULT NULL,
  `adress_m` varchar(255) DEFAULT 'N/A',
  `pays_m` int(16) DEFAULT '0',
  `ville_m` varchar(255) DEFAULT 'N/A',
  `region_m` varchar(255) DEFAULT 'N/A',
  `code_m` varchar(255) DEFAULT 'N/A',
  `phone_m` varchar(255) DEFAULT 'N/A',
  `avatar_m` int(16) DEFAULT '0',
  `bio_m` varchar(255) DEFAULT 'N/A',
  `statut_m` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_medecin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id_medecin`, `nom_m`, `prenom_m`, `user_m`, `email_m`, `id_spe`, `type_m`, `pass_m`, `check_pass_m`, `date_m`, `genre_m`, `adress_m`, `pays_m`, `ville_m`, `region_m`, `code_m`, `phone_m`, `avatar_m`, `bio_m`, `statut_m`, `open_close`) VALUES
(1, 'NGOA MEYONG', 'Kizito', 'N/A', 'hosting@win-technology.net', 0, 'E', NULL, 'N/A', NULL, 'M', 'ELIG-ESSONO (MONTE HOTEL GRAND MOULIN', 0, 'YAOUNDE', 'N/A', 'N/A', '655010203', 0, '', 0, 1),
(2, 'NGOA MEYONG', 'Kizito', 'N/A', 'hosting@win-technology.net', 0, 'N/A', NULL, 'N/A', NULL, 'M', 'ELIG-ESSONO (MONTE HOTEL GRAND MOULIN', 0, 'YAOUNDE', 'N/A', 'N/A', '655010203', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

DROP TABLE IF EXISTS `medicament`;
CREATE TABLE IF NOT EXISTS `medicament` (
  `id_medi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_medi` varchar(255) DEFAULT 'N/A',
  `nom_medi` varchar(255) DEFAULT 'N/A',
  `id_type_medi` int(16) DEFAULT '0',
  `quantite` int(32) DEFAULT '0',
  `date_medi` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT 'N/A',
  `date_medi_os` date DEFAULT NULL,
  `prix_unitaire` int(32) DEFAULT '0',
  `prix_u_v` int(32) DEFAULT '0',
  `id_four` int(16) DEFAULT '0',
  `alert_prod` int(32) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_medi`),
  KEY `id_type_medi` (`id_type_medi`)
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`id_medi`, `ref_medi`, `nom_medi`, `id_type_medi`, `quantite`, `date_medi`, `date_fin`, `obs`, `date_medi_os`, `prix_unitaire`, `prix_u_v`, `id_four`, `alert_prod`, `open_close`) VALUES
(4, 'M_2023_01_28_00004', 'Aciclovir 200mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 600, 1, 50, 1),
(5, 'M_2023_01_28_00005', 'Adrenaline 1mg/ml inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 200, 500, 0, 0, 0),
(6, 'M_2023_01_28_00006', 'Albendazole 400mg  S/1', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 75, 500, 0, 0, 0),
(7, 'M_2023_01_28_00007', 'Albendazole 4% f/10ml Syrup', 6, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 300, 1000, 0, 0, 0),
(8, 'M_2023_01_28_00008', 'Alcohol 100ml', 7, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 150, 500, 0, 0, 0),
(9, 'M_2023_01_28_00009', 'Aluminum Hydroxide 500mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 200, 0, 0, 0),
(10, 'M_2023_01_28_00010', 'Ambroxol 30mg S/20', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 2000, 0, 0, 0),
(11, 'M_2023_01_28_00011', 'Aminophyline 100g S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 150, 0, 0, 0),
(12, 'M_2023_01_28_00012', 'Aminophyline 250mg/10ml', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 250, 700, 0, 0, 0),
(13, 'M_2023_01_28_00013', 'Amitriptyline25mg B/10 (Elavil)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 397, 750, 0, 0, 0),
(14, 'M_2023_01_28_00014', 'Amlostar-10(Amlodipine)B/30', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 3013, 5500, 0, 0, 0),
(15, 'M_2023_01_28_00015', 'Amoxicillin 250mg/5ml. 100ml', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 475, 1500, 0, 0, 0),
(16, 'M_2023_01_28_00016', 'Amoxicillin 500mg   S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 280, 1000, 0, 0, 0),
(17, 'M_2023_01_28_00017', 'Amoxiclav 1G (CLAVICIN Xr, fleming,  ) B/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 2936, 4000, 0, 0, 0),
(18, 'M_2023_01_28_00018', 'Ampicillin 1g inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 130, 800, 0, 0, 0),
(19, 'M_2023_01_28_00019', 'Anomex suppo B/10', 9, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 3449, 5000, 0, 0, 0),
(20, 'M_2023_01_28_00020', 'Antiscabies ointment', 10, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 250, 1200, 0, 0, 0),
(21, 'M_2023_01_28_00021', 'Antitetanus serum inj (ATS)', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 500, 1200, 0, 0, 0),
(22, 'M_2023_01_28_00022', 'Artefan 20/120mg B/6', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 888, 1500, 0, 0, 0),
(23, 'M_2023_01_28_00023', 'Artefan 40/240  B/6', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1295, 2300, 0, 0, 0),
(24, 'M_2023_01_28_00024', 'Artefan 60/360 b B/6', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1726, 2400, 0, 0, 0),
(25, 'M_2023_01_28_00025', 'Artefan 80/480 B/6 (BIMALARIL)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 2133, 3000, 0, 0, 0),
(26, 'M_2023_01_28_00026', 'Artefan syrop 60ml (co-artessian)', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1726, 2500, 0, 0, 0),
(27, 'M_2023_01_28_00027', 'Artemether 40mg inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 500, 0, 0, 0),
(28, 'M_2023_01_28_00028', 'Artemether 80mg inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 60, 750, 0, 0, 0),
(29, 'M_2023_01_28_00029', 'Artesunate 120mg inj', 12, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1500, 2500, 0, 0, 0),
(30, 'M_2023_01_28_00030', 'Artesunate 60mg inj', 12, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 900, 1500, 0, 0, 0),
(31, 'M_2023_01_28_00031', 'Aspergic 1.8g inj', 12, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 800, 0, 0, 0),
(32, 'M_2023_01_28_00032', 'Aspirin 100mg B/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 150, 0, 0, 0),
(33, 'M_2023_01_28_00033', 'Aspirin 500mg tab B/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 150, 0, 0, 0),
(34, 'M_2023_01_28_00034', 'Atenolol  50mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 500, 0, 0, 0),
(35, 'M_2023_01_28_00035', 'Atropine 1mg/1ml', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 175, 600, 0, 0, 0),
(36, 'M_2023_01_28_00036', 'Augmentin(SAPHIR enfant) 100mg/12.5mg/ml  30ml', 13, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 4500, 0, 0, 0),
(37, 'M_2023_01_28_00037', 'Amoxiclav syrup (TICASE) 200mg/28mg/5ml 70', 13, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1713, 2500, 0, 0, 0),
(38, 'M_2023_01_28_00038', 'Amoxiclav syrup (TICASSE 400/57MG/5ML) ', 13, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 3002, 4100, 0, 0, 0),
(39, 'M_2023_01_28_00039', 'Azithromycin 250mg B/6', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1964, 3000, 0, 0, 0),
(40, 'M_2023_01_28_00040', 'Azithromycin 500mg b/3', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 2396, 4000, 0, 0, 0),
(41, 'M_2023_01_28_00041', 'AZITHROMYCIN 250MG B/6 (GENERIC)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 1500, 0, 0, 0),
(42, 'M_2023_01_28_00042', 'Bactine max (lidocaine spray)', 7, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 2500, 0, 0, 0),
(43, 'M_2023_01_28_00043', 'Balsam babies skin oil', 10, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 700, 1500, 0, 0, 0),
(44, 'M_2023_01_28_00044', 'Balsam Menthol', 10, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 75, 200, 0, 0, 0),
(45, 'M_2023_01_28_00045', 'Balsam Robb', 10, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 800, 2000, 0, 0, 0),
(46, 'M_2023_01_28_00046', 'Bandage ', 15, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 250, 500, 0, 0, 0),
(47, 'M_2023_01_28_00047', 'Benzathine 2.4mu inj', 12, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 280, 1500, 0, 0, 0),
(48, 'M_2023_01_28_00048', 'Benzyl Benzoate 125ml', 10, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 350, 1000, 0, 0, 0),
(49, 'M_2023_01_28_00049', 'Betazidime 1g inj', 12, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 9500, 0, 0, 0),
(50, 'M_2023_01_28_00050', ' Bicarbonate ', 16, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 200, 0, 0, 0),
(51, 'M_2023_01_28_00051', 'Biscadyl 5mg  S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 50, 300, 0, 0, 0),
(52, 'M_2023_01_28_00052', 'Blood bag', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1300, 2000, 0, 0, 0),
(53, 'M_2023_01_28_00053', 'Blood giving set', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 150, 500, 0, 0, 0),
(54, 'M_2023_01_28_00054', 'Calamine Lotion 100ml', 39, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 800, 1500, 0, 0, 0),
(55, 'M_2023_01_28_00055', 'Calcimax syrop', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 3000, 0, 0, 0),
(56, 'M_2023_01_28_00056', 'Calcium gluconate inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 130, 500, 0, 0, 0),
(57, 'M_2023_01_28_00057', 'Calcium lactate  300mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 40, 300, 0, 0, 0),
(58, 'M_2023_01_28_00058', 'Camphor cream 10%   100g', 18, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 2000, 0, 0, 0),
(59, 'M_2023_01_28_00059', 'Cannula G18', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 100, 500, 0, 0, 0),
(60, 'M_2023_01_28_00060', 'Cannula G20', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 100, 500, 0, 0, 0),
(61, 'M_2023_01_28_00061', 'Cannula G22', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 100, 500, 0, 0, 0),
(62, 'M_2023_01_28_00062', 'Cannula G24', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 100, 500, 0, 0, 0),
(63, 'M_2023_01_28_00063', 'Captopril 25mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 75, 500, 0, 0, 0),
(64, 'M_2023_01_28_00064', 'Carbocysteine 2%', 19, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 550, 1300, 0, 0, 0),
(65, 'M_2023_01_28_00065', 'Carbocysteine 5%', 19, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 650, 1500, 0, 0, 0),
(66, 'M_2023_01_28_00066', 'Cefaloral 200mg tab b/10 (cefixime )', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 2153, 4000, 0, 0, 0),
(67, 'M_2023_01_28_00067', 'Cefixime 100mg/5ml Syrup (Bactoxime) B/60cc ', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1800, 3500, 0, 0, 0),
(68, 'M_2023_01_28_00068', 'Cefotaxime 1g inject ', 20, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1000, 3000, 0, 0, 0),
(69, 'M_2023_01_28_00069', 'Ceftriazone 1g inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 250, 1300, 0, 0, 0),
(70, 'M_2023_01_28_00070', 'Cetirizine Sp (Benadryl) 1mg/ml', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 2000, 0, 0, 0),
(71, 'M_2023_01_28_00071', 'Celecoxib 200mg (EXXIB) B/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1723, 2500, 0, 0, 0),
(72, 'M_2023_01_28_00072', 'Chlorpheniramine (piriton) 4mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 15, 100, 0, 0, 0),
(73, 'M_2023_01_28_00073', 'Cimetidine 200mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 500, 0, 0, 0),
(74, 'M_2023_01_28_00074', 'Cimetidine inj 200mg/2ml', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 40, 500, 0, 0, 0),
(75, 'M_2023_01_28_00075', 'Ciprofloxacin 500mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 450, 1500, 0, 0, 0),
(76, 'M_2023_01_28_00076', 'Ciprofloxacine 750mg b/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1000, 2000, 0, 0, 0),
(77, 'M_2023_01_28_00077', 'Clarithromycin 500mg b/10 (CLARICIN)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 3849, 5500, 0, 0, 0),
(78, 'M_2023_01_28_00078', 'Clarithromycin 500mg b/14 ( CLARIVA)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 6500, 0, 0, 0),
(79, 'M_2023_01_28_00079', 'Clavicin 1g/200mg inj (Amoxiclav inject)', 12, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1533, 2300, 0, 0, 0),
(80, 'M_2023_01_28_00080', 'Clotrimazole Cream 30g (CANDID CREAM)', 18, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1140, 1600, 0, 0, 0),
(81, 'M_2023_01_28_00081', 'Cloxacillin 250mg/5ml', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 750, 2500, 0, 0, 0),
(82, 'M_2023_01_28_00082', 'Cloxacillin 500mg  S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 450, 1000, 0, 0, 0),
(83, 'M_2023_01_28_00083', 'Cloxacillin 500mg inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 130, 500, 0, 0, 0),
(84, 'M_2023_01_28_00084', 'Coamox syrop 400mg/57mg  70ml', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 4500, 0, 0, 0),
(85, 'M_2023_01_28_00085', 'CORD CLAMP B/1', 21, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 75, 500, 0, 0, 0),
(86, 'M_2023_01_28_00086', 'Cotrimoxazole 240mg/5ml', 19, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 650, 1200, 0, 0, 0),
(87, 'M_2023_01_28_00087', 'Cotrimoxazole(Bactrim)480mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 120, 300, 0, 0, 0),
(88, 'M_2023_01_28_00088', 'Cromsol eye drop(Na cromoglicate', 22, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 675, 1300, 0, 0, 0),
(89, 'M_2023_01_28_00089', 'Cyteal', 7, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 2300, 3200, 0, 0, 0),
(90, 'M_2023_01_28_00090', 'Cytotec 200mcg  S/1', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 375, 1000, 0, 0, 0),
(91, 'M_2023_01_28_00091', 'Depo-provera 150mg inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 250, 1000, 0, 0, 0),
(92, 'M_2023_01_28_00092', 'Dexamethazone 0.4mg/ml inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 40, 500, 0, 0, 0),
(93, 'M_2023_01_28_00093', 'Dexamethazone 0.5mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 20, 500, 0, 0, 0),
(94, 'M_2023_01_28_00094', 'Diazapam 10mg/2ml inj  (VALIUM)', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 150, 1000, 0, 0, 0),
(95, 'M_2023_01_28_00095', 'Diazapam 5mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 100, 300, 0, 0, 0),
(96, 'M_2023_01_28_00096', 'Diclofenac 50mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 80, 200, 0, 0, 0),
(97, 'M_2023_01_28_00097', 'Diclofenac 75mg/3ml inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 40, 500, 0, 0, 0),
(98, 'M_2023_01_28_00098', 'DICLOFENAC EYE DROP (DIFINASOL)', 22, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 675, 1300, 0, 0, 0),
(99, 'M_2023_01_28_00099', 'Diclofenac cream 1%(VOLTARENE, LEORUP)', 10, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1063, 2000, 0, 0, 0),
(100, 'M_2023_01_28_00100', 'DISTEM (Para+methocarbamol) B/50', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 2779, 4000, 0, 0, 0),
(101, 'M_2023_01_28_00101', 'Doxycycline 100mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 120, 500, 0, 0, 0),
(102, 'M_2023_01_28_00102', 'Dripset', 18, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 100, 300, 0, 0, 0),
(103, 'M_2023_01_28_00103', 'Emtrisil 200ml (ANTICID, VISCID SUSPENS)', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1450, 2500, 0, 0, 0),
(104, 'M_2023_01_28_00104', 'Emzolyn (adult cough syrup)', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 600, 1200, 0, 0, 0),
(105, 'M_2023_01_28_00105', 'Emzolyn enfant   100ml', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 600, 1200, 0, 0, 0),
(106, 'M_2023_01_28_00106', 'Eosine solution 20ml', 23, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 700, 0, 0, 0),
(107, 'M_2023_01_28_00107', 'Ergometrine 0.2mg   S/9  (LERIN)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 720, 1000, 0, 0, 0),
(108, 'M_2023_01_28_00108', 'Ergometrine 0.2mg inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 132, 600, 0, 0, 0),
(109, 'M_2023_01_28_00109', 'Erythromycin 125mg/5ml', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 450, 1500, 0, 0, 0),
(110, 'M_2023_01_28_00110', 'Erythromycine 500mg  S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 300, 900, 0, 0, 0),
(111, 'M_2023_01_28_00111', 'Fansidar s/3 (GENERIC)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 300, 0, 0, 0),
(112, 'M_2023_01_28_00112', 'Fasidar  S/3 (SWAIDAR)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 500, 3850, 0, 0, 0),
(113, 'M_2023_01_28_00113', 'FAYTEX B/1', 24, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 460, 650, 0, 0, 0),
(114, 'M_2023_01_28_00114', 'Ferous + Folic Acid S/10 (FEFOL)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 75, 250, 0, 0, 0),
(115, 'M_2023_01_28_00115', 'Ferrous + folic syrup (APFER)', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1002, 1700, 0, 0, 0),
(116, 'M_2023_01_28_00116', 'Floxsol (Norfloxacine) ', 22, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 675, 1300, 0, 0, 0),
(117, 'M_2023_01_28_00117', 'Flucazol 50mg/5ml', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1716, 2300, 0, 0, 0),
(118, 'M_2023_01_28_00118', 'Fluconazole 150mg b/2 (FLUZON)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 2500, 0, 0, 0),
(119, 'M_2023_01_28_00119', 'Fluconazole 100mg (FLUCAZOL)  b/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1548, 2100, 0, 0, 0),
(120, 'M_2023_01_28_00120', 'Folic acid 5mg', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 70, 200, 0, 0, 0),
(121, 'M_2023_01_28_00121', 'Furosemide 20mg/2ml inj  (lasix)', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 92, 800, 0, 0, 0),
(122, 'M_2023_01_28_00122', 'Furosemide 40mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 200, 0, 0, 0),
(123, 'M_2023_01_28_00123', 'Geloplasma drip', 25, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 3400, 6000, 0, 0, 0),
(124, 'M_2023_01_28_00124', 'Gentamycin 80mg/2ml inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 40, 400, 0, 0, 0),
(125, 'M_2023_01_28_00125', 'Gentamycin eye drop', 26, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 300, 500, 0, 0, 0),
(126, 'M_2023_01_28_00126', 'Glibenclamide 5mg (daonil) S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 100, 500, 0, 0, 0),
(127, 'M_2023_01_28_00127', 'Glove (sterile)', 27, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 150, 400, 0, 0, 0),
(128, 'M_2023_01_28_00128', 'Gloves (non-sterile)', 27, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 50, 100, 0, 0, 0),
(129, 'M_2023_01_28_00129', 'Glucose 10%  500 / 250ml', 28, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 400, 1000, 0, 0, 0),
(130, 'M_2023_01_28_00130', 'Glucose 5%  500  /  250 ml', 28, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 400, 1000, 0, 0, 0),
(131, 'M_2023_01_28_00131', 'Glucose normal saline 0.9% 500ml', 28, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 400, 1000, 0, 0, 0),
(132, 'M_2023_01_28_00132', 'Grippe water (pinkoo)', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1700, 2600, 0, 0, 0),
(133, 'M_2023_01_28_00133', 'Griseofulvin  500mg  S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 650, 1000, 0, 0, 0),
(134, 'M_2023_01_28_00134', 'Gynanfort Ovules b/10', 29, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1859, 2600, 0, 0, 0),
(135, 'M_2023_01_28_00135', 'Gynospan suppo b/10', 9, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1379, 2200, 0, 0, 0),
(136, 'M_2023_01_28_00136', 'Haemup inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1030, 1500, 0, 0, 0),
(137, 'M_2023_01_28_00137', 'Hydrochlorothiazide(HCTZ) 50mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 90, 500, 0, 0, 0),
(138, 'M_2023_01_28_00138', 'Hyoscine 20mg/2ml inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 184, 1000, 0, 0, 0),
(139, 'M_2023_01_28_00139', 'Hyoscine(Buscopan) 10mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 150, 600, 0, 0, 0),
(140, 'M_2023_01_28_00140', 'Ibuprofen 100mg/5ml', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 650, 1500, 0, 0, 0),
(141, 'M_2023_01_28_00141', 'Ibuprofen 400 mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 112, 300, 0, 0, 0),
(142, 'M_2023_01_28_00142', 'Ibuprofen/paracet100/125MG/5ML(BUPADOL)', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 550, 2000, 0, 0, 0),
(143, 'M_2023_01_28_00143', 'Ketoconazole (Nizoral) 200mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 750, 0, 0, 0),
(144, 'M_2023_01_28_00144', 'Ketoprofen 100mg suppo b/10', 9, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1111, 2000, 0, 0, 0),
(145, 'M_2023_01_28_00145', 'Ketoprofen 100mg tab b/30', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1083, 2000, 0, 0, 0),
(146, 'M_2023_01_28_00146', 'Laxmag sachet b/10', 16, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 4300, 0, 0, 0),
(147, 'M_2023_01_28_00147', 'Lidocaine 1 to 2%  2ml', 20, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 48, 500, 0, 0, 0),
(148, 'M_2023_01_28_00148', 'Litacold Sp 100ml (FRIBELLEX/ SUDEX)', 6, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1023, 1700, 0, 0, 0),
(149, 'M_2023_01_28_00149', 'Litacold tab S/4 (NEUTROCOLD )', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 170, 300, 0, 0, 0),
(150, 'M_2023_01_28_00150', 'L-Mesitran 15G', 10, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1567, 2500, 0, 0, 0),
(151, 'M_2023_01_28_00151', 'Loperamide(Imodium) 2mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 30, 500, 0, 0, 0),
(152, 'M_2023_01_28_00152', 'Loratadine 10mg B/10(LORATOL)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1716, 2300, 0, 0, 0),
(153, 'M_2023_01_28_00153', 'Loratadine suspension (LORHIST) FL/30ML', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 895, 1300, 0, 0, 0),
(154, 'M_2023_01_28_00154', 'Lotronex (alosetron Hcl) 1mg ', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 2500, 0, 0, 0),
(155, 'M_2023_01_28_00155', 'Loxen  inj (NICARDIPINE)', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1200, 2000, 0, 0, 0),
(156, 'M_2023_01_28_00156', 'Magnesium Sulphate 15% Inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 337, 1200, 0, 0, 0),
(157, 'M_2023_01_28_00157', 'Malacur 20/160mg tab b/6', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1534, 2200, 0, 0, 0),
(158, 'M_2023_01_28_00158', 'Malacur 40/320mg tablet b/12 (RIDMAL)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 2385, 3300, 0, 0, 0),
(159, 'M_2023_01_28_00159', 'Maxidrol (dexa+neo+polym)', 22, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1171, 1700, 0, 0, 0),
(160, 'M_2023_01_28_00160', 'Mebendazole  500mg S/1', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 200, 0, 0, 0),
(161, 'M_2023_01_28_00161', 'Mebendazole 100mg S/6', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 25, 200, 0, 0, 0),
(162, 'M_2023_01_28_00162', 'Mebendazole 100mg/5ml', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 300, 1000, 0, 0, 0),
(163, 'M_2023_01_28_00163', 'MIFESO ( Mifepristone 200umg) b/1', 12, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 375, 1000, 0, 0, 0),
(164, 'M_2023_01_28_00164', 'Mesporin 1000mg inj', 12, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 5000, 0, 0, 0),
(165, 'M_2023_01_28_00165', 'Metamizole 500mg/ml/5ml inj (ANALGIN)', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 80, 700, 0, 0, 0),
(166, 'M_2023_01_28_00166', 'Metformin 500mg  S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 140, 500, 0, 0, 0),
(167, 'M_2023_01_28_00167', 'Methyldopa(aldomet) 250mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 130, 500, 0, 0, 0),
(168, 'M_2023_01_28_00168', 'Metoclopramide inj 10mg/2ml', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 250, 700, 0, 0, 0),
(169, 'M_2023_01_28_00169', 'Metoclopramide tab 10mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 65, 300, 0, 0, 0),
(170, 'M_2023_01_28_00170', 'Metronidazole 125mg/5ml 100ml', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 450, 1200, 0, 0, 0),
(171, 'M_2023_01_28_00171', 'Metronidazole 500mg S/10  (flagyl)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 140, 500, 0, 0, 0),
(172, 'M_2023_01_28_00172', 'Metronidazole Ovules 500mg S/10', 29, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 1000, 0, 0, 0),
(173, 'M_2023_01_28_00173', 'Metronidazole perf 500mg/100ml', 28, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 450, 1300, 0, 0, 0),
(174, 'M_2023_01_28_00174', 'MIOREL 4mg (Thiocothicoside) B/12', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1996, 2700, 0, 0, 0),
(175, 'M_2023_01_28_00175', 'Multivitamine syrup (APVIT)', 19, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 650, 1200, 0, 0, 0),
(176, 'M_2023_01_28_00176', 'Mutivitamine Tablet S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 100, 200, 0, 0, 0),
(177, 'M_2023_01_28_00177', 'Mutivitamine Tablet S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 100, 200, 0, 0, 0),
(178, 'M_2023_01_28_00178', 'Nasogastric NGT ', 18, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 450, 1000, 0, 0, 0),
(179, 'M_2023_01_28_00179', 'Nasonex (mometasone furate, nasal spray)', 7, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 0, 3000, 0, 0, 0),
(180, 'M_2023_01_28_00180', 'Neomycin/Bacitracin ointment 15g (Baneocin)', 18, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 1119, 2000, 0, 0, 0),
(181, 'M_2023_01_28_00181', 'Nifedipine 20mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 80, 400, 0, 0, 0),
(182, 'M_2023_01_28_00182', 'Neomycin 15g', 18, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-17', 390, 2000, 0, 0, 0),
(183, 'M_2023_01_28_00183', 'http://hope.clinic.syges.cm/index.php', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 500, 0, 0, 0),
(184, 'M_2023_01_28_00184', 'Normal saline 500ml', 28, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 400, 1000, 0, 0, 0),
(185, 'M_2023_01_28_00185', 'Nucleo Cmp Fort', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 3955, 5500, 0, 0, 0),
(186, 'M_2023_01_28_00186', 'Nystatine 100,000 in Syrup', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 650, 1200, 0, 0, 0),
(187, 'M_2023_01_28_00187', 'Nystatine 500,000 iu S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 450, 1000, 0, 0, 0),
(188, 'M_2023_01_28_00188', 'Nystatine Ovules S/10', 29, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 250, 1000, 0, 0, 0),
(189, 'M_2023_01_28_00189', 'Ofloxacin 200mg tab b/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 2500, 2892, 0, 0, 0),
(190, 'M_2023_01_28_00190', 'Omeprazole  40mg inj (gaspral)', 20, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1983, 2700, 0, 0, 0),
(191, 'M_2023_01_28_00191', 'Omeprazole 20mg S/10', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 180, 1000, 0, 0, 0),
(192, 'M_2023_01_28_00192', 'Omeprazole 20mg S/10', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 180, 1000, 0, 0, 0),
(193, 'M_2023_01_28_00193', 'Omeprazole 40mg/bicarbonate 1860mg', 16, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 4000, 0, 0, 0),
(194, 'M_2023_01_28_00194', 'Oral rehydration sait plus zinc tabs b/1', 16, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 650, 800, 0, 0, 0),
(195, 'M_2023_01_28_00195', 'Oral Rehydration salt (ORS) S/2', 16, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 400, 0, 0, 0),
(196, 'M_2023_01_28_00196', 'Oxytocin injection 10 IU', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 60, 800, 0, 0, 0),
(197, 'M_2023_01_28_00197', 'Pantoprazole +Domperidone 40/30mg b/10 (CIELPRAZ-D)', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 2500, 0, 0, 0),
(198, 'M_2023_01_28_00198', 'Pantoprazole +Domperidone 40/30mg b/30 (Pandom D)', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 3856, 5200, 0, 0, 0),
(199, 'M_2023_01_28_00199', 'Paracetamol 500mg S/10 (PCM)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 55, 150, 0, 0, 0),
(200, 'M_2023_01_28_00200', 'Paracetamol 1g effervescent (APRAMOL) B/10', 30, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 832, 1200, 0, 0, 0),
(201, 'M_2023_01_28_00201', 'Paracetamol suppo 100mg (DOLIPRANE)', 9, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 78, 150, 0, 0, 0),
(202, 'M_2023_01_28_00202', 'Paracetamol suppo 250mg', 9, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 150, 0, 0, 0),
(203, 'M_2023_01_28_00203', 'Paracetamol Syrop120mg 100ml (PANADOL)', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 475, 1500, 0, 0, 0),
(204, 'M_2023_01_28_00204', 'Penicillin G sodium inj 5 mega', 12, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 240, 1000, 0, 0, 0),
(205, 'M_2023_01_28_00205', 'Penicillin v 250mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 90, 300, 0, 0, 0),
(206, 'M_2023_01_28_00206', 'Permanganate 500mg S/1', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 50, 150, 0, 0, 0),
(207, 'M_2023_01_28_00207', 'Phenobarbital 200mg/2ml inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 600, 1000, 0, 0, 0),
(208, 'M_2023_01_28_00208', 'Plaster roll 10cm/5m', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 90, 200, 0, 0, 0),
(209, 'M_2023_01_28_00209', 'Positon cream (neo+nysta+triamcinolone) 30g', 10, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1996, 3000, 0, 0, 0),
(210, 'M_2023_01_28_00210', 'Potassium 1g/10ml inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 172, 500, 0, 0, 0),
(211, 'M_2023_01_28_00211', 'Prednesolone 5mg', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 171, 250, 0, 0, 0),
(212, 'M_2023_01_28_00212', 'Primalan sp', 6, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1358, 1800, 0, 0, 0),
(213, 'M_2023_01_28_00213', 'Proguanil (paludrine) 100mg S/15', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 200, 600, 0, 0, 0),
(214, 'M_2023_01_28_00214', 'Quinine 600 mg inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 150, 600, 0, 0, 0),
(215, 'M_2023_01_28_00215', 'Quinine Sulphate 300 mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 380, 700, 0, 0, 0),
(216, 'M_2023_01_28_00216', 'Quinine Syrup', 8, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 900, 1500, 0, 0, 0),
(217, 'M_2023_01_28_00217', 'Ranitidine tabs. 150mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 500, 0, 0, 0),
(218, 'M_2023_01_28_00218', 'RENERVE PLUS CAPSULE B/30', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 4850, 6500, 0, 0, 0),
(219, 'M_2023_01_28_00219', 'Revital B/30', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 3027, 4100, 0, 0, 0),
(220, 'M_2023_01_28_00220', 'Revitalose buvable (A+B)', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 3358, 4700, 0, 0, 0),
(221, 'M_2023_01_28_00221', 'Pserent (Psoriasis Topical Solution) 95ml', 7, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 2500, 0, 0, 0),
(222, 'M_2023_01_28_00222', 'Ringer lactate 500ml', 25, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 400, 1000, 0, 0, 0),
(223, 'M_2023_01_28_00223', 'Salbutamol 0.5mg/1ml inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 200, 600, 0, 0, 0),
(224, 'M_2023_01_28_00224', 'Salbutamol 4mg S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 150, 0, 0, 0),
(225, 'M_2023_01_28_00225', 'Salbutamol inhaler (VENTOLINE  SPRAY)', 40, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 2313, 3000, 0, 0, 0),
(226, 'M_2023_01_28_00226', 'Salbutamol sp', 6, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 990, 1500, 0, 0, 0),
(227, 'M_2023_01_28_00227', 'Scalp vein set 23g', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 35, 100, 0, 0, 0),
(228, 'M_2023_01_28_00228', 'Scalp vein set 25g', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 35, 100, 0, 0, 0),
(230, 'M_2023_01_28_00230', 'Sekrol 15mg/5cc (Ambroxol) syrp', 6, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1623, 2300, 0, 0, 0),
(231, 'M_2023_01_28_00231', 'Shea butter body balm (LPM)', 6, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 2057, 3000, 0, 0, 0),
(232, 'M_2023_01_28_00232', 'Sitrus SR  (vitamin c, zinc, selenium) b/30', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 3000, 0, 0, 0),
(233, 'M_2023_01_28_00233', 'Sodium 10% inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 160, 600, 0, 0, 0),
(234, 'M_2023_01_28_00234', 'Spasfon inj (GYNOSPAN)', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 324, 600, 0, 0, 0),
(235, 'M_2023_01_28_00235', 'Spasfon suppo B/10 (GYNOSPAN)', 9, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1456, 2000, 0, 0, 0),
(236, 'M_2023_01_28_00236', 'SPASMAG D. AMPULSE B/30 (magnesium)', 32, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 4200, 0, 0, 0),
(237, 'M_2023_01_28_00237', 'Spasmag Capsules b/60 (magnesium )', 14, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 3000, 0, 0, 0),
(238, 'M_2023_01_28_00238', 'Spasmol apotel suppo (para+buscopan)', 9, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 1600, 0, 0, 0),
(239, 'M_2023_01_28_00239', 'Spasmotroy 40mg/2ml (drotaverine)', 20, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 800, 0, 0, 0),
(240, 'M_2023_01_28_00240', 'SECNIDAZOLE 1G B/2 (STAGYL)', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1089, 1500, 0, 0, 0),
(241, 'M_2023_01_28_00241', 'Sterile water', 12, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 50, 100, 0, 0, 0),
(242, 'M_2023_01_28_00242', 'Stiton 9 f/200ml', 7, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 2215, 3000, 0, 0, 0),
(243, 'M_2023_01_28_00243', 'Surgical blade', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 50, 250, 0, 0, 0),
(244, 'M_2023_01_28_00244', 'Sutures', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 750, 2000, 0, 0, 0),
(245, 'M_2023_01_28_00245', 'Syringe 10ml', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 35, 100, 0, 0, 0),
(246, 'M_2023_01_28_00246', 'Syringe 20ml', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 200, 0, 0, 0),
(247, 'M_2023_01_28_00247', 'Syringe 1ml (INSULIN SYRINGE)', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 28, 100, 0, 0, 0),
(248, 'M_2023_01_28_00248', 'Syringe 2ml /3ml', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 30, 100, 0, 0, 0),
(249, 'M_2023_01_28_00249', 'Syringe 5ml', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 32, 100, 0, 0, 0),
(250, 'M_2023_01_28_00250', 'Thermometer', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 550, 800, 0, 0, 0),
(251, 'M_2023_01_28_00251', 'Tinidazol 500mg B/4 (AMTIBA)', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 618, 1200, 0, 0, 0),
(252, 'M_2023_01_28_00252', 'Tothema', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 3312, 4500, 0, 0, 0),
(253, 'M_2023_01_28_00253', 'TRAMACETAL (Tramadol+para) B/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1356, 2500, 0, 0, 0),
(254, 'M_2023_01_28_00254', 'Tramadol inj 100mg/2ml', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 389, 1000, 0, 0, 0),
(255, 'M_2023_01_28_00255', 'Tramadol DENK tab 50mg  b/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1194, 2500, 0, 0, 0),
(256, 'M_2023_01_28_00256', 'Triamsinolone 40mg/ml inj (KENACOT) ', 20, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 856, 1000, 0, 0, 0),
(257, 'M_2023_01_28_00257', 'Tsori balsam(massage oil)', 34, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1000, 2000, 0, 0, 0),
(258, 'M_2023_01_28_00258', 'Tsori lotion', 7, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 800, 2000, 0, 0, 0),
(259, 'M_2023_01_28_00259', 'Tsori soap (medicated soap)', 33, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1000, 2000, 0, 0, 0),
(260, 'M_2023_01_28_00260', 'Vagimilt ovule b/7', 29, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 2161, 3000, 0, 0, 0),
(261, 'M_2023_01_28_00261', 'Urinary cathetal', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 500, 1000, 0, 0, 0),
(262, 'M_2023_01_28_00262', 'Urine bag', 17, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 500, 1000, 0, 0, 0),
(263, 'M_2023_01_28_00263', 'Uvesterol vitamine ADEC 20ml', 11, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 1245, 1700, 0, 0, 0),
(264, 'M_2023_01_28_00264', 'Vitamin B1+B6 inj (B CO)', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 800, 0, 0, 0),
(265, 'M_2023_01_28_00265', 'Vitamin Bcomplex inj', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 40, 600, 0, 0, 0),
(266, 'M_2023_01_28_00266', 'Vitamin Bcomplex tab S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 20, 200, 0, 0, 0),
(267, 'M_2023_01_28_00267', 'Vitamin K1', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 220, 1000, 0, 0, 0),
(268, 'M_2023_01_28_00268', 'Vitamine C250mg B/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 75, 400, 0, 0, 0),
(269, 'M_2023_01_28_00269', 'Vogalene inj 10mg/ml', 5, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 250, 500, 0, 0, 0),
(270, 'M_2023_01_28_00270', 'Vogalene suppo 5mg B/1', 9, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 75, 150, 0, 0, 0),
(271, 'M_2023_01_28_00271', 'Zinc oxide 5%-Dexpanthenol 5% 100g', 10, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 2000, 0, 0, 0),
(272, 'M_2023_01_28_00272', 'Zinc sulfate 20mg tab S/10', 4, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 170, 300, 0, 0, 0),
(273, 'M_2023_01_28_00273', 'CIRCUMCISIION O-1MONTH', 35, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 5000, 0, 0, 0),
(274, 'M_2023_01_28_00274', 'CIRCUMCISION 1MONTH-1YEAR', 35, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 10000, 0, 0, 0),
(275, 'M_2023_01_28_00275', 'CIRCUMCISION 1YRS-2YEARS', 35, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 15000, 0, 0, 0),
(276, 'M_2023_01_28_00276', 'CIRCUMCISION ADULECENT 2YRS PLUS', 35, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 25000, 0, 0, 0),
(277, 'M_2023_01_28_00277', 'CONSULTATION NORMAL', 35, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 1000, 0, 0, 0),
(278, 'M_2023_01_28_00278', 'CONSULTATION ON CALLS/NIGHT', 36, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 2000, 0, 0, 0),
(279, 'M_2023_01_28_00279', 'DELIVERY(INCLUDING OXYTOCIN, CORD CRAP, VITK', 35, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 30000, 0, 0, 0),
(280, 'M_2023_01_28_00280', 'EAR BUSTING', 35, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 1000, 0, 0, 0),
(281, 'M_2023_01_28_00281', 'EARINGS', 35, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 500, 0, 0, 0),
(282, 'M_2023_01_28_00282', 'INJECTION FEE', 36, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 500, 0, 0, 0),
(283, 'M_2023_01_28_00283', 'BED FEE PER NIGHT', 36, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 2000, 0, 0, 0),
(284, 'M_2023_01_28_00284', 'NURSING CARE', 36, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 1000, 0, 0, 0),
(285, 'M_2023_01_28_00285', 'ANC BOOKING', 36, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 5500, 0, 0, 0),
(286, 'M_2023_01_28_00286', 'ANC VISIT', 36, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 2500, 0, 0, 0),
(288, 'M_2023_01_28_00288', 'CONSULTATION CARD', 36, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 300, 0, 0, 0),
(289, 'M_2023_01_28_00289', 'VIP ROOM ', 38, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 6000, 0, 0, 0),
(292, 'M_2023_01_28_00292', 'OXYGEN CONCENTRATOR PER HOUR', 41, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 500, 0, 0, 0),
(293, 'M_2023_01_28_00293', 'OXYGEN SATUROMETER PER HOUR', 41, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 0, 1000, 0, 0, 0),
(294, 'M_2023_01_28_00294', 'Paracetamol infusion 1G (PERFAGAN)', 28, 0, '0000-00-00', '0000-00-00', 'N/A', '2022-05-18', 900, 2000, 0, 0, 0),
(295, 'MEDOC_2022_09_295', 't', 20, 0, '2022-09-19', '2022-09-19', 'N/A', '2022-09-19', 0, 0, 1, 0, 1),
(297, 'M_2023_01_28_00297', 'Typhoid Rapid Test ', 42, 0, '2022-09-29', '2023-12-29', 'N/A', '2022-09-29', 900, 3000, 7, 100, 0),
(298, 'M_2023_01_28_00298', 'Malaria Rapid Test', 42, 0, '2022-09-29', '2024-12-29', 'N/A', '2022-09-29', 400, 1000, 7, 100, 0),
(299, 'P_00299', 'test', 21, 0, '2023-01-28', '2023-01-28', 'N/A', '2023-01-28', 0, 0, 17, 0, 1),
(300, 'M_2023_01_28_00298', 'TEST', 18, 0, '2023-01-28', NULL, 'N/A', '2023-01-28', 0, 0, 18, 0, 1),
(301, 'M_2023_06_13_00301', 'Aclav 1G sachet B/12', 16, 0, '2023-06-13', NULL, 'N/A', '2023-06-13', 3310, 4500, 15, 0, 0),
(302, 'M_2023_06_13_00302', 'azithromycin 500mg b/3', 14, 0, '2023-06-13', NULL, 'N/A', '2023-06-13', 2578, 4000, 15, 0, 0),
(303, 'M_2023_06_20_00303', 'Bicarbonate ', 4, 0, '2023-06-20', NULL, 'N/A', '2023-06-20', 0, 0, 2, 1, 1),
(304, 'M_2023_06_20_00304', 'Bicarbonate', 4, 0, '2023-06-20', NULL, 'N/A', '2023-06-20', 0, 0, 2, 1, 1),
(305, 'M_2023_06_20_00305', 'Bicarbonate', 4, 0, '2023-06-20', NULL, 'N/A', '2023-06-20', 0, 0, 2, 1, 1),
(306, 'M_2023_06_20_00306', 'Bicarbonate', 4, 0, '2023-06-20', NULL, 'N/A', '2023-06-20', 0, 0, 2, 1, 1),
(307, 'M_2023_06_20_00307', 'Bicarbonate', 18, 0, '2023-06-20', NULL, 'N/A', '2023-06-20', 0, 0, 17, 1, 1),
(308, 'M_2024_03_16_00308', 'test win', 21, 0, '2024-03-16', NULL, 'N/A', '2024-03-16', 4, 3, 1, 1, 1),
(309, 'M_2024_03_18_00309', 'TEST ECO', 16, 0, '2024-03-18', NULL, 'N/A', '2024-03-18', 2, 1, 1, 1, 0),
(310, 'M_2024_03_18_00310', 'test ecoa', 20, 0, '2024-03-18', NULL, 'N/A', '2024-03-18', 2, 1, 1, 0, 0),
(311, 'M_2024_03_19_00311', 'test marche', 20, 0, '2024-03-19', NULL, 'N/A', '2024-03-19', 1, 5, 1, 0, 1),
(312, 'M_2024_03_20_00312', 'PRODUIT ALL', 19, 0, '2024-03-20', NULL, 'N/A', '2024-03-20', 5, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `medicament_ordo`
--

DROP TABLE IF EXISTS `medicament_ordo`;
CREATE TABLE IF NOT EXISTS `medicament_ordo` (
  `id_medi_ordo` int(16) NOT NULL AUTO_INCREMENT,
  `id_ordo` int(16) DEFAULT '0',
  `ref_medi_ordo` varchar(255) DEFAULT 'N/A',
  `reduction` int(16) DEFAULT '0',
  `id_medi` int(16) DEFAULT '0',
  `id_num_lot` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_pharmacien` int(16) DEFAULT '0',
  `id_depart` int(16) DEFAULT '0',
  `quantite_medi_ordo` int(32) DEFAULT '0',
  `date_medi_os_ordo` date DEFAULT NULL,
  `etat` int(11) DEFAULT '0',
  `posologie` varchar(255) DEFAULT 'N/A',
  `traitement` varchar(255) DEFAULT 'N/A',
  `payer` int(16) DEFAULT '0',
  PRIMARY KEY (`id_medi_ordo`),
  KEY `id_patient` (`id_patient`),
  KEY `id_medi` (`id_medi`),
  KEY `id_medecin` (`id_medecin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mode_paie`
--

DROP TABLE IF EXISTS `mode_paie`;
CREATE TABLE IF NOT EXISTS `mode_paie` (
  `id_mode_paie` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `open_close` int(16) NOT NULL,
  PRIMARY KEY (`id_mode_paie`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `mode_paie`
--

INSERT INTO `mode_paie` (`id_mode_paie`, `nom`, `open_close`) VALUES
(1, 'CASH', 1),
(2, 'ESPECES ', 0),
(3, 'CHEQUE', 1),
(4, 'VIREMENT', 1),
(5, 'ANDY', 1),
(6, 'CHEQUE', 0),
(7, 'CAUTION', 0),
(8, 'DEPOT', 0);

-- --------------------------------------------------------

--
-- Structure de la table `momo`
--

DROP TABLE IF EXISTS `momo`;
CREATE TABLE IF NOT EXISTS `momo` (
  `id_momo` int(16) NOT NULL AUTO_INCREMENT,
  `ref_momo` varchar(255) DEFAULT 'N/A',
  `id_perso` int(16) DEFAULT '0',
  `number` int(16) DEFAULT '0',
  `montant` int(16) DEFAULT '0',
  `solde` int(16) DEFAULT '0',
  `date_momo` date DEFAULT NULL,
  `date_valide` date DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  `id_rap_caisse` int(16) DEFAULT '0',
  PRIMARY KEY (`id_momo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `nurse`
--

DROP TABLE IF EXISTS `nurse`;
CREATE TABLE IF NOT EXISTS `nurse` (
  `id_nurse` int(16) NOT NULL AUTO_INCREMENT,
  `nom_n` varchar(255) DEFAULT 'N/A',
  `type_n` char(5) DEFAULT 'N/A',
  `prenom_n` varchar(255) DEFAULT 'N/A',
  `user_n` varchar(255) DEFAULT 'N/A',
  `email_n` varchar(255) DEFAULT 'N/A',
  `id_depart` int(16) DEFAULT '0',
  `pass_n` varchar(255) DEFAULT '1234',
  `check_pass_n` varchar(255) DEFAULT 'N/A',
  `date_n` date DEFAULT NULL,
  `genre_n` varchar(2) DEFAULT NULL,
  `adress_n` varchar(255) DEFAULT 'N/A',
  `pays_n` int(16) DEFAULT '0',
  `ville_n` varchar(255) DEFAULT 'N/A',
  `region_n` varchar(255) DEFAULT 'N/A',
  `code_n` varchar(255) DEFAULT 'N/A',
  `phone_n` varchar(255) DEFAULT 'N/A',
  `avatar_n` int(16) DEFAULT '0',
  `bio_n` varchar(255) DEFAULT 'N/A',
  `statut_n` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_nurse`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `nurse`
--

INSERT INTO `nurse` (`id_nurse`, `nom_n`, `type_n`, `prenom_n`, `user_n`, `email_n`, `id_depart`, `pass_n`, `check_pass_n`, `date_n`, `genre_n`, `adress_n`, `pays_n`, `ville_n`, `region_n`, `code_n`, `phone_n`, `avatar_n`, `bio_n`, `statut_n`, `open_close`) VALUES
(1, 'NGOA MEYONG', 'N/A', 'Kizito', 'N/A', 'hosting@win-technology.net', 0, 'N/A', 'N/A', NULL, 'M', 'ELIG-ESSONO (MONTE HOTEL GRAND MOULIN', 0, 'YAOUNDE', 'N/A', 'N/A', '655010203', 0, '', 0, 1),
(2, 'NGOA MEYONG', 'N/A', 'Kizito', 'N/A', 'hosting@win-technology.net', 0, 'N/A', 'N/A', NULL, 'F', 'ELIG-ESSONO (MONTE HOTEL GRAND MOULIN', 0, 'YAOUNDE', 'N/A', 'N/A', '655010203', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `om`
--

DROP TABLE IF EXISTS `om`;
CREATE TABLE IF NOT EXISTS `om` (
  `id_om` int(16) NOT NULL AUTO_INCREMENT,
  `ref_om` varchar(255) DEFAULT 'N/A',
  `id_perso` int(16) DEFAULT '0',
  `number` int(16) DEFAULT '0',
  `montant` int(16) DEFAULT '0',
  `solde` int(16) DEFAULT '0',
  `date_om` date DEFAULT NULL,
  `date_valide` date DEFAULT NULL,
  `open_close` int(16) NOT NULL DEFAULT '0',
  `id_rap_caisse` int(16) DEFAULT '0',
  PRIMARY KEY (`id_om`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

DROP TABLE IF EXISTS `operation`;
CREATE TABLE IF NOT EXISTS `operation` (
  `id_ope` int(16) NOT NULL AUTO_INCREMENT,
  `ref_ope` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_inter` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_type_ope` int(16) DEFAULT '0',
  `date_ope` date DEFAULT NULL,
  `resume` varchar(255) DEFAULT 'N/A',
  `id_fich_ope_1` int(16) DEFAULT '0',
  `id_fich_ope_2` int(16) DEFAULT '0',
  `obs_ope` varchar(255) DEFAULT 'N/A',
  `id_depart` int(16) DEFAULT '0',
  `time_first` time DEFAULT NULL,
  `time_last` time DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  `etat` int(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ope`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`id_ope`, `ref_ope`, `id_patient`, `id_inter`, `id_medecin`, `id_type_ope`, `date_ope`, `resume`, `id_fich_ope_1`, `id_fich_ope_2`, `obs_ope`, `id_depart`, `time_first`, `time_last`, `open_close`, `etat`) VALUES
(1, 'OPE_2024_01_1_1', 1, 0, 2, 18, '2024-01-13', '', 0, 0, 'N/A', 15, '09:54:00', '13:58:00', 0, 0),
(2, 'OPE_2024_01_1_2', 1, 0, 2, 15, '2024-01-17', '', 0, 0, 'N/A', 17, '13:09:00', '16:12:00', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ordonnance`
--

DROP TABLE IF EXISTS `ordonnance`;
CREATE TABLE IF NOT EXISTS `ordonnance` (
  `id_ordo` int(16) NOT NULL AUTO_INCREMENT,
  `ref_ordo` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_pharmacien` int(16) NOT NULL DEFAULT '0',
  `id_depart` int(16) DEFAULT '0',
  `date_ordo` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT 'N/A',
  `etat` int(16) DEFAULT '0',
  `statut` int(16) DEFAULT '0',
  `id_fich_ordo` int(16) DEFAULT '0',
  PRIMARY KEY (`id_ordo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ordo_medi`
--

DROP TABLE IF EXISTS `ordo_medi`;
CREATE TABLE IF NOT EXISTS `ordo_medi` (
  `id_ordo_medi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_ordo_medi` varchar(255) DEFAULT 'N/A',
  `id_ordo` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medi` int(16) DEFAULT '0',
  `qt_ordo_medi` int(32) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `date_ordo_medi` date DEFAULT NULL,
  `statut` int(4) DEFAULT '0',
  PRIMARY KEY (`id_ordo_medi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `outil`
--

DROP TABLE IF EXISTS `outil`;
CREATE TABLE IF NOT EXISTS `outil` (
  `id_outil` int(16) NOT NULL AUTO_INCREMENT,
  `ref_outil` varchar(255) DEFAULT 'N/A',
  `nom_outil` varchar(255) DEFAULT 'N/A',
  `id_type_outil` int(16) DEFAULT '0',
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT 'N/A',
  `prix_unit` int(32) DEFAULT '0',
  `prix_u_v` int(32) DEFAULT '0',
  `id_four` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_outil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `outil`
--

INSERT INTO `outil` (`id_outil`, `ref_outil`, `nom_outil`, `id_type_outil`, `date_create`, `date_update`, `obs`, `prix_unit`, `prix_u_v`, `id_four`, `open_close`) VALUES
(1, 'F_2023_08_21_00001', 'pens', 2, NULL, NULL, 'N/A', 1000, 1500, 1, 0),
(2, 'F_2024_01_11_00002', 'OUTILS', 1, NULL, NULL, 'N/A', 1000, 1200, 1, 0),
(3, 'F_2024_01_17_00003', 'Douala', 2, NULL, NULL, 'N/A', 20, 34, 1, 0),
(4, 'F_2024_01_29_00004', 'Bafoussam ', 1, NULL, NULL, 'N/A', 9, 8, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id_patient` int(16) NOT NULL AUTO_INCREMENT,
  `ref_patient` varchar(255) DEFAULT 'N/A',
  `nom_p` varchar(255) DEFAULT NULL,
  `prenom_p` varchar(255) DEFAULT NULL,
  `age_p` int(20) DEFAULT NULL,
  `username_p` varchar(255) DEFAULT NULL,
  `email_p` varchar(255) DEFAULT NULL,
  `password_p` varchar(255) DEFAULT NULL,
  `check_password_p` varchar(255) DEFAULT NULL,
  `date_aniv_p` date DEFAULT NULL,
  `genre_p` varchar(100) DEFAULT NULL,
  `adresse_p` varchar(255) DEFAULT NULL,
  `pays_p` int(16) DEFAULT '0',
  `ville_p` varchar(255) DEFAULT NULL,
  `region_p` varchar(255) DEFAULT NULL,
  `code_postal_p` varchar(255) DEFAULT NULL,
  `phone_p` varchar(255) DEFAULT NULL,
  `avatar_p` int(16) DEFAULT NULL,
  `biography_p` varchar(255) DEFAULT NULL,
  `statut_p` int(16) DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  `id_ent` int(16) DEFAULT '0',
  `id_ass` int(16) DEFAULT '0',
  `tel` varchar(50) DEFAULT 'N/A',
  `pers` varchar(255) DEFAULT 'N/A',
  `pers_tel` varchar(50) DEFAULT 'N/A',
  PRIMARY KEY (`id_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `ref_patient`, `nom_p`, `prenom_p`, `age_p`, `username_p`, `email_p`, `password_p`, `check_password_p`, `date_aniv_p`, `genre_p`, `adresse_p`, `pays_p`, `ville_p`, `region_p`, `code_postal_p`, `phone_p`, `avatar_p`, `biography_p`, `statut_p`, `open_close`, `id_ent`, `id_ass`, `tel`, `pers`, `pers_tel`) VALUES
(1, 'P000120240103', 'NGOA MEYONG', 'Kizito', NULL, 'N/A', 'hosting@win-technology.net', 'N/A', 'N/A', NULL, 'M', 'ELIG-ESSONO (MONTE HOTEL GRAND MOULIN', 0, 'YAOUNDE', NULL, NULL, '655010203', NULL, '', NULL, 1, 0, 0, 'N/A', 'konde', '655010203'),
(2, 'P000220240117', 'PATIENT', 'Demo', NULL, 'N/A', '', 'N/A', 'N/A', NULL, 'M', '', 0, '', NULL, NULL, '', NULL, '', NULL, 0, 0, 0, 'N/A', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays` (
  `id_pays` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_pays`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id_pays`, `nom`, `open_close`) VALUES
(1, 'Afrique du Sud', 0),
(2, 'Algerie', 0),
(3, 'Angola', 0),
(4, 'Benin', 0),
(5, 'Botswana', 0),
(6, 'Burkina Faso', 0),
(7, 'Burundi', 0),
(8, 'Cameroun', 0),
(9, 'Comores', 0),
(10, 'Cote ivoire', 0),
(11, 'Djibouti', 0),
(12, 'Egypte', 0),
(13, 'Ethiopie', 0),
(14, 'Gabon', 0),
(15, 'Gambie', 0),
(16, 'Ghana', 0),
(17, 'Guinee', 0),
(18, 'Guinee équatoriale', 0),
(19, 'Guinee-Bissau', 0),
(20, 'Kenya', 0),
(21, 'Lesotho', 0),
(22, 'Liberia', 0),
(23, 'Libye', 0),
(24, 'Madagascar', 0),
(25, 'Malawi', 0),
(26, 'Mali', 0),
(27, 'Maroc', 0),
(28, 'Maurice', 0),
(29, 'Mauritanie', 0),
(30, 'Mozambique', 0),
(31, 'Namibie', 0),
(32, 'Niger', 0),
(33, 'Nigeria ', 0),
(34, 'Ouganda', 0),
(35, 'Republique centrafricaine', 0),
(36, 'Republique démocratique du Congo', 0),
(37, 'Republique du Congo', 0),
(38, 'Rwanda', 0),
(39, 'Sao Tome-et-Principe', 0),
(40, 'Sénegal', 0),
(41, 'Seychelles', 0),
(42, 'Sierra Leone', 0),
(43, 'Somalie', 0),
(44, 'Soudan', 0),
(45, 'Soudan du Sud', 0),
(46, 'Swaziland Eswatini', 0),
(47, 'Tanzanie', 0),
(48, 'Tchad', 0),
(49, 'Togo', 0),
(50, 'Tunisie', 0),
(51, 'Zambie', 0);

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `id_personnel` int(16) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) DEFAULT 'N/A',
  `statut` varchar(255) DEFAULT 'N/A',
  `nom` varchar(255) DEFAULT 'N/A',
  `prenom` varchar(255) DEFAULT 'N/A',
  `attribut` varchar(255) DEFAULT NULL,
  `id_card_number` varchar(255) DEFAULT 'N/A',
  `id_card_validity` varchar(32) DEFAULT 'N/A',
  `nom_pere` varchar(255) DEFAULT 'N/A',
  `nom_mere` varchar(255) DEFAULT 'N/A',
  `date_naissance` varchar(32) DEFAULT 'N/A',
  `lieu_naissance` varchar(32) DEFAULT 'N/A',
  `profession` varchar(255) DEFAULT 'N/A',
  `genre` varchar(32) DEFAULT 'N/A',
  `type_contrat` varchar(50) DEFAULT 'N/A',
  `situation_matrimoniale` varchar(255) DEFAULT 'N/A',
  `nombre_enfants` varchar(16) DEFAULT 'N/A',
  `tel` varchar(255) DEFAULT 'N/A',
  `poste` varchar(255) DEFAULT 'N/A',
  `date_embauche` varchar(32) DEFAULT 'N/A',
  `email` varchar(255) DEFAULT 'N/A',
  `id_quartier` int(16) DEFAULT '0',
  `id_ville` int(16) DEFAULT '0',
  `id_pays` int(16) DEFAULT '0',
  `number_cnps` varchar(255) DEFAULT 'N/A',
  `nom_banque` varchar(255) DEFAULT 'N/A',
  `number_card_bancaire` varchar(255) DEFAULT 'N/A',
  `day_anciennete` int(16) DEFAULT '0',
  `month_anciennete` int(16) DEFAULT '0',
  `year_anciennete` int(16) DEFAULT '0',
  `prime` int(64) DEFAULT '0',
  `cout_h_sup` int(64) DEFAULT '0',
  `cout_horaire` int(64) DEFAULT '0',
  `id_chantier` int(16) DEFAULT '0',
  `id_etape` int(16) DEFAULT '0',
  `open_close` int(16) NOT NULL,
  PRIMARY KEY (`id_personnel`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id_personnel`, `matricule`, `statut`, `nom`, `prenom`, `attribut`, `id_card_number`, `id_card_validity`, `nom_pere`, `nom_mere`, `date_naissance`, `lieu_naissance`, `profession`, `genre`, `type_contrat`, `situation_matrimoniale`, `nombre_enfants`, `tel`, `poste`, `date_embauche`, `email`, `id_quartier`, `id_ville`, `id_pays`, `number_cnps`, `nom_banque`, `number_card_bancaire`, `day_anciennete`, `month_anciennete`, `year_anciennete`, `prime`, `cout_h_sup`, `cout_horaire`, `id_chantier`, `id_etape`, `open_close`) VALUES
(19, '', 'STAGIAIRE', 'KONDE', 'JEAN FELIX', 'N/A', '012478956', '2021-02-27', '', '', '2021-02-06', 'YAOUNDE', 'INFORMATICIEN', 'MASCULIN', 'CDI', 'MARIÉ(E)', '2', '655021489', 'PDG', '', 'infoservice@gmail.com', NULL, NULL, NULL, '', '', '', 0, 0, 0, 0, 0, 0, 5, 0, 0),
(20, 'N/A', 'N/A', 'CAISSE', 'CAISSE', NULL, '', '', '', '', '', '', '0', 'N/A', 'N/A', 'N/A', '0', '', 'N/A', 'N/A', '', 0, 0, NULL, 'N/A', 'N/A', 'N/A', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 'N/A', 'N/A', 'PHAR', 'PHAR', NULL, '', '2024-03-06', '', '', '', '', '0', 'N/A', 'N/A', 'N/A', '0', '', 'N/A', 'N/A', '', 0, 0, NULL, 'N/A', 'N/A', 'N/A', 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pharmacie`
--

INSERT INTO `pharmacie` (`id_phar`, `id_medi`, `nom_medi`, `quantite`, `date_phar`, `open_close`, `id_num_lot`, `date_fab`, `date_exp`, `heure`) VALUES
(7, 4, 'Aciclovir 200mg S/10', 4, '2024-03-20', 0, '879001', '2024-03-31', '2024-02-27', NULL),
(8, 22, 'Artefan 20/120mg B/6', 5, '2024-03-20', 0, '8790000', '2024-03-31', '2024-03-05', NULL),
(9, 20, 'Antiscabies ointment', 2, '2024-03-20', 0, '45667', '2024-05-04', '2024-03-04', '13:33:00');

-- --------------------------------------------------------

--
-- Structure de la table `pj_etat_academique`
--

DROP TABLE IF EXISTS `pj_etat_academique`;
CREATE TABLE IF NOT EXISTS `pj_etat_academique` (
  `id_pj` int(7) NOT NULL,
  `id_personnel` int(16) DEFAULT '0',
  `nom_pj` varchar(255) DEFAULT 'N/A',
  `lien` varchar(255) DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `pj_etat_professionnel`
--

DROP TABLE IF EXISTS `pj_etat_professionnel`;
CREATE TABLE IF NOT EXISTS `pj_etat_professionnel` (
  `id_pj` int(7) NOT NULL,
  `id_personnel` int(16) DEFAULT '0',
  `nom_pj` varchar(255) DEFAULT 'N/A',
  `lien` varchar(255) DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

DROP TABLE IF EXISTS `poste`;
CREATE TABLE IF NOT EXISTS `poste` (
  `id_poste` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_poste`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `profession`
--

DROP TABLE IF EXISTS `profession`;
CREATE TABLE IF NOT EXISTS `profession` (
  `id_prof` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_prof`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `profession`
--

INSERT INTO `profession` (`id_prof`, `nom`, `open_close`) VALUES
(3, 'Pharmacien', 0),
(4, 'Account clerk', 0),
(5, 'Administrative assistant', 0),
(6, 'Accountant', 0),
(7, 'Administrator', 0),
(8, 'Anesthetist nurse', 0),
(9, 'Assistant nurse', 0),
(10, 'Auxillary midwife', 0),
(11, 'Branch account officer', 0),
(12, 'Cashier/receptionist', 0),
(13, 'Cleaner', 0),
(14, 'Community health nurse', 0),
(15, 'Dentiste techician', 0),
(16, 'Evangeliste', 0),
(17, 'Finance assistant', 0),
(18, 'General pratitioner', 0),
(19, 'General supervisor of ns', 0),
(20, 'Guard', 0),
(21, 'Hostess', 0),
(22, 'Laboratory assistant', 0),
(23, 'Laboratory technician', 0),
(24, 'Maintenance assistant', 0),
(25, 'Maintenance officier', 0),
(26, 'Medical imagimg technician', 0),
(27, 'Midwife', 0),
(28, 'Midwife assistant', 0),
(29, 'Midwife brevete', 0),
(30, 'Nurse', 0),
(31, 'Nurse aid', 0),
(32, 'Nurse/midwife brevete', 0),
(33, 'Pastor', 0),
(34, 'Pharmacy store assistant', 0),
(35, 'Pharmacy technician', 0),
(36, 'Program officer', 0),
(37, 'Scrub nurse (orthopedic surgery technician', 0),
(38, 'Senior driver', 0),
(39, 'Senior laboratory technician', 0),
(40, 'State registered nurse', 0),
(41, 'Store assistant', 0),
(42, 'Store officier', 0),
(43, 'Pro', 0);

-- --------------------------------------------------------

--
-- Structure de la table `quartier`
--

DROP TABLE IF EXISTS `quartier`;
CREATE TABLE IF NOT EXISTS `quartier` (
  `id_quat` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT 'N/A',
  `id_ville` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_quat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quartier`
--

INSERT INTO `quartier` (`id_quat`, `nom`, `id_ville`, `open_close`) VALUES
(2, 'Bonaberi-bonèdale', 2, 0),
(3, 'Intendance', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `radiologie`
--

DROP TABLE IF EXISTS `radiologie`;
CREATE TABLE IF NOT EXISTS `radiologie` (
  `id_radiologie` int(16) NOT NULL AUTO_INCREMENT,
  `ref_radiologie` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_type_radiologie` int(16) DEFAULT '0',
  `date_radiologie` date DEFAULT NULL,
  `etat` int(16) DEFAULT '0',
  `obs` varchar(255) DEFAULT 'N/A',
  `id_radiologue` int(16) DEFAULT '0',
  `id_fich_radiologie` int(16) DEFAULT '0',
  `id_img_radiologie` int(16) DEFAULT '0',
  `obs_radiologie` varchar(255) DEFAULT 'N/A',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_radiologie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `radiologie`
--

INSERT INTO `radiologie` (`id_radiologie`, `ref_radiologie`, `id_patient`, `id_medecin`, `id_type_radiologie`, `date_radiologie`, `etat`, `obs`, `id_radiologue`, `id_fich_radiologie`, `id_img_radiologie`, `obs_radiologie`, `open_close`) VALUES
(1, 'RAD_2024_01_1_1', 1, 2, 0, '2024-01-11', 0, '', 0, 0, 0, 'N/A', 0),
(2, 'RAD_2024_01_2_2', 2, 2, 0, '2024-01-17', 0, '', 0, 0, 0, 'N/A', 0);

-- --------------------------------------------------------

--
-- Structure de la table `radiologie_exa`
--

DROP TABLE IF EXISTS `radiologie_exa`;
CREATE TABLE IF NOT EXISTS `radiologie_exa` (
  `id_radiologie_exa` int(16) NOT NULL AUTO_INCREMENT,
  `id_radiologie` int(16) DEFAULT '0',
  `ref_radiologie_exa` varchar(255) DEFAULT 'N/A',
  `reduction` int(16) DEFAULT '0',
  `id_type_radiologie` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_radiologue` int(16) DEFAULT '0',
  `id_depart` int(16) DEFAULT '0',
  `qte_radiologie_exa` int(32) DEFAULT '0',
  `amount` int(32) DEFAULT '0',
  `payer` int(32) DEFAULT '0',
  `date_radiologie` date DEFAULT NULL,
  `etat` int(11) DEFAULT '0',
  PRIMARY KEY (`id_radiologie_exa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `radiologie_exa`
--

INSERT INTO `radiologie_exa` (`id_radiologie_exa`, `id_radiologie`, `ref_radiologie_exa`, `reduction`, `id_type_radiologie`, `id_patient`, `id_medecin`, `id_radiologue`, `id_depart`, `qte_radiologie_exa`, `amount`, `payer`, `date_radiologie`, `etat`) VALUES
(1, 1, 'RAD_2024_01_1_1', 0, 2, 1, 2, 0, 0, 1, 15200, 0, '2024-01-11', 0),
(2, 2, 'RAD_2024_01_2_2', 0, 3, 2, 2, 0, 0, 1, 500, 0, '2024-01-17', 0),
(3, 2, 'RAD_2024_01_2_2', 0, 2, 2, 2, 0, 0, 1, 15200, 0, '2024-01-17', 0);

-- --------------------------------------------------------

--
-- Structure de la table `radiologue`
--

DROP TABLE IF EXISTS `radiologue`;
CREATE TABLE IF NOT EXISTS `radiologue` (
  `id_radiologue` int(16) NOT NULL AUTO_INCREMENT,
  `nom_r` varchar(255) DEFAULT 'N/A',
  `type_r` char(5) DEFAULT 'N/A',
  `prenom_r` varchar(255) DEFAULT 'N/A',
  `user_r` varchar(255) DEFAULT 'N/A',
  `email_r` varchar(255) DEFAULT 'N/A',
  `id_depart` int(16) DEFAULT '0',
  `pass_r` varchar(255) DEFAULT '1234',
  `check_pass_r` varchar(255) DEFAULT 'N/A',
  `date_r` date DEFAULT NULL,
  `genre_r` varchar(2) DEFAULT NULL,
  `adress_r` varchar(255) DEFAULT 'N/A',
  `pays_r` varchar(255) DEFAULT 'N/A',
  `ville_r` varchar(255) DEFAULT 'N/A',
  `region_r` varchar(255) DEFAULT 'N/A',
  `code_r` varchar(255) DEFAULT 'N/A',
  `phone_r` varchar(255) DEFAULT 'N/A',
  `avatar_r` int(16) DEFAULT '0',
  `bio_r` varchar(255) DEFAULT 'N/A',
  `statut_r` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_radiologue`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `radiologue`
--

INSERT INTO `radiologue` (`id_radiologue`, `nom_r`, `type_r`, `prenom_r`, `user_r`, `email_r`, `id_depart`, `pass_r`, `check_pass_r`, `date_r`, `genre_r`, `adress_r`, `pays_r`, `ville_r`, `region_r`, `code_r`, `phone_r`, `avatar_r`, `bio_r`, `statut_r`, `open_close`) VALUES
(1, 'NGOA MEYONG', 'N/A', 'Kizito', 'N/A', 'hosting@win-technology.net', 0, 'N/A', 'N/A', NULL, 'M', 'ELIG-ESSONO (MONTE HOTEL GRAND MOULIN', '0', 'YAOUNDE', 'N/A', 'N/A', '655010203', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `rapport_caisse`
--

DROP TABLE IF EXISTS `rapport_caisse`;
CREATE TABLE IF NOT EXISTS `rapport_caisse` (
  `id_rap_caisse` int(16) NOT NULL AUTO_INCREMENT,
  `ref_rap` varchar(255) DEFAULT 'N/A',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `location` varchar(255) DEFAULT 'N/A',
  `motif` varchar(255) DEFAULT 'N/A',
  `montant` int(32) DEFAULT '0',
  `etat` int(16) DEFAULT '0',
  `dixmilles` int(16) DEFAULT '0',
  `cinqmilles` int(16) DEFAULT '0',
  `deuxmilles` int(16) DEFAULT '0',
  `mille` int(16) DEFAULT '0',
  `cinqcentnote` int(16) DEFAULT '0',
  `cinqcentcoin` int(16) DEFAULT '0',
  `cent` int(16) DEFAULT '0',
  `cinquante` int(16) DEFAULT '0',
  `vingtcinq` int(16) DEFAULT '0',
  `dix` int(16) DEFAULT '0',
  `cinq` int(16) DEFAULT '0',
  `deux` int(16) DEFAULT '0',
  `un` int(16) DEFAULT '0',
  `date_rap` date DEFAULT NULL,
  `date_valide` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `open_close` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_rap_caisse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id_region` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_pays` int(16) NOT NULL,
  `open_close` int(16) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `regler_anesthesie`
--

DROP TABLE IF EXISTS `regler_anesthesie`;
CREATE TABLE IF NOT EXISTS `regler_anesthesie` (
  `id_reg_anes` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_anes` varchar(255) DEFAULT 'N/A',
  `id_anes` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_chirugien` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_type_anes` int(16) DEFAULT '0',
  `date_reg_anes` date DEFAULT NULL,
  `payer` int(32) DEFAULT '0',
  `somme` int(32) DEFAULT '0',
  `remise` int(16) DEFAULT '0',
  `id_paie` int(16) DEFAULT '0',
  PRIMARY KEY (`id_reg_anes`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `regler_anesthesie`
--

INSERT INTO `regler_anesthesie` (`id_reg_anes`, `ref_reg_anes`, `id_anes`, `id_patient`, `id_medecin`, `id_chirugien`, `id_caisse`, `id_perso`, `id_type_anes`, `date_reg_anes`, `payer`, `somme`, `remise`, `id_paie`) VALUES
(1, 'N/A', 1, 1, 2, 0, 0, 0, 0, '2024-01-12', 0, NULL, 0, 0),
(2, 'N/A', 2, 2, 2, 0, 0, 0, 1, '2024-01-17', 500, 500, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `regler_autre`
--

DROP TABLE IF EXISTS `regler_autre`;
CREATE TABLE IF NOT EXISTS `regler_autre` (
  `id_reg_autre` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_autre` varchar(255) DEFAULT 'N/A',
  `id_autre` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `etat` int(16) DEFAULT '0',
  `id_autre_service` int(16) DEFAULT '0',
  `date_reg_autre` date DEFAULT NULL,
  `payer` int(32) DEFAULT '0',
  `remise` int(16) DEFAULT '0',
  `somme` int(32) DEFAULT '0',
  PRIMARY KEY (`id_reg_autre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `regler_autre`
--

INSERT INTO `regler_autre` (`id_reg_autre`, `ref_reg_autre`, `id_autre`, `id_patient`, `id_medecin`, `id_caisse`, `id_perso`, `etat`, `id_autre_service`, `date_reg_autre`, `payer`, `remise`, `somme`) VALUES
(3, 'AUTRE_2024_02_2_5', 5, 2, 2, 0, 0, 1, 0, '2024-02-05', 0, 0, 1000),
(4, 'AUTRE_2024_02_2_6', 6, 2, 2, 0, 0, 1, 0, '2024-02-05', 0, 0, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `regler_comi_anes`
--

DROP TABLE IF EXISTS `regler_comi_anes`;
CREATE TABLE IF NOT EXISTS `regler_comi_anes` (
  `id_reg_comi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_comi` varchar(255) DEFAULT 'N/A',
  `id_service` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_spe` int(16) DEFAULT '0',
  `type_spe` char(5) DEFAULT 'M',
  `date_reg_comi` date DEFAULT NULL,
  `payer_comi` int(32) DEFAULT '0',
  `somme_comi` int(32) DEFAULT '0',
  PRIMARY KEY (`id_reg_comi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `regler_comi_consul`
--

DROP TABLE IF EXISTS `regler_comi_consul`;
CREATE TABLE IF NOT EXISTS `regler_comi_consul` (
  `id_reg_comi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_comi` varchar(255) DEFAULT 'N/A',
  `id_service` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_spe` int(16) DEFAULT '0',
  `type_spe` char(5) DEFAULT 'M',
  `date_reg_comi` date DEFAULT NULL,
  `payer_comi` int(32) DEFAULT '0',
  `somme_comi` int(32) DEFAULT '0',
  PRIMARY KEY (`id_reg_comi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `regler_comi_eco`
--

DROP TABLE IF EXISTS `regler_comi_eco`;
CREATE TABLE IF NOT EXISTS `regler_comi_eco` (
  `id_reg_comi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_comi` varchar(255) DEFAULT 'N/A',
  `id_service` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_spe` int(16) DEFAULT '0',
  `type_spe` char(5) DEFAULT 'O',
  `date_reg_comi` date DEFAULT NULL,
  `payer_comi` int(32) DEFAULT '0',
  `somme_comi` int(32) DEFAULT '0',
  PRIMARY KEY (`id_reg_comi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `regler_comi_exa`
--

DROP TABLE IF EXISTS `regler_comi_exa`;
CREATE TABLE IF NOT EXISTS `regler_comi_exa` (
  `id_reg_comi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_comi` varchar(255) DEFAULT 'N/A',
  `id_service` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_spe` int(16) DEFAULT '0',
  `type_spe` char(5) DEFAULT 'E',
  `date_reg_comi` date DEFAULT NULL,
  `payer_comi` int(32) DEFAULT '0',
  `somme_comi` int(32) DEFAULT '0',
  PRIMARY KEY (`id_reg_comi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `regler_comi_hosp`
--

DROP TABLE IF EXISTS `regler_comi_hosp`;
CREATE TABLE IF NOT EXISTS `regler_comi_hosp` (
  `id_reg_comi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_comi` varchar(255) DEFAULT 'N/A',
  `id_service` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_spe` int(16) DEFAULT '0',
  `type_spe` char(5) DEFAULT 'H',
  `date_reg_comi` date DEFAULT NULL,
  `payer_comi` int(32) DEFAULT '0',
  `somme_comi` int(32) DEFAULT '0',
  PRIMARY KEY (`id_reg_comi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `regler_comi_ope`
--

DROP TABLE IF EXISTS `regler_comi_ope`;
CREATE TABLE IF NOT EXISTS `regler_comi_ope` (
  `id_reg_comi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_comi` varchar(255) DEFAULT 'N/A',
  `id_service` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_spe` int(16) DEFAULT '0',
  `type_spe` char(5) DEFAULT 'O',
  `date_reg_comi` date DEFAULT NULL,
  `payer_comi` int(32) DEFAULT '0',
  `somme_comi` int(32) DEFAULT '0',
  PRIMARY KEY (`id_reg_comi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `regler_comi_ordo`
--

DROP TABLE IF EXISTS `regler_comi_ordo`;
CREATE TABLE IF NOT EXISTS `regler_comi_ordo` (
  `id_reg_comi` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_comi` varchar(255) DEFAULT 'N/A',
  `id_service` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_spe` int(16) DEFAULT '0',
  `type_spe` char(5) DEFAULT 'O',
  `date_reg_comi` date DEFAULT NULL,
  `payer_comi` int(32) DEFAULT '0',
  `somme_comi` int(32) DEFAULT '0',
  PRIMARY KEY (`id_reg_comi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `regler_consul`
--

DROP TABLE IF EXISTS `regler_consul`;
CREATE TABLE IF NOT EXISTS `regler_consul` (
  `id_reg_consul` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_consul` varchar(255) DEFAULT 'N/A',
  `id_con` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_nurse` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_type_consul` int(16) DEFAULT '0',
  `date_reg_consul` date DEFAULT NULL,
  `payer` int(32) DEFAULT '0',
  `somme` int(32) DEFAULT '0',
  `remise` int(16) DEFAULT '0',
  `id_paie` int(16) DEFAULT '0',
  PRIMARY KEY (`id_reg_consul`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `regler_consul`
--

INSERT INTO `regler_consul` (`id_reg_consul`, `ref_reg_consul`, `id_con`, `id_patient`, `id_nurse`, `id_medecin`, `id_caisse`, `id_perso`, `id_type_consul`, `date_reg_consul`, `payer`, `somme`, `remise`, `id_paie`) VALUES
(1, 'CON_2024_01_1_1', 1, 1, 0, 0, 0, 0, 0, '2024-01-11', 0, NULL, 0, 0),
(2, 'CON_2024_01_1_2', 2, 1, 0, 0, 0, 0, 3, '2024-01-11', 24000, 25000, 1000, 2),
(3, 'CON_2024_01_2_3', 3, 2, 0, 0, 0, 0, 5, '2024-01-17', 0, 1000, 0, 2),
(4, 'CON_2024_03_2_4', 4, 2, 0, 0, 0, 0, 15, '2024-03-20', 500, 500, 0, 2),
(5, 'CON_2024_03_2_5', 5, 2, 0, 0, 0, 0, 1, '2024-03-21', 0, 450000, 0, 0),
(6, 'CON_2024_03_0_6', 6, 0, 0, 0, 0, 0, 3, '2024-03-21', 0, 25000, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `regler_ecographie`
--

DROP TABLE IF EXISTS `regler_ecographie`;
CREATE TABLE IF NOT EXISTS `regler_ecographie` (
  `id_reg_eco` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_eco` varchar(255) DEFAULT 'N/A',
  `id_eco` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_medecin2` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_type_eco` int(16) DEFAULT '0',
  `date_reg_eco` date DEFAULT NULL,
  `payer` int(32) DEFAULT '0',
  `somme` int(32) DEFAULT '0',
  `remise` int(16) DEFAULT '0',
  `etat` int(16) DEFAULT '0',
  `id_paie` int(16) DEFAULT '0',
  PRIMARY KEY (`id_reg_eco`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `regler_ecographie`
--

INSERT INTO `regler_ecographie` (`id_reg_eco`, `ref_reg_eco`, `id_eco`, `id_patient`, `id_medecin`, `id_medecin2`, `id_caisse`, `id_perso`, `id_type_eco`, `date_reg_eco`, `payer`, `somme`, `remise`, `etat`, `id_paie`) VALUES
(1, 'N/A', 1, 1, 2, 0, 0, 0, 2, '2024-01-13', 10000, 10000, 0, 1, 2),
(2, 'N/A', 2, 2, 2, 0, 0, 0, 2, '2024-01-17', 10000, 10000, 0, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `regler_examen`
--

DROP TABLE IF EXISTS `regler_examen`;
CREATE TABLE IF NOT EXISTS `regler_examen` (
  `id_reg_exa` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_exa` varchar(255) DEFAULT 'N/A',
  `id_exa` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_lab` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_paie` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_type_exa` int(16) DEFAULT '0',
  `date_reg_exa` date DEFAULT NULL,
  `payer` int(32) DEFAULT '0',
  `somme` int(32) DEFAULT '0',
  `remise` int(16) DEFAULT '0',
  `etat` int(16) DEFAULT '0',
  PRIMARY KEY (`id_reg_exa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `regler_examen`
--

INSERT INTO `regler_examen` (`id_reg_exa`, `ref_reg_exa`, `id_exa`, `id_patient`, `id_medecin`, `id_lab`, `id_caisse`, `id_paie`, `id_perso`, `id_type_exa`, `date_reg_exa`, `payer`, `somme`, `remise`, `etat`) VALUES
(1, 'EXAM_2024_01_1_1', 1, 1, 2, 0, 0, 2, 0, 0, '2024-01-11', 1800, 2000, 200, 1),
(2, 'EXAM_2024_01_2_2', 2, 2, 2, 0, 0, 2, 0, 0, '2024-01-17', 9500, 9500, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `regler_hosp`
--

DROP TABLE IF EXISTS `regler_hosp`;
CREATE TABLE IF NOT EXISTS `regler_hosp` (
  `id_reg_hosp` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_hosp` varchar(255) DEFAULT 'N/A',
  `id_hosp` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_type_hosp` int(16) DEFAULT '0',
  `date_reg_hosp` date DEFAULT NULL,
  `payer` int(32) DEFAULT '0',
  `somme` int(32) DEFAULT '0',
  `remise` int(16) DEFAULT '0',
  `id_paie` int(16) DEFAULT '0',
  PRIMARY KEY (`id_reg_hosp`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `regler_hosp`
--

INSERT INTO `regler_hosp` (`id_reg_hosp`, `ref_reg_hosp`, `id_hosp`, `id_patient`, `id_medecin`, `id_perso`, `id_caisse`, `id_type_hosp`, `date_reg_hosp`, `payer`, `somme`, `remise`, `id_paie`) VALUES
(1, 'HOSP_2024_01_11_1', 1, 1, 2, 0, 0, 1, '2024-01-11', 2000, 2000, 0, 2),
(2, 'HOSP_2024_01_17_2', 2, 2, 2, 0, 0, 1, '2024-01-17', 0, 2000, 0, 0),
(3, 'HOSP_2024_01_17_3', 3, 2, 2, 0, 0, 2, '2024-01-17', 5000, 5000, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `regler_ope`
--

DROP TABLE IF EXISTS `regler_ope`;
CREATE TABLE IF NOT EXISTS `regler_ope` (
  `id_reg_ope` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_ope` varchar(255) DEFAULT 'N/A',
  `id_ope` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_type_ope` int(16) DEFAULT '0',
  `date_reg_ope` date DEFAULT NULL,
  `payer` int(32) DEFAULT '0',
  `somme` int(32) DEFAULT '0',
  `remise` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_chirugien` int(16) DEFAULT '0',
  `id_paie` int(16) DEFAULT '0',
  PRIMARY KEY (`id_reg_ope`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `regler_ope`
--

INSERT INTO `regler_ope` (`id_reg_ope`, `ref_reg_ope`, `id_ope`, `id_patient`, `id_caisse`, `id_perso`, `id_type_ope`, `date_reg_ope`, `payer`, `somme`, `remise`, `id_medecin`, `id_chirugien`, `id_paie`) VALUES
(1, 'N/A', 1, 1, 0, 0, 18, '2024-01-13', 330000, 330000, 0, 2, 0, 2),
(2, 'N/A', 2, 1, 0, 0, 15, '2024-01-17', 100000, 100000, 0, 2, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `regler_ordo`
--

DROP TABLE IF EXISTS `regler_ordo`;
CREATE TABLE IF NOT EXISTS `regler_ordo` (
  `id_reg_ordo` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_ordo` varchar(255) DEFAULT 'N/A',
  `id_ordo` int(16) DEFAULT '0',
  `ref_ordo` varchar(255) DEFAULT 'N/A',
  `id_patient` int(16) DEFAULT '0',
  `reduction` int(16) DEFAULT '0',
  `id_caisse` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_depart` int(16) DEFAULT '0',
  `date_reg_ordo` date DEFAULT NULL,
  `somme` int(32) DEFAULT '0',
  `payer` int(32) DEFAULT '0',
  `remise` int(16) DEFAULT '0',
  `etat` int(16) DEFAULT '0',
  `statut` int(16) DEFAULT '0',
  `obs` varchar(255) DEFAULT 'N/A',
  `id_fich_ordo` int(16) DEFAULT '0',
  `id_pharmacien` int(16) DEFAULT '0',
  `id_paie` int(16) DEFAULT '0',
  `etat_reg` int(16) DEFAULT '0',
  PRIMARY KEY (`id_reg_ordo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `regler_radiologie`
--

DROP TABLE IF EXISTS `regler_radiologie`;
CREATE TABLE IF NOT EXISTS `regler_radiologie` (
  `id_reg_radiologie` int(16) NOT NULL AUTO_INCREMENT,
  `ref_reg_radiologie` varchar(255) DEFAULT 'N/A',
  `id_radiologie` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `id_patient` int(16) DEFAULT '0',
  `id_medecin` int(16) DEFAULT '0',
  `id_type_radiologie` int(16) DEFAULT '0',
  `date_reg_radiologie` date DEFAULT NULL,
  `payer` int(32) DEFAULT '0',
  `somme` int(32) DEFAULT '0',
  `id_paie` int(16) DEFAULT '0',
  `id_radiologue` int(16) DEFAULT '0',
  `remise` int(16) DEFAULT '0',
  `id_caisse` int(16) NOT NULL DEFAULT '0',
  `etat` int(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_reg_radiologie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `regler_radiologie`
--

INSERT INTO `regler_radiologie` (`id_reg_radiologie`, `ref_reg_radiologie`, `id_radiologie`, `id_perso`, `id_patient`, `id_medecin`, `id_type_radiologie`, `date_reg_radiologie`, `payer`, `somme`, `id_paie`, `id_radiologue`, `remise`, `id_caisse`, `etat`) VALUES
(1, 'RAD_2024_01_1_1', 1, 0, 1, 2, 0, '2024-01-11', 0, 15200, 0, 0, 0, 0, 0),
(2, 'RAD_2024_01_2_2', 2, 0, 2, 2, 0, '2024-01-17', 0, 15700, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `retrait`
--

DROP TABLE IF EXISTS `retrait`;
CREATE TABLE IF NOT EXISTS `retrait` (
  `id_retrait` int(16) NOT NULL AUTO_INCREMENT,
  `id_banque` int(16) DEFAULT '0',
  `id_perso` int(16) DEFAULT '0',
  `motif` varchar(255) DEFAULT '0',
  `montant` int(255) DEFAULT '0',
  `date_retrait` date DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  `auteur` varchar(255) DEFAULT 'N/A',
  PRIMARY KEY (`id_retrait`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lvl` int(3) DEFAULT NULL,
  `fonction` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `lvl`, `fonction`) VALUES
(1, 1, 'PATIENT'),
(2, 2, 'CAISSIERE'),
(3, 3, 'INFIRRMIERE'),
(4, 4, 'DIRECTEUR'),
(5, 5, 'MEDECIN'),
(6, 6, 'MAGASINIER'),
(7, 7, 'SECRETAIRE'),
(8, 8, 'CHIRUGIEN'),
(9, 9, 'LABO'),
(10, 10, 'PHARMACIEN'),
(11, 11, 'COMPTABLE'),
(12, 12, 'CAISSIARE PRINCIPALE'),
(15, 13, 'REMBOURSEMENT'),
(16, 14, 'RADIOLOGUE');

-- --------------------------------------------------------

--
-- Structure de la table `salle_malade`
--

DROP TABLE IF EXISTS `salle_malade`;
CREATE TABLE IF NOT EXISTS `salle_malade` (
  `id_sal_mal` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_sal_mal`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `salle_malade`
--

INSERT INTO `salle_malade` (`id_sal_mal`, `nom`) VALUES
(1, 'Salle De Reception Numero 01'),
(2, 'Salle De Reception Femme Enceinte'),
(3, 'Sal1');

-- --------------------------------------------------------

--
-- Structure de la table `salle_soin`
--

DROP TABLE IF EXISTS `salle_soin`;
CREATE TABLE IF NOT EXISTS `salle_soin` (
  `id_sal_soin` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_sal_soin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `salle_soin`
--

INSERT INTO `salle_soin` (`id_sal_soin`, `nom`) VALUES
(1, 'Treatment Unit'),
(2, 'Ssoin');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT 'N/A',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id_service`, `nom`, `open_close`) VALUES
(1, 'Consultation', 0),
(2, 'Examen', 0),
(3, 'Hospitalisations', 0),
(4, 'Ordonnances', 0),
(5, 'Opérations', 0),
(6, 'Anesthésie', 0),
(7, 'Ecographie', 0),
(8, 'Radiologie', 0),
(9, 'Autres Services', 0);

-- --------------------------------------------------------

--
-- Structure de la table `specialiste`
--

DROP TABLE IF EXISTS `specialiste`;
CREATE TABLE IF NOT EXISTS `specialiste` (
  `id_spe` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `id_depart` int(16) NOT NULL,
  PRIMARY KEY (`id_spe`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `specialiste`
--

INSERT INTO `specialiste` (`id_spe`, `nom`, `id_depart`) VALUES
(1, 'General Practioner', 7),
(6, 'Cardiologist', 4),
(14, 'Dental Therapist', 1),
(15, 'Neorologist', 2),
(16, 'Laboratory Technician', 3),
(18, 'Gynaecologist', 9),
(19, 'Physiotherapist', 12),
(20, 'Midwife', 14),
(21, 'Pediatrician ', 15),
(22, 'Midwife', 16),
(25, 'Surgeon', 17),
(26, 'Ent Specialists', 21),
(27, 'Pharmacy Technician', 20),
(28, 'Radiologist / Technologist', 13),
(29, 'Spe1', 2);

-- --------------------------------------------------------

--
-- Structure de la table `transfert_caisse`
--

DROP TABLE IF EXISTS `transfert_caisse`;
CREATE TABLE IF NOT EXISTS `transfert_caisse` (
  `id_trans_caisse` int(16) NOT NULL AUTO_INCREMENT,
  `id_caisse_src` int(16) DEFAULT NULL,
  `nom_caisse_src` varchar(255) DEFAULT 'N/A',
  `id_perso_src` int(16) DEFAULT '0',
  `id_caisse_dst` int(16) DEFAULT NULL,
  `nom_caisse_dst` varchar(255) DEFAULT 'N/A',
  `id_perso_dst` int(16) DEFAULT '0',
  `quantite` int(16) DEFAULT '0',
  `date_trans_caisse` date DEFAULT NULL,
  `etat` int(11) DEFAULT '0',
  `date_valide` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_trans_caisse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type_anes`
--

DROP TABLE IF EXISTS `type_anes`;
CREATE TABLE IF NOT EXISTS `type_anes` (
  `id_type_anes` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT 'N/A',
  `prix_t_anes` int(255) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_type_anes`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_anes`
--

INSERT INTO `type_anes` (`id_type_anes`, `nom`, `prix_t_anes`, `open_close`) VALUES
(1, 'Anes', 500, 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_consul`
--

DROP TABLE IF EXISTS `type_consul`;
CREATE TABLE IF NOT EXISTS `type_consul` (
  `id_type_consul` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix_t_consul` int(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_type_consul`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_consul`
--

INSERT INTO `type_consul` (`id_type_consul`, `nom`, `prix_t_consul`, `open_close`) VALUES
(1, 'Consultation complète', 450000, 0),
(2, 'consul de soins', 10000, 0),
(3, 'consul à Domicile', 25000, 0),
(4, 'Andy', 0, 1),
(5, 'General Consultation Day', 1000, 0),
(6, 'General Consultation Night', 2000, 0),
(7, 'Gynecological Consultation', 5000, 0),
(8, 'Circumcision 0-1 Month', 5000, 0),
(9, 'Circumcision 1 Month-1 Year', 10000, 0),
(10, 'Circumcision 1 Year-2 Years', 15000, 0),
(11, 'Circumcision Adulecent 2 Years Plus', 25000, 0),
(12, 'Delivery ( Including Oxytocin, Cord Crap, Vitk', 30000, 0),
(13, 'Suturing Plus Sutures', 5000, 0),
(14, 'Ear Bursting', 1000, 0),
(15, 'Injection Fee', 500, 0),
(16, 'Bed Fee Per Night', 2000, 0),
(17, 'Nursing Care', 1000, 0),
(18, 'Anc Booking', 5500, 0),
(19, 'Anc Visit', 2500, 0),
(20, 'Anc Card', 1000, 0),
(21, 'Oxygen Concentrator Per Hour', 500, 0),
(22, 'Consultation Card', 300, 0),
(23, 'Vip Room Per Night', 6000, 0),
(24, 'Wound Dressing', 500, 0),
(25, 'Plaster And Gloves', 500, 0),
(26, 'Inplanon Plus Procedure', 5000, 0),
(27, 'Transfusion Fee', 2000, 0),
(28, 'Uterine Revision', 25000, 0),
(29, 'Col', 500, 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_echantillon`
--

DROP TABLE IF EXISTS `type_echantillon`;
CREATE TABLE IF NOT EXISTS `type_echantillon` (
  `id_type_echantillon` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_type_echantillon`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_echantillon`
--

INSERT INTO `type_echantillon` (`id_type_echantillon`, `nom`, `open_close`) VALUES
(1, 'Urine', 1),
(2, 'Sang', 0),
(3, 'Plasma', 0),
(4, 'Urines', 1),
(5, 'Urine', 0),
(6, 'Eau', 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_eco`
--

DROP TABLE IF EXISTS `type_eco`;
CREATE TABLE IF NOT EXISTS `type_eco` (
  `id_type_eco` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix_t_eco` int(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_type_eco`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_eco`
--

INSERT INTO `type_eco` (`id_type_eco`, `nom`, `prix_t_eco`, `open_close`) VALUES
(1, 'Pelvic Echography', 7000, 0),
(2, 'Abdominal Echography', 10000, 0),
(3, 'Pelvic Abdominal Echography', 15000, 0),
(4, 'Eco', 500, 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_exa`
--

DROP TABLE IF EXISTS `type_exa`;
CREATE TABLE IF NOT EXISTS `type_exa` (
  `id_type_exa` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix_t_exa` int(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  `id_cat_exa` int(16) DEFAULT '0',
  `description` varchar(255) DEFAULT 'N/A',
  PRIMARY KEY (`id_type_exa`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `type_exa`
--

INSERT INTO `type_exa` (`id_type_exa`, `nom`, `prix_t_exa`, `open_close`, `id_cat_exa`, `description`) VALUES
(1, 'Acth', 8000, 0, 0, 'OKlml'),
(2, 'Alt(gpt)', 3000, 0, 0, 'N/A'),
(3, 'Amylase', 3000, 0, 0, 'N/A'),
(4, 'Aslo', 3000, 0, 0, 'N/A'),
(5, 'Ast (got)', 3000, 0, 0, 'N/A'),
(6, 'Beta Hcg', 8000, 0, 0, 'N/A'),
(7, 'Bilan Therapeutique', 11000, 0, 0, 'N/A'),
(8, 'Bilirubine Titale /direste', 6500, 0, 0, 'N/A'),
(10, 'Blood Group', 2000, 0, 0, 'N/A'),
(11, 'Blood Surgar/glycemie', 1000, 0, 0, 'N/A'),
(12, 'Calcium', 2500, 0, 0, 'N/A'),
(13, 'Chlamydia Igg+igm Elisa', 11000, 0, 0, 'N/A'),
(14, 'Dcholesterol', 1500, 0, 0, 'N/A'),
(15, 'Compatibiliyty', 1500, 0, 0, 'N/A'),
(16, 'Copro Culture/stool Culture', 8000, 0, 0, 'N/A'),
(17, 'Cortisol', 14000, 0, 0, 'N/A'),
(18, 'Creatinine', 2000, 0, 0, 'N/A'),
(19, 'Crp', 3000, 0, 0, 'N/A'),
(20, 'Csf Analysis', 8000, 0, 0, 'N/A'),
(23, 'Electrophoresis', 8000, 0, 0, 'N/A'),
(24, 'Esr', 1000, 0, 0, 'N/A'),
(25, 'Filaria (skin Snip', 1500, 0, 0, 'N/A'),
(26, 'Fsh', 8000, 0, 0, 'N/A'),
(27, 'Gpt/got', 7000, 0, 0, 'N/A'),
(28, 'H, Pyloti (helicobacter Pylori)', 2500, 0, 0, 'N/A'),
(29, 'Hbcab (aghb) Elisa', 8000, 0, 0, 'N/A'),
(30, 'Hbeab Elisa', 8000, 0, 0, 'N/A'),
(31, 'Hbeag Elsa', 8000, 0, 0, 'N/A'),
(32, 'Hbsab Elisa', 8000, 0, 0, 'N/A'),
(33, 'Hcte', 1000, 0, 0, 'N/A'),
(34, 'Hcv Antibody (achvc)elisa', 8000, 0, 0, 'N/A'),
(35, 'Hdl-c', 2000, 0, 0, 'N/A'),
(36, 'Hepatitis B( Aghbs', 2000, 0, 0, 'N/A'),
(37, 'Hepatitis C', 3000, 0, 0, 'N/A'),
(38, 'Hiv', 1000, 0, 0, 'N/A'),
(39, 'Hiv 1&2 Elisa', 5000, 0, 0, 'N/A'),
(40, 'Hiv Screening Pregant Women', 500, 0, 0, 'N/A'),
(41, 'Hp,mp,ge/tdr', 1700, 0, 0, 'N/A'),
(42, 'Iono Complet (k+,cl-ca++,mg++,na+)', 14000, 0, 0, 'N/A'),
(43, 'Ldl-c', 2000, 0, 0, 'N/A'),
(44, 'Lh', 8000, 0, 0, 'N/A'),
(45, 'Magnesium', 3000, 0, 0, 'N/A'),
(46, 'Mf (skin/snip)', 1000, 0, 0, 'N/A'),
(48, 'Nfs/fbc', 4000, 0, 0, 'N/A'),
(49, 'Occult Blood', 2000, 0, 0, 'N/A'),
(50, 'Oestradiol', 8000, 0, 0, 'N/A'),
(51, 'Bleeding Time(pt) Prothobine Time (ts)', 3000, 0, 0, 'N/A'),
(52, 'Ear Swap', 1500, 0, 0, 'N/A'),
(53, 'Ecbu Urine Culture', 8000, 0, 0, 'N/A'),
(54, 'Mycoplasma', 14000, 0, 0, 'N/A'),
(55, 'Lipid Profile (ldl, Htl, Cholesterol, Triglyceride)', 11000, 0, 0, 'N/A'),
(56, 'P,u +atb', 8000, 0, 0, 'N/A'),
(57, 'P,u Simple', 2000, 0, 0, 'N/A'),
(58, 'Parathomone', 9000, 0, 0, 'N/A'),
(59, 'Pcv Simple', 1500, 0, 0, 'N/A'),
(60, 'Pcv+atb', 8000, 0, 0, 'N/A'),
(61, 'Phosphore', 2000, 0, 0, 'N/A'),
(62, 'Potassium', 1200, 0, 0, 'N/A'),
(63, 'Pregnancy Test', 1500, 0, 0, 'N/A'),
(64, 'Pre-therapeutic Check,bilan, Pretheratique', 11000, 0, 0, 'N/A'),
(65, 'Progesterone', 8000, 0, 0, 'N/A'),
(66, 'Prolactine', 8000, 0, 0, 'N/A'),
(67, 'Proteines', 2000, 0, 0, 'N/A'),
(68, 'Pus Culture', 8000, 0, 0, 'N/A'),
(69, 'Rhematoid', 4000, 0, 0, 'N/A'),
(70, 'Rubella Igg+igm Elisa', 1500, 0, 0, 'N/A'),
(71, 'Sodium', 3000, 0, 0, 'N/A'),
(72, 'Spermograme', 9000, 0, 0, 'N/A'),
(73, 'Sterile Specular (plastic)', 1000, 0, 0, 'N/A'),
(74, 'Stool Culture, Coproculture', 8000, 0, 0, 'N/A'),
(75, 'Stool Test', 1000, 0, 0, 'N/A'),
(76, 'Tdr', 1000, 0, 0, 'N/A'),
(77, 'Testosterone', 8000, 0, 0, 'N/A'),
(78, 'Totale-c', 2000, 0, 0, 'N/A'),
(79, 'Toxoplasma Igg + Igm Elisa', 8000, 0, 0, 'N/A'),
(80, 'Tpha (syphilis)', 3500, 0, 0, 'N/A'),
(81, 'Triglyceride', 4000, 0, 0, 'N/A'),
(82, 'Triiodithyronine', 8000, 0, 0, 'N/A'),
(83, 'Tsh', 9000, 0, 0, 'N/A'),
(84, 'Typhoid Test', 3000, 0, 0, 'N/A'),
(85, 'Tyroxine(t4)', 8000, 0, 0, 'N/A'),
(86, 'Uree', 2000, 0, 0, 'N/A'),
(87, 'Uric Acid (acide Urique)', 2000, 0, 0, 'N/A'),
(88, 'Urine Biochemistry/chimie Urinaire (bu)', 1000, 0, 0, 'N/A'),
(89, 'Urine (alb&suc&ph) For Anc', 500, 0, 0, 'N/A'),
(90, 'Urine Culture', 8000, 0, 0, 'N/A'),
(91, 'Urine Microscopy (complete Urinalysis) Au', 3000, 0, 0, 'N/A'),
(92, 'Vdrl', 3000, 0, 0, 'N/A'),
(93, 'Widal/rtt', 4500, 0, 0, 'N/A'),
(94, 'Wound Culture', 8000, 0, 0, 'N/A'),
(96, 'Exam1', 2500, 0, 2, '');

-- --------------------------------------------------------

--
-- Structure de la table `type_hosp`
--

DROP TABLE IF EXISTS `type_hosp`;
CREATE TABLE IF NOT EXISTS `type_hosp` (
  `id_type_hosp` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix_t_hosp` int(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_type_hosp`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `type_hosp`
--

INSERT INTO `type_hosp` (`id_type_hosp`, `nom`, `prix_t_hosp`, `open_close`) VALUES
(1, 'Maternity', 2000, 0),
(2, 'Tope', 5000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_medecin`
--

DROP TABLE IF EXISTS `type_medecin`;
CREATE TABLE IF NOT EXISTS `type_medecin` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `label` varchar(32) DEFAULT NULL,
  `type_m` varchar(5) DEFAULT NULL,
  `open_close` int(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `type_medecin`
--

INSERT INTO `type_medecin` (`id`, `label`, `type_m`, `open_close`) VALUES
(1, ' Interne', ' I', 0),
(2, 'Externe', 'E', 0),
(3, 'N/A', 'N/A', 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_medi`
--

DROP TABLE IF EXISTS `type_medi`;
CREATE TABLE IF NOT EXISTS `type_medi` (
  `id_type_medi` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `open_close` int(11) DEFAULT '0',
  PRIMARY KEY (`id_type_medi`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_medi`
--

INSERT INTO `type_medi` (`id_type_medi`, `nom`, `open_close`) VALUES
(4, 'TABLET', 0),
(5, 'AMPOULE', 0),
(6, 'SYRUP', 1),
(7, 'SOLUTION', 0),
(8, 'SYRUP/BOTTLE', 0),
(9, 'SUPPO', 0),
(10, 'OINTMENT', 0),
(11, 'SYROP', 0),
(12, 'VIAL', 0),
(13, 'POWDER', 0),
(14, 'CAPSULE', 0),
(15, 'ROLL', 0),
(16, 'SACHET', 0),
(17, 'PIECE', 0),
(18, 'TUBE', 0),
(19, 'SYRUP/BTTLE', 1),
(20, 'INJECT', 0),
(21, 'DERVICE', 0),
(22, 'EYE DROP', 0),
(23, 'MEASURE', 0),
(24, 'PAD', 0),
(25, 'IV/BOTTLE', 0),
(26, 'DROP', 0),
(27, 'PAIR', 0),
(28, 'IV/PIECE', 0),
(29, 'OVULES', 0),
(30, 'EFFERV', 0),
(31, 'CREAM', 0),
(32, 'DRINKABLE', 0),
(33, 'SOAP', 0),
(34, 'EMULSION', 0),
(35, 'PER/CHILD', 0),
(36, 'PER/PERSON', 0),
(37, 'TWINS', 0),
(38, 'PER NIGHT', 0),
(39, 'LOTION', 0),
(40, 'SPRAY', 0),
(41, 'PER/HOUR', 0),
(42, 'LABORATORY', 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_ope`
--

DROP TABLE IF EXISTS `type_ope`;
CREATE TABLE IF NOT EXISTS `type_ope` (
  `id_type_ope` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix_t_ope` int(255) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_type_ope`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `type_ope`
--

INSERT INTO `type_ope` (`id_type_ope`, `nom`, `prix_t_ope`, `open_close`) VALUES
(1, '3rd Degree Tear Repair', 30000, 0),
(2, 'Achillis Tendon Repair', 100000, 0),
(3, 'Acute Abdomen', 250000, 0),
(4, 'Adenoamygdalectomie/adenotonsillectomy', 250000, 0),
(5, '. Adenomectomy(adenomectomie)', 240000, 0),
(6, 'Apendicetomy Hernia Under Ga', 180000, 0),
(7, ' Arthrotomy , Knee', 165000, 0),
(8, 'Bartholin.s Cyst', 45000, 0),
(9, 'Bilateral Hemeorapy', 180000, 0),
(10, 'Bilateral Tubal Ligation With G.a', 180000, 0),
(11, 'Bim Au Fauteuil', 80000, 0),
(12, 'Bowel Perforation And Peritonitis', 250000, 0),
(13, 'Caesarian Section Twins', 220000, 0),
(14, 'Caeserian Section Single', 180000, 0),
(15, 'Cerclage', 100000, 0),
(16, 'Cerclage With Anaesthesia', 150000, 0),
(17, 'Cholecystectomy+ Scototomy', 120000, 0),
(18, 'Churirgie Du Cou(neck Surgery)', 330000, 0),
(19, 'Cilvate', 80000, 0),
(20, 'Complicated Sugery Minor', 50000, 0),
(21, 'Complicated Surgery Major', 100000, 0),
(22, 'Complication Surgery', 250000, 0),
(23, 'Coplication Surgery', 25000, 0),
(24, 'Cystectomy Bilateral', 180000, 0),
(25, 'Cystectomy Multilateral', 250000, 0),
(26, 'Cystostomy With G/a', 100000, 0),
(27, 'Debridment (i/a)', 70000, 0),
(28, 'Ectopic Pregnancy Operation', 200000, 0),
(29, 'Exploratomy/laboartory&extraction Of Huge Abdominal', 360000, 0),
(30, 'Fistulectomy With G/a', 180000, 0),
(31, 'Fixation', 200000, 0),
(32, 'Forearm Double Reduction', 165000, 0),
(33, 'Forearm Open Reduction', 165000, 0),
(34, 'Forearm Simple Reduction', 50000, 0),
(35, 'Fracture', 160000, 0),
(36, 'Fracture Des Opn(opn Fracture)', 80000, 0),
(37, 'Fracture(complicated)', 360000, 0),
(38, 'Fracture(double Reduction)', 180000, 0),
(39, 'Fracture(open Reduction)', 180000, 0),
(40, 'Fracture(simple Reduction)', 60000, 0),
(41, 'Fractures Des Os De La Face Necessitant Une Osteosynthese', 330000, 0),
(42, 'Haemorroidectomy', 165000, 0),
(43, 'Haeniorapy, Bilateral', 165000, 0),
(44, 'Hernia Single Ingunal', 100000, 0),
(45, 'Hernia- Bilateral Ingunal', 180000, 0),
(46, 'Hernia- Umbilical', 100000, 0),
(47, 'Hernia-epigastric(ventral)', 150000, 0),
(48, 'Humerous', 165000, 0),
(49, 'Hydrocelectomy', 165000, 0),
(50, 'Hysterectomy', 250000, 0),
(51, 'Implantation', 130000, 0),
(52, 'Infections', 80000, 0),
(53, 'Ingrowing Toe Nail (partial)', 5000, 0),
(54, 'Ingunal Testes(orchidopexy)', 180000, 0),
(55, 'Intra-peritoneal Drainage Under General Anaethesia', 100000, 0),
(56, 'Kinesis Therapy Major', 5000, 0),
(57, 'Laparotomy', 200000, 0),
(58, 'Lower Limb: Fibula', 180000, 0),
(59, 'Lower Limb: Tibia', 180000, 0),
(60, 'Lymphoma Extraction', 80000, 0),
(61, 'Lymphoma Extraction (local)', 20000, 0),
(62, 'Mastectomy Bilateral', 250000, 0),
(63, 'Mastectomy Single', 180000, 0),
(64, 'Myomectomy', 250000, 0),
(65, 'Necrosectomy- Major', 180000, 0),
(66, 'Necrosectomy- Minor', 50000, 0),
(67, 'Necrosectomy-intermediate', 100000, 0),
(68, 'Nodulectomy / Node', 50000, 0),
(69, 'Oesteotomy', 180000, 0),
(70, 'Open Reduction, Debridement+external Fixation(ext Fix)', 200000, 0),
(71, 'Open Reduction,debridement+internal ', 180000, 0),
(72, 'Orchidopexy', 180000, 0),
(73, 'Osteosynthesis', 180000, 0),
(74, 'Parotidectomie(parotidectomy)', 330000, 0),
(75, 'Patellar Tendon Repair', 200000, 0),
(76, 'Plaster Of Paris (pop)', 20000, 0),
(77, 'Plate Removal', 165000, 0),
(78, 'Quadrantectomy', 180000, 0),
(79, 'Resection Under La', 40000, 0),
(80, 'Scrotal Exploration', 125000, 0),
(81, 'Single Hernia Repairs With L/a', 100000, 0),
(82, 'Skin Grafting (local)', 40000, 0),
(83, 'Theatre Rentage(private)', 80000, 0),
(84, 'Torsion (spinal)', 160000, 0),
(85, 'Tuboplasty', 180000, 0),
(86, 'Tumour Of Jaw', 180000, 0),
(87, 'Tympanoplastie Au Fauteuil(tympanoplasty)', 80000, 0),
(88, 'Umbilical Hernia', 180000, 0),
(89, 'Vaginal Floor Repair', 120000, 0),
(90, 'Vanicosectomy', 180000, 0),
(91, 'Varicosectomy', 180000, 0),
(92, 'Ope', 500, 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_outil`
--

DROP TABLE IF EXISTS `type_outil`;
CREATE TABLE IF NOT EXISTS `type_outil` (
  `id_type_outil` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `open_close` int(11) DEFAULT '0',
  PRIMARY KEY (`id_type_outil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_outil`
--

INSERT INTO `type_outil` (`id_type_outil`, `nom`, `open_close`) VALUES
(1, 'OUTILS', 0),
(2, 'CONSUMMABLES', 0),
(3, 'MBESSE ESSAMA ', 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_radiologie`
--

DROP TABLE IF EXISTS `type_radiologie`;
CREATE TABLE IF NOT EXISTS `type_radiologie` (
  `id_type_radiologie` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix_t_radiologie` int(16) NOT NULL,
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_type_radiologie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `type_radiologie`
--

INSERT INTO `type_radiologie` (`id_type_radiologie`, `nom`, `prix_t_radiologie`, `open_close`) VALUES
(1, 'Testradio', 10000, 1),
(2, 'Testradio2', 15200, 0),
(3, 'Tr', 500, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(16) NOT NULL AUTO_INCREMENT,
  `id_perso` int(16) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lvl` int(3) NOT NULL DEFAULT '0',
  `secteur` int(3) DEFAULT '0',
  `salle` int(11) DEFAULT '0',
  `ip` varchar(40) NOT NULL DEFAULT 'N/A',
  `date` datetime DEFAULT NULL,
  `statut` varchar(2) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `id_perso`, `pseudo`, `password`, `lvl`, `secteur`, `salle`, `ip`, `date`, `statut`) VALUES
(1, 19, 'demo', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 4, 0, 0, '', NULL, 'A'),
(14, 37, 'CAISGEN', '5663e5b1b4d4ffce57666e0b646b5d01b28c7df80c4f27bba3d591c28e26824e', 12, 0, 0, '37.171.191.24', '2022-10-26 11:23:17', 'A'),
(15, 90, 'kamga', '1c0bdfd7abe91329fd7ae4011675c4042c6af5123ac80b16a52e51e2618aa679', 5, 0, 0, '154.72.162.235', '2022-12-08 09:04:48', 'A'),
(16, 87, 'sevidzem', '83ed5207a41179600b50c409a460cfc229c60cb91bf06480d705c923c864e501', 3, 0, 0, '154.72.162.235', '2022-12-08 09:10:11', 'A'),
(17, 50, 'jato', 'e010fd1ce1acc173e3b4835b7635f8d4600d774869102adb5cb7b5d7895649ba', 2, 0, 0, '154.72.162.235', '2022-12-08 09:11:50', 'A'),
(18, 52, 'ndingwandzeh', '2e48eb1e0a333ca20bbb4227e0d3ec909cb550e07e78d99f051f563b003d7e27', 10, 0, 0, '154.72.162.235', '2022-12-08 09:14:15', 'A'),
(19, 46, 'okodombe', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0', 12, 0, 0, '154.72.161.204', '2023-04-04 15:56:21', 'A'),
(20, 96, 'atefo', 'c29277f55fb31aeb8d4026132e53513a1fb755e5d9c13bf21405b72b9570373f', 11, 0, 0, '154.72.163.246', '2023-04-06 09:30:53', 'A'),
(21, 96, 'fointama', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0', 4, 0, 0, '154.72.160.208', '2023-04-10 10:14:02', 'A'),
(22, 94, 'Muna', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0', 10, 0, 0, '154.72.160.171', '2023-06-01 10:15:50', 'A'),
(23, 73, 'Ndjeng', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0', 2, 0, 0, '154.72.163.51', '2023-06-06 10:47:45', 'A'),
(24, 76, 'Tankeu', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0', 11, 0, 0, '154.72.160.196', '2023-06-14 10:29:44', 'A'),
(25, 32, 'briting', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0', 11, 0, 0, '154.72.161.85', '2023-08-21 13:19:03', 'A'),
(26, 52, 'hycinth', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0', 6, 0, 0, '154.72.161.85', '2023-08-21 13:34:29', 'A'),
(27, 79, 'cais', 'f5cd04162bca44def9586421dcac3adfdbde8dba88982676ade56217a91cd6e8', 2, 0, 0, '46.193.3.81', '2023-08-24 22:00:13', 'A'),
(28, 20, 'CAISSE', '730d00f7f1b8a2f67caa2cda08b1b503c15df40e924789c5f869d481dd9dc6ea', 2, 0, 0, '::1', '2024-01-17 09:59:41', 'A'),
(29, 21, 'PHAR', '31ff3de788ec62139f933537fd7e016240ab2034babae9fd97c5426e12c6f693', 10, 0, 0, '::1', '2024-02-28 17:14:40', 'A');

-- --------------------------------------------------------

--
-- Structure de la table `users_patients`
--

DROP TABLE IF EXISTS `users_patients`;
CREATE TABLE IF NOT EXISTS `users_patients` (
  `id_users` int(16) NOT NULL AUTO_INCREMENT,
  `id_patient` int(16) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lvl` int(3) NOT NULL DEFAULT '0',
  `ip` varchar(40) NOT NULL DEFAULT 'N/A',
  `date` datetime DEFAULT NULL,
  `statut` varchar(2) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `users_specialistes`
--

DROP TABLE IF EXISTS `users_specialistes`;
CREATE TABLE IF NOT EXISTS `users_specialistes` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `id_specialiste` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `lvl` int(11) NOT NULL,
  `type_spe` varchar(15) DEFAULT 'N/A',
  `ip` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `statut` varchar(2) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_users`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id_ville` int(16) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT 'N/A',
  `id_pays` int(16) DEFAULT '0',
  `open_close` int(16) DEFAULT '0',
  PRIMARY KEY (`id_ville`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id_ville`, `nom`, `id_pays`, `open_close`) VALUES
(1, 'Yaoundé', 8, 0),
(2, 'Douala', 8, 0),
(3, 'Bafoussam ', 8, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD CONSTRAINT `medicament_ibfk_1` FOREIGN KEY (`id_type_medi`) REFERENCES `type_medi` (`id_type_medi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

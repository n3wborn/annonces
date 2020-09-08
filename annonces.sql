-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 08 sep. 2020 à 13:49
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prix` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `img_nom` varchar(255) DEFAULT NULL,
  `est_validee` tinyint(1) DEFAULT 0,
  `date_ecriture` date DEFAULT NULL,
  `date_validation` date DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id`, `prix`, `description`, `img_url`, `img_nom`, `est_validee`, `date_ecriture`, `date_validation`, `id_utilisateur`, `id_categorie`) VALUES
(1, 56, 'description de l\'annonce', '/media/image.png', 'image.png', 0, '2020-09-02', NULL, 1, 2),
(2, 34, 'Four micro-onde', '/media/four.jpg', 'four.jpg', 0, '2020-09-02', NULL, 2, 6),
(4, 23, 'tes test etst', '/media/image.jpg', 'image.jpg', 1, '2020-09-04', '2020-09-05', 3, 4),
(5, 12, 'description de l annonce', '/medias/image.jpg', 'image.jpg', 0, '2020-09-07', NULL, 4, 7),
(6, 65, 'description de l\'annonce', '/media/image.png', 'image.png', 0, '2020-09-02', NULL, 1, 2),
(7, 47, 'Four micro-onde', '/media/four.jpg', 'four.jpg', 0, '2020-09-02', NULL, 2, 6),
(8, 57, 'tes test etst', '/media/image.jpg', 'image.jpg', 1, '2020-09-04', '2020-09-05', 3, 4),
(9, 12, 'description de l annonce', '/medias/image.jpg', 'image.jpg', 0, '2020-09-07', NULL, 4, 7);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(1, 'Affaires professionnelles'),
(2, 'Animaux'),
(3, 'Auto-Moto'),
(4, 'Emploi'),
(5, 'Immobilier'),
(6, 'Services'),
(7, 'Vacances');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courriel` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `courriel`, `nom`, `prenom`, `telephone`) VALUES
(1, 'JohnDoe@domain.com', 'Doe', 'John', '06 06 06 06 06'),
(2, 'test@domain.org', 'bidule', 'machine', '06 06 06 07 07'),
(3, 'courriel@gmail.com', 'alachaussurenoir', 'Legrandblond', '07 07 07 07 07'),
(4, 'mail@maildomain.com', 'noname', 'nonick', '03 44 55 99 77');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `annonces_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

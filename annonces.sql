-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 09 oct. 2020 à 11:42
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
  `uuid` varchar(36) DEFAULT NULL,
  `prix` int(11) DEFAULT 0,
  `titre` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `img_nom` varchar(255) DEFAULT NULL,
  `est_validee` tinyint(1) DEFAULT 1,
  `date_ecriture` date DEFAULT NULL,
  `date_validation` date DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id`, `uuid`, `prix`, `titre`, `description`, `img_url`, `img_nom`, `est_validee`, `date_ecriture`, `date_validation`, `id_utilisateur`, `id_categorie`) VALUES
(29, '6778d54ae8dde161e6ae1a2efdab68ce7412', 0, 'Girafe', 'Donne girafe, trop grande pour mon petit appartement.', 'assets/549b4157b5girafe.jpg', '549b4157b5girafe.jpg', 1, '2020-09-15', '2020-09-16', 6, 2),
(30, '566f6b630ecf9024afa0d88d8918c642594b', 0, 'Cabane', 'Séjour dans les bois', 'assets/d4113dffb5Cocoon-Etoilée-carré-mise-en-avant-divi-500x355.jpg', 'd4113dffb5Cocoon-Etoilée-carré-mise-en-avant-divi-500x355.jpg', 1, '2020-09-15', '2020-09-16', 6, 7),
(32, 'd76e4da5e5815d06543b9480710eb5f10eaf', 5, 'Chaussette Banane', 'Vend chaussette Banane', 'assets/fe61f414e861ujONMm9XL._AC_UX385_.jpg', 'fe61f414e861ujONMm9XL._AC_UX385_.jpg', 1, '2020-09-15', NULL, 6, 8),
(33, '1831f5ecbfb5174d4a8b8fc8a1bc5fa0e786', 876, 'Bali', 'Voyage a Bali', 'assets/f9fd74705b222790006.jpg', 'f9fd74705b222790006.jpg', 1, '2020-09-15', NULL, 7, 7);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
(7, 'Vacances'),
(8, 'Autres');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `courriel`, `nom`, `prenom`, `telephone`) VALUES
(1, 'JohnDoe@domain.com', 'Doe', 'John', '06 06 06 06 06'),
(2, 'test@domain.org', 'bidule', 'machine', '06 06 06 07 07'),
(3, 'courriel@gmail.com', 'alachaussurenoir', 'Legrandblond', '07 07 07 07 07'),
(4, 'mail@maildomain.com', 'noname', 'nonick', '03 44 55 99 77'),
(6, 'lezervinia@gmail.com', 'Zervini', 'Léa', '0567846354'),
(7, 'lucian@ptiglo.com', 'Ptiglo', 'lucien', '0567846354');

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

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 09 sep. 2020 à 09:28
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annonces`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) DEFAULT NULL,
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
  UNIQUE KEY `uuid` (`uuid`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `annonces`
--

INSERT INTO `annonces` (`id`, `uuid`, `prix`, `description`, `img_url`, `img_nom`, `est_validee`, `date_ecriture`, `date_validation`, `id_utilisateur`, `id_categorie`) VALUES
(1, 'acd7b69f-f27e-11ea-ac75-68f7289097ce', 56, 'description de l\'annonce', '/public/assets/image.png', 'image.png', 0, '2020-09-02', NULL, 1, 2),
(2, 'acd7bbb8-f27e-11ea-ac75-68f7289097ce', 34, 'Four micro-onde', '/public/assets/four.jpg', 'four.jpg', 0, '2020-09-02', NULL, 2, 6),
(4, 'acd7bcfc-f27e-11ea-ac75-68f7289097ce', 23, 'tes test etst', '/public/assets/image.jpg', 'image.jpg', 1, '2020-09-04', '2020-09-05', 3, 4),
(5, 'acd7be31-f27e-11ea-ac75-68f7289097ce', 12, 'description de l annonce', '/public/assets/image.jpg', 'image.jpg', 0, '2020-09-07', NULL, 4, 7),
(6, 'acd7bf30-f27e-11ea-ac75-68f7289097ce', 65, 'description de l\'annonce', '/public/assets/image.png', 'image.png', 0, '2020-09-02', NULL, 1, 2),
(7, 'acd7bfe7-f27e-11ea-ac75-68f7289097ce', 47, 'Four micro-onde', '/public/assets/four.jpg', 'four.jpg', 0, '2020-09-02', NULL, 2, 6),
(8, 'acd7c0b0-f27e-11ea-ac75-68f7289097ce', 57, 'tes test etst', '/public/assets/image.jpg', 'image.jpg', 1, '2020-09-04', '2020-09-05', 3, 4),
(9, 'acd7c16c-f27e-11ea-ac75-68f7289097ce', 12, 'description de l annonce', '/public/assets/image.jpg', 'image.jpg', 0, '2020-09-07', NULL, 4, 7);

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `annonces_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

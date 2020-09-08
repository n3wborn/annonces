-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: mariadb_1
-- Generation Time: Sep 08, 2020 at 05:12 PM
-- Server version: 10.4.13-MariaDB-1:10.4.13+maria~focal
-- PHP Version: 7.4.6

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

CREATE TABLE `annonces` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) DEFAULT NULL,
  `prix` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `img_nom` varchar(255) DEFAULT NULL,
  `est_validee` tinyint(1) DEFAULT 0,
  `date_ecriture` date DEFAULT NULL,
  `date_validation` date DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `annonces`
--

INSERT INTO `annonces` (`id`, `uuid`, `prix`, `description`, `img_url`, `img_nom`, `est_validee`, `date_ecriture`, `date_validation`, `id_utilisateur`, `id_categorie`) VALUES
(1, 'a3a28a06-f1ea-11ea-9a8d-0242ac140002', 56, 'description de l\'annonce', '/media/image.png', 'image.png', 0, '2020-09-02', NULL, 1, 2),
(2, 'a3a29978-f1ea-11ea-9a8d-0242ac140002', 34, 'Four micro-onde', '/media/four.jpg', 'four.jpg', 0, '2020-09-02', NULL, 2, 6),
(4, 'a3c043a1-f1ea-11ea-9a8d-0242ac140002', 23, 'tes test etst', '/media/image.jpg', 'image.jpg', 1, '2020-09-04', '2020-09-05', 3, 4),
(5, 'a3c044cb-f1ea-11ea-9a8d-0242ac140002', 12, 'description de l annonce', '/medias/image.jpg', 'image.jpg', 0, '2020-09-07', NULL, 4, 7),
(6, 'a3c0454f-f1ea-11ea-9a8d-0242ac140002', 65, 'description de l\'annonce', '/media/image.png', 'image.png', 0, '2020-09-02', NULL, 1, 2),
(7, 'a3c045c2-f1ea-11ea-9a8d-0242ac140002', 47, 'Four micro-onde', '/media/four.jpg', 'four.jpg', 0, '2020-09-02', NULL, 2, 6),
(8, 'a3c04624-f1ea-11ea-9a8d-0242ac140002', 57, 'tes test etst', '/media/image.jpg', 'image.jpg', 1, '2020-09-04', '2020-09-05', 3, 4),
(9, 'a3c04680-f1ea-11ea-9a8d-0242ac140002', 12, 'description de l annonce', '/medias/image.jpg', 'image.jpg', 0, '2020-09-07', NULL, 4, 7);

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

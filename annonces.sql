CREATE TABLE `annonces` (
  `id` int(11) PRIMARY KEY,
  `description` varchar(255),
  `img_url` varchar(255),
  `img_nom` varchar(255),
  `est_validee` bool DEFAULT false,
  `date_ecriture` date,
  `date_validation` date,
  `id_utilisateur` int(11),
  `id_categorie` int(11)
);

CREATE TABLE `categorie` (
  `id` int(11) PRIMARY KEY,
  `libelle` varchar(50)
);

CREATE TABLE `utilisateur` (
  `id` int(11) PRIMARY KEY,
  `courriel` varchar(255),
  `nom` varchar(255),
  `prenom` varchar(255),
  `telephone` varchar(20)
);

ALTER TABLE `annonces` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

ALTER TABLE `annonces` ADD FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);

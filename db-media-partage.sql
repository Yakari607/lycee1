-- Structure de la table medias_partage
CREATE TABLE IF NOT EXISTS `medias_partage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text,
  `fichier_path` varchar(255) NOT NULL,
  `type_fichier` enum('pdf','image','video','autre') NOT NULL DEFAULT 'pdf',
  `lien_partage` varchar(100) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `vues` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lien_partage` (`lien_partage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 
-- Table pour les médias des actualités
CREATE TABLE IF NOT EXISTS `lycee1_actualites_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actualite_id` int(11) NOT NULL,
  `nom_fichier` varchar(255) NOT NULL,
  `nom_original` varchar(255) NOT NULL,
  `type_media` enum('image', 'pdf') NOT NULL,
  `taille` int(11) NOT NULL,
  `chemin` varchar(500) NOT NULL,
  `date_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `idx_actualite_id` (`actualite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table des actualités (structure de base si elle n'existe pas)
CREATE TABLE IF NOT EXISTS `lycee1_actualites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_publication` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `categorie` varchar(100) NOT NULL,
  `is_important` tinyint(1) DEFAULT 0,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_date_publication` (`date_publication`),
  KEY `idx_categorie` (`categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 
-- Structure de la table restaurant_media
CREATE TABLE IF NOT EXISTS `restaurant_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_path` varchar(255) NOT NULL,
  `description` text,
  `type` enum('image','video') NOT NULL DEFAULT 'image',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Structure de la table repas
CREATE TABLE IF NOT EXISTS `repas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour_id` int(11) NOT NULL,
  `type` enum('entree','plat','dessert') NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `allergenes` varchar(255) DEFAULT NULL,
  `vegetarien` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `jour_id` (`jour_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Structure de la table jours
CREATE TABLE IF NOT EXISTS `jours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `semaine` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contraintes pour la table repas
ALTER TABLE `repas`
  ADD CONSTRAINT `repas_ibfk_1` FOREIGN KEY (`jour_id`) REFERENCES `jours` (`id`) ON DELETE CASCADE; 
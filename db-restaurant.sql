-- Structure de la table restaurant_media
CREATE TABLE IF NOT EXISTS `restaurant_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_path` varchar(255) NOT NULL,
  `description` text,
  `type` enum('image','video') NOT NULL DEFAULT 'image',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Structure de la table categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Structure de la table jours
CREATE TABLE IF NOT EXISTS `jours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` varchar(50) NOT NULL,
  `date_semaine` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Structure de la table repas
CREATE TABLE IF NOT EXISTS `repas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `bio` tinyint(1) NOT NULL DEFAULT '0',
  `local` tinyint(1) NOT NULL DEFAULT '0',
  `vegetarien` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `jour_id` (`jour_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contraintes pour la table repas
ALTER TABLE `repas`
  ADD CONSTRAINT `repas_ibfk_1` FOREIGN KEY (`jour_id`) REFERENCES `jours` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `repas_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

-- Insertion des jours de la semaine
INSERT INTO `jours` (`jour`, `date_semaine`) VALUES
('lundi', 'Semaine du 17 au 21 juin 2024'),
('mardi', 'Semaine du 17 au 21 juin 2024'),
('mercredi', 'Semaine du 17 au 21 juin 2024'),
('jeudi', 'Semaine du 17 au 21 juin 2024'),
('vendredi', 'Semaine du 17 au 21 juin 2024');

-- Insertion des catégories de repas
INSERT INTO `categories` (`nom`) VALUES
('Entrée'),
('Plat principal'),
('Accompagnement'),
('Fromage'),
('Dessert'); 
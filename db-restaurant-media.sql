-- Structure de la table restaurant_media
CREATE TABLE IF NOT EXISTS `restaurant_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_path` varchar(255) NOT NULL,
  `description` text,
  `type` enum('image','video') NOT NULL DEFAULT 'image',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 
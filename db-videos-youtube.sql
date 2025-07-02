-- Structure de la table videos_youtube pour gérer les vidéos YouTube du lycée
CREATE TABLE IF NOT EXISTS `videos_youtube` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text,
  `url_youtube` varchar(500) NOT NULL,
  `video_id` varchar(20) NOT NULL,
  `categorie` varchar(100) DEFAULT 'Général',
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_publication` date DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `ordre_affichage` int(11) DEFAULT 0,
  `vues` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `video_id` (`video_id`),
  KEY `idx_categorie` (`categorie`),
  KEY `idx_actif` (`actif`),
  KEY `idx_ordre` (`ordre_affichage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion de quelques vidéos d'exemple
INSERT INTO `videos_youtube` (`titre`, `description`, `url_youtube`, `video_id`, `categorie`, `date_publication`, `ordre_affichage`) VALUES
('Présentation du Lycée Jean-Mermoz', 'Découvrez notre établissement et ses valeurs', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'dQw4w9WgXcQ', 'Présentation', '2024-01-15', 1),
('Portes ouvertes 2024', 'Retour en images sur nos portes ouvertes', 'https://www.youtube.com/watch?v=9bZkp7q19f0', '9bZkp7q19f0', 'Événements', '2024-02-20', 2),
('Formation BTS MCO', 'Découvrez notre formation BTS Management Commercial Opérationnel', 'https://www.youtube.com/watch?v=ZZ5LpwO-An4', 'ZZ5LpwO-An4', 'Formations', '2024-03-10', 3);

-- Note: Les video_id sont des exemples. Remplacez-les par de vrais IDs YouTube. 
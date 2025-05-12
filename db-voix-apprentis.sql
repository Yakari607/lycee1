-- Structure de la table voix_apprentis_journaux
CREATE TABLE IF NOT EXISTS `voix_apprentis_journaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `date_publication` date NOT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `fichier_pdf` varchar(255) NOT NULL,
  `is_supplement` tinyint(1) NOT NULL DEFAULT 0,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero` (`numero`,`is_supplement`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion de quelques exemples de journaux
INSERT INTO `voix_apprentis_journaux` (`numero`, `date_publication`, `theme`, `description`, `image`, `fichier_pdf`, `is_supplement`) VALUES
(44, '2023-06-01', NULL, 'Dernière édition de La Voix des Apprentis', 'images/voix-apprentis/journal44.jpg', 'uploads/voix-apprentis/journal44.pdf', 0),
(43, '2022-12-01', NULL, 'Edition de décembre 2022', 'images/voix-apprentis/journal43.jpg', 'uploads/voix-apprentis/journal43.pdf', 0),
(42, '2022-06-01', NULL, 'Edition de juin 2022', 'images/voix-apprentis/journal42.jpg', 'uploads/voix-apprentis/journal42.pdf', 0),
(41, '2021-12-01', NULL, 'Edition de décembre 2021', 'images/voix-apprentis/journal41.jpg', 'uploads/voix-apprentis/journal41.pdf', 0),
(40, '2021-06-01', NULL, 'Edition de juin 2021', 'images/voix-apprentis/journal40.jpg', 'uploads/voix-apprentis/journal40.pdf', 0),
(39, '2020-12-01', NULL, 'Edition de décembre 2020', 'images/voix-apprentis/journal39.jpg', 'uploads/voix-apprentis/journal39.pdf', 0),
(38, '2020-06-01', 'Décembre 2021', 'Edition de juin 2020', 'images/voix-apprentis/journal38.jpg', 'uploads/voix-apprentis/journal38.pdf', 0),
(37, '2019-12-01', 'Mai 2021', 'Edition de décembre 2019', 'images/voix-apprentis/journal37.jpg', 'uploads/voix-apprentis/journal37.pdf', 0),
(37, '2019-12-01', 'Supplément', 'Supplément à l\'édition de décembre 2019', 'images/voix-apprentis/journal37-supplement.jpg', 'uploads/voix-apprentis/journal37-supplement.pdf', 1); 
-- Structure de la table plaquettes
CREATE TABLE IF NOT EXISTS `plaquettes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `fichier_pdf` varchar(255) NOT NULL,
  `image_couverture` varchar(255) DEFAULT NULL,
  `pages_affichage` text NOT NULL COMMENT 'Pages où afficher la plaquette (JSON)',
  `couleur_fond` varchar(7) DEFAULT '#3498db' COMMENT 'Couleur de fond en hexadécimal',
  `ordre_affichage` int(11) DEFAULT 0 COMMENT 'Ordre d\'affichage sur les pages',
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modification` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion d'exemples de plaquettes
INSERT INTO `plaquettes` (`titre`, `description`, `fichier_pdf`, `image_couverture`, `pages_affichage`, `couleur_fond`, `ordre_affichage`, `actif`) VALUES
('Bac Pro MSPC', '12 places proposées au lycée Jean-Mermoz', 'uploads/plaquettes/bac-pro-mspc.pdf', 'images/plaquettes/bac-pro-mspc.jpg', '["bac-pro-mspc.php", "index.php"]', '#4a90e2', 1, 1),
('Plaquette Bac Pro MSPC par Apprentissage', 'Formation par apprentissage', 'uploads/plaquettes/bac-pro-mspc-apprentissage.pdf', 'images/plaquettes/bac-pro-mspc-apprentissage.jpg', '["bac-pro-mspc.php"]', '#27ae60', 2, 1); 
-- Structure de la table admin_users pour un système d'authentification plus sécurisé
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('admin','moderator') NOT NULL DEFAULT 'admin',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login` timestamp NULL DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion d'un utilisateur administrateur par défaut
-- Mot de passe : Grandhaye2025 (haché avec password_hash())
INSERT INTO `admin_users` (`username`, `password_hash`, `email`, `role`) VALUES
('admin', '$2y$10$u7vwEPp74YpKKu8asGj2puZEFxsDS/QBZhuRdbtlNkdP.2txFBpxO', 'admin@lyceemermoz.fr', 'admin');

-- Note: Pour créer un nouveau mot de passe haché, utilisez cette commande PHP :
-- echo password_hash('VotreNouveauMotDePasse', PASSWORD_DEFAULT); 
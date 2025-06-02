-- Script pour renommer les tables existantes avec le préfixe lycee1_
-- Exécutez ce script sur votre base de données si vous avez déjà des tables créées

-- Renommer les tables (ajoutez toutes vos tables ici)
RENAME TABLE actualites TO lycee1_actualites;
RENAME TABLE medias_partage TO lycee1_medias_partage;
RENAME TABLE voix_apprentis_journaux TO lycee1_voix_apprentis_journaux;
RENAME TABLE jours TO lycee1_jours;
RENAME TABLE categories TO lycee1_categories;
RENAME TABLE restaurant_media TO lycee1_restaurant_media;
-- RENAME TABLE your_table TO lycee1_your_table; -- Décommentez et remplacez si nécessaire

-- Si vous avez de nouvelles tables à créer, utilisez le préfixe dans leur nom
-- Exemple :
-- CREATE TABLE lycee1_nouvelle_table (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     nom VARCHAR(255) NOT NULL
-- );

-- Note: Si vous avez des contraintes de clé étrangère, vous devrez peut-être 
-- les supprimer avant de renommer les tables, puis les recréer après. 
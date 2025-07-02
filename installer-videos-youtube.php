<?php
/**
 * Script d'installation pour la table videos_youtube
 * Ce script crée la table et insère quelques vidéos d'exemple
 */

// Inclure la connexion à la base de données
require_once 'includes/db_connect.php';

echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Installation - Vidéos YouTube</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; line-height: 1.6; }
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        .container { max-width: 800px; margin: 0 auto; }
        .step { margin: 1rem 0; padding: 1rem; border-left: 4px solid #007bff; background: #f8f9fa; }
        .btn { display: inline-block; padding: 0.5rem 1rem; background: #007bff; color: white; text-decoration: none; border-radius: 4px; margin: 0.5rem 0.5rem 0.5rem 0; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🎥 Installation du système de vidéos YouTube</h1>";

try {
    echo "<div class='step'>
        <h3>Étape 1 : Vérification de la connexion à la base de données</h3>";
    
    // Test de connexion
    $db->query("SELECT 1");
    echo "<p class='success'>✅ Connexion à la base de données réussie</p>";
    
    echo "</div>";
    
    echo "<div class='step'>
        <h3>Étape 2 : Création de la table videos_youtube</h3>";
    
    // Création de la table
    $sql_create_table = "
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
    ";
    
    $db->exec($sql_create_table);
    echo "<p class='success'>✅ Table videos_youtube créée avec succès</p>";
    
    echo "</div>";
    
    echo "<div class='step'>
        <h3>Étape 3 : Vérification de l'existence de données</h3>";
    
    // Vérifier si des données existent déjà
    $stmt = $db->query("SELECT COUNT(*) FROM videos_youtube");
    $count = $stmt->fetchColumn();
    
    if ($count > 0) {
        echo "<p class='info'>ℹ️ La table contient déjà $count vidéo(s)</p>";
        echo "<p class='info'>Aucune donnée d'exemple n'a été ajoutée pour éviter les doublons</p>";
    } else {
        echo "<p class='info'>ℹ️ La table est vide, ajout de vidéos d'exemple...</p>";
        
        // Insertion de vidéos d'exemple
        $videos_exemple = [
            [
                'titre' => 'Présentation du Lycée Jean-Mermoz',
                'description' => 'Découvrez notre établissement, ses valeurs et son projet éducatif',
                'url_youtube' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'video_id' => 'dQw4w9WgXcQ',
                'categorie' => 'Présentation',
                'date_publication' => '2024-01-15',
                'ordre_affichage' => 1
            ],
            [
                'titre' => 'Portes ouvertes 2024',
                'description' => 'Retour en images sur nos portes ouvertes et les moments forts',
                'url_youtube' => 'https://www.youtube.com/watch?v=9bZkp7q19f0',
                'video_id' => '9bZkp7q19f0',
                'categorie' => 'Événements',
                'date_publication' => '2024-02-20',
                'ordre_affichage' => 2
            ],
            [
                'titre' => 'Formation BTS MCO',
                'description' => 'Découvrez notre formation BTS Management Commercial Opérationnel',
                'url_youtube' => 'https://www.youtube.com/watch?v=ZZ5LpwO-An4',
                'video_id' => 'ZZ5LpwO-An4',
                'categorie' => 'Formations',
                'date_publication' => '2024-03-10',
                'ordre_affichage' => 3
            ]
        ];
        
        $stmt = $db->prepare("
            INSERT INTO videos_youtube 
            (titre, description, url_youtube, video_id, categorie, date_publication, ordre_affichage) 
            VALUES (:titre, :description, :url_youtube, :video_id, :categorie, :date_publication, :ordre_affichage)
        ");
        
        foreach ($videos_exemple as $video) {
            $stmt->execute($video);
        }
        
        echo "<p class='success'>✅ " . count($videos_exemple) . " vidéo(s) d'exemple ajoutée(s)</p>";
        echo "<p class='info'>Note: Les video_id sont des exemples. Remplacez-les par de vrais IDs YouTube.</p>";
    }
    
    echo "</div>";
    
    echo "<div class='step'>
        <h3>Étape 4 : Vérification finale</h3>";
    
    // Vérification finale
    $stmt = $db->query("SELECT COUNT(*) FROM videos_youtube");
    $final_count = $stmt->fetchColumn();
    
    echo "<p class='success'>✅ Installation terminée avec succès !</p>";
    echo "<p class='info'>La table videos_youtube contient $final_count vidéo(s)</p>";
    
    echo "</div>";
    
    echo "<div class='step'>
        <h3>🎉 Installation réussie !</h3>
        <p>Le système de vidéos YouTube est maintenant prêt à être utilisé.</p>
        <p><strong>Prochaines étapes :</strong></p>
        <ul>
            <li>Accédez à l'<a href='admin/videos-youtube-admin.php'>administration des vidéos</a> pour gérer vos vidéos</li>
            <li>Visitez la <a href='videos-youtube.php'>page publique des vidéos</a> pour voir le résultat</li>
            <li>Remplacez les vidéos d'exemple par vos vraies vidéos YouTube</li>
        </ul>
    </div>";
    
} catch (PDOException $e) {
    echo "<div class='step'>
        <h3>❌ Erreur lors de l'installation</h3>
        <p class='error'>Erreur : " . $e->getMessage() . "</p>
        <p>Vérifiez que :</p>
        <ul>
            <li>La base de données est accessible</li>
            <li>L'utilisateur a les droits de création de tables</li>
            <li>Le fichier includes/db_connect.php est correctement configuré</li>
        </ul>
    </div>";
}

echo "<div style='margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 4px;'>
    <h3>Liens utiles</h3>
    <a href='admin/videos-youtube-admin.php' class='btn'>Administration des vidéos</a>
    <a href='videos-youtube.php' class='btn'>Page publique des vidéos</a>
    <a href='admin/index.php' class='btn'>Retour à l'administration</a>
    <a href='index.php' class='btn'>Accueil du site</a>
</div>

</div>
</body>
</html>";
?> 
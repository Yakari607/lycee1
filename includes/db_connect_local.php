<?php
// Configuration pour le développement local
// Renommez ce fichier en db_connect.php pour utiliser la configuration locale

// Paramètres de connexion à la base de données locale
$host = 'localhost';
$dbname = 'lycee1';
$user = 'root';
$password = '';

// Préfixe pour les tables de ce projet (pour éviter les conflits dans une base partagée)
$table_prefix = 'lycee1_';

// Création de la connexion
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Configuration pour afficher les erreurs PDO
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Affiche l'erreur de connexion (à désactiver en production en remplaçant par une page d'erreur générique)
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    die();
}
?> 
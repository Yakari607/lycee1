<?php
// Paramètres de connexion à la base de données
$host = 'lyceemerqagora.mysql.db'; // Généralement fourni par votre hébergeur
$dbname = 'lyceemerqagora';  // Nom de la base de données que vous avez créée sur l'hébergeur
$user = 'lyceemerqagora';      // Nom d'utilisateur MySQL fourni par votre hébergeur
$password = 'Mermoz68300Illzach';      // Mot de passe MySQL fourni par votre hébergeur

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
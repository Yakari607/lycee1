<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'lycee1';
$user = 'root';
$password = '';

// Création de la connexion
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Configuration pour afficher les erreurs PDO
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    die();
}
?> 
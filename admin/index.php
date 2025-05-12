<?php
// Inclure les fonctions et la connexion à la base de données
require_once '../includes/functions.php';
require_once '../includes/db_connect.php';

// Démarrer la session
session_start();

// Rediriger vers la page d'accueil de l'administration
header('Location: actualites-admin.php');
exit;
?> 
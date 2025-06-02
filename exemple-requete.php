<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

// AVANT: Requête SQL sans utiliser le préfixe
// $stmt = $db->query("SELECT * FROM actualites ORDER BY date_publication DESC LIMIT 5");

// APRÈS: Utilisez la fonction addTablePrefix pour ajouter automatiquement le préfixe
$sql = "SELECT * FROM actualites ORDER BY date_publication DESC LIMIT 5";
$sql_with_prefix = addTablePrefix($sql);
$stmt = $db->query($sql_with_prefix);

// Vous pouvez aussi l'utiliser directement dans les requêtes préparées
$id = 1;
$sql = "SELECT * FROM medias_partage WHERE id = :id";
$stmt = $db->prepare(addTablePrefix($sql));
$stmt->bindParam(':id', $id);
$stmt->execute();

// Pour l'utiliser partout dans votre projet, vous devrez modifier toutes les requêtes SQL
// dans vos fichiers .php en utilisant cette fonction.

echo "<p>Exemple d'une requête SQL avec préfixe : " . htmlspecialchars($sql_with_prefix) . "</p>";
?> 
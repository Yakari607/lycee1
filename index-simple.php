<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lycée Jean-Mermoz - Saint-Louis</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <h1>Test du Lycée Jean-Mermoz</h1>
    <p>Si vous voyez cette page, le problème est résolu.</p>
    
    <?php
    // Test de base
    echo "<p>PHP fonctionne correctement.</p>";
    echo "<p>Date actuelle : " . date('Y-m-d H:i:s') . "</p>";
    ?>
    
    <p><a href="debug.php">Lancer le test de débogage</a></p>
    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>

</body>
</html> 
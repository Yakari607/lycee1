<?php
// Test simple du système de médias pour actualités
require_once 'includes/db_connect.php';
require_once 'includes/actualite-functions.php';

// Exemple de contenu avec shortcodes
$exemple_contenu = "Voici une actualité avec des médias intégrés.

Nous pouvons ajouter une image centrée :
[image id=\"1\" align=\"center\"]

Ou encore une image alignée à gauche :
[image id=\"2\" align=\"left\"]

Et voici un document PDF important :
[pdf id=\"3\" title=\"Règlement intérieur 2024\"]

Fin de l'actualité.";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Médias Actualités</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/actualite.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container" style="max-width: 800px; margin: 2rem auto; padding: 2rem;">
        <h1>Test du système de médias</h1>
        
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin: 2rem 0;">
            <h3>Comment utiliser :</h3>
            <ol>
                <li>Aller dans l'admin : <a href="admin/actualites-admin.php">admin/actualites-admin.php</a></li>
                <li>Créer ou éditer une actualité</li>
                <li>Cliquer sur "Sélectionner des fichiers" pour uploader</li>
                <li>Copier-coller les codes dans le contenu</li>
            </ol>
        </div>
        
        <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 8px; margin: 2rem 0;">
            <h3>Shortcodes disponibles :</h3>
            <ul>
                <li><code>[image id="123" align="center"]</code> - Image centrée</li>
                <li><code>[image id="123" align="left"]</code> - Image à gauche</li>
                <li><code>[image id="123" align="right"]</code> - Image à droite</li>
                <li><code>[pdf id="123" title="Mon PDF"]</code> - Document PDF</li>
                <li><code>[media id="123"]</code> - Média générique</li>
            </ul>
        </div>
        
        <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3>Exemple de rendu :</h3>
            <div class="actualite-text">
                <?php echo process_actualite_content($exemple_contenu, 1); ?>
            </div>
        </div>
        
        <div style="margin-top: 2rem; text-align: center;">
            <a href="admin/actualites-admin.php" style="display: inline-block; background: #007bff; color: white; padding: 1rem 2rem; text-decoration: none; border-radius: 8px; font-weight: 600;">
                <i class="fas fa-cog"></i> Aller à l'administration
            </a>
        </div>
    </div>
</body>
</html> 
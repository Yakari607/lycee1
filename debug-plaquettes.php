<?php
// Script de debug pour les plaquettes
require_once 'includes/db_connect.php';

echo "<h1>Debug des plaquettes</h1>";

try {
    // Récupérer toutes les plaquettes
    $stmt = $db->prepare("SELECT * FROM plaquettes ORDER BY id DESC");
    $stmt->execute();
    $plaquettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Nombre de plaquettes en base: " . count($plaquettes) . "</h2>";
    
    if (count($plaquettes) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Titre</th><th>Actif</th><th>Pages d'affichage</th><th>Fichier PDF</th><th>Image</th></tr>";
        
        foreach ($plaquettes as $plaquette) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($plaquette['id']) . "</td>";
            echo "<td>" . htmlspecialchars($plaquette['titre']) . "</td>";
            echo "<td>" . ($plaquette['actif'] ? 'Oui' : 'Non') . "</td>";
            echo "<td>" . htmlspecialchars($plaquette['pages_affichage']) . "</td>";
            echo "<td>" . htmlspecialchars($plaquette['fichier_pdf']) . "</td>";
            echo "<td>" . htmlspecialchars($plaquette['image_couverture']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Test spécifique pour cap-psr.php
        echo "<h2>Test pour la page cap-psr.php</h2>";
        
        $page_name = 'cap-psr.php';
        $plaquettes_filtered = [];
        
        foreach ($plaquettes as $plaquette) {
            if ($plaquette['actif'] == 1 && !empty($plaquette['pages_affichage'])) {
                $pages = json_decode($plaquette['pages_affichage'], true);
                echo "<p>Plaquette '{$plaquette['titre']}' - Pages: " . implode(', ', $pages ?? []) . "</p>";
                
                if ($pages && in_array($page_name, $pages)) {
                    $plaquettes_filtered[] = $plaquette;
                    echo "<p style='color: green;'>✓ Cette plaquette s'affiche sur cap-psr.php</p>";
                } else {
                    echo "<p style='color: red;'>✗ Cette plaquette ne s'affiche pas sur cap-psr.php</p>";
                }
            }
        }
        
        echo "<h3>Plaquettes filtrées pour cap-psr.php: " . count($plaquettes_filtered) . "</h3>";
        
        if (count($plaquettes_filtered) > 0) {
            foreach ($plaquettes_filtered as $plaquette) {
                echo "<div style='border: 1px solid green; padding: 10px; margin: 10px;'>";
                echo "<h4>" . htmlspecialchars($plaquette['titre']) . "</h4>";
                echo "<p>Fichier PDF: " . htmlspecialchars($plaquette['fichier_pdf']) . "</p>";
                echo "<p>Image: " . htmlspecialchars($plaquette['image_couverture']) . "</p>";
                echo "<p>Couleur: " . htmlspecialchars($plaquette['couleur_fond']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p style='color: red; font-weight: bold;'>Aucune plaquette configurée pour s'afficher sur cap-psr.php</p>";
        }
        
    } else {
        echo "<p style='color: red; font-weight: bold;'>Aucune plaquette trouvée en base de données</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erreur: " . $e->getMessage() . "</p>";
}
?> 
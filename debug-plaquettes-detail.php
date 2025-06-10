<?php
// Script de debug détaillé pour les plaquettes
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Debug détaillé des plaquettes</h1>";

// 1. Connexion à la base de données
echo "<h2>1. Test de connexion à la base de données</h2>";
try {
    require_once 'includes/db_connect.php';
    echo "<p style='color: green;'>✅ Connexion à la base de données réussie</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erreur de connexion : " . $e->getMessage() . "</p>";
    exit;
}

// 2. Vérification de la table plaquettes
echo "<h2>2. Vérification de la table plaquettes</h2>";
try {
    $stmt = $db->query("DESCRIBE plaquettes");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<p style='color: green;'>✅ Table plaquettes existe</p>";
    echo "<details><summary>Structure de la table</summary><pre>";
    print_r($columns);
    echo "</pre></details>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erreur table : " . $e->getMessage() . "</p>";
}

// 3. Contenu de la table plaquettes
echo "<h2>3. Contenu de la table plaquettes</h2>";
try {
    $stmt = $db->query("SELECT * FROM plaquettes");
    $plaquettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<p>Nombre de plaquettes : " . count($plaquettes) . "</p>";
    
    if (count($plaquettes) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%; font-size: 12px;'>";
        echo "<tr><th>ID</th><th>Titre</th><th>Actif</th><th>Pages</th><th>PDF existe</th><th>Image existe</th></tr>";
        
        foreach ($plaquettes as $plaquette) {
            $pdf_exists = file_exists($plaquette['fichier_pdf']) ? '✅' : '❌';
            $image_exists = !empty($plaquette['image_couverture']) && file_exists($plaquette['image_couverture']) ? '✅' : '❌';
            
            echo "<tr>";
            echo "<td>" . $plaquette['id'] . "</td>";
            echo "<td>" . htmlspecialchars($plaquette['titre']) . "</td>";
            echo "<td>" . ($plaquette['actif'] ? '✅' : '❌') . "</td>";
            echo "<td>" . htmlspecialchars($plaquette['pages_affichage']) . "</td>";
            echo "<td>" . $pdf_exists . "</td>";
            echo "<td>" . $image_exists . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erreur lecture : " . $e->getMessage() . "</p>";
}

// 4. Test de la fonction get_plaquettes_for_page
echo "<h2>4. Test de la fonction get_plaquettes_for_page</h2>";
try {
    include 'includes/plaquettes.php';
    echo "<p style='color: green;'>✅ Fichier includes/plaquettes.php inclus</p>";
    
    $test_pages = ['cap-psr.php', 'bac-pro-melec.php', 'index.php'];
    
    foreach ($test_pages as $page) {
        echo "<h3>Test pour $page</h3>";
        $plaquettes_page = get_plaquettes_for_page($page);
        echo "<p>Nombre de plaquettes pour $page : " . count($plaquettes_page) . "</p>";
        
        if (count($plaquettes_page) > 0) {
            echo "<ul>";
            foreach ($plaquettes_page as $plaquette) {
                echo "<li>" . htmlspecialchars($plaquette['titre']) . "</li>";
            }
            echo "</ul>";
        }
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erreur fonction : " . $e->getMessage() . "</p>";
}

// 5. Test de la fonction display_plaquettes
echo "<h2>5. Test de la fonction display_plaquettes</h2>";
try {
    echo "<h3>Sortie de display_plaquettes('cap-psr.php') :</h3>";
    echo "<div style='border: 2px solid blue; padding: 10px;'>";
    
    // Capturer la sortie de la fonction
    ob_start();
    display_plaquettes('cap-psr.php');
    $output = ob_get_clean();
    
    if (empty($output)) {
        echo "<p style='color: red;'>❌ Aucune sortie de display_plaquettes</p>";
    } else {
        echo "<p style='color: green;'>✅ Sortie générée :</p>";
        echo $output;
    }
    
    echo "</div>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erreur display : " . $e->getMessage() . "</p>";
}

// 6. Vérification des chemins de fichiers
echo "<h2>6. Vérification des chemins de fichiers</h2>";
try {
    $stmt = $db->query("SELECT fichier_pdf, image_couverture FROM plaquettes WHERE actif = 1");
    $fichiers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($fichiers as $fichier) {
        echo "<h3>Fichiers de plaquette</h3>";
        
        if (!empty($fichier['fichier_pdf'])) {
            $pdf_path = $fichier['fichier_pdf'];
            echo "<p>PDF : $pdf_path - ";
            if (file_exists($pdf_path)) {
                echo "<span style='color: green;'>✅ Existe</span>";
            } else {
                echo "<span style='color: red;'>❌ N'existe pas</span>";
            }
            echo "</p>";
        }
        
        if (!empty($fichier['image_couverture'])) {
            $image_path = $fichier['image_couverture'];
            echo "<p>Image : $image_path - ";
            if (file_exists($image_path)) {
                echo "<span style='color: green;'>✅ Existe</span>";
            } else {
                echo "<span style='color: red;'>❌ N'existe pas</span>";
            }
            echo "</p>";
        }
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erreur fichiers : " . $e->getMessage() . "</p>";
}

// 7. Test manuel d'affichage
echo "<h2>7. Test manuel d'affichage pour cap-psr.php</h2>";
try {
    $stmt = $db->prepare("SELECT * FROM plaquettes WHERE actif = 1 ORDER BY ordre_affichage ASC, date_creation DESC");
    $stmt->execute();
    $plaquettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<p>Plaquettes actives trouvées : " . count($plaquettes) . "</p>";
    
    $plaquettes_filtered = [];
    foreach ($plaquettes as $plaquette) {
        if (!empty($plaquette['pages_affichage'])) {
            $pages = json_decode($plaquette['pages_affichage'], true);
            echo "<p>Plaquette '{$plaquette['titre']}' - Pages configurées: ";
            if ($pages) {
                echo implode(', ', $pages);
                if (in_array('cap-psr.php', $pages)) {
                    $plaquettes_filtered[] = $plaquette;
                    echo " <span style='color: green;'>✅ Inclut cap-psr.php</span>";
                } else {
                    echo " <span style='color: red;'>❌ N'inclut pas cap-psr.php</span>";
                }
            } else {
                echo "Erreur JSON";
            }
            echo "</p>";
        }
    }
    
    echo "<h3>Résultat final</h3>";
    echo "<p>Plaquettes à afficher sur cap-psr.php : " . count($plaquettes_filtered) . "</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erreur test : " . $e->getMessage() . "</p>";
}

echo "<h2>Actions</h2>";
echo "<p><a href='admin/plaquettes-admin.php' style='background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>Administration</a></p>";
echo "<p><a href='cap-psr.php' style='background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>Voir cap-psr.php</a></p>";
?> 
<?php
// Script pour vérifier l'installation du système de plaquettes sur toutes les pages

require_once 'includes/db_connect.php';

echo "<h1>🔍 Vérification de l'installation des plaquettes</h1>";

// Vérifier d'abord la base de données
echo "<h2>📊 Vérification de la base de données</h2>";

try {
    $stmt = $db->query("SELECT COUNT(*) as count FROM plaquettes WHERE actif = 1");
    $count = $stmt->fetch()['count'];
    echo "<p style='color: green;'>✅ Base de données accessible</p>";
    echo "<p><strong>Plaquettes actives :</strong> $count</p>";
    
    if ($count > 0) {
        echo "<h3>Plaquettes en base :</h3>";
        $stmt = $db->query("SELECT id, titre, pages_affichage FROM plaquettes WHERE actif = 1 ORDER BY ordre_affichage");
        $plaquettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($plaquettes as $plaquette) {
            $pages = json_decode($plaquette['pages_affichage'], true) ?: [];
            echo "<div style='background: #f8f9fa; padding: 10px; margin: 5px 0; border-radius: 4px;'>";
            echo "<strong>ID {$plaquette['id']}: {$plaquette['titre']}</strong><br>";
            echo "<small>Pages ciblées: " . implode(', ', $pages) . "</small>";
            echo "</div>";
        }
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erreur base de données: " . $e->getMessage() . "</p>";
}

echo "<h2>📄 Vérification des pages PHP</h2>";

// Lister toutes les pages PHP
$pages_php = glob('*.php');
$pages_a_verifier = [];

foreach ($pages_php as $page) {
    // Exclure les fichiers de test/admin
    $exclure = [
        'installer-plaquettes-toutes-pages.php',
        'verifier-installation-plaquettes.php',
        'test-simple.php',
        'test-plaquettes-final.php',
        'test-complet-plaquettes.php',
        'debug-plaquettes.php',
        'debug-plaquettes-detail.php',
        'configure-plaquette.php',
        'ajouter-plaquettes-toutes-pages.php',
        'web_migrate.php',
        'test_binary_data.php'
    ];
    
    if (!in_array($page, $exclure)) {
        $pages_a_verifier[] = $page;
    }
}

$avec_code = 0;
$sans_code = 0;
$erreurs = 0;

echo "<div style='display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px; margin: 20px 0;'>";

foreach ($pages_a_verifier as $page) {
    echo "<div style='border: 1px solid #ddd; padding: 15px; border-radius: 8px; background: white;'>";
    echo "<h4 style='margin: 0 0 10px 0; color: #333;'>📄 $page</h4>";
    
    if (!file_exists($page)) {
        echo "<p style='color: red; margin: 5px 0;'>❌ Fichier inexistant</p>";
        $erreurs++;
        echo "</div>";
        continue;
    }
    
    $content = file_get_contents($page);
    
    if ($content === false) {
        echo "<p style='color: red; margin: 5px 0;'>❌ Impossible de lire le fichier</p>";
        $erreurs++;
        echo "</div>";
        continue;
    }
    
    // Vérifier la présence du code des plaquettes
    $has_display_function = strpos($content, 'display_plaquettes()') !== false;
    $has_include = strpos($content, 'includes/plaquettes.php') !== false;
    $has_db_connect = strpos($content, 'includes/db_connect.php') !== false;
    
    if ($has_display_function && $has_include && $has_db_connect) {
        echo "<p style='color: green; margin: 5px 0;'>✅ Code complet présent</p>";
        $avec_code++;
        
        // Vérifier si cette page a des plaquettes assignées
        if (isset($plaquettes)) {
            $page_a_plaquettes = false;
            foreach ($plaquettes as $plaquette) {
                $pages = json_decode($plaquette['pages_affichage'], true) ?: [];
                if (in_array($page, $pages)) {
                    $page_a_plaquettes = true;
                    break;
                }
            }
            
            if ($page_a_plaquettes) {
                echo "<p style='color: blue; margin: 5px 0; font-size: 12px;'>📋 Plaquettes assignées</p>";
            } else {
                echo "<p style='color: #666; margin: 5px 0; font-size: 12px;'>⚪ Pas de plaquettes assignées</p>";
            }
        }
    } else {
        echo "<p style='color: red; margin: 5px 0;'>❌ Code manquant ou incomplet</p>";
        $sans_code++;
        
        if (!$has_display_function) echo "<small style='color: red;'>- Manque display_plaquettes()</small><br>";
        if (!$has_include) echo "<small style='color: red;'>- Manque include plaquettes.php</small><br>";
        if (!$has_db_connect) echo "<small style='color: red;'>- Manque include db_connect.php</small><br>";
    }
    
    // Vérifier les permissions
    if (!is_readable($page)) {
        echo "<p style='color: orange; margin: 5px 0; font-size: 12px;'>⚠️ Problème de permissions lecture</p>";
    }
    
    echo "</div>";
}

echo "</div>";

// Résumé
echo "<h2>📊 Résultats de la vérification</h2>";
echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;'>";
echo "<div style='display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;'>";

echo "<div style='text-align: center; padding: 15px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
echo "<div style='font-size: 2em; color: #28a745;'>$avec_code</div>";
echo "<div style='font-weight: bold; color: #28a745;'>Pages OK</div>";
echo "</div>";

echo "<div style='text-align: center; padding: 15px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
echo "<div style='font-size: 2em; color: #dc3545;'>$sans_code</div>";
echo "<div style='font-weight: bold; color: #dc3545;'>Pages sans code</div>";
echo "</div>";

echo "<div style='text-align: center; padding: 15px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
echo "<div style='font-size: 2em; color: #ffc107;'>$erreurs</div>";
echo "<div style='font-weight: bold; color: #ffc107;'>Erreurs</div>";
echo "</div>";

$total_pages = count($pages_a_verifier);
$pourcentage = round(($avec_code / $total_pages) * 100, 1);

echo "<div style='text-align: center; padding: 15px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
echo "<div style='font-size: 2em; color: #007bff;'>$pourcentage%</div>";
echo "<div style='font-weight: bold; color: #007bff;'>Couverture</div>";
echo "</div>";

echo "</div>";

// Status global
if ($avec_code == $total_pages) {
    echo "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 20px 0; text-align: center;'>";
    echo "<h3 style='margin: 0;'>🎉 Installation parfaite !</h3>";
    echo "<p style='margin: 10px 0 0 0;'>Toutes les pages ont le code des plaquettes installé.</p>";
    echo "</div>";
} elseif ($avec_code > $total_pages * 0.8) {
    echo "<div style='background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 20px 0; text-align: center;'>";
    echo "<h3 style='margin: 0;'>⚠️ Installation presque complète</h3>";
    echo "<p style='margin: 10px 0 0 0;'>La plupart des pages sont prêtes. Quelques corrections nécessaires.</p>";
    echo "</div>";
} else {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 20px 0; text-align: center;'>";
    echo "<h3 style='margin: 0;'>❌ Installation incomplète</h3>";
    echo "<p style='margin: 10px 0 0 0;'>Plusieurs pages nécessitent une intervention manuelle.</p>";
    echo "</div>";
}

echo "</div>";

// Actions
echo "<h2>🔗 Actions disponibles</h2>";
echo "<div style='text-align: center; margin: 20px 0;'>";

if ($sans_code > 0) {
    echo "<a href='installer-plaquettes-toutes-pages.php' style='background: #007bff; color: white; padding: 12px 20px; text-decoration: none; border-radius: 6px; margin: 0 10px; display: inline-block;'>🔧 Réinstaller</a>";
}

echo "<a href='admin/plaquettes-admin.php' style='background: #28a745; color: white; padding: 12px 20px; text-decoration: none; border-radius: 6px; margin: 0 10px; display: inline-block;'>⚙️ Administration</a>";

echo "<a href='test-complet-plaquettes.php' style='background: #6f42c1; color: white; padding: 12px 20px; text-decoration: none; border-radius: 6px; margin: 0 10px; display: inline-block;'>🧪 Test complet</a>";

echo "</div>";

// Test rapide d'affichage
if ($avec_code > 0) {
    echo "<h2>🎨 Aperçu de l'affichage</h2>";
    echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px;'>";
    echo "<p>Test d'affichage des plaquettes sur la page actuelle :</p>";
    
    // Simuler l'affichage des plaquettes
    try {
        include 'includes/plaquettes.php';
        echo "<div style='border: 2px dashed #007bff; padding: 15px; margin: 10px 0; background: white;'>";
        echo "<h4 style='color: #007bff; margin: 0 0 10px 0;'>🎯 Plaquettes qui s'afficheraient ici :</h4>";
        
        $current_page = basename($_SERVER['PHP_SELF']);
        $plaquettes_page = get_plaquettes_for_page($current_page);
        
        if (empty($plaquettes_page)) {
            echo "<p style='color: #666; font-style: italic;'>Aucune plaquette configurée pour cette page ($current_page)</p>";
        } else {
            foreach ($plaquettes_page as $plaquette) {
                echo "<div style='background: #e7f3ff; padding: 10px; margin: 5px 0; border-radius: 4px; border-left: 4px solid #007bff;'>";
                echo "<strong>" . htmlspecialchars($plaquette['titre']) . "</strong>";
                if (!empty($plaquette['description'])) {
                    echo "<br><small>" . htmlspecialchars($plaquette['description']) . "</small>";
                }
                echo "</div>";
            }
        }
        
        echo "</div>";
    } catch (Exception $e) {
        echo "<p style='color: red;'>Erreur lors du test d'affichage : " . $e->getMessage() . "</p>";
    }
    
    echo "</div>";
}
?> 
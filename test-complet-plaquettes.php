<?php
echo "<h1>Test complet du système de plaquettes</h1>";

// Connexion DB
require_once 'includes/db_connect.php';
include 'includes/plaquettes.php';

// Récupérer toutes les plaquettes actives
$stmt = $db->query("SELECT id, titre, pages_affichage FROM plaquettes WHERE actif = 1");
$plaquettes = $stmt->fetchAll();

echo "<h2>📋 Plaquettes en base de données</h2>";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>ID</th><th>Titre</th><th>Pages configurées</th></tr>";

$toutes_pages = [];
foreach ($plaquettes as $p) {
    $pages = json_decode($p['pages_affichage'], true);
    $toutes_pages = array_merge($toutes_pages, $pages);
    echo "<tr>";
    echo "<td>" . $p['id'] . "</td>";
    echo "<td>" . htmlspecialchars($p['titre']) . "</td>";
    echo "<td>" . implode(', ', $pages) . "</td>";
    echo "</tr>";
}
echo "</table>";

// Pages uniques
$pages_uniques = array_unique($toutes_pages);
sort($pages_uniques);

echo "<h2>🔍 Test par page</h2>";

foreach ($pages_uniques as $page) {
    echo "<div style='border: 1px solid #ddd; margin: 15px 0; padding: 15px; background: #f9f9f9;'>";
    echo "<h3>📄 $page</h3>";
    
    // Vérifier si le fichier existe
    if (file_exists($page)) {
        echo "<p style='color: green;'>✅ Fichier existe</p>";
        
        // Vérifier si le code des plaquettes est présent
        $content = file_get_contents($page);
        if (strpos($content, 'display_plaquettes()') !== false) {
            echo "<p style='color: green;'>✅ Code des plaquettes présent</p>";
            
            // Tester la fonction
            $plaquettes_page = get_plaquettes_for_page($page);
            echo "<p><strong>Plaquettes trouvées :</strong> " . count($plaquettes_page) . "</p>";
            
            if (count($plaquettes_page) > 0) {
                echo "<ul>";
                foreach ($plaquettes_page as $plaquette) {
                    echo "<li>🏷️ " . htmlspecialchars($plaquette['titre']) . "</li>";
                }
                echo "</ul>";
                echo "<p><a href='$page' target='_blank' style='background: #007bff; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;'>👀 Voir la page</a></p>";
            } else {
                echo "<p style='color: orange;'>⚠️ Aucune plaquette configurée</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ Code des plaquettes manquant</p>";
            echo "<p>→ <em>Cette page doit être modifiée pour afficher les plaquettes</em></p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Fichier n'existe pas</p>";
    }
    
    echo "</div>";
}

echo "<h2>📊 Résumé</h2>";
$pages_avec_code = 0;
$pages_fonctionnelles = 0;

foreach ($pages_uniques as $page) {
    if (file_exists($page)) {
        $content = file_get_contents($page);
        if (strpos($content, 'display_plaquettes()') !== false) {
            $pages_avec_code++;
            $plaquettes_page = get_plaquettes_for_page($page);
            if (count($plaquettes_page) > 0) {
                $pages_fonctionnelles++;
            }
        }
    }
}

echo "<div style='background: #e8f4fd; padding: 20px; border-radius: 8px; margin: 20px 0;'>";
echo "<h3>🎯 Statistiques</h3>";
echo "<ul>";
echo "<li><strong>Pages avec plaquettes configurées :</strong> " . count($pages_uniques) . "</li>";
echo "<li><strong>Pages avec code ajouté :</strong> $pages_avec_code / " . count($pages_uniques) . "</li>";
echo "<li><strong>Pages fonctionnelles :</strong> $pages_fonctionnelles / " . count($pages_uniques) . "</li>";
echo "</ul>";

if ($pages_fonctionnelles == count($pages_uniques)) {
    echo "<p style='color: green; font-size: 18px; font-weight: bold;'>🎉 Système de plaquettes 100% fonctionnel !</p>";
} else {
    echo "<p style='color: orange; font-size: 16px;'>⚠️ Quelques pages nécessitent encore l'ajout du code des plaquettes.</p>";
}
echo "</div>";

echo "<h2>🚀 Actions</h2>";
echo "<p><a href='admin/plaquettes-admin.php' style='background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; margin-right: 10px;'>🔧 Administration des plaquettes</a>";
echo "<a href='cap-psr.php' style='background: #17a2b8; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;'>👁️ Exemple: CAP PSR</a></p>";
?> 
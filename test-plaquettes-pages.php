<?php
// Script pour tester l'affichage des plaquettes sur différentes pages
require_once 'includes/db_connect.php';
include 'includes/plaquettes.php';

$pages_test = [
    'cap-psr.php' => 'CAP PSR',
    'bac-pro-melec.php' => 'Bac Pro MELEC',
    'bts-cpi.php' => 'BTS CPI',
    'index.php' => 'Page d\'accueil'
];

echo "<h1>Test d'affichage des plaquettes</h1>";

foreach ($pages_test as $page => $nom) {
    echo "<div style='border: 1px solid #ddd; margin: 20px 0; padding: 15px;'>";
    echo "<h2>Page: $nom ($page)</h2>";
    
    $plaquettes = get_plaquettes_for_page($page);
    
    if (empty($plaquettes)) {
        echo "<p style='color: red;'>❌ Aucune plaquette configurée pour cette page</p>";
    } else {
        echo "<p style='color: green;'>✅ " . count($plaquettes) . " plaquette(s) trouvée(s) :</p>";
        echo "<ul>";
        foreach ($plaquettes as $plaquette) {
            echo "<li><strong>" . htmlspecialchars($plaquette['titre']) . "</strong>";
            if ($plaquette['description']) {
                echo " - " . htmlspecialchars($plaquette['description']);
            }
            echo "</li>";
        }
        echo "</ul>";
    }
    echo "</div>";
}

echo "<h2>Liens de test</h2>";
echo "<ul>";
foreach ($pages_test as $page => $nom) {
    echo "<li><a href='$page' target='_blank'>$nom</a></li>";
}
echo "</ul>";

echo "<p><a href='admin/plaquettes-admin.php' style='background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;'>Administration des plaquettes</a></p>";
?> 
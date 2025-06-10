<?php
echo "<h1>Test final des plaquettes</h1>";

$pages_test = [
    'cap-psr.php' => 'CAP PSR',
    'bac-pro-melec.php' => 'Bac Pro MELEC',
    'abibac.php' => 'ABIBAC',
    'bts-mco.php' => 'BTS MCO'
];

echo "<h2>État des plaquettes</h2>";

// Connexion DB
require_once 'includes/db_connect.php';

// Afficher les plaquettes actives
$stmt = $db->query("SELECT id, titre, pages_affichage FROM plaquettes WHERE actif = 1");
$plaquettes = $stmt->fetchAll();

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>ID</th><th>Titre</th><th>Pages configurées</th></tr>";

foreach ($plaquettes as $p) {
    $pages = json_decode($p['pages_affichage'], true);
    echo "<tr>";
    echo "<td>" . $p['id'] . "</td>";
    echo "<td>" . htmlspecialchars($p['titre']) . "</td>";
    echo "<td>" . implode(', ', $pages) . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>Test sur les pages</h2>";

include 'includes/plaquettes.php';

foreach ($pages_test as $page => $nom) {
    echo "<div style='border: 1px solid #ddd; margin: 10px 0; padding: 10px;'>";
    echo "<h3>$nom ($page)</h3>";
    
    $plaquettes_page = get_plaquettes_for_page($page);
    echo "<p>Plaquettes trouvées : " . count($plaquettes_page) . "</p>";
    
    if (count($plaquettes_page) > 0) {
        echo "<ul>";
        foreach ($plaquettes_page as $plaquette) {
            echo "<li>" . htmlspecialchars($plaquette['titre']) . "</li>";
        }
        echo "</ul>";
        echo "<p style='color: green;'>✅ <a href='$page' target='_blank'>Voir $nom</a></p>";
    } else {
        echo "<p style='color: red;'>❌ Aucune plaquette à afficher</p>";
    }
    
    echo "</div>";
}

echo "<h2>Résumé</h2>";
echo "<p>Les plaquettes devraient maintenant s'afficher sur :</p>";
echo "<ul>";
echo "<li><a href='cap-psr.php' target='_blank'>CAP PSR</a> → 1 plaquette</li>";
echo "<li><a href='bac-pro-melec.php' target='_blank'>Bac Pro MELEC</a> → 1 plaquette</li>";
echo "<li><a href='abibac.php' target='_blank'>ABIBAC</a> → 2 plaquettes</li>";
echo "<li><a href='bts-mco.php' target='_blank'>BTS MCO</a> → 1 plaquette</li>";
echo "</ul>";
?> 
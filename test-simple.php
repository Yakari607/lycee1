<?php
echo "Test simple des plaquettes<br><br>";

// Test 1: Connexion DB
echo "1. Test connexion DB... ";
try {
    require_once 'includes/db_connect.php';
    echo "OK<br>";
} catch (Exception $e) {
    echo "ERREUR: " . $e->getMessage() . "<br>";
    exit;
}

// Test 2: Table existe
echo "2. Test table plaquettes... ";
try {
    $stmt = $db->query("SELECT COUNT(*) FROM plaquettes");
    $count = $stmt->fetchColumn();
    echo "OK - $count plaquettes<br>";
} catch (Exception $e) {
    echo "ERREUR: " . $e->getMessage() . "<br>";
    exit;
}

// Test 3: Plaquettes actives
echo "3. Plaquettes actives... ";
try {
    $stmt = $db->query("SELECT * FROM plaquettes WHERE actif = 1");
    $plaquettes = $stmt->fetchAll();
    echo count($plaquettes) . " trouvées<br>";
    
    foreach ($plaquettes as $p) {
        echo "- ID " . $p['id'] . ": " . $p['titre'] . " (pages: " . $p['pages_affichage'] . ")<br>";
    }
} catch (Exception $e) {
    echo "ERREUR: " . $e->getMessage() . "<br>";
}

// Test 4: Include plaquettes.php
echo "4. Include plaquettes.php... ";
try {
    include 'includes/plaquettes.php';
    echo "OK<br>";
} catch (Exception $e) {
    echo "ERREUR: " . $e->getMessage() . "<br>";
}

// Test 5: Fonction get_plaquettes_for_page
echo "5. Test fonction pour cap-psr.php... ";
try {
    $result = get_plaquettes_for_page('cap-psr.php');
    echo count($result) . " plaquettes trouvées<br>";
} catch (Exception $e) {
    echo "ERREUR: " . $e->getMessage() . "<br>";
}

echo "<br><a href='cap-psr.php'>Voir cap-psr.php</a>";
?> 
<?php
// Test simple pour identifier le problème
echo "1. Test PHP de base : OK<br>";

// Test de l'inclusion du fichier de connexion
echo "2. Test d'inclusion db_connect.php...<br>";
try {
    require_once 'includes/db_connect.php';
    echo "   - Inclusion réussie<br>";
    echo "   - Connexion à la base de données : OK<br>";
} catch (Exception $e) {
    echo "   - ERREUR: " . $e->getMessage() . "<br>";
}

// Test d'inclusion de la navbar
echo "3. Test d'inclusion navbar.php...<br>";
try {
    ob_start();
    include 'includes/navbar.php';
    $navbar_content = ob_get_clean();
    echo "   - Inclusion navbar : OK<br>";
} catch (Exception $e) {
    echo "   - ERREUR navbar: " . $e->getMessage() . "<br>";
}

// Test d'inclusion du header
echo "4. Test d'inclusion header.php...<br>";
try {
    ob_start();
    include 'includes/header.php';
    $header_content = ob_get_clean();
    echo "   - Inclusion header : OK<br>";
} catch (Exception $e) {
    echo "   - ERREUR header: " . $e->getMessage() . "<br>";
}

echo "5. Test terminé.";
?> 
<?php
// Script pour ajouter automatiquement le code d'affichage des plaquettes dans toutes les pages

$pages_formation = [
    'abibac.php',
    'bts-mco.php',
    'pass-ingenieur.php',
    'section-europeenne.php',
    'etwinning.php',
    'bac-general.php',
    'bts-assurance.php',
    'bts-ccst.php',
    'bts-comptabilite-gestion.php',
    'bts-cpi.php',
    'bts-ms.php',
    'bts-tm.php',
    'cap-aaga.php',
    'cap-electricien.php',
    'cap-metiers-enseigne.php',
    'metiers-accueil.php',
    'metiers-commerce-vente.php',
    'bac-pro-metiers-enseigne.php',
    'bac-pro-mspc.php',
    'bac-stmg.php',
    'sti2d.php',
    'vie-lyceenne.php',
    'voix-apprentis.php',
    'restaurant-scolaire.php',
    'partenariats.php'
];

$code_plaquettes = '
    <?php
    // Connexion à la base de données pour les plaquettes
    require_once \'includes/db_connect.php\';
    
    // Inclure et afficher les plaquettes pour cette page
    include \'includes/plaquettes.php\';
    display_plaquettes();
    ?>';

echo "<h1>Ajout du code des plaquettes dans les pages de formation</h1>";

foreach ($pages_formation as $page) {
    if (file_exists($page)) {
        echo "<h3>Traitement de $page</h3>";
        
        $content = file_get_contents($page);
        
        // Vérifier si le code des plaquettes n'est pas déjà présent
        if (strpos($content, 'display_plaquettes()') !== false) {
            echo "<p style='color: blue;'>✓ Code déjà présent dans $page</p>";
            continue;
        }
        
        // Chercher la position juste avant le footer
        $pattern = '/(\s*<\/div>\s*<\/section>\s*<\/main>\s*)(.*?)(<!\-\- Footer \-\->)/s';
        
        if (preg_match($pattern, $content, $matches)) {
            $new_content = $matches[1] . $code_plaquettes . "\n\n    " . $matches[3];
            $updated_content = preg_replace($pattern, $new_content, $content);
            
            if (file_put_contents($page, $updated_content)) {
                echo "<p style='color: green;'>✅ Code ajouté avec succès dans $page</p>";
            } else {
                echo "<p style='color: red;'>❌ Erreur lors de l'écriture de $page</p>";
            }
        } else {
            echo "<p style='color: orange;'>⚠️ Structure de page non reconnue pour $page</p>";
        }
    } else {
        echo "<p style='color: gray;'>- $page n'existe pas</p>";
    }
}

echo "<h2>Terminé !</h2>";
echo "<p>Vous pouvez maintenant tester les pages :</p>";
echo "<ul>";
foreach ($pages_formation as $page) {
    if (file_exists($page)) {
        echo "<li><a href='$page' target='_blank'>$page</a></li>";
    }
}
echo "</ul>";
?> 
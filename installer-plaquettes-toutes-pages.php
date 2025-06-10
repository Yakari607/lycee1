<?php
// Script pour installer automatiquement le système de plaquettes dans toutes les pages PHP

echo "<h1>Installation du système de plaquettes sur toutes les pages</h1>";

// Code à insérer
$code_plaquettes = '
    <?php
    // Connexion à la base de données pour les plaquettes
    require_once \'includes/db_connect.php\';
    
    // Inclure et afficher les plaquettes pour cette page
    include \'includes/plaquettes.php\';
    display_plaquettes();
    ?>';

// Lister toutes les pages PHP (sauf admin et includes)
$pages_php = glob('*.php');
$pages_a_traiter = [];

foreach ($pages_php as $page) {
    // Exclure certains fichiers
    $exclure = [
        'installer-plaquettes-toutes-pages.php',
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
        $pages_a_traiter[] = $page;
    }
}

echo "<h2>Pages à traiter (" . count($pages_a_traiter) . ")</h2>";
echo "<ul>";
foreach ($pages_a_traiter as $page) {
    echo "<li>$page</li>";
}
echo "</ul>";

$succes = 0;
$deja_present = 0;
$erreurs = 0;

echo "<h2>Traitement des pages</h2>";

foreach ($pages_a_traiter as $page) {
    echo "<div style='border: 1px solid #ddd; margin: 10px 0; padding: 10px;'>";
    echo "<h3>📄 $page</h3>";
    
    if (!file_exists($page)) {
        echo "<p style='color: red;'>❌ Fichier inexistant</p>";
        $erreurs++;
        echo "</div>";
        continue;
    }
    
    $content = file_get_contents($page);
    
    // Vérifier si le code n'est pas déjà présent
    if (strpos($content, 'display_plaquettes()') !== false) {
        echo "<p style='color: blue;'>✓ Code déjà présent</p>";
        $deja_present++;
        echo "</div>";
        continue;
    }
    
    // Différents patterns pour trouver où insérer le code
    $patterns = [
        // Pattern principal: </section></main> suivi d'espaces et de <!-- Footer -->
        '/(\s*<\/section>\s*<\/main>\s*)(.*?)(<!\-\- Footer \-\->)/s',
        // Pattern alternatif: </main> directement suivi de <footer>
        '/(\s*<\/main>\s*)(<footer)/s',
        // Pattern pour </body>
        '/(\s*)(<\/body>)/s'
    ];
    
    $insertion_reussie = false;
    
    foreach ($patterns as $i => $pattern) {
        if (preg_match($pattern, $content)) {
            if ($i == 0) {
                // Pattern principal
                $new_content = preg_replace(
                    $pattern, 
                    '$1' . $code_plaquettes . "\n\n    " . '$3', 
                    $content
                );
            } elseif ($i == 1) {
                // Pattern alternatif
                $new_content = preg_replace(
                    $pattern, 
                    '$1' . $code_plaquettes . "\n\n    " . '$2', 
                    $content
                );
            } else {
                // Pattern pour </body>
                $new_content = preg_replace(
                    $pattern, 
                    $code_plaquettes . "\n" . '$1$2', 
                    $content
                );
            }
            
            if ($new_content && $new_content !== $content) {
                if (file_put_contents($page, $new_content)) {
                    echo "<p style='color: green;'>✅ Code ajouté avec succès (pattern " . ($i+1) . ")</p>";
                    $succes++;
                    $insertion_reussie = true;
                    break;
                } else {
                    echo "<p style='color: red;'>❌ Erreur lors de l'écriture</p>";
                    $erreurs++;
                }
            }
        }
    }
    
    if (!$insertion_reussie) {
        echo "<p style='color: orange;'>⚠️ Structure de page non reconnue</p>";
        
        // Essayer d'ajouter avant </body> comme dernier recours
        if (strpos($content, '</body>') !== false) {
            $new_content = str_replace('</body>', $code_plaquettes . "\n</body>", $content);
            if (file_put_contents($page, $new_content)) {
                echo "<p style='color: green;'>✅ Code ajouté avant </body></p>";
                $succes++;
            } else {
                echo "<p style='color: red;'>❌ Erreur lors de l'écriture</p>";
                $erreurs++;
            }
        } else {
            echo "<p style='color: red;'>❌ Impossible d'insérer le code</p>";
            $erreurs++;
        }
    }
    
    echo "</div>";
}

echo "<h2>📊 Résultats</h2>";
echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px;'>";
echo "<ul>";
echo "<li><strong>Pages traitées :</strong> " . count($pages_a_traiter) . "</li>";
echo "<li style='color: green;'><strong>Succès :</strong> $succes</li>";
echo "<li style='color: blue;'><strong>Déjà présent :</strong> $deja_present</li>";
echo "<li style='color: red;'><strong>Erreurs :</strong> $erreurs</li>";
echo "</ul>";

$total_fonctionnel = $succes + $deja_present;
echo "<p><strong>Total fonctionnel :</strong> $total_fonctionnel / " . count($pages_a_traiter) . "</p>";

if ($total_fonctionnel == count($pages_a_traiter)) {
    echo "<p style='color: green; font-size: 18px; font-weight: bold;'>🎉 Installation terminée avec succès !</p>";
} else {
    echo "<p style='color: orange; font-size: 16px;'>⚠️ Quelques pages nécessitent un traitement manuel.</p>";
}
echo "</div>";

echo "<h2>🔗 Actions suivantes</h2>";
echo "<p><a href='verifier-installation-plaquettes.php' style='background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; margin-right: 10px;'>🔍 Vérifier l'installation</a>";
echo "<a href='admin/plaquettes-admin.php' style='background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;'>⚙️ Administration</a></p>";
?> 
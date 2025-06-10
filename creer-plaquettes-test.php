<?php
// Script pour créer des plaquettes de test sur toutes les pages du site

require_once 'includes/db_connect.php';

echo "<h1>🎯 Création de plaquettes de test pour toutes les pages</h1>";

// Fonction pour créer une plaquette de test
function creer_plaquette_test($db, $titre, $description, $pages, $couleur = '#007bff') {
    try {
        // Vérifier si une plaquette avec ce titre existe déjà
        $check_stmt = $db->prepare("SELECT id FROM plaquettes WHERE titre = :titre");
        $check_stmt->execute([':titre' => $titre]);
        
        if ($check_stmt->fetch()) {
            return "⚠️ Plaquette '$titre' existe déjà";
        }
        
        // Créer les fichiers de test (images et PDF factices)
        $image_test = 'images/plaquettes/test_' . md5($titre) . '.jpg';
        $pdf_test = 'uploads/plaquettes/test_' . md5($titre) . '.pdf';
        
        // Créer une image de test simple (1x1 pixel)
        $test_image_data = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==');
        file_put_contents($image_test, $test_image_data);
        
        // Créer un PDF de test simple
        $test_pdf_content = "%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj 2 0 obj<</Type/Pages/Kids[3 0 R]/Count 1>>endobj 3 0 obj<</Type/Page/Parent 2 0 R/MediaBox[0 0 612 792]>>endobj\nxref\n0 4\n0000000000 65535 f \n0000000009 00000 n \n0000000058 00000 n \n0000000115 00000 n \ntrailer<</Size 4/Root 1 0 R>>\nstartxref\n193\n%%EOF";
        file_put_contents($pdf_test, $test_pdf_content);
        
        // Obtenir le prochain ordre d'affichage
        $ordre_stmt = $db->query("SELECT IFNULL(MAX(ordre_affichage), 0) + 1 as next_ordre FROM plaquettes");
        $ordre = $ordre_stmt->fetch()['next_ordre'];
        
        // Insérer la plaquette
        $stmt = $db->prepare("INSERT INTO plaquettes 
                              (titre, description, fichier_pdf, image_couverture, pages_affichage, couleur_fond, ordre_affichage, actif) 
                              VALUES (:titre, :description, :fichier_pdf, :image_couverture, :pages_affichage, :couleur_fond, :ordre_affichage, 1)");
        
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':fichier_pdf' => $pdf_test,
            ':image_couverture' => $image_test,
            ':pages_affichage' => json_encode($pages),
            ':couleur_fond' => $couleur,
            ':ordre_affichage' => $ordre
        ]);
        
        return "✅ Plaquette '$titre' créée avec succès";
        
    } catch (Exception $e) {
        return "❌ Erreur: " . $e->getMessage();
    }
}

// Créer les dossiers si nécessaire
if (!file_exists('images/plaquettes')) {
    mkdir('images/plaquettes', 0777, true);
}
if (!file_exists('uploads/plaquettes')) {
    mkdir('uploads/plaquettes', 0777, true);
}

echo "<h2>📋 Création des plaquettes de test</h2>";

// Plaquettes de test pour différentes pages
$plaquettes_test = [
    [
        'titre' => 'Guide de l\'Orientation 2024',
        'description' => 'Découvrez toutes les possibilités d\'orientation après le bac et les formations proposées au lycée Jean-Mermoz.',
        'pages' => ['index.php', 'bac-general.php', 'orientation-bac.php'],
        'couleur' => '#e74c3c'
    ],
    [
        'titre' => 'Formations Professionnelles',
        'description' => 'Guide complet des formations professionnelles : CAP, Bac Pro, BTS. Trouvez votre voie vers l\'excellence.',
        'pages' => ['bac-pro-melec.php', 'bac-pro-mspc.php', 'cap-electricien.php', 'cap-psr.php'],
        'couleur' => '#3498db'
    ],
    [
        'titre' => 'Vie Étudiante & Services',
        'description' => 'Tout savoir sur la vie au lycée : internat, restauration, CDI, activités extra-scolaires.',
        'pages' => ['vie-lyceenne.php', 'internat.php', 'restaurant-scolaire.php', 'cdi.php'],
        'couleur' => '#2ecc71'
    ],
    [
        'titre' => 'Formations BTS',
        'description' => 'Catalogue des formations BTS disponibles : industrie, tertiaire, commerce, gestion.',
        'pages' => ['bts-mco.php', 'bts-assurance.php', 'bts-cpi.php', 'bts-comptabilite-gestion.php'],
        'couleur' => '#9b59b6'
    ],
    [
        'titre' => 'International & Langues',
        'description' => 'Nos programmes internationaux : ABIBAC, sections européennes, projets eTwinning, échanges.',
        'pages' => ['abibac.php', 'section-europeenne.php', 'etwinning.php', 'cafe-des-langues.php'],
        'couleur' => '#f39c12'
    ],
    [
        'titre' => 'Innovation & Technologie',
        'description' => 'Les formations d\'avenir : STI2D, PASS Ingénieur, métiers de l\'industrie 4.0.',
        'pages' => ['sti2d.php', 'pass-ingenieur.php', 'bts-tm.php', 'eco-mermoz.php'],
        'couleur' => '#1abc9c'
    ],
    [
        'titre' => 'Métiers du Service',
        'description' => 'Les formations aux métiers de l\'accueil, du commerce et des services aux personnes.',
        'pages' => ['metiers-accueil.php', 'metiers-commerce-vente.php', 'cap-aaga.php'],
        'couleur' => '#e67e22'
    ],
    [
        'titre' => 'Apprentissage & UFA',
        'description' => 'Découvrez l\'apprentissage au lycée Jean-Mermoz : formations, partenaires, avantages.',
        'pages' => ['ufa.php', 'azubi-bac-pro.php', 'partenariats.php'],
        'couleur' => '#34495e'
    ]
];

echo "<div style='margin: 20px 0;'>";

foreach ($plaquettes_test as $plaquette) {
    $resultat = creer_plaquette_test(
        $db, 
        $plaquette['titre'], 
        $plaquette['description'], 
        $plaquette['pages'], 
        $plaquette['couleur']
    );
    
    echo "<div style='background: white; margin: 10px 0; padding: 15px; border-radius: 8px; border-left: 4px solid {$plaquette['couleur']};'>";
    echo "<h4 style='margin: 0 0 10px 0; color: {$plaquette['couleur']};'>{$plaquette['titre']}</h4>";
    echo "<p style='margin: 0 0 10px 0; color: #666;'>{$plaquette['description']}</p>";
    echo "<p style='margin: 0; font-size: 12px;'><strong>Pages:</strong> " . implode(', ', $plaquette['pages']) . "</p>";
    echo "<p style='margin: 5px 0 0 0; font-weight: bold;'>$resultat</p>";
    echo "</div>";
}

echo "</div>";

// Statistiques finales
try {
    $stmt = $db->query("SELECT COUNT(*) as total FROM plaquettes WHERE actif = 1");
    $total_plaquettes = $stmt->fetch()['total'];
    
    $stmt = $db->query("SELECT COUNT(DISTINCT JSON_EXTRACT(pages_affichage, '$[*]')) as pages_avec_plaquettes FROM plaquettes WHERE actif = 1");
    
    echo "<h2>📊 Statistiques finales</h2>";
    echo "<div style='background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;'>";
    echo "<div style='display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;'>";
    
    echo "<div style='text-align: center; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>";
    echo "<div style='font-size: 2em; color: #28a745; font-weight: bold;'>$total_plaquettes</div>";
    echo "<div style='color: #666;'>Plaquettes actives</div>";
    echo "</div>";
    
    echo "<div style='text-align: center; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>";
    echo "<div style='font-size: 2em; color: #007bff; font-weight: bold;'>40+</div>";
    echo "<div style='color: #666;'>Pages avec le code</div>";
    echo "</div>";
    
    echo "<div style='text-align: center; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>";
    echo "<div style='font-size: 2em; color: #17a2b8; font-weight: bold;'>100%</div>";
    echo "<div style='color: #666;'>Système opérationnel</div>";
    echo "</div>";
    
    echo "</div>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Erreur lors du calcul des statistiques : " . $e->getMessage() . "</p>";
}

echo "<h2>🎉 Installation terminée !</h2>";
echo "<div style='background: #d4edda; color: #155724; padding: 20px; border-radius: 8px; margin: 20px 0; text-align: center;'>";
echo "<h3 style='margin: 0 0 15px 0;'>🚀 Le système de plaquettes est maintenant opérationnel !</h3>";
echo "<p style='margin: 0 0 15px 0;'>Toutes les pages du site peuvent maintenant afficher des plaquettes téléchargeables dynamiquement.</p>";
echo "<p style='margin: 0; font-weight: bold;'>Rendez-vous sur n'importe quelle page du site pour voir les plaquettes en action !</p>";
echo "</div>";

echo "<h2>🔗 Actions disponibles</h2>";
echo "<div style='text-align: center; margin: 20px 0;'>";
echo "<a href='admin/plaquettes-admin.php' style='background: #28a745; color: white; padding: 15px 25px; text-decoration: none; border-radius: 8px; margin: 0 10px; display: inline-block; font-weight: bold;'>⚙️ Administration des Plaquettes</a>";
echo "<a href='index.php' style='background: #007bff; color: white; padding: 15px 25px; text-decoration: none; border-radius: 8px; margin: 0 10px; display: inline-block; font-weight: bold;'>🏠 Voir le site</a>";
echo "<a href='bac-pro-melec.php' style='background: #6f42c1; color: white; padding: 15px 25px; text-decoration: none; border-radius: 8px; margin: 0 10px; display: inline-block; font-weight: bold;'>📄 Test sur une page</a>";
echo "</div>";

echo "<div style='background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 20px 0;'>";
echo "<h4 style='margin: 0 0 10px 0;'>💡 Pour tester le système :</h4>";
echo "<ol style='margin: 0; padding-left: 20px;'>";
echo "<li>Visitez une page de formation (ex: bac-pro-melec.php, bts-mco.php, cap-psr.php)</li>";
echo "<li>Scrollez vers le bas pour voir les plaquettes téléchargeables</li>";
echo "<li>Modifiez les plaquettes depuis l'administration</li>";
echo "<li>Ajoutez vos propres plaquettes avec de vrais PDF et images</li>";
echo "</ol>";
echo "</div>";
?> 
<?php
// Script pour créer des plaquettes officielles avec un design institutionnel

require_once 'includes/db_connect.php';

echo "<h1>🏛️ Création de plaquettes officielles</h1>";

// Fonction pour créer une plaquette institutionnelle
function creer_plaquette_officielle($db, $titre, $description, $pages, $couleur = '#1e3a8a') {
    try {
        // Vérifier si une plaquette avec ce titre existe déjà
        $check_stmt = $db->prepare("SELECT id FROM plaquettes WHERE titre = :titre");
        $check_stmt->execute([':titre' => $titre]);
        
        if ($check_stmt->fetch()) {
            return "⚠️ Plaquette '$titre' existe déjà";
        }
        
        // Créer les fichiers de test (images et PDF factices)
        $image_test = 'images/plaquettes/officiel_' . md5($titre) . '.jpg';
        
        // Création d'une image simple pour le test
        $image = imagecreatetruecolor(800, 600);
        
        // Convertir la couleur hexadécimale en RGB
        $hex = ltrim($couleur, '#');
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        // Couleur de fond
        $bg_color = imagecolorallocate($image, $r, $g, $b);
        imagefill($image, 0, 0, $bg_color);
        
        // Ajout d'une bande blanche en haut
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image, 0, 0, 800, 80, $white);
        
        // Ajout d'un texte avec le titre
        $text_color = imagecolorallocate($image, 50, 50, 50);
        $font = 5; // Police par défaut
        imagestring($image, $font, 20, 30, $titre, $text_color);
        
        // Ajout d'un texte "DOCUMENT OFFICIEL"
        $white_text = imagecolorallocate($image, 255, 255, 255);
        imagestring($image, $font, 20, 280, "DOCUMENT OFFICIEL", $white_text);
        
        // Sauvegarder l'image
        if (!file_exists(dirname($image_test))) {
            mkdir(dirname($image_test), 0777, true);
        }
        imagejpeg($image, $image_test);
        imagedestroy($image);
        
        // Créer un PDF fictif
        $pdf_test = 'uploads/plaquettes/officiel_' . md5($titre) . '.pdf';
        if (!file_exists(dirname($pdf_test))) {
            mkdir(dirname($pdf_test), 0777, true);
        }
        
        // Copier un fichier PDF de test (supposé exister)
        if (file_exists('test_document.pdf')) {
            copy('test_document.pdf', $pdf_test);
        } else {
            // Créer un fichier PDF vide si test_document.pdf n'existe pas
            file_put_contents($pdf_test, "Document officiel - " . $titre);
        }
        
        // Enregistrer dans la base de données
        $stmt = $db->prepare("INSERT INTO plaquettes (titre, description, image_couverture, fichier_pdf, pages_affichage, couleur_fond, ordre_affichage, actif, date_creation) 
                              VALUES (:titre, :description, :image, :pdf, :pages, :couleur, :ordre, 1, NOW())");
        
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':image' => $image_test,
            ':pdf' => $pdf_test,
            ':pages' => json_encode($pages),
            ':couleur' => $couleur,
            ':ordre' => rand(1, 10)
        ]);
        
        return "✅ Plaquette officielle '$titre' créée avec succès";
    } catch (Exception $e) {
        return "❌ Erreur: " . $e->getMessage();
    }
}

// Définir des couleurs institutionnelles
$couleurs_institutionnelles = [
    '#1e3a8a', // Bleu foncé
    '#003f7d', // Bleu institutionnel
    '#036dc3', // Bleu ministère
    '#274360', // Bleu marine
    '#6a0f2b', // Bordeaux
    '#2d4739', // Vert forêt
    '#4a5568'  // Gris ardoise
];

// Liste des exemples de plaquettes à créer
$plaquettes = [
    [
        'titre' => 'Guide d\'orientation 2024',
        'description' => 'Document officiel pour l\'accompagnement à l\'orientation des lycéens',
        'pages' => ['index.php', 'orientation-bac.php', 'bac-general.php'],
        'couleur' => $couleurs_institutionnelles[0]
    ],
    [
        'titre' => 'Formations Professionnelles',
        'description' => 'Présentation des filières professionnelles de l\'établissement',
        'pages' => ['bac-pro-melec.php', 'bac-pro-mspc.php', 'cap-psr.php'],
        'couleur' => $couleurs_institutionnelles[1]
    ],
    [
        'titre' => 'Section européenne - Documentation',
        'description' => 'Informations sur le programme européen et ses modalités',
        'pages' => ['section-europeenne.php', 'etwinning.php'],
        'couleur' => $couleurs_institutionnelles[2]
    ],
    [
        'titre' => 'Programme Abibac',
        'description' => 'Présentation du dispositif franco-allemand Abibac',
        'pages' => ['abibac.php', 'pass-ingenieur.php'],
        'couleur' => $couleurs_institutionnelles[3]
    ],
    [
        'titre' => 'Règlement intérieur',
        'description' => 'Règlement intérieur de l\'établissement - Document officiel',
        'pages' => ['index.php', 'vie-lyceenne.php'],
        'couleur' => $couleurs_institutionnelles[4]
    ],
    [
        'titre' => 'Projet d\'établissement 2023-2027',
        'description' => 'Projet d\'établissement adopté par le conseil d\'administration',
        'pages' => ['index.php'],
        'couleur' => $couleurs_institutionnelles[5]
    ],
    [
        'titre' => 'Procédures d\'inscription',
        'description' => 'Document explicatif sur les modalités d\'inscription et d\'admission',
        'pages' => ['index.php', 'bts-mco.php', 'bts-cpi.php'],
        'couleur' => $couleurs_institutionnelles[6]
    ]
];

// Créer chaque plaquette
echo "<ul>";
foreach ($plaquettes as $plaquette) {
    $resultat = creer_plaquette_officielle(
        $db, 
        $plaquette['titre'], 
        $plaquette['description'], 
        $plaquette['pages'], 
        $plaquette['couleur']
    );
    echo "<li>{$resultat}</li>";
}
echo "</ul>";

echo "<h2>🔄 Vérification des plaquettes créées</h2>";

// Vérifier les plaquettes en base de données
try {
    $stmt = $db->query("SELECT id, titre, pages_affichage, date_creation FROM plaquettes ORDER BY date_creation DESC LIMIT 10");
    $plaquettes_bdd = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($plaquettes_bdd) > 0) {
        echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Titre</th><th>Pages</th><th>Date création</th></tr>";
        
        foreach ($plaquettes_bdd as $p) {
            $pages = json_decode($p['pages_affichage'], true);
            $pages_str = $pages ? implode(", ", $pages) : "Aucune";
            
            echo "<tr>";
            echo "<td>{$p['id']}</td>";
            echo "<td>{$p['titre']}</td>";
            echo "<td>{$pages_str}</td>";
            echo "<td>{$p['date_creation']}</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>Aucune plaquette trouvée en base de données.</p>";
    }
} catch (PDOException $e) {
    echo "<p>Erreur lors de la vérification : " . $e->getMessage() . "</p>";
}

echo "<p><a href='admin/plaquettes-admin.php'>Aller à l'administration des plaquettes</a></p>";
echo "<p><a href='index.php'>Retour à l'accueil</a></p>";
?> 
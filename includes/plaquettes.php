<?php
/**
 * Composant pour afficher les plaquettes téléchargeables
 * Usage: include 'includes/plaquettes.php';
 */

// Fonction pour récupérer les plaquettes d'une page spécifique
function get_plaquettes_for_page($page_name) {
    global $db;
    
    try {
        $stmt = $db->prepare("SELECT * FROM plaquettes WHERE actif = 1 ORDER BY ordre_affichage ASC, date_creation DESC");
        $stmt->execute();
        $plaquettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $plaquettes_filtered = [];
        foreach ($plaquettes as $plaquette) {
            if (!empty($plaquette['pages_affichage'])) {
                $pages = json_decode($plaquette['pages_affichage'], true);
                if ($pages && in_array($page_name, $pages)) {
                    $plaquettes_filtered[] = $plaquette;
                }
            }
        }
        
        return $plaquettes_filtered;
    } catch (PDOException $e) {
        return [];
    }
}

// Fonction pour afficher les plaquettes
function display_plaquettes($page_name = null) {
    if (!$page_name) {
        $page_name = basename($_SERVER['PHP_SELF']);
    }
    
    $plaquettes = get_plaquettes_for_page($page_name);
    
    if (empty($plaquettes)) {
        return;
    }
    
    echo '<section class="plaquettes-section" aria-labelledby="titre-plaquettes">';
    echo '<div class="container">';
    echo '<h2 id="titre-plaquettes" class="section-title">Documents à télécharger</h2>';
    echo '<div class="plaquettes-grid">';
    
    foreach ($plaquettes as $plaquette) {
        $background_color = htmlspecialchars($plaquette['couleur_fond']);
        $titre = htmlspecialchars($plaquette['titre']);
        $description = htmlspecialchars($plaquette['description'] ?? '');
        $pdf_path = htmlspecialchars($plaquette['fichier_pdf']);
        $image_path = !empty($plaquette['image_couverture']) ? htmlspecialchars($plaquette['image_couverture']) : '';
        
        echo '<div class="plaquette-card">';
        
        if ($image_path) {
            echo '<div class="plaquette-image" style="border-top: 5px solid ' . $background_color . ';">';
            echo '<img src="' . $image_path . '" alt="' . $titre . '" loading="lazy">';
            echo '</div>';
        }
        
        echo '<div class="plaquette-content">';
        echo '<h3>' . $titre . '</h3>';
        
        if ($description) {
            echo '<p>' . $description . '</p>';
        }
        
        echo '<div class="plaquette-actions">';
        echo '<a href="' . $pdf_path . '" class="btn-download" target="_blank" rel="noopener" style="background-color: ' . $background_color . ';">';
        echo '<i class="fas fa-file-pdf" aria-hidden="true"></i>';
        echo '<span>Télécharger le document</span>';
        echo '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</div>';
    echo '</section>';
}

// Styles CSS pour les plaquettes
function plaquettes_styles() {
    echo '<style>
    .plaquettes-section {
        padding: 3rem 0;
        background-color: #f9f9fa;
        border-top: 1px solid #e9e9e9;
        border-bottom: 1px solid #e9e9e9;
    }
    
    .plaquettes-section .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 25px;
        font-weight: 600;
        color: #1e3a8a;
    }
    
    .plaquettes-section .section-title:after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 80px;
        height: 4px;
        background-color: #1e3a8a;
    }
    
    .plaquettes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .plaquette-card {
        background-color: #ffffff;
        border-radius: 2px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        color: #333;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .plaquette-card:hover {
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
    }
    
    .plaquette-image {
        width: 100%;
        height: 180px;
        overflow: hidden;
        position: relative;
        background-color: #f5f5f5;
    }
    
    .plaquette-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .plaquette-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .plaquette-content h3 {
        margin: 0 0 1rem 0;
        font-size: 1.2rem;
        font-weight: 600;
        color: #1e3a8a;
    }
    
    .plaquette-content p {
        margin: 0 0 1.5rem 0;
        font-size: 0.95rem;
        color: #555;
        line-height: 1.6;
        flex-grow: 1;
    }
    
    .plaquette-actions {
        margin-top: auto;
    }
    
    .btn-download {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: #0056b3;
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 2px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        width: 100%;
        border: none;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    .btn-download:hover {
        opacity: 0.9;
        color: white;
        text-decoration: none;
    }
    
    .btn-download i {
        font-size: 1.1rem;
    }
    
    /* Mode sombre */
    [data-theme="dark"] .plaquettes-section {
        background-color: #1a1a1a;
        border-color: #333;
    }
    
    [data-theme="dark"] .plaquettes-section .section-title {
        color: #e0e0e0;
    }
    
    [data-theme="dark"] .plaquettes-section .section-title:after {
        background-color: #4a6baf;
    }
    
    [data-theme="dark"] .plaquette-card {
        background-color: #2d2d2d;
        color: #e0e0e0;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    }
    
    [data-theme="dark"] .plaquette-card:hover {
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.4);
    }
    
    [data-theme="dark"] .plaquette-content h3 {
        color: #e0e0e0;
    }
    
    [data-theme="dark"] .plaquette-content p {
        color: #bbb;
    }
    
    [data-theme="dark"] .plaquette-image {
        background-color: #222;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .plaquettes-section {
            padding: 2rem 0;
        }
        
        .plaquettes-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .plaquette-content {
            padding: 1.25rem;
        }
    }
    
    @media (max-width: 480px) {
        .plaquettes-grid {
            gap: 1rem;
        }
        
        .plaquette-image {
            height: 160px;
        }
    }
    </style>';
}

// Auto-inclusion des styles CSS
plaquettes_styles();
?> 
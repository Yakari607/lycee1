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
    echo '<h2 id="titre-plaquettes" class="section-title">Téléchargements</h2>';
    echo '<div class="plaquettes-grid">';
    
    foreach ($plaquettes as $plaquette) {
        $background_color = htmlspecialchars($plaquette['couleur_fond']);
        $titre = htmlspecialchars($plaquette['titre']);
        $description = htmlspecialchars($plaquette['description'] ?? '');
        $pdf_path = htmlspecialchars($plaquette['fichier_pdf']);
        $image_path = !empty($plaquette['image_couverture']) ? htmlspecialchars($plaquette['image_couverture']) : '';
        
        echo '<div class="plaquette-card" style="background-color: ' . $background_color . ';">';
        
        if ($image_path) {
            echo '<div class="plaquette-image">';
            echo '<img src="' . $image_path . '" alt="' . $titre . '" loading="lazy">';
            echo '</div>';
        }
        
        echo '<div class="plaquette-content">';
        echo '<h3>' . $titre . '</h3>';
        
        if ($description) {
            echo '<p>' . $description . '</p>';
        }
        
        echo '<div class="plaquette-actions">';
        echo '<a href="' . $pdf_path . '" class="btn-download" target="_blank" rel="noopener">';
        echo '<i class="fas fa-download" aria-hidden="true"></i>';
        echo '<span>Télécharger la plaquette</span>';
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
        background-color: var(--gray-light, #f8f9fa);
    }
    
    .plaquettes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .plaquette-card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        color: white;
        position: relative;
    }
    
    .plaquette-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }
    
    .plaquette-image {
        width: 100%;
        height: 180px;
        overflow: hidden;
        position: relative;
    }
    
    .plaquette-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .plaquette-card:hover .plaquette-image img {
        transform: scale(1.05);
    }
    
    .plaquette-content {
        padding: 1.5rem;
    }
    
    .plaquette-content h3 {
        margin: 0 0 1rem 0;
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
    }
    
    .plaquette-content p {
        margin: 0 0 1.5rem 0;
        font-size: 0.95rem;
        opacity: 0.9;
        line-height: 1.5;
    }
    
    .plaquette-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }
    
    .btn-download {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .btn-download:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }
    
    .btn-download i {
        font-size: 1rem;
    }
    
    /* Mode sombre */
    [data-theme="dark"] .plaquettes-section {
        background-color: var(--card-bg, #2d2d2d);
    }
    
    [data-theme="dark"] .plaquette-card {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }
    
    [data-theme="dark"] .plaquette-card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
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
        
        .plaquette-image {
            height: 150px;
        }
        
        .plaquette-content {
            padding: 1.25rem;
        }
        
        .plaquette-content h3 {
            font-size: 1.1rem;
        }
        
        .btn-download {
            padding: 0.65rem 1rem;
            font-size: 0.9rem;
        }
    }
    
    @media (max-width: 480px) {
        .plaquettes-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .plaquette-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .btn-download {
            justify-content: center;
            width: 100%;
        }
    }
    </style>';
}

// Auto-inclusion des styles CSS
plaquettes_styles();
?> 
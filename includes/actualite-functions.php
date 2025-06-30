<?php
/**
 * Fonctions pour le traitement du contenu des actualités avec médias
 */

/**
 * Traite le contenu d'une actualité en remplaçant les shortcodes par les médias
 * 
 * Shortcodes supportés :
 * [media id="123"] - Affiche le média avec l'ID 123
 * [image id="123" align="left|center|right"] - Affiche une image avec alignement
 * [pdf id="123" title="Titre personnalisé"] - Affiche un PDF avec lien de téléchargement
 */
function process_actualite_content($content, $actualite_id) {
    global $db, $table_prefix;
    if (!isset($db)) {
        require_once __DIR__ . '/db_connect.php';
    }

    // Placeholders pour HTML généré
    $html_placeholders = [];
    $placeholder_counter = 0;

    // Détection de la présence de shortcodes
    $has_shortcode = preg_match('/\[(image|pdf|media)\s+id=/i', $content);

    // Traitement normal si shortcodes présents
    $content = preg_replace_callback(
        '/\[media\s+id=["\'](\d+)["\']\s*\]/',
        function($matches) use ($actualite_id, &$html_placeholders, &$placeholder_counter) {
            $html = render_media_shortcode($matches[1], [], $actualite_id);
            $placeholder = "|||HTML_PLACEHOLDER_" . $placeholder_counter . "|||";
            $html_placeholders[$placeholder] = $html;
            $placeholder_counter++;
            return $placeholder;
        },
        $content
    );
    $content = preg_replace_callback(
        '/\[image\s+id=["\'](\d+)["\']\s*(?:align=["\']([^"\']*)["\'])?\s*\]/',
        function($matches) use ($actualite_id, &$html_placeholders, &$placeholder_counter) {
            $options = [];
            if (isset($matches[2])) {
                $options['align'] = $matches[2];
            }
            $html = render_image_shortcode($matches[1], $options, $actualite_id);
            $placeholder = "|||HTML_PLACEHOLDER_" . $placeholder_counter . "|||";
            $html_placeholders[$placeholder] = $html;
            $placeholder_counter++;
            return $placeholder;
        },
        $content
    );
    $content = preg_replace_callback(
        '/\[pdf\s+id=["\'](\d+)["\']\s*(?:title=["\']([^"\']*)["\'])?\s*\]/',
        function($matches) use ($actualite_id, &$html_placeholders, &$placeholder_counter) {
            $options = [];
            if (isset($matches[2])) {
                $options['title'] = $matches[2];
            }
            $html = render_pdf_shortcode($matches[1], $options, $actualite_id);
            $placeholder = "|||HTML_PLACEHOLDER_" . $placeholder_counter . "|||";
            $html_placeholders[$placeholder] = $html;
            $placeholder_counter++;
            return $placeholder;
        },
        $content
    );

    // Si pas de shortcode, on ajoute tous les médias automatiquement
    if (!$has_shortcode) {
        $medias = get_actualite_medias($actualite_id);
        $images = [];
        $pdfs = [];
        foreach ($medias as $media) {
            if ($media['type_media'] === 'image') {
                $images[] = $media;
            } elseif ($media['type_media'] === 'pdf') {
                $pdfs[] = $media;
            }
        }
        $media_html = '';
        // Carrousel si plusieurs images
        if (count($images) > 1) {
            $media_html .= '<div class="actualite-carousel">';
            foreach ($images as $idx => $img) {
                $media_html .= '<div class="carousel-slide" data-index="'.$idx.'">';
                $media_html .= render_image_shortcode($img['id'], ['align' => 'center'], $actualite_id);
                $media_html .= '</div>';
            }
            // Flèches et pagination
            $media_html .= '<button class="carousel-prev" aria-label="Image précédente">&#10094;</button>';
            $media_html .= '<button class="carousel-next" aria-label="Image suivante">&#10095;</button>';
            $media_html .= '<div class="carousel-pagination"></div>';
            $media_html .= '</div>';
        } elseif (count($images) === 1) {
            $media_html .= render_image_shortcode($images[0]['id'], ['align' => 'center'], $actualite_id);
        }
        // PDFs en dessous
        foreach ($pdfs as $pdf) {
            $media_html .= render_pdf_shortcode($pdf['id'], [], $actualite_id);
        }
        $content = nl2br(htmlspecialchars($content)) . $media_html;
        return $content;
    }

    // Échapper le texte restant
    $content = nl2br(htmlspecialchars($content));
    // Restaurer le HTML généré par les shortcodes
    foreach ($html_placeholders as $placeholder => $html) {
        $content = str_replace(htmlspecialchars($placeholder), $html, $content);
    }
    return $content;
}

/**
 * Récupère un média par son ID et vérifie qu'il appartient à l'actualité
 */
function get_actualite_media($media_id, $actualite_id) {
    global $db, $table_prefix;
    
    // S'assurer que nous avons les variables globales
    if (!isset($db)) {
        require_once __DIR__ . '/db_connect.php';
        global $db, $table_prefix;
    }
    
    try {
        $table_name = $table_prefix . 'actualites_media';
        $stmt = $db->prepare("
            SELECT * FROM {$table_name} 
            WHERE id = :media_id AND actualite_id = :actualite_id
        ");
        $stmt->execute([
            ':media_id' => $media_id,
            ':actualite_id' => $actualite_id
        ]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur get_actualite_media: " . $e->getMessage());
        return false;
    }
}

/**
 * Rend un shortcode média générique
 */
function render_media_shortcode($media_id, $options = [], $actualite_id = 0) {
    $media = get_actualite_media($media_id, $actualite_id);
    
    if (!$media) {
        return '<div class="media-error">Média non trouvé (ID: ' . $media_id . ')</div>';
    }
    
    if ($media['type_media'] === 'image') {
        return render_image_shortcode($media_id, $options, $actualite_id);
    } elseif ($media['type_media'] === 'pdf') {
        return render_pdf_shortcode($media_id, $options, $actualite_id);
    }
    
    return '<div class="media-error">Type de média non supporté</div>';
}

/**
 * Rend un shortcode image
 */
function render_image_shortcode($media_id, $options = [], $actualite_id = 0) {
    $media = get_actualite_media($media_id, $actualite_id);
    
    if (!$media || $media['type_media'] !== 'image') {
        return '<div class="media-error">Image non trouvée (ID: ' . $media_id . ')</div>';
    }
    
    $align = isset($options['align']) ? $options['align'] : 'center';
    $align_class = in_array($align, ['left', 'center', 'right']) ? 'align-' . $align : 'align-center';
    
    $description = !empty($media['description']) ? htmlspecialchars($media['description']) : '';
    
    $html = '<div class="actualite-media-image ' . $align_class . '">';
    $html .= '<img src="' . htmlspecialchars($media['chemin']) . '" ';
    $html .= 'alt="' . htmlspecialchars($media['nom_original']) . '" ';
    $html .= 'loading="lazy" />';
    
    if ($description) {
        $html .= '<div class="media-caption">' . $description . '</div>';
    }
    
    $html .= '</div>';
    
    return $html;
}

/**
 * Rend un shortcode PDF
 */
function render_pdf_shortcode($media_id, $options = [], $actualite_id = 0) {
    $media = get_actualite_media($media_id, $actualite_id);
    
    if (!$media || $media['type_media'] !== 'pdf') {
        return '<div class="media-error">PDF non trouvé (ID: ' . $media_id . ')</div>';
    }
    
    $title = isset($options['title']) ? htmlspecialchars($options['title']) : htmlspecialchars($media['nom_original']);
    $description = !empty($media['description']) ? htmlspecialchars($media['description']) : '';
    $file_size = format_file_size($media['taille']);
    
    $html = '<div class="actualite-media-pdf">';
    $html .= '<div class="pdf-icon"><i class="fas fa-file-pdf"></i></div>';
    $html .= '<div class="pdf-info">';
    $html .= '<h4 class="pdf-title">' . $title . '</h4>';
    
    if ($description) {
        $html .= '<p class="pdf-description">' . $description . '</p>';
    }
    
    $html .= '<div class="pdf-meta">';
    $html .= '<span class="pdf-size">Taille: ' . $file_size . '</span>';
    $html .= '</div>';
    
    $html .= '<div class="pdf-actions">';
    $html .= '<a href="' . htmlspecialchars($media['chemin']) . '" target="_blank" class="btn-pdf-view">';
    $html .= '<i class="fas fa-eye"></i> Visualiser';
    $html .= '</a>';
    $html .= '<a href="' . htmlspecialchars($media['chemin']) . '" download class="btn-pdf-download">';
    $html .= '<i class="fas fa-download"></i> Télécharger';
    $html .= '</a>';
    $html .= '</div>';
    
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}

/**
 * Formate la taille d'un fichier en format lisible
 */
function format_file_size($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' bytes';
    }
}

/**
 * Récupère tous les médias d'une actualité
 */
function get_actualite_medias($actualite_id) {
    global $db, $table_prefix;
    
    // S'assurer que nous avons les variables globales
    if (!isset($db)) {
        require_once __DIR__ . '/db_connect.php';
        global $db, $table_prefix;
    }
    
    try {
        $table_name = $table_prefix . 'actualites_media';
        $stmt = $db->prepare("
            SELECT * FROM {$table_name} 
            WHERE actualite_id = :actualite_id 
            ORDER BY date_upload ASC
        ");
        $stmt->execute([':actualite_id' => $actualite_id]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur get_actualite_medias: " . $e->getMessage());
        return [];
    }
}
?> 
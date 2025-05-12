<?php
// Démarrer la session
session_start();

// Inclure les fonctions et la connexion à la base de données
require_once '../includes/functions.php';
require_once '../includes/db_connect.php';

// Vérification de l'authentification
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

// Vérifier si la requête est une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $file_path = isset($_POST['file_path']) ? $_POST['file_path'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $element_id = isset($_POST['element_id']) ? $_POST['element_id'] : '';
    
    $response = ['success' => false, 'message' => ''];
    
    // Vérifier que le chemin du fichier est valide
    if (empty($file_path)) {
        $response['message'] = 'Chemin de fichier non spécifié.';
        echo json_encode($response);
        exit;
    }
    
    // Vérifier que le fichier existe et est accessible en écriture
    $full_path = '../' . ltrim($file_path, '/');
    
    if (!file_exists($full_path)) {
        $response['message'] = 'Le fichier n\'existe pas.';
        echo json_encode($response);
        exit;
    }
    
    if (!is_writable($full_path)) {
        // Tenter de modifier les permissions
        if (!chmod($full_path, 0664)) {
            $response['message'] = 'Le fichier n\'est pas accessible en écriture et impossible de modifier les permissions.';
            echo json_encode($response);
            exit;
        }
    }
    
    // Si nous avons un ID d'élément spécifique, on peut mettre à jour un élément spécifique dans le fichier
    if (!empty($element_id)) {
        // Lire le contenu actuel du fichier
        $current_content = file_get_contents($full_path);
        
        // Rechercher et remplacer la section correspondant à l'ID
        // Exemple simple, à adapter selon votre structure HTML
        $pattern = '/<div id="' . preg_quote($element_id, '/') . '".*?>.*?<\/div>/s';
        $replacement = $content;
        
        $new_content = preg_replace($pattern, $replacement, $current_content);
        
        if ($new_content !== null && $new_content !== $current_content) {
            // Écrire le nouveau contenu dans le fichier
            if (file_put_contents($full_path, $new_content)) {
                $response['success'] = true;
                $response['message'] = 'Section mise à jour avec succès.';
            } else {
                $response['message'] = 'Erreur lors de l\'écriture dans le fichier.';
            }
        } else {
            $response['message'] = 'Aucune modification effectuée ou erreur dans le motif de recherche.';
        }
    } else {
        // Écriture directe du contenu complet
        if (file_put_contents($full_path, $content)) {
            $response['success'] = true;
            $response['message'] = 'Fichier mis à jour avec succès.';
        } else {
            $response['message'] = 'Erreur lors de l\'écriture dans le fichier.';
        }
    }
    
    // Renvoyer la réponse
    echo json_encode($response);
    exit;
}

// Si aucune donnée POST n'a été reçue, rediriger vers la page d'accueil
header('Location: index.php');
exit;
?> 
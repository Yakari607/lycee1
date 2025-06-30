<?php
// Démarrer la session
session_start();

// Inclure la connexion à la base de données
require_once '../includes/db_connect.php';

// Vérification de l'authentification
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Non autorisé']);
    exit;
}

// Configuration des uploads
$upload_dir = '../uploads/actualites/';
$max_file_size = 10 * 1024 * 1024; // 10MB
$allowed_types = [
    'image' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
    'pdf' => ['pdf']
];

// Créer le dossier s'il n'existe pas
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0777, true)) {
        throw new Exception('Impossible de créer le dossier de destination');
    }
    chmod($upload_dir, 0777); // S'assurer des permissions
}

// Fonction pour nettoyer le nom de fichier
function sanitize_filename($filename) {
    // Supprimer les accents et caractères spéciaux
    $filename = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $filename);
    // Remplacer les caractères non alphanumériques par des underscores
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
    // Supprimer les underscores multiples
    $filename = preg_replace('/_+/', '_', $filename);
    // Supprimer les underscores au début et à la fin
    $filename = trim($filename, '_');
    // Limiter la longueur
    if (strlen($filename) > 50) {
        $filename = substr($filename, 0, 50);
    }
    // Si le nom devient vide, utiliser un nom par défaut
    if (empty($filename)) {
        $filename = 'fichier';
    }
    return $filename;
}

// Traitement de l'upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media'])) {
    $response = ['success' => false, 'message' => ''];
    
    try {
        $file = $_FILES['media'];
        $actualite_id = isset($_POST['actualite_id']) ? intval($_POST['actualite_id']) : 0;
        $description = $_POST['description'] ?? '';
        
        // Vérifications de base
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Erreur lors de l\'upload du fichier');
        }
        
        if ($file['size'] > $max_file_size) {
            throw new Exception('Le fichier est trop volumineux (max 10MB)');
        }
        
        // Déterminer le type de média
        $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $media_type = null;
        
        foreach ($allowed_types as $type => $extensions) {
            if (in_array($file_extension, $extensions)) {
                $media_type = $type;
                break;
            }
        }
        
        if (!$media_type) {
            throw new Exception('Type de fichier non autorisé');
        }
        
        // Générer un nom de fichier unique
        $timestamp = date('YmdHis');
        $random = bin2hex(random_bytes(4));
        $safe_filename = sanitize_filename(pathinfo($file['name'], PATHINFO_FILENAME));
        $new_filename = $timestamp . '_' . $random . '_' . $safe_filename . '.' . $file_extension;
        
        // Logs pour debug
        error_log("Upload debug - Fichier original: " . $file['name']);
        error_log("Upload debug - Nouveau nom: " . $new_filename);
        error_log("Upload debug - Dossier destination: " . $upload_dir);
        
        // Chemin complet du fichier
        $file_path = $upload_dir . $new_filename;
        $relative_path = 'uploads/actualites/' . $new_filename;
        
        // Vérifier que le dossier est accessible en écriture
        if (!is_writable($upload_dir)) {
            throw new Exception('Le dossier de destination n\'est pas accessible en écriture');
        }
        
        // Déplacer le fichier
        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            // Plus de détails sur l'erreur
            $error_details = error_get_last();
            throw new Exception('Impossible de sauvegarder le fichier: ' . ($error_details['message'] ?? 'Erreur inconnue'));
        }
        
        // Enregistrer en base de données
        $stmt = $db->prepare("
            INSERT INTO {$table_prefix}actualites_media 
            (actualite_id, nom_fichier, nom_original, type_media, taille, chemin, description) 
            VALUES (:actualite_id, :nom_fichier, :nom_original, :type_media, :taille, :chemin, :description)
        ");
        
        $stmt->execute([
            ':actualite_id' => $actualite_id,
            ':nom_fichier' => $new_filename,
            ':nom_original' => $file['name'],
            ':type_media' => $media_type,
            ':taille' => $file['size'],
            ':chemin' => $relative_path,
            ':description' => $description
        ]);
        
        $media_id = $db->lastInsertId();
        
        $response = [
            'success' => true,
            'message' => 'Fichier uploadé avec succès',
            'media_id' => $media_id,
            'filename' => $new_filename,
            'type' => $media_type,
            'type_media' => $media_type,
            'path' => $relative_path,
            'size' => $file['size']
        ];
        
    } catch (Exception $e) {
        $response = [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Récupération des médias pour une actualité
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['actualite_id'])) {
    $actualite_id = intval($_GET['actualite_id']);
    
    try {
        $stmt = $db->prepare("
            SELECT * FROM {$table_prefix}actualites_media 
            WHERE actualite_id = :actualite_id 
            ORDER BY date_upload DESC
        ");
        $stmt->execute([':actualite_id' => $actualite_id]);
        $medias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'medias' => $medias]);
        
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

// Suppression d'un média
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' || ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE')) {
    parse_str(file_get_contents("php://input"), $delete_data);
    $media_id = $delete_data['media_id'] ?? ($_POST['media_id'] ?? 0);
    
    try {
        // Récupérer les infos du média
        $stmt = $db->prepare("SELECT * FROM {$table_prefix}actualites_media WHERE id = :id");
        $stmt->execute([':id' => $media_id]);
        $media = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($media) {
            // Supprimer le fichier physique
            $file_path = '../' . $media['chemin'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            
            // Supprimer de la base de données
            $stmt = $db->prepare("DELETE FROM {$table_prefix}actualites_media WHERE id = :id");
            $stmt->execute([':id' => $media_id]);
            
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Média supprimé avec succès']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Média non trouvé']);
        }
        
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}
?> 
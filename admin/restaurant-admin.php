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

// Vérifier si le répertoire d'upload existe, sinon le créer
$upload_dir = '../images/restaurant/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Gérer le téléchargement de fichiers
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media_file'])) {
    $response = ['success' => false, 'message' => ''];
    
    $file = $_FILES['media_file'];
    $file_type = $_POST['file_type'] ?? '';
    $description = $_POST['description'] ?? '';
    
    // Vérifier les erreurs d'upload
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error_messages = [
            UPLOAD_ERR_INI_SIZE => 'Le fichier dépasse la taille maximale autorisée par PHP.',
            UPLOAD_ERR_FORM_SIZE => 'Le fichier dépasse la taille maximale autorisée par le formulaire.',
            UPLOAD_ERR_PARTIAL => 'Le fichier n\'a été que partiellement téléchargé.',
            UPLOAD_ERR_NO_FILE => 'Aucun fichier n\'a été téléchargé.',
            UPLOAD_ERR_NO_TMP_DIR => 'Le dossier temporaire est manquant.',
            UPLOAD_ERR_CANT_WRITE => 'Échec de l\'écriture du fichier sur le disque.',
            UPLOAD_ERR_EXTENSION => 'Une extension PHP a arrêté le téléchargement du fichier.'
        ];
        
        $response['message'] = $error_messages[$file['error']] ?? 'Erreur inconnue lors du téléchargement.';
        echo json_encode($response);
        exit;
    }
    
    // Vérifier le type de fichier (images ou vidéos)
    $allowed_types = [
        'image' => ['image/jpeg', 'image/png', 'image/gif'],
        'video' => ['video/mp4', 'video/webm', 'video/ogg']
    ];
    
    if (!in_array($file['type'], $allowed_types[$file_type] ?? [])) {
        $response['message'] = 'Type de fichier non autorisé.';
        echo json_encode($response);
        exit;
    }
    
    // Générer un nom de fichier unique
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = uniqid() . '.' . $file_extension;
    $destination = $upload_dir . $new_filename;
    
    // S'assurer que le répertoire est accessible en écriture
    if (!is_writable(dirname($destination))) {
        // Tenter de modifier les permissions du répertoire
        if (!chmod(dirname($destination), 0755)) {
            $response['message'] = 'Le répertoire de destination n\'est pas accessible en écriture.';
            echo json_encode($response);
            exit;
        }
    }
    
    // Déplacer le fichier téléchargé vers sa destination finale
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        // Enregistrer les informations du média dans la base de données
        try {
            $stmt = $db->prepare("INSERT INTO restaurant_media (file_path, description, type, date_added) VALUES (:file_path, :description, :type, NOW())");
            $stmt->execute([
                ':file_path' => 'images/restaurant/' . $new_filename,
                ':description' => $description,
                ':type' => $file_type
            ]);
            
            $response['success'] = true;
            $response['message'] = 'Fichier téléchargé avec succès.';
            $response['file_path'] = 'images/restaurant/' . $new_filename;
            $response['id'] = $db->lastInsertId();
        } catch (PDOException $e) {
            $response['message'] = 'Erreur lors de l\'enregistrement dans la base de données: ' . $e->getMessage();
            // Supprimer le fichier si l'enregistrement dans la base de données a échoué
            @unlink($destination);
        }
    } else {
        $response['message'] = 'Erreur lors du déplacement du fichier téléchargé. Vérifiez les permissions.';
    }
    
    echo json_encode($response);
    exit;
}

// Récupérer les médias actuels
try {
    $stmt = $db->query("SELECT * FROM restaurant_media ORDER BY date_added DESC");
    $medias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Erreur lors de la récupération des médias: " . $e->getMessage();
    $medias = [];
}

// Gestion de la suppression d'un média
if (isset($_GET['delete_media'])) {
    $media_id = $_GET['delete_media'];
    
    try {
        // Récupérer le chemin du fichier avant de le supprimer de la base de données
        $stmt = $db->prepare("SELECT file_path FROM restaurant_media WHERE id = :id");
        $stmt->execute([':id' => $media_id]);
        $media = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($media) {
            // Supprimer le fichier physique
            $file_to_delete = '../' . $media['file_path'];
            if (file_exists($file_to_delete)) {
                @unlink($file_to_delete);
            }
            
            // Supprimer l'entrée de la base de données
            $stmt = $db->prepare("DELETE FROM restaurant_media WHERE id = :id");
            $stmt->execute([':id' => $media_id]);
            
            $success_message = "Média supprimé avec succès";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la suppression: " . $e->getMessage();
    }
    
    // Rediriger pour éviter les soumissions multiples
    header('Location: restaurant-admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Restaurant Scolaire - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Styles CSS similaires aux autres pages d'administration */
        :root {
            --primary-color: #1a73e8;
            --hover-color: #0d47a1;
            --danger-color: #dc3545;
            --success-color: #28a745;
            --border-color: #dee2e6;
            --gray-light: #f8f9fa;
            --gray-dark: #343a40;
            --shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f7fa;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: var(--shadow);
        }
        
        h1, h2, h3 {
            color: #333;
            margin-bottom: 1rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        input[type="text"],
        input[type="file"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        button, .btn {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        
        button:hover, .btn:hover {
            background: var(--hover-color);
        }
        
        .btn-danger {
            background: var(--danger-color);
        }
        
        .btn-danger:hover {
            background: #bd2130;
        }
        
        .alert {
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        
        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .admin-actions {
            display: flex;
            gap: 15px;
            margin-bottom: 1rem;
        }
        
        .media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 2rem;
        }
        
        .media-card {
            border: 1px solid var(--border-color);
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .media-thumbnail {
            width: 100%;
            height: 180px;
            overflow: hidden;
            background-color: #f5f5f5;
            position: relative;
        }
        
        .media-thumbnail img, .media-thumbnail video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .media-info {
            padding: 15px;
        }
        
        .media-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Gestion du Restaurant Scolaire</h1>
            <div class="admin-actions">
                <a href="actualites-admin.php" class="btn">Gestion des actualités</a>
                <a href="menu-admin.php" class="btn">Gestion des menus</a>
                <a href="?logout=1" class="btn btn-danger">Déconnexion</a>
            </div>
        </div>
        
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?= $success_message ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>
        
        <h2>Ajouter un nouveau média</h2>
        <form method="post" action="" enctype="multipart/form-data" id="media-form">
            <div class="form-group">
                <label for="file_type">Type de média</label>
                <select id="file_type" name="file_type" required>
                    <option value="image">Image</option>
                    <option value="video">Vidéo</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="media_file">Fichier</label>
                <input type="file" id="media_file" name="media_file" required>
                <small>Formats acceptés: JPG, PNG, GIF pour les images; MP4, WebM, OGG pour les vidéos</small>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Description du média..."></textarea>
            </div>
            
            <button type="submit">Télécharger</button>
        </form>
        
        <h2 style="margin-top: 2rem;">Médias du restaurant scolaire</h2>
        
        <?php if (empty($medias)): ?>
            <p>Aucun média trouvé.</p>
        <?php else: ?>
            <div class="media-grid">
                <?php foreach ($medias as $media): ?>
                    <div class="media-card">
                        <div class="media-thumbnail">
                            <?php if ($media['type'] === 'image'): ?>
                                <img src="../<?= htmlspecialchars($media['file_path']) ?>" alt="<?= htmlspecialchars($media['description']) ?>">
                            <?php elseif ($media['type'] === 'video'): ?>
                                <video controls>
                                    <source src="../<?= htmlspecialchars($media['file_path']) ?>" type="video/mp4">
                                    Votre navigateur ne supporte pas la lecture vidéo.
                                </video>
                            <?php endif; ?>
                        </div>
                        <div class="media-info">
                            <p><?= htmlspecialchars($media['description']) ?></p>
                            <small>Ajouté le <?= date('d/m/Y', strtotime($media['date_added'])) ?></small>
                            <div class="media-actions">
                                <a href="?delete_media=<?= $media['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce média ?')">Supprimer</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <a href="../restaurant-scolaire.php" class="btn" style="margin-top: 2rem;">Voir la page du restaurant</a>
    </div>

    <script>
        // Validation du formulaire côté client
        document.getElementById('media-form').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('media_file');
            const fileType = document.getElementById('file_type').value;
            
            if (fileInput.files.length === 0) {
                e.preventDefault();
                alert('Veuillez sélectionner un fichier.');
                return;
            }
            
            const file = fileInput.files[0];
            
            // Vérifier le type de fichier
            if (fileType === 'image' && !file.type.match('image.*')) {
                e.preventDefault();
                alert('Veuillez sélectionner une image (JPG, PNG, GIF).');
                return;
            }
            
            if (fileType === 'video' && !file.type.match('video.*')) {
                e.preventDefault();
                alert('Veuillez sélectionner une vidéo (MP4, WebM, OGG).');
                return;
            }
            
            // Vérifier la taille du fichier (limite à 10 Mo)
            if (file.size > 10 * 1024 * 1024) {
                e.preventDefault();
                alert('Le fichier est trop volumineux. La taille maximale est de 10 Mo.');
                return;
            }
        });
    </script>
</body>
</html> 
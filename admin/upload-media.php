<?php
session_start();
require_once '../includes/db_connect.php';

// Vérifier si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

$message = '';
$error = '';
$debug = '';

// 1. Pré-remplir le formulaire si ?edit=ID est passé en GET
$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $stmt = $db->prepare("SELECT * FROM medias_partage WHERE id = :id");
    $stmt->execute([':id' => $edit_id]);
    $edit_media = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($edit_media) {
        $edit_mode = true;
        $titre = $edit_media['titre'];
        $description = $edit_media['description'];
        $type_fichier = $edit_media['type_fichier'];
        $media_id = $edit_media['id'];
    }
}

// Traitement du formulaire de téléversement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = htmlspecialchars($_POST['titre'] ?? '');
    $description = htmlspecialchars($_POST['description'] ?? '');
    $type_fichier = $_POST['type_fichier'] ?? 'pdf';
    
    // Vérifier si un fichier a été téléversé
    if (isset($_FILES['fichier'])) {
        $debug .= "Fichier soumis. Statut: " . $_FILES['fichier']['error'] . "<br>";
        
        // Afficher les informations complètes du fichier pour débogage
        $debug .= "<pre>Informations du fichier: " . print_r($_FILES['fichier'], true) . "</pre>";
        
        if ($_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
            $fichier = $_FILES['fichier'];
            $nom_fichier = $fichier['name'];
            $tmp_path = $fichier['tmp_name'];
            $taille = $fichier['size'];
            
            // Vérifier le type de fichier
            $extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
            $extensions_autorisees = array('pdf', 'jpg', 'jpeg', 'png', 'mp4');
            
            if (!in_array($extension, $extensions_autorisees)) {
                $error = "Ce type de fichier n'est pas autorisé.";
                $debug .= "Extension non autorisée: $extension<br>";
            } else if ($taille > 20 * 1024 * 1024) { // 20 Mo max
                $error = "Le fichier est trop volumineux (max 20 Mo).";
                $debug .= "Fichier trop volumineux: $taille bytes<br>";
            } else {
                // Créer le dossier de destination s'il n'existe pas
                $dossier_uploads = '../uploads/medias-partage/';
                if (!file_exists($dossier_uploads)) {
                    $debug .= "Création du dossier: $dossier_uploads<br>";
                    if (!mkdir($dossier_uploads, 0777, true)) {
                        $error = "Impossible de créer le dossier de destination.";
                        $debug .= "Erreur lors de la création du dossier<br>";
                    }
                }
                
                // Vérifier les permissions du dossier
                $debug .= "Permissions du dossier: " . substr(sprintf('%o', fileperms($dossier_uploads)), -4) . "<br>";
                $debug .= "Dossier accessible en écriture: " . (is_writable($dossier_uploads) ? 'Oui' : 'Non') . "<br>";
                
                if (empty($error)) {
                    // Générer un nom de fichier unique
                    $date = date('YmdHis');
                    $nouveau_nom = $date . '_' . uniqid() . '.' . $extension;
                    $chemin_fichier = 'uploads/medias-partage/' . $nouveau_nom;
                    $chemin_complet = $dossier_uploads . $nouveau_nom;
                    
                    $debug .= "Tentative de déplacement de '$tmp_path' vers '$chemin_complet'<br>";
                    
                    // Déplacer le fichier téléversé
                    if (move_uploaded_file($tmp_path, $chemin_complet)) {
                        $debug .= "Fichier déplacé avec succès<br>";
                        
                        // Définir les permissions du fichier
                        chmod($chemin_complet, 0644);
                        
                        // Générer un lien de partage unique
                        $lien_partage = bin2hex(random_bytes(5));
                        
                        // Insérer dans la base de données
                        $sql = "INSERT INTO medias_partage (titre, description, fichier_path, type_fichier, lien_partage) 
                                VALUES (:titre, :description, :fichier_path, :type_fichier, :lien_partage)";
                        
                        try {
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':titre', $titre);
                            $stmt->bindParam(':description', $description);
                            $stmt->bindParam(':fichier_path', $chemin_fichier);
                            $stmt->bindParam(':type_fichier', $type_fichier);
                            $stmt->bindParam(':lien_partage', $lien_partage);
                            
                            if ($stmt->execute()) {
                                // Stocker le message dans la session pour l'afficher après redirection
                                $_SESSION['message'] = "Fichier téléversé avec succès! Lien de partage : " . $_SERVER['HTTP_HOST'] . "/lycee1/media.php?l=" . $lien_partage;
                                
                                // Rediriger pour éviter la resoumission du formulaire lors d'un rafraîchissement
                                header('Location: upload-media.php');
                                exit;
                            } else {
                                $error = "Erreur lors de l'enregistrement dans la base de données.";
                                $debug .= "Erreur SQL: " . implode(', ', $stmt->errorInfo()) . "<br>";
                            }
                        } catch (PDOException $e) {
                            $error = "Erreur de base de données: " . $e->getMessage();
                            $debug .= "Exception PDO: " . $e->getMessage() . "<br>";
                        }
                    } else {
                        $error = "Erreur lors du téléversement du fichier.";
                        $debug .= "Échec du déplacement du fichier. Code d'erreur PHP: " . error_get_last()['message'] . "<br>";
                    }
                }
            }
        } else {
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => "Le fichier dépasse la taille maximale définie dans php.ini.",
                UPLOAD_ERR_FORM_SIZE => "Le fichier dépasse la taille maximale spécifiée dans le formulaire HTML.",
                UPLOAD_ERR_PARTIAL => "Le fichier n'a été que partiellement téléversé.",
                UPLOAD_ERR_NO_FILE => "Aucun fichier n'a été téléversé.",
                UPLOAD_ERR_NO_TMP_DIR => "Absence d'un dossier temporaire.",
                UPLOAD_ERR_CANT_WRITE => "Échec de l'écriture du fichier sur le disque.",
                UPLOAD_ERR_EXTENSION => "Une extension PHP a arrêté le téléversement du fichier."
            ];
            
            $errorCode = $_FILES['fichier']['error'];
            $error = "Erreur de téléversement: " . ($errorMessages[$errorCode] ?? "Erreur inconnue (code $errorCode)");
            $debug .= "Code d'erreur: $errorCode - " . ($errorMessages[$errorCode] ?? "Erreur inconnue") . "<br>";
        }
    } else {
        $error = "Veuillez sélectionner un fichier.";
        $debug .= "Aucun fichier soumis<br>";
    }
}

// 2. Traitement de la modification si POST avec media_id
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['media_id']) && !empty($_POST['media_id'])) {
    $media_id = (int)$_POST['media_id'];
    $titre = htmlspecialchars($_POST['titre'] ?? '');
    $description = htmlspecialchars($_POST['description'] ?? '');
    $type_fichier = $_POST['type_fichier'] ?? 'pdf';
    $nouveau_fichier = false;
    $chemin_fichier = null;
    if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
        $fichier = $_FILES['fichier'];
        $nom_fichier = $fichier['name'];
        $tmp_path = $fichier['tmp_name'];
        $extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
        $extensions_autorisees = array('pdf', 'jpg', 'jpeg', 'png', 'mp4');
        if (in_array($extension, $extensions_autorisees)) {
            $date = date('YmdHis');
            $nouveau_nom = $date . '_' . uniqid() . '.' . $extension;
            $chemin_fichier = 'uploads/medias-partage/' . $nouveau_nom;
            $chemin_complet = '../' . $chemin_fichier;
            if (move_uploaded_file($tmp_path, $chemin_complet)) {
                chmod($chemin_complet, 0644);
                $nouveau_fichier = true;
            }
        }
    }
    // Mettre à jour la base
    if ($nouveau_fichier) {
        // Supprimer l'ancien fichier
        $stmt_old = $db->prepare("SELECT fichier_path FROM medias_partage WHERE id = :id");
        $stmt_old->execute([':id' => $media_id]);
        $old = $stmt_old->fetch(PDO::FETCH_ASSOC);
        if ($old && file_exists('../' . $old['fichier_path'])) {
            unlink('../' . $old['fichier_path']);
        }
        $stmt = $db->prepare("UPDATE medias_partage SET titre = :titre, description = :description, type_fichier = :type_fichier, fichier_path = :fichier_path WHERE id = :id");
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':type_fichier' => $type_fichier,
            ':fichier_path' => $chemin_fichier,
            ':id' => $media_id
        ]);
    } else {
        $stmt = $db->prepare("UPDATE medias_partage SET titre = :titre, description = :description, type_fichier = :type_fichier WHERE id = :id");
        $stmt->execute([
            ':titre' => $titre,
            ':description' => $description,
            ':type_fichier' => $type_fichier,
            ':id' => $media_id
        ]);
    }
    $_SESSION['message'] = "Média modifié avec succès.";
    $_SESSION['message_type'] = 'success';
    header('Location: upload-media.php');
    exit;
}

// Suppression d'un média si ?delete=ID est passé en GET
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    // Récupérer le chemin du fichier pour le supprimer physiquement
    $stmt = $db->prepare("SELECT fichier_path FROM medias_partage WHERE id = :id");
    $stmt->execute([':id' => $delete_id]);
    $media = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($media) {
        $file_path = '../' . $media['fichier_path'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        // Supprimer de la base
        $stmt = $db->prepare("DELETE FROM medias_partage WHERE id = :id");
        $stmt->execute([':id' => $delete_id]);
        $_SESSION['message'] = "Média supprimé avec succès.";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Média introuvable.";
        $_SESSION['message_type'] = 'danger';
    }
    header('Location: upload-media.php');
    exit;
}

// Récupérer le message de session
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Nettoyer le message après l'avoir affiché
    
    // Récupérer le type de message si disponible
    if (isset($_SESSION['message_type'])) {
        $message_type = $_SESSION['message_type'];
        unset($_SESSION['message_type']);
    } else {
        $message_type = 'success'; // Type par défaut
    }
}

// Récupérer la liste des fichiers déjà téléversés
$sql = "SELECT * FROM medias_partage ORDER BY date_creation DESC";
$stmt = $db->query($sql);
$medias = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inclure le header
include 'header.php';
?>

<h1>Gestion des médias partagés</h1>

<?php if (!empty($message)): ?>
    <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<?php if (!empty($debug)): ?>
    <div class="alert" style="background-color: #f0f0f0; border: 1px solid #ccc; color: #333;">
        <h4>Informations de débogage:</h4>
        <?php echo $debug; ?>
    </div>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data" class="upload-form">
    <div class="form-group">
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" required value="<?php echo $titre; ?>">
    </div>
    
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="3"><?php echo $description; ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="type_fichier">Type de fichier:</label>
        <select id="type_fichier" name="type_fichier">
            <option value="pdf" <?php echo $type_fichier === 'pdf' ? 'selected' : ''; ?>>PDF</option>
            <option value="image" <?php echo $type_fichier === 'image' ? 'selected' : ''; ?>>Image</option>
            <option value="video" <?php echo $type_fichier === 'video' ? 'selected' : ''; ?>>Vidéo</option>
            <option value="autre" <?php echo $type_fichier === 'autre' ? 'selected' : ''; ?>>Autre</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="fichier">Fichier:</label>
        <input type="file" id="fichier" name="fichier">
        <small>Formats acceptés: PDF, JPG, PNG, MP4. Taille max: 20 Mo</small>
    </div>
    
    <input type="hidden" id="media_id" name="media_id" value="<?php echo $media_id; ?>">
    
    <button type="submit" class="btn btn-primary">Téléverser</button>
    <a href="upload-media.php" class="btn btn-secondary">Annuler</a>
</form>

<h2>Médias partagés</h2>
<table class="table">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Type</th>
            <th>Lien de partage</th>
            <th>Date</th>
            <th>Vues</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($medias as $media): ?>
        <tr>
            <td><?php echo $media['titre']; ?></td>
            <td><?php echo $media['type_fichier']; ?></td>
            <td>
                <a href="<?php echo '../media.php?l=' . $media['lien_partage']; ?>" target="_blank">
                    <?php echo $media['lien_partage']; ?>
                </a>
                <button class="copy-btn" data-link="<?php echo $_SERVER['HTTP_HOST'] . '/lycee1/media.php?l=' . $media['lien_partage']; ?>">Copier</button>
            </td>
            <td><?php echo date('d/m/Y H:i', strtotime($media['date_creation'])); ?></td>
            <td><?php echo $media['vues']; ?></td>
            <td>
                <a href="upload-media.php?edit=<?php echo $media['id']; ?>" class="btn btn-sm btn-warning">Modifier</a>
                <a href="upload-media.php?delete=<?php echo $media['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce média?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if (count($medias) == 0): ?>
        <tr>
            <td colspan="6" class="text-center">Aucun média partagé pour le moment.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?> 
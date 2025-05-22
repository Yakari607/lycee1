<?php
session_start();
require_once '../includes/db_connect.php';

// Vérifier si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

// Vérifier si l'ID est spécifié
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: upload-media.php');
    exit;
}

$id = (int)$_GET['id'];
$message = '';
$error = '';

// Récupérer les informations du média
$sql = "SELECT * FROM medias_partage WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$media = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$media) {
    header('Location: upload-media.php');
    exit;
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $type_fichier = $_POST['type_fichier'];
    $actif = isset($_POST['actif']) ? 1 : 0;
    
    // Vérifier si un nouveau fichier a été téléversé
    $nouveau_fichier = false;
    $chemin_fichier = $media['fichier_path'];
    
    if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
        $fichier = $_FILES['fichier'];
        $nom_fichier = $fichier['name'];
        $tmp_path = $fichier['tmp_name'];
        $taille = $fichier['size'];
        
        // Vérifier le type de fichier
        $extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
        $extensions_autorisees = array('pdf', 'jpg', 'jpeg', 'png', 'mp4');
        
        if (!in_array($extension, $extensions_autorisees)) {
            $error = "Ce type de fichier n'est pas autorisé.";
        } else if ($taille > 20 * 1024 * 1024) { // 20 Mo max
            $error = "Le fichier est trop volumineux (max 20 Mo).";
        } else {
            $nouveau_fichier = true;
            
            // Créer le dossier de destination s'il n'existe pas
            $dossier_uploads = '../uploads/medias-partage/';
            if (!file_exists($dossier_uploads)) {
                mkdir($dossier_uploads, 0777, true);
            }
            
            // Générer un nom de fichier unique
            $date = date('YmdHis');
            $nouveau_nom = $date . '_' . uniqid() . '.' . $extension;
            $chemin_fichier = 'uploads/medias-partage/' . $nouveau_nom;
            $chemin_complet = $dossier_uploads . $nouveau_nom;
            
            // Déplacer le fichier téléversé
            if (!move_uploaded_file($tmp_path, $chemin_complet)) {
                $error = "Erreur lors du téléversement du fichier.";
                $nouveau_fichier = false;
            }
        }
    }
    
    if (empty($error)) {
        // Mettre à jour la base de données
        $sql = "UPDATE medias_partage SET 
                titre = :titre, 
                description = :description, 
                type_fichier = :type_fichier, 
                actif = :actif";
        
        // Ajouter le chemin du fichier si un nouveau fichier a été téléversé
        if ($nouveau_fichier) {
            $sql .= ", fichier_path = :fichier_path";
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':type_fichier', $type_fichier);
        $stmt->bindParam(':actif', $actif);
        $stmt->bindParam(':id', $id);
        
        if ($nouveau_fichier) {
            $stmt->bindParam(':fichier_path', $chemin_fichier);
            
            // Supprimer l'ancien fichier
            $ancien_fichier = '../' . $media['fichier_path'];
            if (file_exists($ancien_fichier)) {
                unlink($ancien_fichier);
            }
        }
        
        if ($stmt->execute()) {
            $message = "Média mis à jour avec succès!";
            
            // Recharger les données du média
            $stmt = $db->prepare("SELECT * FROM medias_partage WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $media = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $error = "Erreur lors de la mise à jour du média.";
        }
    }
}

// Inclure le header
include 'header.php';
?>

<h1>Modifier un média</h1>

<?php if (!empty($message)): ?>
    <div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<a href="upload-media.php" class="btn btn-secondary mb-3">Retour à la liste</a>

<form action="" method="post" enctype="multipart/form-data" class="upload-form">
    <div class="form-group">
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($media['titre']); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="3"><?php echo htmlspecialchars($media['description']); ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="type_fichier">Type de fichier:</label>
        <select id="type_fichier" name="type_fichier">
            <option value="pdf" <?php echo $media['type_fichier'] === 'pdf' ? 'selected' : ''; ?>>PDF</option>
            <option value="image" <?php echo $media['type_fichier'] === 'image' ? 'selected' : ''; ?>>Image</option>
            <option value="video" <?php echo $media['type_fichier'] === 'video' ? 'selected' : ''; ?>>Vidéo</option>
            <option value="autre" <?php echo $media['type_fichier'] === 'autre' ? 'selected' : ''; ?>>Autre</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="actif">Actif:</label>
        <input type="checkbox" id="actif" name="actif" <?php echo $media['actif'] ? 'checked' : ''; ?>>
        <small>Cochez pour rendre ce média accessible via son lien</small>
    </div>
    
    <div class="form-group">
        <label>Fichier actuel:</label>
        <div>
            <a href="<?php echo '../' . $media['fichier_path']; ?>" target="_blank">
                <?php echo basename($media['fichier_path']); ?>
            </a>
        </div>
    </div>
    
    <div class="form-group">
        <label for="fichier">Nouveau fichier (optionnel):</label>
        <input type="file" id="fichier" name="fichier">
        <small>Formats acceptés: PDF, JPG, PNG, MP4. Taille max: 20 Mo</small>
    </div>
    
    <div class="form-group">
        <label>Lien de partage:</label>
        <div class="link-display">
            <a href="<?php echo '../media.php?l=' . $media['lien_partage']; ?>" target="_blank">
                <?php echo $_SERVER['HTTP_HOST'] . '/lycee1/media.php?l=' . $media['lien_partage']; ?>
            </a>
            <button type="button" class="copy-btn" data-link="<?php echo $_SERVER['HTTP_HOST'] . '/lycee1/media.php?l=' . $media['lien_partage']; ?>">Copier</button>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

<?php include 'footer.php'; ?> 
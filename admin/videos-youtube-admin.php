<?php
// Démarrer la session
session_start();

// Inclure la connexion à la base de données
require_once '../includes/db_connect.php';

// Vérification de l'authentification
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

// Fonction pour extraire l'ID YouTube d'une URL
function extractYoutubeId($url) {
    $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
    if (preg_match($pattern, $url, $matches)) {
        return $matches[1];
    }
    return false;
}

// Fonction pour générer l'URL d'embed YouTube
function generateEmbedUrl($video_id) {
    return "https://www.youtube.com/embed/" . $video_id;
}

// Fonction pour générer l'URL de thumbnail YouTube
function generateThumbnailUrl($video_id) {
    return "https://img.youtube.com/vi/" . $video_id . "/maxresdefault.jpg";
}

// Traitement de l'ajout/modification d'une vidéo
if (isset($_POST['save_video'])) {
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $url_youtube = $_POST['url_youtube'] ?? '';
    $categorie = $_POST['categorie'] ?? 'Général';
    $date_publication = $_POST['date_publication'] ?? '';
    $ordre_affichage = intval($_POST['ordre_affichage'] ?? 0);
    $actif = isset($_POST['actif']) ? 1 : 0;
    $video_id_form = $_POST['video_id'] ?? '';
    
    // Validation
    if (empty($titre)) {
        $error_message = "Le titre est requis";
    } elseif (empty($url_youtube)) {
        $error_message = "L'URL YouTube est requise";
    } else {
        // Extraire l'ID YouTube de l'URL
        $video_id = extractYoutubeId($url_youtube);
        if (!$video_id) {
            $error_message = "URL YouTube invalide. Format attendu : https://www.youtube.com/watch?v=VIDEO_ID";
        } else {
            try {
                if (!empty($video_id_form)) {
                    // Mise à jour d'une vidéo existante
                    $stmt = $db->prepare("UPDATE videos_youtube SET 
                                          titre = :titre, 
                                          description = :description, 
                                          url_youtube = :url_youtube,
                                          video_id = :video_id,
                                          categorie = :categorie,
                                          date_publication = :date_publication,
                                          ordre_affichage = :ordre_affichage,
                                          actif = :actif 
                                          WHERE id = :id");
                    $stmt->execute([
                        ':titre' => $titre,
                        ':description' => $description,
                        ':url_youtube' => $url_youtube,
                        ':video_id' => $video_id,
                        ':categorie' => $categorie,
                        ':date_publication' => $date_publication,
                        ':ordre_affichage' => $ordre_affichage,
                        ':actif' => $actif,
                        ':id' => $video_id_form
                    ]);
                    $success_message = "Vidéo mise à jour avec succès";
                } else {
                    // Vérifier si la vidéo existe déjà
                    $check_stmt = $db->prepare("SELECT id FROM videos_youtube WHERE video_id = :video_id");
                    $check_stmt->execute([':video_id' => $video_id]);
                    if ($check_stmt->fetch()) {
                        $error_message = "Cette vidéo YouTube existe déjà dans la base de données";
                    } else {
                        // Ajout d'une nouvelle vidéo
                        $stmt = $db->prepare("INSERT INTO videos_youtube 
                            (titre, description, url_youtube, video_id, categorie, date_publication, ordre_affichage, actif) 
                            VALUES (:titre, :description, :url_youtube, :video_id, :categorie, :date_publication, :ordre_affichage, :actif)");
                        $stmt->execute([
                            ':titre' => $titre,
                            ':description' => $description,
                            ':url_youtube' => $url_youtube,
                            ':video_id' => $video_id,
                            ':categorie' => $categorie,
                            ':date_publication' => $date_publication,
                            ':ordre_affichage' => $ordre_affichage,
                            ':actif' => $actif
                        ]);
                        $success_message = "Vidéo ajoutée avec succès";
                    }
                }
            } catch (PDOException $e) {
                $error_message = "Erreur lors de l'enregistrement : " . $e->getMessage();
            }
        }
    }
}

// Traitement de la suppression d'une vidéo
if (isset($_GET['delete_video'])) {
    $video_id = $_GET['delete_video'];
    
    try {
        $stmt = $db->prepare("DELETE FROM videos_youtube WHERE id = :id");
        $stmt->execute([':id' => $video_id]);
        $success_message = "Vidéo supprimée avec succès";
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la suppression : " . $e->getMessage();
    }
}

// Si on veut éditer une vidéo existante
$video_to_edit = null;
if (isset($_GET['edit_video'])) {
    $video_id = $_GET['edit_video'];
    
    try {
        $stmt = $db->prepare("SELECT * FROM videos_youtube WHERE id = :id");
        $stmt->execute([':id' => $video_id]);
        $video_to_edit = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$video_to_edit) {
            $error_message = "Vidéo introuvable";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la récupération de la vidéo : " . $e->getMessage();
    }
}

// Récupération de toutes les vidéos
try {
    $stmt = $db->query("SELECT * FROM videos_youtube ORDER BY ordre_affichage ASC, date_ajout DESC");
    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Erreur lors de la récupération des vidéos : " . $e->getMessage();
    $videos = [];
}

// Récupération des catégories existantes
try {
    $stmt = $db->query("SELECT DISTINCT categorie FROM videos_youtube ORDER BY categorie");
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (!in_array('Général', $categories)) {
        array_unshift($categories, 'Général');
    }
} catch (PDOException $e) {
    $categories = ['Général'];
}

// Inclure le header
include 'header.php';
?>

<h1>Gestion des vidéos YouTube</h1>

<?php if (isset($success_message)): ?>
    <div class="alert alert-success"><?= $success_message ?></div>
<?php endif; ?>

<?php if (isset($error_message)): ?>
    <div class="alert alert-danger"><?= $error_message ?></div>
<?php endif; ?>

<h2><?= $video_to_edit ? 'Modifier la vidéo' : 'Ajouter une nouvelle vidéo' ?></h2>
<form method="post" action="" class="upload-form">
    <?php if ($video_to_edit): ?>
        <input type="hidden" name="video_id" value="<?= $video_to_edit['id'] ?>">
    <?php endif; ?>
    
    <div class="form-group">
        <label for="titre">Titre de la vidéo *</label>
        <input type="text" id="titre" name="titre" value="<?= $video_to_edit['titre'] ?? '' ?>" required>
    </div>
    
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Description de la vidéo"><?= $video_to_edit['description'] ?? '' ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="url_youtube">URL YouTube *</label>
        <input type="url" id="url_youtube" name="url_youtube" value="<?= $video_to_edit['url_youtube'] ?? '' ?>" 
               placeholder="https://www.youtube.com/watch?v=VIDEO_ID" required>
        <small class="form-help">Formats acceptés : youtube.com/watch?v=, youtu.be/, youtube.com/embed/</small>
    </div>
    
    <div class="form-group">
        <label for="categorie">Catégorie</label>
        <select name="categorie" id="categorie">
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat ?>" <?= (isset($video_to_edit) && $video_to_edit['categorie'] === $cat) ? 'selected' : '' ?>>
                    <?= $cat ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="date_publication">Date de publication</label>
        <input type="date" id="date_publication" name="date_publication" value="<?= $video_to_edit['date_publication'] ?? date('Y-m-d') ?>">
    </div>
    
    <div class="form-group">
        <label for="ordre_affichage">Ordre d'affichage</label>
        <input type="number" id="ordre_affichage" name="ordre_affichage" value="<?= $video_to_edit['ordre_affichage'] ?? 0 ?>" min="0">
        <small class="form-help">Les vidéos avec un ordre plus petit s'affichent en premier</small>
    </div>
    
    <div class="form-group checkbox-group">
        <input type="checkbox" id="actif" name="actif" <?= (isset($video_to_edit) && $video_to_edit['actif']) || !isset($video_to_edit) ? 'checked' : '' ?>>
        <label for="actif">Vidéo active</label>
    </div>

    <button type="submit" name="save_video" class="btn btn-primary"><?= $video_to_edit ? 'Mettre à jour' : 'Ajouter' ?></button>
    <?php if ($video_to_edit): ?>
        <a href="videos-youtube-admin.php" class="btn btn-secondary">Annuler</a>
    <?php endif; ?>
</form>

<h2 style="margin-top: 2rem;">Liste des vidéos</h2>

<?php if (empty($videos)): ?>
    <p>Aucune vidéo trouvée.</p>
<?php else: ?>
    <div class="videos-grid">
        <?php foreach ($videos as $video): ?>
            <div class="video-card">
                <div class="video-thumbnail">
                    <img src="<?= generateThumbnailUrl($video['video_id']) ?>" alt="<?= htmlspecialchars($video['titre']) ?>" 
                         onerror="this.src='https://img.youtube.com/vi/<?= $video['video_id'] ?>/0.jpg'">
                    <div class="video-overlay">
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
                <div class="video-info">
                    <h3><?= htmlspecialchars($video['titre']) ?></h3>
                    <p class="video-category"><?= htmlspecialchars($video['categorie']) ?></p>
                    <?php if (!empty($video['description'])): ?>
                        <p class="video-description"><?= htmlspecialchars(substr($video['description'], 0, 100)) ?>...</p>
                    <?php endif; ?>
                    <div class="video-meta">
                        <span class="video-date"><?= $video['date_publication'] ? date('d/m/Y', strtotime($video['date_publication'])) : 'Non définie' ?></span>
                        <span class="video-status <?= $video['actif'] ? 'active' : 'inactive' ?>">
                            <?= $video['actif'] ? 'Active' : 'Inactive' ?>
                        </span>
                    </div>
                    <div class="video-actions">
                        <a href="?edit_video=<?= $video['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="?delete_video=<?= $video['id'] ?>" class="btn btn-sm btn-danger" 
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vidéo ?')">Supprimer</a>
                        <a href="<?= $video['url_youtube'] ?>" target="_blank" class="btn btn-sm btn-secondary">Voir sur YouTube</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="admin-links" style="margin-top: 2rem;">
    <a href="../videos-youtube.php" class="btn btn-secondary">Voir la page des vidéos</a>
    <a href="index.php" class="btn btn-secondary">Retour à l'administration</a>
</div>

<style>
    .videos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 1.5rem;
    }
    
    .video-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.2s ease;
    }
    
    .video-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .video-thumbnail {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
    }
    
    .video-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    
    .video-card:hover .video-overlay {
        opacity: 1;
    }
    
    .video-overlay i {
        color: white;
        font-size: 3rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    
    .video-info {
        padding: 1rem;
    }
    
    .video-info h3 {
        margin: 0 0 0.5rem 0;
        font-size: 1.1rem;
        color: #333;
    }
    
    .video-category {
        color: #007bff;
        font-weight: 600;
        margin: 0 0 0.5rem 0;
        font-size: 0.9rem;
    }
    
    .video-description {
        color: #666;
        font-size: 0.9rem;
        margin: 0 0 1rem 0;
        line-height: 1.4;
    }
    
    .video-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 0.8rem;
    }
    
    .video-date {
        color: #666;
    }
    
    .video-status {
        padding: 0.2rem 0.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.7rem;
    }
    
    .video-status.active {
        background: #d4edda;
        color: #155724;
    }
    
    .video-status.inactive {
        background: #f8d7da;
        color: #721c24;
    }
    
    .video-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .checkbox-group input[type="checkbox"] {
        width: auto;
    }
    
    .checkbox-group label {
        display: inline;
        margin-bottom: 0;
    }
    
    .form-help {
        color: #6c757d;
        margin-top: 5px;
        font-size: 0.85rem;
    }
    
    .admin-links {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    @media (max-width: 768px) {
        .videos-grid {
            grid-template-columns: 1fr;
        }
        
        .video-actions {
            flex-direction: column;
        }
        
        .video-actions .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Prévisualisation de l'URL YouTube
    const urlInput = document.getElementById('url_youtube');
    const previewDiv = document.createElement('div');
    previewDiv.className = 'url-preview';
    previewDiv.style.cssText = 'margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 4px; display: none;';
    
    if (urlInput) {
        urlInput.parentNode.appendChild(previewDiv);
        
        urlInput.addEventListener('input', function() {
            const url = this.value.trim();
            if (url) {
                const videoId = extractYoutubeId(url);
                if (videoId) {
                    previewDiv.innerHTML = `
                        <strong>✅ URL valide</strong><br>
                        <small>ID vidéo: ${videoId}</small><br>
                        <img src="https://img.youtube.com/vi/${videoId}/maxresdefault.jpg" 
                             style="max-width: 200px; max-height: 120px; margin-top: 10px; border-radius: 4px;"
                             onerror="this.src='https://img.youtube.com/vi/${videoId}/0.jpg'">
                    `;
                    previewDiv.style.display = 'block';
                } else {
                    previewDiv.innerHTML = '<strong>❌ URL YouTube invalide</strong>';
                    previewDiv.style.display = 'block';
                }
            } else {
                previewDiv.style.display = 'none';
            }
        });
    }
    
    // Fonction pour extraire l'ID YouTube (version JavaScript)
    function extractYoutubeId(url) {
        const pattern = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i;
        const match = url.match(pattern);
        return match ? match[1] : false;
    }
});
</script>

<?php include 'footer.php'; ?> 
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

// Traitement de l'ajout/modification d'une actualité
if (isset($_POST['save_actualite'])) {
    $titre = $_POST['titre'] ?? '';
    $contenu = $_POST['contenu'] ?? '';
    $date_publication = $_POST['date_publication'] ?? '';
    $image = $_POST['image'] ?? '';
    $categorie = $_POST['categorie'] ?? '';
    $is_important = isset($_POST['is_important']) ? 1 : 0;
    $actualite_id = $_POST['actualite_id'] ?? '';
    
    try {
        if (!empty($actualite_id)) {
            // Mise à jour d'une actualité existante
            $stmt = $db->prepare("UPDATE actualites SET titre = :titre, contenu = :contenu, date_publication = :date_publication, image = :image, categorie = :categorie, is_important = :is_important WHERE id = :id");
            $stmt->execute([
                ':titre' => $titre,
                ':contenu' => $contenu,
                ':date_publication' => $date_publication,
                ':image' => $image,
                ':categorie' => $categorie,
                ':is_important' => $is_important,
                ':id' => $actualite_id
            ]);
            $success_message = "Actualité mise à jour avec succès";
        } else {
            // Ajout d'une nouvelle actualité
            $stmt = $db->prepare("INSERT INTO actualites (titre, contenu, date_publication, image, categorie, is_important) VALUES (:titre, :contenu, :date_publication, :image, :categorie, :is_important)");
            $stmt->execute([
                ':titre' => $titre,
                ':contenu' => $contenu,
                ':date_publication' => $date_publication,
                ':image' => $image,
                ':categorie' => $categorie,
                ':is_important' => $is_important
            ]);
            $success_message = "Actualité ajoutée avec succès";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur lors de l'enregistrement : " . $e->getMessage();
    }
}

// Traitement de la suppression d'une actualité
if (isset($_GET['delete_actualite'])) {
    $actualite_id = $_GET['delete_actualite'];
    
    try {
        // Récupérer tous les médias associés à cette actualité
        $stmt = $db->prepare("SELECT chemin FROM {$table_prefix}actualites_media WHERE actualite_id = :actualite_id");
        $stmt->execute([':actualite_id' => $actualite_id]);
        $medias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Supprimer tous les fichiers physiques
        foreach ($medias as $media) {
            $file_path = '../' . $media['chemin'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        
        // Supprimer tous les médias de la base de données
        $stmt = $db->prepare("DELETE FROM {$table_prefix}actualites_media WHERE actualite_id = :actualite_id");
        $stmt->execute([':actualite_id' => $actualite_id]);
        
        // Supprimer l'actualité
        $stmt = $db->prepare("DELETE FROM actualites WHERE id = :id");
        $stmt->execute([':id' => $actualite_id]);
        $success_message = "Actualité et tous ses médias supprimés avec succès";
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la suppression : " . $e->getMessage();
    }
}

// Si on veut éditer une actualité existante
$actualite_to_edit = null;
if (isset($_GET['edit_actualite'])) {
    $actualite_id = $_GET['edit_actualite'];
    
    try {
        $stmt = $db->prepare("SELECT * FROM actualites WHERE id = :id");
        $stmt->execute([':id' => $actualite_id]);
        $actualite_to_edit = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$actualite_to_edit) {
            $error_message = "Actualité introuvable";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la récupération de l'actualité : " . $e->getMessage();
    }
}

// Récupération de toutes les actualités
try {
    $stmt = $db->query("SELECT * FROM actualites ORDER BY date_publication DESC");
    $actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Erreur lors de la récupération des actualités : " . $e->getMessage();
    $actualites = [];
}

// Inclure le header
include 'header.php';
?>

<h1>Gestion des actualités</h1>

<?php if (isset($success_message)): ?>
    <div class="alert alert-success"><?= $success_message ?></div>
<?php endif; ?>

<?php if (isset($error_message)): ?>
    <div class="alert alert-danger"><?= $error_message ?></div>
<?php endif; ?>

<h2><?= $actualite_to_edit ? 'Modifier l\'actualité' : 'Ajouter une nouvelle actualité' ?></h2>
<form method="post" action="" class="upload-form">
    <?php if ($actualite_to_edit): ?>
        <input type="hidden" name="actualite_id" value="<?= $actualite_to_edit['id'] ?>">
    <?php endif; ?>
    
    <div class="form-group">
        <label for="titre">Titre de l'actualité</label>
        <input type="text" id="titre" name="titre" value="<?= $actualite_to_edit['titre'] ?? '' ?>" required>
    </div>
    
    <div class="form-group">
        <label for="contenu">Contenu</label>
        <textarea id="contenu" name="contenu" required><?= $actualite_to_edit['contenu'] ?? '' ?></textarea>
    </div>
    
    <!-- Section simple pour ajouter des médias -->
    <?php if (isset($actualite_to_edit['id'])): ?>
    <div class="form-group">
        <label>Ajouter des images ou PDF dans l'article</label>
        <div class="media-upload-simple">
            <input type="file" id="quickMediaUpload" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf" multiple style="display: none;">
            <button type="button" class="btn btn-secondary" onclick="document.getElementById('quickMediaUpload').click()">
                <i class="fas fa-plus"></i> Sélectionner des fichiers
            </button>
            <div id="uploadProgress" style="display: none;">
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <span class="progress-text">Upload en cours...</span>
            </div>
            <div id="uploadedFiles"></div>
        </div>
    </div>
    
    <!-- Liste des médias déjà uploadés -->
    <div class="form-group">
        <label>Médias disponibles pour cette actualité</label>
        <div id="existingMedias" class="existing-medias">
            <!-- Chargé par JavaScript -->
        </div>
    </div>
    <?php else: ?>
    <div class="form-group">
        <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <strong>Info :</strong> Enregistrez d'abord l'actualité pour pouvoir ajouter des images et PDF.
        </div>
    </div>
    <?php endif; ?>
    
    <div class="form-group">
        <label for="date_publication">Date de publication</label>
        <input type="date" id="date_publication" name="date_publication" value="<?= $actualite_to_edit['date_publication'] ?? date('Y-m-d') ?>" required>
    </div>
    
    <div class="form-group">
        <label for="image">URL de l'image</label>
        <input type="text" id="image" name="image" value="<?= $actualite_to_edit['image'] ?? '' ?>" placeholder="images/actualites/exemple.jpg">
    </div>
    
    <div class="form-group">
        <label for="categorie">Catégorie</label>
        <input type="text" id="categorie" name="categorie" value="<?= $actualite_to_edit['categorie'] ?? '' ?>" required>
    </div>
    
    <div class="form-group checkbox-group">
        <input type="checkbox" id="is_important" name="is_important" <?= isset($actualite_to_edit['is_important']) && $actualite_to_edit['is_important'] ? 'checked' : '' ?>>
        <label for="is_important">Actualité importante (mise en avant)</label>
    </div>
    
    <button type="submit" name="save_actualite" class="btn btn-primary"><?= $actualite_to_edit ? 'Mettre à jour' : 'Ajouter' ?></button>
    <?php if ($actualite_to_edit): ?>
        <a href="actualites-admin.php" class="btn btn-secondary">Annuler</a>
    <?php endif; ?>
</form>

<h2 style="margin-top: 2rem;">Liste des actualités</h2>

<?php if (empty($actualites)): ?>
    <p>Aucune actualité trouvée.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Date de publication</th>
                <th>Catégorie</th>
                <th>Important</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($actualites as $actualite): ?>
                <tr>
                    <td><?= $actualite['id'] ?></td>
                    <td class="truncate"><?= htmlspecialchars($actualite['titre']) ?></td>
                    <td><?= $actualite['date_publication'] ?></td>
                    <td><?= htmlspecialchars($actualite['categorie']) ?></td>
                    <td><?= $actualite['is_important'] ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' ?></td>
                    <td class="actions">
                        <a href="?edit_actualite=<?= $actualite['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="?delete_actualite=<?= $actualite['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="../index.php" class="btn btn-secondary" style="margin-top: 2rem;">Retour au site</a>

<style>
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
    
    .truncate {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .actions {
        display: flex;
        gap: 10px;
    }
    
    /* Styles pour l'upload simple */
    .media-upload-simple {
        border: 2px dashed #007bff;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        margin: 1rem 0;
    }
    
    .progress-bar {
        width: 100%;
        height: 20px;
        background: #f0f0f0;
        border-radius: 10px;
        overflow: hidden;
        margin: 1rem 0;
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #007bff, #0056b3);
        width: 0%;
        transition: width 0.3s ease;
    }
    
    .progress-text {
        font-size: 0.9rem;
        color: #666;
    }
    
    .info-box {
        background: #e3f2fd;
        border: 1px solid #bbdefb;
        border-radius: 8px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #1976d2;
    }
    
    /* Médias existants */
    .existing-medias {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .media-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 1rem;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .media-thumb {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 1px solid #ddd;
        flex-shrink: 0;
    }
    
    .media-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
    }
    
    .media-thumb i {
        font-size: 1.5rem;
        color: #dc3545;
    }
    
    .media-info-simple {
        flex: 1;
        min-width: 0;
    }
    
    .media-name-simple {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }
    
    .media-code {
        font-family: monospace;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 0.3rem 0.5rem;
        font-size: 0.8rem;
        color: #d63384;
        cursor: pointer;
        user-select: all;
    }
    
    .media-code:hover {
        background: #f0f0f0;
    }
    
    .btn-copy {
        background: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.3rem 0.6rem;
        font-size: 0.8rem;
        cursor: pointer;
        margin-left: 0.5rem;
    }
    
    .btn-copy:hover {
        background: #218838;
    }
    
    .btn-delete-simple {
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.3rem 0.6rem;
        font-size: 0.8rem;
        cursor: pointer;
        margin-left: 0.5rem;
    }
    
    .btn-delete-simple:hover {
        background: #c82333;
    }
    
    .upload-result {
        margin-top: 1rem;
        padding: 1rem;
        border-radius: 8px;
    }
    
    .upload-success {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }
    
    .upload-error {
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }
</style>

<script>
// Variables globales
let currentActualiteId = <?= $actualite_to_edit['id'] ?? 0 ?>;

// Charger les médias au démarrage
document.addEventListener('DOMContentLoaded', function() {
    if (currentActualiteId > 0) {
        loadExistingMedias();
    }
    
    // Gestion de l'upload de fichiers
    const fileInput = document.getElementById('quickMediaUpload');
    if (fileInput) {
        fileInput.addEventListener('change', handleFileUpload);
    }
});

// Upload simple de fichiers
function handleFileUpload(event) {
    const files = event.target.files;
    if (files.length === 0) return;
    
    const progressDiv = document.getElementById('uploadProgress');
    const progressFill = document.querySelector('.progress-fill');
    const progressText = document.querySelector('.progress-text');
    const uploadedDiv = document.getElementById('uploadedFiles');
    
    progressDiv.style.display = 'block';
    uploadedDiv.innerHTML = '';
    
    let uploadedCount = 0;
    const totalFiles = files.length;
    
    // Upload de chaque fichier
    Array.from(files).forEach((file, index) => {
        const formData = new FormData();
        formData.append('media', file);
        formData.append('actualite_id', currentActualiteId);
        formData.append('description', '');
        
        fetch('upload-actualite-media.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            uploadedCount++;
            const progress = (uploadedCount / totalFiles) * 100;
            progressFill.style.width = progress + '%';
            progressText.textContent = `Upload ${uploadedCount}/${totalFiles} fichiers...`;
            
            if (data.success) {
                const shortcode = data.type_media === 'image' 
                    ? `[image id="${data.media_id}" align="center"]`
                    : `[pdf id="${data.media_id}" title="${file.name}"]`;
                
                uploadedDiv.innerHTML += `
                    <div class="upload-result upload-success">
                        <strong>${file.name}</strong> uploadé avec succès!
                        <br>Code à copier: <code class="media-code" onclick="copyToClipboard('${shortcode}')">${shortcode}</code>
                        <button class="btn-copy" onclick="insertIntoContent('${shortcode}')">Insérer</button>
                    </div>
                `;
            } else {
                uploadedDiv.innerHTML += `
                    <div class="upload-result upload-error">
                        <strong>${file.name}</strong> : Erreur - ${data.message || 'Erreur inconnue'}
                    </div>
                `;
            }
            
            // Si tous les fichiers sont traités
            if (uploadedCount === totalFiles) {
                progressDiv.style.display = 'none';
                loadExistingMedias(); // Recharger la liste
                
                // Réinitialiser l'input
                event.target.value = '';
            }
        })
        .catch(error => {
            uploadedCount++;
            uploadedDiv.innerHTML += `
                <div class="upload-result upload-error">
                    <strong>${file.name}</strong> : Erreur de connexion
                </div>
            `;
            
            if (uploadedCount === totalFiles) {
                progressDiv.style.display = 'none';
            }
        });
    });
}

// Charger les médias existants
function loadExistingMedias() {
    const container = document.getElementById('existingMedias');
    if (!container) return;
    
    container.innerHTML = '<div style="text-align: center; padding: 1rem;"><i class="fas fa-spinner fa-spin"></i> Chargement...</div>';
    
    fetch(`upload-actualite-media.php?actualite_id=${currentActualiteId}`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayExistingMedias(data.medias);
        } else {
            container.innerHTML = '<div style="text-align: center; padding: 1rem; color: #666;">Erreur lors du chargement</div>';
        }
    })
    .catch(error => {
        container.innerHTML = '<div style="text-align: center; padding: 1rem; color: #666;">Erreur de connexion</div>';
    });
}

// Afficher les médias existants
function displayExistingMedias(medias) {
    const container = document.getElementById('existingMedias');
    
    if (medias.length === 0) {
        container.innerHTML = '<div style="text-align: center; padding: 2rem; color: #666; background: #f8f9fa; border-radius: 8px; border: 1px dashed #ddd;"><i class="fas fa-images"></i><br>Aucun média pour cette actualité</div>';
        return;
    }
    
    let html = '';
    medias.forEach(media => {
        const isImage = media.type_media === 'image';
        const shortcode = isImage 
            ? `[image id="${media.id}" align="center"]`
            : `[pdf id="${media.id}" title="${media.nom_original}"]`;
        
        const thumb = isImage 
            ? `<img src="../${media.chemin}" alt="${media.nom_original}">` 
            : '<i class="fas fa-file-pdf"></i>';
        
        html += `
            <div class="media-card">
                <div class="media-thumb">${thumb}</div>
                <div class="media-info-simple">
                    <div class="media-name-simple">${media.nom_original}</div>
                    <div class="media-code" onclick="copyToClipboard('${shortcode}')" title="Cliquer pour copier">${shortcode}</div>
                </div>
                <button class="btn-copy" onclick="insertIntoContent('${shortcode}')">Insérer</button>
                <button class="btn-delete-simple" onclick="deleteMedia(${media.id})">Supprimer</button>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

// Insérer dans le contenu
function insertIntoContent(shortcode) {
    const textarea = document.getElementById('contenu');
    const cursorPos = textarea.selectionStart;
    const textBefore = textarea.value.substring(0, cursorPos);
    const textAfter = textarea.value.substring(cursorPos);
    
    textarea.value = textBefore + '\n' + shortcode + '\n' + textAfter;
    textarea.focus();
    
    // Placer le curseur après le shortcode
    const newPos = cursorPos + shortcode.length + 2;
    textarea.setSelectionRange(newPos, newPos);
    
    // Feedback visuel
    showFeedback('Code inséré dans le contenu !');
}

// Copier dans le presse-papiers
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        showFeedback('Code copié dans le presse-papiers !');
    }).catch(() => {
        // Fallback pour les navigateurs plus anciens
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showFeedback('Code copié !');
    });
}

// Supprimer un média
function deleteMedia(mediaId) {
    if (!confirm('Supprimer ce média ? Il sera retiré de tous les articles qui l\'utilisent.')) {
        return;
    }
    
    fetch('upload-actualite-media.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `_method=DELETE&media_id=${mediaId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showFeedback('Média supprimé avec succès !');
            loadExistingMedias();
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        alert('Erreur lors de la suppression');
    });
}

// Feedback visuel
function showFeedback(message) {
    // Créer un élément de notification
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #28a745;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        z-index: 1000;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Animation d'apparition
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Suppression après 3 secondes
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}
</script>

<?php include 'footer.php'; ?> 
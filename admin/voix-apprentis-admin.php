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

// Traitement de l'upload de fichier
function upload_file($file, $target_dir) {
    // Activons le débogage
    error_log("Tentative d'upload: " . json_encode($file));
    error_log("Dossier cible: " . $target_dir);
    
    // Vérifier si le dossier existe, sinon le créer
    if (!file_exists($target_dir)) {
        error_log("Le dossier n'existe pas, tentative de création: " . $target_dir);
        $mkdir_result = mkdir($target_dir, 0777, true);
        if (!$mkdir_result) {
            error_log("Erreur lors de la création du dossier: " . $target_dir);
            return [
                'success' => false,
                'message' => "Impossible de créer le dossier de destination. Vérifiez les permissions."
            ];
        }
    }
    
    // Extraire le nom de fichier et l'extension
    $file_name = basename($file["name"]);
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    error_log("Type de fichier: " . $file_type);
    
    // Générer un nom de fichier unique pour éviter les collisions
    $new_file_name = uniqid() . '.' . $file_type;
    $target_file = $target_dir . $new_file_name;
    error_log("Fichier cible: " . $target_file);
    
    // Vérifier si le fichier est bien un fichier image ou PDF selon le dossier cible
    if (strpos($target_dir, 'images') !== false) {
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($file_type, $allowed_types)) {
            error_log("Type de fichier non autorisé pour les images: " . $file_type);
            return [
                'success' => false,
                'message' => "Seuls les fichiers JPG, JPEG, PNG, GIF et WEBP sont autorisés pour les images."
            ];
        }
    } elseif (strpos($target_dir, 'uploads') !== false) {
        if ($file_type != 'pdf') {
            error_log("Type de fichier non autorisé pour les documents: " . $file_type);
            return [
                'success' => false,
                'message' => "Seuls les fichiers PDF sont autorisés pour les documents."
            ];
        }
    }
    
    // Vérifier la taille du fichier (10 Mo max)
    if ($file['size'] > 10 * 1024 * 1024) {
        error_log("Fichier trop volumineux: " . $file['size'] . " octets");
        return [
            'success' => false,
            'message' => "Le fichier est trop volumineux. La taille maximale est de 10 Mo."
        ];
    }
    
    // Essayons de copier le fichier au lieu de le déplacer
    error_log("Tentative de copie de " . $file["tmp_name"] . " vers " . $target_file);
    
    if (copy($file["tmp_name"], $target_file)) {
        error_log("Fichier copié avec succès");
        // Si la copie a réussi, on peut supprimer le fichier temporaire
        @unlink($file["tmp_name"]);
        return [
            'success' => true,
            'path' => str_replace('../', '', $target_file)
        ];
    }
    
    error_log("Erreur lors de la copie du fichier.");
    // Vérifions si le fichier temporaire existe
    if (!file_exists($file["tmp_name"])) {
        error_log("Le fichier temporaire n'existe pas: " . $file["tmp_name"]);
    }
    // Vérifions si on peut écrire dans le dossier cible
    if (!is_writable(dirname($target_file))) {
        error_log("Le dossier cible n'est pas accessible en écriture: " . dirname($target_file));
    }
    
    return [
        'success' => false,
        'message' => "Une erreur s'est produite lors du téléchargement. Code: " . $file['error']
    ];
}

// Traitement de l'ajout d'un journal
if (isset($_POST['save_journal'])) {
    $numero = $_POST['numero'] ?? '';
    $date_publication = $_POST['date_publication'] ?? '';
    $theme = $_POST['theme'] ?? '';
    $description = $_POST['description'] ?? '';
    $is_supplement = isset($_POST['is_supplement']) ? 1 : 0;
    $journal_id = $_POST['journal_id'] ?? '';
    
    $upload_error = false;
    
    // Traitement de l'image
    $image_path = $_POST['image_path'] ?? '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $upload_result = upload_file($_FILES['image'], "../images/voix-apprentis/");
        if ($upload_result['success']) {
            $image_path = $upload_result['path'];
        } else {
            $error_message = "Erreur image: " . $upload_result['message'];
            $upload_error = true;
        }
    }
    
    // Traitement du fichier PDF
    $fichier_pdf = $_POST['fichier_pdf'] ?? '';
    if (!$upload_error && isset($_FILES['fichier_pdf']) && $_FILES['fichier_pdf']['error'] !== UPLOAD_ERR_NO_FILE) {
        $upload_result = upload_file($_FILES['fichier_pdf'], "../uploads/voix-apprentis/");
        if ($upload_result['success']) {
            $fichier_pdf = $upload_result['path'];
        } else {
            $error_message = "Erreur PDF: " . $upload_result['message'];
            $upload_error = true;
        }
    }
    
    // Si pas d'erreur d'upload, on enregistre en base de données
    if (!$upload_error) {
        try {
            if (!empty($journal_id)) {
                // Mise à jour d'un journal existant
                $query = "UPDATE voix_apprentis_journaux SET 
                          numero = :numero, 
                          date_publication = :date_publication, 
                          theme = :theme, 
                          description = :description, 
                          is_supplement = :is_supplement";
                
                if (!empty($image_path)) {
                    $query .= ", image = :image";
                }
                
                if (!empty($fichier_pdf)) {
                    $query .= ", fichier_pdf = :fichier_pdf";
                }
                
                $query .= " WHERE id = :id";
                
                $stmt = $db->prepare($query);
                $params = [
                    ':numero' => $numero,
                    ':date_publication' => $date_publication,
                    ':theme' => $theme,
                    ':description' => $description,
                    ':is_supplement' => $is_supplement,
                    ':id' => $journal_id
                ];
                
                if (!empty($image_path)) {
                    $params[':image'] = $image_path;
                }
                
                if (!empty($fichier_pdf)) {
                    $params[':fichier_pdf'] = $fichier_pdf;
                }
                
                $stmt->execute($params);
                $success_message = "Journal mis à jour avec succès";
            } else {
                // Vérification que les fichiers ont été uploadés pour un nouveau journal
                if (empty($image_path)) {
                    $error_message = "Vous devez télécharger une image de couverture";
                } elseif (empty($fichier_pdf)) {
                    $error_message = "Vous devez télécharger un fichier PDF";
                } else {
                    // Ajout d'un nouveau journal
                    $stmt = $db->prepare("INSERT INTO voix_apprentis_journaux 
                        (numero, date_publication, theme, description, image, fichier_pdf, is_supplement) 
                        VALUES (:numero, :date_publication, :theme, :description, :image, :fichier_pdf, :is_supplement)");
                    $stmt->execute([
                        ':numero' => $numero,
                        ':date_publication' => $date_publication,
                        ':theme' => $theme,
                        ':description' => $description,
                        ':image' => $image_path,
                        ':fichier_pdf' => $fichier_pdf,
                        ':is_supplement' => $is_supplement
                    ]);
                    $success_message = "Journal ajouté avec succès";
                }
            }
        } catch (PDOException $e) {
            $error_message = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
}

// Traitement de la suppression d'un journal
if (isset($_GET['delete_journal'])) {
    $journal_id = $_GET['delete_journal'];
    
    try {
        // Récupérer les chemins des fichiers à supprimer
        $stmt = $db->prepare("SELECT image, fichier_pdf FROM voix_apprentis_journaux WHERE id = :id");
        $stmt->execute([':id' => $journal_id]);
        $journal = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Supprimer les fichiers
        if ($journal) {
            if (file_exists("../" . $journal['image'])) {
                unlink("../" . $journal['image']);
            }
            if (file_exists("../" . $journal['fichier_pdf'])) {
                unlink("../" . $journal['fichier_pdf']);
            }
        }
        
        // Supprimer l'entrée de la base de données
        $stmt = $db->prepare("DELETE FROM voix_apprentis_journaux WHERE id = :id");
        $stmt->execute([':id' => $journal_id]);
        $success_message = "Journal supprimé avec succès";
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la suppression : " . $e->getMessage();
    }
}

// Si on veut éditer un journal existant
$journal_to_edit = null;
if (isset($_GET['edit_journal'])) {
    $journal_id = $_GET['edit_journal'];
    
    try {
        $stmt = $db->prepare("SELECT * FROM voix_apprentis_journaux WHERE id = :id");
        $stmt->execute([':id' => $journal_id]);
        $journal_to_edit = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$journal_to_edit) {
            $error_message = "Journal introuvable";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la récupération du journal : " . $e->getMessage();
    }
}

// Récupération de tous les journaux
try {
    $stmt = $db->query("SELECT * FROM voix_apprentis_journaux ORDER BY numero DESC, is_supplement ASC");
    $journaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Erreur lors de la récupération des journaux : " . $e->getMessage();
    $journaux = [];
}

// Inclure le header
include 'header.php';
?>

<h1>Gestion de La Voix des Apprentis</h1>

<?php if (isset($success_message)): ?>
    <div class="alert alert-success"><?= $success_message ?></div>
<?php endif; ?>

<?php if (isset($error_message)): ?>
    <div class="alert alert-danger"><?= $error_message ?></div>
<?php endif; ?>

<h2><?= $journal_to_edit ? 'Modifier le journal' : 'Ajouter un nouveau journal' ?></h2>
<form method="post" action="" enctype="multipart/form-data" name="save_journal" class="upload-form">
    <?php if ($journal_to_edit): ?>
        <input type="hidden" name="journal_id" value="<?= $journal_to_edit['id'] ?>">
        <input type="hidden" name="image_path" value="<?= $journal_to_edit['image'] ?>">
        <input type="hidden" name="fichier_pdf" value="<?= $journal_to_edit['fichier_pdf'] ?>">
    <?php endif; ?>
    
    <div class="form-group">
        <label for="numero">Numéro du journal</label>
        <input type="number" id="numero" name="numero" value="<?= $journal_to_edit['numero'] ?? '' ?>" required min="1">
    </div>
    
    <div class="form-group">
        <label for="date_publication">Date de publication</label>
        <input type="date" id="date_publication" name="date_publication" value="<?= $journal_to_edit['date_publication'] ?? date('Y-m-d') ?>" required>
    </div>
    
    <div class="form-group">
        <label for="theme">Thème (facultatif)</label>
        <input type="text" id="theme" name="theme" value="<?= $journal_to_edit['theme'] ?? '' ?>" placeholder="Ex: La paix, L'amour, Le temps...">
    </div>
    
    <div class="form-group">
        <label for="description">Description (facultatif)</label>
        <textarea id="description" name="description" placeholder="Description brève du contenu du journal"><?= $journal_to_edit['description'] ?? '' ?></textarea>
    </div>
    
    <div class="form-group checkbox-group">
        <input type="checkbox" id="is_supplement" name="is_supplement" <?= (isset($journal_to_edit) && $journal_to_edit['is_supplement']) ? 'checked' : '' ?>>
        <label for="is_supplement">Supplément</label>
    </div>
    
    <div class="form-group">
        <label for="image">Image de couverture</label>
        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif,image/webp" <?= $journal_to_edit ? '' : 'required' ?>>
        <div class="form-help">
            <small>Formats acceptés: JPG, PNG, GIF, WEBP. Taille max: 10 Mo. Dimension recommandée: 800x600px</small>
        </div>
        <?php if (isset($journal_to_edit) && !empty($journal_to_edit['image'])): ?>
            <div class="file-preview">
                <p>Image actuelle :</p>
                <img src="../<?= $journal_to_edit['image'] ?>" alt="Couverture du journal">
            </div>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="fichier_pdf">Fichier PDF</label>
        <input type="file" id="fichier_pdf" name="fichier_pdf" accept="application/pdf" <?= $journal_to_edit ? '' : 'required' ?>>
        <div class="form-help">
            <small>Format accepté: PDF uniquement. Taille max: 10 Mo.</small>
        </div>
        <?php if (isset($journal_to_edit) && !empty($journal_to_edit['fichier_pdf'])): ?>
            <div class="file-preview">
                <p>Fichier actuel :</p>
                <a href="../<?= $journal_to_edit['fichier_pdf'] ?>" class="file-link" target="_blank">
                    <i class="fas fa-file-pdf"></i> <?= basename($journal_to_edit['fichier_pdf']) ?>
                </a>
            </div>
        <?php endif; ?>
    </div>

    
    <button type="submit" name="save_journal" class="btn btn-primary"><?= $journal_to_edit ? 'Mettre à jour' : 'Ajouter' ?></button>
    <?php if ($journal_to_edit): ?>
        <a href="voix-apprentis-admin.php" class="btn btn-secondary">Annuler</a>
    <?php endif; ?>
</form>

<h2 style="margin-top: 2rem;">Liste des journaux</h2>

<?php if (empty($journaux)): ?>
    <p>Aucun journal trouvé.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Numéro</th>
                <th>Date</th>
                <th>Thème</th>
                <th>Image</th>
                <th>Fichier PDF</th>
                <th>Supplément</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($journaux as $journal): ?>
                <tr>
                    <td><?= $journal['id'] ?></td>
                    <td><?= $journal['numero'] ?></td>
                    <td><?= $journal['date_publication'] ?></td>
                    <td class="truncate"><?= htmlspecialchars($journal['theme'] ?? '') ?></td>
                    <td>
                        <a href="../<?= $journal['image'] ?>" target="_blank">
                            <img src="../<?= $journal['image'] ?>" alt="Couverture" style="max-width: 50px; max-height: 50px;">
                        </a>
                    </td>
                    <td>
                        <a href="../<?= $journal['fichier_pdf'] ?>" target="_blank" class="file-link">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </td>
                    <td><?= $journal['is_supplement'] ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' ?></td>
                    <td class="actions">
                        <a href="?edit_journal=<?= $journal['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="?delete_journal=<?= $journal['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce journal ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="../voix-apprentis.php" class="btn btn-secondary" style="margin-top: 2rem;">Voir la page La Voix des Apprentis</a>

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
    
    .file-preview {
        margin-top: 15px;
        padding: 10px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        background-color: #f8f9fa;
    }
    
    .file-preview img {
        max-width: 300px;
        max-height: 200px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 3px;
        background-color: white;
        display: block;
        margin-top: 10px;
    }
    
    .file-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #007bff;
        text-decoration: none;
        margin-top: 5px;
    }
    
    .file-link:hover {
        text-decoration: underline;
    }
    
    .form-help {
        color: #6c757d;
        margin-top: 5px;
    }
    
    .truncate {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .actions {
        display: flex;
        gap: 10px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour formatter la taille des fichiers
    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' octets';
        else if (bytes < 1048576) return (bytes / 1024).toFixed(2) + ' Ko';
        else return (bytes / 1048576).toFixed(2) + ' Mo';
    }
    
    // Prévisualisation de l'image
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (!file) return;
            
            // Vérifier le type de fichier
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!validImageTypes.includes(file.type)) {
                alert('Type de fichier invalide. Veuillez sélectionner une image au format JPG, PNG, GIF ou WEBP.');
                this.value = ''; // Réinitialiser l'input
                return;
            }
            
            // Vérifier la taille (max 10 Mo)
            if (file.size > 10 * 1024 * 1024) {
                alert('Le fichier est trop volumineux. La taille maximale est de 10 Mo.');
                this.value = ''; // Réinitialiser l'input
                return;
            }
            
            // Créer ou récupérer la div de prévisualisation
            let previewDiv = this.nextElementSibling.nextElementSibling;
            if (!previewDiv || !previewDiv.classList.contains('file-preview')) {
                previewDiv = document.createElement('div');
                previewDiv.className = 'file-preview';
                this.parentNode.appendChild(previewDiv);
            }
            
            // Afficher les informations du fichier
            previewDiv.innerHTML = `
                <p>Aperçu de l'image sélectionnée :</p>
                <p><strong>Nom :</strong> ${file.name}</p>
                <p><strong>Taille :</strong> ${formatFileSize(file.size)}</p>
            `;
            
            // Créer un aperçu de l'image
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                previewDiv.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }
    
    // Affichage des informations pour le fichier PDF
    const pdfInput = document.getElementById('fichier_pdf');
    if (pdfInput) {
        pdfInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (!file) return;
            
            // Vérifier le type de fichier
            if (file.type !== 'application/pdf') {
                alert('Seuls les fichiers PDF sont acceptés.');
                this.value = ''; // Réinitialiser l'input
                return;
            }
            
            // Vérifier la taille (max 10 Mo)
            if (file.size > 10 * 1024 * 1024) {
                alert('Le fichier est trop volumineux. La taille maximale est de 10 Mo.');
                this.value = ''; // Réinitialiser l'input
                return;
            }
            
            // Créer ou récupérer la div de prévisualisation
            let previewDiv = this.nextElementSibling.nextElementSibling;
            if (!previewDiv || !previewDiv.classList.contains('file-preview')) {
                previewDiv = document.createElement('div');
                previewDiv.className = 'file-preview';
                this.parentNode.appendChild(previewDiv);
            }
            
            // Afficher les informations du fichier
            previewDiv.innerHTML = `
                <p>Fichier PDF sélectionné :</p>
                <p><strong>Nom :</strong> ${file.name}</p>
                <p><strong>Taille :</strong> ${formatFileSize(file.size)}</p>
                <div class="file-link">
                    <i class="fas fa-file-pdf"></i> ${file.name}
                </div>
            `;
        });
    }
    
    // Validation du formulaire avant soumission
    const journalForm = document.querySelector('form[name="save_journal"]');
    if (journalForm) {
        journalForm.addEventListener('submit', function(e) {
            const numero = document.getElementById('numero').value;
            const datePublication = document.getElementById('date_publication').value;
            
            if (!numero || isNaN(parseInt(numero)) || parseInt(numero) <= 0) {
                alert('Veuillez entrer un numéro de journal valide.');
                e.preventDefault();
                return;
            }
            
            if (!datePublication) {
                alert('Veuillez sélectionner une date de publication.');
                e.preventDefault();
                return;
            }
            
            // Vérification des fichiers pour un nouveau journal
            const journalIdInput = document.querySelector('input[name="journal_id"]');
            if (!journalIdInput) {
                const image = document.getElementById('image').files[0];
                const pdf = document.getElementById('fichier_pdf').files[0];
                
                if (!image) {
                    alert('Veuillez sélectionner une image de couverture.');
                    e.preventDefault();
                    return;
                }
                
                if (!pdf) {
                    alert('Veuillez sélectionner un fichier PDF.');
                    e.preventDefault();
                    return;
                }
            }
        });
    }
});
</script>

<?php include 'footer.php'; ?> 
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

// Fonction d'upload de fichier
function upload_file($file, $target_dir) {
    if (!file_exists($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            return [
                'success' => false,
                'message' => "Impossible de créer le dossier de destination."
            ];
        }
    }
    
    $file_name = basename($file["name"]);
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    $new_file_name = uniqid() . '.' . $file_type;
    $target_file = $target_dir . $new_file_name;
    
    // Vérification du type de fichier selon le dossier
    if (strpos($target_dir, 'images') !== false) {
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($file_type, $allowed_types)) {
            return [
                'success' => false,
                'message' => "Seuls les fichiers JPG, JPEG, PNG, GIF et WEBP sont autorisés pour les images."
            ];
        }
    } elseif (strpos($target_dir, 'uploads') !== false) {
        if ($file_type != 'pdf') {
            return [
                'success' => false,
                'message' => "Seuls les fichiers PDF sont autorisés pour les documents."
            ];
        }
    }
    
    // Vérifier la taille du fichier (50 Mo max)
    if ($file['size'] > 50 * 1024 * 1024) {
        return [
            'success' => false,
            'message' => "Le fichier est trop volumineux. La taille maximale est de 50 Mo."
        ];
    }
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return [
            'success' => true,
            'path' => str_replace('../', '', $target_file)
        ];
    }
    
    // Plus de détails sur l'erreur
    $error_details = [];
    
    // Vérifier si le fichier temporaire existe
    if (!file_exists($file["tmp_name"])) {
        $error_details[] = "Le fichier temporaire n'existe pas: " . $file["tmp_name"];
    }
    
    // Vérifier si le dossier de destination est accessible en écriture
    if (!is_writable(dirname($target_file))) {
        $error_details[] = "Le dossier de destination n'est pas accessible en écriture: " . dirname($target_file);
    }
    
    // Vérifier l'espace disque disponible
    $free_space = disk_free_space(dirname($target_file));
    if ($free_space !== false && $free_space < $file['size']) {
        $error_details[] = "Espace disque insuffisant. Disponible: " . number_format($free_space / 1024 / 1024, 2) . " Mo";
    }
    
    // Récupérer la dernière erreur PHP
    $last_error = error_get_last();
    if ($last_error) {
        $error_details[] = "Erreur PHP: " . $last_error['message'];
    }
    
    $error_message = "Une erreur s'est produite lors du téléchargement.";
    if (!empty($error_details)) {
        $error_message .= " Détails: " . implode('; ', $error_details);
    }
    
    return [
        'success' => false,
        'message' => $error_message
    ];
}

// Liste des pages disponibles pour l'affichage des plaquettes
$pages_disponibles = [
    'index.php' => 'Page d\'accueil',
    'actualite.php' => 'Actualités',
    'abibac.php' => 'Section ABIBAC',
    'azubi-bac-pro.php' => 'AZUBI BAC PRO',
    'bac-general.php' => 'Bac Général',
    'bac-pro-aepa.php' => 'Bac Pro AEPA',
    'bac-pro-agora.php' => 'Bac Pro AGOrA',
    'bac-pro-melec.php' => 'Bac Pro MELEC',
    'bac-pro-metiers-enseigne.php' => 'Bac Pro Métiers de l\'Enseigne',
    'bac-pro-mspc.php' => 'Bac Pro MSPC',
    'bac-pro-trpm.php' => 'Bac Pro TRPM',
    'bac-stmg.php' => 'STMG',
    'bts-assurance.php' => 'BTS Assurance',
    'bts-ccst.php' => 'BTS CCST',
    'bts-comptabilite-gestion.php' => 'BTS Comptabilité-Gestion',
    'bts-cpi.php' => 'BTS CPI',
    'bts-mco.php' => 'BTS MCO',
    'bts-ms.php' => 'BTS MS',
    'bts-tm.php' => 'BTS TM',
    'cafe-des-langues.php' => 'Café des Langues',
    'cap-aaga.php' => 'CAP AAGA',
    'cap-electricien.php' => 'CAP Electricien',
    'cap-epc.php' => 'CAP Équipier Polyvalent du Commerce',
    'cap-metiers-enseigne.php' => 'CAP Métiers de l\'Enseigne',
    'cap-psr.php' => 'CAP PSR',
    'enseignements-pro.php' => 'Enseignements Professionnels',
    'enseignements-sup.php' => 'Enseignements Supérieurs',
    'metiers-accueil.php' => 'Métiers de l\'Accueil',
    'metiers-commerce-vente.php' => 'Métiers du Commerce et de la Vente',
    'orientation-bac.php' => 'Orientation BAC',
    'sti2d.php' => 'STI2D',
    'vie-lyceenne.php' => 'Vie Lycéenne',
    'voix-apprentis.php' => 'La Voix des Apprentis',
    'restaurant-scolaire.php' => 'Restaurant Scolaire',
    'partenariats.php' => 'Partenariats',
    'section-europeenne.php' => 'Section Européenne',
    'etwinning.php' => 'eTwinning',
    'pass-ingenieur.php' => 'Pass Ingénieur',
    'ufa.php' => 'UFA - Apprentissage',
    'internat.php' => 'Internat',
    'cdi.php' => 'CDI',
    'eco-mermoz.php' => 'Éco-Mermoz',
    'mot-proviseur.php' => 'Mot du Proviseur'
];

// Traitement de l'ajout/modification de plaquette
if (isset($_POST['save_plaquette'])) {
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $pages_affichage = $_POST['pages_affichage'] ?? [];
    $couleur_fond = $_POST['couleur_fond'] ?? '#3498db';
    $ordre_affichage = intval($_POST['ordre_affichage'] ?? 0);
    $actif = isset($_POST['actif']) ? 1 : 0;
    $plaquette_id = $_POST['plaquette_id'] ?? '';
    
    $upload_error = false;
    
    // Traitement de l'image de couverture
    $image_path = $_POST['image_path'] ?? '';
    if (isset($_FILES['image_couverture']) && $_FILES['image_couverture']['error'] !== UPLOAD_ERR_NO_FILE) {
        $upload_result = upload_file($_FILES['image_couverture'], "../images/plaquettes/");
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
        $upload_result = upload_file($_FILES['fichier_pdf'], "../uploads/plaquettes/");
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
            // Convertir le tableau des pages en JSON
            $pages_json = json_encode($pages_affichage);
            
            if (!empty($plaquette_id)) {
                // Mise à jour d'une plaquette existante
                $query = "UPDATE plaquettes SET 
                          titre = :titre, 
                          description = :description, 
                          pages_affichage = :pages_affichage,
                          couleur_fond = :couleur_fond,
                          ordre_affichage = :ordre_affichage,
                          actif = :actif";
                
                if (!empty($image_path)) {
                    $query .= ", image_couverture = :image_couverture";
                }
                
                if (!empty($fichier_pdf)) {
                    $query .= ", fichier_pdf = :fichier_pdf";
                }
                
                $query .= " WHERE id = :id";
                
                $stmt = $db->prepare($query);
                $params = [
                    ':titre' => $titre,
                    ':description' => $description,
                    ':pages_affichage' => $pages_json,
                    ':couleur_fond' => $couleur_fond,
                    ':ordre_affichage' => $ordre_affichage,
                    ':actif' => $actif,
                    ':id' => $plaquette_id
                ];
                
                if (!empty($image_path)) {
                    $params[':image_couverture'] = $image_path;
                }
                
                if (!empty($fichier_pdf)) {
                    $params[':fichier_pdf'] = $fichier_pdf;
                }
                
                $stmt->execute($params);
                $success_message = "Plaquette mise à jour avec succès";
            } else {
                // Vérification que les fichiers ont été uploadés pour une nouvelle plaquette
                if (empty($fichier_pdf)) {
                    $error_message = "Vous devez télécharger un fichier PDF";
                } else {
                    // Ajout d'une nouvelle plaquette
                    $stmt = $db->prepare("INSERT INTO plaquettes 
                        (titre, description, fichier_pdf, image_couverture, pages_affichage, couleur_fond, ordre_affichage, actif) 
                        VALUES (:titre, :description, :fichier_pdf, :image_couverture, :pages_affichage, :couleur_fond, :ordre_affichage, :actif)");
                    $stmt->execute([
                        ':titre' => $titre,
                        ':description' => $description,
                        ':fichier_pdf' => $fichier_pdf,
                        ':image_couverture' => $image_path,
                        ':pages_affichage' => $pages_json,
                        ':couleur_fond' => $couleur_fond,
                        ':ordre_affichage' => $ordre_affichage,
                        ':actif' => $actif
                    ]);
                    $success_message = "Plaquette ajoutée avec succès";
                }
            }
        } catch (PDOException $e) {
            $error_message = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
}

// Traitement de la suppression d'une plaquette
if (isset($_GET['delete_plaquette'])) {
    $plaquette_id = $_GET['delete_plaquette'];
    
    try {
        // Récupérer les chemins des fichiers à supprimer
        $stmt = $db->prepare("SELECT image_couverture, fichier_pdf FROM plaquettes WHERE id = :id");
        $stmt->execute([':id' => $plaquette_id]);
        $plaquette = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Supprimer les fichiers
        if ($plaquette) {
            if (!empty($plaquette['image_couverture']) && file_exists("../" . $plaquette['image_couverture'])) {
                unlink("../" . $plaquette['image_couverture']);
            }
            if (file_exists("../" . $plaquette['fichier_pdf'])) {
                unlink("../" . $plaquette['fichier_pdf']);
            }
        }
        
        // Supprimer l'entrée de la base de données
        $stmt = $db->prepare("DELETE FROM plaquettes WHERE id = :id");
        $stmt->execute([':id' => $plaquette_id]);
        $success_message = "Plaquette supprimée avec succès";
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la suppression : " . $e->getMessage();
    }
}

// Si on veut éditer une plaquette existante
$plaquette_to_edit = null;
if (isset($_GET['edit_plaquette'])) {
    $plaquette_id = $_GET['edit_plaquette'];
    
    try {
        $stmt = $db->prepare("SELECT * FROM plaquettes WHERE id = :id");
        $stmt->execute([':id' => $plaquette_id]);
        $plaquette_to_edit = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$plaquette_to_edit) {
            $error_message = "Plaquette introuvable";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la récupération de la plaquette : " . $e->getMessage();
    }
}

// Récupération de toutes les plaquettes
try {
    $stmt = $db->query("SELECT * FROM plaquettes ORDER BY ordre_affichage ASC, date_creation DESC");
    $plaquettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Erreur lors de la récupération des plaquettes : " . $e->getMessage();
    $plaquettes = [];
}

// Inclure le header
include 'header.php';
?>

<h1>Gestion des plaquettes téléchargeables</h1>

<?php if (isset($success_message)): ?>
    <div class="alert alert-success"><?= $success_message ?></div>
<?php endif; ?>

<?php if (isset($error_message)): ?>
    <div class="alert alert-danger"><?= $error_message ?></div>
<?php endif; ?>

<h2><?= $plaquette_to_edit ? 'Modifier la plaquette' : 'Ajouter une nouvelle plaquette' ?></h2>
<form method="post" action="" enctype="multipart/form-data" name="save_plaquette" class="upload-form">
    <?php if ($plaquette_to_edit): ?>
        <input type="hidden" name="plaquette_id" value="<?= $plaquette_to_edit['id'] ?>">
        <input type="hidden" name="image_path" value="<?= $plaquette_to_edit['image_couverture'] ?>">
        <input type="hidden" name="fichier_pdf" value="<?= $plaquette_to_edit['fichier_pdf'] ?>">
    <?php endif; ?>
    
    <div class="form-group">
        <label for="titre">Titre de la plaquette *</label>
        <input type="text" id="titre" name="titre" value="<?= $plaquette_to_edit['titre'] ?? '' ?>" required>
    </div>
    
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Description courte de la plaquette"><?= $plaquette_to_edit['description'] ?? '' ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="couleur_fond">Couleur de fond</label>
        <input type="color" id="couleur_fond" name="couleur_fond" value="<?= $plaquette_to_edit['couleur_fond'] ?? '#3498db' ?>">
        <small class="form-help">Couleur d'arrière-plan de la plaquette</small>
    </div>
    
    <div class="form-group">
        <label for="ordre_affichage">Ordre d'affichage</label>
        <input type="number" id="ordre_affichage" name="ordre_affichage" value="<?= $plaquette_to_edit['ordre_affichage'] ?? 0 ?>" min="0">
        <small class="form-help">Les plaquettes avec un ordre plus petit s'affichent en premier</small>
    </div>
    
    <div class="form-group">
        <label>Pages d'affichage *</label>
        <div class="checkbox-group">
            <?php 
            $pages_selected = [];
            if ($plaquette_to_edit && !empty($plaquette_to_edit['pages_affichage'])) {
                $pages_selected = json_decode($plaquette_to_edit['pages_affichage'], true) ?? [];
            }
            ?>
            <?php foreach ($pages_disponibles as $page => $label): ?>
                <label class="checkbox-item">
                    <input type="checkbox" name="pages_affichage[]" value="<?= $page ?>" 
                           <?= in_array($page, $pages_selected) ? 'checked' : '' ?>>
                    <?= $label ?>
                </label>
            <?php endforeach; ?>
        </div>
        <small class="form-help">Sélectionnez les pages où cette plaquette doit apparaître</small>
    </div>
    
    <div class="form-group checkbox-group">
        <input type="checkbox" id="actif" name="actif" <?= (isset($plaquette_to_edit) && $plaquette_to_edit['actif']) || !isset($plaquette_to_edit) ? 'checked' : '' ?>>
        <label for="actif">Plaquette active</label>
    </div>
    
    <div class="form-group">
        <label for="image_couverture">Image de couverture</label>
        <input type="file" id="image_couverture" name="image_couverture" accept="image/jpeg,image/png,image/gif,image/webp">
        <div class="form-help">
            <small>Formats acceptés: JPG, PNG, GIF, WEBP. Taille max: 50 Mo. Dimension recommandée: 400x300px</small>
        </div>
        <?php if (isset($plaquette_to_edit) && !empty($plaquette_to_edit['image_couverture'])): ?>
            <div class="file-preview">
                <p>Image actuelle :</p>
                <img src="../<?= $plaquette_to_edit['image_couverture'] ?>" alt="Couverture de la plaquette">
            </div>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="fichier_pdf">Fichier PDF *</label>
        <input type="file" id="fichier_pdf" name="fichier_pdf" accept="application/pdf" <?= $plaquette_to_edit ? '' : 'required' ?>>
        <div class="form-help">
            <small>Format accepté: PDF uniquement. Taille max: 50 Mo.</small>
        </div>
        <?php if (isset($plaquette_to_edit) && !empty($plaquette_to_edit['fichier_pdf'])): ?>
            <div class="file-preview">
                <p>Fichier actuel :</p>
                <a href="../<?= $plaquette_to_edit['fichier_pdf'] ?>" class="file-link" target="_blank">
                    <i class="fas fa-file-pdf"></i> <?= basename($plaquette_to_edit['fichier_pdf']) ?>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <button type="submit" name="save_plaquette" class="btn btn-primary"><?= $plaquette_to_edit ? 'Mettre à jour' : 'Ajouter' ?></button>
    <?php if ($plaquette_to_edit): ?>
        <a href="plaquettes-admin.php" class="btn btn-secondary">Annuler</a>
    <?php endif; ?>
</form>

<h2 style="margin-top: 2rem;">Liste des plaquettes</h2>

<?php if (empty($plaquettes)): ?>
    <p>Aucune plaquette trouvée.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Pages</th>
                <th>Couleur</th>
                <th>Ordre</th>
                <th>Image</th>
                <th>PDF</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($plaquettes as $plaquette): ?>
                <?php 
                $pages_display = [];
                if (!empty($plaquette['pages_affichage'])) {
                    $pages_array = json_decode($plaquette['pages_affichage'], true);
                    if ($pages_array) {
                        foreach ($pages_array as $page) {
                            $pages_display[] = $pages_disponibles[$page] ?? $page;
                        }
                    }
                }
                ?>
                <tr>
                    <td><?= $plaquette['id'] ?></td>
                    <td class="truncate"><?= htmlspecialchars($plaquette['titre']) ?></td>
                    <td class="truncate"><?= htmlspecialchars($plaquette['description'] ?? '') ?></td>
                    <td class="truncate" title="<?= implode(', ', $pages_display) ?>">
                        <?= count($pages_display) ?> page(s)
                    </td>
                    <td>
                        <div class="color-preview" style="background-color: <?= $plaquette['couleur_fond'] ?>; width: 30px; height: 20px; border-radius: 3px; border: 1px solid #ddd;"></div>
                    </td>
                    <td><?= $plaquette['ordre_affichage'] ?></td>
                    <td>
                        <?php if (!empty($plaquette['image_couverture'])): ?>
                            <a href="../<?= $plaquette['image_couverture'] ?>" target="_blank">
                                <img src="../<?= $plaquette['image_couverture'] ?>" alt="Couverture" style="max-width: 50px; max-height: 50px;">
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Aucune</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="../<?= $plaquette['fichier_pdf'] ?>" target="_blank" class="file-link">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </td>
                    <td><?= $plaquette['actif'] ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' ?></td>
                    <td class="actions">
                        <a href="?edit_plaquette=<?= $plaquette['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="?delete_plaquette=<?= $plaquette['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette plaquette ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<style>
    .checkbox-group .checkbox-item {
        display: block;
        margin: 0.5rem 0;
        padding: 0.25rem;
        cursor: pointer;
    }
    
    .checkbox-group .checkbox-item input[type="checkbox"] {
        width: auto;
        margin-right: 0.5rem;
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
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .color-preview {
        display: inline-block;
    }
    
    .text-muted {
        color: #6c757d;
        font-style: italic;
    }
    
    @media (max-width: 768px) {
        .actions {
            flex-direction: column;
        }
        
        .truncate {
            max-width: 100px;
        }
    }
</style>

<?php include 'footer.php'; ?> 
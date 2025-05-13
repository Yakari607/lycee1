<?php
// Démarrer la session
session_start();

// Vérification simple d'authentification
if (!isset($_SESSION['admin_logged_in']) && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Vérification simple des identifiants (à améliorer en production)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $login_error = "Identifiants incorrects";
    }
}

// Vérifier si l'utilisateur est connecté
$is_logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Si l'utilisateur clique sur déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: voix-apprentis-admin.php');
    exit;
}

// Si l'utilisateur est connecté, on peut traiter les formulaires
if ($is_logged_in) {
    // Connexion à la base de données
    require_once '../includes/db_connect.php';
    
    // Traitement de l'upload de fichier
    function upload_file($file, $target_dir) {
        // Vérifier si le dossier existe, sinon le créer
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        
        // Extraire le nom de fichier et l'extension
        $file_name = basename($file["name"]);
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Générer un nom de fichier unique pour éviter les collisions
        $new_file_name = uniqid() . '.' . $file_type;
        $target_file = $target_dir . $new_file_name;
        
        // Vérifier si le fichier est bien un fichier image ou PDF selon le dossier cible
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
        
        // Vérifier la taille du fichier (10 Mo max)
        if ($file['size'] > 10 * 1024 * 1024) {
            return [
                'success' => false,
                'message' => "Le fichier est trop volumineux. La taille maximale est de 10 Mo."
            ];
        }
        
        // Déplacer le fichier téléchargé
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return [
                'success' => true,
                'path' => str_replace('../', '', $target_file)
            ];
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
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de La Voix des Apprentis - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-color: #1a73e8;
            --hover-color: #0d47a1;
            --danger-color: #dc3545;
            --success-color: #28a745;
            --warning-color: #ffc107;
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
        
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: var(--shadow);
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
        input[type="password"],
        input[type="date"],
        input[type="number"],
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
        
        .btn-edit {
            background: var(--warning-color);
            color: #212529;
        }
        
        .btn-edit:hover {
            background: #e0a800;
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
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }
        
        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        .table th {
            background-color: var(--gray-light);
            font-weight: 600;
        }
        
        .table tr:hover {
            background-color: #f5f5f5;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .file-preview {
            margin-top: 10px;
        }
        
        .file-preview img {
            max-width: 200px;
            max-height: 200px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 3px;
            background-color: white;
        }
        
        .file-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            text-decoration: none;
            margin-top: 5px;
        }
        
        .file-link:hover {
            text-decoration: underline;
        }

        .actions {
            display: flex;
            gap: 10px;
        }
        
        .admin-actions {
            display: flex;
            gap: 15px;
            margin-bottom: 1rem;
        }
        
        .truncate {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .back-link {
            margin-top: 2rem;
            display: inline-block;
        }
        
        @media (max-width: 768px) {
            .table {
                display: block;
                overflow-x: auto;
            }
            
            .header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }
        
        .form-help {
            color: #6c757d;
            margin-top: 5px;
        }
        
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        
        .file-input-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
        
        .file-input-wrapper .btn {
            display: inline-block;
            padding: 8px 12px;
            margin-right: 5px;
        }
        
        .file-preview {
            margin-top: 15px;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            background-color: var(--gray-light);
        }
        
        .file-preview img {
            max-width: 300px;
            max-height: 200px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 3px;
            background-color: white;
            display: block;
            margin-top: 10px;
        }
        
        .progress-bar {
            height: 20px;
            background-color: #e9ecef;
            border-radius: 4px;
            margin-top: 10px;
            overflow: hidden;
        }
        
        .progress-bar .progress {
            height: 100%;
            background-color: var(--primary-color);
            width: 0%;
            transition: width 0.3s ease;
        }
        
        .alert ul {
            margin: 5px 0 5px 20px;
        }
    </style>
</head>
<body>
    <?php if (!$is_logged_in): ?>
        <div class="login-container">
            <h2>Connexion à l'administration</h2>
            
            <?php if (isset($login_error)): ?>
                <div class="alert alert-danger"><?= $login_error ?></div>
            <?php endif; ?>
            
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="login">Se connecter</button>
            </form>
        </div>
    <?php else: ?>
        <div class="container">
            <div class="header">
                <h1>Gestion de La Voix des Apprentis</h1>
                <div class="admin-actions">
                    <a href="menu-admin.php" class="btn">Gestion des menus</a>
                    <a href="actualites-admin.php" class="btn">Gestion des actualités</a>
                    <a href="?logout=1" class="btn btn-danger">Déconnexion</a>
                </div>
            </div>
            
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?= $success_message ?></div>
            <?php endif; ?>
            
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?= $error_message ?></div>
            <?php endif; ?>
            
            <h2><?= $journal_to_edit ? 'Modifier le journal' : 'Ajouter un nouveau journal' ?></h2>
            <form method="post" action="" enctype="multipart/form-data" name="save_journal">
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
        
                
                <button type="submit" name="save_journal"><?= $journal_to_edit ? 'Mettre à jour' : 'Ajouter' ?></button>
                <?php if ($journal_to_edit): ?>
                    <a href="voix-apprentis-admin.php" class="btn">Annuler</a>
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
                                    <a href="?edit_journal=<?= $journal['id'] ?>" class="btn btn-edit">Modifier</a>
                                    <a href="?delete_journal=<?= $journal['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce journal ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            
            <a href="../voix-apprentis.php" class="back-link">Retour à La Voix des Apprentis</a>
        </div>
    <?php endif; ?>
    
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
        
        // Confirmation de suppression
        const deleteLinks = document.querySelectorAll('a[href*="delete_journal"]');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer ce journal ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            });
        });
        
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
</body>
</html> 
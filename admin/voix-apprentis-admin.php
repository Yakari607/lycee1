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
        
        $target_file = $target_dir . basename($file["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Générer un nom de fichier unique
        $file_name = uniqid() . "." . $file_type;
        $target_file = $target_dir . $file_name;
        
        // Déplacer le fichier téléchargé
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        }
        
        return false;
    }
    
    // Traitement de l'ajout d'un journal
    if (isset($_POST['save_journal'])) {
        $numero = $_POST['numero'] ?? '';
        $date_publication = $_POST['date_publication'] ?? '';
        $theme = $_POST['theme'] ?? '';
        $description = $_POST['description'] ?? '';
        $is_supplement = isset($_POST['is_supplement']) ? 1 : 0;
        $journal_id = $_POST['journal_id'] ?? '';
        
        // Traitement de l'image
        $image_path = $_POST['image_path'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_result = upload_file($_FILES['image'], "../images/voix-apprentis/");
            if ($upload_result !== false) {
                $image_path = $upload_result;
            }
        }
        
        // Traitement du fichier PDF
        $fichier_pdf = $_POST['fichier_pdf'] ?? '';
        if (isset($_FILES['fichier_pdf']) && $_FILES['fichier_pdf']['error'] === UPLOAD_ERR_OK) {
            $upload_result = upload_file($_FILES['fichier_pdf'], "../uploads/voix-apprentis/");
            if ($upload_result !== false) {
                $fichier_pdf = $upload_result;
            }
        }
        
        try {
            if (!empty($journal_id)) {
                // Mise à jour d'un journal existant
                $stmt = $db->prepare("UPDATE voix_apprentis_journaux SET numero = :numero, date_publication = :date_publication, theme = :theme, description = :description, is_supplement = :is_supplement" . 
                    (!empty($image_path) ? ", image = :image" : "") . 
                    (!empty($fichier_pdf) ? ", fichier_pdf = :fichier_pdf" : "") . 
                    " WHERE id = :id");
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
                // Vérification que les fichiers ont été uploadés
                if (empty($image_path) || empty($fichier_pdf)) {
                    $error_message = "Vous devez télécharger une image et un fichier PDF";
                } else {
                    // Ajout d'un nouveau journal
                    $stmt = $db->prepare("INSERT INTO voix_apprentis_journaux (numero, date_publication, theme, description, image, fichier_pdf, is_supplement) 
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
            <form method="post" action="" enctype="multipart/form-data">
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
                    <input type="file" id="image" name="image" accept="image/*" <?= $journal_to_edit ? '' : 'required' ?>>
                    <?php if (isset($journal_to_edit) && !empty($journal_to_edit['image'])): ?>
                        <div class="file-preview">
                            <p>Image actuelle :</p>
                            <img src="../<?= $journal_to_edit['image'] ?>" alt="Couverture du journal">
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label for="fichier_pdf">Fichier PDF</label>
                    <input type="file" id="fichier_pdf" name="fichier_pdf" accept=".pdf" <?= $journal_to_edit ? '' : 'required' ?>>
                    <?php if (isset($journal_to_edit) && !empty($journal_to_edit['fichier_pdf'])): ?>
                        <div class="file-preview">
                            <p>Fichier actuel :</p>
                            <a href="../<?= $journal_to_edit['fichier_pdf'] ?>" class="file-link" target="_blank">
                                <i class="fas fa-file-pdf"></i> <?= basename($journal_to_edit['fichier_pdf']) ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="is_supplement" name="is_supplement" <?= isset($journal_to_edit['is_supplement']) && $journal_to_edit['is_supplement'] ? 'checked' : '' ?>>
                        <label for="is_supplement">Est un supplément</label>
                    </div>
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
</body>
</html> 
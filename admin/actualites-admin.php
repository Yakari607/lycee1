<?php
// Démarrer la session
session_start();

// Vérification simple d'authentification (à améliorer en production)
// Si la session n'est pas définie et qu'on tente de se connecter
if (!isset($_SESSION['admin_logged_in']) && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Vérification simple des identifiants
    // Dans un environnement de production, utilisez une méthode plus sécurisée
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
    header('Location: actualites-admin.php');
    exit;
}

// Si l'utilisateur est connecté, on peut traiter les formulaires
if ($is_logged_in) {
    // Connexion à la base de données
    require_once '../includes/db_connect.php';
    
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
            $stmt = $db->prepare("DELETE FROM actualites WHERE id = :id");
            $stmt->execute([':id' => $actualite_id]);
            $success_message = "Actualité supprimée avec succès";
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
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des actualités - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
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
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
        }
        
        textarea {
            min-height: 150px;
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
            background: #ffc107;
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
        
        .back-link {
            margin-top: 2rem;
            display: inline-block;
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
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
                <h1>Gestion des actualités</h1>
                <div class="admin-actions">
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
            
            <h2><?= $actualite_to_edit ? 'Modifier l\'actualité' : 'Ajouter une nouvelle actualité' ?></h2>
            <form method="post" action="">
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
                
                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="is_important" name="is_important" <?= isset($actualite_to_edit['is_important']) && $actualite_to_edit['is_important'] ? 'checked' : '' ?>>
                        <label for="is_important">Actualité importante (mise en avant)</label>
                    </div>
                </div>
                
                <button type="submit" name="save_actualite"><?= $actualite_to_edit ? 'Mettre à jour' : 'Ajouter' ?></button>
                <?php if ($actualite_to_edit): ?>
                    <a href="actualites-admin.php" class="btn">Annuler</a>
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
                                    <a href="?edit_actualite=<?= $actualite['id'] ?>" class="btn btn-edit">Modifier</a>
                                    <a href="?delete_actualite=<?= $actualite['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            
            <a href="../index.php" class="back-link">Retour au site</a>
        </div>
    <?php endif; ?>
</body>
</html> 
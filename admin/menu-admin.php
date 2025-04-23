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
    header('Location: menu-admin.php');
    exit;
}

// Si l'utilisateur est connecté, on peut traiter les formulaires
if ($is_logged_in) {
    // Connexion à la base de données
    require_once '../includes/db_connect.php';
    
    // Traitement de l'ajout/modification de repas
    if (isset($_POST['save_meal'])) {
        $jour_id = $_POST['jour_id'] ?? '';
        $categorie_id = $_POST['categorie_id'] ?? '';
        $nom = $_POST['nom'] ?? '';
        $bio = isset($_POST['bio']) ? 1 : 0;
        $local = isset($_POST['local']) ? 1 : 0;
        $vegetarien = isset($_POST['vegetarien']) ? 1 : 0;
        $meal_id = $_POST['meal_id'] ?? '';
        
        try {
            if (!empty($meal_id)) {
                // Mise à jour d'un repas existant
                $stmt = $db->prepare("UPDATE repas SET jour_id = :jour_id, categorie_id = :categorie_id, nom = :nom, bio = :bio, local = :local, vegetarien = :vegetarien WHERE id = :id");
                $stmt->execute([
                    ':jour_id' => $jour_id,
                    ':categorie_id' => $categorie_id,
                    ':nom' => $nom,
                    ':bio' => $bio,
                    ':local' => $local,
                    ':vegetarien' => $vegetarien,
                    ':id' => $meal_id
                ]);
                $success_message = "Repas mis à jour avec succès";
            } else {
                // Ajout d'un nouveau repas
                $stmt = $db->prepare("INSERT INTO repas (jour_id, categorie_id, nom, bio, local, vegetarien) VALUES (:jour_id, :categorie_id, :nom, :bio, :local, :vegetarien)");
                $stmt->execute([
                    ':jour_id' => $jour_id,
                    ':categorie_id' => $categorie_id,
                    ':nom' => $nom,
                    ':bio' => $bio,
                    ':local' => $local,
                    ':vegetarien' => $vegetarien
                ]);
                $success_message = "Repas ajouté avec succès";
            }
        } catch (PDOException $e) {
            $error_message = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
    
    // Traitement de la suppression d'un repas
    if (isset($_GET['delete_meal'])) {
        $meal_id = $_GET['delete_meal'];
        
        try {
            $stmt = $db->prepare("DELETE FROM repas WHERE id = :id");
            $stmt->execute([':id' => $meal_id]);
            $success_message = "Repas supprimé avec succès";
        } catch (PDOException $e) {
            $error_message = "Erreur lors de la suppression : " . $e->getMessage();
        }
    }
    
    // Récupération des jours de la semaine
    $stmt_jours = $db->query("SELECT id, jour, date_semaine FROM jours ORDER BY id");
    $jours = $stmt_jours->fetchAll(PDO::FETCH_ASSOC);
    
    // Récupération des catégories
    $stmt_categories = $db->query("SELECT id, nom FROM categories ORDER BY id");
    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);
    
    // Mise à jour de la date de la semaine
    if (isset($_POST['update_date'])) {
        $date_semaine = $_POST['date_semaine'] ?? '';
        
        try {
            $stmt = $db->prepare("UPDATE jours SET date_semaine = :date_semaine");
            $stmt->execute([':date_semaine' => $date_semaine]);
            $success_message = "Date de semaine mise à jour avec succès";
        } catch (PDOException $e) {
            $error_message = "Erreur lors de la mise à jour de la date : " . $e->getMessage();
        }
    }
    
    // Récupération de tous les repas
    if (isset($_GET['filter_jour']) && $_GET['filter_jour'] > 0) {
        $jour_filter = $_GET['filter_jour'];
        $stmt_repas = $db->prepare("
            SELECT r.*, j.jour, c.nom as categorie_nom 
            FROM repas r
            JOIN jours j ON r.jour_id = j.id
            JOIN categories c ON r.categorie_id = c.id
            WHERE r.jour_id = :jour_id
            ORDER BY r.jour_id, r.categorie_id
        ");
        $stmt_repas->execute([':jour_id' => $jour_filter]);
    } else {
        $stmt_repas = $db->query("
            SELECT r.*, j.jour, c.nom as categorie_nom 
            FROM repas r
            JOIN jours j ON r.jour_id = j.id
            JOIN categories c ON r.categorie_id = c.id
            ORDER BY r.jour_id, r.categorie_id
        ");
    }
    $repas = $stmt_repas->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des menus - Administration</title>
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
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
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
            gap: 15px;
        }
        
        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: normal;
            cursor: pointer;
        }
        
        .tab-container {
            margin-bottom: 2rem;
        }
        
        .tab-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 1.5rem;
        }
        
        .tab-button {
            background: #e9ecef;
            color: #495057;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .tab-button.active {
            background: var(--primary-color);
            color: white;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .filter-container {
            margin-bottom: 1.5rem;
            padding: 15px;
            background-color: var(--gray-light);
            border-radius: 4px;
        }
        
        .filter-form {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .filter-form select {
            width: auto;
        }
        
        .back-link {
            margin-top: 2rem;
            display: inline-block;
        }
        
        @media (max-width: 768px) {
            .filter-form {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .checkbox-group {
                flex-direction: column;
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
                <h1>Gestion des menus du restaurant scolaire</h1>
                <a href="?logout=1" class="btn btn-danger">Déconnexion</a>
            </div>
            
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?= $success_message ?></div>
            <?php endif; ?>
            
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?= $error_message ?></div>
            <?php endif; ?>
            
            <div class="tab-container">
                <div class="tab-buttons">
                    <button class="tab-button active" data-tab="repas">Gestion des repas</button>
                    <button class="tab-button" data-tab="date">Date de la semaine</button>
                </div>
                
                <div class="tab-content active" id="tab-repas">
                    <h2>Ajouter un nouveau repas</h2>
                    <form method="post" action="">
                        <input type="hidden" name="meal_id" value="">
                        <div class="form-group">
                            <label for="jour_id">Jour</label>
                            <select name="jour_id" id="jour_id" required>
                                <?php foreach ($jours as $jour): ?>
                                    <option value="<?= $jour['id'] ?>"><?= ucfirst($jour['jour']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categorie_id">Catégorie</label>
                            <select name="categorie_id" id="categorie_id" required>
                                <?php foreach ($categories as $categorie): ?>
                                    <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom du plat</label>
                            <input type="text" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label>Options</label>
                            <div class="checkbox-group">
                                <label>
                                    <input type="checkbox" name="bio"> Bio
                                </label>
                                <label>
                                    <input type="checkbox" name="local"> Local
                                </label>
                                <label>
                                    <input type="checkbox" name="vegetarien"> Végétarien
                                </label>
                            </div>
                        </div>
                        <button type="submit" name="save_meal">Enregistrer</button>
                    </form>
                    
                    <h2 style="margin-top: 2rem;">Liste des repas</h2>
                    
                    <div class="filter-container">
                        <form method="get" class="filter-form">
                            <label for="filter_jour">Filtrer par jour :</label>
                            <select name="filter_jour" id="filter_jour">
                                <option value="0">Tous les jours</option>
                                <?php foreach ($jours as $jour): ?>
                                    <option value="<?= $jour['id'] ?>" <?= (isset($_GET['filter_jour']) && $_GET['filter_jour'] == $jour['id']) ? 'selected' : '' ?>>
                                        <?= ucfirst($jour['jour']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit">Filtrer</button>
                        </form>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Jour</th>
                                <th>Catégorie</th>
                                <th>Nom</th>
                                <th>Bio</th>
                                <th>Local</th>
                                <th>Végétarien</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($repas)): ?>
                                <tr>
                                    <td colspan="8" style="text-align: center;">Aucun repas trouvé</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($repas as $plat): ?>
                                    <tr>
                                        <td><?= $plat['id'] ?></td>
                                        <td><?= ucfirst($plat['jour']) ?></td>
                                        <td><?= $plat['categorie_nom'] ?></td>
                                        <td><?= $plat['nom'] ?></td>
                                        <td><?= $plat['bio'] ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' ?></td>
                                        <td><?= $plat['local'] ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' ?></td>
                                        <td><?= $plat['vegetarien'] ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' ?></td>
                                        <td>
                                            <a href="?delete_meal=<?= $plat['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce repas ?');">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="tab-content" id="tab-date">
                    <h2>Modifier la date de la semaine</h2>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="date_semaine">Date de la semaine (ex: 15 au 19 juillet 2024)</label>
                            <input type="text" id="date_semaine" name="date_semaine" value="<?= $jours[0]['date_semaine'] ?? '' ?>" required>
                        </div>
                        <button type="submit" name="update_date">Mettre à jour</button>
                    </form>
                </div>
            </div>
            
            <a href="../restaurant-scolaire.php" class="back-link">Retour au site</a>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gestion des onglets
                const tabButtons = document.querySelectorAll('.tab-button');
                const tabContents = document.querySelectorAll('.tab-content');
                
                tabButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        // Retirer la classe active de tous les boutons
                        tabButtons.forEach(btn => btn.classList.remove('active'));
                        // Ajouter la classe active au bouton cliqué
                        button.classList.add('active');
                        
                        // Masquer tous les contenus
                        tabContents.forEach(content => content.classList.remove('active'));
                        
                        // Afficher le contenu correspondant
                        const tabId = button.getAttribute('data-tab');
                        document.getElementById(`tab-${tabId}`).classList.add('active');
                    });
                });
            });
        </script>
    <?php endif; ?>
</body>
</html> 
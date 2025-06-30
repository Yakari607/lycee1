<?php
// Démarrer la session
session_start();

// Inclure les fonctions et la connexion à la base de données
require_once '../includes/functions.php';
require_once '../includes/db_connect.php';

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header('Location: actualites-admin.php');
    exit;
}

// Gestion de la soumission du formulaire
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    try {
        // Recherche de l'utilisateur dans la base de données
        $stmt = $db->prepare("SELECT id, username, password_hash, role, active FROM admin_users WHERE username = :username AND active = 1");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Vérification du mot de passe
        if ($user && password_verify($password, $user['password_hash'])) {
        // Connexion réussie
        $_SESSION['admin'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['admin_role'] = $user['role'];
            
            // Mise à jour de la date de dernière connexion
            $stmt = $db->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = :id");
            $stmt->execute([':id' => $user['id']]);
        
        // Redirection vers la page d'administration principale
        header('Location: actualites-admin.php');
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect";
        }
    } catch (PDOException $e) {
        $error = "Erreur de connexion à la base de données";
        error_log("Erreur login: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion administration - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .login-container {
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 30px;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        .btn {
            background: #1a73e8;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
        }
        
        .btn:hover {
            background: #0d47a1;
        }
        
        .alert {
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #1a73e8;
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo img {
            height: 60px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="../images/logos/LOGO-UFA-MERMOZ-1.jpg" alt="Logo Lycée Jean-Mermoz">
        </div>
        
        <h1>Connexion Administration</h1>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
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
            
            <button type="submit" class="btn">Se connecter</button>
        </form>
        
        <a href="../index.php" class="back-link">Retour au site</a>
    </div>
</body>
</html> 
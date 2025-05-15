<?php
// Page web pour exécuter la migration des fichiers vers la base de données
session_start();

// Fonction pour réparer les duplications de numéros
function fixDuplicateNumbers() {
    ob_start(); // Capturer la sortie
    
    // Connexion à la base de données
    require_once 'includes/db_connect.php';
    
    try {
        echo "<p>Recherche des numéros de journaux dupliqués...</p>";
        
        // Trouver les numéros dupliqués
        $query = "SELECT numero, is_supplement, COUNT(*) as count 
                  FROM voix_apprentis_journaux 
                  GROUP BY numero, is_supplement 
                  HAVING COUNT(*) > 1";
        $stmt = $db->query($query);
        $duplicates = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($duplicates) > 0) {
            echo "<p>Numéros dupliqués trouvés :</p>";
            echo "<ul>";
            
            foreach ($duplicates as $duplicate) {
                echo "<li>Numéro {$duplicate['numero']} " . 
                     ($duplicate['is_supplement'] ? "(supplément)" : "") . 
                     " - {$duplicate['count']} occurrences</li>";
                
                // Récupérer tous les journaux avec ce numéro
                $journals_query = "SELECT id, date_publication 
                                   FROM voix_apprentis_journaux 
                                   WHERE numero = :numero 
                                   AND is_supplement = :is_supplement 
                                   ORDER BY date_publication ASC";
                $journals_stmt = $db->prepare($journals_query);
                $journals_stmt->execute([
                    ':numero' => $duplicate['numero'],
                    ':is_supplement' => $duplicate['is_supplement']
                ]);
                $journals = $journals_stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Garder le premier journal avec ce numéro, réaffecter les autres
                $first = true;
                foreach ($journals as $journal) {
                    if ($first) {
                        echo "<li class='success'>- Journal ID {$journal['id']} (date: {$journal['date_publication']}) conserve le numéro {$duplicate['numero']}</li>";
                        $first = false;
                    } else {
                        // Trouver le nouveau numéro (le plus grand numéro existant + 1)
                        $max_query = "SELECT MAX(numero) as max_numero FROM voix_apprentis_journaux";
                        $max_stmt = $db->query($max_query);
                        $max_result = $max_stmt->fetch(PDO::FETCH_ASSOC);
                        $new_numero = intval($max_result['max_numero']) + 1;
                        
                        // Mettre à jour le journal avec un nouveau numéro
                        $update_query = "UPDATE voix_apprentis_journaux SET numero = :new_numero WHERE id = :id";
                        $update_stmt = $db->prepare($update_query);
                        $update_stmt->execute([
                            ':new_numero' => $new_numero,
                            ':id' => $journal['id']
                        ]);
                        
                        echo "<li class='warning'>- Journal ID {$journal['id']} (date: {$journal['date_publication']}) a été réaffecté au numéro {$new_numero}</li>";
                    }
                }
            }
            
            echo "</ul>";
            echo "<p class='success'>Correction des numéros dupliqués terminée.</p>";
        } else {
            echo "<p class='success'>Aucun numéro dupliqué trouvé. La base de données est propre.</p>";
        }
    } catch (PDOException $e) {
        echo "<p class='error'>Erreur lors de la réparation des numéros dupliqués : " . $e->getMessage() . "</p>";
    }
    
    return ob_get_clean(); // Récupérer et renvoyer la sortie
}

// Fonction pour débuter la migration
function startMigration() {
    ob_start(); // Capturer la sortie
    
    // Connexion à la base de données
    require_once 'includes/db_connect.php';
    
    try {
        // 1. Ajouter les nouvelles colonnes à la table si elles n'existent pas
        echo "<p>Vérification des colonnes dans la table...</p>";
        
        // Vérifier si la colonne image_data existe déjà
        $columnsCheck = $db->query("SHOW COLUMNS FROM voix_apprentis_journaux LIKE 'image_data'");
        if ($columnsCheck->rowCount() == 0) {
            echo "<p>Ajout des nouvelles colonnes...</p>";
            
            $db->exec("ALTER TABLE voix_apprentis_journaux 
                      ADD COLUMN image_data MEDIUMBLOB,
                      ADD COLUMN image_type VARCHAR(100),
                      ADD COLUMN pdf_data MEDIUMBLOB");
            
            echo "<p>Colonnes ajoutées avec succès.</p>";
        } else {
            echo "<p>Les colonnes existent déjà.</p>";
        }
        
        // 2. Migrer les données existantes
        echo "<p>Migration des fichiers existants vers la base de données...</p>";
        
        $stmt = $db->query("SELECT id, image, fichier_pdf FROM voix_apprentis_journaux");
        $journals = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($journals) > 0) {
            echo "<ul>";
            foreach ($journals as $journal) {
                echo "<li>Traitement du journal ID {$journal['id']}...</li>";
                
                // Traitement de l'image
                if (!empty($journal['image'])) {
                    $imagePath = $journal['image'];
                    
                    // Vérifier si le chemin est relatif ou absolu
                    if (strpos($imagePath, '/') !== 0 && strpos($imagePath, ':') !== 1) {
                        // Chemin relatif, on ajoute le chemin absolu
                        $fullImagePath = __DIR__ . '/' . $imagePath;
                    } else {
                        // Chemin absolu
                        $fullImagePath = $imagePath;
                    }
                    
                    if (file_exists($fullImagePath)) {
                        $imageData = file_get_contents($fullImagePath);
                        $imageType = getImageMimeType($fullImagePath);
                        
                        if ($imageData !== false) {
                            $updateStmt = $db->prepare("UPDATE voix_apprentis_journaux 
                                                      SET image_data = :image_data, 
                                                          image_type = :image_type 
                                                      WHERE id = :id");
                            $updateStmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);
                            $updateStmt->bindParam(':image_type', $imageType);
                            $updateStmt->bindParam(':id', $journal['id']);
                            
                            if ($updateStmt->execute()) {
                                echo "<li class='success'>- Image migrée avec succès.</li>";
                            } else {
                                echo "<li class='error'>- Erreur lors de la migration de l'image.</li>";
                            }
                        } else {
                            echo "<li class='error'>- Impossible de lire le fichier image: $fullImagePath</li>";
                        }
                    } else {
                        echo "<li class='error'>- Fichier image introuvable: $fullImagePath</li>";
                    }
                } else {
                    echo "<li class='warning'>- Pas de chemin d'image pour ce journal.</li>";
                }
                
                // Traitement du PDF
                if (!empty($journal['fichier_pdf'])) {
                    $pdfPath = $journal['fichier_pdf'];
                    
                    // Vérifier si le chemin est relatif ou absolu
                    if (strpos($pdfPath, '/') !== 0 && strpos($pdfPath, ':') !== 1) {
                        // Chemin relatif, on ajoute le chemin absolu
                        $fullPdfPath = __DIR__ . '/' . $pdfPath;
                    } else {
                        // Chemin absolu
                        $fullPdfPath = $pdfPath;
                    }
                    
                    if (file_exists($fullPdfPath)) {
                        $pdfData = file_get_contents($fullPdfPath);
                        
                        if ($pdfData !== false) {
                            $updateStmt = $db->prepare("UPDATE voix_apprentis_journaux 
                                                      SET pdf_data = :pdf_data 
                                                      WHERE id = :id");
                            $updateStmt->bindParam(':pdf_data', $pdfData, PDO::PARAM_LOB);
                            $updateStmt->bindParam(':id', $journal['id']);
                            
                            if ($updateStmt->execute()) {
                                echo "<li class='success'>- PDF migré avec succès.</li>";
                            } else {
                                echo "<li class='error'>- Erreur lors de la migration du PDF.</li>";
                            }
                        } else {
                            echo "<li class='error'>- Impossible de lire le fichier PDF: $fullPdfPath</li>";
                        }
                    } else {
                        echo "<li class='error'>- Fichier PDF introuvable: $fullPdfPath</li>";
                    }
                } else {
                    echo "<li class='warning'>- Pas de chemin de PDF pour ce journal.</li>";
                }
            }
            echo "</ul>";
        } else {
            echo "<p>Aucun journal trouvé dans la base de données.</p>";
        }
        
        echo "<p class='success'>Migration terminée avec succès !</p>";
        echo "<p>La base de données est maintenant prête à utiliser le stockage de fichiers binaires.</p>";
        
    } catch (PDOException $e) {
        echo "<p class='error'>Erreur lors de la mise à jour de la base de données : " . $e->getMessage() . "</p>";
    }
    
    return ob_get_clean(); // Récupérer et renvoyer la sortie
}

// Fonction pour déterminer le type MIME d'une image
function getImageMimeType($filePath) {
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            return 'image/jpeg';
        case 'png':
            return 'image/png';
        case 'gif':
            return 'image/gif';
        case 'webp':
            return 'image/webp';
        default:
            return 'image/jpeg'; // Type par défaut
    }
}

// Vérification d'authentification simple
$isAdmin = false;
$errorMsg = '';

// Si formulaire de connexion soumis
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $errorMsg = "Identifiants incorrects";
    }
}

// Vérifier si l'utilisateur est connecté
$isAdmin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Si déconnexion demandée
if (isset($_GET['logout'])) {
    unset($_SESSION['admin_logged_in']);
    header('Location: web_migrate.php');
    exit;
}

// Exécuter la migration si demandé
$migrationResult = null;
if ($isAdmin && isset($_POST['start_migration'])) {
    $migrationResult = startMigration();
}

// Réparer les numéros dupliqués si demandé
$fixResult = null;
if ($isAdmin && isset($_POST['fix_duplicates'])) {
    $fixResult = fixDuplicateNumbers();
}

// Vérifier l'état des colonnes
$columnsExist = false;
if ($isAdmin) {
    require_once 'includes/db_connect.php';
    try {
        $columnsCheck = $db->query("SHOW COLUMNS FROM voix_apprentis_journaux LIKE 'image_data'");
        $columnsExist = ($columnsCheck->rowCount() > 0);
    } catch (PDOException $e) {
        $errorMsg = "Erreur lors de la vérification de la structure : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Migration des fichiers - La Voix des Apprentis</title>
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
            max-width: 800px;
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
        input[type="password"] {
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
        
        .alert-warning {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .migration-result {
            margin-top: 20px;
            padding: 15px;
            background-color: var(--gray-light);
            border-radius: 4px;
            max-height: 500px;
            overflow-y: auto;
        }
        
        .migration-result ul {
            margin-left: 20px;
        }
        
        .migration-result li {
            margin-bottom: 5px;
        }
        
        .success {
            color: var(--success-color);
        }
        
        .error {
            color: var(--danger-color);
        }
        
        .warning {
            color: var(--warning-color);
        }
        
        .status {
            margin: 20px 0;
            padding: 15px;
            border-radius: 4px;
        }
        
        .status-ready {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        
        .status-not-ready {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
        }
        
        .actions {
            margin-top: 20px;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php if (!$isAdmin): ?>
        <div class="login-container">
            <h2>Connexion Administrateur</h2>
            
            <?php if (!empty($errorMsg)): ?>
                <div class="alert alert-danger"><?= $errorMsg ?></div>
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
                <h1>Migration des fichiers vers la base de données</h1>
                <a href="?logout=1" class="btn btn-danger">Déconnexion</a>
            </div>
            
            <p>Cette page vous permet de migrer les fichiers de La Voix des Apprentis (images et PDF) du système de fichiers vers la base de données.</p>
            
            <?php if ($columnsExist): ?>
                <div class="status status-ready">
                    <h3><i class="fas fa-check-circle"></i> État de la base de données</h3>
                    <p>Les colonnes pour le stockage binaire existent déjà dans la base de données.</p>
                </div>
            <?php else: ?>
                <div class="status status-not-ready">
                    <h3><i class="fas fa-exclamation-triangle"></i> État de la base de données</h3>
                    <p>Les colonnes pour le stockage binaire n'existent pas encore dans la base de données.</p>
                    <p>La migration va d'abord créer ces colonnes puis importer les fichiers.</p>
                </div>
            <?php endif; ?>
            
            <div class="actions">
                <form method="post" action="" style="display: inline-block;">
                    <button type="submit" name="start_migration"><?= $columnsExist ? 'Relancer la migration' : 'Démarrer la migration' ?></button>
                </form>
                
                <form method="post" action="" style="display: inline-block; margin-left: 10px;">
                    <button type="submit" name="fix_duplicates" class="btn">Réparer les numéros dupliqués</button>
                </form>
            </div>
            
            <?php if ($migrationResult !== null): ?>
                <h2>Résultat de la migration</h2>
                <div class="migration-result">
                    <?= $migrationResult ?>
                </div>
            <?php endif; ?>
            
            <?php if ($fixResult !== null): ?>
                <h2>Résultat de la réparation des numéros dupliqués</h2>
                <div class="migration-result">
                    <?= $fixResult ?>
                </div>
            <?php endif; ?>
            
            <a href="test_binary_data.php" class="btn back-link">Tester les données binaires</a>
            <a href="admin/voix-apprentis-admin.php" class="btn back-link">Administration des journaux</a>
            <a href="voix-apprentis.php" class="btn back-link">Retour à La Voix des Apprentis</a>
        </div>
    <?php endif; ?>
</body>
</html> 
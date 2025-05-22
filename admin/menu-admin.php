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

// Inclure le header
include 'header.php';
?>

<h1>Gestion des menus du restaurant scolaire</h1>

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
        <form method="post" action="" class="upload-form">
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
            <button type="submit" name="save_meal" class="btn btn-primary">Enregistrer</button>
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
                <button type="submit" class="btn btn-secondary">Filtrer</button>
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
                                <a href="?delete_meal=<?= $plat['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce repas ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="tab-content" id="tab-date">
        <h2>Modifier la date de la semaine</h2>
        <form method="post" action="" class="upload-form">
            <div class="form-group">
                <label for="date_semaine">Date de la semaine (ex: 15 au 19 juillet 2024)</label>
                <input type="text" id="date_semaine" name="date_semaine" value="<?= $jours[0]['date_semaine'] ?? '' ?>" required>
            </div>
            <button type="submit" name="update_date" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>

<div class="admin-links" style="margin-top: 2rem;">
    <a href="restaurant-admin.php" class="btn btn-secondary">Gestion des médias restaurant</a>
    <a href="../restaurant-scolaire.php" class="btn btn-secondary">Voir la page du restaurant</a>
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

<style>
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
        background-color: var(--light-color);
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
    
    .admin-links {
        display: flex;
        gap: 15px;
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

<?php include 'footer.php'; ?> 
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
</style>

<?php include 'footer.php'; ?> 
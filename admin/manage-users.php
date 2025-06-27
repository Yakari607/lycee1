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

$success_message = '';
$error_message = '';

// Traitement de l'ajout/modification d'utilisateur
if (isset($_POST['save_user'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $role = $_POST['role'] ?? 'admin';
    $active = isset($_POST['active']) ? 1 : 0;
    $user_id = $_POST['user_id'] ?? '';
    
    if (empty($username)) {
        $error_message = "Le nom d'utilisateur est requis";
    } else {
        try {
            if (!empty($user_id)) {
                // Mise à jour d'un utilisateur existant
                $query = "UPDATE admin_users SET username = :username, email = :email, role = :role, active = :active";
                $params = [
                    ':username' => $username,
                    ':email' => $email,
                    ':role' => $role,
                    ':active' => $active,
                    ':id' => $user_id
                ];
                
                if (!empty($password)) {
                    $query .= ", password_hash = :password_hash";
                    $params[':password_hash'] = password_hash($password, PASSWORD_DEFAULT);
                }
                
                $query .= " WHERE id = :id";
                
                $stmt = $db->prepare($query);
                $stmt->execute($params);
                $success_message = "Utilisateur mis à jour avec succès";
            } else {
                // Ajout d'un nouvel utilisateur
                if (empty($password)) {
                    $error_message = "Le mot de passe est requis pour un nouvel utilisateur";
                } else {
                    $stmt = $db->prepare("INSERT INTO admin_users (username, password_hash, email, role, active) VALUES (:username, :password_hash, :email, :role, :active)");
                    $stmt->execute([
                        ':username' => $username,
                        ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
                        ':email' => $email,
                        ':role' => $role,
                        ':active' => $active
                    ]);
                    $success_message = "Utilisateur ajouté avec succès";
                }
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error_message = "Ce nom d'utilisateur ou email existe déjà";
            } else {
                $error_message = "Erreur lors de l'enregistrement : " . $e->getMessage();
            }
        }
    }
}

// Traitement de la suppression d'un utilisateur
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    
    // Empêcher la suppression de son propre compte
    if ($user_id == $_SESSION['admin_id']) {
        $error_message = "Vous ne pouvez pas supprimer votre propre compte";
    } else {
        try {
            $stmt = $db->prepare("DELETE FROM admin_users WHERE id = :id");
            $stmt->execute([':id' => $user_id]);
            $success_message = "Utilisateur supprimé avec succès";
        } catch (PDOException $e) {
            $error_message = "Erreur lors de la suppression : " . $e->getMessage();
        }
    }
}

// Si on veut éditer un utilisateur existant
$user_to_edit = null;
if (isset($_GET['edit_user'])) {
    $user_id = $_GET['edit_user'];
    
    try {
        $stmt = $db->prepare("SELECT * FROM admin_users WHERE id = :id");
        $stmt->execute([':id' => $user_id]);
        $user_to_edit = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user_to_edit) {
            $error_message = "Utilisateur introuvable";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
    }
}

// Récupération de tous les utilisateurs
try {
    $stmt = $db->query("SELECT * FROM admin_users ORDER BY username ASC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
    $users = [];
}

// Inclure le header
include 'header.php';
?>

<h1>Gestion des utilisateurs administrateurs</h1>

<?php if (!empty($success_message)): ?>
    <div class="alert alert-success"><?= $success_message ?></div>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger"><?= $error_message ?></div>
<?php endif; ?>

<h2><?= $user_to_edit ? 'Modifier l\'utilisateur' : 'Ajouter un nouvel utilisateur' ?></h2>
<form method="post" action="" class="upload-form">
    <?php if ($user_to_edit): ?>
        <input type="hidden" name="user_id" value="<?= $user_to_edit['id'] ?>">
    <?php endif; ?>
    
    <div class="form-group">
        <label for="username">Nom d'utilisateur *</label>
        <input type="text" id="username" name="username" value="<?= $user_to_edit['username'] ?? '' ?>" required>
    </div>
    
    <div class="form-group">
        <label for="password">Mot de passe <?= $user_to_edit ? '(laisser vide pour ne pas changer)' : '*' ?></label>
        <input type="password" id="password" name="password" <?= $user_to_edit ? '' : 'required' ?>>
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $user_to_edit['email'] ?? '' ?>">
    </div>
    
    <div class="form-group">
        <label for="role">Rôle</label>
        <select id="role" name="role">
            <option value="admin" <?= (isset($user_to_edit) && $user_to_edit['role'] === 'admin') ? 'selected' : '' ?>>Administrateur</option>
            <option value="moderator" <?= (isset($user_to_edit) && $user_to_edit['role'] === 'moderator') ? 'selected' : '' ?>>Modérateur</option>
        </select>
    </div>
    
    <div class="form-group checkbox-group">
        <input type="checkbox" id="active" name="active" <?= (isset($user_to_edit) && $user_to_edit['active']) || !isset($user_to_edit) ? 'checked' : '' ?>>
        <label for="active">Compte actif</label>
    </div>

    <button type="submit" name="save_user" class="btn btn-primary"><?= $user_to_edit ? 'Mettre à jour' : 'Ajouter' ?></button>
    <?php if ($user_to_edit): ?>
        <a href="manage-users.php" class="btn btn-secondary">Annuler</a>
    <?php endif; ?>
</form>

<h2 style="margin-top: 2rem;">Liste des utilisateurs</h2>

<?php if (empty($users)): ?>
    <p>Aucun utilisateur trouvé.</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Statut</th>
                <th>Dernière connexion</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                    <td><?= $user['role'] === 'admin' ? 'Administrateur' : 'Modérateur' ?></td>
                    <td><?= $user['active'] ? '<i class="fas fa-check" style="color: green;"></i>' : '<i class="fas fa-times" style="color: red;"></i>' ?></td>
                    <td><?= $user['last_login'] ? date('d/m/Y H:i', strtotime($user['last_login'])) : 'Jamais' ?></td>
                    <td><?= date('d/m/Y', strtotime($user['date_created'])) ?></td>
                    <td class="actions">
                        <a href="?edit_user=<?= $user['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <?php if ($user['id'] != $_SESSION['admin_id']): ?>
                            <a href="?delete_user=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<style>
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .checkbox-group input[type="checkbox"] {
        width: auto;
        margin: 0;
    }
    
    .actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    @media (max-width: 768px) {
        .actions {
            flex-direction: column;
        }
    }
</style>

<?php include 'footer.php'; ?> 
<?php
// Script de test pour l'upload de plaquettes

// Désactivation de la mise en mémoire tampon de la sortie pour voir les résultats immédiatement
ini_set('output_buffering', 'off');
ini_set('zlib.output_compression', false);
ini_set('implicit_flush', true);
ob_implicit_flush(true);

echo "<h1>Test d'upload de plaquettes</h1>";
echo "<pre>";

// Afficher les informations sur le serveur
echo "=== INFORMATIONS SERVEUR ===\n";
echo "Utilisateur PHP: " . get_current_user() . "\n";
echo "Dossier temporaire PHP: " . sys_get_temp_dir() . "\n";
echo "Dossier courant: " . getcwd() . "\n";
echo "Upload max filesize: " . ini_get('upload_max_filesize') . "\n";
echo "Post max size: " . ini_get('post_max_size') . "\n";
echo "Max execution time: " . ini_get('max_execution_time') . "\n";
echo "Memory limit: " . ini_get('memory_limit') . "\n\n";

// Créer les dossiers de test
$image_dir = "../images/plaquettes/";
$upload_dir = "../uploads/plaquettes/";

echo "=== VÉRIFICATION DES DOSSIERS ===\n";

// Vérifier les dossiers
echo "Dossier images ($image_dir):\n";
echo "- Existe: " . (file_exists($image_dir) ? "Oui" : "Non") . "\n";
echo "- Accessible en lecture: " . (is_readable($image_dir) ? "Oui" : "Non") . "\n";
echo "- Accessible en écriture: " . (is_writable($image_dir) ? "Oui" : "Non") . "\n";
echo "- Permissions: " . substr(sprintf('%o', fileperms($image_dir)), -4) . "\n";

echo "\nDossier uploads ($upload_dir):\n";
echo "- Existe: " . (file_exists($upload_dir) ? "Oui" : "Non") . "\n";
echo "- Accessible en lecture: " . (is_readable($upload_dir) ? "Oui" : "Non") . "\n";
echo "- Accessible en écriture: " . (is_writable($upload_dir) ? "Oui" : "Non") . "\n";
echo "- Permissions: " . substr(sprintf('%o', fileperms($upload_dir)), -4) . "\n\n";

// Test de création de fichier
echo "=== TEST D'ÉCRITURE ===\n";
$test_file_image = $image_dir . "test_" . uniqid() . ".txt";
$test_file_upload = $upload_dir . "test_" . uniqid() . ".txt";

if (file_put_contents($test_file_image, "Test écriture image")) {
    echo "✓ Écriture réussie dans le dossier images\n";
    unlink($test_file_image);
} else {
    echo "✗ Écriture échouée dans le dossier images\n";
    echo "Erreur: " . error_get_last()['message'] . "\n";
}

if (file_put_contents($test_file_upload, "Test écriture upload")) {
    echo "✓ Écriture réussie dans le dossier uploads\n";
    unlink($test_file_upload);
} else {
    echo "✗ Écriture échouée dans le dossier uploads\n";
    echo "Erreur: " . error_get_last()['message'] . "\n";
}

// Traitement du formulaire d'upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "\n=== TRAITEMENT UPLOAD ===\n";
    
    if (isset($_FILES['test_image']) && $_FILES['test_image']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "Upload d'image de test:\n";
        echo "- Nom: " . $_FILES['test_image']['name'] . "\n";
        echo "- Type: " . $_FILES['test_image']['type'] . "\n";
        echo "- Taille: " . $_FILES['test_image']['size'] . " octets\n";
        echo "- Code erreur: " . $_FILES['test_image']['error'] . "\n";
        echo "- Fichier temporaire: " . $_FILES['test_image']['tmp_name'] . "\n";
        echo "- Fichier temp existe: " . (file_exists($_FILES['test_image']['tmp_name']) ? "Oui" : "Non") . "\n";
        
        // Messages d'erreur
        $error_messages = [
            UPLOAD_ERR_OK => "Pas d'erreur",
            UPLOAD_ERR_INI_SIZE => "Fichier trop grand (php.ini)",
            UPLOAD_ERR_FORM_SIZE => "Fichier trop grand (formulaire)",
            UPLOAD_ERR_PARTIAL => "Upload partiel",
            UPLOAD_ERR_NO_FILE => "Aucun fichier",
            UPLOAD_ERR_NO_TMP_DIR => "Dossier temporaire manquant",
            UPLOAD_ERR_CANT_WRITE => "Impossible d'écrire",
            UPLOAD_ERR_EXTENSION => "Extension bloquée"
        ];
        
        echo "- Message erreur: " . ($error_messages[$_FILES['test_image']['error']] ?? "Erreur inconnue") . "\n";
        
        if ($_FILES['test_image']['error'] === UPLOAD_ERR_OK) {
            $target_file = $image_dir . "test_upload_" . uniqid() . "." . pathinfo($_FILES['test_image']['name'], PATHINFO_EXTENSION);
            echo "- Fichier cible: " . $target_file . "\n";
            
            if (move_uploaded_file($_FILES['test_image']['tmp_name'], $target_file)) {
                echo "✓ Upload réussi!\n";
                echo "- Fichier créé: " . $target_file . "\n";
                echo "- Taille finale: " . filesize($target_file) . " octets\n";
                // Nettoyer le fichier de test
                unlink($target_file);
            } else {
                echo "✗ Échec du déplacement du fichier\n";
                $last_error = error_get_last();
                if ($last_error) {
                    echo "- Dernière erreur PHP: " . $last_error['message'] . "\n";
                }
            }
        }
    }
    
    if (isset($_FILES['test_pdf']) && $_FILES['test_pdf']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "\nUpload de PDF de test:\n";
        echo "- Nom: " . $_FILES['test_pdf']['name'] . "\n";
        echo "- Type: " . $_FILES['test_pdf']['type'] . "\n";
        echo "- Taille: " . $_FILES['test_pdf']['size'] . " octets\n";
        echo "- Code erreur: " . $_FILES['test_pdf']['error'] . "\n";
        echo "- Fichier temporaire: " . $_FILES['test_pdf']['tmp_name'] . "\n";
        echo "- Fichier temp existe: " . (file_exists($_FILES['test_pdf']['tmp_name']) ? "Oui" : "Non") . "\n";
        
        if ($_FILES['test_pdf']['error'] === UPLOAD_ERR_OK) {
            $target_file = $upload_dir . "test_upload_" . uniqid() . ".pdf";
            echo "- Fichier cible: " . $target_file . "\n";
            
            if (move_uploaded_file($_FILES['test_pdf']['tmp_name'], $target_file)) {
                echo "✓ Upload PDF réussi!\n";
                echo "- Fichier créé: " . $target_file . "\n";
                echo "- Taille finale: " . filesize($target_file) . " octets\n";
                // Nettoyer le fichier de test
                unlink($target_file);
            } else {
                echo "✗ Échec du déplacement du fichier PDF\n";
                $last_error = error_get_last();
                if ($last_error) {
                    echo "- Dernière erreur PHP: " . $last_error['message'] . "\n";
                }
            }
        }
    }
}

echo "</pre>";
?>

<form action="" method="post" enctype="multipart/form-data" style="margin-top: 20px; padding: 20px; border: 1px solid #ccc;">
    <h3>Test d'upload</h3>
    <p>
        <label for="test_image">Image de test :</label><br>
        <input type="file" name="test_image" id="test_image" accept="image/*">
    </p>
    <p>
        <label for="test_pdf">PDF de test :</label><br>
        <input type="file" name="test_pdf" id="test_pdf" accept="application/pdf">
    </p>
    <button type="submit">Tester l'upload</button>
</form>

<div style="margin-top: 20px;">
    <a href="plaquettes-admin.php">← Retour à la gestion des plaquettes</a>
</div> 
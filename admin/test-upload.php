<?php
// Script de test pour l'upload de fichiers

// Désactivation de la mise en mémoire tampon de la sortie pour voir les résultats immédiatement
ini_set('output_buffering', 'off');
ini_set('zlib.output_compression', false);
ini_set('implicit_flush', true);
ob_implicit_flush(true);

echo "<h1>Test d'upload de fichiers</h1>";
echo "<pre>";

// Afficher les informations sur le serveur
echo "Utilisateur PHP: " . exec('whoami') . "\n";
echo "ID processus: " . getmypid() . "\n";
echo "Dossier temporaire PHP: " . sys_get_temp_dir() . "\n";
echo "Dossier courant: " . getcwd() . "\n\n";

// Créer les dossiers de test
$image_dir = "../images/voix-apprentis-test/";
$upload_dir = "../uploads/voix-apprentis-test/";

echo "Création des dossiers de test...\n";
if (!file_exists($image_dir)) {
    if (mkdir($image_dir, 0777, true)) {
        echo "Dossier $image_dir créé avec succès\n";
    } else {
        echo "ÉCHEC: Impossible de créer le dossier $image_dir\n";
    }
} else {
    echo "Le dossier $image_dir existe déjà\n";
}

if (!file_exists($upload_dir)) {
    if (mkdir($upload_dir, 0777, true)) {
        echo "Dossier $upload_dir créé avec succès\n";
    } else {
        echo "ÉCHEC: Impossible de créer le dossier $upload_dir\n";
    }
} else {
    echo "Le dossier $upload_dir existe déjà\n";
}

// Vérifier les permissions
echo "\nVérification des permissions...\n";
echo "Images dir ($image_dir):\n";
echo "- Existe: " . (file_exists($image_dir) ? "Oui" : "Non") . "\n";
echo "- Accessible en lecture: " . (is_readable($image_dir) ? "Oui" : "Non") . "\n";
echo "- Accessible en écriture: " . (is_writable($image_dir) ? "Oui" : "Non") . "\n";

echo "Uploads dir ($upload_dir):\n";
echo "- Existe: " . (file_exists($upload_dir) ? "Oui" : "Non") . "\n";
echo "- Accessible en lecture: " . (is_readable($upload_dir) ? "Oui" : "Non") . "\n";
echo "- Accessible en écriture: " . (is_writable($upload_dir) ? "Oui" : "Non") . "\n";

// Traitement du formulaire d'upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "\nTraitement du formulaire d'upload...\n";
    
    // Traitement de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "Upload d'image:\n";
        echo "- Nom: " . $_FILES['image']['name'] . "\n";
        echo "- Type: " . $_FILES['image']['type'] . "\n";
        echo "- Taille: " . $_FILES['image']['size'] . " octets\n";
        echo "- Erreur: " . $_FILES['image']['error'] . "\n";
        echo "- Fichier temporaire: " . $_FILES['image']['tmp_name'] . "\n";
        echo "- Existe: " . (file_exists($_FILES['image']['tmp_name']) ? "Oui" : "Non") . "\n";
        
        $target_file = $image_dir . uniqid() . "." . strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        echo "- Fichier cible: " . $target_file . "\n";
        
        if (copy($_FILES['image']['tmp_name'], $target_file)) {
            echo "- Copie réussie vers $target_file\n";
        } else {
            echo "- ÉCHEC: Impossible de copier le fichier\n";
            echo "- Erreur: " . error_get_last()['message'] . "\n";
        }
    }
    
    // Traitement du PDF
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "\nUpload de PDF:\n";
        echo "- Nom: " . $_FILES['pdf']['name'] . "\n";
        echo "- Type: " . $_FILES['pdf']['type'] . "\n";
        echo "- Taille: " . $_FILES['pdf']['size'] . " octets\n";
        echo "- Erreur: " . $_FILES['pdf']['error'] . "\n";
        echo "- Fichier temporaire: " . $_FILES['pdf']['tmp_name'] . "\n";
        echo "- Existe: " . (file_exists($_FILES['pdf']['tmp_name']) ? "Oui" : "Non") . "\n";
        
        $target_file = $upload_dir . uniqid() . ".pdf";
        echo "- Fichier cible: " . $target_file . "\n";
        
        if (copy($_FILES['pdf']['tmp_name'], $target_file)) {
            echo "- Copie réussie vers $target_file\n";
        } else {
            echo "- ÉCHEC: Impossible de copier le fichier\n";
            echo "- Erreur: " . error_get_last()['message'] . "\n";
        }
    }
}

echo "</pre>";
?>

<form action="" method="post" enctype="multipart/form-data">
    <p>
        <label for="image">Image :</label>
        <input type="file" name="image" id="image">
    </p>
    <p>
        <label for="pdf">PDF :</label>
        <input type="file" name="pdf" id="pdf">
    </p>
    <button type="submit">Tester l'upload</button>
</form> 
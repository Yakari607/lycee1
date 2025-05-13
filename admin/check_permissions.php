<?php
// Script de vérification des permissions des dossiers d'upload

echo "<h1>Vérification des permissions pour les dossiers d'upload</h1>";

$directories = [
    '../images/voix-apprentis/',
    '../uploads/voix-apprentis/'
];

foreach ($directories as $dir) {
    echo "<h2>Vérification du dossier: $dir</h2>";
    
    // Vérifier si le dossier existe
    if (!file_exists($dir)) {
        echo "Le dossier n'existe pas. Tentative de création... ";
        
        if (mkdir($dir, 0755, true)) {
            echo "<span style='color:green'>SUCCÈS</span><br>";
        } else {
            echo "<span style='color:red'>ÉCHEC</span><br>";
            echo "Erreur PHP: " . error_get_last()['message'] . "<br>";
            echo "Assurez-vous que le serveur web a les droits d'écriture sur le dossier parent.<br>";
            continue;
        }
    } else {
        echo "Le dossier existe. <span style='color:green'>OK</span><br>";
    }
    
    // Vérifier les permissions
    echo "Permissions actuelles: " . substr(sprintf('%o', fileperms($dir)), -4) . "<br>";
    
    // Vérifier si le dossier est accessible en écriture
    if (is_writable($dir)) {
        echo "Le dossier est accessible en écriture. <span style='color:green'>OK</span><br>";
    } else {
        echo "Le dossier n'est PAS accessible en écriture. <span style='color:red'>PROBLÈME</span><br>";
        echo "Vous devez changer les permissions du dossier pour permettre l'écriture.<br>";
    }
    
    // Tester la création d'un fichier
    $test_file = $dir . 'test_' . time() . '.txt';
    echo "Test de création d'un fichier... ";
    
    if ($file = @fopen($test_file, 'w')) {
        fwrite($file, 'Test de permission réussi');
        fclose($file);
        echo "<span style='color:green'>SUCCÈS</span><br>";
        
        // Supprimer le fichier de test
        if (unlink($test_file)) {
            echo "Suppression du fichier de test. <span style='color:green'>OK</span><br>";
        } else {
            echo "Impossible de supprimer le fichier de test. <span style='color:orange'>AVERTISSEMENT</span><br>";
        }
    } else {
        echo "<span style='color:red'>ÉCHEC</span><br>";
        echo "Erreur PHP: " . error_get_last()['message'] . "<br>";
    }
    
    echo "<hr>";
}

// Vérifier les limites de taille d'upload PHP
echo "<h2>Vérification des limites PHP</h2>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "post_max_size: " . ini_get('post_max_size') . "<br>";
echo "max_file_uploads: " . ini_get('max_file_uploads') . "<br>";
echo "memory_limit: " . ini_get('memory_limit') . "<br>";

// Vérifier si les extensions nécessaires sont chargées
echo "<h2>Vérification des extensions PHP</h2>";
$required_extensions = ['gd', 'fileinfo', 'pdo', 'pdo_mysql'];

foreach ($required_extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "Extension $ext: <span style='color:green'>CHARGÉE</span><br>";
    } else {
        echo "Extension $ext: <span style='color:red'>NON CHARGÉE</span> (peut être nécessaire)<br>";
    }
}

// Afficher les informations générales sur PHP
echo "<h2>Informations générales</h2>";
echo "Version PHP: " . phpversion() . "<br>";
echo "Utilisateur PHP: " . get_current_user() . "<br>";
echo "Dossier temporaire: " . sys_get_temp_dir() . " (permissions: " . substr(sprintf('%o', fileperms(sys_get_temp_dir())), -4) . ")<br>";

echo "<p>Ces informations vous aideront à résoudre les problèmes d'upload de fichiers.</p>";
?> 
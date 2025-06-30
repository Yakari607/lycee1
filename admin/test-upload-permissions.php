<?php
// Script de test pour vérifier les permissions d'upload

echo "<h1>Test des permissions d'upload</h1>";

// Test 1: Vérifier la configuration PHP
echo "<h2>1. Configuration PHP</h2>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "post_max_size: " . ini_get('post_max_size') . "<br>";
echo "max_execution_time: " . ini_get('max_execution_time') . "<br>";
echo "memory_limit: " . ini_get('memory_limit') . "<br>";

// Test 2: Vérifier le dossier uploads
echo "<h2>2. Dossier uploads</h2>";
$upload_dir = '../uploads/actualites/';

echo "Chemin complet: " . realpath($upload_dir) . "<br>";
echo "Dossier existe: " . (is_dir($upload_dir) ? "✅ Oui" : "❌ Non") . "<br>";
echo "Dossier accessible en lecture: " . (is_readable($upload_dir) ? "✅ Oui" : "❌ Non") . "<br>";
echo "Dossier accessible en écriture: " . (is_writable($upload_dir) ? "✅ Oui" : "❌ Non") . "<br>";

// Test 3: Permissions détaillées
echo "<h2>3. Permissions détaillées</h2>";
if (is_dir($upload_dir)) {
    $perms = fileperms($upload_dir);
    echo "Permissions: " . decoct($perms & 0777) . "<br>";
    echo "Propriétaire: " . posix_getpwuid(fileowner($upload_dir))['name'] . "<br>";
    echo "Groupe: " . posix_getgrgid(filegroup($upload_dir))['name'] . "<br>";
} else {
    echo "❌ Le dossier n'existe pas<br>";
}

// Test 4: Test d'écriture
echo "<h2>4. Test d'écriture</h2>";
$test_file = $upload_dir . 'test_write_' . time() . '.txt';
if (file_put_contents($test_file, 'test')) {
    echo "✅ Écriture de fichier réussie<br>";
    unlink($test_file); // Nettoyer
    echo "✅ Suppression de fichier réussie<br>";
} else {
    echo "❌ Impossible d'écrire dans le dossier<br>";
    echo "Erreur: " . error_get_last()['message'] . "<br>";
}

// Test 5: Test d'upload simulé
echo "<h2>5. Variables d'environnement</h2>";
echo "USER: " . ($_ENV['USER'] ?? 'non défini') . "<br>";
echo "Apache user: " . (function_exists('posix_getpwuid') ? posix_getpwuid(posix_geteuid())['name'] : 'non disponible') . "<br>";
echo "PHP SAPI: " . php_sapi_name() . "<br>";

// Test 6: Extensions PHP
echo "<h2>6. Extensions PHP</h2>";
echo "fileinfo: " . (extension_loaded('fileinfo') ? "✅ Installée" : "❌ Manquante") . "<br>";
echo "mbstring: " . (extension_loaded('mbstring') ? "✅ Installée" : "❌ Manquante") . "<br>";

?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; }
h1 { color: #333; }
h2 { color: #666; border-bottom: 1px solid #ddd; padding-bottom: 5px; }
</style> 
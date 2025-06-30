<?php
// Script pour réparer les permissions d'upload

echo "<h1>Réparation des permissions d'upload</h1>";

$upload_dir = 'uploads/actualites/';

// Créer le dossier s'il n'existe pas
if (!is_dir($upload_dir)) {
    echo "<p>Création du dossier $upload_dir...</p>";
    if (mkdir($upload_dir, 0777, true)) {
        echo "<p style='color: green;'>✅ Dossier créé avec succès</p>";
    } else {
        echo "<p style='color: red;'>❌ Impossible de créer le dossier</p>";
        exit;
    }
}

// Changer les permissions
echo "<p>Modification des permissions...</p>";
if (chmod($upload_dir, 0777)) {
    echo "<p style='color: green;'>✅ Permissions modifiées avec succès</p>";
} else {
    echo "<p style='color: orange;'>⚠️ Impossible de modifier les permissions (peut être normal)</p>";
}

// Test d'écriture
echo "<p>Test d'écriture...</p>";
$test_file = $upload_dir . 'test_' . time() . '.txt';
if (file_put_contents($test_file, 'test')) {
    echo "<p style='color: green;'>✅ Test d'écriture réussi</p>";
    unlink($test_file);
    echo "<p style='color: green;'>✅ Test de suppression réussi</p>";
} else {
    echo "<p style='color: red;'>❌ Test d'écriture échoué</p>";
}

// Vérifications finales
echo "<h2>État final</h2>";
echo "<p>Dossier existe: " . (is_dir($upload_dir) ? "✅ Oui" : "❌ Non") . "</p>";
echo "<p>Accessible en lecture: " . (is_readable($upload_dir) ? "✅ Oui" : "❌ Non") . "</p>";
echo "<p>Accessible en écriture: " . (is_writable($upload_dir) ? "✅ Oui" : "❌ Non") . "</p>";

if (is_dir($upload_dir)) {
    $perms = fileperms($upload_dir);
    echo "<p>Permissions actuelles: " . decoct($perms & 0777) . "</p>";
}

echo "<h2>Instructions</h2>";
echo "<p>Si tout est ✅, vous pouvez maintenant tester l'upload dans l'administration.</p>";
echo "<p>Si il y a encore des ❌, contactez votre administrateur système.</p>";
echo "<p><a href='admin/actualites-admin.php'>Aller à l'administration</a></p>";
echo "<p><a href='admin/test-upload-permissions.php'>Tests détaillés</a></p>";

?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; max-width: 800px; }
h1, h2 { color: #333; }
p { line-height: 1.5; }
a { color: #007bff; text-decoration: none; padding: 10px; background: #f8f9fa; border-radius: 5px; display: inline-block; margin: 5px; }
a:hover { background: #e9ecef; }
</style> 
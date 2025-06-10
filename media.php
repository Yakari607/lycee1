<?php
require_once 'includes/db_connect.php';

// Récupérer le lien de partage depuis l'URL
$lien_partage = isset($_GET['l']) ? $_GET['l'] : '';

if (empty($lien_partage)) {
    header('Location: index.php');
    exit;
}

// Rechercher le média correspondant au lien de partage
$sql = "SELECT * FROM medias_partage WHERE lien_partage = :lien_partage AND actif = 1";
$stmt = $db->prepare($sql);
$stmt->bindParam(':lien_partage', $lien_partage);
$stmt->execute();
$media = $stmt->fetch(PDO::FETCH_ASSOC);

// Si le média n'existe pas ou n'est pas actif, rediriger vers la page d'accueil
if (!$media) {
    header('Location: index.php');
    exit;
}

// Incrémenter le compteur de vues
$sql = "UPDATE medias_partage SET vues = vues + 1 WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $media['id']);
$stmt->execute();

// Déterminer le type de contenu pour l'affichage
$type_fichier = $media['type_fichier'];
$chemin_fichier = $media['fichier_path'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($media['titre']); ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .media-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        .media-header {
            margin-bottom: 20px;
        }
        .media-content {
            margin-top: 20px;
            text-align: center;
        }
        .pdf-viewer {
            width: 100%;
            height: 800px;
            border: 1px solid #ddd;
        }
        .image-viewer img {
            max-width: 100%;
            height: auto;
        }
        .video-viewer {
            width: 100%;
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="media-container">
        <div class="media-header">
            <h1><?php echo htmlspecialchars($media['titre']); ?></h1>
            <?php if (!empty($media['description'])): ?>
                <p class="description"><?php echo nl2br(htmlspecialchars($media['description'])); ?></p>
            <?php endif; ?>
            <p class="date">Partagé le <?php echo date('d/m/Y', strtotime($media['date_creation'])); ?></p>
        </div>
        
        <div class="media-content">
            <?php if ($type_fichier === 'pdf'): ?>
                <iframe class="pdf-viewer" src="<?php echo $chemin_fichier; ?>" frameborder="0"></iframe>
                <p>
                    <a href="<?php echo $chemin_fichier; ?>" download class="btn btn-primary">Télécharger le PDF</a>
                </p>
            <?php elseif ($type_fichier === 'image'): ?>
                <div class="image-viewer">
                    <img src="<?php echo $chemin_fichier; ?>" alt="<?php echo htmlspecialchars($media['titre']); ?>">
                </div>
                <p>
                    <a href="<?php echo $chemin_fichier; ?>" download class="btn btn-primary">Télécharger l'image</a>
                </p>
            <?php elseif ($type_fichier === 'video'): ?>
                <video class="video-viewer" controls>
                    <source src="<?php echo $chemin_fichier; ?>" type="video/mp4">
                    Votre navigateur ne prend pas en charge la lecture de vidéos.
                </video>
                <p>
                    <a href="<?php echo $chemin_fichier; ?>" download class="btn btn-primary">Télécharger la vidéo</a>
                </p>
            <?php else: ?>
                <p>Ce type de fichier ne peut pas être affiché directement.</p>
                <p>
                    <a href="<?php echo $chemin_fichier; ?>" download class="btn btn-primary">Télécharger le fichier</a>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>

</body>
</html> 
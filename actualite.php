<?php
// Connexion à la base de données
require_once 'includes/db_connect.php';
require_once 'includes/actualite-functions.php';

// Récupération de l'ID de l'actualité
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Si aucun ID n'est fourni, rediriger vers la page d'accueil
if ($id <= 0) {
    header('Location: index.php#actualites');
    exit;
}

// Récupération de l'actualité
try {
    $stmt = $db->prepare("SELECT * FROM actualites WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $actualite = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$actualite) {
        // Si l'actualité n'existe pas, rediriger vers la page d'accueil
        header('Location: index.php#actualites');
        exit;
    }
    
    // Formatage de la date
    $date = new DateTime($actualite['date_publication']);
    $date_fr = $date->format('j F Y');
    $date_fr = str_replace(
        ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
        $date_fr
    );
    
} catch (PDOException $e) {
    $error_message = "Erreur lors de la récupération de l'actualité: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($actualite['titre']); ?> - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/actualite.css">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- Navigation principale -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à l'accueil</span>
        </a>

        <section class="actualite-content">
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php else: ?>
            <article class="actualite-detail">
                <header class="actualite-header">
                    <div class="container">
                        <div class="actualite-meta">
                            <span class="actualite-category"><?php echo htmlspecialchars($actualite['categorie']); ?></span>
                            <time class="actualite-date" datetime="<?php echo $actualite['date_publication']; ?>"><?php echo $date_fr; ?></time>
                        </div>
                        <h1 class="actualite-title"><?php echo htmlspecialchars($actualite['titre']); ?></h1>
                    </div>
                </header>
                
                <?php if (!empty($actualite['image'])): ?>
                <div class="actualite-image">
                    <img src="<?php echo htmlspecialchars($actualite['image']); ?>" alt="<?php echo htmlspecialchars($actualite['titre']); ?>" loading="lazy">
                </div>
                <?php else: ?>
                <div class="actualite-image-placeholder">
                    <div class="no-image-news">
                        <i class="fas fa-newspaper"></i>
                        <span>Image non disponible</span>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="actualite-content-wrapper">
                    <div class="container">
                    <div class="actualite-text">
                        <?php echo process_actualite_content($actualite['contenu'], $actualite['id']); ?>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Actualités similaires -->
            <section class="related-news">
                <div class="container">
                    <h2>Autres actualités</h2>
                    <div class="related-grid">
                        <?php
                        try {
                            $stmt = $db->prepare("SELECT * FROM actualites WHERE id != :id AND date_publication <= NOW() ORDER BY date_publication DESC LIMIT 3");
                            $stmt->execute(['id' => $id]);
                            $related_actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if (!empty($related_actualites)):
                            foreach ($related_actualites as $related_actualite):
                                // Formatage de la date
                                $rel_date = new DateTime($related_actualite['date_publication']);
                                $rel_date_fr = $rel_date->format('j F Y');
                                $rel_date_fr = str_replace(
                                    ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                    ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
                                    $rel_date_fr
                                );
                        ?>
                            <article class="related-card">
                                <div class="related-image">
                                    <?php if (!empty($related_actualite['image'])): ?>
                                        <img src="<?php echo htmlspecialchars($related_actualite['image']); ?>" alt="<?php echo htmlspecialchars($related_actualite['titre']); ?>" loading="lazy">
                                    <?php else: ?>
                                        <div class="no-image-related">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="related-content">
                                    <span class="related-tag"><?php echo htmlspecialchars($related_actualite['categorie']); ?></span>
                                    <h3><?php echo htmlspecialchars($related_actualite['titre']); ?></h3>
                                    <time datetime="<?php echo $related_actualite['date_publication']; ?>"><?php echo $rel_date_fr; ?></time>
                                    <div class="related-excerpt">
                                        <?php 
                                        $excerpt = substr(strip_tags($related_actualite['contenu']), 0, 120);
                                        echo htmlspecialchars($excerpt);
                                        if (strlen($related_actualite['contenu']) > 120) echo '...';
                                        ?>
                                    </div>
                                    <a href="actualite.php?id=<?php echo $related_actualite['id']; ?>" class="read-more-related">
                                        Lire la suite <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        <?php 
                            endforeach;
                            else:
                        ?>
                            <div class="no-related">
                                <i class="fas fa-info-circle"></i>
                                <p>Aucune autre actualité à afficher pour le moment.</p>
                            </div>
                        <?php
                            endif;
                        } catch (PDOException $e) {
                            echo '<div class="error-related"><i class="fas fa-exclamation-triangle"></i><p>Impossible de charger les actualités similaires.</p></div>';
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <img src="images/logos/LOGO-UFA-MERMOZ-1.jpg" alt="Logo UFA Jean-Mermoz" class="footer-logo">
                    <p>&copy; 2024 Lycée Jean-Mermoz - Saint-Louis</p>
                </div>
                <div class="footer-links">
                    <a href="mentions-legales.php">Mentions légales</a>
                    <a href="accessibilite.php">Accessibilité</a>
                    <a href="#">Plan du site</a>
                </div>
            </div>
        </div>
    </footer>

    <button class="theme-toggle" aria-label="Basculer le mode sombre">
        <i class="fas fa-moon"></i>
    </button>

    <script src="js/script.js"></script>
    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>

    <script>
        // Animation d'apparition progressive
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.actualite-content, .related-news');
            elements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>

</body>
</html> 
<?php
// Connexion à la base de données
require_once 'includes/db_connect.php';

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
    <title><?php echo htmlspecialchars($actualite['titre']); ?> - Lycée Jean Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/actualite.css">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- Navigation principale -->
    <nav class="main-nav">
        <div class="nav-container">
            <div class="logo">
                <img src="images/logos/Logo_de_la_République_française_(1999).svg.png" alt="Logo République Française" class="logo-rf">
                <img src="images/logos/LOGO-UFA-MERMOZ-1.jpg" alt="Logo UFA Jean-Mermoz" class="logo-ufa">
                <div class="logo-text">
                    <h1>Lycée Jean-Mermoz</h1>
                    <span class="slogan">Excellence et Innovation</span>
                </div>
            </div>
            <div class="nav-content">
                <ul class="nav-links">
                    <li><a href="index.php">Accueil</a></li>
                    <li class="dropdown">
                        <a href="#" onclick="return false;">L'établissement</a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php#contact">Présentation</a></li>
                            <li><a href="index.php#contact">L'équipe</a></li>
                            <li><a href="index.php#vie-lyceenne">Nos infrastructures</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="index.php#formations">Nos formations</a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php#general">Enseignement général & technologique</a></li>
                            <li><a href="index.php#industrie">Enseignement Professionnel</a></li>
                            <li><a href="index.php#industrie">Enseignement supérieur</a></li>
                            <li><a href="index.php#industrie">Apprentissage</a></li>
                            <li><a href="index.php#contact">Orientation</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" onclick="return false;">Espace pour les professionnels</a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php#contact">Stages</a></li>
                            <li><a href="index.php#contact">Alternance</a></li>
                            <li><a href="index.php#contact">Partenariats</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php#actualites" class="active">Actualités</a></li>
                    <li><a href="index.php#ufa">UFA</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                    <li><a href="vie-lyceenne.php">Vie Lycéenne</a></li>
                </ul>
                <button class="menu-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <main>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php else: ?>
            <article class="actualite-detail">
                <header class="actualite-header">
                    <!-- Bouton retour -->
                    <a href="index.php#actualites" class="back-home">
                        <i class="fas fa-arrow-left"></i>
                        <span>Retour aux actualités</span>
                    </a>
                    
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
                    <img src="<?php echo htmlspecialchars($actualite['image']); ?>" alt="<?php echo htmlspecialchars($actualite['titre']); ?>">
                </div>
                <?php endif; ?>
                
                <div class="actualite-content container">
                    <div class="actualite-text">
                        <?php echo nl2br(htmlspecialchars($actualite['contenu'])); ?>
                    </div>
                    
                    <div class="share-buttons">
                        <h3>Partager cette actualité</h3>
                        <div class="social-links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="social-link facebook" aria-label="Partager sur Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($actualite['titre']); ?>" target="_blank" class="social-link twitter" aria-label="Partager sur Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="mailto:?subject=<?php echo urlencode($actualite['titre'] . ' - Lycée Jean Mermoz'); ?>&body=<?php echo urlencode('Découvrez cette actualité du Lycée Jean Mermoz : ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" class="social-link email" aria-label="Partager par e-mail">
                                <i class="fas fa-envelope"></i>
                            </a>
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
                            $stmt = $db->prepare("SELECT * FROM actualites WHERE id != :id ORDER BY date_publication DESC LIMIT 3");
                            $stmt->execute(['id' => $id]);
                            $related_actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
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
                                    <img src="<?php echo htmlspecialchars($related_actualite['image']); ?>" alt="<?php echo htmlspecialchars($related_actualite['titre']); ?>">
                                </div>
                                <div class="related-content">
                                    <span class="related-tag"><?php echo htmlspecialchars($related_actualite['categorie']); ?></span>
                                    <h3><?php echo htmlspecialchars($related_actualite['titre']); ?></h3>
                                    <time datetime="<?php echo $related_actualite['date_publication']; ?>"><?php echo $rel_date_fr; ?></time>
                                    <a href="actualite.php?id=<?php echo $related_actualite['id']; ?>" class="read-more">Lire la suite</a>
                                </div>
                            </article>
                        <?php 
                            endforeach;
                        } catch (PDOException $e) {
                            echo "<p>Impossible de charger les actualités similaires.</p>";
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <img src="images/logos/LOGO-UFA-MERMOZ-1.jpg" alt="Logo UFA Jean-Mermoz" class="footer-logo">
                    <p>&copy; 2024 Lycée Jean Mermoz - Saint-Louis</p>
                </div>
                <div class="footer-links">
                    <a href="#">Mentions légales</a>
                    <a href="#">Accessibilité</a>
                    <a href="#">Plan du site</a>
                </div>
            </div>
        </div>
    </footer>

    <button class="theme-toggle" aria-label="Basculer le mode sombre">
        <i class="fas fa-moon"></i>
    </button>

    <script src="js/script.js"></script>
</body>
</html> 
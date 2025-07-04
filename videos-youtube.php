<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vidéos YouTube - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/videos-youtube.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <?php
    // Connexion à la base de données
    require_once 'includes/db_connect.php';
    
    // Filtrage par catégorie
    $categorie_filter = isset($_GET['categorie']) ? $_GET['categorie'] : '';
    
    // Récupération des vidéos actives
    try {
        $sql = "SELECT * FROM videos_youtube WHERE actif = 1";
        $params = [];
        
        if (!empty($categorie_filter)) {
            $sql .= " AND categorie = :categorie";
            $params[':categorie'] = $categorie_filter;
        }
        
        $sql .= " ORDER BY ordre_affichage ASC, date_ajout DESC";
        
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Récupération des catégories pour le filtre
        $categories_stmt = $db->query("SELECT DISTINCT categorie FROM videos_youtube WHERE actif = 1 ORDER BY categorie");
        $categories = $categories_stmt->fetchAll(PDO::FETCH_COLUMN);
        
    } catch (PDOException $e) {
        $videos = [];
        $categories = [];
        $error_message = "Erreur lors de la récupération des vidéos : " . $e->getMessage();
    }
    
    // Fonction pour générer l'URL d'embed YouTube
    function generateEmbedUrl($video_id) {
        return "https://www.youtube.com/embed/" . $video_id;
    }
    
    // Fonction pour générer l'URL de thumbnail YouTube
    function generateThumbnailUrl($video_id) {
        return "https://img.youtube.com/vi/" . $video_id . "/maxresdefault.jpg";
    }
    ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à l'accueil</span>
        </a>

        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h1>Vidéos YouTube du Lycée</h1>
                    <p class="hero-subtitle">Découvrez nos vidéos de présentation, événements et formations</p>
                </div>
            </div>
        </section>

        <!-- Section Filtres -->
        <section class="filters-section">
            <div class="container">
                <div class="filters-container">
                    <h2>Filtrer par catégorie</h2>
                    <div class="filter-buttons">
                        <a href="videos-youtube.php" class="filter-btn <?= empty($categorie_filter) ? 'active' : '' ?>">
                            Toutes les vidéos
                        </a>
                        <?php foreach ($categories as $cat): ?>
                            <a href="videos-youtube.php?categorie=<?= urlencode($cat) ?>" 
                               class="filter-btn <?= $categorie_filter === $cat ? 'active' : '' ?>">
                                <?= htmlspecialchars($cat) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Vidéos -->
        <section class="videos-section">
            <div class="container">
                <?php if (empty($videos)): ?>
                    <div class="no-videos">
                        <i class="fas fa-video-slash"></i>
                        <h3>Aucune vidéo trouvée</h3>
                        <p><?= !empty($categorie_filter) ? "Aucune vidéo dans la catégorie \"$categorie_filter\"" : "Aucune vidéo disponible pour le moment" ?></p>
                        <?php if (!empty($categorie_filter)): ?>
                            <a href="videos-youtube.php" class="btn btn-primary">Voir toutes les vidéos</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="videos-grid">
                        <?php foreach ($videos as $video): ?>
                            <div class="video-card" data-video-id="<?= $video['video_id'] ?>">
                                <div class="video-thumbnail">
                                    <img src="<?= generateThumbnailUrl($video['video_id']) ?>" 
                                         alt="<?= htmlspecialchars($video['titre']) ?>"
                                         onerror="this.src='https://img.youtube.com/vi/<?= $video['video_id'] ?>/0.jpg'">
                                    <div class="video-overlay">
                                        <button class="play-button" onclick="playVideo('<?= $video['video_id'] ?>', '<?= htmlspecialchars($video['titre']) ?>')">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    </div>
                                    <div class="video-duration">
                                        <i class="fab fa-youtube"></i>
                                    </div>
                                </div>
                                <div class="video-info">
                                    <h3><?= htmlspecialchars($video['titre']) ?></h3>
                                    <div class="video-meta">
                                        <span class="video-category"><?= htmlspecialchars($video['categorie']) ?></span>
                                        <?php if ($video['date_publication']): ?>
                                            <span class="video-date"><?= date('d/m/Y', strtotime($video['date_publication'])) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($video['description'])): ?>
                                        <p class="video-description"><?= htmlspecialchars($video['description']) ?></p>
                                    <?php endif; ?>
                                    <div class="video-actions">
                                        <button class="btn btn-primary" onclick="playVideo('<?= $video['video_id'] ?>', '<?= htmlspecialchars($video['titre']) ?>')">
                                            <i class="fas fa-play"></i> Regarder
                                        </button>
                                        <a href="<?= $video['url_youtube'] ?>" target="_blank" class="btn btn-secondary">
                                            <i class="fab fa-youtube"></i> YouTube
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Modal pour la lecture vidéo -->
    <div id="videoModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Titre de la vidéo</h3>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="video-container">
                    <iframe id="videoFrame" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>

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

    <script>
    // Fonction pour ouvrir la modal et lire la vidéo
    function playVideo(videoId, title) {
        const modal = document.getElementById('videoModal');
        const modalTitle = document.getElementById('modalTitle');
        const videoFrame = document.getElementById('videoFrame');
        
        modalTitle.textContent = title;
        videoFrame.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
        
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Empêcher le scroll
    }
    
    // Fonction pour fermer la modal
    function closeModal() {
        const modal = document.getElementById('videoModal');
        const videoFrame = document.getElementById('videoFrame');
        
        videoFrame.src = ''; // Arrêter la vidéo
        modal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Réactiver le scroll
    }
    
    // Fermer la modal en cliquant en dehors
    window.onclick = function(event) {
        const modal = document.getElementById('videoModal');
        if (event.target === modal) {
            closeModal();
        }
    }
    
    // Fermer la modal avec la touche Échap
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
    
    // Animation d'apparition des cartes vidéo
    document.addEventListener('DOMContentLoaded', function() {
        const videoCards = document.querySelectorAll('.video-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });
        
        videoCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    });
    </script>
</body>
</html> 
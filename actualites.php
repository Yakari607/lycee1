<?php
// Connexion à la base de données
require_once 'includes/db_connect.php';

// Pagination
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 9; // Nombre d'actualités par page
$offset = ($page - 1) * $limit;

// Filtrage par catégorie
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Récupération des actualités
try {
    // Requête de base
    $sql = "SELECT * FROM actualites";
    $params = [];
    
    // Ajout du filtre par catégorie si spécifié
    if (!empty($category)) {
        $sql .= " WHERE categorie = :category";
        $params['category'] = $category;
    }
    
    // Ajout de l'ordre et de la pagination
    $sql .= " ORDER BY date_publication DESC LIMIT :limit OFFSET :offset";
    $params['limit'] = $limit;
    $params['offset'] = $offset;
    
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Compter le nombre total d'actualités pour la pagination
    $count_sql = "SELECT COUNT(*) FROM actualites";
    if (!empty($category)) {
        $count_sql .= " WHERE categorie = :category";
    }
    $count_stmt = $db->prepare($count_sql);
    if (!empty($category)) {
        $count_stmt->execute(['category' => $category]);
    } else {
        $count_stmt->execute();
    }
    $total_actualites = $count_stmt->fetchColumn();
    $total_pages = ceil($total_actualites / $limit);
    
    // Récupération des catégories pour le filtre
    $categories_stmt = $db->query("SELECT DISTINCT categorie FROM actualites ORDER BY categorie");
    $categories = $categories_stmt->fetchAll(PDO::FETCH_COLUMN);
    
} catch (PDOException $e) {
    $actualites = [];
    $categories = [];
    $error_message = "Erreur lors de la récupération des actualités: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualités - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/actualite.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body data-page="actualites">
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à l'accueil</span>
        </a>

        <section class="actualites-hero">
            <div class="hero-content">
                <h1><i class="fas fa-newspaper"></i> Actualités</h1>
                <p>Toute l'actualité du Lycée Jean-Mermoz</p>
            </div>
        </section>

        <div class="container">
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <!-- Filtres -->
            <div class="filters-section">
                <h2>Filtrer par catégorie</h2>
                <div class="filter-buttons">
                    <a href="actualites.php" class="filter-btn <?php echo empty($category) ? 'active' : ''; ?>">
                        <i class="fas fa-list"></i> Toutes les actualités
                    </a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="actualites.php?category=<?php echo urlencode($cat); ?>" 
                           class="filter-btn <?php echo $category === $cat ? 'active' : ''; ?>">
                            <i class="fas fa-tag"></i> <?php echo htmlspecialchars($cat); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Grille des actualités -->
            <section class="actualites-grid-section">
                <?php if (empty($actualites)): ?>
                    <div class="no-results">
                        <i class="fas fa-newspaper"></i>
                        <h3>Aucune actualité trouvée</h3>
                        <p>Il n'y a pas d'actualités à afficher pour le moment<?php echo !empty($category) ? ' dans cette catégorie' : ''; ?>.</p>
                    </div>
                <?php else: ?>
                    <div class="results-info">
                        <p><i class="fas fa-info-circle"></i> 
                        <?php echo count($actualites); ?> actualité<?php echo count($actualites) > 1 ? 's' : ''; ?> 
                        <?php echo !empty($category) ? 'dans la catégorie "' . htmlspecialchars($category) . '"' : 'au total'; ?>
                        </p>
                    </div>
                    
                    <div class="actualites-grid">
                    <?php foreach ($actualites as $actualite): ?>
                        <?php
                        // Formatage de la date
                        $date = new DateTime($actualite['date_publication']);
                        $date_fr = $date->format('j F Y');
                        $date_fr = str_replace(
                            ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                            ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
                            $date_fr
                        );
                        ?>
                            <article class="actualite-card <?php echo isset($actualite['is_important']) && $actualite['is_important'] ? 'important' : ''; ?>">
                            <div class="card-image">
                                <?php if (!empty($actualite['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($actualite['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($actualite['titre']); ?>" 
                                             loading="lazy">
                                <?php else: ?>
                                    <div class="no-image">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="card-category">
                                        <i class="fas fa-tag"></i>
                                    <?php echo htmlspecialchars($actualite['categorie']); ?>
                                </div>
                                    <?php if (isset($actualite['is_important']) && $actualite['is_important']): ?>
                                        <div class="important-badge">
                                            <i class="fas fa-star"></i>
                                        </div>
                                    <?php endif; ?>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">
                                    <a href="actualite.php?id=<?php echo $actualite['id']; ?>">
                                        <?php echo htmlspecialchars($actualite['titre']); ?>
                                    </a>
                                </h3>
                                <div class="card-meta">
                                    <time datetime="<?php echo $actualite['date_publication']; ?>">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo $date_fr; ?>
                                    </time>
                                </div>
                                <div class="card-excerpt">
                                    <?php 
                                    $excerpt = substr(strip_tags($actualite['contenu']), 0, 150);
                                    echo htmlspecialchars($excerpt);
                                    if (strlen($actualite['contenu']) > 150) echo '...';
                                    ?>
                                </div>
                                <a href="actualite.php?id=<?php echo $actualite['id']; ?>" class="read-more">
                                    Lire la suite <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <nav class="pagination" aria-label="Navigation des pages">
                    <ul class="pagination-list">
                        <?php if ($page > 1): ?>
                            <li>
                                <a href="actualites.php?page=<?php echo ($page - 1); ?><?php echo !empty($category) ? '&category=' . urlencode($category) : ''; ?>" 
                                   aria-label="Page précédente">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li>
                                <a href="actualites.php?page=<?php echo $i; ?><?php echo !empty($category) ? '&category=' . urlencode($category) : ''; ?>" 
                                   class="<?php echo $i === $page ? 'active' : ''; ?>"
                                   aria-label="Page <?php echo $i; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <li>
                                <a href="actualites.php?page=<?php echo ($page + 1); ?><?php echo !empty($category) ? '&category=' . urlencode($category) : ''; ?>" 
                                   aria-label="Page suivante">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </main>

    <!-- Scripts -->
    <script src="js/script.js"></script>
    <script>
        // Animation d'apparition des cartes
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.actualite-card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                        observer.unobserve(entry.target);
                    }
                });
            });
            
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>

    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>
</body>
</html> 
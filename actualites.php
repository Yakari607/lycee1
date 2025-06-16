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
    <link rel="stylesheet" href="css/pages/formation.css">
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

        <section class="formation-hero">
            <div class="hero-content">
                <h1>Actualités</h1>
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
                        Toutes les actualités
                    </a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="actualites.php?category=<?php echo urlencode($cat); ?>" 
                           class="filter-btn <?php echo $category === $cat ? 'active' : ''; ?>">
                            <?php echo htmlspecialchars($cat); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Grille des actualités -->
            <section class="actualites-grid">
                <?php if (empty($actualites)): ?>
                    <div class="no-results">
                        <i class="fas fa-newspaper"></i>
                        <h3>Aucune actualité trouvée</h3>
                        <p>Il n'y a pas d'actualités à afficher pour le moment.</p>
                    </div>
                <?php else: ?>
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
                        <article class="actualite-card">
                            <div class="card-image">
                                <?php if (!empty($actualite['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($actualite['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($actualite['titre']); ?>">
                                <?php else: ?>
                                    <div class="no-image">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="card-category">
                                    <?php echo htmlspecialchars($actualite['categorie']); ?>
                                </div>
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

    <style>
        .filters-section {
            margin: 3rem 0;
            text-align: center;
        }

        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .filter-btn {
            padding: 0.75rem 1.5rem;
            background: var(--white);
            color: var(--text-color);
            text-decoration: none;
            border: 2px solid var(--border-color);
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .actualites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .actualite-card {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .actualite-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }

        .card-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .actualite-card:hover .card-image img {
            transform: scale(1.05);
        }

        .no-image {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            background: var(--gray-light);
            color: var(--text-muted);
        }

        .no-image i {
            font-size: 3rem;
        }

        .card-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-title {
            margin: 0 0 0.75rem 0;
            font-size: 1.25rem;
            line-height: 1.4;
        }

        .card-title a {
            color: var(--text-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .card-title a:hover {
            color: var(--primary-color);
        }

        .card-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .card-excerpt {
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .read-more:hover {
            color: var(--primary-dark);
        }

        .read-more i {
            transition: transform 0.3s ease;
        }

        .read-more:hover i {
            transform: translateX(5px);
        }

        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .no-results i {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin: 3rem 0;
        }

        .pagination-list {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 0.5rem;
        }

        .pagination-list a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: var(--white);
            color: var(--text-color);
            text-decoration: none;
            border: 1px solid var(--border-color);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .pagination-list a:hover,
        .pagination-list a.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .actualites-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .filter-buttons {
                flex-direction: column;
                align-items: center;
            }

            .filter-btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>

    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>
</body>
</html> 
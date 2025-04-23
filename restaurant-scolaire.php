<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant scolaire - Lycée Jean Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/restaurant.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- En-tête -->
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
                    <li><a href="index.php#actualites">Actualités</a></li>
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

    <?php
    // Connexion à la base de données
    require_once 'includes/db_connect.php';
    
    // Récupération de la date de semaine (pour tous les jours)
    $stmt = $db->query("SELECT date_semaine FROM jours LIMIT 1");
    $date_semaine = $stmt->fetch(PDO::FETCH_COLUMN);
    
    // Récupération des jours de la semaine
    $stmt_jours = $db->query("SELECT id, jour FROM jours ORDER BY id");
    $jours = $stmt_jours->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <main>
        <!-- Bouton retour -->
        <a href="vie-lyceenne.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à la vie lycéenne</span>
        </a>

        <section class="restaurant-hero">
            <div class="hero-content">
                <h1>Restaurant scolaire</h1>
                <p>Une alimentation de qualité pour le bien-être de nos élèves</p>
            </div>
        </section>

        <section class="menu-section">
            <div class="container">
                <div class="intro-text">
                    <h2>Notre engagement pour une alimentation de qualité</h2>
                    <p>Notre restaurant scolaire propose chaque jour des menus équilibrés élaborés par une équipe professionnelle et attentive. Nous accordons une importance particulière à l'utilisation de produits frais, locaux et de saison. Notre objectif est d'offrir des repas savoureux tout en sensibilisant nos élèves à une alimentation saine et respectueuse de l'environnement.</p>
                    <div class="engagement-points">
                        <div class="engagement">
                            <i class="fas fa-carrot"></i>
                            <span>30% de produits bio</span>
                        </div>
                        <div class="engagement">
                            <i class="fas fa-leaf"></i>
                            <span>Circuits courts</span>
                        </div>
                        <div class="engagement">
                            <i class="fas fa-apple-alt"></i>
                            <span>Fruits & légumes de saison</span>
                        </div>
                        <div class="engagement">
                            <i class="fas fa-seedling"></i>
                            <span>Option végétarienne</span>
                        </div>
                    </div>
                </div>

                <div class="menu-tabs">
                    <div class="tab-buttons">
                        <?php foreach ($jours as $index => $jour): ?>
                            <button class="menu-tab-btn <?= ($index === 0) ? 'active' : '' ?>" data-day="<?= $jour['jour'] ?>"><?= ucfirst($jour['jour']) ?></button>
                        <?php endforeach; ?>
                    </div>

                    <div class="menu-date">
                        <h3>Menu du <span id="current-date"><?= $date_semaine ?></span></h3>
                    </div>

                    <!-- Menus par jour -->
                    <?php foreach ($jours as $index => $jour): ?>
                        <div class="menu-content <?= ($index === 0) ? 'active' : '' ?>" id="menu-<?= $jour['jour'] ?>">
                            <?php
                            // Récupération des catégories
                            $stmt_categories = $db->query("SELECT id, nom FROM categories ORDER BY id");
                            $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach ($categories as $categorie): 
                                // Récupération des repas pour ce jour et cette catégorie
                                $stmt_repas = $db->prepare("
                                    SELECT nom, bio, local, vegetarien 
                                    FROM repas 
                                    WHERE jour_id = :jour_id AND categorie_id = :categorie_id
                                ");
                                $stmt_repas->execute([
                                    ':jour_id' => $jour['id'],
                                    ':categorie_id' => $categorie['id']
                                ]);
                                $repas = $stmt_repas->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                                <div class="meal-category">
                                    <h4><?= $categorie['nom'] ?></h4>
                                    <ul class="meal-items">
                                        <?php foreach ($repas as $plat): ?>
                                            <li>
                                                <?= $plat['nom'] ?>
                                                <?php if ($plat['bio']): ?>
                                                    <span class="bio-label">Bio</span>
                                                <?php endif; ?>
                                                <?php if ($plat['local']): ?>
                                                    <span class="local-label">Local</span>
                                                <?php endif; ?>
                                                <?php if ($plat['vegetarien']): ?>
                                                    <span class="veggie-label">Végé</span>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="info-pratiques">
                    <h2>Informations pratiques</h2>
                    <div class="info-grid">
                        <div class="info-card">
                            <i class="fas fa-clock"></i>
                            <h3>Horaires</h3>
                            <ul>
                                <li>Lundi au vendredi : 11h30 - 13h30</li>
                                <li>Service continu</li>
                            </ul>
                        </div>
                        <div class="info-card">
                            <i class="fas fa-credit-card"></i>
                            <h3>Tarifs</h3>
                            <ul>
                                <li>Élèves : 3,80€ par repas</li>
                                <li>Forfait trimestre : consulter l'intendance</li>
                                <li>Personnel : 4,50€ par repas</li>
                            </ul>
                        </div>
                        <div class="info-card">
                            <i class="fas fa-user-plus"></i>
                            <h3>Inscription</h3>
                            <p>Inscriptions en ligne ou auprès de l'intendance.</p>
                            <a href="#" class="btn-secondary">Accéder au portail</a>
                        </div>
                        <div class="info-card">
                            <i class="fas fa-hand-holding-heart"></i>
                            <h3>Aide sociale</h3>
                            <p>Fonds social disponible pour les familles en difficulté. Contactez l'assistante sociale du lycée pour plus d'informations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
    <script>
        // Script pour gérer les onglets des menus
        document.addEventListener('DOMContentLoaded', function() {
            const menuTabs = document.querySelectorAll('.menu-tab-btn');
            const menuContents = document.querySelectorAll('.menu-content');
            
            menuTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Retirer la classe active de tous les onglets
                    menuTabs.forEach(t => t.classList.remove('active'));
                    
                    // Ajouter la classe active à l'onglet cliqué
                    tab.classList.add('active');
                    
                    // Masquer tous les contenus
                    menuContents.forEach(content => {
                        content.classList.remove('active');
                    });
                    
                    // Afficher le contenu correspondant
                    const dayId = tab.getAttribute('data-day');
                    document.getElementById(`menu-${dayId}`).classList.add('active');
                });
            });
        });
    </script>
</body>
</html> 
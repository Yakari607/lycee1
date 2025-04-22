<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La vie au lycée - Lycée Jean Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/vie-lyceenne.css">
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
                    <li><a href="vie-lyceenne.php" class="active">Vie Lycéenne</a></li>
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
        <!-- Ajout du bouton retour -->
        <a href="index.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à l'accueil</span>
        </a>

        <section class="vie-lyceenne-hero">
            <div class="hero-content">
                <h1>La vie au lycée</h1>
                <p>Découvrez les activités et services qui enrichissent votre vie lycéenne</p>
            </div>
        </section>

        <section class="activities-section">
            <div class="container">
                <div class="news-grid">
                    <!-- UNSS -->
                    <article class="news-card">
                        <div class="news-image">
                            <img src="images/activites/sport-_choisir_header_light.jpg" alt="UNSS">
                        </div>
                        <div class="news-content">
                            <span class="news-tag">Sport</span>
                            <h3>UNSS</h3>
                            <p>L'Union Nationale du Sport Scolaire propose des activités sportives variées tout au long de l'année. Participez à des compétitions, développez votre esprit d'équipe et dépassez-vous !</p>
                            <a href="#" class="read-more">En savoir plus</a>
                        </div>
                    </article>

                    <!-- Club Cinéma -->
                    <article class="news-card">
                        <div class="news-image">
                            <img src="images/activites/sala-cine.jpg" alt="Club Cinéma">
                        </div>
                        <div class="news-content">
                            <span class="news-tag">Culture</span>
                            <h3>Club Cinéma</h3>
                            <p>Découvrez le 7ème art à travers des projections, des analyses de films et des ateliers de création. Développez votre culture cinématographique et votre créativité.</p>
                            <a href="#" class="read-more">En savoir plus</a>
                        </div>
                    </article>

                    <!-- Café des langues -->
                    <article class="news-card"> 
                        <div class="news-image">
                            <img src="images/activites/cafe-bienfaits-inconvenients-6.jpg" alt="Café des langues">
                        </div>
                        <div class="news-content">
                            <span class="news-tag">Langues</span>
                            <h3>Café des langues</h3>
                            <p>Un espace d'échange multiculturel pour pratiquer les langues étrangères dans une ambiance conviviale. Améliorez vos compétences linguistiques en situation réelle.</p>
                            <a href="#" class="read-more">En savoir plus</a>
                        </div>
                    </article>

                    <!-- Restaurant scolaire -->
                    <article class="news-card">
                        <div class="news-image">
                            <img src="images/activites/Restauration-scolaire.png" alt="Restaurant scolaire">
                        </div>
                        <div class="news-content">
                            <span class="news-tag">Service</span>
                            <h3>Le restaurant scolaire</h3>
                            <p>Une restauration de qualité avec des menus équilibrés et variés. Notre équipe de restauration s'engage à vous proposer des repas sains et savoureux.</p>
                            <a href="#" class="read-more">En savoir plus</a>
                        </div>
                    </article>

                    <!-- Internat -->
                    <article class="news-card">
                        <div class="news-image">
                            <img src="images/activites/-tablissement-internat-guez-balzac-17224.jpg" alt="L'internat">
                        </div>
                        <div class="news-content">
                            <span class="news-tag">Hébergement</span>
                            <h3>L'internat</h3>
                            <p>Un cadre de vie adapté pour la réussite de vos études. Bénéficiez d'un environnement propice au travail et d'un accompagnement personnalisé.</p>
                            <a href="#" class="read-more">En savoir plus</a>
                        </div>
                    </article>
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
</body>
</html>
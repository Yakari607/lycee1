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
                        <button class="menu-tab-btn active" data-day="lundi">Lundi</button>
                        <button class="menu-tab-btn" data-day="mardi">Mardi</button>
                        <button class="menu-tab-btn" data-day="mercredi">Mercredi</button>
                        <button class="menu-tab-btn" data-day="jeudi">Jeudi</button>
                        <button class="menu-tab-btn" data-day="vendredi">Vendredi</button>
                    </div>

                    <div class="menu-date">
                        <h3>Menu du <span id="current-date">15 au 19 juillet 2024</span></h3>
                    </div>

                    <!-- Menus par jour -->
                    <div class="menu-content active" id="menu-lundi">
                        <div class="meal-category">
                            <h4>Entrées</h4>
                            <ul class="meal-items">
                                <li>Salade de tomates et mozzarella <span class="bio-label">Bio</span></li>
                                <li>Terrine de légumes</li>
                                <li>Carottes râpées aux agrumes <span class="local-label">Local</span></li>
                            </ul>
                        </div>

                        <div class="meal-category">
                            <h4>Plats</h4>
                            <ul class="meal-items">
                                <li>Filet de poulet à la provençale <span class="local-label">Local</span></li>
                                <li>Boulettes végétariennes aux légumes <span class="veggie-label">Végé</span></li>
                                <li>Accompagnement : Ratatouille et riz basmati <span class="bio-label">Bio</span></li>
                            </ul>
                        </div>

                        <div class="meal-category">
                            <h4>Fromages & Laitages</h4>
                            <ul class="meal-items">
                                <li>Yaourt nature <span class="bio-label">Bio</span></li>
                                <li>Comté AOP</li>
                                <li>Fromage blanc</li>
                            </ul>
                        </div>

                        <div class="meal-category">
                            <h4>Desserts</h4>
                            <ul class="meal-items">
                                <li>Fruit de saison <span class="bio-label">Bio</span></li>
                                <li>Tarte aux pommes</li>
                                <li>Compote de fruits</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Répéter pour les autres jours avec des menus différents -->
                    <div class="menu-content" id="menu-mardi">
                        <!-- Contenu pour mardi -->
                        <div class="meal-category">
                            <h4>Entrées</h4>
                            <ul class="meal-items">
                                <li>Taboulé à la menthe <span class="bio-label">Bio</span></li>
                                <li>Salade de concombres</li>
                                <li>Betteraves en vinaigrette <span class="local-label">Local</span></li>
                            </ul>
                        </div>

                        <div class="meal-category">
                            <h4>Plats</h4>
                            <ul class="meal-items">
                                <li>Lasagnes à la bolognaise</li>
                                <li>Gratin de légumes et pois chiches <span class="veggie-label">Végé</span></li>
                                <li>Accompagnement : Salade verte <span class="bio-label">Bio</span></li>
                            </ul>
                        </div>

                        <div class="meal-category">
                            <h4>Fromages & Laitages</h4>
                            <ul class="meal-items">
                                <li>Petit suisse</li>
                                <li>Brie</li>
                                <li>Fromage blanc aux fruits</li>
                            </ul>
                        </div>

                        <div class="meal-category">
                            <h4>Desserts</h4>
                            <ul class="meal-items">
                                <li>Fruit de saison <span class="local-label">Local</span></li>
                                <li>Mousse au chocolat</li>
                                <li>Crème caramel</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Répéter ce bloc pour mercredi, jeudi et vendredi -->
                    <div class="menu-content" id="menu-mercredi">
                        <!-- Contenu similaire avec menus différents -->
                    </div>

                    <div class="menu-content" id="menu-jeudi">
                        <!-- Contenu similaire avec menus différents -->
                    </div>

                    <div class="menu-content" id="menu-vendredi">
                        <!-- Contenu similaire avec menus différents -->
                    </div>
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
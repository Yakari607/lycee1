<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNSS - Union Nationale du Sport Scolaire - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/vie-lyceenne.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Styles spécifiques à la page UNSS */
        .unss-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .unss-intro {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        .unss-intro h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }
        
        .unss-intro p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .unss-section {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        .unss-section h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }
        
        .unss-section h3 i {
            margin-right: 0.75rem;
        }
        
        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .activity-item {
            background-color: var(--gray-light);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .activity-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        
        .activity-item i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .activity-item h4 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .info-card {
            background-color: var(--gray-light);
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }
        
        .info-card h4 {
            color: var(--primary-color);
            margin-bottom: 0.75rem;
            font-size: 1.2rem;
        }
        
        .info-card p {
            margin-bottom: 0.5rem;
        }
        
        .info-card ul {
            padding-left: 1.5rem;
            margin-top: 0.5rem;
        }
        
        .info-card li {
            margin-bottom: 0.5rem;
        }
        
        .highlight-box {
            background: linear-gradient(135deg, var(--primary-color) 0%, #000066 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin: 2rem 0;
            text-align: center;
        }
        
        .highlight-box h3 {
            color: white;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .highlight-box p {
            font-size: 1.2rem;
            margin-bottom: 0;
        }
        
        @media (max-width: 768px) {
            .unss-content {
                padding: 1rem;
            }
            
            .activities-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="vie-lyceenne.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à la vie lycéenne</span>
        </a>

        <section class="vie-lyceenne-hero" style="background: url('images/activites/sport-_choisir_header_light.jpg'); background-size: cover; background-position: center;">
            <div class="hero-content">
                <h1>U.N.S.S.</h1>
                <p>Union Nationale du Sport Scolaire</p>
            </div>
        </section>

        <div class="unss-content">
            <section class="unss-intro">
                <h2>L'Association Sportive : Union Nationale du Sport Scolaire</h2>
                <p>L'UNSS est le club sportif du lycée encadré par les professeurs d'EPS. Elle propose une multitude d'activités sportives adaptées à tous les niveaux et à toutes les envies. Que vous soyez débutant ou confirmé, venez découvrir le plaisir du sport dans une ambiance conviviale et dynamique.</p>
            </section>

            <section class="unss-section">
                <h3><i class="fas fa-running"></i> Les activités proposées</h3>
                <p>Un large choix d'activités sportives est proposé tout au long de l'année :</p>
                
                <div class="activities-grid">
                    <div class="activity-item">
                        <i class="fas fa-running"></i>
                        <h4>Athlétisme</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-fist-raised"></i>
                        <h4>Boxe française</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-heartbeat"></i>
                        <h4>Cocktail Forme</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-dumbbell"></i>
                        <h4>Musculation</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-shoe-prints"></i>
                        <h4>Step</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-table-tennis"></i>
                        <h4>Badminton</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-table-tennis"></i>
                        <h4>Tennis de Table</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-basketball-ball"></i>
                        <h4>Basket-ball</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-futbol"></i>
                        <h4>Football</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-volleyball-ball"></i>
                        <h4>Hand-ball</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-football-ball"></i>
                        <h4>Rugby</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-volleyball-ball"></i>
                        <h4>Volley-ball</h4>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-music"></i>
                        <h4>Zumba</h4>
                    </div>
                </div>
                
                <div class="info-card" style="margin-top: 2rem;">
                    <h4>Activités sur demande</h4>
                    <p>Pour les activités suivantes, veuillez contacter vos professeurs d'EPS :</p>
                    <ul>
                        <li>VTT</li>
                        <li>Escalade</li>
                        <li>Judo</li>
                        <li>Gym Sportive</li>
                        <li>Acrosport</li>
                        <li>GR</li>
                        <li>Golf</li>
                        <li>Poneygames</li>
                    </ul>
                </div>
            </section>

            <div class="highlight-box">
                <h3>Le plus de l'UNSS</h3>
                <p>Formation à l'arbitrage dans toutes ces activités</p>
                <p>Rencontres avec les autres lycées certains mercredis après-midi</p>
            </div>

            <section class="unss-section">
                <h3><i class="fas fa-layer-group"></i> Les différents niveaux</h3>
                
                <div class="info-grid">
                    <div class="info-card">
                        <h4>Sportif</h4>
                        <p>Compétitions par équipe jusqu'aux qualifications aux championnats de France</p>
                    </div>
                    <div class="info-card">
                        <h4>Perfectionnement</h4>
                        <p>Préparation au baccalauréat</p>
                    </div>
                    <div class="info-card">
                        <h4>Loisir</h4>
                        <p>Pratique sportive sans pression, pour le plaisir et la détente</p>
                    </div>
                </div>
            </section>

            <section class="unss-section">
                <h3><i class="fas fa-info-circle"></i> Informations pratiques</h3>
                
                <div class="info-grid">
                    <div class="info-card">
                        <h4>Lieux</h4>
                        <ul>
                            <li>Au gymnase du lycée</li>
                            <li>Dans la salle de musculation de l'internat</li>
                            <li>Au stade de la Frontière à la belle saison</li>
                        </ul>
                    </div>
                    <div class="info-card">
                        <h4>Horaires</h4>
                        <p>Tous les jours entre midi et deux, et en soirée à partir de 17h45.</p>
                    </div>
                    <div class="info-card">
                        <h4>Tarif</h4>
                        <p>20 Euros la licence qui ouvre la porte à toutes les activités.</p>
                    </div>
                </div>
            </section>

            <div class="highlight-box" style="background: linear-gradient(135deg, #28a745 0%, #218838 100%);">
                <h3>Rejoignez-nous !</h3>
                <p>Toute l'équipe des professeurs d'EPS vous attend</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-info">
                <img src="images/logos/LOGO-UFA-MERMOZ-1.jpg" alt="Logo UFA Jean-Mermoz" class="footer-logo">
                <p>&copy; 2024 Lycée Jean-Mermoz - Saint-Louis</p>
            </div>
            <div class="footer-links">
                <a href="#">Mentions légales</a>
                <a href="#">Accessibilité</a>
                <a href="#">Plan du site</a>
                <a href="admin/login.php">Administration</a>
            </div>
        </div>
    </div>
</footer>

<button class="theme-toggle" aria-label="Basculer le mode sombre">
    <i class="fas fa-moon"></i>
</button>
    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>

</body>
</html>

    <script src="js/script.js"></script>
    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>

</body>
</html> 
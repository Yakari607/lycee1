<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partenariats - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/partenariats.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .partenariat-hero {
            height: 400px;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/formations/pexels-fauxels-3184398.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }
        
        .partenariat-section {
            position: relative;
            background-color: var(--background-color);
            z-index: 1;
        }
        
        .partenariat-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('images/logos/trench_group_logo.jpeg'), url('images/logos/staubli-black.png'), url('images/logos/crostar.png');
            background-position: 5% 15%, 95% 85%, 50% 50%;
            background-repeat: no-repeat;
            background-size: 15%, 15%, 15%;
            opacity: 0.03;
            z-index: 0;
            pointer-events: none;
        }
        
        @media (max-width: 768px) {
            .partenariat-hero {
                background-attachment: scroll;
            }
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <div class="partenariat-bg"></div>

    <main>
        <!-- Bouton retour -->
        <a href="index.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à l'accueil</span>
        </a>

        <section class="partenariat-hero">
            <div class="hero-content">
                <h1>Nos partenariats</h1>
                <p>Des liens solides avec le monde professionnel pour la réussite de nos élèves</p>
            </div>
        </section>

        <section class="partenariat-section">
            <div class="container">
                <!-- Introduction -->
                <div class="intro">
                    <h2>Les types de partenariat</h2>
                    <div class="partenariat-types">
                        <div class="type-card">
                            <i class="fas fa-handshake"></i>
                            <h3>Formation globale</h3>
                            <p>Partenariats durables et structurels avec des entreprises clés de notre écosystème</p>
                        </div>
                        <div class="type-card">
                            <i class="fas fa-project-diagram"></i>
                            <h3>Projet/Stage</h3>
                            <p>Collaborations ciblées autour de projets spécifiques et d'accueil de stagiaires</p>
                        </div>
                        <div class="type-card">
                            <i class="fas fa-industry"></i>
                            <h3>Sections professionnelles</h3>
                            <p>Entreprises partenaires spécifiques à nos différentes sections professionnelles</p>
                        </div>
                    </div>
                </div>

                <!-- Rôle d'un partenariat -->
                <div class="role-partenariat">
                    <h2>Rôle d'un partenariat</h2>
                    <div class="role-grid">
                        <div class="role-card">
                            <i class="fas fa-exchange-alt"></i>
                            <p>Favoriser les échanges avec les entreprises pour tendre vers une relation et des échanges constructifs entre les différents intervenants : DRH, tuteurs, enseignants, étudiants, élèves…</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-info-circle"></i>
                            <p>Informer sur les métiers, les diplômes professionnels et leurs évolutions</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-tools"></i>
                            <p>Construire des projets de formation</p>
                        </div>
                        <div class="role-card">
                            <i class="fas fa-users"></i>
                            <p>Réfléchir sur le rôle de chacun des acteurs de la formation</p>
                        </div>
                    </div>

                    <div class="cooperation">
                        <h3>Coopération technique</h3>
                        <p>La convention de partenariat, signée entre les deux parties, est l'aboutissement d'une réflexion sur l'implication pédagogique de formation de l'élève, de l'étudiant. Elle s'inscrit dans la durée et se traduit par des visites d'entreprises, des interventions (conférences), des propositions de stages, des bilans…</p>
                    </div>
                </div>

                <!-- Formation globale -->
                <div class="partenaires-section">
                    <h2>Nos partenaires « formation globale »</h2>
                    <p class="section-intro">Dans le cadre des stages en entreprises, une relation de partenariat plus ponctuel se noue entre le lycée et les tuteurs. Le partenariat se renouvelle souvent tacitement pendant quelques années.</p>
                    
                    <h3>BTS GOP</h3>
                    <div class="partenaires-grid">
                        <div class="partenaire-card">
                            <div class="logo-container">
                                <img src="images/logos/PNP-footer.png" alt="Photon&polymers" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>« Photon&polymers » à Lutterbach</h4>
                                <p class="tagline">Quand la lumière rencontre la matière</p>
                                <p>Le projet étudiants : réalisation d'un système de micro-stéréolithographie</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card">
                            <div class="logo-container">
                                <img src="images/logos/S0-diesel-psa-peugeot-citroen-propose-sa-solution-a-l-europe-107370.jpg" alt="PSA Peugeot-Citroen" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>« PSA Peugeot-Citroen » à Mulhouse</h4>
                            </div>
                        </div>
                        
                        <div class="partenaire-card">
                            <div class="logo-container">
                                <img src="images/logos/free-photo-of-oiseau-bec-tete-exotique.jpeg" alt="CALAOS" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>« CALAOS » à Bartenheim</h4>
                            </div>
                        </div>
                        
                        <div class="partenaire-card">
                            <div class="logo-container">
                                <img src="images/logos/1606814501582.jpeg" alt="KRIKO Engineering" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>« KRIKO Engineering » à Bâle</h4>
                            </div>
                        </div>
                    </div>
                    
                    <h3>BTS TC</h3>
                    <div class="partenaires-grid">
                        <div class="partenaire-card">
                            <div class="logo-container icon-only">
                                <i class="fas fa-industry icon-main"></i>
                            </div>
                            <div class="partenaire-content">
                                <h4>« AERE » à Habsheim</h4>
                            </div>
                        </div>
                        
                        <div class="partenaire-card">
                            <div class="logo-container icon-only">
                                <i class="fas fa-tools icon-main"></i>
                            </div>
                            <div class="partenaire-content">
                                <h4>« BALTZINGER » à Saint-Louis et Illzach</h4>
                            </div>
                        </div>
                    </div>
                    
                    <h3>Pass ingénieur, un enseignement d'exploration de 2de</h3>
                    <div class="partenaires-grid">
                        <div class="partenaire-card sdis-card">
                            <div class="logo-container full-image sdis-image">
                                <img src="images/logos/le-commandant-alain-bettinger-(a-g-)-et-le-capitaine-gilles-higelin-du-centre-de-secours-principal-de-saint-louis-sont-fiers-du-travail-accompli-par-leurs-equipes-photo-l-alsace-nadine-muller-1617785636.jpg" alt="SDIS de ST LOUIS" class="partenaire-logo">
                                <div class="sdis-overlay">
                                    <h4>« SDIS de ST LOUIS », sauveteurs nautiques</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projet/Stage -->
                <div class="partenaires-section">
                    <h2>Nos partenaires « projet/stage »</h2>
                    <div class="partenaires-grid">
                        <div class="partenaire-card">
                            <div class="logo-container full-image">
                                <img src="images/logos/Endress+Hauser_Logo.jpg" alt="ENDRESS+HAUSER" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>« ENDRESS+HAUSER »</h4>
                                <p>Une convention de partenariat est signée chaque année avec la société « Endress+hauser » et la licence pro GPI management de la qualité option métrologie du lycée Mermoz. Les étudiants visitent les différents sites de la société.</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card">
                            <div class="logo-container full-image">
                                <img src="images/logos/S0-diesel-psa-peugeot-citroen-propose-sa-solution-a-l-europe-107370.jpg" alt="PSA Peugeot-Citroen" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>« PSA Peugeot-Citroen »</h4>
                                <p>Une convention de partenariat a été signée mardi 08 novembre 2011 entre le lycée MERMOZ et le centre technique de PSA Peugeot-Citroen BELCHAMP (25). Elle concerne la section des techniciens supérieurs « Traitement des matériaux »</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sections professionnelles -->
                <div class="partenaires-section">
                    <h2>Nos partenaires « sections professionnelles »</h2>
                    <p class="section-intro">Les signataires d'une convention de partenariat en 2023/24 :</p>
                    
                    <div class="partenaires-grid large-grid">
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/lise.jpeg" alt="ASSOCIATION LES LYS D'ARGENT" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>ASSOCIATION LES LYS D'ARGENT</h4>
                                <p class="sections">Cap AAGA</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/barisol.png" alt="BARRISOL" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>BARRISOL</h4>
                                <p class="sections">Bac Pro TRPM et MSPC</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/crit.png" alt="CRIT'INTERIM" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>CRIT'INTERIM</h4>
                                <p class="sections">Toutes sections</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/images.png" alt="CRYOSTAR" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>CRYOSTAR</h4>
                                <p class="sections">Bac Pro Industriels</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/PICTO-APPLI-E.Leclerc.png" alt="E.LECLERC" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>E.LECLERC</h4>
                                <p class="sections">Bac Pro MCV, MCA et AGORA</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/airport-png-1155395377271rgs4invg.png" alt="EUROAIRPORT" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>EUROAIRPORT</h4>
                                <p class="sections">Bac Pro MSPC, MELEEC, AGORA, MC-Accueil</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/super-u.jpg" alt="HYPER U Sierentz" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>HYPER U Sierentz</h4>
                                <p class="sections">Bac Pro MCA et AGORA</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/Manpower-logo.png" alt="MANPOWER" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>MANPOWER</h4>
                                <p class="sections">Toutes sections</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/téléchargement.png" alt="RANDSTAD" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>RANDSTAD</h4>
                                <p class="sections">Toutes sections</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/images (3).png" alt="SIGVARIS" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>SIGVARIS</h4>
                                <p class="sections">Bac Pro MSPC</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/logo-sofitex.png" alt="SOFITEX" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>SOFITEX</h4>
                                <p class="sections">Toutes sections</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/staubli-black.png" alt="STAUBLI" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>STAUBLI</h4>
                                <p class="sections">Bac Pro TRPM</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/images (4).png" alt="STELLANTIS" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>STELLANTIS</h4>
                                <p class="sections">Bac Pro Industriels, BTS CPI</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/trench_group_logo.jpeg" alt="TRENCH" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>TRENCH</h4>
                                <p class="sections">Bac Pro Industriels</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/images (1).jpeg" alt="VILLE DE HUNINGUE" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>VILLE DE HUNINGUE</h4>
                                <p class="sections">Toutes sections</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/images (2).jpeg" alt="VILLE DE SAINT LOUIS" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>VILLE DE SAINT LOUIS</h4>
                                <p class="sections">Toutes sections</p>
                            </div>
                        </div>
                        
                        <div class="partenaire-card small">
                            <div class="logo-container">
                                <img src="images/logos/Weldom-Aizenay.jpg" alt="WELDOM" class="partenaire-logo">
                            </div>
                            <div class="partenaire-content">
                                <h4>WELDOM</h4>
                                <p class="sections">Bac Pro MCV et MCA, Cap EPC</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="contact-section">
                    <div class="contact-container">
                        <div class="contact-info">
                            <h2>Vous souhaitez devenir partenaire ?</h2>
                            <p>Vous bénéficiez d'un interlocuteur privilégié par domaine de spécialité, n'hésitez pas à le solliciter.</p>
                            <p>Pour un complément d'information contacter Emmanuel DANGEL, Responsable du Bureau des Entreprises:</p>
                            <a href="mailto:bde-lpo-jean-mermoz@ac-strasbourg.fr" class="contact-email">
                                <i class="fas fa-envelope"></i>
                                bde-lpo-jean-mermoz@ac-strasbourg.fr
                            </a>
                            <a href="#" class="btn-primary">Nous contacter</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    
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
</body>
</html> 
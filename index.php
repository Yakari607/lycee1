<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lycée Jean-Mermoz - Saint-Louis</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/index.css">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- Liens d'évitement pour la navigation clavier - RGAA 4 -->
    <div class="skip-links">
        <a href="#main" class="skip-link">Aller au contenu principal</a>
        <a href="#nav" class="skip-link">Aller à la navigation</a>
        <a href="#formations" class="skip-link">Aller aux formations</a>
        <a href="#contact" class="skip-link">Aller au formulaire de contact</a>
    </div>

<?php
    // Connexion à la base de données
    require_once 'includes/db_connect.php';
    
    // Récupération des actualités
    try {
        $stmt = $db->query("SELECT * FROM actualites ORDER BY date_publication DESC LIMIT 5");
        $actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $actualites = [];
        $error_message = "Erreur lors de la récupération des actualités: " . $e->getMessage();
    }
    ?>
    
    <!-- Navigation principale -->
    <?php include 'includes/navbar.php'; ?>


    <main id="main" role="main">
        <section class="hero">
            <div class="hero-content">
                <h1>Lycée Jean-Mermoz</h1>
                <p class="hero-subtitle">Un établissement d'excellence au service de la réussite de tous</p>
                <div class="cta-container">
                    <a href="#formations" class="cta-button">Découvrir nos filières</a>
                    <a href="#contact" class="cta-button secondary">Nous contacter</a>
                </div>
            </div>
        </section>

        <!-- Section Actualités -->
        <section class="news-section">
            <div class="container">
                <h2 class="section-title">Actualités</h2>
                
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                
                <?php if (!empty($actualites)): ?>
                    <div class="news-slider-container">
                        <button class="slider-nav prev" aria-label="Actualité précédente">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="news-grid-wrapper">
                            <div class="news-grid">
                                <?php foreach ($actualites as $actualite): 
                                    // Formatage de la date
                                    $date = new DateTime($actualite['date_publication']);
                                    $date_fr = $date->format('j F Y');
                                    $date_fr = str_replace(
                                        ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                        ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
                                        $date_fr
                                    );
                                ?>
                                    <article class="news-card <?php echo $actualite['is_important'] ? 'highlight' : ''; ?>">
                                        <div class="news-image">
                                            <img src="<?php echo htmlspecialchars($actualite['image']); ?>" alt="<?php echo htmlspecialchars($actualite['titre']); ?>">
                                            <div class="news-date">
                                                <time datetime="<?php echo $actualite['date_publication']; ?>"><?php echo $date_fr; ?></time>
                                            </div>
                                        </div>
                                        <div class="news-content">
                                            <span class="news-tag"><?php echo htmlspecialchars($actualite['categorie']); ?></span>
                                            <h3><?php echo htmlspecialchars($actualite['titre']); ?></h3>
                                            <p><?php echo substr(htmlspecialchars($actualite['contenu']), 0, 150) . '...'; ?></p>
                                            <a href="actualite.php?id=<?php echo $actualite['id']; ?>" class="read-more">Lire la suite</a>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button class="slider-nav next" aria-label="Actualité suivante">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                <?php else: ?>
                    <p class="no-news">Aucune actualité à afficher pour le moment.</p>
                <?php endif; ?>
                
            </div>
        </section>

        <!-- Section Vie au Lycée -->
        <section id="vie-lyceenne" class="vie-lycee-section" aria-labelledby="titre-vie-lycee">
            <div class="container">
                <h2 id="titre-vie-lycee" class="sr-only">Vie au lycée</h2>
                <div class="buttons-grid" role="navigation" aria-label="Navigation rapide de la vie lycéenne">
                    <a href="vie-lyceenne.php" class="info-button" aria-describedby="desc-vie-lycee">
                        <i class="fas fa-school" aria-hidden="true"></i>
                        <span>La vie au lycée</span>
                        <p id="desc-vie-lycee" class="button-subtitle">MDL, CVL, Internat, Restauration, CDI...</p>
                    </a>
                    <a href="#formations" class="info-button" aria-describedby="desc-formations">
                        <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                        <span>Formations</span>
                        <p id="desc-formations" class="button-subtitle">Générale, Technologique, Professionnelle</p>
                    </a>
                    <a href="partenariats.php" class="info-button" aria-describedby="desc-partenaires">
                        <i class="fas fa-handshake" aria-hidden="true"></i>
                        <span>Nos partenaires</span>
                        <p id="desc-partenaires" class="button-subtitle">Entreprises, Institutions, International</p>
                    </a>
                </div>
            </div>
        </section>

        <!-- Section Formations -->
        <section id="formations" class="filiere-section industrie-section" aria-labelledby="titre-formations">
            <div class="container">
                <h2 id="titre-formations" class="section-title">Nos filières</h2>
                
                <!-- Navigation des formations -->
                <nav class="filiere-filter formations-nav" aria-label="Navigation des filières de formation">
                    <a href="#seconde" class="formation-nav-btn" data-section="seconde">Classe de Seconde</a>
                    <a href="#general" class="formation-nav-btn active" data-section="general">Voie Générale</a>
                    <a href="#langues" class="formation-nav-btn" data-section="langues">Langues Vivantes</a>
                    <a href="#industrie" class="formation-nav-btn" data-section="industrie">Métiers de l'Industrie</a>
                    <a href="metiers-accueil.php" class="formation-nav-btn" data-section="tertiaire">Métiers du Tertiaire</a>
                    <a href="#artisanat" class="formation-nav-btn" data-section="artisanat">Artisanat</a>
                    <a href="#services" class="formation-nav-btn" data-section="services">Services aux Personnes</a>
                </nav>

                <!-- Classe de Seconde -->
                <div class="formation-block" id="seconde">
                    <div class="formation-header">
                        <h3>Classe de Seconde</h3>
                        <p class="formation-intro">Une année pour découvrir et choisir son orientation</p>
                    </div>
                    <div class="formation-content">
                        <div class="seconde-grid">
                            <div class="seconde-card">
                                <i class="fas fa-book"></i>
                                <h4>Tronc Commun</h4>
                                <ul>
                                    <li>Français</li>
                                    <li>Histoire-Géographie</li>
                                    <li>Mathématiques</li>
                                    <li>Sciences</li>
                                    <li>Langues Vivantes</li>
                                    <li>EPS</li>
                                </ul>
                            </div>
                            <div class="seconde-card">
                                <i class="fas fa-microscope"></i>
                                <h4>Enseignements d'Exploration</h4>
                                <ul>
                                    <li>Sciences de l'Ingénieur (SI)</li>
                                    <li>Création et Innovation Technologiques (CIT)</li>
                                    <li>Informatique et Création Numérique (ICN)</li>
                                    <li>Méthodes et Pratiques Scientifiques (MPS)</li>
                                    <li>Littérature et Société (LS)</li>
                                    <li>Sciences Économiques et Sociales (SES)</li>
                                </ul>
                            </div>
                            <div class="seconde-card highlight">
                                <i class="fas fa-star"></i>
                                <h4>PASS INGENIEUR</h4>
                                <a href="pass-ingenieur.php" class="read-more">En savoir plus</a>
                                <p>Programme spécial pour les élèves de seconde</p>
                                <ul>
                                    <li>Cours renforcés en anglais</li>
                                    <li>Projets technologiques</li>
                                    <li>Préparation aux études d'ingénieur</li>
                                </ul>
                            </div>
                            <div class="seconde-card">
                                <i class="fas fa-plus-circle"></i>
                                <h4>Options Facultatives</h4>
                                <ul>
                                    <li>Abibac</li>
                                    <li>Euro anglais</li>
                                    <li>Théâtre</li>
                                    <li>Latin</li>
                                    <li>Musique</li>
                                    <li>Arts plastiques</li>
                                    <li>Espagnol</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Voie Générale -->
                <div class="formation-block active" id="general">
                    <div class="formation-header">
                        <h3>Formations Générales et Technologiques</h3>
                        <p class="formation-intro">Préparez votre avenir avec nos filières d'excellence</p>
                    </div>
                    <div class="formation-content">
                        <div class="filieres-grid">
                            <div class="filiere-card">
                                <div class="filiere-header">
                                    <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                                    <h4>Bac Général</h4>
                                    <a href="bac-general.php" class="read-more">En savoir plus sur le Bac Général</a>
                                </div>
                                <div class="filiere-details">
                                    <h5>Spécialités proposées</h5>
                                    <ul>
                                        <li>Mathématiques</li>
                                        <li>Physique-Chimie</li>
                                        <li>Sciences de la Vie et de la Terre</li>
                                        <li>Sciences Économiques et Sociales</li>
                                        <li>Histoire-Géographie, Géopolitique et Sciences Politiques</li>
                                        <li>Humanités, Littérature et Philosophie</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filiere-card">
                                <div class="filiere-header">
                                    <i class="fas fa-microchip" aria-hidden="true"></i>
                                    <h4>STI2D</h4>
                                    <a href="sti2d.php" class="read-more">En savoir plus sur STI2D</a>
                                </div>
                                <div class="filiere-details">
                                    <h5>Sciences et Technologies de l'Industrie et du Développement Durable</h5>
                                    <ul>
                                        <li>Innovation Technologique</li>
                                        <li>Ingénierie et Développement Durable</li>
                                        <li>Physique-Chimie et Mathématiques</li>
                                        <li>Architecture et Construction</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filiere-card">
                                <div class="filiere-header">
                                    <i class="fas fa-chart-pie" aria-hidden="true"></i>
                                    <h4>STMG</h4>
                                    <a href="bac-stmg.php" class="read-more">En savoir plus sur STMG</a>
                                </div>
                                <div class="filiere-details">
                                    <h5>Sciences et Technologies du Management et de la Gestion</h5>
                                    <ul>
                                        <li>Management</li>
                                        <li>Sciences de Gestion et Numérique</li>
                                        <li>Droit et Économie</li>
                                        <li>Mercatique (Marketing)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Langues Vivantes -->
                <div class="formation-block" id="langues">
                    <div class="formation-header">
                        <h3>Langues Vivantes</h3>
                        <p class="formation-intro">Une ouverture sur l'international et le transfrontalier</p>
                    </div>
                    <div class="formation-content">
                        <div class="formation-category">
                            <h4>Formations Internationales</h4>
                            <div class="diplomes-grid">
                                <a href="abibac.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                    <i class="fas fa-flag"></i>
                                    <h5>Section ABIBAC</h5>
                                    <p>Double diplôme franco-allemand</p>
                                </a>
                                <a href="section-europeenne.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                    <i class="fas fa-globe-europe"></i>
                                    <h5>Sections EURO ANGLAIS</h5>
                                    <ul>
                                        <li>Euro anglais en filières générales et technologiques</li>
                                        <li>Euro anglais en BAC PRO MELEC</li>
                                    </ul>
                                </a>
                                <a href="etwinning.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                    <i class="fas fa-laptop-code"></i>
                                    <h5>eTwinning</h5>
                                    <p>Projets collaboratifs européens</p>
                                </a>
                            </div>
                        </div>

                        <div class="formation-category">
                            <h4>Formations Transfrontalières</h4>
                            <div class="diplomes-grid">
                                <a href="azubi-bac-pro.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                    <i class="fas fa-handshake"></i>
                                    <h5>AZUBI BAC PRO</h5>
                                    <p>Apprentissage transfrontalier en BAC PRO</p>
                                </a>
                                <a href="#" class="diplome-card" style="text-decoration: none; color: inherit;">
                                    <i class="fas fa-graduation-cap"></i>
                                    <h5>Licence Professionnelle Transfrontalière</h5>
                                    <p>Formation supérieure transfrontalière</p>
                                </a>
                            </div>
                        </div>
                    </div> <!-- Fin de la section Langues Vivantes -->
                </div>

                <!-- Métiers de l'Industrie -->
                <div class="formation-block" id="industrie">
                    <div class="formation-header">
                        <h3>Métiers de l'Industrie</h3>
                        <p class="formation-intro">Des formations techniques de pointe pour l'industrie du futur</p>
                    </div>
                    <div class="formation-content">
                        <div class="industrie-grid">
                            <div class="formation-category">
                                <h4>BTS Industriels</h4>
                                <div class="diplomes-grid">
                                    <a href="bts-cpi.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-cogs"></i>
                                        <h5>Conception de produits industriels</h5>
                                    </a>
                                    <a href="bts-ms.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-tools"></i>
                                        <h5>Maintenance des Systèmes</h5>
                                    </a>
                                    <a href="bts-tm.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-atom"></i>
                                        <h5>Traitement des matériaux</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="formation-category">
                                <h4>Bacs Professionnels</h4>
                                <div class="diplomes-grid">
                                    <a href="bac-pro-mspc.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-tools"></i>
                                        <h5>Bac Pro Maintenance des Systèmes de Production Connectés (MSPC)</h5>
                                    </a>
                                    <a href="#" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-industry"></i>
                                        <h5>Bac pro technicien en réalisation
de produits mécaniques option
réalisation et suivi de productions
(TRPM)
</h5>
                                    </a>
                                    <a href="bac-pro-melec.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-bolt"></i>
                                        <h5>Métiers de l'électricité et de ses environnement (MELEC)</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="formation-category">
                                <h4>CAP</h4>
                                <div class="diplomes-grid">
                                    <a href="cap-electricien.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-plug"></i>
                                        <h5>CAP Electricien</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Métiers du Tertiaire -->
                <div class="formation-block" id="tertiaire">
                    <div class="formation-header">
                        <h3>Métiers du Tertiaire</h3>
                        <p class="formation-intro">Des formations adaptées aux besoins des entreprises</p>
                    </div>
                    <div class="formation-content">
                        <div class="tertiaire-grid">
                            <div class="formation-category">
                                <h4>BTS Tertiaires</h4>
                                <div class="diplomes-grid">
                                    <a href="bts-assurance.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-shield-alt"></i>
                                        <h5>Assurance</h5>
                                    </a>
                                    <a href="bts-comptabilite-gestion.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-calculator"></i>
                                        <h5>Comptabilité-Gestion</h5>
                                    </a>
                                    <a href="bts-ccst.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-handshake"></i>
                                        <h5>Conseil et Commercialisation de Solutions Techniques</h5>
                                    </a>
                                    <a href="bts-mco.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-store"></i>
                                        <h5>Management Commercial Opérationnel</h5>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="formation-category">
                                <h4>Bacs Professionnels</h4>
                                <div class="diplomes-grid">
                                    <a href="metiers-accueil.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-user-tie"></i>
                                        <h5>Métiers de l'Accueil</h5>
                                    </a>
                                    <a href="metiers-commerce-vente.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-shopping-cart"></i>
                                        <h5>Métiers du Commerce et de la Vente</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Artisanat -->
                <div class="formation-block" id="artisanat">
                    <div class="formation-header">
                        <h3>Métiers de l'enseigne et de la signalétique</h3>
                        <p class="formation-intro">Des formations créatives et techniques</p>
                    </div>
                    <div class="formation-content">
                        <div class="formation-category">
                            <h4>Nos formations</h4>
                            <div class="diplomes-grid">
                                <a href="bac-pro-metiers-enseigne.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                    <i class="fas fa-paint-brush"></i>
                                    <h5>BAC PRO Métiers de l'enseigne et de la signalétique</h5>
                                </a>
                                <a href="cap-metiers-enseigne.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                    <i class="fas fa-sign"></i>
                                    <h5>CAP Métiers de l'Enseigne et de la Signalétique</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services aux Personnes -->
                <div class="formation-block" id="services">
                    <div class="formation-header">
                        <h3>Services aux Personnes</h3>
                        <p class="formation-intro">Des formations pour l'accompagnement et le service</p>
                    </div>
                    <div class="formation-content">
                        <div class="services-grid">
                            <div class="service-category">
                                <h4>Aide à la Personne</h4>
                                <div class="diplomes-grid">
                                    <a href="cap-aaga.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-hand-holding-heart"></i>
                                        <h5>CAP Agent Accompagnant au Grand Âge (AAGA)</h5>
                                    </a>
                                    <a href="#" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-users"></i>
                                        <h5>Bac Pro Animation-Enfance et Personnes Âgées (AEPA)</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="service-category">
                                <h4>Restauration</h4>
                                <div class="diplomes-grid">
                                    <a href="cap-psr.php" class="diplome-card" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-utensils"></i>
                                        <h5>CAP Production et Service en Restaurations (PSR)</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- Section UFA et Enseignements Professionnels -->
        <section class="ufa-pro-section" aria-labelledby="titre-ufa-pro">
            <div class="container">
                <div class="ufa-pro-grid">
                    <div class="ufa-card">
                        <div class="ufa-header">
                            <i class="fas fa-university" aria-hidden="true"></i>
                            <h3>Unité de Formation par Apprentissage (UFA)</h3>
                        </div>
                        <div class="ufa-content">
                            <p>Notre UFA propose des formations en alternance pour préparer votre avenir professionnel.</p>
                            <ul>
                                <li>Formation rémunérée</li>
                                <li>Expérience professionnelle</li>
                                <li>Accompagnement personnalisé</li>
                            </ul>
                            <a href="ufa.php" class="cta-button">Découvrir l'UFA</a>
                        </div>
                    </div>
                    <div class="pro-card">
                        <div class="pro-header">
                            <i class="fas fa-briefcase" aria-hidden="true"></i>
                            <h3>Enseignements Professionnels</h3>
                        </div>
                        <div class="pro-content">
                            <p>Des formations qualifiantes adaptées au monde du travail dans divers secteurs.</p>
                            <div class="pro-sectors">
                                <div class="sector">
                                    <i class="fas fa-industry"></i>
                                    <span>Industrie</span>
                                </div>
                                <div class="sector">
                                    <i class="fas fa-store"></i>
                                    <span>Commerce</span>
                                </div>
                                <div class="sector">
                                    <i class="fas fa-bolt"></i>
                                    <span>Électricité</span>
                                </div>
                                <div class="sector">
                                    <i class="fas fa-hand-holding-heart"></i>
                                    <span>Services</span>
                                </div>
                            </div>
                            <a href="#formations" class="cta-button">Voir les formations</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="key-numbers" aria-labelledby="titre-chiffres">
            <div class="container">
                <h2 id="titre-chiffres" class="section-title">Chiffres clés</h2>
                <div class="numbers-grid" role="group" aria-label="Statistiques du lycée">
                    <div class="number-card" role="presentation">
                        <strong class="number" aria-label="mille deux cents">1200</strong>
                        <span>Élèves</span>
                    </div>
                    <div class="number-card" role="presentation">
                        <strong class="number" aria-label="cent">100</strong>
                        <span>Enseignants</span>
                    </div>
                    <div class="number-card" role="presentation">
                        <strong class="number" aria-label="quatre-vingt-quinze pourcent">95</strong>
                        <span>% de réussite au bac</span>
                    </div>
                </div>
            </div>
        </section>

    
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
                    <a href="#contact">Mentions légales</a>
                    <a href="#contact">Accessibilité</a>
                    <a href="#contact">Plan du site</a>
                    <a href="https://lyceemermoz-my.sharepoint.com/" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-cloud"></i> SharePoint
                    </a>
                    <a href="admin/login.php">Administration</a>
                </div>
            </div>
        </div>
    </footer>

    <button class="theme-toggle" aria-label="Basculer le mode sombre">
        <i class="fas fa-moon"></i>
    </button>

    <script src="js/script.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const navBtns = document.querySelectorAll('.formation-nav-btn');
        const blocks = document.querySelectorAll('.formation-block');

        function showSection(section) {
            navBtns.forEach(b => b.classList.remove('active'));
            blocks.forEach(b => b.classList.remove('active'));
            // Active le bouton et le bloc correspondant
            navBtns.forEach(btn => {
                if (btn.getAttribute('data-section') === section) {
                    btn.classList.add('active');
                }
            });
            const block = document.getElementById(section);
            if (block) block.classList.add('active');
        }

        navBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                const href = btn.getAttribute('href');
                // Si c'est un lien vers une page, on laisse le comportement par défaut
                if (href && href.endsWith('.php')) return;

                e.preventDefault();
                const section = btn.getAttribute('data-section');
                showSection(section);
                // Met à jour le hash dans l'URL sans recharger
                history.replaceState(null, '', '#' + section);
            });
        });

        // Affiche la bonne section au chargement selon le hash
        const hash = window.location.hash.replace('#', '');
        if (hash && document.getElementById(hash)) {
            showSection(hash);
        } else {
            // Par défaut, active la première section
            const defaultSection = navBtns[0].getAttribute('data-section');
            showSection(defaultSection);
        }
    });
    </script>
</body>
</html>

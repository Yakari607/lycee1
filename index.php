<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lycée Jean Mermoz - Saint-Louis</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/index.css">
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
                    <li><a href="index.php" class="active">Accueil</a></li>
                    <li class="dropdown">
                        <a href="#" onclick="return false;">L'établissement</a>
                        <ul class="dropdown-menu">
                            <li><a href="#contact">Présentation</a></li>
                            <li><a href="#contact">L'équipe</a></li>
                            <li><a href="#vie-lyceenne">Nos infrastructures</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#formations">Nos formations</a>
                        <ul class="dropdown-menu">
                            <li><a href="#general">Enseignement général & technologique</a></li>
                            <li><a href="#industrie">Enseignement Professionnel</a></li>
                            <li><a href="#industrie">Enseignement supérieur</a></li>
                            <li><a href="#industrie">Apprentissage</a></li>
                            <li><a href="#contact">Orientation</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" onclick="return false;">Espace pour les professionnels</a>
                        <ul class="dropdown-menu">
                            <li><a href="#contact">Stages</a></li>
                            <li><a href="#contact">Alternance</a></li>
                            <li><a href="#contact">Partenariats</a></li>
                        </ul>
                    </li>
                    <li><a href="#actualites">Actualités</a></li>
                    <li><a href="#ufa">UFA</a></li>
                    <li><a href="#contact">Contact</a></li>
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
        <section class="hero">
            <div class="hero-content">
                <h1>Lycée Jean Mermoz</h1>
                <p class="hero-subtitle">Un établissement d'excellence au service de la réussite de tous</p>
                <div class="cta-container">
                    <a href="#formations" class="cta-button">Découvrir nos filières</a>
                    <a href="#contact" class="cta-button secondary">Nous contacter</a>
                </div>
            </div>
        </section>

        <section id="actualites" class="news-section">
            <div class="container">
                <h2 class="section-title">Actualités</h2>
                <div class="news-slider-container">
                    <button class="slider-nav prev" aria-label="Actualité précédente">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="news-grid">
                        <article class="news-card">
                            <div class="news-image">
                                <img src="images/images.jpeg" alt="Visite à Strasbourg">
                                <div class="news-date">
                                    <time datetime="2024-02-21">21 février 2024</time>
                                </div>
                            </div>
                            <div class="news-content">
                                <span class="news-tag">Événement</span>
                                <h3>Des Mermoziens à Strasbourg</h3>
                                <p>Les élèves de 1PACCE inscrits en Section européenne Allemand se sont rendus à Strasbourg pour y retrouver leurs correspondants allemands.</p>
                                <a href="#actualites" class="read-more">Lire la suite</a>
                            </div>
                        </article>
                        <article class="news-card">
                            <div class="news-image">
                                <img src="images/batiments/c-est-la-rentree-ce-lundi-au-lycee-jean-mermoz-de-saint-louis-avec-une-17e-classe-de-seconde-qui-vient-s-ajouter-a-des-effectifs-consequents-qui-font-du-lycee-ludovicien-le-plus-grand-d-alsace-photo-l-alsace-1567245623.jpg" alt="Journée Portes Ouvertes">
                                <div class="news-date">
                                    <time datetime="2024-01-03">3 janvier 2024</time>
                                </div>
                            </div>
                            <div class="news-content">
                                <span class="news-tag">Information</span>
                                <h3>Journée Portes Ouvertes 2025</h3>
                                <p>Venez découvrir notre établissement lors de notre prochaine journée portes ouvertes.</p>
                                <a href="#actualites" class="read-more">Lire la suite</a>
                            </div>
                        </article>
                    </div>
                    <button class="slider-nav next" aria-label="Actualité suivante">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Section Vie au Lycée -->
        <section id="vie-lyceenne" class="vie-lycee-section">
            <div class="container">
                <div class="buttons-grid">
                    <a href="vie-lyceenne.php" class="info-button">
                        <i class="fas fa-school"></i>
                        <span>La vie au lycée</span>
                        <p class="button-subtitle">MDL, CVL, Internat, Restauration, CDI...</p>
                    </a>
                    <a href="#formations" class="info-button">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Formations</span>
                        <p class="button-subtitle">Générale, Technologique, Professionnelle</p>
                    </a>
                    <a href="#contact" class="info-button">
                        <i class="fas fa-handshake"></i>
                        <span>Nos partenaires</span>
                        <p class="button-subtitle">Entreprises, Institutions, International</p>
                    </a>
                </div>
            </div>
        </section>

        <!-- Section Formations -->
        <section id="formations" class="filiere-section industrie-section">
            <div class="container">
                <h2 class="section-title">Nos filières</h2>
                
                <!-- Navigation des formations -->
                <div class="formations-nav">
                    <button class="formation-nav-btn active" data-section="seconde">Classe de Seconde</button>
                    <button class="formation-nav-btn" data-section="general">Voie Générale</button>
                    <button class="formation-nav-btn" data-section="langues">Langues Vivantes</button>
                    <button class="formation-nav-btn" data-section="industrie">Métiers de l'Industrie</button>
                    <button class="formation-nav-btn" data-section="tertiaire">Métiers du Tertiaire</button>
                    <button class="formation-nav-btn" data-section="artisanat">Artisanat</button>
                    <button class="formation-nav-btn" data-section="services">Services aux Personnes</button>
                </div>

                <!-- Classe de Seconde -->
                <div class="formation-block active" id="seconde">
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
                <div class="formation-block" id="general">
                    <div class="formation-header">
                        <h3>Formations Générales et Technologiques</h3>
                        <p class="formation-intro">Préparez votre avenir avec nos filières d'excellence</p>
                    </div>
                    <div class="formation-content">
                        <div class="filieres-grid">
                            <div class="filiere-card">
                                <div class="filiere-header">
                                    <i class="fas fa-graduation-cap"></i>
                                    <h4>Bac Général</h4>
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
                                    <i class="fas fa-microchip"></i>
                                    <h4>STI2D</h4>
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
                                    <i class="fas fa-chart-pie"></i>
                                    <h4>STMG</h4>
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
                        <div class="langues-grid">
                            <div class="langue-card">
                                <i class="fas fa-flag"></i>
                                <h4>Section ABIBAC</h4>
                                <p>Double diplôme franco-allemand</p>
                            </div>
                            <div class="langue-card">
                                <i class="fas fa-globe-europe"></i>
                                <h4>Sections Européennes</h4>
                                <ul>
                                    <li>Euro anglais en filières générales et technologiques</li>
                                    <li>Euro anglais en BAC PRO MELEC</li>
                                </ul>
                            </div>
                            <div class="langue-card">
                                <i class="fas fa-handshake"></i>
                                <h4>Formations Transfrontalières</h4>
                                <p>Apprentissage en mixage de publics en BAC PRO et BTS</p>
                            </div>
                            <div class="langue-card">
                                <i class="fas fa-laptop-code"></i>
                                <h4>Etwinning</h4>
                                <p>Projets collaboratifs européens</p>
                            </div>
                        </div>
                    </div>
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
                                    <div class="diplome-card">
                                        <i class="fas fa-cogs"></i>
                                        <h5>Conception de produits industriels</h5>
                                    </div>
                                    <div class="diplome-card">
                                        <i class="fas fa-atom"></i>
                                        <h5>Traitement des matériaux</h5>
                                    </div>
                                    <div class="diplome-card highlight">
                                        <i class="fas fa-laser"></i>
                                        <h5>Systèmes photoniques</h5>
                                        <p class="unique">Unique en Alsace</p>
                                    </div>
                                </div>
                            </div>
                            <div class="formation-category">
                                <h4>Bacs Professionnels</h4>
                                <div class="diplomes-grid">
                                    <div class="diplome-card">
                                        <i class="fas fa-tools"></i>
                                        <h5>Maintenance des équipements industriels</h5>
                                    </div>
                                    <div class="diplome-card">
                                        <i class="fas fa-industry"></i>
                                        <h5>Technicien d'usinage</h5>
                                    </div>
                                    <div class="diplome-card">
                                        <i class="fas fa-bolt"></i>
                                        <h5>Métiers de l'électricité et de ses environnements connectés</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="formation-category">
                                <h4>CAP</h4>
                                <div class="diplomes-grid">
                                    <div class="diplome-card">
                                        <i class="fas fa-plug"></i>
                                        <h5>Préparation et réalisation d'ouvrages électriques</h5>
                                    </div>
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
                                    <div class="diplome-card">
                                        <i class="fas fa-shield-alt"></i>
                                        <h5>Assurance</h5>
                                    </div>
                                    <div class="diplome-card">
                                        <i class="fas fa-calculator"></i>
                                        <h5>Comptabilité-Gestion</h5>
                                    </div>
                                    <div class="diplome-card">
                                        <i class="fas fa-handshake"></i>
                                        <h5>Conseil et Commercialisation de Solutions Techniques</h5>
                                    </div>
                                    <div class="diplome-card">
                                        <i class="fas fa-store"></i>
                                        <h5>Management Commercial Opérationnel</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="formation-category">
                                <h4>Bacs Professionnels</h4>
                                <div class="diplomes-grid">
                                    <div class="diplome-card">
                                        <i class="fas fa-user-tie"></i>
                                        <h5>Métiers de l'accueil</h5>
                                    </div>
                                    <div class="diplome-card">
                                        <i class="fas fa-shopping-cart"></i>
                                        <h5>Métiers du Commerce et de la Vente</h5>
                                    </div>
                                    <div class="diplome-card">
                                        <i class="fas fa-tasks"></i>
                                        <h5>Assistance à la Gestion des Organisations</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Artisanat -->
                <div class="formation-block" id="artisanat">
                    <div class="formation-header">
                        <h3>Artisanat et Métiers d'Art</h3>
                        <p class="formation-intro">Des formations créatives et techniques</p>
                    </div>
                    <div class="formation-content">
                        <div class="artisanat-grid">
                            <div class="diplome-card large">
                                <i class="fas fa-paint-brush"></i>
                                <h4>BAC PRO Artisanat et Métiers d'Arts</h4>
                                <h5>Métiers de l'Enseigne et de la Signalétique</h5>
                            </div>
                            <div class="diplome-card large">
                                <i class="fas fa-sign"></i>
                                <h4>CAP Métiers de l'Enseigne et de la Signalétique</h4>
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
                                    <div class="diplome-card">
                                        <i class="fas fa-hand-holding-heart"></i>
                                        <h5>CAP Agent Accompagnant au Grand Âge (AAGA)</h5>
                                    </div>
                                    <div class="diplome-card">
                                        <i class="fas fa-users"></i>
                                        <h5>Bac Pro Animation-Enfance et Personnes Âgées (AEPA)</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="service-category">
                                <h4>Restauration</h4>
                                <div class="diplomes-grid">
                                    <div class="diplome-card">
                                        <i class="fas fa-utensils"></i>
                                        <h5>CAP Production et Service en Restaurations (PSR)</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="key-numbers">
            <div class="container">
                <h2 class="section-title">Chiffres clés</h2>
                <div class="numbers-grid">
                    <div class="number-card">
                        <strong class="number">1200</strong>
                        <span>Élèves</span>
                    </div>
                    <div class="number-card">
                        <strong class="number">100</strong>
                        <span>Enseignants</span>
                    </div>
                    <div class="number-card">
                        <strong class="number">95</strong>
                        <span>% de réussite au bac</span>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Section UFA -->
        <section id="ufa" class="ufa-section">
            <div class="container">
                <h2 class="section-title">L'UFA Jean Mermoz</h2>
                <div class="ufa-content">
                    <div class="ufa-intro">
                        <p>L'Unité de Formation par Apprentissage (UFA) du Lycée Jean Mermoz propose des formations en alternance de qualité, alliant enseignement théorique et expérience professionnelle.</p>
                    </div>
                    
                    <div class="ufa-grid">
                        <div class="ufa-card">
                            <div class="ufa-card-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h3>Nos formations en apprentissage</h3>
                            <p>Un large choix de formations professionnalisantes du CAP au BTS dans les domaines industriels et tertiaires.</p>
                            <ul class="ufa-list">
                                <li>CAP Métiers de l'Enseigne et de la Signalétique</li>
                                <li>BAC PRO Métiers de l'Électricité</li>
                                <li>BAC PRO Technicien d'Usinage</li>
                                <li>BTS Conception de Produits Industriels</li>
                                <li>BTS Management Commercial Opérationnel</li>
                                <li>BTS Assurance</li>
                            </ul>  
                        </div>
                        
                        <div class="ufa-card">
                            <div class="ufa-card-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <h3>Les avantages de l'alternance</h3>
                            <ul class="ufa-list">
                                <li><strong>Formation rémunérée</strong> - Gagnez en indépendance financière</li>
                                <li><strong>Expérience professionnelle</strong> - Acquisition d'une expérience concrète</li>
                                <li><strong>Insertion facilitée</strong> - 70% des apprentis trouvent un emploi dans les 7 mois</li>
                                <li><strong>Double statut</strong> - Bénéficiez du statut étudiant et salarié</li>
                                <li><strong>Formation gratuite</strong> - Prise en charge des frais par l'entreprise</li>
                                <li><strong>Suivi personnalisé</strong> - Accompagnement par des tuteurs dédiés</li>
                            </ul>
                        </div>
                        
                        <div class="ufa-card highlight">
                            <div class="ufa-card-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h3>Notre réseau d'entreprises partenaires</h3>
                            <p>L'UFA Jean Mermoz entretient des relations privilégiées avec plus de 150 entreprises dans la région trinationale (France, Allemagne, Suisse).</p>
                            <p>Notre Bureau des Entreprises vous accompagne dans votre recherche de contrat d'apprentissage.</p>
                            <a href="#contact" class="ufa-btn">Contacter notre Bureau des Entreprises</a>
                        </div>
                    </div>
                    
                    <div class="ufa-testimonials">
                        <h3>Ce que disent nos apprentis</h3>
                        <div class="testimonial-grid">
                            <div class="testimonial-card">
                                <blockquote>
                                    "L'alternance à l'UFA Jean Mermoz m'a permis d'acquérir une solide expérience professionnelle tout en obtenant mon diplôme. J'ai été embauché dans mon entreprise d'accueil dès la fin de ma formation."
                                </blockquote>
                                <cite>Thomas, diplômé BTS CPI</cite>
                            </div>
                            <div class="testimonial-card">
                                <blockquote>
                                    "Les formateurs sont très investis et l'accompagnement est personnalisé. La formation en apprentissage est exigeante mais très enrichissante."
                                </blockquote>
                                <cite>Emma, apprentie en BAC PRO</cite>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Section Contact -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2 class="section-title">Besoin de renseignements ?</h2>
            <div class="contact-container">
                <div class="contact-accordion">
                    <button class="accordion-btn">
                        <span>Qui contacter ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content">
                        <table class="contact-table">
                            <tr>
                                <td>Proviseure</td>
                                <td>Mme Marie-Carmen GRANDHAYE</td>
                                <td>+33 389.70.22.70</td>
                            </tr>
                            <tr>
                                <td>Proviseure adjointe, sections générales et technologiques</td>
                                <td>Mme Marie HIMBERT</td>
                                <td>+33 389.70.22.70</td>
                            </tr>
                            <tr>
                                <td>Proviseur adjoint, sections professionnelles et BTS</td>
                                <td>M Mathieu CLOSSE</td>
                                <td>+33 389.70.22.70</td>
                            </tr>
                            <tr>
                                <td>Directeur Délégué à l'UFA</td>
                                <td>M Emmanuel DANGEL</td>
                                <td>+33 389.70.22.71</td>
                            </tr>
                            <tr>
                                <td>Responsable du Bureau des Entreprises</td>
                                <td>M Bruno SCHAFFNER</td>
                                <td>+33 389.70.22.70</td>
                            </tr>
                            <tr>
                                <td>Intendant/Agent comptable</td>
                                <td>M Nicolas MERLET</td>
                                <td>+33 389.70.22.70</td>
                            </tr>
                            <tr>
                                <td>Directeur délégué, département de génie industriel</td>
                                <td>M Thomas NIEDERST</td>
                                <td>+33 389.70.22.76</td>
                            </tr>
                            <tr>
                                <td>Directrice déléguée, département tertiaire et biotechnologies</td>
                                <td>Mme Brigitte PAJOT</td>
                                <td>+33 389.70.22.77</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <form class="contact-form">
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" id="nom" name="nom" placeholder="NOM & PRÉNOM *" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="societe" name="societe" placeholder="SOCIÉTÉ">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="E-MAIL *" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="telephone" name="telephone" placeholder="N° TÉLÉPHONE *" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group message-group">
                            <textarea id="message" name="message" placeholder="MESSAGE *" required></textarea>
                        </div>
                        <div class="form-group submit-group">
                            <p class="form-note">* Champs obligatoires</p>
                            <button type="submit" class="submit-btn">Envoyer</button>
                        </div>
                    </div>
                </form>
                
                <div class="contact-info">
                    <div class="info-row">
                        <p><i class="fas fa-phone"></i> +33 389 70 22 70</p>
                        <p><i class="fas fa-envelope"></i> <a href="mailto:ce.0680066c@ac-strasbourg.fr">ce.0680066c@ac-strasbourg.fr</a></p>
                    </div>
                    <div class="info-row">
                        <p><i class="fas fa-map-marker-alt"></i> 53 rue du Docteur Hurst, 68301 Saint-Louis Cedex</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <img src="images/logos/LOGO-UFA-MERMOZ-1.jpg" alt="Logo UFA Jean-Mermoz" class="footer-logo">
                    <p>&copy; 2024 Lycée Jean Mermoz - Saint-Louis</p>
                </div>
                <div class="footer-links">
                    <a href="#contact">Mentions légales</a>
                    <a href="#contact">Accessibilité</a>
                    <a href="#contact">Plan du site</a>
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

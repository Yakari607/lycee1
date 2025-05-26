<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orientation - Lycée Jean Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .timeline-container {
            margin: 2rem 0;
            position: relative;
        }
        
        .timeline-item {
            background: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            padding: 2rem;
            position: relative;
            border-left: 5px solid var(--primary-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .timeline-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .timeline-date {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 1rem;
        }
        
        .timeline-title {
            color: var(--primary-color);
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        
        .timeline-subtitle {
            color: var(--accent-color);
            font-size: 1rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        
        .timeline-description {
            color: var(--text-color);
            line-height: 1.6;
            font-size: 0.95rem;
        }
        
        .info-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .info-card {
            background: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-top: 4px solid var(--primary-color);
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .info-card-icon {
            background: var(--primary-color);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
        }
        
        .info-card h4 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        
        .info-card p {
            color: var(--text-color);
            line-height: 1.5;
            font-size: 0.95rem;
        }
        
        .quote-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem 2rem;
            border-radius: 15px;
            text-align: center;
            margin: 3rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .quote-section::before {
            content: '"';
            font-size: 8rem;
            position: absolute;
            top: -2rem;
            left: 2rem;
            opacity: 0.2;
            font-family: serif;
        }
        
        .quote-text {
            font-size: 1.2rem;
            font-style: italic;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }
        
        .quote-author {
            font-weight: 600;
            font-size: 1rem;
        }
        
        @media (max-width: 768px) {
            .info-cards-grid {
                grid-template-columns: 1fr;
            }
            
            .timeline-item {
                padding: 1.5rem;
            }
            
            .quote-section {
                padding: 2rem 1.5rem;
            }
            
            .quote-section::before {
                font-size: 6rem;
                top: -1rem;
                left: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="bac-general.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour au Bac Général</span>
        </a>

        <section class="formation-hero" style="background-image: url('images/formations/pexels-pixabay-159740.jpg');">
            <div class="hero-content">
                <h1>Orientation</h1>
                <p>Les grandes étapes de l'orientation</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <!-- Message de l'équipe de direction -->
                <div class="quote-section">
                    <div class="quote-text">
                        Vous trouverez sur cette page les principales échéances de l'orientation au lycée Jean-Mermoz
                    </div>
                    <div class="quote-author">L'Équipe de direction - Lycée Jean-Mermoz</div>
                </div>

                <!-- Orientation Bac Général -->
                <div class="formation-block">
                    <h3><i class="fas fa-graduation-cap"></i> Orientation Bac Général</h3>
                    
                    <div class="timeline-container">
                        <!-- Étape 1 : Information personnelle -->
                        <div class="timeline-item">
                            <div class="timeline-title">Informations personnelles</div>
                            <div class="timeline-subtitle">Information classe/ Personnelle – Professeur principaux</div>
                            <div class="timeline-description">
                                <p>Echanges avec les professeurs principaux pour accompagner les élèves dans leur orientation.</p>
                            </div>
                        </div>

                        <!-- Étape 2 : Saisie des voeux provisoires -->
                        <div class="timeline-item">
                            <div class="timeline-date">Février - Mars</div>
                            <div class="timeline-title">Saisie des Voeux provisoires pour le conseil de classe du 2ème trimestre</div>
                            <div class="timeline-subtitle">Parents et Elève</div>
                            <div class="timeline-description">
                                <p>Les voeux provisoires d'orientation pour la classe de 1ère sont saisis et validés sur l'application TSO</p>
                            </div>
                        </div>

                        <!-- Étape 3 : Consultation des avis -->
                        <div class="timeline-item">
                            <div class="timeline-date">À partir de fin Mars</div>
                            <div class="timeline-title">Consultation des avis du conseil de classe</div>
                            <div class="timeline-subtitle">Elève</div>
                            <div class="timeline-description">
                                <p>L'application vous permet de consulter les avis du conseil de classe concernant votre projet d'orientation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orientation 3ème Prépa Métier -->
                <div class="formation-block">
                    <h3><i class="fas fa-tools"></i> Orientation 3ème Prépa Métier</h3>
                    
                    <div class="timeline-container">
                        <!-- Étape 1 : Information personnelle -->
                        <div class="timeline-item">
                            <div class="timeline-title">Informations personnelles</div>
                            <div class="timeline-subtitle">Information classe/ Personnelle – Professeur principaux</div>
                            <div class="timeline-description">
                                <p>Echanges avec les professeurs principaux pour accompagner les élèves dans leur orientation.</p>
                            </div>
                        </div>

                        <!-- Étape 2 : Saisie des intentions de voeux -->
                        <div class="timeline-item">
                            <div class="timeline-date">Février - Mars</div>
                            <div class="timeline-title">Saisie des intentions de Voeux</div>
                            <div class="timeline-subtitle">Parents et Elève</div>
                            <div class="timeline-description">
                                <p>Saisie des premières intentions de voeux sur le portail TSO</p>
                            </div>
                        </div>

                        <!-- Étape 3 : Consultation des avis -->
                        <div class="timeline-item">
                            <div class="timeline-date">À partir de fin Mars</div>
                            <div class="timeline-title">Consultation des avis du conseil de classe</div>
                            <div class="timeline-subtitle">Elève</div>
                            <div class="timeline-description">
                                <p>L'application vous permet de consulter les avis du conseil de classe concernant votre projet d'orientation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Information sur l'orientation -->
                <div class="formation-block">
                    <h3><i class="fas fa-info-circle"></i> Information sur l'orientation</h3>
                    
                    <div class="info-cards-grid">
                        <div class="info-card">
                            <div class="info-card-icon">
                                <i class="fas fa-atom"></i>
                            </div>
                            <h4>Bac général – Les spécialités au lycée Jean-Mermoz</h4>
                            <p>Découvrez l'ensemble des spécialités proposées au lycée Jean Mermoz</p>
                        </div>
                        
                        <div class="info-card">
                            <div class="info-card-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h4>Information sur le Bac général</h4>
                            <p>L'organisation du Baccalauréat</p>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="contact-section">
                    <h3><i class="fas fa-map-marker-alt"></i> Contact</h3>
                    <div class="contact-content">
                        <div class="contact-address">
                            <h4>Lycée Jean-Mermoz</h4>
                            <p>53 rue du Docteur Hurst<br>68301 Saint-Louis Cedex
                                <a href="https://maps.google.com/?q=Lycée+Jean+Mermoz,+53+rue+du+Docteur+Hurst,+68301+Saint-Louis+Cedex,+France" target="_blank" class="map-link" title="Voir sur Google Maps">
                                    <i class="fas fa-map"></i>
                                </a>
                            </p>
                            <p><i class="fas fa-phone"></i> +33 389 70 22 71</p>
                        </div>
                        
                        <div class="contact-info">
                            <div class="contact-block">
                                <h4>L'Equipe de direction</h4>
                                <p>Pour toute question concernant l'orientation, n'hésitez pas à prendre contact avec l'équipe de direction.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <button class="theme-toggle" aria-label="Basculer le mode sombre">
        <i class="fas fa-moon"></i>
    </button>

    <script src="js/script.js"></script>
    <script src="js/page-specific/formation.js"></script>
</body>
</html> 
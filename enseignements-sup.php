<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enseignements Supérieurs - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="css/components/parcoursup-cards.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php#formations" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à l'accueil</span>
        </a>

        <section class="formation-hero" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/formations/pexels-fauxels-3184398.jpg');">
            <div class="hero-content">
                <h1>Enseignements Supérieurs</h1>
                <p>Découvrez nos formations post-bac pour préparer votre avenir professionnel</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <div class="formation-block">
                    <h3><i class="fas fa-university"></i> Nos BTS</h3>
                    <p>Le lycée Jean-Mermoz propose des formations supérieures de qualité pour vous préparer aux métiers d'aujourd'hui et de demain</p>
                </div>

                <!-- BTS Industriels -->
                <div class="formation-block">
                    <h3><i class="fas fa-industry"></i> BTS secteur Industriel</h3>
                    <div class="parcoursup-grid">
                        <div class="parcoursup-card">
                            <div class="parcoursup-header">
                                <div class="parcoursup-title">
                                    <i class="fas fa-drafting-compass"></i>
                                    <h4>BTS CPI</h4>
                                </div>
                                <p class="parcoursup-subtitle">Conception de Produits Industriels</p>
                            </div>
                            <div class="parcoursup-body">
                                <p class="parcoursup-description">Formation aux techniques de conception et d'industrialisation de produits mécaniques.</p>
                                <div class="parcoursup-tags">
                                    <span class="parcoursup-tag bts">BTS</span>
                                    <span class="parcoursup-tag pro">Industrie</span>
                                    <span class="parcoursup-tag">2 ans</span>
                                </div>
                            </div>
                            <div class="parcoursup-footer">
                                <div class="parcoursup-details">
                                    <div class="parcoursup-detail">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                </div>
                                <a href="bts-cpi.php" class="parcoursup-action">Découvrir</a>
                            </div>
                        </div>

                        <div class="parcoursup-card">
                            <div class="parcoursup-header">
                                <div class="parcoursup-title">
                                    <i class="fas fa-atom"></i>
                                    <h4>BTS TM</h4>
                                </div>
                                <p class="parcoursup-subtitle">Traitement des Matériaux</p>
                            </div>
                            <div class="parcoursup-body">
                                <p class="parcoursup-description">Formation aux techniques de traitement de surface et de traitement thermique des matériaux.</p>
                                <div class="parcoursup-tags">
                                    <span class="parcoursup-tag bts">BTS</span>
                                    <span class="parcoursup-tag pro">Industrie</span>
                                    <span class="parcoursup-tag">2 ans</span>
                                </div>
                            </div>
                            <div class="parcoursup-footer">
                                <div class="parcoursup-details">
                                    <div class="parcoursup-detail">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                </div>
                                <a href="bts-tm.php" class="parcoursup-action">Découvrir</a>
                            </div>
                        </div>
                        
                        <div class="parcoursup-card">
                            <div class="parcoursup-header">
                                <div class="parcoursup-title">
                                    <i class="fas fa-cogs"></i>
                                    <h4>BTS MS (par alternance)</h4>
                                </div>
                                <p class="parcoursup-subtitle">Maintenance des Systèmes</p>
                            </div>
                            <div class="parcoursup-body">
                                <p class="parcoursup-description">Formation aux techniques de maintenance industrielle et d'optimisation des équipements de production.</p>
                                <div class="parcoursup-tags">
                                    <span class="parcoursup-tag bts">BTS</span>
                                    <span class="parcoursup-tag pro">Industrie</span>
                                    <span class="parcoursup-tag">2 ans</span>
                                </div>
                            </div>
                            <div class="parcoursup-footer">
                                <div class="parcoursup-details">
                                    <div class="parcoursup-detail">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                </div>
                                <a href="bts-ms.php" class="parcoursup-action">Découvrir</a>
                            </div>
                        </div>
                </div>

                <!-- BTS Tertiaires -->
                <div class="formation-block">
                    <h3><i class="fas fa-briefcase"></i> BTS secteur Tertiaire</h3>
                    <div class="parcoursup-grid">                        
                        <div class="parcoursup-card">
                            <div class="parcoursup-header">
                                <div class="parcoursup-title">
                                    <i class="fas fa-calculator"></i>
                                    <h4>BTS Comptabilité-Gestion</h4>
                                </div>
                                <p class="parcoursup-subtitle">Gestion comptable et financière</p>
                            </div>
                            <div class="parcoursup-body">
                                <p class="parcoursup-description">Formation aux techniques comptables, à la gestion financière et à l'analyse des données économiques.</p>
                                <div class="parcoursup-tags">
                                    <span class="parcoursup-tag bts">BTS</span>
                                    <span class="parcoursup-tag pro">Gestion</span>
                                    <span class="parcoursup-tag">2 ans</span>
                                </div>
                            </div>
                            <div class="parcoursup-footer">
                                <div class="parcoursup-details">
                                    <div class="parcoursup-detail">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                </div>
                                <a href="bts-comptabilite-gestion.php" class="parcoursup-action">Découvrir</a>
                            </div>
                        </div>
                        
                        <div class="parcoursup-card">
                            <div class="parcoursup-header">
                                <div class="parcoursup-title">
                                    <i class="fas fa-shield-alt"></i>
                                    <h4>BTS Assurance</h4>
                                </div>
                                <p class="parcoursup-subtitle">Conseil et développement en assurance</p>
                            </div>
                            <div class="parcoursup-body">
                                <p class="parcoursup-description">Formation aux techniques de souscription, de gestion des contrats et de relation client dans le secteur de l'assurance.</p>
                                <div class="parcoursup-tags">
                                    <span class="parcoursup-tag bts">BTS</span>
                                    <span class="parcoursup-tag pro">Assurance</span>
                                    <span class="parcoursup-tag">2 ans</span>
                                </div>
                            </div>
                            <div class="parcoursup-footer">
                                <div class="parcoursup-details">
                                    <div class="parcoursup-detail">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                </div>
                                <a href="bts-assurance.php" class="parcoursup-action">Découvrir</a>
                            </div>
                        </div>
                        
                        <div class="parcoursup-card">
                            <div class="parcoursup-header">
                                <div class="parcoursup-title">
                                    <i class="fas fa-comments"></i>
                                    <h4>BTS CCST</h4>
                                </div>
                                <p class="parcoursup-subtitle">Conseil et Commercialisation de Solutions Techniques</p>
                            </div>
                            <div class="parcoursup-body">
                                <p class="parcoursup-description">Formation aux techniques de vente de solutions techniques et de conseil auprès des clients professionnels.</p>
                                <div class="parcoursup-tags">
                                    <span class="parcoursup-tag bts">BTS</span>
                                    <span class="parcoursup-tag pro">Commerce</span>
                                    <span class="parcoursup-tag">2 ans</span>
                                </div>
                            </div>
                            <div class="parcoursup-footer">
                                <div class="parcoursup-details">
                                    <div class="parcoursup-detail">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                </div>
                                <a href="bts-ccst.php" class="parcoursup-action">Découvrir</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Poursuite d'études -->
                <div class="formation-block">
                    <h3><i class="fas fa-graduation-cap"></i> Poursuite d'études</h3>
                    <p>Après votre BTS, de nombreuses possibilités s'offrent à vous : licence professionnelle, école d'ingénieur, école de commerce ou intégration directe dans le monde professionnel.</p>
                    <div class="text-center" style="margin-top: 1.5rem; text-align: center;">
                        <a href="orientation-bac.php" class="cta-button">En savoir plus sur l'orientation</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
    
    <script src="js/script.js"></script>
</body>
</html> 
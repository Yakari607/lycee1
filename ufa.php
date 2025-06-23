<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UFA - Unité de Formation par Apprentissage - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="css/components/parcoursup-cards.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Styles pour les 3 pôles de formation - Design institutionnel */
        .poles-section h3 {
            color: #000091;
            border-bottom: 2px solid #000091;
            padding-bottom: 8px;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .poles-section h3 .fas {
            color: #000091;
        }
        
        .poles-container {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            margin: 2rem 0;
        }
        
        /* Titre du pôle */
        .pole-header {
            margin-bottom: 1rem;
            background-color: #000091;
            color: white;
            padding: 10px 15px;
            display: flex;
            align-items: center;
        }
        
        .pole-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 1.2rem;
            color: white;
        }
        
        .pole-header h4 {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0;
            color: white;
        }
        
        /* Liste des formations */
        .formations-list {
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
            border: 1px solid #e3e3e3;
        }
        
        .formation-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-bottom: 1px solid #e3e3e3;
            background: white;
        }
        
        .formation-item:last-child {
            border-bottom: none;
        }
        
        .formation-item i {
            font-size: 1rem;
            margin-right: 15px;
            width: 18px;
            text-align: center;
            color: #000091;
        }
        
        .formation-item span {
            flex: 1;
            font-size: 1rem;
            color: #1e1e1e;
        }
        
        /* Badge pour les formations uniques */
        .formation-item.unique {
            background-color: #f9f8f6;
        }
        
        .badge {
            display: inline-block;
            background-color: #e1000f;
            color: white;
            padding: 3px 8px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-left: 10px;
        }
        
        .pole-highlight {
            background-color: #f9f8f6;
            border-left: 4px solid #000091;
            padding: 10px 15px;
            font-weight: 600;
            margin-top: 1rem;
            color: #1e1e1e;
        }
        
        .pole-highlight i {
            margin-right: 8px;
            color: #000091;
        }
        
        /* Mode sombre */
        [data-theme="dark"] .formation-item {
            background-color: #2a2a2a;
            border-color: #444;
        }
        
        [data-theme="dark"] .formation-item span {
            color: #e0e0e0;
        }
        
        [data-theme="dark"] .formation-item.unique {
            background-color: #32302f;
        }
        
        [data-theme="dark"] .formations-list {
            border-color: #444;
        }
        
        [data-theme="dark"] .pole-highlight {
            background-color: #32302f;
            color: #e0e0e0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .pole-header h4 {
                font-size: 1.1rem;
            }
            
            .formation-item {
                padding: 10px;
            }
            
            .formation-item span {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body data-page="ufa">
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php#formations" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour aux formations</span>
        </a>

        <section class="formation-hero" style="background-image: url('images/formations/pexels-kampus-8815880.jpg');">
            <div class="hero-content">
                <h1>UFA Jean-Mermoz</h1>
                <p>Unité de Formation par Apprentissage</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <!-- Présentation -->
                <div class="formation-intro">
                    <div class="formation-card">
                        <h2>Présentation de l'UFA</h2>
                        <div class="formation-type">Formation par apprentissage</div>
                        <p>L'UFA du lycée Jean-Mermoz, intégrée au lycée, est une Unité de Formation par Apprentissage particulièrement atypique. En effet, sa carte de formation compte <strong>15 diplômes relevant de l'apprentissage</strong> pour un total de <strong>125 apprentis</strong>.</p>
                        <p>Ces chiffres s'expliquent par la volonté et la priorité que l'établissement s'est donné de privilégier la mise en œuvre du <strong>mixage de publics</strong> avec les formations relevant du lycée technologique et des sections d'enseignement professionnel.</p>
                        <p>Atypique encore par le nombre très élevé d'enseignants qui a largement dépassé le cap des <strong>65 personnes</strong>.</p>
                    </div>
                    <div class="formation-card image-card">
                        <img src="images/pexels-rdne-7648055.jpg" alt="Apprentis en formation" />
                    </div>
                </div>

                <!-- Chiffres clés -->
                <div class="formation-block">
                    <h3><i class="fas fa-chart-bar"></i> Chiffres clés de l'UFA</h3>
                    <div class="debouches-container">
                        <div class="debouches-list">
                            <div class="debouche-item"><i class="fas fa-graduation-cap"></i> <span>15 diplômes en apprentissage</span></div>
                            <div class="debouche-item"><i class="fas fa-users"></i> <span>125 apprentis</span></div>
                            <div class="debouche-item"><i class="fas fa-chalkboard-teacher"></i> <span>Plus de 65 enseignants</span></div>
                            <div class="debouche-item"><i class="fas fa-sitemap"></i> <span>3 pôles de formation</span></div>
                        </div>
                        <div class="debouches-image">
                            <img src="images/metiers/pexels-ekrulila-2293019.jpg" alt="Formation en apprentissage" class="debouche-img">
                        </div>
                    </div>
                </div>

                <!-- Spécificités -->
                <div class="formation-block">
                    <h3><i class="fas fa-star"></i> Nos spécificités</h3>
                    <div class="qualites-sections">
                        <div class="qualite-section">
                            <h4 class="blue">Mixage de publics</h4>
                            <p>Les 6 BTS que compte le lycée sont tous proposés par alternance sur le principe du mixage de publics.</p>
                            <p>Les 3 BAC PRO du domaine industriel sont proposés également en apprentissage par mixage de publics.</p>
                        </div>
                        <div class="qualite-section">
                            <h4 class="green">Formations exclusives</h4>
                            <p>Les 7ème et 8ème BTS : le BTS MCO et le BTS Maintenance sont proposés uniquement en apprentissage.</p>
                        </div>
                        <div class="qualite-section">
                            <h4 class="orange">Formations uniques</h4>
                            <p>Le BTS Traitement Thermique des Matériaux est une formation unique dans le Grand Est, voire en France en alternance.</p>
                        </div>
                        <div class="qualite-section">
                            <h4 class="pink">Hébergement</h4>
                            <p>Les apprentis dont le domicile est éloigné peuvent être accueillis au centre d'hébergement.</p>
                        </div>
                    </div>
                </div>

                <!-- Les 3 pôles de formation -->
                <div class="formation-block">
                    <div class="poles-section">
                    <h3><i class="fas fa-sitemap"></i> Nos formations par pôle</h3>
                    
                    <div class="poles-container">
                        <!-- Pôle BTS Tertiaires et Industriels -->
                        <div>
                            <div class="pole-header">
                                <div class="pole-icon">
                                    <i class="fas fa-laptop-code"></i>
                                </div>
                                <h4>Pôle BTS Tertiaires et Industriels</h4>
                            </div>
                            <div class="parcoursup-grid">
                                <div class="parcoursup-card">
                                    <div class="parcoursup-status">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div class="parcoursup-header">
                                        <div class="parcoursup-title">
                                            <i class="fas fa-shield-alt"></i>
                                            <h4>BTS Assurance</h4>
                                        </div>
                                        <p class="parcoursup-subtitle">Brevet de Technicien Supérieur</p>
                                    </div>
                                    <div class="parcoursup-body">
                                        <p class="parcoursup-description">Formation aux métiers de l'assurance, de la gestion des contrats et de la relation client.</p>
                                        <div class="parcoursup-tags">
                                            <span class="parcoursup-tag bac">BTS</span>
                                            <span class="parcoursup-tag pro">Tertiaire</span>
                                            <span class="parcoursup-tag">2 ans</span>
                                        </div>
                                    </div>
                                    <div class="parcoursup-footer">
                                        <div class="parcoursup-details">
                                            <div class="parcoursup-detail">
                                                <i class="fas fa-user-graduate"></i>
                                                <span>Niveau 5</span>
                                            </div>
                                        </div>
                                        <a href="bts-assurance.php" class="parcoursup-action">Découvrir</a>
                                    </div>
                                </div>
                                
                                <div class="parcoursup-card">
                                    <div class="parcoursup-status">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div class="parcoursup-header">
                                        <div class="parcoursup-title">
                                            <i class="fas fa-calculator"></i>
                                            <h4>BTS Comptabilité-Gestion</h4>
                                        </div>
                                        <p class="parcoursup-subtitle">Brevet de Technicien Supérieur</p>
                                    </div>
                                    <div class="parcoursup-body">
                                        <p class="parcoursup-description">Formation aux métiers de la comptabilité, de la gestion et de l'analyse financière.</p>
                                        <div class="parcoursup-tags">
                                            <span class="parcoursup-tag bac">BTS</span>
                                            <span class="parcoursup-tag pro">Tertiaire</span>
                                            <span class="parcoursup-tag">2 ans</span>
                                        </div>
                                    </div>
                                    <div class="parcoursup-footer">
                                        <div class="parcoursup-details">
                                            <div class="parcoursup-detail">
                                                <i class="fas fa-user-graduate"></i>
                                                <span>Niveau 5</span>
                                            </div>
                                        </div>
                                        <a href="bts-comptabilite-gestion.php" class="parcoursup-action">Découvrir</a>
                                    </div>
                                </div>
                                
                                <div class="parcoursup-card">
                                    <div class="parcoursup-status">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div class="parcoursup-header">
                                        <div class="parcoursup-title">
                                            <i class="fas fa-handshake"></i>
                                            <h4>BTS CCST</h4>
                                        </div>
                                        <p class="parcoursup-subtitle">Conseil et Commercialisation de Solutions Techniques</p>
                                    </div>
                                    <div class="parcoursup-body">
                                        <p class="parcoursup-description">Formation aux métiers de la vente de solutions techniques et de la négociation commerciale B2B.</p>
                                        <div class="parcoursup-tags">
                                            <span class="parcoursup-tag bac">BTS</span>
                                            <span class="parcoursup-tag pro">Commercial</span>
                                            <span class="parcoursup-tag">2 ans</span>
                                        </div>
                                    </div>
                                    <div class="parcoursup-footer">
                                        <div class="parcoursup-details">
                                            <div class="parcoursup-detail">
                                                <i class="fas fa-user-graduate"></i>
                                                <span>Niveau 5</span>
                                            </div>
                                        </div>
                                        <a href="bts-ccst.php" class="parcoursup-action">Découvrir</a>
                                    </div>
                                </div>
                                
                                <div class="parcoursup-card">
                                    <div class="parcoursup-status apprentissage">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="parcoursup-header">
                                        <div class="parcoursup-title">
                                            <i class="fas fa-store"></i>
                                            <h4>BTS MCO</h4>
                                        </div>
                                        <p class="parcoursup-subtitle">Management Commercial Opérationnel</p>
                                    </div>
                                    <div class="parcoursup-body">
                                        <p class="parcoursup-description">Formation aux métiers du management d'unité commerciale, de la gestion et de l'animation d'équipe.</p>
                                        <div class="parcoursup-tags">
                                            <span class="parcoursup-tag bac">BTS</span>
                                            <span class="parcoursup-tag pro">Commercial</span>
                                            <span class="parcoursup-tag">2 ans</span>
                                        </div>
                                    </div>
                                    <div class="parcoursup-footer">
                                        <div class="parcoursup-details">
                                            <div class="parcoursup-detail">
                                                <i class="fas fa-user-graduate"></i>
                                                <span>Niveau 5</span>
                                            </div>
                                            <div class="parcoursup-detail">
                                                <i class="fas fa-briefcase"></i>
                                                <span>Apprentissage</span>
                                            </div>
                                        </div>
                                        <a href="bts-mco.php" class="parcoursup-action">Découvrir</a>
                                    </div>
                                </div>
                                
                                <div class="parcoursup-card">
                                    <div class="parcoursup-status">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div class="parcoursup-header">
                                        <div class="parcoursup-title">
                                            <i class="fas fa-cogs"></i>
                                            <h4>BTS CPI</h4>
                                        </div>
                                        <p class="parcoursup-subtitle">Conception de Produits Industriels</p>
                                    </div>
                                    <div class="parcoursup-body">
                                        <p class="parcoursup-description">Formation aux métiers de la conception et du développement de produits industriels mécaniques.</p>
                                        <div class="parcoursup-tags">
                                            <span class="parcoursup-tag bac">BTS</span>
                                            <span class="parcoursup-tag pro">Industriel</span>
                                            <span class="parcoursup-tag">2 ans</span>
                                        </div>
                                    </div>
                                    <div class="parcoursup-footer">
                                        <div class="parcoursup-details">
                                            <div class="parcoursup-detail">
                                                <i class="fas fa-user-graduate"></i>
                                                <span>Niveau 5</span>
                                            </div>
                                        </div>
                                        <a href="bts-cpi.php" class="parcoursup-action">Découvrir</a>
                                    </div>
                                </div>
                                
                                <div class="parcoursup-card">
                                    <div class="parcoursup-status apprentissage">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="parcoursup-header">
                                        <div class="parcoursup-title">
                                            <i class="fas fa-fire"></i>
                                            <h4>BTS Traitement des Matériaux</h4>
                                        </div>
                                        <p class="parcoursup-subtitle">Option Traitements Thermiques</p>
                                    </div>
                                    <div class="parcoursup-body">
                                        <p class="parcoursup-description">Formation unique dans le Grand Est aux techniques de traitement thermique des matériaux métalliques.</p>
                                        <div class="parcoursup-tags">
                                            <span class="parcoursup-tag bac">BTS</span>
                                            <span class="parcoursup-tag pro">Industriel</span>
                                            <span class="parcoursup-tag">2 ans</span>
                                            <span class="parcoursup-tag cap">UNIQUE</span>
                                        </div>
                                    </div>
                                    <div class="parcoursup-footer">
                                        <div class="parcoursup-details">
                                            <div class="parcoursup-detail">
                                                <i class="fas fa-user-graduate"></i>
                                                <span>Niveau 5</span>
                                            </div>
                                            <div class="parcoursup-detail">
                                                <i class="fas fa-briefcase"></i>
                                                <span>Apprentissage</span>
                                            </div>
                                        </div>
                                        <a href="bts-tm.php" class="parcoursup-action">Découvrir</a>
                                    </div>
                                </div>
                                
                                <div class="parcoursup-card">
                                    <div class="parcoursup-status apprentissage">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="parcoursup-header">
                                        <div class="parcoursup-title">
                                            <i class="fas fa-wrench"></i>
                                            <h4>BTS Maintenance des Systèmes</h4>
                                        </div>
                                        <p class="parcoursup-subtitle">Option Systèmes de Production</p>
                                    </div>
                                    <div class="parcoursup-body">
                                        <p class="parcoursup-description">Formation aux techniques de maintenance industrielle et d'optimisation des équipements de production.</p>
                                        <div class="parcoursup-tags">
                                            <span class="parcoursup-tag bac">BTS</span>
                                            <span class="parcoursup-tag pro">Industriel</span>
                                            <span class="parcoursup-tag">2 ans</span>
                                        </div>
                                    </div>
                                    <div class="parcoursup-footer">
                                        <div class="parcoursup-details">
                                            <div class="parcoursup-detail">
                                                <i class="fas fa-user-graduate"></i>
                                                <span>Niveau 5</span>
                                            </div>
                                            <div class="parcoursup-detail">
                                                <i class="fas fa-briefcase"></i>
                                                <span>Apprentissage</span>
                                            </div>
                                        </div>
                                        <a href="bts-ms.php" class="parcoursup-action">Découvrir</a>
                                    </div>
                                </div>
                            </div>
                            <div class="pole-highlight">
                                <i class="fas fa-info-circle"></i>
                                Le BTS Traitement des Matériaux est une formation unique dans le Grand Est, voire en France en alternance
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <!-- Formations uniques -->
                <div class="formation-block">
                    <h3><i class="fas fa-medal"></i> Notre formation unique</h3>
                    <p>Le BTS Traitement Thermique des Matériaux est une formation unique dans le Grand Est, voire en France en alternance :</p>
                    
                    <div class="specialty-grid">
                        <div class="specialty-item">
                            <h4>BTS Traitement Thermique des Matériaux</h4>
                            <p>Cette formation spécialisée dans le traitement des matériaux est particulièrement rare en France et constitue une opportunité exceptionnelle pour les apprentis souhaitant se spécialiser dans ce domaine recherché par les industries.</p>
                        </div>
                    </div>
                </div>

                <!-- Candidatures -->
                <div class="formation-block">
                    <h3><i class="fas fa-file-alt"></i> Candidatures à l'apprentissage</h3>
                    <div class="formation-intro">
                        <div class="formation-card">
                            <h4>Déposer une candidature</h4>
                            <p>Vous souhaitez rejoindre notre UFA ? Déposez votre candidature dès maintenant !</p>
                            <p><strong>Rendez-vous à l'adresse suivante :</strong></p>
                            <p><a href="https://cfa-ac-alsace.ymag.cloud/index.php/preinscription/" target="_blank" class="cta-button">
                                <i class="fas fa-external-link-alt"></i> Déposer une candidature
                            </a></p>
                        </div>
                        <div class="formation-card">
                            <h4>Apprentissage</h4>
                            <p>L'apprentissage vous permet de :</p>
                            <ul>
                                <li>Percevoir une rémunération pendant votre formation</li>
                                <li>Acquérir une expérience professionnelle concrète</li>
                                <li>Obtenir le même diplôme que la voie scolaire</li>
                                <li>Bénéficier d'un excellent taux d'insertion professionnelle</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Avantages de l'apprentissage -->
                <div class="formation-block">
                    <h3><i class="fas fa-thumbs-up"></i> Les avantages de l'apprentissage</h3>
                    <div class="debouches-container">
                        <div class="debouches-list">
                            <div class="debouche-item"><i class="fas fa-euro-sign"></i> <span>Rémunération pendant la formation</span></div>
                            <div class="debouche-item"><i class="fas fa-graduation-cap"></i> <span>Formation gratuite</span></div>
                            <div class="debouche-item"><i class="fas fa-briefcase"></i> <span>Expérience professionnelle</span></div>
                            <div class="debouche-item"><i class="fas fa-rocket"></i> <span>Insertion facilitée</span></div>
                            <div class="debouche-item"><i class="fas fa-users"></i> <span>Mixage de publics</span></div>
                            <div class="debouche-item"><i class="fas fa-home"></i> <span>Hébergement possible</span></div>
                        </div>
                        <div class="debouches-image">
                            <img src="images/formations/pexels-fauxels-3184398.jpg" alt="Apprentis en formation" class="debouche-img">
                        </div>
                    </div>
                </div>

                <!-- Poursuites d'études -->
                <div class="formation-block">
                    <h3><i class="fas fa-graduation-cap"></i> Et après l'apprentissage...</h3>
                    <button class="collapsible-header">
                        Poursuite d'études et insertion professionnelle <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="collapsible-content">
                        <div class="apres-bac">
                            <div class="apres-bac-item">
                                <h4>1- Insertion professionnelle directe</h4>
                                <p>L'apprentissage offre un excellent taux d'insertion professionnelle :</p>
                                <ul>
                                    <li>Embauche directe dans l'entreprise d'apprentissage</li>
                                    <li>Recherche d'emploi facilitée grâce à l'expérience acquise</li>
                                    <li>Réseau professionnel déjà constitué</li>
                                </ul>
                            </div>
                            <div class="apres-bac-item">
                                <h4>2- Poursuite d'études</h4>
                                <p>Possibilité de poursuivre ses études après un diplôme en apprentissage :</p>
                                <ul>
                                    <li>Licence professionnelle</li>
                                    <li>École d'ingénieur</li>
                                    <li>École de commerce</li>
                                    <li>Formations spécialisées</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hébergement -->
                <div class="hebergement-section">
                    <h3><i class="fas fa-home"></i> Hébergement</h3>
                    <div class="hebergement-content">
                        <p>Il est à noter également que les apprentis dont le domicile est éloigné peuvent être accueillis au centre d'hébergement.</p>
                        
                        <h4>Conditions d'hébergement</h4>
                        <ul>
                            <li>L'internat est ouvert du lundi matin au vendredi midi.</li>
                            <li>Le centre d'hébergement dispose par ailleurs d'une cafétéria, d'une salle de télévision, d'une salle de billard ainsi que de lieux de détente et de travail.</li>
                            <li>Les chambres sont récentes et disposent d'un accès Wifi.</li>
                        </ul>
                        <p><a href="internat.php" class="cta-button secondary">En savoir plus sur l'internat</a></p>
                    </div>
                </div>

                <!-- Contact -->
                <div class="contact-section">
                    <h3><i class="fas fa-map-marker-alt"></i> Localisation et contact</h3>
                    <div class="contact-content">
                        <div class="contact-address">
                            <h4>Contact</h4>
                            <p>
                                Lycée Jean-Mermoz<br>
                                53 rue du Docteur Hurst<br>
                                68301 Saint-Louis Cedex
                                <a href="https://maps.google.com/?q=Lycée+Jean+Mermoz,+53+rue+du+Docteur+Hurst,+68301+Saint-Louis+Cedex,+France" target="_blank" class="map-link" title="Voir sur Google Maps">
                                    <i class="fas fa-map"></i>
                                </a>
                            </p>
                            <p><i class="fas fa-phone"></i> +33 389 70 22 70</p>
                        </div>
                        
                        <div class="contact-info">
                            <div class="contact-block">
                                <h4>Direction de l'UFA</h4>
                                <p>Directeur Délégué à l'UFA<br>
                                <a href="mailto:ddufa@lyceemermoz.fr">ddufa@lyceemermoz.fr</a></p>
                            </div>
                            
                            <div class="contact-block">
                                <h4>Développement de l'Apprentissage</h4>
                                <p>Victoria Viegas<br>
                                Chargée de Développement de l'Apprentissage<br>
                                <a href="mailto:victoria.viegas@cfa-academique.fr">victoria.viegas@cfa-academique.fr</a></p>
                            </div>
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
    <script src="js/page-specific/formation.js"></script>
</body>
</html> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BAC PRO Métiers de l'Accueil - Lycée Jean Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
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
        <a href="index.php#formations" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour aux formations</span>
        </a>

        <section class="formation-hero">
            <div class="hero-content">
                <h1>BAC PRO Métiers de l'Accueil</h1>
                <p>Formation professionnelle qualifiante</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <!-- Introduction -->
                <div class="formation-intro">
                    <div class="formation-card">
                        <h2>La formation Bac Pro Métiers de l'Accueil</h2>
                        <div class="formation-type">Formation sous statut scolaire</div>
                        <p>Ce bac pro forme aux métiers de l'accueil dans tous types d'organisations et dans des contextes variés : accueil en entreprises, évènementiel, …</p>
                        <p>L'activité d'accueil peut être réalisée en face à face ou à distance, directement avec les publics accueillis mais aussi entre les services de l'organisation elle-même ou avec ceux des organisations partenaires.</p>
                        <p>Ce cœur de métier de l'accueil peut s'élargir à un ensemble d'activités administratives, commerciales et de logistique légère.</p>
                    </div>

                    <div class="formation-card">
                        <h2>Métiers de la Relation Client</h2>
                        <div class="admission-info">
                            <i class="fas fa-user-graduate"></i>
                            <span><strong>24 places</strong> proposées au lycée Jean Mermoz<br>dont <strong>12</strong> en Bac Pro Métiers de l'Accueil</span>
                        </div>
                    </div>
                </div>

                <!-- Contenu détaillé -->
                <div class="formation-content">
                    <!-- Parcours de formation avec timeline chronologique -->
                    <div class="formation-block parcours-block">
                        <h3 class="parcours-title">Le parcours de formation</h3>
                        
                        <div class="timeline-container">
                            <div class="timeline">
                                <div class="timeline-top">
                                    <div class="timeline-item">
                                        <div class="timeline-content">
                                            <h4>Découverte</h4>
                                            <ul>
                                                <li>15h enseignements pros</li>
                                                <li>11h50 enseignements généraux</li>
                                                <li>6 semaines de stage</li>
                                            </ul>
                                        </div>
                                        <div class="timeline-badge">
                                            <span class="timeline-badge-label badge-seconde">Seconde</span>
                                            <div class="timeline-badge-circle badge-seconde"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-content">
                                            <h4>Pratique professionnelle</h4>
                                            <ul>
                                                <li>8 semaines de stage</li>
                                                <li>Compétences professionnelles</li>
                                            </ul>
                                        </div>
                                        <div class="timeline-badge">
                                            <span class="timeline-badge-label badge-premiere">Première</span>
                                            <div class="timeline-badge-circle badge-premiere"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-content">
                                            <h4>Perfection&shy;nement</h4>
                                            <ul>
                                                <li>Préparation à l'examen</li>
                                                <li>8 semaines de stage</li>
                                            </ul>
                                        </div>
                                        <div class="timeline-badge">
                                            <span class="timeline-badge-label badge-terminale">Terminale</span>
                                            <div class="timeline-badge-circle badge-terminale"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="timeline-bottom">
                                    <div class="timeline-item">
                                        <div class="timeline-badge">
                                            <span class="timeline-badge-label badge-access">Accès</span>
                                            <div class="timeline-badge-circle badge-access"></div>
                                        </div>
                                        <div class="timeline-content">
                                            <h4>Entrée en formation</h4>
                                            <ul>
                                                <li>Élèves 3<sup>ème</sup> générale</li>
                                                <li>Élèves issus d'un CAP</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-badge">
                                            <span class="timeline-badge-label badge-orientation">Orientation</span>
                                            <div class="timeline-badge-circle badge-orientation"></div>
                                        </div>
                                        <div class="timeline-content">
                                            <h4>Choix de formation</h4>
                                            <ul>
                                                <li>Bac Pro Métiers de l'Accueil</li>
                                                <li>Métiers du Commerce</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-badge">
                                            <span class="timeline-badge-label badge-certification">Certification</span>
                                            <div class="timeline-badge-circle badge-certification"></div>
                                        </div>
                                        <div class="timeline-content">
                                            <h4>Attestation</h4>
                                            <ul>
                                                <li>Validation des acquis</li>
                                                <li>Certification intermédiaire</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-item">
                                        <div class="timeline-badge">
                                            <span class="timeline-badge-label badge-diplome">Diplôme</span>
                                            <div class="timeline-badge-circle badge-diplome"></div>
                                        </div>
                                        <div class="timeline-content">
                                            <h4>Bac Pro</h4>
                                            <div class="timeline-info">
                                                <div class="info-badge">
                                                    <i class="fas fa-graduation-cap"></i>
                                                    <span>Niveau 4</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="formation-block">
                        <h3><i class="fas fa-briefcase"></i> Les débouchés</h3>
                        <p>Dans tout type d'organisation commerciale ou non (administration, association…), le-a diplômé-e occupe des postes de :</p>
                        <div class="debouches-grid">
                            <div class="debouche-item">
                                <i class="fas fa-headset"></i>
                                <span>Chargé-e d'accueil</span>
                            </div>
                            <div class="debouche-item">
                                <i class="fas fa-concierge-bell"></i>
                                <span>Hôte-sse d'accueil, d'évènementiel</span>
                            </div>
                            <div class="debouche-item">
                                <i class="fas fa-user-tie"></i>
                                <span>Agent-e d'accueil</span>
                            </div>
                            <div class="debouche-item">
                                <i class="fas fa-phone-alt"></i>
                                <span>Standardiste</span>
                            </div>
                            <div class="debouche-item">
                                <i class="fas fa-headset"></i>
                                <span>Téléopérateur(-trice), téléconseiller-e</span>
                            </div>
                            <div class="debouche-item">
                                <i class="fas fa-cash-register"></i>
                                <span>Chef de vente, de rayon ou de caisse</span>
                            </div>
                            <div class="debouche-item">
                                <i class="fas fa-user-friends"></i>
                                <span>Conseiller de clientèle</span>
                            </div>
                            <div class="debouche-item">
                                <i class="fas fa-plane"></i>
                                <span>Agent-e d'escale</span>
                            </div>
                            <div class="debouche-item">
                                <i class="fas fa-globe"></i>
                                <span>Conseiller-e commercial-le de voyage</span>
                            </div>
                        </div>
                    </div>

                    <div class="formation-block">
                        <h3><i class="fas fa-road"></i> Et après le Bac Pro …</h3>
                        <div class="apres-bac">
                            <div class="apres-bac-item">
                                <h4>1- Insertion Professionnelle</h4>
                                <p>Le Diplôme du Bac Pro Métiers de l'Accueil est un diplôme professionnel qui permet de se présenter sur le marché du travail.</p>
                            </div>
                            
                            <div class="apres-bac-item">
                                <h4>2- Mention Complémentaire</h4>
                                <p>Il est également possible de compléter sa formation avec une Mention Complémentaire (MC en 1 an) :</p>
                                <ul>
                                    <li>MC Accueil dans les transports</li>
                                    <li>MC Accueil-Réception</li>
                                </ul>
                            </div>
                            
                            <div class="apres-bac-item">
                                <h4>3- BTS ou Licences Pro</h4>
                                <p>Avec un très bon dossier ou une mention à l'examen, une poursuite d'études en BTS est envisageable.</p>
                                <ul>
                                    <li>BTS Management Commercial Opérationnel</li>
                                    <li>BTS Négociation et Digitalisation de la Relation Client</li>
                                    <li>BTS Support à l'Action Managériale</li>
                                    <li>BTS Professions Immobilières</li>
                                    <li>BTS Tourisme</li>
                                    <li>Licence professionnelle dans les secteurs de la banque ou des assurances (Licence Conseil en Assurance et Services Financiers de Saint Louis-Colmar)</li>
                                    <li>Licence d'économie-gestion</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hébergement -->
                <div class="hebergement-section">
                    <h3><i class="fas fa-home"></i> Hébergement</h3>
                    <div class="hebergement-content">
                        <p>Le lycée Jean-Mermoz possède un centre d'hébergement mixte.</p>
                        
                        <h4>Conditions d'hébergement</h4>
                        <ul>
                            <li>L'internat est ouvert du lundi matin au vendredi matin.</li>
                            <li>Le centre d'hébergement dispose par ailleurs d'une cafétéria, d'une salle de télévision, d'une salle de billard ainsi que de lieux de détente et de travail.</li>
                            <li>Les chambres sont récentes et disposent d'un accès Wifi.</li>
                        </ul>
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
                            </p>
                            <p><i class="fas fa-phone"></i> 03 89 70 22 70</p>
                        </div>
                        
                        <div class="contact-info">
                            <div class="contact-block">
                                <h4>Voie Scolaire</h4>
                                <p>Directrice Déléguée aux Formations Professionnelles et Technologiques<br>
                                <a href="mailto:ddfpt.tertiaire@lyceemermoz.fr">ddfpt.tertiaire@lyceemermoz.fr</a></p>
                            </div>
                            
                            <div class="contact-block">
                                <h4>Apprentissage</h4>
                                <p>Directeur Délégué de l'UFA Jean Mermoz<br>
                                <a href="mailto:ddufa@lyceemermoz.fr">ddufa@lyceemermoz.fr</a></p>
                                
                                <p>Chargée de Développement de l'Apprentissage<br>
                                Victoria VIEGAS<br>
                                <a href="mailto:victoria.viegas@cfa-academique.fr">victoria.viegas@cfa-academique.fr</a></p>
                            </div>
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
</body>
</html> 
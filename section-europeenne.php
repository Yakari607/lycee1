<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section Européenne et DNL - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body data-page="section-europeenne">
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php#langues" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>retour à l'accueil</span>
        </a>

        <section class="formation-hero" style="background-image: url('images/formations/pexels-photo-45923.jpeg');">
            <div class="hero-content">
                <h1>Section Européenne et DNL</h1>
                <p>Formation d'excellence en anglais</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <!-- Présentation -->
                <div class="formation-intro">
                    <div class="formation-card">
                        <h2>Qu'est-ce que la Section Européenne et DNL ?</h2>
                        <div class="formation-type">Formation d'excellence en anglais</div>
                        <p>Une formation qui permet de :</p>
                        <ul>
                            <li>Renforcer ses compétences en anglais à travers des disciplines non-linguistiques</li>
                            <li>Obtenir une mention « Section européenne » ou DNL sur le diplôme du Bac</li>
                        </ul>
                    </div>
                    <div class="formation-card image-card">
                        <img src="images/formations/pexels-photo-9381640.webp" alt="Étudiants en formation européenne" />
                    </div>
                </div>

                <!-- Organisation -->
                <div class="formation-block">
                    <h3><i class="fas fa-clock"></i> Organisation</h3>
                    <div class="formation-content">
                        <div class="content-card">
                            <h4 class="section-title">Emploi du temps hebdomadaire</h4>
                            <ul>
                                <li>1.5h de sciences de l'ingénieur en anglais / semaine à travers une pédagogie par projets</li>
                                <li>1h de mathématiques en anglais / semaine</li>
                                <li>1h de cinéma</li>
                            </ul>
                            <p><strong>Note :</strong> Effectif contingenté avec tests de sélection en juin</p>
                        </div>
                    </div>
                </div>

                <!-- Section Euro Cinéma -->
                <div class="formation-block">
                    <h3><i class="fas fa-film"></i> Section Euro Cinéma</h3>
                    <div class="formation-content">
                        <div class="content-card">
                            <h4 class="section-title">Zoom sur la DNL Euro Cinéma</h4>
                            <p>Passionné de cinéma, venez découvrir la section Euro Cinéma</p>
                            <div class="video-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/dHylxmrc2Ow" title="Présentation de l'Euro Cinéma" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="download-section">
                                <a href="#" class="download-link">
                                    <i class="fas fa-download"></i>
                                    Télécharger la plaquette de la section
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DNL Sciences de l'Ingénieur -->
                <div class="formation-block">
                    <h3><i class="fas fa-microchip"></i> DNL Sciences de l'Ingénieur</h3>
                    <div class="formation-content">
                        <div class="content-card">
                            <h4 class="section-title">ENGINEERING CLASS</h4>
                            <p>Envie de vivre des projets de A à Z ? Envie de laisser votre imagination vous mener vers des réalisations originales ?</p>
                            <p>Envie de devenir des maîtres Jedi de la recherche de vocabulaire sur internet ?</p>
                            <p>Envie de défendre vos idées en langue anglaise ?</p>
                            <p>Ben, vous savez ce qu'il vous reste à faire ! 😉</p>
                            <div class="video-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/EZKOqtq__3U" title="Our project in Seconde: the eLight bike light" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Qualités requises -->
                <div class="formation-block">
                    <h3><i class="fas fa-star"></i> Les qualités requises</h3>
                    <div class="qualites-sections">
                        <div class="qualite-section">
                            <h4 class="blue">Niveau d'anglais</h4>
                            <p>Un bon niveau d'anglais est requis pour suivre les cours en langue anglaise.</p>
                        </div>
                        <div class="qualite-section">
                            <h4 class="green">Motivation</h4>
                            <p>Une forte motivation pour l'apprentissage des langues et des disciplines non linguistiques.</p>
                        </div>
                        <div class="qualite-section">
                            <h4 class="orange">Autonomie</h4>
                            <p>Capacité à travailler en autonomie et à s'investir dans des projets.</p>
                        </div>
                        <div class="qualite-section">
                            <h4 class="pink">Curiosité</h4>
                            <p>Intérêt pour les cultures anglophones et les disciplines enseignées en anglais.</p>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="contact-section">
                    <h3><i class="fas fa-map-marker-alt"></i> Localisation et contact</h3>
                    <div class="contact-content">
                        <div class="contact-address">
                            <h4>Contact</h4>
                            <p>Lycée Jean-Mermoz<br>53 rue du Docteur Hurst<br>68301 Saint Louis
                                <a href="https://maps.google.com/?q=Lycée+Jean+Mermoz,+53+rue+du+Docteur+Hurst,+68301+Saint-Louis,+France" target="_blank" class="map-link" title="Voir sur Google Maps">
                                    <i class="fas fa-map"></i>
                                </a>
                            </p>
                            <p><i class="fas fa-phone"></i> +33 389 70 22 71</p>
                        </div>
                        <div class="contact-info">
                            <div class="contact-block">
                                <h4>Responsable de la section européenne</h4>
                                <p>Service des Langues<br>
                                <a href="mailto:langues@lyceemermoz.fr">langues@lyceemermoz.fr</a></p>
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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDI - Centre de Documentation et d'Information - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .cdi-section {
            margin-bottom: 2rem;
        }
        
        .cdi-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .cdi-card h3 {
            color: #000091;
            border-bottom: 2px solid #000091;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        .cdi-card p {
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        .cdi-hours {
            background-color: #f9f8f6;
            border-left: 4px solid #000091;
            padding: 1rem;
            margin: 1.5rem 0;
        }
        
        .cdi-hours h4 {
            font-size: 1.1rem;
            color: #000091;
            margin-bottom: 0.5rem;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .feature-box {
            background-color: #f9f8f6;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .feature-box:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: #000091;
            margin-bottom: 1rem;
        }
        
        .feature-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #000091;
        }
        
        .feature-text {
            font-size: 0.95rem;
            color: #333;
        }
        
        .visit-button {
            display: inline-block;
            background-color: #000091;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            margin-top: 1.5rem;
            transition: background-color 0.3s ease;
        }
        
        .visit-button:hover {
            background-color: #1a1a9f;
        }
        
        .slideshow-container {
            position: relative;
            margin: 2rem auto;
            max-width: 800px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .slideshow-slide {
            display: none;
            text-align: center;
        }
        
        .slideshow-slide img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
        }
        
        .slideshow-prev, .slideshow-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            padding: 1rem;
            color: white;
            font-weight: bold;
            background-color: rgba(0,0,0,0.5);
            border: none;
            cursor: pointer;
            z-index: 10;
        }
        
        .slideshow-prev {
            left: 0;
            border-radius: 0 4px 4px 0;
        }
        
        .slideshow-next {
            right: 0;
            border-radius: 4px 0 0 4px;
        }
        
        /* Mode sombre */
        [data-theme="dark"] .cdi-card {
            background-color: var(--card-bg);
        }
        
        [data-theme="dark"] .cdi-hours,
        [data-theme="dark"] .feature-box {
            background-color: #2a2a2a;
        }
        
        [data-theme="dark"] .feature-text {
            color: var(--text-color);
        }
        
        @media (max-width: 768px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .cdi-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à l'accueil</span>
        </a>

        <section class="formation-hero" style="background-image: url('images/formations/pexels-pixabay-159740.jpg');">
            <div class="hero-content">
                <h1>Centre de Documentation et d'Information</h1>
                <p>Un espace de recherche, de lecture et de travail</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <!-- Présentation du CDI -->
                <div class="cdi-section">
                    <div class="cdi-card">
                        <h3><i class="fas fa-book-reader"></i> Le Centre de Documentation et d'Information</h3>
                        <p>Les professeurs-documentalistes vous accueillent au C.D.I. du lundi au vendredi de 7h45 à 17h45 (jusqu'à 16h45 le vendredi).</p>
                        
                        <p>Le C.D.I est un lieu de recherche et de lecture. Vous pouvez emprunter 4 documents, y compris des bandes dessinées, des mangas et des DVD, pour une durée de 3 semaines renouvelables.</p>
                        
                        <div class="cdi-hours">
                            <h4><i class="fas fa-clock"></i> Horaires d'ouverture</h4>
                            <p>Du lundi au jeudi : <strong>7h45 - 17h45</strong><br>
                            Vendredi : <strong>7h45 - 16h45</strong></p>
                        </div>
                        
                        <p>Pour favoriser le travail des enseignants comme celui des élèves, le C.D.I met à votre disposition :</p>
                        
                        <div class="features-grid">
                            <div class="feature-box">
                                <div class="feature-icon">
                                    <i class="fas fa-desktop"></i>
                                </div>
                                <div class="feature-title">15 postes informatiques</div>
                                <div class="feature-text">Accès internet et logiciels de recherche documentaire</div>
                            </div>
                            
                            <div class="feature-box">
                                <div class="feature-icon">
                                    <i class="fas fa-th-large"></i>
                                </div>
                                <div class="feature-title">13 grilles d'exposition</div>
                                <div class="feature-text">Pour les projets pédagogiques et culturels</div>
                            </div>
                            
                            <div class="feature-box">
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="feature-title">3 salles de travail en groupe</div>
                                <div class="feature-text">Espaces dédiés aux travaux collaboratifs</div>
                            </div>
                        </div>
                        
                        <p>La réservation de la Salle audiovisuelle Mermoz Palace se fait sur MBN : <a href="http://monbureaunumerique.fr/" target="_blank">http://monbureaunumerique.fr/</a></p>
                        
                        <div style="text-align: center; margin-top: 2rem;">
                            <p>Venez découvrir le site web du CDI ! Vous y trouverez tous nos documents :</p>
                            <a href="https://0680066c.esidoc.fr/" class="visit-button"><i class="fas fa-external-link-alt"></i> Visiter le site web du CDI</a>
                        </div>
                    </div>
                </div>
                
                <!-- Visite virtuelle -->
                <div class="cdi-section">
                    <div class="cdi-card">
                        <h3><i class="fas fa-video"></i> Visite virtuelle du CDI</h3>
                        <p>C'est parti pour une visite virtuelle ! Faites défiler les flèches ci-dessous :</p>
                        
                        <div class="slideshow-container">
                            <div class="slideshow-slide">
                                <img src="images/cdi/cdi-photo-1.jpg" alt="Vue du CDI - espace de lecture">
                            </div>
                            
                            <div class="slideshow-slide">
                                <img src="images/cdi/cdi-photo-2.jpg" alt="Vue du CDI - postes informatiques">
                            </div>
                            
                            <div class="slideshow-slide">
                                <img src="images/cdi/cdi-photo-3.jpg" alt="Vue du CDI - rayonnages">
                            </div>
                            
                            <button class="slideshow-prev"><i class="fas fa-chevron-left"></i></button>
                            <button class="slideshow-next"><i class="fas fa-chevron-right"></i></button>
                        </div>

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
                                <h4>Professeurs-documentalistes</h4>
                                <p>Pour toute question concernant le CDI :<br>
                                <a href="mailto:cdi@lyceemermoz.fr">cdi@lyceemermoz.fr</a></p>
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
    <script>
        // Script pour le diaporama
        document.addEventListener('DOMContentLoaded', function() {
            let slideIndex = 0;
            const slides = document.querySelectorAll('.slideshow-slide');
            const prevBtn = document.querySelector('.slideshow-prev');
            const nextBtn = document.querySelector('.slideshow-next');
            
            // Afficher le premier slide
            showSlides();
            
            // Fonction pour afficher un slide spécifique
            function showSlides() {
                // Masquer tous les slides
                for (let i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                
                // Afficher le slide courant
                slides[slideIndex].style.display = "block";
            }
            
            // Bouton précédent
            prevBtn.addEventListener('click', function() {
                slideIndex--;
                if (slideIndex < 0) {
                    slideIndex = slides.length - 1;
                }
                showSlides();
            });
            
            // Bouton suivant
            nextBtn.addEventListener('click', function() {
                slideIndex++;
                if (slideIndex >= slides.length) {
                    slideIndex = 0;
                }
                showSlides();
            });
        });
    </script>
</body>
</html> 
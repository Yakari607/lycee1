<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pass Ingénieur - Lycée Jean Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body data-page="pass-ingenieur">
    <?php include 'includes/navbar.php'; ?>
    <main>
        <a href="index.php#seconde" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour aux formations</span>
        </a>
        <section class="formation-hero" style="background-image: url('images/formations/pexels-kevin-ku-92347-577585.jpg');">
            <div class="hero-content">
                <h1>Pass Ingénieur & Pass Ingénieur Euro-Anglais</h1>
                <p>La combinaison gagnante SI & CIT pour la seconde générale</p>
            </div>
        </section>
        <section class="formation-section">
            <div class="container">
                <!-- Présentation -->
                <div class="formation-intro">
                    <div class="formation-card">
                        <h2>Le Pass Ingénieur, c'est quoi ?</h2>
                        <div class="formation-type">Enseignement d'exploration en seconde</div>
                        <p>Le Pass Ingénieur (et Pass Ingénieur Euro-Anglais) est une combinaison des modules Sciences de l'Ingénieur (SI) et Création et Innovation Technologiques (CIT) proposée aux élèves de seconde générale. Près de 50% des élèves de seconde au lycée Mermoz suivent ce parcours innovant et ludique.</p>
                        <p>Il s'agit de la préparation idéale au nouveau bac STI2D.</p>
                    </div>
                    <div class="formation-card image-card">
                        <img src="images/formations/pexels-thisisengineering-3913025.jpg" alt="Projet Pass Ingénieur" />
                    </div>
                </div>
                <!-- Objectifs -->
                <div class="formation-block">
                    <h3><i class="fas fa-bullseye"></i> Les objectifs</h3>
                    <div class="formation-content">
                        <div class="content-card">
                            <p>Notre société a besoin de projets innovants et de créativité afin de répondre aux défis de la planète, à savoir la préservation des ressources et l'usage de nouvelles énergies propres.</p>
                            <p>Chacun peut y contribuer dans sa vie de tous les jours et la technologie qui nous entoure est en constant mouvement pour essayer de relever ce défi d'envergure.</p>
                            <p>La culture technologique est passionnante à explorer, que l'on soit un passionné ou juste un citoyen curieux et soucieux de contribuer à la préservation de son environnement.</p>
                            <p>Avec une approche ludique et pratique, le Pass Ingénieur (combinaison des modules SI et CIT) propose cette exploration aux élèves de seconde générale. Cet enseignement d'exploration est actuellement suivi par près de 50% des élèves de seconde au lycée Mermoz.</p>
                            <p><strong>Grâce à l'enseignement d'exploration Pass Ingénieur, les élèves de seconde peuvent :</strong></p>
                            <ul>
                                <li>Acquérir la maîtrise de la technologie</li>
                                <li>Se familiariser avec les processus de création et de conception</li>
                                <li>S'initier au travail en équipe</li>
                                <li>Solliciter l'esprit créatif et s'initier au raisonnement critique</li>
                                <li>Apprendre à résoudre les problèmes propres à l'exécution d'un projet</li>
                                <li>Prendre confiance en soi</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Vidéo projet élèves -->
                <div class="formation-block">
                    <h3><i class="fas fa-video"></i> Découvrez un projet d'élèves</h3>
                    <div class="formation-content">
                        <div class="content-card">
                            <p>Laissez les élèves vous présenter eux-mêmes un de leurs projets !</p>
                            <div class="video-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/bFGkVrpFdF8" title="Projet Pass Ingénieur" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Contact -->
                <div class="contact-section">
                    <h3><i class="fas fa-map-marker-alt"></i> Localisation et contact</h3>
                    <div class="contact-content">
                        <div class="contact-address">
                            <h4>Contact</h4>
                            <p>Lycée Jean-Mermoz<br>53 rue du Docteur Hurst<br>68301 Saint-Louis Cedex</p>
                            <p><i class="fas fa-phone"></i> +33 389 70 22 70</p>
                        </div>
                        <div class="contact-info">
                            <div class="contact-block">
                                <h4>Voie Scolaire</h4>
                                <p>Directeur Délégué aux Formations Professionnelles et Technologiques<br>Bernard Kempf</p>
                            </div>
                        </div>
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
    <script src="js/page-specific/formation.js"></script>
</body>
</html> 
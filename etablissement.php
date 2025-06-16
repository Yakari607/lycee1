<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'établissement - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body data-page="etablissement">
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à l'accueil</span>
        </a>

        <section class="formation-hero">
            <div class="hero-content">
                <h1>Notre établissement</h1>
                <p>Découvrez le Lycée Jean-Mermoz</p>
            </div>
        </section>

        <div class="container">
            <!-- Section Présentation -->
            <section id="presentation" class="section-content">
                <h2>Présentation du lycée</h2>
                <div class="content-grid">
                    <div class="text-content">
                        <p>Le Lycée Jean-Mermoz de Saint-Louis est un établissement polyvalent d'enseignement général, technologique et professionnel. Fort de ses 1700 élèves et étudiants, il constitue l'un des plus grands lycées d'Alsace.</p>
                        
                        <p>Notre établissement propose une offre de formation diversifiée allant de la seconde générale aux BTS, en passant par les filières professionnelles et l'apprentissage. Cette diversité fait notre richesse et permet à chaque élève de trouver sa voie.</p>

                        <h3>Nos valeurs</h3>
                        <ul class="values-list">
                            <li><i class="fas fa-graduation-cap"></i> Excellence pédagogique</li>
                            <li><i class="fas fa-lightbulb"></i> Innovation éducative</li>
                            <li><i class="fas fa-handshake"></i> Accompagnement personnalisé</li>
                            <li><i class="fas fa-globe"></i> Ouverture internationale</li>
                            <li><i class="fas fa-leaf"></i> Développement durable</li>
                        </ul>
                    </div>
                    <div class="image-content">
                        <img src="images/batiments/c-est-la-rentree-ce-lundi-au-lycee-jean-mermoz-de-saint-louis-avec-une-17e-classe-de-seconde-qui-vient-s-ajouter-a-des-effectifs-consequents-qui-font-du-lycee-ludovicien-le-plus-grand-d-alsace-photo-l-alsace-1567245623.jpg" alt="Vue du lycée Jean-Mermoz" class="responsive-image">
                    </div>
                </div>
            </section>

            <!-- Section Équipe -->
            <section id="equipe" class="section-content">
                <h2>L'équipe dirigeante</h2>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-info">
                            <h3>Direction</h3>
                            <p><strong>Proviseur :</strong> M. [Nom]</p>
                            <p><strong>Proviseur Adjoint :</strong> Mme [Nom]</p>
                            <p><strong>Gestionnaire :</strong> M./Mme [Nom]</p>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="member-info">
                            <h3>Conseillers Principaux d'Éducation</h3>
                            <p>Une équipe de CPE dédiée à l'accompagnement et au suivi des élèves dans leur parcours scolaire et personnel.</p>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="member-info">
                            <h3>Corps enseignant</h3>
                            <p>Plus de 150 professeurs qualifiés dans toutes les disciplines, engagés dans la réussite de nos élèves.</p>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="member-info">
                            <h3>Personnel administratif et technique</h3>
                            <p>Une équipe complète pour assurer le bon fonctionnement de l'établissement au quotidien.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section Infrastructures -->
            <section id="infrastructures" class="section-content">
                <h2>Nos infrastructures</h2>
                <div class="infrastructure-grid">
                    <div class="infra-item">
                        <div class="infra-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3>Salles de cours</h3>
                        <p>Plus de 80 salles de cours équipées des dernières technologies numériques</p>
                    </div>
                    <div class="infra-item">
                        <div class="infra-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h3>Laboratoires</h3>
                        <p>Laboratoires de sciences physiques, chimie, SVT et biotechnologies</p>
                    </div>
                    <div class="infra-item">
                        <div class="infra-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3>Ateliers techniques</h3>
                        <p>Ateliers professionnels équipés pour les formations industrielles et tertiaires</p>
                    </div>
                    <div class="infra-item">
                        <div class="infra-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3>CDI</h3>
                        <p>Centre de Documentation et d'Information avec espace de travail et ressources numériques</p>
                    </div>
                    <div class="infra-item">
                        <div class="infra-icon">
                            <i class="fas fa-running"></i>
                        </div>
                        <h3>Installations sportives</h3>
                        <p>Gymnases, terrain de sport et équipements pour l'EPS</p>
                    </div>
                    <div class="infra-item">
                        <div class="infra-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3>Restaurant scolaire</h3>
                        <p>Self-service moderne pouvant accueillir tous nos élèves et personnels</p>
                    </div>
                    <div class="infra-item">
                        <div class="infra-icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <h3>Internat</h3>
                        <p>Hébergement pour les élèves éloignés avec encadrement éducatif</p>
                    </div>
                    <div class="infra-item">
                        <div class="infra-icon">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h3>Équipements numériques</h3>
                        <p>Réseau WiFi, tableaux numériques interactifs et espaces informatiques</p>
                    </div>
                </div>
            </section>

            <!-- Section Contact rapide -->
            <section class="contact-section">
                <h2>Nous contacter</h2>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Adresse</strong>
                            <p>9 Boulevard de la Marne<br>68300 Saint-Louis</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Téléphone</strong>
                            <p>03 89 70 74 00</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email</strong>
                            <p>contact@lycee-mermoz.fr</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Scripts -->
    <script src="js/script.js"></script>

    <style>
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3rem;
            margin: 2rem 0;
        }

        .values-list {
            list-style: none;
            padding: 0;
        }

        .values-list li {
            display: flex;
            align-items: center;
            margin: 1rem 0;
            padding: 0.5rem;
        }

        .values-list i {
            color: var(--primary-color);
            margin-right: 1rem;
            width: 20px;
        }

        .team-grid, .infrastructure-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .team-member, .infra-item {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .team-member:hover, .infra-item:hover {
            transform: translateY(-5px);
        }

        .infra-icon {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .infra-icon i {
            font-size: 2.5rem;
            color: var(--primary-color);
        }

        .contact-section {
            background: var(--primary-color);
            color: white;
            padding: 3rem;
            border-radius: 10px;
            margin: 3rem 0;
        }

        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .contact-item i {
            font-size: 1.5rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .team-grid, .infrastructure-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .contact-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html> 
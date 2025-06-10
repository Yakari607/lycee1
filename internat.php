<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Internat - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/vie-lyceenne.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Styles spécifiques à la page Internat */
        .internat-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .internat-intro {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .internat-intro::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }
        
        .internat-section {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .internat-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }
        
        .internat-section h3 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }
        
        .internat-section h3 i {
            margin-right: 0.75rem;
        }
        
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .facility-item {
            background-color: var(--gray-light);
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }
        
        .facility-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        
        .facility-item i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .facility-item h4 {
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
            color: var(--primary-color);
        }
        
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }
        
        .schedule-table th, .schedule-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        .schedule-table th {
            background-color: var(--primary-color);
            color: white;
        }
        
        .schedule-table tr:nth-child(even) {
            background-color: var(--gray-light);
        }
        
        .schedule-table tr:hover {
            background-color: rgba(0, 0, 145, 0.05);
        }
        
        .room-info {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .room-card {
            background-color: var(--gray-light);
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }
        
        .room-card h4 {
            color: var(--primary-color);
            margin-bottom: 0.75rem;
            font-size: 1.2rem;
        }
        
        .room-card ul {
            padding-left: 1.5rem;
            margin-top: 0.5rem;
        }
        
        .room-card li {
            margin-bottom: 0.5rem;
        }
        
        .highlight-box {
            background: linear-gradient(135deg, var(--primary-color) 0%, #000066 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin: 2rem 0;
            text-align: center;
        }
        
        .highlight-box h3 {
            color: white !important;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .highlight-box p {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .internat-content {
                padding: 1rem;
            }
            
            .facilities-grid {
                grid-template-columns: 1fr;
            }
            
            .room-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="vie-lyceenne.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à la vie lycéenne</span>
        </a>

        <section class="vie-lyceenne-hero" style="background: url('images/activites/-tablissement-internat-guez-balzac-17224.jpg'); background-size: cover; background-position: center;">
            <div class="hero-content">
                <h1>L'Internat</h1>
                <p>Un cadre de vie idéal pour la réussite des élèves</p>
            </div>
        </section>

        <div class="internat-content">
            <section class="internat-intro">
                <h2>L'internat du lycée Jean-Mermoz</h2>
                <p>L'internat du lycée Jean-Mermoz est un espace de vie conçu pour favoriser la réussite scolaire et l'épanouissement personnel des élèves. Il offre un environnement propice au travail, à la détente et à la vie en collectivité.</p>
                <p>Notre internat mixte accueille les élèves du lundi au vendredi dans un cadre moderne et confortable, permettant aux jeunes de se concentrer pleinement sur leurs études.</p>
            </section>

            <section class="internat-section">
                <h3><i class="fas fa-home"></i> Un cadre de vie agréable</h3>
                <p>L'internat du lycée Jean-Mermoz propose un environnement sécurisé et convivial qui comprend :</p>
                
                <div class="facilities-grid">
                    <div class="facility-item">
                        <i class="fas fa-bed"></i>
                        <h4>Chambres confortables</h4>
                        <p>Des chambres modernes et bien équipées pour 2 à 4 élèves</p>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-wifi"></i>
                        <h4>Connexion WiFi</h4>
                        <p>Accès internet dans toutes les chambres</p>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-book"></i>
                        <h4>Salles d'étude</h4>
                        <p>Espaces dédiés au travail individuel et collectif</p>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-couch"></i>
                        <h4>Espaces détente</h4>
                        <p>Lieux de convivialité pour se relaxer</p>
                    </div>
                </div>
            </section>

            <section class="internat-section">
                <h3><i class="fas fa-gamepad"></i> Les équipements de loisirs</h3>
                <p>Pour permettre aux internes de se détendre après les cours, l'internat dispose de plusieurs équipements :</p>
                
                <ul>
                    <li>Une cafétéria avec distributeurs de boissons et snacks</li>
                    <li>Une salle de télévision équipée d'un grand écran</li>
                    <li>Une salle de billard</li>
                    <li>Des espaces de jeux de société</li>
                    <li>Des lieux de détente confortables</li>
                </ul>
            </section>

            <section class="internat-section">
                <h3><i class="fas fa-clock"></i> L'organisation de la journée</h3>
                <p>La vie à l'internat est rythmée par un emploi du temps précis qui structure la journée :</p>
                
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Horaire</th>
                            <th>Activité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>7h00</td>
                            <td>Lever et toilette</td>
                        </tr>
                        <tr>
                            <td>7h15 - 7h45</td>
                            <td>Petit-déjeuner au restaurant scolaire</td>
                        </tr>
                        <tr>
                            <td>8h00 - 17h45</td>
                            <td>Cours et activités scolaires</td>
                        </tr>
                        <tr>
                            <td>18h00 - 19h00</td>
                            <td>Étude surveillée obligatoire</td>
                        </tr>
                        <tr>
                            <td>19h00 - 19h45</td>
                            <td>Dîner au restaurant scolaire</td>
                        </tr>
                        <tr>
                            <td>19h45 - 21h30</td>
                            <td>Temps libre et activités</td>
                        </tr>
                        <tr>
                            <td>21h30 - 22h00</td>
                            <td>Retour dans les chambres et préparation au coucher</td>
                        </tr>
                        <tr>
                            <td>22h00</td>
                            <td>Extinction des lumières</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section class="internat-section">
                <h3><i class="fas fa-graduation-cap"></i> L'accompagnement aux études</h3>
                <p>L'internat n'est pas qu'un lieu d'hébergement, c'est aussi un espace d'apprentissage et de soutien scolaire :</p>
                
                <ul>
                    <li>Une étude surveillée obligatoire chaque soir de 18h à 19h</li>
                    <li>Un accès à des ressources pédagogiques (livres, ordinateurs)</li>
                    <li>Une aide aux devoirs disponible sur demande</li>
                    <li>Un suivi personnalisé par les assistants d'éducation</li>
                </ul>
                
                <p>Cette organisation permet aux élèves d'acquérir de bonnes méthodes de travail et de développer leur autonomie.</p>
            </section>

            <section class="internat-section">
                <h3><i class="fas fa-door-open"></i> Les chambres</h3>
                <p>L'internat dispose de chambres modernes et fonctionnelles réparties par sections :</p>
                
                <div class="room-info">
                    <div class="room-card">
                        <h4>Équipement des chambres</h4>
                        <ul>
                            <li>Lits confortables avec rangement intégré</li>
                            <li>Bureaux individuels avec lampe de travail</li>
                            <li>Armoires personnelles</li>
                            <li>Connexion WiFi</li>
                            <li>Salle de bain ou sanitaires à proximité</li>
                        </ul>
                    </div>
                    <div class="room-card">
                        <h4>Organisation</h4>
                        <ul>
                            <li>Chambres de 2 à 4 élèves</li>
                            <li>Répartition par niveau et filière quand c'est possible</li>
                            <li>Sections filles et garçons séparées</li>
                            <li>Présence de personnel d'encadrement à chaque étage</li>
                        </ul>
                    </div>
                </div>
            </section>

            <div class="highlight-box">
                <h3>Un lieu de vie et d'apprentissage</h3>
                <p>L'internat du lycée Jean-Mermoz offre bien plus qu'un simple hébergement.</p>
                <p>C'est un véritable lieu de vie qui favorise la réussite scolaire, l'autonomie et l'épanouissement personnel.</p>
            </div>
        </div>
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
    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>

</body>
</html> 
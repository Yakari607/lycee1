<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Internat - Lycée Jean Mermoz</title>
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
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
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
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
        }
        
        .internat-section h3 {
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            padding-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .internat-section h3 i {
            background-color: var(--primary);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        
        .internat-facilities {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .facility-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background-color: var(--light-bg);
            padding: 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }
        
        .facility-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .facility-item i {
            font-size: 1.8rem;
            color: var(--primary);
            min-width: 40px;
            text-align: center;
        }
        
        /* Nouveau style amélioré pour le tableau des horaires */
        .schedule-container {
            margin-top: 2rem;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            background-color: white;
        }
        
        .schedule-header {
            background: linear-gradient(135deg, var(--primary) 0%, #3a7bd5 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
            font-size: 1.3rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }
        
        .schedule-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
        }
        
        .schedule-header i {
            margin-right: 10px;
            font-size: 1.4rem;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .timeline-schedule {
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        
        .timeline-item {
            display: flex;
            border-bottom: 1px solid #eaeaea;
            transition: all 0.3s ease;
        }
        
        .timeline-item:last-child {
            border-bottom: none;
        }
        
        .timeline-item:hover {
            background-color: rgba(0,0,0,0.02);
        }
        
        .timeline-time {
            flex: 0 0 150px;
            padding: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            background-color: #f8f9fa;
            border-right: 1px solid #eaeaea;
            display: flex;
            align-items: center;
            position: relative;
        }
        
        .timeline-time::after {
            content: '';
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            background-color: var(--primary);
            border-radius: 50%;
            z-index: 1;
        }
        
        .timeline-activity {
            flex: 1;
            padding: 1.2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .timeline-icon {
            width: 36px;
            height: 36px;
            background-color: #e8f4ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1rem;
            flex-shrink: 0;
        }
        
        .timeline-text {
            flex: 1;
        }
        
        .timeline-text small {
            display: block;
            color: #6c757d;
            margin-top: 0.3rem;
            font-style: italic;
        }
        
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            display: none;
        }
        
        .schedule-table th,
        .schedule-table td {
            padding: 1rem 1.5rem;
            border: none;
            border-bottom: 1px solid #eaeaea;
        }
        
        .schedule-table th {
            background-color: #f8f9fa;
            color: var(--primary);
            text-align: left;
            font-weight: 600;
            font-size: 1rem;
        }
        
        .schedule-table tr:last-child td {
            border-bottom: none;
        }
        
        .schedule-table tr:hover {
            background-color: rgba(0,0,0,0.02);
        }
        
        .schedule-time {
            font-weight: 600;
            color: var(--primary);
            white-space: nowrap;
            background-color: #f8f9fa;
            border-right: 1px solid #eaeaea;
        }
        
        .important-note {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 1.5rem;
            margin: 2rem 0;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .important-note h4 {
            color: #f57c00;
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .important-note h4 i {
            color: #f57c00;
        }
        
        .important-note ul {
            padding-left: 1.5rem;
        }
        
        .important-note li {
            margin-bottom: 0.5rem;
        }
        
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .gallery-item {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            height: 250px;
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        
        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(0deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);
            color: white;
            padding: 1rem;
            font-weight: 500;
        }
        
        .two-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-top: 1.5rem;
        }
        
        .column-content {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
        }
        
        .column-content h4 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.2rem;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 0.5rem;
            display: inline-block;
        }
        
        @media (max-width: 768px) {
            .internat-facilities {
                grid-template-columns: 1fr;
            }
            
            .image-gallery {
                grid-template-columns: 1fr;
            }
            
            .two-columns {
                grid-template-columns: 1fr;
            }
            
            .timeline-time {
                flex: 0 0 100px;
                padding: 1rem 0.8rem;
                font-size: 0.9rem;
            }
            
            .timeline-activity {
                padding: 1rem;
            }
            
            .timeline-icon {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Ajout du bouton retour -->
        <a href="vie-lyceenne.php" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour à la vie au lycée</span>
        </a>

        <section class="vie-lyceenne-hero" style="background-image: url('images/activites/-tablissement-internat-guez-balzac-17224.jpg'); background-position: center; background-size: cover;">
            <div class="hero-content">
                <h1>L'Internat</h1>
                <p>Un lieu de vie convivial pour réussir sa scolarité</p>
            </div>
        </section>

        <div class="internat-content">
            <div class="internat-intro">
                <h2>Présentation de l'internat</h2>
                <p>L'internat est un lieu de vie convivial, encadré par les Conseillers Principaux d'Education et les Assistants d'Education. Le respect du Règlement Intérieur permet le bon fonctionnement de la vie en collectivité.</p>
                <p>Différents personnels du lycée contribuent à la mise en œuvre du meilleur accueil possible : Infirmières, agents d'entretien, agent de service de la restauration.</p>
                <p>L'internat dispose d'une capacité d'accueil d'une centaine d'internes. Il est mixte et accueille les lycéens, les apprentis ainsi que les étudiants des Sections de Technicien Supérieur.</p>
                
                <div class="image-gallery">
                    <div class="gallery-item">
                        <img src="images/activites/-tablissement-internat-guez-balzac-17224.jpg" alt="Vue extérieure de l'internat">
                        <div class="gallery-caption">Vue extérieure de l'internat</div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/activites/Restauration-scolaire.png" alt="Espace commun de l'internat">
                        <div class="gallery-caption">Espace de restauration</div>
                    </div>
                </div>
            </div>

            <div class="internat-section">
                <h3><i class="fas fa-couch"></i> Détente et loisirs</h3>
                <p>Les internes disposent d'espaces spacieux et conviviaux. En effet, le bâtiment offre un cadre de vie et un espace agréables pour tous.</p>
                
                <div class="internat-facilities">
                    <div class="facility-item">
                        <i class="fas fa-sofa"></i>
                        <span>Foyer équipé de fauteuils et tables basses</span>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-chess"></i>
                        <span>Nombreux jeux de société</span>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-gamepad"></i>
                        <span>Billard et trois Baby-foot</span>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-tv"></i>
                        <span>Salle de télévision avec vidéo projecteur</span>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-dumbbell"></i>
                        <span>Salle de musculation (1 fois/semaine)</span>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-music"></i>
                        <span>Sono pour l'organisation de soirées</span>
                    </div>
                </div>
                
                <div class="image-gallery">
                    <div class="gallery-item">
                        <img src="images/activites/sala-cine.jpg" alt="Salle de détente">
                        <div class="gallery-caption">Salle de détente et projection</div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/activites/sport-_choisir_header_light.jpg" alt="Activités sportives">
                        <div class="gallery-caption">Activités sportives proposées</div>
                    </div>
                </div>
            </div>

            <div class="internat-section">
                <h3><i class="fas fa-bed"></i> Les chambres</h3>
                
                <div class="two-columns">
                    <div>
                        <p>Les chambres sont spacieuses. Elles sont composées chacune de deux modules de trois lits. Elles comportent leurs propres sanitaires (deux toilettes, deux douches et trois lavabos).</p>
                        <p>Chaque interne dispose d'un lit, d'une table de chevet, d'une armoire individuelle et d'un bureau.</p>
                        <p>Les encadrants affectent les chambres aux internes selon les critères suivants : sexe, âge, niveau d'études et section.</p>
                    </div>
                    <div class="column-content">
                        <h4>Équipements des chambres</h4>
                        <ul>
                            <li>Lit individuel</li>
                            <li>Bureau de travail</li>
                            <li>Table de chevet</li>
                            <li>Armoire individuelle</li>
                            <li>Sanitaires privatifs (douches, toilettes, lavabos)</li>
                            <li>Accès Wi-Fi</li>
                        </ul>
                    </div>
                </div>
                
                <div class="image-gallery">
                    <div class="gallery-item">
                        <img src="images/activites/cafe-bienfaits-inconvenients-6.jpg" alt="Espace commun">
                        <div class="gallery-caption">Espace commun de détente</div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/activites/-tablissement-internat-guez-balzac-17224.jpg" alt="Vue du bâtiment">
                        <div class="gallery-caption">Vue du bâtiment de l'internat</div>
                    </div>
                </div>
            </div>

            <div class="internat-section">
                <h3><i class="fas fa-clock"></i> Horaires et organisation</h3>
                <p><strong>Ouverture :</strong> Du lundi 17h00 au vendredi matin 7h30. Les internes disposent d'une salle de dépôt en vie scolaire pour y déposer leurs bagages le lundi matin.</p>
                <p><strong>Fermeture :</strong> Les vendredis soir, samedis soir, dimanches soir, veilles de jour férié et jours fériés, vacances scolaires. L'internat est également fermé en journée de 7h30 à 17h00.</p>
                
                <div class="schedule-container">
                    <div class="schedule-header">
                        <i class="fas fa-calendar-alt"></i> Emploi du temps quotidien
                    </div>
                    <div class="timeline-schedule">
                        <div class="timeline-item">
                            <div class="timeline-time">07h00 – 07h30</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-bed"></i></div>
                                <div class="timeline-text">Réveil, toilette, petit-déjeuner <br><small>(Accès au self à partir 7h00 et au plus tard à 7h30)</small></div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">07h30</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-door-closed"></i></div>
                                <div class="timeline-text">Fermeture de l'internat</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">07h40</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-door-closed"></i></div>
                                <div class="timeline-text">Fermeture du self</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">17h00</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-door-open"></i></div>
                                <div class="timeline-text">Ouverture de l'internat, accès aux chambres</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">18h00</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-user"></i></div>
                                <div class="timeline-text">Appel dans les chambres</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">18h10 – 18h20</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-utensils"></i></div>
                                <div class="timeline-text">Service du repas (accès au self)</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">19h00</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-door-closed"></i></div>
                                <div class="timeline-text">Fermeture du restaurant</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">19h30</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-user"></i></div>
                                <div class="timeline-text">Appel (sauf BTS) dans les chambres ou en salle d'études</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">19h30 – 21h00</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-book"></i></div>
                                <div class="timeline-text">Etudes (jusqu'à 20h30 pour les sections pro)</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">21h00 – 22h00</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-moon"></i></div>
                                <div class="timeline-text">Détente, toilette, rangement</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">22h00</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-user"></i></div>
                                <div class="timeline-text">Appel dans les chambres</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">22h00 à 22h30</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-ban"></i></div>
                                <div class="timeline-text">Les circulations dans les couloirs et les douches sont interdites.<br>La présence dans sa chambre est impérative</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">22h30</div>
                            <div class="timeline-activity">
                                <div class="timeline-icon"><i class="fas fa-moon"></i></div>
                                <div class="timeline-text">Coucher et extinction des feux</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="internat-section">
                <h3><i class="fas fa-book"></i> Travail scolaire</h3>
                <p>La vie à l'internat s'organise autour de trois pôles essentiels au bon déroulement de la scolarité de chacun.</p>
                
                <div class="two-columns">
                    <div class="column-content">
                        <h4>Espaces de travail</h4>
                        <ul>
                            <li>Une durée minimale d'études est obligatoire</li>
                            <li>Plusieurs salles d'études (entraide, exposé) sont disponibles</li>
                            <li>Une salle informatique est mise à disposition des internes</li>
                            <li>Un réseau Wi-Fi est accessible</li>
                            <li>Un espace bibliothèque est en cours de création</li>
                        </ul>
                    </div>
                    <div class="column-content">
                        <h4>Accompagnement</h4>
                        <ul>
                            <li>Encadrement par l'équipe éducative</li>
                            <li>Suivi personnalisé des études</li>
                            <li>Entraide entre élèves encouragée</li>
                            <li>Environnement propice à la concentration</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="internat-section">
                <h3><i class="fas fa-moon"></i> Repos</h3>
                <div class="two-columns">
                    <div class="column-content">
                        <h4>Règles de vie</h4>
                        <ul>
                            <li>Respect du calme dans les locaux</li>
                            <li>Respect du calme durant le temps d'étude</li>
                            <li>Respect des horaires de couvre-feu</li>
                        </ul>
                    </div>
                    <div class="column-content">
                        <h4>Bien-être</h4>
                        <ul>
                            <li>Cadre calme et sécurisé</li>
                            <li>Espaces de détente adaptés</li>
                            <li>Équilibre entre travail et repos</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="important-note">
                <h4><i class="fas fa-exclamation-circle"></i> À NOTER :</h4>
                <ul>
                    <li>Les élèves de la 3ème Pré-Professionnelle et des collèges voisins ne sont pas accueillis à l'internat.</li>
                    <li>Sous réserve de modification du fonctionnement général et du Règlement Intérieur.</li>
                    <li>La demande d'admission est établie lors de l'inscription. Un courrier de refus ou d'acceptation est envoyé en juillet ou fin août selon la date de la demande.</li>
                </ul>
            </div>
        </div>
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
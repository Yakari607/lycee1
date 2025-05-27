<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bac Général - Lycée Jean Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
                .program-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .program-card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 2rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .program-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }
        
        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .program-card h4 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .program-card h4 i {
            background-color: var(--primary-color);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }
        
        .timetable-container {
            margin: 2rem 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .timetable-header {
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .timetable {
            width: 100%;
            border-collapse: collapse;
        }
        
        .timetable th, 
        .timetable td {
            padding: 1rem;
            text-align: center;
            border: 1px solid #eaeaea;
        }
        
        .timetable th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--dark);
        }
        
        .timetable tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .timetable tr:hover {
            background-color: rgba(0,0,0,0.02);
        }
        
        .subject-name {
            text-align: left;
            font-weight: 500;
        }
        
        .highlight-cell {
            background-color: rgba(0, 0, 145, 0.1);
            font-weight: 600;
        }
        
        .specialty-section {
            margin: 3rem 0;
        }
        
        .specialty-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .specialty-item {
            background-color: var(--white);
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }
        
        .specialty-item:hover {
            transform: translateY(-5px);
        }
        
        .specialty-item h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }
        
        .specialty-item p {
            color: var(--text-color);
            font-size: 0.9rem;
        }
        
        .portrait-section {
            margin: 3rem 0;
        }
        
        .portrait-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .portrait-card {
            background-color: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .portrait-card:hover {
            transform: translateY(-10px);
        }
        
        .portrait-image {
            height: 200px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .portrait-image i {
            font-size: 5rem;
            color: var(--primary-color);
            opacity: 0.3;
        }
        
        .portrait-content {
            padding: 1.5rem;
        }
        
        .portrait-content h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }
        
        .portrait-content p {
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .portrait-content .portrait-quote {
            font-style: italic;
            color: var(--gray);
            position: relative;
            padding-left: 1rem;
            border-left: 3px solid var(--primary-color);
        }
        
        @media (max-width: 768px) {
            .program-grid {
                grid-template-columns: 1fr;
            }
            
            .specialty-grid {
                grid-template-columns: 1fr;
            }
            
            .portrait-grid {
                grid-template-columns: 1fr;
            }
            
            .timetable {
                font-size: 0.9rem;
            }
            
            .timetable th, 
            .timetable td {
                padding: 0.7rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php#formations" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour aux formations</span>
        </a>

        <section class="formation-hero" style="background-image: url('images/formations/pexels-pixabay-159740.jpg');">
            <div class="hero-content">
                <h1>Le Bac Général</h1>
                <p>Une formation d'excellence pour réussir vos études supérieures</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <!-- Présentation -->
                <div class="formation-intro">
                    <div class="formation-card">
                        <h2>La Première Générale</h2>
                        <div class="formation-type">Formation sous statut scolaire</div>
                        <p>Le Baccalauréat Général est une formation d'excellence qui prépare les élèves à la poursuite d'études supérieures longues. Il permet d'acquérir une solide culture générale et des méthodes de travail rigoureuses, tout en se spécialisant progressivement dans des domaines qui correspondent aux centres d'intérêt et au projet d'orientation de l'élève.</p>
                    </div>
                    <div class="formation-card image-card">
                        <img src="images/metiers/pexels-ekrulila-2293019.jpg" alt="Élèves en cours" />
                    </div>
                </div>

                <!-- Programme -->
                <div class="formation-block">
                    <h3><i class="fas fa-book"></i> Au programme</h3>
                    
                    <div class="program-grid">
                        <div class="program-card">
                            <h4><i class="fas fa-users"></i> Le tronc commun</h4>
                            <p>Un ensemble d'enseignements communs à toutes les premières. Il s'agit d'acquérir les mêmes bases, qui seront approfondies selon les spécialités choisies.</p>
                            <ul>
                                <li>Français (en Première) / Philosophie (en Terminale)</li>
                                <li>Histoire-géographie</li>
                                <li>Enseignement moral et civique</li>
                                <li>Langues vivantes A et B</li>
                                <li>Éducation physique et sportive</li>
                                <li>Enseignement scientifique</li>
                            </ul>
                        </div>
                        <div class="program-card">
                            <h4><i class="fas fa-microscope"></i> Les spécialités</h4>
                            <p>En première, il faut choisir 3 spécialités. Des « menus », des ensembles de 3 spécialités qui ont une certaine cohérence sont disponibles au lycée. Il est possible de sélectionner 3 spécialités qui ne forment pas un menu.</p>
                            <p>En fin de première, une des spécialités est abandonnée. Cela signifie que l'épreuve du baccalauréat de cette spécialité est passée en fin de première, et son enseignement n'est donc pas poursuivi en Terminale.</p>
                        </div>
                    </div>
                </div>

                <!-- Spécialités -->
                <div class="specialty-section">
                    <h3><i class="fas fa-atom"></i> Les spécialités proposées</h3>
                    <p>Le lycée Jean Mermoz propose les spécialités suivantes :</p>
                    
                    <div class="specialty-grid">
                        <div class="specialty-item">
                            <h4>Mathématiques</h4>
                            <p>Approfondissement des connaissances en algèbre, analyse, géométrie et probabilités.</p>
                        </div>
                        <div class="specialty-item">
                            <h4>Physique-Chimie</h4>
                            <p>Étude des phénomènes naturels et des lois qui les régissent à travers l'expérimentation.</p>
                        </div>
                        <div class="specialty-item">
                            <h4>Sciences de la Vie et de la Terre</h4>
                            <p>Exploration du vivant, de la Terre et de l'environnement à différentes échelles.</p>
                        </div>
                        <div class="specialty-item">
                            <h4>Sciences Économiques et Sociales</h4>
                            <p>Analyse des grands enjeux économiques, sociaux et politiques du monde contemporain.</p>
                        </div>
                        <div class="specialty-item">
                            <h4>Histoire-Géographie, Géopolitique et Sciences Politiques</h4>
                            <p>Compréhension du monde contemporain par l'étude des enjeux politiques, sociaux et économiques.</p>
                        </div>
                        <div class="specialty-item">
                            <h4>Humanités, Littérature et Philosophie</h4>
                            <p>Approche pluridisciplinaire des grandes questions de culture et d'histoire des idées.</p>
                        </div>
                    </div>
                </div>

                <!-- Menus de spécialités -->
                <div class="formation-block">
                    <h3><i class="fas fa-th-list"></i> Menus de spécialités proposés</h3>
                    <p>Le lycée propose des ensembles cohérents de spécialités qui préparent à différents parcours d'études supérieures :</p>
                    
                    <div class="menu-specialites-grid">
                        <div class="menu-specialites-card">
                            <div class="menu-specialites-title">
                                <i class="fas fa-flask"></i>
                                Menu Sciences
                            </div>
                            <ul class="menu-specialites-list">
                                <li>Mathématiques</li>
                                <li>Physique-Chimie</li>
                                <li>Sciences de la Vie et de la Terre</li>
                            </ul>
                        </div>
                        
                        <div class="menu-specialites-card">
                            <div class="menu-specialites-title">
                                <i class="fas fa-chart-line"></i>
                                Menu Sciences Économiques
                            </div>
                            <ul class="menu-specialites-list">
                                <li>Mathématiques</li>
                                <li>Sciences Économiques et Sociales</li>
                                <li>Histoire-Géographie, Géopolitique et Sciences Politiques</li>
                            </ul>
                        </div>
                        
                        <div class="menu-specialites-card">
                            <div class="menu-specialites-title">
                                <i class="fas fa-book"></i>
                                Menu Humanités
                            </div>
                            <ul class="menu-specialites-list">
                                <li>Humanités, Littérature et Philosophie</li>
                                <li>Histoire-Géographie, Géopolitique et Sciences Politiques</li>
                                <li>Sciences Économiques et Sociales</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Horaires -->
                <div class="formation-block">
                    <h3><i class="fas fa-clock"></i> Horaires et coefficients</h3>
                    
                    <div class="timetable-container">
                        <div class="timetable-header">
                            <i class="fas fa-table"></i> Horaires et coefficients du Baccalauréat Général
                        </div>
                        <div class="table-responsive">
                            <table class="timetable">
                                <thead>
                                    <tr>
                                        <th>Enseignements</th>
                                        <th>Horaire<br>Classe de 1ère</th>
                                        <th>Horaire<br>Classe de Terminale</th>
                                        <th>Coefficient<br>Baccalauréat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="subject-name">Français</td>
                                        <td>4 h</td>
                                        <td>-</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Philosophie</td>
                                        <td>-</td>
                                        <td>4 h</td>
                                        <td>8</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Histoire-géographie</td>
                                        <td>3 h</td>
                                        <td>3 h</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Enseignement moral et civique</td>
                                        <td>30 min</td>
                                        <td>30 min</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Langue vivante LVA et LVB</td>
                                        <td>4h30</td>
                                        <td>4 h</td>
                                        <td>LVA : 5<br>LVB : 5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Education physique et sportive</td>
                                        <td>2 h</td>
                                        <td>2 h</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Enseignement scientifique</td>
                                        <td>2 h</td>
                                        <td>2 h</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name highlight-cell">Enseignement de spécialité A (gardée en Terminale)</td>
                                        <td class="highlight-cell">4 h</td>
                                        <td class="highlight-cell">6h</td>
                                        <td class="highlight-cell">16</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name highlight-cell">Enseignement de spécialité B (gardée en Terminale)</td>
                                        <td class="highlight-cell">4 h</td>
                                        <td class="highlight-cell">6h</td>
                                        <td class="highlight-cell">16</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Enseignement de spécialité C (épreuve passée en fin de Première)</td>
                                        <td>4 h</td>
                                        <td>-</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Bulletin de Première et Terminale</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Grand Oral (sur spécialités A et B, en fin de Terminale)</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="timetable-subheader"><strong>Enseignements facultatifs</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Euro anglais</td>
                                        <td>1 h</td>
                                        <td>1 h</td>
                                        <td>Pts > 10</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Arts plastiques</td>
                                        <td>2 h</td>
                                        <td>2 h</td>
                                        <td>Pts > 10</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Théâtre</td>
                                        <td>2 h</td>
                                        <td>2 h</td>
                                        <td>Pts > 10</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Poursuites d'études -->
                <div class="formation-block">
                    <h3><i class="fas fa-graduation-cap"></i> Et après le BAC...</h3>
                    <button class="collapsible-header">
                        Poursuite d'études <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="collapsible-content">
                        <div class="apres-bac">
                            <div class="apres-bac-item">
                                <h4>1- Études supérieures</h4>
                                <p>Le baccalauréat général permet d'accéder à l'enseignement supérieur, notamment :</p>
                                <ul>
                                    <li>Universités (Licences, Masters, Doctorats)</li>
                                    <li>Classes préparatoires aux grandes écoles (CPGE)</li>
                                    <li>Écoles spécialisées (ingénieur, commerce, architecture, etc.)</li>
                                    <li>BUT (Bachelor Universitaire de Technologie)</li>
                                    <li>BTS (Brevet de Technicien Supérieur)</li>
                                </ul>
                            </div>
                            <div class="apres-bac-item">
                                <h4>2- Débouchés professionnels</h4>
                                <p>Après des études supérieures, les débouchés sont variés selon les spécialités choisies :</p>
                                <ul>
                                    <li>Ingénierie et recherche scientifique</li>
                                    <li>Médecine et professions de santé</li>
                                    <li>Enseignement et recherche</li>
                                    <li>Droit, économie et gestion</li>
                                    <li>Arts, lettres et sciences humaines</li>
                                    <li>Communication et médias</li>
                                </ul>
                            </div>
                            <div class="apres-bac-item">
                                <h4>3- Formations complémentaires</h4>
                                <p>Les étudiants peuvent également envisager :</p>
                                <ul>
                                    <li>Des doubles diplômes</li>
                                    <li>Des formations à l'étranger (Erasmus+)</li>
                                    <li>Des certifications professionnelles</li>
                                    <li>Des formations en alternance</li>
                                </ul>
                            </div>
                            <div class="apres-bac-item">
                                <h4>4- Autres filières du lycée</h4>
                                <p>Découvrez également nos autres filières de baccalauréat :</p>
                                <ul>
                                    <li><a href="bac-stmg.php">Bac STMG - Sciences et Technologies du Management et de la Gestion</a></li>
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
                            <li>L'internat est ouvert du lundi soir au vendredi midi.</li>
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
                            <p>Lycée Jean-Mermoz<br>53 rue du Docteur Hurst<br>68301 Saint Louis Cedex
                                <a href="https://maps.google.com/?q=Lycée+Jean+Mermoz,+53+rue+du+Docteur+Hurst,+68301+Saint-Louis+Cedex,+France" target="_blank" class="map-link" title="Voir sur Google Maps">
                                    <i class="fas fa-map"></i>
                                </a>
                            </p>
                            <p><i class="fas fa-phone"></i> +33 389 70 22 71</p>
                        </div>
                        <div class="contact-info">
                            <div class="contact-block">
                                <h4>Voie Générale</h4>
                                <p>Proviseure adjointe, sections générales et technologiques<br>
                                Mme Marie HIMBERT<br>
                                <a href="mailto:ce.0680066c@ac-strasbourg.fr">ce.0680066c@ac-strasbourg.fr</a></p>
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
    <script src="js/page-specific/formation.js"></script>
</body>
</html> 
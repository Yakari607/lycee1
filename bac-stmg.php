<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bac STMG - Sciences et Technologies du Management et de la Gestion - Lycée Jean-Mermoz</title>
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

        <section class="formation-hero" style="background-image: url('images/metiers/pexels-fauxels-3184291.jpg');">
            <div class="hero-content">
                <h1>Bac STMG</h1>
                <p>Sciences et Technologies du Management et de la Gestion</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <!-- Présentation -->
                <div class="formation-intro">
                    <div class="formation-card">
                        <h2>Le Baccalauréat STMG</h2>
                        <div class="formation-type">Formation sous statut scolaire</div>
                        <p>Le Baccalauréat Sciences et Technologies du Management et de la Gestion (STMG) s'adresse aux élèves intéressés par la réalité du fonctionnement des organisations, les relations au travail, les nouveaux usages du numérique, le marketing, la recherche et la mesure de la performance, l'analyse des décisions et l'impact des stratégies d'entreprise.</p>
                        <p><strong>À noter :</strong> l'importance de l'enseignement général, pour la maîtrise de l'expression écrite et orale, en français et en langues vivantes étrangères, les apports culturels de l'histoire-géographie et l'appui d'un enseignement adapté de mathématiques.</p>
                    </div>
                    <div class="formation-card image-card">
                        <img src="images/metiers/pexels-photo-3184465.jpg" alt="Étudiants en STMG" />
                    </div>
                </div>

                <!-- Programme -->
                <div class="formation-block">
                    <h3><i class="fas fa-book"></i> Au programme</h3>
                    
                    <div class="program-grid">
                        <div class="program-card">
                            <h4><i class="fas fa-users"></i> Le contenu de la formation</h4>
                            <p>Ce bac aborde les grandes questions de la gestion des organisations, par exemple : le rôle du facteur humain, les différentes approches de la valeur, l'information et la communication bases de l'intelligence collective, etc.</p>
                            <p>Il comprend des enseignements :</p>
                            <ul>
                                <li>technologiques commun en 1re et en lien avec la spécialité choisie en terminale ;</li>
                                <li>généraux (français, mathématiques, langues, histoire-géographie, philosophie et EPS) ;</li>
                                <li>en économie, droit et management des organisations.</li>
                            </ul>
                        </div>
                        <div class="program-card">
                            <h4><i class="fas fa-laptop"></i> Une pédagogie active</h4>
                            <p>Ce dernier pôle, articulé avec le pôle technologique, donne les repères et les outils d'analyse et d'interprétation des logiques de fonctionnement des entreprises, des administrations, des associations.</p>
                            <p>Observation du fonctionnement, mesure et analyse des résultats avant leur interprétation et la préparation de décisions sont mis en œuvre dans des situations réelles ou simulées.</p>
                            <p>Pratiques des jeux sérieux (serious games), usages des réseaux sociaux, des outils de simulation et de gestion (progiciel de gestion intégré ou PGI) sont au programme d'une pédagogie de l'action, basée sur la conduite d'études (en 1re) et de projets (en terminale).</p>
                        </div>
                    </div>
                </div>

                <!-- Spécialités -->
                <div class="specialty-section">
                    <h3><i class="fas fa-briefcase"></i> Les spécialités proposées</h3>
                    <p>En terminale, les élèves choisissent une spécialité parmi les suivantes :</p>
                    
                    <div class="specialty-grid">
                        <div class="specialty-item">
                            <h4>GF - Gestion Finance</h4>
                            <p>Découvrir le fonctionnement financier et comptable d'une entreprise à travers des cas réels ou fictifs. L'apprentissage est technique mais pousse aussi les élèves à analyser et proposer des solutions.</p>
                            <p>En plongeant au coeur de l'organisation comptable d'une entreprise, les élèves découvrent comment elle produit des services ou des objets, comment elle les vend ou en achète.</p>
                        </div>
                        <div class="specialty-item">
                            <h4>RHC - Ressources Humaines et Communication</h4>
                            <p>Cette spécialité examine la dimension humaine de l'organisation : relations de travail, communication, gestion des ressources humaines.</p>
                            <p>Les élèves étudient comment mobiliser les ressources humaines, communiquer en interne et en externe, et gérer les relations au travail.</p>
                        </div>
                        <div class="specialty-item">
                            <h4>Mercatique (Marketing)</h4>
                            <p>Cette spécialité s'intéresse aux techniques commerciales et marketing des entreprises.</p>
                            <p>Les élèves étudient comment une entreprise analyse son marché, définit une stratégie commerciale et met en œuvre des actions pour conquérir et fidéliser ses clients.</p>
                        </div>
                    </div>
                </div>

                <!-- Horaires -->
                <div class="formation-block">
                    <h3><i class="fas fa-clock"></i> Horaires et coefficients</h3>
                    
                    <div class="timetable-container">
                        <div class="timetable-header">
                            <i class="fas fa-table"></i> Horaires et coefficients du Baccalauréat STMG
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
                                        <td>3 h</td>
                                        <td>-</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Philosophie</td>
                                        <td>-</td>
                                        <td>2 h</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Histoire Géographie</td>
                                        <td>1 h 30</td>
                                        <td>1 h 30</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Langue vivante LV1 et LV2</td>
                                        <td>4 h</td>
                                        <td>4 h</td>
                                        <td>LVA : 5<br>LVB : 5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Mathématiques</td>
                                        <td>3 h</td>
                                        <td>2 h</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Enseignement moral et civique</td>
                                        <td>18 h annuelles</td>
                                        <td>18 h annuelles</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">EPS</td>
                                        <td>2 h</td>
                                        <td>2 h</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name highlight-cell">Sciences de gestion et numérique</td>
                                        <td class="highlight-cell">7 h</td>
                                        <td class="highlight-cell">-</td>
                                        <td class="highlight-cell">5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name highlight-cell">Management</td>
                                        <td class="highlight-cell">4 h</td>
                                        <td class="highlight-cell">-</td>
                                        <td class="highlight-cell">5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name highlight-cell">Droit et économie</td>
                                        <td class="highlight-cell">4 h</td>
                                        <td class="highlight-cell">6 h</td>
                                        <td class="highlight-cell">16</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name highlight-cell">Management, sciences de gestion et numérique avec enseignement spécifique</td>
                                        <td class="highlight-cell">-</td>
                                        <td class="highlight-cell">10 h</td>
                                        <td class="highlight-cell">16</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Grand Oral (sur les deux spécialités de Terminale)</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>14</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Bulletins de Première et de Terminale</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="timetable-subheader"><strong>Enseignements facultatifs</strong></td>
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

                <!-- Portraits de réussite -->
                <div class="portrait-section">
                    <h3><i class="fas fa-user-graduate"></i> Les portraits de la réussite</h3>
                    <p>Voici les portraits d'anciens élèves du lycée Jean-Mermoz, lauréates et lauréats du baccalauréat Management et Gestion (STMG), ils ont accepté de partager leur motivation, leur parcours et leurs projets.</p>
                    
                    <div class="portrait-grid">
                        <div class="portrait-card">
                            <div class="portrait-image">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="portrait-content">
                                <h4>Emma L.</h4>
                                <p>Promotion 2022 - Spécialité Gestion Finance</p>
                                <div class="portrait-quote">
                                    "Le bac STMG m'a permis de découvrir le monde de l'entreprise sous un angle concret. Aujourd'hui, je poursuis mes études en BTS Comptabilité Gestion."
                                </div>
                            </div>
                        </div>
                        <div class="portrait-card">
                            <div class="portrait-image">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="portrait-content">
                                <h4>Thomas R.</h4>
                                <p>Promotion 2021 - Spécialité Mercatique</p>
                                <div class="portrait-quote">
                                    "Grâce à la spécialité Mercatique, j'ai pu intégrer un BUT Techniques de Commercialisation. Les projets réalisés au lycée m'ont donné une longueur d'avance."
                                </div>
                            </div>
                        </div>
                        <div class="portrait-card">
                            <div class="portrait-image">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="portrait-content">
                                <h4>Léa M.</h4>
                                <p>Promotion 2020 - Spécialité RHC</p>
                                <div class="portrait-quote">
                                    "La spécialité RHC m'a ouvert les portes de l'université en AES. J'ai apprécié l'approche concrète des cours et les études de cas réelles."
                                </div>
                            </div>
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
                                <h4>1- BTS et BUT</h4>
                                <p>La majorité des bacheliers STMG se tourne vers un BTS ou un BUT en lien avec les spécialités de terminale :</p>
                                <ul>
                                    <li>Après la spécialité mercatique : BUT Techniques de Commercialisation</li>
                                    <li>Après la spécialité gestion et finance : BTS Comptabilité et Gestion</li>
                                    <li>Après la spécialité ressources humaines et communication : BTS Support à l'Action Managériale</li>
                                </ul>
                                <p>Possibilité de continuer ensuite en licence professionnelle (1 an) à l'université, en école de commerce ou encore en école spécialisée (tourisme...).</p>
                            </div>
                            <div class="apres-bac-item">
                                <h4>2- Université</h4>
                                <p>Un tiers des bacheliers STMG s'inscrit à l'université en :</p>
                                <ul>
                                    <li>Licence de droit</li>
                                    <li>Administration Économique et Sociale (AES)</li>
                                    <li>Économie-gestion</li>
                                </ul>
                                <p>Attention, la réussite n'est pas toujours au rendez-vous car ces études exigent beaucoup d'autonomie, une solide culture générale et de l'aisance à l'écrit.</p>
                            </div>
                            <div class="apres-bac-item">
                                <h4>3- Classes préparatoires</h4>
                                <p>Les meilleurs élèves peuvent entrer en classe prépa économique et commerciale :</p>
                                <ul>
                                    <li>L'option technologique (ECT) leur est réservée, quelle que soit la spécialité suivie en terminale</li>
                                    <li>Elle prépare en 2 ans aux concours d'entrée des écoles supérieures de commerce (3 ans d'études)</li>
                                </ul>
                            </div>
                            <div class="apres-bac-item">
                                <h4>4- Écoles spécialisées</h4>
                                <p>Après le bac, il est possible d'entrer directement dans :</p>
                                <ul>
                                    <li>Certaines écoles de commerce et de gestion</li>
                                    <li>Écoles de tourisme, d'hôtellerie</li>
                                    <li>Écoles paramédicales ou sociales (préparation d'un DE)</li>
                                </ul>
                                <p>Compter 3 à 5 ans d'études selon la formation choisie.</p>
                            </div>
                            <div class="apres-bac-item">
                                <h4>5- Autres filières du lycée</h4>
                                <p>Découvrez également nos autres filières de baccalauréat :</p>
                                <ul>
                                    <li><a href="bac-general.php">Bac Général</a></li>
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
                            <p>Lycée Jean-Mermoz<br>53 rue du Docteur Hurst<br>68300 Saint Louis
                                <a href="https://maps.google.com/?q=Lycée+Jean+Mermoz,+53+rue+du+Docteur+Hurst,+68301+Saint-Louis+Cedex,+France" target="_blank" class="map-link" title="Voir sur Google Maps">
                                    <i class="fas fa-map"></i>
                                </a>
                            </p>
                            <p><i class="fas fa-phone"></i> +33 389 70 22 71</p>
                        </div>
                        <div class="contact-info">
                            <div class="contact-block">
                                <h4>Voie Scolaire</h4>
                                <p>Directrice Déléguée aux Formations Professionnelles et Technologiques<br>
                                Brigitte PAJOT<br>
                                <a href="mailto:brigitte.pajot@ac-strasbourg.fr">brigitte.pajot@ac-strasbourg.fr</a></p>
                                <p>Coordonnatrice Bac STMG<br>
                                Sandrine DIENER<br>
                                <a href="mailto:sandrine.diener@ac-strasbourg.fr">sandrine.diener@ac-strasbourg.fr</a></p>
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
                    <a href="admin/login.php">Administration</a>
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
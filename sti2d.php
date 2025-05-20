<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bac STI2D - Sciences et Technologies de l'Industrie et du Développement Durable - Lycée Jean Mermoz</title>
    <meta name="description" content="Découvrez le Baccalauréat STI2D proposé au Lycée Jean Mermoz : une formation axée sur l'industrie, l'innovation technologique et le développement durable.">
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
            height: 100%;
            display: flex;
            flex-direction: column;
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
            flex: 1;
        }
        
        /* Organisation pédagogique */
        .organisation-section {
            margin: 3rem 0;
        }
        
        .organisation-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .organisation-card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 2rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .organisation-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }
        
        .organisation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .organisation-card h4 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .organisation-card h4 i {
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
        
        .organisation-card p, .organisation-card ul {
            flex: 1;
        }
        
        /* Spécialités en Terminale */
        .specialites-section {
            margin: 3rem 0;
        }
        
        .specialites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .specialite-card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            padding: 2rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .specialite-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }
        
        .specialite-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .specialite-card h4 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .specialite-card h4 i {
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
        
        .specialite-card p {
            color: var(--text-color);
            flex: 1;
        }
        
        /* Carousel styles */
        .carousel-container {
            margin: 2rem 0;
            border-radius: 10px;
            overflow: hidden;
            background-color: var(--white);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .carousel-tabs {
            display: flex;
            flex-wrap: wrap;
            background-color: var(--primary-color);
            padding: 0.5rem;
        }
        
        .carousel-tab {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 5px;
            transition: all 0.3s ease;
            margin: 0.25rem;
        }
        
        .carousel-tab:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        .carousel-tab.active {
            background-color: white;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .carousel-content {
            position: relative;
            overflow: hidden;
        }
        
        .carousel-slide {
            display: none;
            padding: 0;
            transition: transform 0.4s ease;
        }
        
        .carousel-slide.active {
            display: block;
        }
        
        .carousel-card {
            padding: 0;
            overflow: hidden;
        }
        
        .carousel-header {
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eaeaea;
        }
        
        .carousel-header h4 {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            font-size: 1.25rem;
        }
        
        .carousel-header h4 i {
            background-color: var(--primary-color);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .carousel-body {
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }
        
        .carousel-text {
            flex: 1;
            min-width: 280px;
            padding: 1.5rem;
        }
        
        .carousel-img {
            flex: 1;
            min-width: 280px;
            max-width: 450px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .carousel-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .carousel-card:hover .carousel-img img {
            transform: scale(1.05);
        }
        
        .carousel-nav {
            display: flex;
            justify-content: center;
            padding: 1rem;
            background-color: #f8f9fa;
            border-top: 1px solid #eaeaea;
        }
        
        .carousel-prev, .carousel-next {
            background-color: var(--primary-color);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin: 0 0.5rem;
            transition: background-color 0.3s ease;
        }
        
        .carousel-prev:hover, .carousel-next:hover {
            background-color: var(--secondary-color);
        }
        
        @media (max-width: 768px) {
            .program-grid {
                grid-template-columns: 1fr;
            }
            
            .specialty-grid {
                grid-template-columns: 1fr;
            }
            
            .timetable {
                font-size: 0.9rem;
            }
            
            .timetable th, 
            .timetable td {
                padding: 0.7rem 0.5rem;
            }
            
            .carousel-tabs {
                flex-direction: column;
                padding: 0.5rem;
            }
            
            .carousel-tab {
                width: 100%;
                margin: 0.25rem 0;
                text-align: left;
            }
            
            .carousel-body {
                flex-direction: column;
            }
            
            .carousel-img {
                max-width: 100%;
                height: 200px;
            }
        }
        
        @media (max-width: 576px) {
        }
    </style>
</head>
<body data-page="sti2d">
    <!-- En-tête -->
    <?php include 'includes/navbar.php'; ?>

    <main>
        <!-- Bouton retour -->
        <a href="index.php#formations" class="back-home">
            <i class="fas fa-arrow-left"></i>
            <span>Retour aux formations</span>
        </a>

        <section class="formation-hero" style="background-image: url('images/metiers/pexels-thisisengineering-3862379.jpg');">
            <div class="hero-content">
                <h1>Bac STI2D</h1>
                <p>Sciences et Technologies de l'Industrie et du Développement Durable</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <!-- Présentation -->
                <div class="formation-intro">
                    <div class="formation-card">
                        <h2>Le Baccalauréat STI2D</h2>
                        <div class="formation-type">Formation sous statut scolaire</div>
                        <p><strong>Pour qui ?</strong> Pour celles et ceux qui s'intéressent à l'industrie, à l'innovation technologique et à la transition énergétique, et qui souhaitent suivre une formation technologique polyvalente en vue d'une poursuite d'études.</p>
                    </div>
                    <div class="formation-card image-card">
                        <img src="images/formations/pexels-ranjeet-860714737-27928762.jpg" alt="Étudiants en STI2D" />
                    </div>
                </div>

                <!-- Au programme -->
                <div class="formation-block">
                    <h3><i class="fas fa-book"></i> Au programme</h3>
                    
                    <p>La série STI2D vous permet d'acquérir des compétences technologiques transversales à tous les domaines industriels, ainsi que des compétences approfondies dans un champ de spécialité.</p>
                    
                    <p>Les programmes de mathématiques et de physique-chimie sont adaptés pour vous donner les outils scientifiques nécessaires aux enseignements technologiques.</p>
                    
                    <p>Ces derniers reposent sur une démarche d'analyse fondée sur 3 approches complémentaires (« énergie », « information » et « matière »), qui permettent d'aboutir à la création de solutions techniques en intégrant les contraintes propres au monde industriel, y compris le développement durable.</p>
                    
                    <div class="program-grid">
                        <div class="program-card">
                            <h4><i class="fas fa-users"></i> Le tronc commun</h4>
                            <p>Enseignements communs à tous les baccalauréats technologiques, permettant d'acquérir une culture générale solide.</p>
                            <ul>
                                <li>Français (en Première) / Philosophie (en Terminale)</li>
                                <li>Histoire-géographie</li>
                                <li>Enseignement moral et civique</li>
                                <li>Langues vivantes A et B</li>
                                <li>Éducation physique et sportive</li>
                                <li>Mathématiques</li>
                            </ul>
                        </div>
                        <div class="program-card">
                            <h4><i class="fas fa-microchip"></i> Les spécialités</h4>
                            <p>Le bac STI2D propose des enseignements propres à chacune des 4 spécialités. Dans chacune d'entre elles, l'accent est mis sur l'une des 3 approches technologiques :</p>
                            <ul>
                                <li>« énergie » (énergies et environnement)</li>
                                <li>« information » (systèmes d'information et numérique)</li>
                                <li>« matière » (architecture et construction ; innovation technologique et éco-conception)</li>
                            </ul>
                            <p>À noter : 1 heure hebdomadaire d'enseignement technologique est dispensée dans la langue vivante 1.</p>
                        </div>
                    </div>
                </div>
                
                <!-- L'organisation pédagogique -->
                <div class="organisation-section">
                    <h3><i class="fas fa-cogs"></i> L'organisation pédagogique</h3>
                    <p>La formation STI2D s'organise selon une progression pédagogique entre la Première et la Terminale :</p>
                    
                    <!-- Carrousel pour IT, I2D, 2I2D -->
                    <div class="carousel-container">
                        <div class="carousel-tabs">
                            <button class="carousel-tab active" data-target="slide-it-i2d">IT, I2D en Première</button>
                            <button class="carousel-tab" data-target="slide-2i2d">2I2D en Terminale</button>
                            <button class="carousel-tab" data-target="slide-etlv">L'ETLV</button>
                            <button class="carousel-tab" data-target="slide-mecatronique">STI2D Mécatronique</button>
                            <button class="carousel-tab" data-target="slide-domotique">STI2D Domotique</button>
                        </div>
                        
                        <div class="carousel-content">
                            <!-- Slide 1: IT, I2D -->
                            <div class="carousel-slide active" id="slide-it-i2d">
                                <div class="carousel-card">
                                    <div class="carousel-header">
                                        <h4><i class="fas fa-lightbulb"></i> Innovation Technologique (IT) et Ingénierie et Développement Durable (I2D)</h4>
                                    </div>
                                    <div class="carousel-body">
                                        <div class="carousel-text">
                                            <p><strong>L'enseignement Innovation Technologique (IT)</strong> favorise l'approche par le design et l'innovation. Cette approche permet d'identifier et d'approfondir des possibilités de réponse à un besoin. Il s'agit de développer la créativité, l'esprit critique et de travailler en groupe à l'émergence et la sélection d'idées.</p>
                                            <p><strong>L'enseignement de spécialité Ingénierie et Développement Durable (I2D)</strong> permet d'étudier les contraintes reliée à la réalisation d'un produit (contraintes techniques, économiques et environnementales). Cela implique la prise en compte du triptyque « Matière – Énergie – Information » dans une démarche d'éco-conception incluant une réflexion sur les grandes questions de société.</p>
                                        </div>
                                        <div class="carousel-img">
                                            <img src="images/formations/pexels-photo-459402.webp" alt="Innovation Technologique et Ingénierie">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Slide 2: 2I2D -->
                            <div class="carousel-slide" id="slide-2i2d">
                                <div class="carousel-card">
                                    <div class="carousel-header">
                                        <h4><i class="fas fa-project-diagram"></i> Ingénierie, Innovation et Développement Durable (2I2D)</h4>
                                    </div>
                                    <div class="carousel-body">
                                        <div class="carousel-text">
                                            <p><strong>L'enseignement de spécialité Ingénierie, innovation et développement durable (2I2D)</strong> proposé en classe terminale, consiste en la fusion des spécialités IT et I2D de première.</p>
                                            <p>Le programme comprend ainsi des connaissances communes et des connaissances propres à chacun des champs spécifiques :</p>
                                            <ul>
                                                <li>Architecture et Construction (AC)</li>
                                                <li>Énergies et Environnement (EE)</li>
                                                <li>Innovation Technologique et Éco-Conception (ITEC)</li>
                                                <li>Systèmes d'Information et Numérique (SIN)</li>
                                            </ul>
                                        </div>
                                        <div class="carousel-img">
                                            <img src="images/formations/pexels-photo-3735782.webp" alt="Ingénierie, Innovation et Développement Durable">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Slide 3: ETLV -->
                            <div class="carousel-slide" id="slide-etlv">
                                <div class="carousel-card">
                                    <div class="carousel-header">
                                        <h4><i class="fas fa-language"></i> L'Enseignement Technologique en Langue Vivante (ETLV)</h4>
                                    </div>
                                    <div class="carousel-body">
                                        <div class="carousel-text">
                                            <p><strong>L'ETLV</strong> est un enseignement technologique en anglais auquel collaborent un professeur d'anglais et un professeur de sciences industrielles de l'ingénieur.</p>
                                            <p>L'ETLV se base sur des situations de mises en pratiques :</p>
                                            <ul>
                                                <li>Travaux</li>
                                                <li>Expérimentations</li>
                                                <li>Projets</li>
                                            </ul>
                                            <p>Le tout en anglais. Les ressources ainsi que les travaux présentés lors d'exposés sont rédigés ou présentés exclusivement en anglais.</p>
                                        </div>
                                        <div class="carousel-img">
                                            <img src="images/formations/pexels-photo-257736.webp" alt="Enseignement Technologique en Langue Vivante">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Slide 4: Mécatronique -->
                            <div class="carousel-slide" id="slide-mecatronique">
                                <div class="carousel-card">
                                    <div class="carousel-header">
                                        <h4><i class="fas fa-robot"></i> STI2D Mécatronique (ITEC + SIN)</h4>
                                    </div>
                                    <div class="carousel-body">
                                        <div class="carousel-text">
                                            <p>La classe de STI2D2 regroupe pour moitié des élèves de la spécialité ITEC et de la spécialité SIN d'où sa désignation "mécatronique".</p>
                                            <p>La mécatronique touche tous les produits dits "grand public" où l'on retrouve une structure mécanique (statique ou en mouvement) et une partie informationnelle (des entrées et des sorties pilotées par une carte programmable).</p>
                                            <p>Par exemple, un robot humanoïde est un produit mécatronique. Il possède une structure mécanique ayant un certain nombre de pièces articulées les unes aux autres (partie ITEC) et incorpore des capteurs (détection d'obstacles, de distance, caméra, micro,…) qui informent la carte de traitement. Celle-ci pilote en conséquence les sorties (moteurs, haut-parleurs,…). Cette partie numérique étant dédiée à la spécialité SIN.</p>
                                        </div>
                                        <div class="carousel-img">
                                            <img src="images/formations/free-photo-of-abstrait-rechercher-energie-numerique.jpeg" alt="Mécatronique">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Slide 5: Domotique -->
                            <div class="carousel-slide" id="slide-domotique">
                                <div class="carousel-card">
                                    <div class="carousel-header">
                                        <h4><i class="fas fa-home"></i> STI2D Domotique (AC + EE)</h4>
                                    </div>
                                    <div class="carousel-body">
                                        <div class="carousel-text">
                                            <p>La combinaison de spécialités AC et EE porte sur l'analyse et la création de solutions techniques relatives à l'architecture, donc à la domotique.</p>
                                            <p>Dans un contexte de développement durable, les élèves participent aux principales étapes du développement d'un projet architectural en intégrant diverses contraintes sociales et culturelles, d'efficacité énergétique et du cadre de vie.</p>
                                            <p>Durant la phase de conception, les élèves identifient les paramètres sociaux, culturels, sanitaires, technologiques et économiques du projet. Ils analysent ensuite ces paramètres pour définir les solutions qui permettront de répondre aux contraintes du projet. Les élèves valident ensuite leurs solutions via une simulation.</p>
                                            <p>Les enjeux de la gestion de l'énergie contribuent à enrichir la culture scientifique des élèves. De ce fait, les élèves pourront se tourner par la suite vers les métiers émergents concentrés sur l'optimisation de la production et de la consommation énergétique.</p>
                                        </div>
                                        <div class="carousel-img">
                                            <img src="images/formations/pexels-pixabay-210126.jpg" alt="Domotique">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Navigation buttons -->
                        <div class="carousel-nav">
                            <button class="carousel-prev"><i class="fas fa-chevron-left"></i></button>
                            <button class="carousel-next"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Les spécialités en Terminale -->
                <div class="specialites-section">
                    <h3><i class="fas fa-star"></i> Les spécialités en Terminale</h3>
                    <p>En classe de Terminale, les élèves choisissent un des quatre enseignements spécifiques :</p>
                    
                    <!-- Carrousel pour les spécialités en Terminale -->
                    <div class="carousel-container specialites-carousel">
                        <div class="carousel-tabs">
                            <button class="carousel-tab active" data-target="slide-ac">AC - Architecture et Construction</button>
                            <button class="carousel-tab" data-target="slide-ee">EE - Énergies et Environnement</button>
                            <button class="carousel-tab" data-target="slide-itec">ITEC - Innovation Technologique et Éco-Conception</button>
                            <button class="carousel-tab" data-target="slide-sin">SIN - Systèmes d'Information et Numérique</button>
                        </div>
                        
                        <div class="carousel-content">
                            <!-- Slide 1: AC - Architecture et Construction -->
                            <div class="carousel-slide active" id="slide-ac">
                                <div class="carousel-card">
                                    <div class="carousel-header">
                                        <h4><i class="fas fa-building"></i> AC - Architecture et Construction</h4>
                                    </div>
                                    <div class="carousel-body">
                                        <div class="carousel-text">
                                            <p>Cette spécialité porte sur l'analyse et la création de solutions techniques, relatives au domaine de la construction, qui respectent des contraintes d'usage, réglementaires, économiques et environnementales. Cette approche développe les compétences dans l'utilisation des outils de conception et la prise en compte des contraintes liées aux matériaux et aux procédés.</p>
                                            <p><strong>Compétences développées :</strong></p>
                                            <ul>
                                                <li>Maîtrise des outils de conception architecturale</li>
                                                <li>Analyse et respect des contraintes d'usage</li>
                                                <li>Compréhension des contraintes réglementaires</li>
                                                <li>Gestion des aspects économiques et environnementaux</li>
                                            </ul>
                                        </div>
                                        <div class="carousel-img">
                                            <img src="images/formations/pexels-pixabay-256455.jpg" alt="Architecture et Construction">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Slide 2: EE - Énergies et Environnement -->
                            <div class="carousel-slide" id="slide-ee">
                                <div class="carousel-card">
                                    <div class="carousel-header">
                                        <h4><i class="fas fa-bolt"></i> EE - Énergies et Environnement</h4>
                                    </div>
                                    <div class="carousel-body">
                                        <div class="carousel-text">
                                            <p>Cette spécialité explore le domaine de l'énergie et sa gestion. Elle apporte les compétences nécessaires pour appréhender l'efficacité énergétique de tous les systèmes intégrant une composante énergétique, leur impact sur l'environnement et l'optimisation du cycle de vie. Les systèmes étant communicants, la maîtrise de l'énergie exige des compétences sur l'utilisation des outils de commande.</p>
                                            <p><strong>Systèmes étudiés :</strong></p>
                                            <ul>
                                                <li>Systèmes de gestion énergétique intelligents</li>
                                                <li>Solutions d'énergies renouvelables</li>
                                                <li>Optimisation de l'efficacité énergétique</li>
                                                <li>Analyse du cycle de vie et impact environnemental</li>
                                            </ul>
                                        </div>
                                        <div class="carousel-img">
                                            <img src="images/formations/pexels-photo-2898199.jpeg" alt="Énergies et Environnement">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Slide 3: ITEC - Innovation Technologique et Éco-Conception -->
                            <div class="carousel-slide" id="slide-itec">
                                <div class="carousel-card">
                                    <div class="carousel-header">
                                        <h4><i class="fas fa-tools"></i> ITEC - Innovation Technologique et Éco-Conception</h4>
                                    </div>
                                    <div class="carousel-body">
                                        <div class="carousel-text">
                                            <p>Cette spécialité porte sur l'analyse et la création de solutions techniques relatives aux produits manufacturés en intégrant les dimensions design, ergonomie et développement durable. Elle apporte les compétences nécessaires pour appréhender toutes les étapes de la vie d'un produit (conception, fabrication, commercialisation, recyclage).</p>
                                            <p><strong>Formation :</strong></p>
                                            <p>L'objectif est de sensibiliser les étudiants à la démarche de projet, à la conception sur modeleur volumique (CAO) et à la réalisation d'un prototype fonctionnel (imprimante 3D, découpe laser,...) dans l'esprit du développement durable (éco-conception).</p>
                                            <p>La mesure des écarts entre le réel (prototype physique), la simulation numérique et les exigences du cahier des charges (outils SysML) à partir d'un protocole expérimental est constante au cours de la formation.</p>
                                            <p><strong>Pédagogie :</strong></p>
                                            <p>L'équipe pédagogique privilégie la pédagogie par projet « apprendre en faisant » ainsi que le travail collaboratif au travers d'outils en ligne (DRIVE, ONESHAPE pour la CAO,...). Les méthodes « agiles » lors de la démarche de projet sont favorisées.</p>
                                        </div>
                                        <div class="carousel-img">
                                            <img src="images/formations/pexels-thisisengineering-3862379.jpg" alt="Innovation Technologique et Éco-Conception">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Slide 4: SIN - Systèmes d'Information et Numérique -->
                            <div class="carousel-slide" id="slide-sin">
                                <div class="carousel-card">
                                    <div class="carousel-header">
                                        <h4><i class="fas fa-microchip"></i> SIN - Systèmes d'Information et Numérique</h4>
                                    </div>
                                    <div class="carousel-body">
                                        <div class="carousel-text">
                                            <p>Cette spécialité porte sur l'analyse et la création de solutions techniques, relatives au traitement des flux d'information (voix, données, images), dans les systèmes pluri-techniques actuels qui comportent à la fois une gestion locale et une gestion à distance de l'information. Les supports privilégiés sont les systèmes de télécommunications, les réseaux informatiques, les produits pluri-techniques et, en particulier, les produits multimédias. Les activités portent sur le développement de systèmes virtuels destinés à la conduite, au dialogue homme-machine, à la transmission et à la restitution de l'information.
                                            <p><strong>Supports privilégiés :</strong></p>
                                            <ul>
                                                <li>Systèmes de télécommunications</li>
                                                <li>Réseaux informatiques</li>
                                                <li>Produits pluri-techniques</li>
                                                <li>Produits multimédias</li>
                                            </ul>
                                            <p>Les activités portent sur le développement de systèmes virtuels destinés à la conduite, au dialogue homme-machine, à la transmission et à la restitution de l'information.</p>
                                        </div>
                                        <div class="carousel-img">
                                            <img src="images/formations/pexels-photo-2760241.webp" alt="Systèmes d'Information et Numérique">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Navigation buttons -->
                        <div class="carousel-nav">
                            <button class="carousel-prev"><i class="fas fa-chevron-left"></i></button>
                            <button class="carousel-next"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
                
                

                <!-- Horaires -->
                <div class="formation-block">
                    <h3><i class="fas fa-clock"></i> Horaires et coefficients</h3>
                    <div class="timetable-container">
                        <div class="timetable-header">
                            <i class="fas fa-table"></i> Horaires et coefficients du Baccalauréat STI2D
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
                                        <td class="subject-name">Enseignements communs</td>
                                        <td colspan="3"></td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Français</td>
                                        <td>3 h</td>
                                        <td>-</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Histoire-géographie</td>
                                        <td>1 h 30</td>
                                        <td>1 h 30</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Philosophie</td>
                                        <td>-</td>
                                        <td>2 h</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Langues vivantes 1 et 2 + enseignement technologique en langue vivante A</td>
                                        <td>4 h (dont 1 h d'ETLV)</td>
                                        <td>4 h (dont 1 h d'ETLV)</td>
                                        <td>LVA : 5<br>LVB : 5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Mathématiques</td>
                                        <td>3 h</td>
                                        <td>3 h</td>
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
                                        <td class="subject-name">Accompagnement personnalisé</td>
                                        <td colspan="2">Selon les besoins des élèves</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Accompagnement au choix de l'orientation</td>
                                        <td colspan="2">Selon les besoins des élèves</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name">Heures de vie de classe</td>
                                        <td colspan="2">Selon les besoins des élèves</td>
                                        <td>-</td>
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
                                    <tr><td colspan="4" class="timetable-subheader"><strong>Enseignements de spécialité</strong></td></tr>
                                    <tr>
                                        <td class="subject-name highlight-cell">I2D - Ingénierie et Développement Durable (en Première)</td>
                                        <td class="highlight-cell">9 h</td>
                                        <td class="highlight-cell">-</td>
                                        <td class="highlight-cell">5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name highlight-cell">IT - Innovation Technologique (en Première)</td>
                                        <td class="highlight-cell">3 h</td>
                                        <td class="highlight-cell">-</td>
                                        <td class="highlight-cell">5</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name highlight-cell">2I2D - Ingénierie, Innovation et Développement Durable avec un enseignement spécifique (en Terminale)</td>
                                        <td class="highlight-cell">-</td>
                                        <td class="highlight-cell">12 h</td>
                                        <td class="highlight-cell">16</td>
                                    </tr>
                                    <tr>
                                        <td class="subject-name highlight-cell">Physique-Chimie et Mathématiques</td>
                                        <td class="highlight-cell">6 h</td>
                                        <td class="highlight-cell">6 h</td>
                                        <td class="highlight-cell">16</td>
                                    </tr>
                                    <tr><td colspan="4" class="timetable-subheader"><strong>Enseignements facultatifs (1 au choix)</strong></td></tr>
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
                    <h3><i class="fas fa-graduation-cap"></i> Et après le BAC STI2D...</h3>
                    <button class="collapsible-header">
                        Poursuite d'études <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="collapsible-content" style="max-height: 0;">
                        <div class="apres-bac">
                            <div class="apres-bac-item">
                                <h4><i class="fas fa-school"></i> BTS et BUT (Bac +2/3)</h4>
                                <p>En tête des poursuites d'études après le bac STI2D : un BTS ou un BUT en 2 ou 3 ans, notamment en énergie, logistique, maintenance, informatique industrielle, génie civil, conception de produits industriels, systèmes numériques…</p>
                            </div>
                            <div class="apres-bac-item">
                                <h4><i class="fas fa-cogs"></i> Écoles d'ingénieurs (Bac +5)</h4>
                                <p>Il est aussi possible de postuler dans certaines écoles d'ingénieurs en 5 ans, avec un solide dossier, ou dans quelques écoles spécialisées en électronique, mécanique, réseaux…</p>
                            </div>
                            <div class="apres-bac-item">
                                <h4><i class="fas fa-atom"></i> Classes Préparatoires TSI (Bac +2)</h4>
                                <p>Autre voie : la classe prépa TSI (Technologie et Sciences Industrielles), accessible avec un bon niveau. Réservée aux bacheliers STI2D, elle permet d'intégrer une école d'ingénieurs sans être en concurrence avec les bacs Généraux.</p>
                            </div>
                            <div class="apres-bac-item">
                                <h4><i class="fas fa-university"></i> Université (Licence, Master)</h4>
                                <p>Enfin, pour rejoindre une licence sciences de l'ingénieur à l'université (par exemple, électronique, mécanique…), une année de mise à niveau est parfois conseillée pour consolider les bases scientifiques.</p>
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
                            <p><i class="fas fa-phone"></i> +33 389 70 22 70</p>
                        </div>
                        <div class="contact-info">
                             <div class="contact-block">
                                <h4>Voie Scolaire</h4>
                                <p>Directeur Délégué aux Formations Professionnelles et Technologiques (Industrie)<br>
                                Thomas NIEDERST<br>
                                <a href="mailto:thomas.niederst@ac-strasbourg.fr">thomas.niederst@ac-strasbourg.fr</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    
    <!-- Scripts -->
    <?php 
        $pageSpecificJS = "js/page-specific/formation.js";
        include 'includes/scripts.php'; 
    ?>
    
    <script src="js/script.js"></script>
    <script src="js/page-specific/formation.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des sections dépliables
            const collapsibleHeaders = document.querySelectorAll('.collapsible-header');
            
            collapsibleHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    // Toggle la classe active sur l'en-tête
                    this.classList.toggle('active');
                    
                    // Récupère le contenu associé
                    const content = this.nextElementSibling;
                    
                    // Toggle la classe active sur le contenu
                    content.classList.toggle('active');
                    
                    // Ajuste la hauteur max pour l'animation
                    if (content.classList.contains('active')) {
                        content.style.maxHeight = content.scrollHeight + 'px';
                    } else {
                        content.style.maxHeight = '0';
                    }
                });
            });
            
            // Fonction pour initialiser un carrousel
            function initCarousel(containerId) {
                const container = document.querySelector(containerId);
                if (!container) return;
                
                const tabs = container.querySelectorAll('.carousel-tab');
                const slides = container.querySelectorAll('.carousel-slide');
                const prevBtn = container.querySelector('.carousel-prev');
                const nextBtn = container.querySelector('.carousel-next');
                
                let currentIndex = 0;
                
                // Fonction pour afficher un slide spécifique
                function showSlide(index) {
                    // Masquer tous les slides
                    slides.forEach(slide => {
                        slide.classList.remove('active');
                    });
                    
                    // Désactiver tous les onglets
                    tabs.forEach(tab => {
                        tab.classList.remove('active');
                    });
                    
                    // Afficher le slide sélectionné
                    slides[index].classList.add('active');
                    
                    // Activer l'onglet correspondant
                    tabs[index].classList.add('active');
                    
                    // Mettre à jour l'index courant
                    currentIndex = index;
                }
                
                // Ajouter des écouteurs d'événements aux onglets
                tabs.forEach((tab, index) => {
                    tab.addEventListener('click', () => {
                        showSlide(index);
                    });
                });
                
                // Gestion du bouton précédent
                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        let newIndex = currentIndex - 1;
                        if (newIndex < 0) {
                            newIndex = slides.length - 1;
                        }
                        showSlide(newIndex);
                    });
                }
                
                // Gestion du bouton suivant
                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        let newIndex = currentIndex + 1;
                        if (newIndex >= slides.length) {
                            newIndex = 0;
                        }
                        showSlide(newIndex);
                    });
                }
                
                // Initialiser le carrousel avec le premier slide
                showSlide(0);
            }
            
            // Initialiser les deux carrousels
            initCarousel('.organisation-section .carousel-container');
            initCarousel('.specialites-section .carousel-container');
        });
    </script>
</body>
</html> 
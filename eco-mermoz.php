<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éco-Mermoz - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .eco-section {
            margin-bottom: 2.5rem;
        }
        
        .eco-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .eco-card h3 {
            color: #2e7d32;
            border-bottom: 2px solid #2e7d32;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        .eco-card p {
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        .eco-quote {
            background-color: #f1f8e9;
            border-left: 4px solid #2e7d32;
            padding: 1.5rem;
            margin: 1.5rem 0;
            font-style: italic;
            position: relative;
        }
        
        .eco-quote:before {
            content: '\201C';
            font-size: 4rem;
            font-family: Georgia, serif;
            color: #2e7d32;
            opacity: 0.3;
            position: absolute;
            top: -20px;
            left: 10px;
        }
        
        .contact-box {
            background-color: #f1f8e9;
            border-radius: 8px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .contact-box i {
            font-size: 2rem;
            color: #2e7d32;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .feature-box {
            background-color: #f1f8e9;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: left;
            transition: transform 0.3s ease;
            border-left: 4px solid #2e7d32;
        }
        
        .feature-box:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            font-size: 2rem;
            color: #2e7d32;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .feature-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #2e7d32;
        }
        
        .feature-list {
            padding-left: 1.2rem;
        }
        
        .feature-list li {
            margin-bottom: 0.5rem;
            position: relative;
        }
        
        .feature-list li:before {
            content: '\f058';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: #2e7d32;
            position: absolute;
            left: -1.2rem;
            top: 2px;
        }
        
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover {
            transform: translateY(-5px);
        }
        
        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        
        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(46, 125, 50, 0.8);
            color: white;
            padding: 0.8rem;
            font-size: 0.9rem;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover .gallery-caption {
            transform: translateY(0);
        }
        
        .schema {
            display: block;
            margin: 2rem auto;
            max-width: 100%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        
        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #2e7d32, transparent);
            margin: 2rem 0;
        }
        
        /* Accordéon */
        .accordion-container {
            margin: 2rem 0;
        }
        
        .accordion-item {
            margin-bottom: 1rem;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .accordion-header {
            background-color: #f1f8e9;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-left: 4px solid #2e7d32;
        }
        
        .accordion-header:hover {
            background-color: #e8f5e9;
        }
        
        .accordion-header i:first-child {
            color: #2e7d32;
            font-size: 1.2rem;
            margin-right: 1rem;
            width: 24px;
            text-align: center;
        }
        
        .accordion-header span {
            flex: 1;
            font-weight: 600;
            font-size: 1.1rem;
            color: #2e7d32;
        }
        
        .accordion-icon {
            transition: transform 0.3s ease;
        }
        
        .accordion-item.active .accordion-icon {
            transform: rotate(180deg);
        }
        
        .accordion-content {
            background-color: #fff;
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }
        
        .accordion-item.active .accordion-content {
            padding: 1.5rem;
            max-height: 500px;
        }
        
        /* Mode sombre */
        [data-theme="dark"] .eco-card {
            background-color: var(--card-bg);
        }
        
        [data-theme="dark"] .eco-quote,
        [data-theme="dark"] .contact-box,
        [data-theme="dark"] .feature-box,
        [data-theme="dark"] .accordion-header {
            background-color: #1c2a1c;
        }
        
        [data-theme="dark"] .accordion-content {
            background-color: var(--card-bg);
        }
        
        @media (max-width: 768px) {
            .features-grid,
            .gallery {
                grid-template-columns: 1fr;
            }
            
            .eco-card {
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
                <h1>ÉCO-MERMOZ</h1>
                <p>« Le lycée Jean-Mermoz, un modèle de développement durable ! »</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <!-- Introduction -->
                <div class="eco-section">
                    <div class="eco-card">
                        <div class="contact-box">
                            <i class="fas fa-user-tie"></i>
                            <div>
                                <p><strong>Maître d'œuvre du projet Eco-Mermoz :</strong> Marvin DECONINCK</p>
                                <p><strong>Courriel :</strong> <a href="mailto:contact@marvindeconinck.fr">contact@marvindeconinck.fr</a></p>
                            </div>
                        </div>
                        
                        <div class="eco-quote">
                            <p>L'intention du projet initialement intitulé « Mon lycée se met au vert » puis rebaptisé « Éco-Mermoz », débuté en décembre 2018, est d'inscrire dans les mœurs du lycée des valeurs respectueuses de l'environnement, et ainsi devenir une communauté d'éco-citoyens.</p>
                        </div>
                        
                        <p>Sa durée est indéterminée. Le but n'est pas de se précipiter mais de construire progressivement et collectivement les bases solides d'une nouvelle politique, organisation et d'un nouveau fonctionnement. L'imprégnation des principes inculqués se concrétisera et se manifestera au fil des actions et du temps. C'est un projet social d'intérêt général, visant à changer le comportement de la communauté.</p>
                        
                        <img src="images/atouts/schemas.jpg" alt="Schéma descriptif du projet Éco-Mermoz" class="schema">
                    </div>
                </div>
                
                <!-- Prémices du projet -->
                <div class="eco-section">
                    <div class="eco-card">
                        <h3><i class="fas fa-seedling"></i> Les prémices du projet</h3>
                        
                        <h4>Les spécificités de l'infrastructure</h4>
                        <p>En 2008, le lycée est une nouvelle fois inauguré à la suite de rénovations et d'agrandissement. Certains aspects de l'architecture et des installations ont été prévus avec une logique écologique :</p>
                        
                        <div class="features-grid">
                            <div class="feature-box">
                                <div class="feature-icon">
                                    <i class="fas fa-sun"></i>
                                </div>
                                <div class="feature-title">Optimisation de la lumière naturelle</div>
                                <ul class="feature-list">
                                    <li>Larges baies vitrées</li>
                                    <li>Réflecteurs de lumière sur les rebords intérieurs des fenêtres</li>
                                    <li>Limitation de l'usage de l'électricité</li>
                                </ul>
                            </div>
                            
                            <div class="feature-box">
                                <div class="feature-icon">
                                    <i class="fas fa-solar-panel"></i>
                                </div>
                                <div class="feature-title">Aménagements des toits</div>
                                <ul class="feature-list">
                                    <li>Zones de toiture végétale créant des espaces naturels</li>
                                    <li>Amélioration de la performance thermique des locaux</li>
                                    <li>Panneaux photovoltaïques produisant de l'électricité</li>
                                    <li>Alimentation en eau chaude des sanitaires</li>
                                </ul>
                            </div>
                            
                            <div class="feature-box">
                                <div class="feature-icon">
                                    <i class="fas fa-water"></i>
                                </div>
                                <div class="feature-title">Gestion des eaux</div>
                                <ul class="feature-list">
                                    <li>Fossés d'évacuation des eaux pluviales</li>
                                    <li>Bac de rétention naturel</li>
                                    <li>Évacuation et traitement des eaux usées</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobilisation interne -->
                <div class="eco-section">
                    <div class="eco-card">
                        <h3><i class="fas fa-hands-helping"></i> La mobilisation en interne</h3>
                        
                        <p>Dans l'organisation du lycée, plusieurs membres ont agi, et agissent, en perpétuant cette logique écologique. Certaines actions sont la traduction d'une orientation politique affirmée. Ces objectifs atteints en 2015, en témoignent :</p>
                        
                        <div class="features-grid">
                            <div class="feature-box">
                                <div class="feature-icon">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <div class="feature-title">Objectifs écologiques atteints</div>
                                <ul class="feature-list">
                                    <li>Suppression de l'utilisation de tous les produits phytosanitaires</li>
                                    <li>Réduction et valorisation des déchets verts en interne</li>
                                    <li>Ouverture des espaces verts aux usagers</li>
                                    <li>Gestion différenciée des espaces extérieurs</li>
                                </ul>
                            </div>
                            
                            <div class="feature-box">
                                <div class="feature-icon">
                                    <i class="fas fa-recycle"></i>
                                </div>
                                <div class="feature-title">Moyens de récupération et de recyclage</div>
                                <ul class="feature-list">
                                    <li>Récupération et recyclage du matériel bureautique</li>
                                    <li>Collecte et recyclage des piles et accumulateurs</li>
                                    <li>Collecte et recyclage des bouchons en plastique</li>
                                    <li>Tri et recyclage du papier</li>
                                    <li>Récupération des mégots</li>
                                    <li>Tri du pain</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <h4>Initiatives de l'Agent paysagiste</h4>
                        <p>L'Agent paysagiste, qui entretient quotidiennement les espaces verts, est à l'initiative de plusieurs modifications et aménagements, valorisant cet esprit d'entreprise. Principalement liés à la renaturation et au fleurissement de la structure :</p>
                        
                        <ul class="feature-list">
                            <li>Zones laissées en friche, création de jachères fleuries et utilisation du lierre terrestre</li>
                            <li>Plantation de fleurs, d'arbres fruitiers et d'ornement (cerisier, figuier, tulipier, etc.)</li>
                            <li>Conception et fabrication d'un plantoir à bulbes par les BTS CPI et leurs enseignants</li>
                            <li>Création d'un carré potager et de cabanes à oiseaux, en collaboration avec une enseignante et ses élèves</li>
                            <li>Création d'un hôtel à insectes avec un membre de son équipe</li>
                            <li>Création d'une cabane à hérissons</li>
                        </ul>
                        
                        <div class="divider"></div>
                        
                        <h4>L'intention d'aller plus loin dans la démarche</h4>
                        <ul class="feature-list">
                            <li>La Direction du lycée souhaite intégrer des valeurs éco-citoyennes dans les mœurs de l'organisation</li>
                            <li>Le Conseil régional incite à s'engager, par l'intermédiaire de sa démarche de développement durable « Lycées en transition »</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Les actions menées -->
                <div class="eco-section">
                    <div class="eco-card">
                        <h3><i class="fas fa-tasks"></i> Les actions menées</h3>
                        
                        <h4>Pilotage participatif</h4>
                        
                        <div class="accordion-container">
                            <!-- Comité de pilotage -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-users-cog"></i>
                                    <span>Comité de pilotage (COPIL)</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Le COPIL (comité de pilotage), organe décisionnel et de suivi, est composé :</p>
                                    <ul class="feature-list">
                                        <li>du Proviseur</li>
                                        <li>de 4 Enseignants</li>
                                        <li>de 2 Conseillers Principaux d'Éducation (CPE)</li>
                                        <li>du Maître d'oeuvre</li>
                                        <li>de l'Intendant</li>
                                        <li>de l'Agent comptable</li>
                                        <li>de l'Agent chef</li>
                                        <li>de l'Agent des espaces verts</li>
                                        <li>d'une Documentaliste</li>
                                        <li>de 3 éco-délégués</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Cellule d'éco-délégués -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Cellule d'éco-délégués</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Les éco-délégués sont des élèves volontaires chargés de suivre le déroulement du projet, de proposer de nouvelles actions et de représenter les valeurs écocitoyennes dans la politique du lycée. Ils s'engagent en signant une charte, établie par eux-mêmes.</p>
                                    <p>Il y en a en moyenne entre 40 et 60 éco-délégués.</p>
                                    <p>Aussi, une attestation de compétences a été créée afin de valoriser l'investissement de ces derniers.</p>
                                </div>
                            </div>
                            
                            <!-- Club éco-citoyen -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-globe-europe"></i>
                                    <span>Club éco-citoyen</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Organisation regroupant le COPIL, les éco-délégués et l'ensemble des acteurs impliqués dans le projet.</p>
                                </div>
                            </div>
                            
                            <!-- Label E3D -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-award"></i>
                                    <span>Label E3D</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Le lycée a obtenu en juin 2021 le label E3D (Etablissement en démarche de développement durable), niveau engagement, décerné par l'Académie de Strasbourg via la DAAC.</p>
                                    <p>En juin 2023, le niveau expertise a été décerné.</p>
                                    <p>Le dossier d'obtention a été constitué sous forme de projet pédagogique. Deux classes de terminale Gestion/Administration s'en sont chargées, encadrées par leurs professeurs.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Galerie photos -->
                <div class="eco-section">
                    <div class="eco-card">
                        <h3><i class="fas fa-images"></i> Nos réalisations en images</h3>
                        
                        <div class="gallery">
                            <div class="gallery-item">
                                <img src="images/batiments/panneu-solaire.jpg" alt="Panneau photovoltaïque">
                                <div class="gallery-caption">Écran (situé dans le hall du bâtiment C) affichant la quantité mesurée de courant électrique produite par les panneaux photovoltaïques</div>
                            </div>
                            
                            <div class="gallery-item">
                                <img src="images/atouts/espace-nature.jpg" alt="Label Espace Nature">
                                <div class="gallery-caption">Un audit mené par la Fredon (Fédération Régionale de lutte et de défense contre les Organismes Nuisibles) a permis d'obtenir le label « Espace Nature », et 3 libellules</div>
                            </div>
                            
                            <div class="gallery-item">
                                <img src="images/atouts/espaces-verts-768x576.jpg" alt="Espace avec tonte diversifiée">
                                <div class="gallery-caption">Espace avec tonte diversifiée</div>
                            </div>
                            
                            <div class="gallery-item">
                                <img src="images/atouts/insectes-768x985.jpg" alt="Hôtel à insectes">
                                <div class="gallery-caption">Hôtel à insectes</div>
                            </div>
                        </div>
                        

                    </div>
                </div>
                
                <!-- Actions matérielles et éducatives -->
                <div class="eco-section">
                    <div class="eco-card">
                        <h3><i class="fas fa-tools"></i> Actions matérielles et éducatives</h3>
                        
                        <div class="accordion-container materielles-accordions">
                            <!-- Ruches d'abeilles -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-hive"></i>
                                    <span>Ruches d'abeilles</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Il y a une vingtaine de ruches installées dans l'établissement.</p>
                                    <p>La Miellerie des Moulins, avec son apiculteur qui les entretient, a été le partenaire de cette opération pendant 6 ans. En 2024, c'est le Rucher des Lys qui prendra le relai.</p>
                                    <p>La mise en œuvre d'une technologie permettant d'observer, de peser, de mesurer la température et la fréquentation, a été réalisée par 3 élèves du Brevet de Technicien Supérieur de la section « Systèmes Photoniques » encadrée par 2 professeurs. Le système permet de compter les abeilles, peser le miel et relever la température. Il est présenté lors de la semaine écocitoyenne mais n'a pas encore été installée.</p>
                                    <p>Le miel est mis en vente depuis 3 ans pour la communauté lycéenne, sous la forme d'un projet pédagogique faisant intervenir une classe de CAP Commerce encadrée par leur professeur.</p>
                                </div>
                            </div>
                            
                            <!-- Plantations -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-seedling"></i>
                                    <span>Plantations</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Des plantes ornementales sont en pot dans le hall du lycée.</p>
                                    <p>Un verger (8 arbres : quetschiers, mirabelliers et pommiers) ainsi que des plantes ornementales et vivaces ont été plantés dans les espaces verts.</p>
                                    <p>Un jardin aromatique va être planté près de la cantine.</p>
                                </div>
                            </div>
                            
                                                         <!-- Éco-pâturage -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-sheep"></i>
                                    <span>Éco-pâturage</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Chaque année, depuis 2020, 2 troupeaux de 6 brebis amenées par un éleveur local (Alternature) prennent place pour brouter l'herbe des espaces verts, du mois d'avril au mois d'octobre. Cela permet d'éviter l'usage des engins de débroussaillement et de participer à la recréation d'une biodiversité, notamment liée aux insectes.</p>
                                    
                                    <div class="eco-image-container" style="text-align: center; margin: 1.5rem 0;">
                                        <img src="images/formations/moutton.jpg" alt="Agneau né au lycée Jean-Mermoz" style="max-width: 350%; max-height: 350px; height: 180px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); object-fit: cover; display: block; margin: 0 auto;">
                                        <p style="font-style: italic; margin-top: 0.8rem; color: #666; font-size: 0.9rem; text-align: center;">Un agneau né au lycée Jean-Mermoz</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hôtels à hirondelles -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-dove"></i>
                                    <span>Hôtels à hirondelles</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Deux hôtels à hirondelles ont été installés afin d'œuvrer à la survie de l'espèce.</p>
                                    <p>Le premier au printemps 2021 et le second au printemps 2024.</p>
                                    <p>Ce projet est le fruit d'un partenariat avec la Ville de Saint-Louis et de la LPO (Ligue de Protection des oiseaux).</p>
                                    <p>Il s'agit d'abord de permettre le développement de l'hirondelle, espèce menacée à cause de l'urbanisation. De plus, elle participe à la biodiversité tout en nous protégeant des moustiques tigres, par exemple.</p>
                                </div>
                            </div>
                            
                            <!-- Matériel pour l'agent paysagiste -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-leaf"></i>
                                    <span>Matériel pour l'agent paysagiste</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Acquisition d'équipements à batterie pour réduire les nuisances sonores et les émissions de gaz à effet de serre ainsi que d'améliorer les conditions de travail des agents.</p>
                                </div>
                            </div>
                            
                            <!-- Création d'un milieu humide -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-water"></i>
                                    <span>Création d'un milieu humide (mare)</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Le projet est de créer une mare pour les espèces vivant dans un milieu humide. L'association Bufo conseille le lycée. Les travaux, qui débuteront en 2024, seront exécutés par l'entreprise Nature-Techniques. Le projet, s'inscrivant dans le Programme Régional d'Actions en faveur des Mares (PRAM), sera soutenu financièrement par l'Agence de l'Eau Rhin-Meuse.</p>
                                    <p>Un projet pédagogique parallèle pour les éco-délégués a été mis en place pour accompagner cette démarche, avec la Petite Camargue Alsacienne dans le cadre du projet « Life Biodiv'Est » organisé par la Région Grand-Est et l'Ariena.</p>
                                </div>
                            </div>
                            
                            <!-- Création d'un pierrier -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-mountain"></i>
                                    <span>Création d'un pierrier</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Le projet est mené par l'agent paysagiste, les 3èmes Prépa.Métiers et leurs enseignants.</p>
                                    <p>L'objectif est de créer un habitat pour les espèces vivantes, par exemple :</p>
                                    <ul class="feature-list">
                                        <li>lézard vert</li>
                                        <li>punaise écuyère</li>
                                        <li>araignée rouge</li>
                                        <li>orvet</li>
                                        <li>troglodyte mignon</li>
                                        <li>hérisson</li>
                                        <li>hermine...</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Lieux de ressourcement -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-spa"></i>
                                    <span>Lieux de ressourcement / zones dédiées au bien-être</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Des lieux de ressourcement en extérieur ont été installés :</p>
                                    <ul class="feature-list">
                                        <li>des mobiliers de jardin fabriquées par les élèves avec des matériaux recyclés (palettes par exemple) ;</li>
                                        <li>des structures de sport à l'internat et à l'externat. Elles ont été financées par la Maison Des Lycéens et installées par nos agents.</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Collectes -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-recycle"></i>
                                    <span>Collectes</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Le lycée organise des collectes pour le recyclage. Ainsi, sont récupérés :</p>
                                    <ul class="feature-list">
                                        <li>le matériel bureautique</li>
                                        <li>les piles, accumulateurs et autres déchets chimiques</li>
                                        <li>les déchets d'équipements électriques et électroniques</li>
                                        <li>les bouchons en plastique</li>
                                    </ul>
                                    <p>Les partenaires sont LVL, Tredi (Séché Environnement), Les bouchons de l'espoir et Lions Club St-Louis.</p>
                                </div>
                            </div>
                            
                            <!-- Tri et recyclage du papier -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-newspaper"></i>
                                    <span>Tri et recyclage du papier</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Le papier et le carton du lycée sont récupérés pour être recyclés. Une benne de tri est à disposition. Le papier est aussi réutilisé comme brouillon dans les salles de classe. Saint-Louis Agglomération est le partenaire pour cette opération.</p>
                                    <p>De plus, l'essuie-main utilisé au lycée est en papier recyclé. Le partenaire pour cette opération est Lucart.</p>
                                </div>
                            </div>
                            
                            <!-- Tri sélectif -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-sort"></i>
                                    <span>Tri sélectif</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Le tri sélectif (papier, plastique et métal) est fonctionnel à l'internat et à l'externat.</p>
                                    <p>Saint-Louis Agglomération participe à cette opération.</p>
                                </div>
                            </div>
                            
                            <!-- Collecte des chutes d'imprimantes 3D -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-print"></i>
                                    <span>Collecte des chutes d'imprimantes 3D</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Mise en place de la collecte des chutes d'imprimantes 3D effectuée par l'équipe SI, en partenariat avec Recycling Fabrik.</p>
                                </div>
                            </div>
                            
                            <!-- Distribution de gourdes métalliques -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-bottle-water"></i>
                                    <span>Distribution de gourdes métalliques</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Un projet de distribution de gourdes métalliques a été lancé au lycée afin de réduire l'usage du plastique. Il est porté par une classe de Bac Pro Commerce et les éco-délégués, qui ont distribué 500 gourdes pendant l'année 2023/2024, à l'occasion d'un tournoi sportif et de la semaine écocitoyenne.</p>
                                </div>
                            </div>
                            
                            <!-- Friperie -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-tshirt"></i>
                                    <span>Friperie</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>L'idée de mettre en place un système de vente de vêtements d'occasion est venue d'une éco-déléguée. Elle s'est ensuite concrétisée en projet mené par une classe de commerce encadrée par leurs professeurs.</p>
                                    <p>Depuis l'année 2023/2024, l'association Terre des hommes est partenaire de cette opération.</p>
                                </div>
                            </div>
                            
                            <!-- Système de gestion des mégots -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-smoking-ban"></i>
                                    <span>Système de gestion des mégots</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Une boîte à mégots a été installée à l'entrée du lycée, des cendriers portatifs sont distribués aux élèves. L'objectif est d'inciter les élèves a ne plus jeter par terre leurs mégots, devant et aux alentours du lycée. De plus, des campagnes de sensibilisation sur l'effet du tabagisme sur la santé sont organisées. Les infirmières du lycée, la PEEP (Association des parents d'élèves) ont participé à cette opération. La Jeune Chambre Economique de Saint-Louis en est partenaire.</p>
                                </div>
                            </div>
                            
                            <!-- Etude des performances énergétiques -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Etude des performances énergétiques de l'établissement</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Enquête menée sur les consommations d'eau et d'électricité du lycée pour informer les usagers et trouver les moyens de les réduire.</p>
                                    <p>Travail effectué par les éco-délégués avec l'association « Alter Alsace Énergie ».</p>
                                    <p>Un rapport a été rédigé, avec la liste du parc machine, les résultats de l'enquête et des recommandations. Il est donc un support d'information et de communication.</p>
                                </div>
                            </div>
                            
                            <!-- Actions de réduction de la consommation électrique -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-lightbulb"></i>
                                    <span>Actions de réduction de la consommation électrique</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>De nombreuses actions sont menées pour réduire la consommation électrique du lycée. Pour exemples : l'utilisation de projecteurs à LED et de détecteurs de présence (projet de relampage), la mise en place d'un logiciel permettant l'extinction programmée des ordinateurs (en cas d'oubli) ou la programmation de l'éclairage. Des instructions pratiques sont également affichées.</p>
                                </div>
                            </div>
                            
                            <!-- Actions de réduction de la consommation d'eau -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-tint"></i>
                                    <span>Actions de réduction de la consommation d'eau</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Deux actions sont mises en place :</p>
                                    <ul class="feature-list">
                                        <li>Investissement dans des mousseurs de robinet, réduisant le débit de l'écoulement de l'eau donc la consommation</li>
                                        <li>Réglage du temps d'écoulement</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Ecologie numérique -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-laptop"></i>
                                    <span>Ecologie numérique</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Deux actions ont été menées dans ce domaine :</p>
                                    <ul class="feature-list">
                                        <li>l'utilisation du moteur de recherche « Ecosia », proposé sur le site internet du lycée et dans les salles informatiques du lycée</li>
                                        <li>une formation sur la pollution numérique faite aux élèves</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Système de covoiturage -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-car"></i>
                                    <span>Système de covoiturage</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>L'application Klaxit a été mise en place pour favoriser le covoiturage.</p>
                                    <p>L'opération a été mené en partenariat avec Saint-Louis Agglomération.</p>
                                </div>
                            </div>
                            
                            <!-- Traitement des déchets alimentaires -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-utensils"></i>
                                    <span>Traitement des déchets alimentaires</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Un partenariat a été établi avec Agrivalor afin de traiter les déchets alimentaires et les huiles de cuisson.</p>
                                    <p>Cette entreprise récupère les déchets au sein des collectivités, entreprises et des particuliers, en effectuant des trajets optimisés. Elle les revalorise et utilise ensuite pour créer de l'electricité (par le principe de biométhanisation) ou encore des engrais.</p>
                                </div>
                            </div>
                            
                            <!-- Enquête sur le gaspillage alimentaire -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-search"></i>
                                    <span>Enquête sur le gaspillage alimentaire</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Engagé dans l'axe « Gaspillons moins, mangeons mieux » de la démarche régionale « Lycées en transition », l'équipe cuisine et les éco-délégués participe à une enquête sur le gaspillage alimentaire de la cantine, en vue de le réduire. Organeo est le partenaire de cette opération.</p>
                                </div>
                            </div>
                            
                            <!-- Actions de réduction du gaspillage alimentaire -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-cut"></i>
                                    <span>Actions de réduction du gaspillage alimentaire</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Des actions sont mises en place ou vont l'être dans le but de réduire le gaspillage :</p>
                                    <ul class="feature-list">
                                        <li>réorganisation de la cantine et investissements</li>
                                        <li>Intégration des élèves dans l'élaboration des menus</li>
                                        <li>mis en place d'un système de réservation</li>
                                    </ul>
                                    <p>L'objectif est de passer de 100g/repas de gaspillage par convive à 70g/repas.</p>
                                </div>
                            </div>
                            
                            <!-- Augmentation des produits bio/locaux -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-leaf"></i>
                                    <span>Augmentation des produits bio/locaux</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>La cuisine, qui sert plus de 1000 repas par jour, propose déjà régulièrement des produits bio/locaux, à savoir :</p>
                                    <ul class="feature-list">
                                        <li>crudités</li>
                                        <li>riz, boulgour, céréales gourmandes, semoule, pommes de terre</li>
                                        <li>légumes d'accompagnement</li>
                                        <li>fonds de sauce</li>
                                        <li>plats végétariens</li>
                                        <li>œufs</li>
                                        <li>fromages et yaourts</li>
                                        <li>fruits crus ou à croquer</li>
                                        <li>viandes</li>
                                    </ul>
                                    <p>Elle souhaite cependant augmenter la quantité de produits issus de l'agriculture biologique et locale, en multipliant les partenariats auprès des producteurs et des éleveurs locaux. Les éco-délégués soutiennent cette démarche. L'objectif est de passer de passer de 30 à 50% de produits bio/locaux en deux ans.</p>
                                    <p>La mise en place d'une filière de pain local est en étude avec Saint-Louis Agglomération et Ecooparc.</p>
                                </div>
                            </div>
                            
                            <!-- Agrandissement parc à vélos -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-bicycle"></i>
                                    <span>Agrandissement/Aménagement du parc à vélos</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Les éco-délégués ont travaillé sur le projet d'agrandissement du parc à vélos et de son aménagement (station de réparation).</p>
                                    <p>Via son programme Alvéole Plus, la Fédération des Usagers de la Bicyclette (FUB) vont financer une partie du projet. Les travaux, qui seront réalisés par l'entreprise Inotechna, sont prévus en 2024.</p>
                                </div>
                            </div>
                            
                            <!-- Construction d'un gymnase écologique -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-building"></i>
                                    <span>Construction d'un gymnase écologique</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>La construction de ce gymnase, prévue en 2024/2025, est une opération organisée par la Région Grand-Est. Les professeurs de sport et les éco-délégués travaillent sur la rédaction du cahier des charges.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions de communication -->
                <div class="eco-section">
                    <div class="eco-card">
                        <h3><i class="fas fa-bullhorn"></i> Actions de communication</h3>
                        
                        <div class="accordion-container communication-accordions">
                            <!-- Formation au développement durable -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Formation au développement durable</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Le maître d'œuvre et les éco-délégués ont créé une formation au développement durable.</p>
                                    <p>Ainsi, tout nouvel arrivant au lycée (élève ou membre du personnel) suit cette formation qui a pour vocation de le sensibiliser aux différentes problématiques environnementales (l'épuisement des ressources/la surconsommation, la pollution de l'air, de la terre et de la mer, l'extinction des espèces vivantes), présenter les actions menées au lycée et les bonnes pratiques à adopter suivant les thématiques abordées (la gestion des ressources, de l'énergie et des déchets, la renaturation, la santé).</p>
                                </div>
                            </div>
                            
                            <!-- Sensibilisation, information et formation des usagers -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Sensibilisation, information et formation des usagers</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>L'objectif est de sensibiliser et d'informer la communauté sur les problèmes environnementaux, justifiant ainsi la nécessité de mener le projet « Eco-Mermoz », puis de les former aux nouvelles pratiques mises en place au lycée. Plusieurs moyens de communication sont utilisés :</p>
                                    <ul class="feature-list">
                                        <li>Interventions orales</li>
                                        <li>Affichages sur les écrans vidéo et dans les endroits les plus fréquentés du lycée</li>
                                        <li>Publication sur les réseaux sociaux</li>
                                        <li>Événements avec des animations</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Diffusion sur les réseaux sociaux -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-share-alt"></i>
                                    <span>Diffusion sur les réseaux sociaux</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Pour présenter publiquement le projet et ses actions.</p>
                                    <p>Les diffusions se trouvent sur Facebook, Instagram et Mon bureau Numérique.</p>
                                    <p>Action menée par les éco-délégués.</p>
                                </div>
                            </div>
                            
                            <!-- Ecoflash -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-bolt"></i>
                                    <span>Ecoflash</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>L'objectif est de sensibiliser les usagers à la démarche écocitoyenne par la diffusion d'une information sur les écrans du lycée.</p>
                                    <p>Au départ hebdomadaire (et intitulé Flash Hebdo) pour sensibiliser fortement sur les problématiques environnementales, ce format est dorénavant sans périodicité régulière et vise principalement à mettre en valeur les actions mises en place au lycée.</p>
                                </div>
                            </div>
                            
                            <!-- Parcours pédagogique -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-route"></i>
                                    <span>Parcours pédagogique</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Action en cours d'élaboration, faisant l'objet d'un projet de création de panneaux d'informations. Pour le moment, sept ont déjà été produits et installés. L'objectif est de communiquer sur l'ensemble des actions menées au lycée.</p>
                                    <p>Le club écocitoyen crée le contenu des panneaux et choisi leurs dispositions ; Leur fabrication (avec des matériaux recyclés) est réalisée par des apprentis, encadré par leur professeur des métiers de l'enseigne et la signalétique, chef de l'entreprise O Puissance 4.</p>
                                </div>
                            </div>
                            
                            <!-- Communication artistique -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-palette"></i>
                                    <span>Communication artistique</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>La sensibilisation est aussi réalisée en utilisant l'art. Ainsi :</p>
                                    <ul class="feature-list">
                                        <li>Un groupe d'éco-délégués musiciens se réunit afin d'interpréter des chansons traitant les sujets liés à l'écologie, pour les présenter à leurs camarades. Ils ont notamment l'occasion de se représenter en concert pendant la semaine écocitoyenne. Le groupe se nomme « Eco-Mermoz », comme le projet.</li>
                                        <li>Une montagne de déchets a été réalisée par des éco-délégués de l'option « Arts plastiques ».</li>
                                        <li>Des clips vidéos sont aussi réalisés.</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Evénement écocitoyen intergénérationnel -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-users"></i>
                                    <span>Evénement écocitoyen intergénérationnel</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>L'objectif est d'organiser des journées dédiées aux actions écologiques, avec des campagnes de sensibilisation et d'informations, la présentation des actions menées au lycée et des animations. Cela permet aux éco-délégués du lycée de sensibiliser les plus jeunes générations.</p>
                                    <p>Le premier événement a eu lieu au printemps 2021. Les enfants de l'école maternelle Jules Verne étaient les visiteurs. La Petite Camargue Alsacienne a participé à l'événement.</p>
                                </div>
                            </div>
                            
                            <!-- Semaine écocitoyenne -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Semaine écocitoyenne</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>L'organisation d'une semaine écocitoyenne, animée par de nombreux ateliers, a été instaurée chaque année, au printemps.</p>
                                    <p>La première a eu lieu en avril 2022, la seconde en mai 2023 et la troisième en mai 2024.</p>
                                    <p>Les ateliers, proposés par les éco-délégués et les partenaires extérieurs, ont pour but de mettre en valeur les actions portées au lycée à travers les thématiques suivantes : renaturation, gestion des ressources, de l'énergie et des déchets, la santé et bien-être.</p>
                                </div>
                            </div>
                            
                            <!-- Découverte des métiers -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-briefcase"></i>
                                    <span>Découverte des métiers</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Il y a deux classes de 3ème au lycée: les P3Métiers</p>
                                    <p>Encadré par leur professeur prinicipal, ils rencontrent les différents acteurs du projet ayant des métiers spécifiques (paysagiste, apiculteur, agriculteur, etc.) et participe avec les professeurs d'atelier à différents travaux (salons de jardin, carré potager, etc.)</p>
                                </div>
                            </div>
                            
                            <!-- Atelier d'architecture par la renaturation -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-drafting-compass"></i>
                                    <span>Atelier d'architecture par la renaturation</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Mené par un enseignant (STI), l'atelier a pour objectif d'initier à l'architecture par la renaturation par la création de maquettes.</p>
                                </div>
                            </div>
                            
                            <!-- Sentier pieds nus / Parcours nature / Atelier biodiversité -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-leaf"></i>
                                    <span>Sentier pieds nus / Parcours nature / Atelier biodiversité</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Trois animations sont proposées durant la semaine écocitoyenne :</p>
                                    <ul class="feature-list">
                                        <li>Un sentier pieds nus a été mis en place afin de connecter la communauté à la nature par le biais d'une expérience sensorielle</li>
                                        <li>Un parcours nature, une course d'orientation avec des éléments précis de la nature du lycée à trouver</li>
                                        <li>Un atelier biodiversité animé par la Petite Camargue Alsacienne, l'objectif étant d'étudier la biodiversité du lycée par l'intermédiaire de recherches et de prises de note</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Page 2 des activités -->
                        <div class="accordion-container communication-accordions">
                            <!-- Animation sur les moustiques -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-bug"></i>
                                    <span>Animation sur les moustiques</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>L'animation est proposée par la brigade verte, pendant l'année et durant la semaine écocitoyenne.</p>
                                    <p>L'objectif est d'informer la communauté lycéenne sur les caractéristiques du moustique et des différentes espèces, notamment le moustique tigre sur lequel une sensibilisation spécifique est faite.</p>
                                </div>
                            </div>
                            
                            <!-- Atelier origami et fabrication d'objets recyclés -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-recycle"></i>
                                    <span>Atelier origami et fabrication d'objets recyclés / Atelier tri et réduction des déchets</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Les ateliers sont organisés dans le cadre de la semaine écocitoyenne. L'objectif étant de former les élèves au tri et à la réduction des déchets et favoriser le recyclage du papier et des canettes :</p>
                                    <ul class="feature-list">
                                        <li>Atelier de tri et de réduction des déchets en partenariat avec Eco-sulting</li>
                                        <li>Ateliers d'origami et de fabrication d'objets recyclés (canettes par exemple)</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Atelier linge -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-tshirt"></i>
                                    <span>Atelier linge</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Les ateliers suivant sont proposés durant la semaine écocitoyenne :</p>
                                    <ul class="feature-list">
                                        <li>Réparation/customisation de vêtements (couture)</li>
                                        <li>Fabrication de lessive maison</li>
                                        <li>Tri du linge</li>
                                        <li>Exposition textile</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Atelier sur le cycle de l'eau -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-water"></i>
                                    <span>Atelier sur le cycle de l'eau</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>L'atelier, qui a pour objectif d'expliquer aux élèves le cycle de l'eau, est animé par Véolia.</p>
                                </div>
                            </div>
                            
                            <!-- Jeux sur la gestion de l'énergie -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-bolt"></i>
                                    <span>Jeux sur la gestion de l'énergie</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Des jeux ludiques sur la consommation d'électricité et d'eau sont organisés dans le cadre de la semaine écocitoyenne. Alter Alsace Energies a accompagné les éco-délégués dans la préparation du matériel et des animations.</p>
                                    <p>Un atelier sur la pollution numérique est également proposé.</p>
                                </div>
                            </div>
                            
                            <!-- Ateliers Hop'la transition -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-sync-alt"></i>
                                    <span>Ateliers Hop'la transition</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Pendant la semaine écocitoyenne, l'association Hop'la transition propose plusieurs ateliers :</p>
                                    <ul class="feature-list">
                                        <li>La fresque du climat</li>
                                        <li>La fresque de l'eau</li>
                                        <li>La fresque de l'économie circulaire</li>
                                        <li>La chasse au trésor numérique</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Défi "Au Mermoz, j'y vais autrement" -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-trophy"></i>
                                    <span>Défi "Au Mermoz, j'y vais autrement" et concours "Objectif Nature"</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>La défi « J'y vais », soutenu par L'ADEME, la Région Grand-Est, Saint-Louis Agglomération et la commune, a pour but d'inciter la communauté lycéenne à se déplacer à vélo au lycée, ou privilégier des transports écologiques (marche, transport en commun, etc.)</p>
                                    <p>Ainsi, les élèves participent au défi « Au lycée, j'y vais autrement » et les salariés au défi « Au boulot, j'y vais autrement ».</p>
                                    <p>La communauté lycéenne participe également au concours de photos « Objectif Nature », organisé par la Région Grand-Est, qui récompense la photo mettant le plus en valeur la nature dans l'établissement.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Page 3 des activités -->
                        <div class="accordion-container communication-accordions">
                            <!-- Atelier de réparation de vélos -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-bicycle"></i>
                                    <span>Atelier de réparation de vélos</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Un atelier de réparation de vélos a été proposé lors des deux dernières semaines écocitoyenne.</p>
                                    <p>La première fois, dirigé par La maison du vélo Alsace et la seconde par Les Tisserands d'EBN.</p>
                                </div>
                            </div>
                            
                            <!-- Evénements sportifs -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-running"></i>
                                    <span>Evénements sportifs</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Des événements sportifs sont organisés pendant la semaine écocitoyenne, afin de favoriser l'exercice physique.</p>
                                    <p>Cela peut être un tournoi de sports collectifs (basketball, football et handball) ou un challenge individuel.</p>
                                    <p>La récompense donnée aux équipes victorieuses peut être des pots de miel (des ruches du lycée) ou des gourdes métalliques distribués à chacun des joueurs.</p>
                                </div>
                            </div>
                            
                            <!-- Petit déjeuner sportif -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-biking"></i>
                                    <span>Petit déjeuner sportif et atelier "Vélo smoothies"</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Ces animations ont pour but d'associer les deux axes traités dans la thématique « Santé », à savoir le sport et l'alimentation.</p>
                                    <p>Par exemple, un petit déjeuner sportif a été organisé par les éco-délégués pour une classe de seconde composée d'élèves en situation de handicap, à l'occasion de leur rencontre avec un athlète paralympique.</p>
                                    <p>Une animation « Vélo smoothies » est également proposé pendant la semaine écocitoyenne. Le but étant de pédaler sur un vélo équipé d'un mixeur de fruits (préalablement sélectionnés avec un producteur local). Cette animation est organisée en partenariat avec Saint-Louis Agglomération et l'Agence Locale de la Maîtrise de l'Energie (ALME). Une classe de 2nde professionnelle a participé à la sélection et la préparation des fruits.</p>
                                </div>
                            </div>
                            
                            <!-- Atelier nutrition et dégustation -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-apple-alt"></i>
                                    <span>Atelier nutrition et dégustation</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Cet atelier, mené par les CAP ATMFC, a pour but de proposer un petit déjeuner en présentant sa composition et ses bienfaits pour la santé.</p>
                                </div>
                            </div>
                            
                            <!-- Activités Saint-Louis Agglomération -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-city"></i>
                                    <span>Activités Saint-Louis Agglomération</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Saint-Louis Agglomération participent à la semaine écocitoyenne en proposant plusieurs activités :</p>
                                    <ul class="feature-list">
                                        <li>Atelier « sport et santé »</li>
                                        <li>Animation « Les mobilités actives »</li>
                                        <li>Animation « Zoom sur l'économie circulaire »</li>
                                        <li>Atelier « Connaissez-vous votre empreinte carbone ? »</li>
                                        <li>Atelier « Connaissez-vous le diagnostic climat de notre territoire ? »</li>
                                        <li>Projection du film « Face au changement »</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Animation "Pollen dans l'air" -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-wind"></i>
                                    <span>Animation « Pollen dans l'air : surveillance et impacts sur la santé »</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Animation proposée par l'ATMO pendant la semaine écocitoyenne afin de sensibiliser sur les impacts dus au pollen dans l'air et les moyens de prévention.</p>
                                </div>
                            </div>
                            
                            <!-- Visites -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <i class="fas fa-building"></i>
                                    <span>Visites</span>
                                    <i class="fas fa-chevron-down accordion-icon"></i>
                                </div>
                                <div class="accordion-content">
                                    <p>Des visites sont organisées :</p>
                                    <ul class="feature-list">
                                        <li>Des infrastructures locales en lien avec la gestion de l'énergie et des déchets (Déchetterie, Réseaux de Chaleurs Urbains de l'Est, Relais Est, Est Assainissement, centrale à bois EBM)</li>
                                        <li>De la Petite Camargue Alsacienne (réserve naturelle)</li>
                                        <li>De l'écohabitat de Saint-Louis (Ludologis, avec Face Alsace)</li>
                                        <li>De la station d'épuration avec Véolia</li>
                                        <li>Des puits de Saint-Louis</li>
                                    </ul>
                                </div>
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
                                <h4>Projet Éco-Mermoz</h4>
                                <p>Pour toute question concernant le projet :<br>
                                <a href="mailto:contact@marvindeconinck.fr">contact@marvindeconinck.fr</a></p>
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
        // Script pour l'accordéon
        document.addEventListener('DOMContentLoaded', function() {
            const accordionHeaders = document.querySelectorAll('.accordion-header');
            
            accordionHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const accordionItem = this.parentElement;
                    
                    // Toggle active class
                    accordionItem.classList.toggle('active');
                    
                    // Close other accordion items
                    const siblings = Array.from(accordionItem.parentElement.children).filter(item => item !== accordionItem);
                    siblings.forEach(sibling => {
                        sibling.classList.remove('active');
                    });
                });
            });
            
            // Open first accordion by default
            if (accordionHeaders.length > 0) {
                accordionHeaders[0].parentElement.classList.add('active');
            }
        });
    </script>
</body>
</html> 
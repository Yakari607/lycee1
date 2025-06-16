<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Professionnels - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body data-page="professionnels">
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
                <h1>Espace Professionnels</h1>
                <p>Partenaires de la réussite de nos élèves</p>
            </div>
        </section>

        <div class="container">
            <!-- Section Stages -->
            <section id="stages" class="section-content">
                <h2>Stages en entreprise</h2>
                <div class="content-grid">
                    <div class="text-content">
                        <p>Les stages en entreprise constituent un élément essentiel de la formation de nos élèves. Ils permettent la découverte du monde professionnel et l'application concrète des savoirs acquis en cours.</p>
                        
                        <h3>Types de stages</h3>
                        <ul class="stage-types">
                            <li><i class="fas fa-eye"></i> <strong>Stages d'observation</strong> : Pour les élèves de 3ème et seconde</li>
                            <li><i class="fas fa-tools"></i> <strong>Stages de formation</strong> : Pour les élèves de Bac Pro (22 semaines sur 3 ans)</li>
                            <li><i class="fas fa-graduation-cap"></i> <strong>Stages en BTS</strong> : 12 à 16 semaines selon les filières</li>
                        </ul>

                        <h3>Nos engagements</h3>
                        <ul class="commitments">
                            <li>Accompagnement personnalisé dans la recherche</li>
                            <li>Préparation des élèves avant le stage</li>
                            <li>Suivi régulier pendant le stage</li>
                            <li>Évaluation concertée avec l'entreprise</li>
                        </ul>
                    </div>
                    <div class="image-content">
                        <div class="info-card">
                            <h4>Contact Stages</h4>
                            <p><i class="fas fa-user"></i> Référent stages : M./Mme [Nom]</p>
                            <p><i class="fas fa-phone"></i> 03 89 70 74 00</p>
                            <p><i class="fas fa-envelope"></i> stages@lycee-mermoz.fr</p>
                            <a href="#contact" class="btn btn-primary">Proposer un stage</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section Alternance -->
            <section id="alternance" class="section-content">
                <h2>Alternance et Apprentissage</h2>
                <div class="alternance-info">
                    <div class="alt-item">
                        <div class="alt-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3>Contrat d'apprentissage</h3>
                        <p>Formation en alternance permettant d'obtenir un diplôme tout en travaillant en entreprise. Rythme généralement 2 semaines en entreprise / 2 semaines au lycée.</p>
                        <ul>
                            <li>CAP en apprentissage</li>
                            <li>Bac Pro en apprentissage</li>
                            <li>BTS en apprentissage</li>
                        </ul>
                    </div>
                    <div class="alt-item">
                        <div class="alt-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3>Contrat de professionnalisation</h3>
                        <p>Contrat de travail en alternance permettant l'acquisition d'une qualification professionnelle reconnue.</p>
                        <ul>
                            <li>Formation qualifiante</li>
                            <li>Rémunération progressive</li>
                            <li>Accompagnement personnalisé</li>
                        </ul>
                    </div>
                </div>

                <div class="alternance-benefits">
                    <h3>Avantages pour l'entreprise</h3>
                    <div class="benefits-grid">
                        <div class="benefit-item">
                            <i class="fas fa-users"></i>
                            <h4>Recrutement</h4>
                            <p>Former un futur collaborateur selon vos besoins</p>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-euro-sign"></i>
                            <h4>Aides financières</h4>
                            <p>Exonérations de charges et aides à l'embauche</p>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-lightbulb"></i>
                            <h4>Innovation</h4>
                            <p>Apport de nouvelles compétences et regard neuf</p>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-heart"></i>
                            <h4>Engagement social</h4>
                            <p>Participation à la formation des jeunes</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section Partenariats -->
            <section id="partenariats" class="section-content">
                <h2>Partenariats entreprises</h2>
                <div class="partnerships-content">
                    <div class="partnership-types">
                        <div class="partnership-item">
                            <h3><i class="fas fa-chalkboard-teacher"></i> Interventions pédagogiques</h3>
                            <p>Professionnels intervenant dans nos cours pour partager leur expertise et expérience terrain.</p>
                        </div>
                        <div class="partnership-item">
                            <h3><i class="fas fa-building"></i> Visites d'entreprises</h3>
                            <p>Découverte de vos installations et métiers par nos élèves dans le cadre de leur orientation.</p>
                        </div>
                        <div class="partnership-item">
                            <h3><i class="fas fa-trophy"></i> Projets collaboratifs</h3>
                            <p>Projets étudiants répondant à vos problématiques réelles d'entreprise.</p>
                        </div>
                        <div class="partnership-item">
                            <h3><i class="fas fa-gift"></i> Équipements et dons</h3>
                            <p>Dons de matériels, équipements ou logiciels pour enrichir nos plateaux techniques.</p>
                        </div>
                    </div>
                </div>

                <div class="existing-partners">
                    <h3>Nos partenaires actuels</h3>
                    <p>Nous travaillons déjà avec de nombreuses entreprises locales et nationales dans tous les secteurs d'activité.</p>
                    <div class="sectors">
                        <span class="sector-tag">Industrie</span>
                        <span class="sector-tag">Services</span>
                        <span class="sector-tag">Commerce</span>
                        <span class="sector-tag">Artisanat</span>
                        <span class="sector-tag">BTP</span>
                        <span class="sector-tag">Santé</span>
                        <span class="sector-tag">Informatique</span>
                        <span class="sector-tag">Hôtellerie</span>
                    </div>
                </div>
            </section>

            <!-- Section Contact -->
            <section id="contact" class="contact-section">
                <h2>Devenir partenaire</h2>
                <div class="contact-grid">
                    <div class="contact-info">
                        <h3>Vos contacts privilégiés</h3>
                        <div class="contact-item">
                            <i class="fas fa-user-tie"></i>
                            <div>
                                <strong>Relations entreprises</strong>
                                <p>M./Mme [Nom]<br>
                                Référent relations entreprises</p>
                                <p><i class="fas fa-phone"></i> 03 89 70 74 00</p>
                                <p><i class="fas fa-envelope"></i> entreprises@lycee-mermoz.fr</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-graduation-cap"></i>
                            <div>
                                <strong>Centre de Formation d'Apprentis (UFA)</strong>
                                <p>M./Mme [Nom]<br>
                                Coordonnateur apprentissage</p>
                                <p><i class="fas fa-phone"></i> 03 89 70 74 00</p>
                                <p><i class="fas fa-envelope"></i> ufa@lycee-mermoz.fr</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form">
                        <h3>Nous contacter</h3>
                        <form>
                            <div class="form-group">
                                <label for="entreprise">Nom de l'entreprise *</label>
                                <input type="text" id="entreprise" name="entreprise" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Nom du contact *</label>
                                <input type="text" id="contact" name="contact" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="secteur">Secteur d'activité</label>
                                <input type="text" id="secteur" name="secteur">
                            </div>
                            <div class="form-group">
                                <label for="demande">Type de demande</label>
                                <select id="demande" name="demande">
                                    <option value="">Sélectionnez...</option>
                                    <option value="stage">Proposer un stage</option>
                                    <option value="alternance">Alternance/Apprentissage</option>
                                    <option value="partenariat">Partenariat pédagogique</option>
                                    <option value="visite">Visite d'entreprise</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
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

        .stage-types, .commitments {
            list-style: none;
            padding: 0;
        }

        .stage-types li, .commitments li {
            display: flex;
            align-items: flex-start;
            margin: 1rem 0;
            padding: 0.5rem;
        }

        .stage-types i, .commitments i {
            color: var(--primary-color);
            margin-right: 1rem;
            margin-top: 0.25rem;
            width: 20px;
        }

        .info-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .alternance-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .alt-item {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .alt-icon {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .alt-icon i {
            font-size: 2.5rem;
            color: var(--primary-color);
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .benefit-item {
            text-align: center;
            padding: 1.5rem;
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .benefit-item i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .partnership-types {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .partnership-item {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .partnership-item h3 i {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }

        .sectors {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .sector-tag {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .contact-section {
            background: var(--gray-light);
            padding: 3rem;
            border-radius: 10px;
            margin: 3rem 0;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-top: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin: 2rem 0;
        }

        .contact-item i {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-top: 0.25rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background: var(--primary-dark);
        }

        @media (max-width: 768px) {
            .content-grid,
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .alternance-info,
            .partnership-types,
            .benefits-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }
    </style>
</body>
</html> 
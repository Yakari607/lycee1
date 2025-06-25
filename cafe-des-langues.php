<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café des langues - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/vie-lyceenne.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Styles spécifiques à la page Café des langues */
        .cafe-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .cafe-intro {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        .cafe-intro h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }
        
        .cafe-intro p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .cafe-section {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        .cafe-section h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }
        
        .cafe-section h3 i {
            margin-right: 0.75rem;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .info-card {
            background-color: var(--gray-light);
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }
        
        .info-card h4 {
            color: var(--primary-color);
            margin-bottom: 0.75rem;
            font-size: 1.2rem;
        }
        
        .info-card p {
            margin-bottom: 0.5rem;
        }
        
        .info-card ul {
            padding-left: 1.5rem;
            margin-top: 0.5rem;
        }
        
        .info-card li {
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
            color: white;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .highlight-box p {
            font-size: 1.2rem;
            margin-bottom: 0;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .feature-item {
            background-color: var(--gray-light);
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        
        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        
        .feature-item i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .feature-item h4 {
            font-size: 1.2rem;
            margin-bottom: 0.75rem;
            color: var(--primary-color);
        }
        
        .feature-item p {
            font-size: 1rem;
            line-height: 1.5;
        }
        
        .rule-box {
            background: linear-gradient(135deg, #e1000f 0%, #c00000 100%);
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin: 2rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .rule-box h3 {
            color: white;
            margin-bottom: 1rem;
            font-size: 1.8rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .rule-box p {
            font-size: 1.4rem;
            margin-bottom: 0;
            font-weight: 600;
        }
        
        .rule-box::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .rule-box::after {
            content: '';
            position: absolute;
            bottom: -30px;
            right: -30px;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
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
        
        .quote-box {
            font-style: italic;
            padding: 1.5rem;
            background-color: var(--gray-light);
            border-left: 4px solid var(--primary-color);
            margin: 2rem 0;
            position: relative;
        }
        
        .quote-box::before {
            content: '\201C';
            font-size: 4rem;
            position: absolute;
            top: -10px;
            left: 10px;
            color: var(--primary-color);
            opacity: 0.2;
            font-family: Georgia, serif;
        }
        
        .quote-box p {
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }
        
        @media (max-width: 768px) {
            .cafe-content {
                padding: 1rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .rule-box h3 {
                font-size: 1.5rem;
            }
            
            .rule-box p {
                font-size: 1.2rem;
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

        <section class="vie-lyceenne-hero" style="background: url('images/activites/cafe-bienfaits-inconvenients-6.jpg'); background-size: cover; background-position: center;">
            <div class="hero-content">
                <h1>Café des langues</h1>
                <p>Un espace convivial pour pratiquer les langues étrangères</p>
            </div>
        </section>

        <div class="cafe-content">
            <section class="cafe-intro">
                <h2>Café des langues</h2>
                <p>Un lieu pour vous, pour se détendre et discuter dans une ambiance conviviale tout en buvant un café, un thé ou un chocolat chaud. Le Café des langues est un espace d'échange multiculturel qui vous permet de pratiquer vos compétences linguistiques dans un cadre détendu et chaleureux.</p>
            </section>

            <div class="rule-box">
                <h3>La règle d'or</h3>
                <p>NE PAS PARLER FRANÇAIS !</p>
            </div>

            <section class="cafe-section">
                <h3><i class="fas fa-star"></i> Les plus du Café des langues</h3>
                
                <div class="features-grid">
                    <div class="feature-item">
                        <i class="fas fa-coffee"></i>
                        <h4>Boissons chaudes</h4>
                        <p>Des boissons chaudes CHAUDES ! Café, thé, chocolat chaud...</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-comments"></i>
                        <h4>Debating Society</h4>
                        <p>Animée par des enseignements et des assisants de Langues</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-book"></i>
                        <h4>Ressources</h4>
                        <p>Des magazines, des jeux et Harry Potter en hongrois</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-film"></i>
                        <h4>Invités spéciaux</h4>
                        <p>Brad Pitt et Angelina Jolie (invitation en cours…)</p>
                    </div>
                </div>
            </section>

            <section class="cafe-section">
                <h3><i class="fas fa-info-circle"></i> Informations pratiques</h3>
                
                <div class="info-grid">
                    <div class="info-card">
                        <h4>Pour qui ?</h4>
                        <p>Pour tous les élèves et personnels du lycée !</p>
                    </div>
                    <div class="info-card">
                        <h4>Où ?</h4>
                        <p>Salle C002, à côté de la vie scolaire</p>
                    </div>
                </div>
                
                <h4 style="margin-top: 2rem;">Horaires</h4>
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Jour</th>
                            <th>Horaires</th>
                            <th>Activité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lundi</td>
                            <td>12h00 - 13h30</td>
                            <td>Café des langues</td>
                        </tr>
                        <tr>
                            <td>Mercredi</td>
                            <td>12h00 - 13h30</td>
                            <td>Debating Society</td>
                        </tr>
                        <tr>
                            <td>Jeudi</td>
                            <td>12h00 - 13h30</td>
                            <td>Café des langues</td>
                        </tr>
                        <tr>
                            <td>Vendredi</td>
                            <td>12h00 - 13h30</td>
                            <td>Café des langues</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <div class="quote-box">
                <p>"A consommer sans modération !"</p>
            </div>

            <div class="highlight-box" style="background: linear-gradient(135deg, #28a745 0%, #218838 100%);">
                <h3>Un élan pour l'avenir</h3>
                <p>Venez pratiquer les langues dans une ambiance conviviale et internationale</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
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
    <?php
    // Connexion à la base de données pour les plaquettes
    require_once 'includes/db_connect.php';
    
    // Inclure et afficher les plaquettes pour cette page
    include 'includes/plaquettes.php';
    display_plaquettes();
    ?>

</body>
</html>

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
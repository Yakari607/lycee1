<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre d'Information et d'Orientation - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .cio-section {
            padding: 3rem 0;
        }
        
        .cio-content {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .cio-links {
            margin-top: 2rem;
            padding: 1.5rem;
            background-color: #f5f5f5;
            border-radius: 8px;
        }
        
        .cio-links h3 {
            margin-top: 0;
            color: #000091;
        }
        
        .cio-links ul {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0 0;
        }
        
        .cio-links li {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
            position: relative;
        }
        
        .cio-links li:before {
            content: "\f35d";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 0.2rem;
            color: #000091;
        }
        
        .cio-links a {
            color: #000091;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .cio-links a:hover {
            color: #3f51b5;
            text-decoration: underline;
        }
        
        .cio-address {
            margin-top: 2rem;
            padding: 1.5rem;
            background-color: #e8eaf6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .cio-address i {
            font-size: 2rem;
            color: #000091;
        }
        
        .cio-address p {
            margin: 0;
            font-size: 1.1rem;
        }
        
        .cio-address strong {
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 4rem 1rem;
        }
        
        .formation-hero {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/formations/pexels-pixabay-159740.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            position: relative;
            margin-bottom: 2rem;
        }
        
        @media (max-width: 768px) {
            .cio-address {
                flex-direction: column;
                text-align: center;
                gap: 0.75rem;
            }
        }
    </style>
</head>
<body data-page="cio">
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
                <h1>Centre d'Information et d'Orientation</h1>
                <p>Informations, conseils et accompagnement pour votre orientation</p>
            </div>
        </section>

        <section class="cio-section">
            <div class="container">
                <div class="cio-content">
                    <h2>Le rôle du CIO</h2>
                    
                    <p>Le CIO, centre d'information et d'orientation, est un lieu d'accueil, d'écoute et de conseil. Service public de l'Education nationale, il est gratuit et ouvert à tous les publics en quête d'informations et de conseils pour le choix d'une formation ou d'une profession.</p>
                    
                    <p>Les conseillers d'orientation-psychologues vous y proposent des entretiens personnalisés pour faire le point sur vos intérêts, vos atouts, les formations et métiers qui pourraient vous convenir.</p>
                    
                    <div class="cio-address">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <p><strong>Adresse du CIO le plus proche :</strong>
                            4 rue Jean Mermoz à Saint-Louis</p>
                        </div>
                    </div>
                    
                    <div class="cio-links">
                        <h3>Quelques liens importants pour l'orientation</h3>
                        <ul>
                            <li><a href="http://www.secondes2018-2019.fr/" target="_blank" rel="noopener noreferrer">Orientation 2nde</a></li>
                            <li><a href="http://www.terminales2018-2019.fr/" target="_blank" rel="noopener noreferrer">Orientation Terminale</a></li>
                            <li><a href="https://www.parcoursup.fr/" target="_blank" rel="noopener noreferrer">Portail Parcours Sup</a></li>
                            <li><a href="http://www.horizons2021.fr/" target="_blank" rel="noopener noreferrer">Bac 2021</a></li>
                        </ul>
                    </div>
                    
                    <div style="margin-top: 2rem; text-align: center;">
                        <a href="orientation-bac.php" class="cta-button">Découvrir nos conseils d'orientation</a>
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

    <!-- Scripts -->
    <script src="js/script.js"></script>
</body>
</html> 
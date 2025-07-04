<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le mot de la Proviseure - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .proviseur-section {
            padding: 3rem 0;
        }
        
        .proviseur-content {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .proviseur-quote {
            font-style: italic;
            color: #555;
            border-left: 4px solid #0056b3;
            padding-left: 1rem;
            margin: 1.5rem 0;
        }
        
        .proviseur-signature {
            text-align: right;
            margin-top: 2rem;
        }
        
        .proviseur-signature p {
            margin: 0.3rem 0;
        }
        
        .proviseur-signature .title {
            font-weight: bold;
        }
        
        .proviseur-signature .motto {
            font-style: italic;
            color: #555;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 4rem 1rem;
        }
        
        .formation-hero {
            background-image: url('images/batiments/c-est-la-rentree-ce-lundi-au-lycee-jean-mermoz-de-saint-louis-avec-une-17e-classe-de-seconde-qui-vient-s-ajouter-a-des-effectifs-consequents-qui-font-du-lycee-ludovicien-le-plus-grand-d-alsace-photo-l-alsace-1567245623.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            position: relative;
            margin-bottom: 2rem;
            filter: brightness(1.2);
        }
    </style>
</head>
<body data-page="mot-proviseur">
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
                <h1>L'Établissement</h1>
                <p>Le mot de la Proviseure</p>
            </div>
        </section>

        <section class="proviseur-section">
            <div class="container">
                <div class="proviseur-content">
                    <p>Le lycée polyvalent Jean Mermoz, fort de son dynamisme, est un lieu de formation, un lieu d'apprentissage et un lieu privilégié d'échanges, parfaitement ancré dans la cité, au sein de ce territoire transfrontalier.</p>
                    
                    <p>Il est ce lieu VIVANT où l'Instruction citoyenne et l'ouverture au monde permettent l'épanouissement de chacune et chacun : chaque élève et chaque personnel trouve en son sein, sa place pleine et entière, dans le respect absolu les unes et les autres.</p>
                    
                    <p>Ce grand lycée foisonne de multiples projets qui mettent les jeunes sur un parcours de vie, de découverte et, gageons-le, de réussite.</p>
                    
                    <p>C'est autour des élèves, des apprenties et des étudiantes qui nous sont confiées, que se concentrent notre attention et notre bienveillance, et c'est bien au service de leur réussite que nous œuvrons.</p>
                    
                    <p>La satisfaction de la transmission du savoir pour les unes, la joie d'apprendre et de grandir pour les autres.</p>
                    
                    <div class="proviseur-quote">
                        <p>« On ne peut vivre mieux qu'en cherchant à devenir meilleur, ni plus agréablement qu'en ayant pleine conscience de son amélioration »</p>
                        <p>- Socrate</p>
                    </div>
                    
                    <div class="proviseur-signature">
                        <p class="title">La Proviseure</p>
                        <p class="motto">Une élane pour l'avenir</p>
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
                    <a href="mentions-legales.php">Mentions légales</a>
                    <a href="accessibilite.php">Accessibilité</a>
                    <a href="#">Plan du site</a>
                    <a href="admin/login.php">Administration</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/script.js"></script>
</body>
</html> 
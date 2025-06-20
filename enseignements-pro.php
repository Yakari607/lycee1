<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enseignements Professionnels - Lycée Jean-Mermoz</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/pages/formation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

        <section class="formation-hero" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/formations/pexels-thisisengineering-3913025.jpg');">
            <div class="hero-content">
                <h1>Enseignements Professionnels</h1>
                <p>Découvrez nos formations qualifiantes adaptées au monde du travail dans divers secteurs</p>
            </div>
        </section>

        <section class="formation-section">
            <div class="container">
                <div class="formation-block">
                    <h3><i class="fas fa-graduation-cap"></i> Nos filières professionnelles</h3>
                    <p>Le lycée Jean-Mermoz propose une large gamme de formations professionnelles pour préparer nos élèves aux métiers d'aujourd'hui et de demain</p>
                </div>

                <!-- Métiers de l'Industrie -->
                <div class="formation-block">
                    <h3><i class="fas fa-industry"></i> Métiers de l'Industrie</h3>
                    <div class="parcours-grid">
                        <div class="formation-card">
                            <i class="fas fa-tools"></i>
                            <h4>Bac Pro MSPC</h4>
                            <p>Maintenance des Systèmes de Production Connectés : formation aux techniques de maintenance industrielle et d'intervention sur les équipements automatisés.</p>
                            <a href="bac-pro-mspc.php" class="cta-button">Découvrir</a>
                        </div>
                        
                        <div class="formation-card">
                            <i class="fas fa-industry"></i>
                            <h4>Bac Pro TRPM</h4>
                            <p>Technicien en Réalisation de Produits Mécaniques : formation à la fabrication de pièces mécaniques par usinage sur machines à commande numérique.</p>
                            <a href="bac-pro-trpm.php" class="cta-button">Découvrir</a>
                        </div>
                        
                        <div class="formation-card">
                            <i class="fas fa-bolt"></i>
                            <h4>Bac Pro MELEC</h4>
                            <p>Métiers de l'Électricité et de ses Environnements Connectés : formation aux installations électriques et systèmes communicants du bâtiment et de l'industrie.</p>
                            <a href="bac-pro-melec.php" class="cta-button">Découvrir</a>
                        </div>
                        
                        <div class="formation-card">
                            <i class="fas fa-plug"></i>
                            <h4>CAP Electricien</h4>
                            <p>Formation aux métiers d'installateur électricien dans les domaines de l'habitat, du tertiaire et de l'industrie.</p>
                            <a href="cap-electricien.php" class="cta-button">Découvrir</a>
                        </div>
                    </div>
                </div>

                <!-- Métiers du Tertiaire -->
                <div class="formation-block">
                    <h3><i class="fas fa-store"></i> Métiers du Tertiaire</h3>
                    <div class="parcours-grid">
                        <div class="formation-card">
                            <i class="fas fa-clipboard-list"></i>
                            <h4>BAC PRO AGOrA</h4>
                            <p>Assistance à la Gestion des Organisations et de leurs Activités : formation aux métiers administratifs et de gestion.</p>
                            <a href="bac-pro-agora.php" class="cta-button">Découvrir</a>
                        </div>
                        
                        <div class="formation-card">
                            <i class="fas fa-user-tie"></i>
                            <h4>Bac Pro Métiers de l'Accueil</h4>
                            <p>Formation aux métiers de l'accueil physique et téléphonique, de la relation client et de la gestion de l'information.</p>
                            <a href="metiers-accueil.php" class="cta-button">Découvrir</a>
                        </div>
                        
                        <div class="formation-card">
                            <i class="fas fa-shopping-cart"></i>
                            <h4>Bac Pro Métiers du Commerce et de la Vente</h4>
                            <p>Formation aux techniques de vente, de gestion commerciale et d'animation de point de vente.</p>
                            <a href="metiers-commerce-vente.php" class="cta-button">Découvrir</a>
                        </div>
                        
                        <div class="formation-card">
                            <i class="fas fa-store-alt"></i>
                            <h4>CAP Équipier Polyvalent du Commerce</h4>
                            <p>Formation aux métiers de la vente et de la gestion des produits en magasin.</p>
                            <a href="cap-epc.php" class="cta-button">Découvrir</a>
                        </div>
                    </div>
                </div>

                <!-- Artisanat -->
                <div class="formation-block">
                    <h3><i class="fas fa-paint-brush"></i> Métiers de l'Enseigne et de la Signalétique</h3>
                    <div class="parcours-grid">
                        <div class="formation-card">
                            <i class="fas fa-paint-brush"></i>
                            <h4>BAC PRO Métiers de l'enseigne et de la signalétique</h4>
                            <p>Formation aux techniques de conception, fabrication et installation d'enseignes et de supports de communication visuelle.</p>
                            <a href="bac-pro-metiers-enseigne.php" class="cta-button">Découvrir</a>
                        </div>
                        
                        <div class="formation-card">
                            <i class="fas fa-sign"></i>
                            <h4>CAP Métiers de l'Enseigne et de la Signalétique</h4>
                            <p>Formation aux techniques de base de fabrication et d'installation d'enseignes lumineuses et non lumineuses.</p>
                            <a href="cap-metiers-enseigne.php" class="cta-button">Découvrir</a>
                        </div>
                    </div>
                </div>

                <!-- Services aux Personnes -->
                <div class="formation-block">
                    <h3><i class="fas fa-hand-holding-heart"></i> Services aux Personnes</h3>
                    <div class="parcours-grid">
                        <div class="formation-card">
                            <i class="fas fa-hand-holding-heart"></i>
                            <h4>CAP Agent Accompagnant au Grand Âge</h4>
                            <p>Formation aux métiers de l'accompagnement et du soin aux personnes âgées en situation de dépendance.</p>
                            <a href="cap-aaga.php" class="cta-button">Découvrir</a>
                        </div>
                        
                        <div class="formation-card">
                            <i class="fas fa-users"></i>
                            <h4>Bac Pro Animation-Enfance et Personnes Âgées</h4>
                            <p>Formation aux métiers de l'animation sociale et socio-éducative auprès d'enfants et de personnes âgées.</p>
                            <a href="bac-pro-aepa.php" class="cta-button">Découvrir</a>
                        </div>
                        
                        <div class="formation-card">
                            <i class="fas fa-utensils"></i>
                            <h4>CAP Production et Service en Restaurations</h4>
                            <p>Formation aux métiers de la production culinaire et du service en restauration collective et commerciale.</p>
                            <a href="cap-psr.php" class="cta-button">Découvrir</a>
                        </div>
                    </div>
                </div>
                
                <!-- Apprentissage -->
                <div class="formation-block">
                    <h3><i class="fas fa-university"></i> Unité de Formation par Apprentissage (UFA)</h3>
                    <p>Notre UFA propose des formations en alternance pour préparer votre avenir professionnel. Découvrez les avantages de l'apprentissage : formation rémunérée, expérience professionnelle et accompagnement personnalisé.</p>
                    <div class="text-center" style="margin-top: 1.5rem; text-align: center;">
                        <a href="ufa.php" class="cta-button">Découvrir l'UFA</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <button class="theme-toggle" aria-label="Basculer le mode sombre">
        <i class="fas fa-moon"></i>
    </button>

    <script src="js/script.js"></script>
</body>
</html> 
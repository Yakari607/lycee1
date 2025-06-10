<?php
/**
 * Footer component for Lycée Jean-Mermoz website
 * Include this file in all pages that need the footer
 */

// Déterminer si nous sommes dans un sous-dossier (si pas déjà défini)
if (!isset($base_path)) {
    $base_path = '';
    if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
        $base_path = '../';
    }
}

// Connexion à la base de données si pas déjà faite
if (!isset($db)) {
    require_once __DIR__ . '/db_connect.php';
}

// Récupérer les plaquettes pour cette page
include_once __DIR__ . '/plaquettes.php';
$page_name = basename($_SERVER['PHP_SELF']);
$plaquettes = get_plaquettes_for_page($page_name);
?>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contact</h3>
                <div class="contact-info">
                    <h4>Lycée Jean-Mermoz</h4>
                    <p>53 rue du Docteur Hurst</p>
                    <p>68301 Saint-Louis Cedex</p>
                    <p><i class="fas fa-phone"></i> +33 389 70 22 70</p>
                    <p><i class="fas fa-envelope"></i> ce.0680066c@ac-strasbourg.fr</p>
                </div>
            </div>

            <div class="footer-section">
                <h3>Voie Scolaire</h3>
                <div class="contact-info">
                    <p><strong>Directeur Délégué aux Formations Professionnelles et Technologiques</strong></p>
                    <p><a href="mailto:ddfp.industiel@lyceemermoz.fr">ddfp.industiel@lyceemermoz.fr</a></p>
                    
                    <p><strong>Coordonnatrice Bac Pro MEI</strong></p>
                    <p>Abdelali Kanouni</p>
                    <p><a href="mailto:abdelali.kanouni@ac-strasbourg.fr">abdelali.kanouni@ac-strasbourg.fr</a></p>
                </div>
            </div>

            <div class="footer-section">
                <h3>Apprentissage</h3>
                <div class="contact-info">
                    <p><strong>Directeur Délégué à l'UFA</strong></p>
                    <p><a href="mailto:ddufa@lyceemermoz.fr">ddufa@lyceemermoz.fr</a></p>
                    
                    <p><strong>Chargée de Développement de l'Apprentissage</strong></p>
                    <p>Victoria Viegas</p>
                    <p><a href="mailto:victoria.viegas@cfa-academique.fr">victoria.viegas@cfa-academique.fr</a></p>
                </div>
            </div>
        </div>

        <?php if (!empty($plaquettes)): ?>
        <!-- Section plaquettes dans le footer -->
        <div class="footer-plaquettes">
            <h3>Téléchargements</h3>
            <div class="footer-plaquettes-grid">
                <?php foreach ($plaquettes as $plaquette): ?>
                    <?php 
                    $background_color = htmlspecialchars($plaquette['couleur_fond']);
                    $titre = htmlspecialchars($plaquette['titre']);
                    $description = htmlspecialchars($plaquette['description'] ?? '');
                    $pdf_path = htmlspecialchars($plaquette['fichier_pdf']);
                    ?>
                    
                    <div class="footer-plaquette" style="background-color: <?= $background_color ?>;">
                        <div class="plaquette-info">
                            <h4><?= $titre ?></h4>
                            <?php if ($description): ?>
                                <p><?= $description ?></p>
                            <?php endif; ?>
                        </div>
                        <a href="<?= $pdf_path ?>" class="btn-download-footer" target="_blank" rel="noopener" aria-label="Télécharger <?= $titre ?>">
                            <i class="fas fa-download"></i>
                            <span>Télécharger</span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="footer-bottom">
            <div class="footer-info">
                <img src="images/logos/LOGO-UFA-MERMOZ-1.jpg" alt="Logo UFA Jean-Mermoz" class="footer-logo">
                <p>&copy; 2024 Lycée Jean-Mermoz - Saint-Louis</p>
                <p>Un élan pour l'avenir</p>
            </div>
            <div class="footer-links">
                <a href="#contact">Mentions légales</a>
                <a href="#contact">Accessibilité</a>
                <a href="#contact">Plan du site</a>
                <a href="admin/login.php">Administration</a>
            </div>
            <div class="footer-rights">
                <p>All rights reserved</p>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        color: white;
        padding: 3rem 0 1rem;
        margin-top: 4rem;
    }
    
    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .footer-section h3 {
        color: #ecf0f1;
        margin-bottom: 1rem;
        font-size: 1.25rem;
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        padding-bottom: 0.5rem;
    }
    
    .contact-info p {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }
    
    .contact-info a {
        color: #3498db;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .contact-info a:hover {
        color: #5dade2;
        text-decoration: underline;
    }
    
    .footer-plaquettes {
        margin: 2rem 0;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .footer-plaquettes h3 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #ecf0f1;
    }
    
    .footer-plaquettes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1rem;
    }
    
    .footer-plaquette {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        border-radius: 8px;
        background-color: var(--plaquette-color, #3498db);
        color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    
    .plaquette-info h4 {
        margin: 0 0 0.25rem 0;
        font-size: 1rem;
        font-weight: 600;
    }
    
    .plaquette-info p {
        margin: 0;
        font-size: 0.875rem;
        opacity: 0.9;
    }
    
    .btn-download-footer {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.75rem;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        min-width: 100px;
    }
    
    .btn-download-footer:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }
    
    .btn-download-footer i {
        font-size: 1.25rem;
    }
    
    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .footer-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .footer-logo {
        height: 50px;
        width: auto;
        border-radius: 4px;
    }
    
    .footer-links {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    
    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }
    
    .footer-links a:hover {
        color: white;
        text-decoration: underline;
    }
    
    .footer-rights {
        font-size: 0.875rem;
        opacity: 0.7;
    }
    
    /* Mode sombre */
    [data-theme="dark"] .footer {
        background: linear-gradient(135deg, #1a1a1a 0%, #2c3e50 100%);
    }
    
    [data-theme="dark"] .footer-plaquette {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .footer {
            padding: 2rem 0 1rem;
        }
        
        .footer-content {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .footer-plaquettes-grid {
            grid-template-columns: 1fr;
        }
        
        .footer-plaquette {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
        
        .footer-bottom {
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
        }
        
        .footer-info {
            justify-content: center;
        }
        
        .footer-links {
            justify-content: center;
        }
    }
    
    @media (max-width: 480px) {
        .footer-links {
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
        }
        
        .btn-download-footer {
            width: 100%;
            max-width: 200px;
        }
    }
</style>

<button class="theme-toggle" aria-label="Basculer le mode sombre">
    <i class="fas fa-moon"></i>
</button> 
</body>
</html> 
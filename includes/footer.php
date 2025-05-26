<?php
/**
 * Footer component for Lycée Jean Mermoz website
 * Include this file in all pages that need the footer
 */

// Déterminer si nous sommes dans un sous-dossier (si pas déjà défini)
if (!isset($base_path)) {
    $base_path = '';
    if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
        $base_path = '../';
    }
}
?>
<!-- Footer -->
<footer class="footer bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; <?php echo date('Y'); ?> Lycée Jean Mermoz</p>
                <p>Tous droits réservés.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p>
                    <a href="https://www.education.gouv.fr/" target="_blank" class="text-white">Ministère de l'Éducation Nationale</a> | 
                    <a href="https://www.ac-strasbourg.fr/" target="_blank" class="text-white">Académie de Strasbourg</a>
                </p>
                <p>
                    <small>
                        <a href="<?php echo $base_path; ?>mentions-legales.php" class="text-white-50">Mentions légales</a> | 
                        <a href="<?php echo $base_path; ?>politique-confidentialite.php" class="text-white-50">Politique de confidentialité</a> | 
                        <a href="<?php echo $base_path; ?>admin/login.php" class="text-white-50">Accès</a>
                    </small>
                </p>
            </div>
        </div>
    </div>
</footer>

<button class="theme-toggle" aria-label="Basculer le mode sombre">
    <i class="fas fa-moon"></i>
</button> 
</body>
</html> 
<?php
/**
 * Scripts component for Lycée Jean-Mermoz website
 * Contains common JavaScript includes
 * 
 * Usage: 
 * <?php 
 *   $pageSpecificJS = "js/page-specific/your-page.js"; // Optional
 *   include 'includes/scripts.php'; 
 * ?>
 */

// Déterminer si nous sommes dans un sous-dossier (si pas déjà défini)
if (!isset($base_path)) {
    $base_path = '';
    if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
        $base_path = '../';
    }
}
?>
<!-- Common scripts -->
<script src="<?php echo $base_path; ?>js/script.js"></script>

<!-- Page specific scripts if provided -->
<?php if (isset($pageSpecificJS) && !empty($pageSpecificJS)): ?>
<script src="<?php echo $base_path . $pageSpecificJS; ?>"></script>
<?php endif; ?> 
<?php
/**
 * Scripts component for Lycée Jean Mermoz website
 * Contains common JavaScript includes
 * 
 * Usage: 
 * <?php 
 *   $pageSpecificJS = "js/page-specific/your-page.js"; // Optional
 *   include 'includes/scripts.php'; 
 * ?>
 */
?>
<!-- Common scripts -->
<script src="js/script.js"></script>

<!-- Page specific scripts if provided -->
<?php if (isset($pageSpecificJS) && !empty($pageSpecificJS)): ?>
<script src="<?php echo $pageSpecificJS; ?>"></script>
<?php endif; ?> 
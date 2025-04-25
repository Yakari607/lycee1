<?php
/**
 * Header component for Lycée Jean Mermoz website
 * Contains common meta tags and CSS links
 * 
 * Usage: 
 * <?php 
 *   $pageTitle = "Your Page Title"; 
 *   $pageSpecificCSS = "css/pages/your-page.css"; // Optional
 *   include 'includes/header.php'; 
 * ?>
 */

// Set default title if not provided
if (!isset($pageTitle)) {
    $pageTitle = "Lycée Jean Mermoz - Saint-Louis";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site officiel du Lycée Jean Mermoz à Saint-Louis, Alsace. Formation professionnelle, technologique et générale.">
    <title><?php echo $pageTitle; ?> - Lycée Jean Mermoz</title>
    
    <!-- Common CSS -->
    <link rel="stylesheet" href="css/main.css">
    
    <!-- Page specific CSS if provided -->
    <?php if (isset($pageSpecificCSS) && !empty($pageSpecificCSS)): ?>
    <link rel="stylesheet" href="<?php echo $pageSpecificCSS; ?>">
    <?php endif; ?>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
</head>
</body>
</html> 
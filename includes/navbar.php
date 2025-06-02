<?php
/**
 * Navigation bar component for Lycée Jean Mermoz website
 * Include this file in all pages that need the main navigation
 */

// Déterminer si nous sommes dans un sous-dossier
$base_path = '';
if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) {
    $base_path = '../';
}
?> <!-- En-tête -->
<nav class="main-nav">
    <div class="nav-container">
        <div class="logo">
            <img src="<?php echo $base_path; ?>images/logos/Logo_de_la_République_française_(1999).svg.png" alt="Logo République Française" class="logo-rf">
            <img src="<?php echo $base_path; ?>images/logos/LOGO-UFA-MERMOZ-1.jpg" alt="Logo UFA Jean-Mermoz" class="logo-ufa">
            <div class="logo-text">
                <h1>Lycée Jean-Mermoz</h1>
                <span class="slogan">Excellence et Innovation</span>
            </div>
        </div>
        <div class="nav-content">
            <ul class="nav-links">
                <li><a href="<?php echo $base_path; ?>index.php">Accueil</a></li>
                <li class="dropdown">
                    <a href="#" onclick="return false;">L'établissement</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $base_path; ?>index.php#contact">Présentation</a></li>
                        <li><a href="<?php echo $base_path; ?>index.php#contact">L'équipe</a></li>
                        <li><a href="<?php echo $base_path; ?>index.php#vie-lyceenne">Nos infrastructures</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="<?php echo $base_path; ?>index.php#formations">Nos formations</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $base_path; ?>index.php#general">Enseignement général & technologique</a></li>
                        <li><a href="<?php echo $base_path; ?>index.php#industrie">Enseignement Professionnel</a></li>
                        <li><a href="<?php echo $base_path; ?>index.php#industrie">Enseignement supérieur</a></li>
                        <li><a href="<?php echo $base_path; ?>index.php#industrie">Apprentissage</a></li>
                        <li><a href="<?php echo $base_path; ?>orientation-bac.php">Orientation</a></li>
                        <li><a href="<?php echo $base_path; ?>ufa.php">UFA - Apprentissage</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" onclick="return false;">Espace pour les professionnels</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $base_path; ?>index.php#contact">Stages</a></li>
                        <li><a href="<?php echo $base_path; ?>index.php#contact">Alternance</a></li>
                        <li><a href="<?php echo $base_path; ?>index.php#contact">Partenariats</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo $base_path; ?>index.php#actualites">Actualités</a></li>
                <li><a href="<?php echo $base_path; ?>index.php#ufa">UFA</a></li>
                <li><a href="<?php echo $base_path; ?>index.php#contact">Contact</a></li>
                <li><a href="<?php echo $base_path; ?>vie-lyceenne.php">Vie Lycéenne</a></li>
                <li><a href="<?php echo $base_path; ?>cdi.php">CDI</a></li>
                <li><a href="<?php echo $base_path; ?>eco-mermoz.php">Éco-Mermoz</a></li>
            </ul>
            <button class="menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav>
<div class="menu-overlay"></div> 
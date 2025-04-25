<?php
/**
 * Navigation bar component for Lycée Jean Mermoz website
 * Include this file in all pages that need the main navigation
 */
?>
<!-- En-tête -->
<nav class="main-nav">
    <div class="nav-container">
        <div class="logo">
            <img src="images/logos/Logo_de_la_République_française_(1999).svg.png" alt="Logo République Française" class="logo-rf">
            <img src="images/logos/LOGO-UFA-MERMOZ-1.jpg" alt="Logo UFA Jean-Mermoz" class="logo-ufa">
            <div class="logo-text">
                <h1>Lycée Jean-Mermoz</h1>
                <span class="slogan">Excellence et Innovation</span>
            </div>
        </div>
        <div class="nav-content">
            <ul class="nav-links">
                <li><a href="index.php">Accueil</a></li>
                <li class="dropdown">
                    <a href="#" onclick="return false;">L'établissement</a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php#contact">Présentation</a></li>
                        <li><a href="index.php#contact">L'équipe</a></li>
                        <li><a href="index.php#vie-lyceenne">Nos infrastructures</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="index.php#formations">Nos formations</a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php#general">Enseignement général & technologique</a></li>
                        <li><a href="index.php#industrie">Enseignement Professionnel</a></li>
                        <li><a href="index.php#industrie">Enseignement supérieur</a></li>
                        <li><a href="index.php#industrie">Apprentissage</a></li>
                        <li><a href="index.php#contact">Orientation</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" onclick="return false;">Espace pour les professionnels</a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php#contact">Stages</a></li>
                        <li><a href="index.php#contact">Alternance</a></li>
                        <li><a href="index.php#contact">Partenariats</a></li>
                    </ul>
                </li>
                <li><a href="index.php#actualites">Actualités</a></li>
                <li><a href="index.php#ufa">UFA</a></li>
                <li><a href="index.php#contact">Contact</a></li>
                <li><a href="vie-lyceenne.php">Vie Lycéenne</a></li>
            </ul>
            <button class="menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav> 
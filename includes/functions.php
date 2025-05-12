<?php
/**
 * Fonctions utilitaires pour le système d'administration
 */

/**
 * Nettoie une chaîne de caractères pour éviter les injections
 * @param string $data La chaîne à nettoyer
 * @return string La chaîne nettoyée
 */
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Génère un slug à partir d'un titre
 * @param string $title Le titre à transformer
 * @return string Le slug généré
 */
function generate_slug($title) {
    // Convertit les caractères spéciaux en ASCII
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $title);
    // Remplace les espaces par des tirets
    $slug = str_replace(' ', '-', $slug);
    // Supprime tous les caractères non alphanumériques sauf les tirets
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    // Convertit en minuscules
    $slug = strtolower($slug);
    // Supprime les tirets multiples
    $slug = preg_replace('/-+/', '-', $slug);
    // Supprime les tirets au début et à la fin
    $slug = trim($slug, '-');
    
    return $slug;
}

/**
 * Vérifie si l'utilisateur est connecté
 * @return bool
 */
function is_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Redirige vers une autre page
 * @param string $location L'URL de destination
 */
function redirect($location) {
    header("Location: $location");
    exit;
}

/**
 * Formate une date MySQL en format français
 * @param string $date La date au format MySQL (YYYY-MM-DD)
 * @return string La date au format français (DD/MM/YYYY)
 */
function format_date($date) {
    if (empty($date)) return '';
    $timestamp = strtotime($date);
    return date('d/m/Y', $timestamp);
}

/**
 * Crée un jeton CSRF
 * @return string Le jeton généré
 */
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Vérifie un jeton CSRF
 * @param string $token Le jeton à vérifier
 * @return bool True si le jeton est valide
 */
function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}
?> 
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

/**
 * Fonction pour ajouter automatiquement le préfixe aux noms de tables
 * @param string $sql La requête SQL avec des noms de tables sans préfixe
 * @return string La requête SQL avec les noms de tables préfixés
 */
function addTablePrefix($sql) {
    global $table_prefix;
    
    // Liste des tables trouvées dans les requêtes SQL
    $tables = [
        'actualites',
        'medias_partage',
        'voix_apprentis_journaux',
        'jours',
        'categories',
        'restaurant_media',
        'your_table' // Remplacer par le vrai nom si nécessaire
    ];
    
    // Remplacer chaque nom de table par sa version préfixée
    foreach ($tables as $table) {
        // Assure que le remplacement n'est fait que pour les noms de tables complets
        // en utilisant des délimiteurs (espace, parenthèse, etc.)
        $sql = preg_replace('/\b' . $table . '\b/', $table_prefix . $table, $sql);
    }
    
    return $sql;
}
?> 
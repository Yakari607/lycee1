function ajouter_scripts_personnalises() {
    wp_enqueue_style('mon-style', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_script('mon-script', get_template_directory_uri() . '/js/script.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'ajouter_scripts_personnalises');

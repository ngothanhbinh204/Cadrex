<?php
define('GENERATE_VERSION', '1.1.0');
require get_template_directory() . '/inc/function-root.php';
require get_template_directory() . '/inc/function-custom.php';
require get_template_directory() . '/inc/function-field.php';
require get_template_directory() . '/inc/function-pagination.php';
require get_template_directory() . '/inc/function-setup.php';
require get_template_directory() . '/inc/function-post-types.php';
require get_template_directory() . '/inc/class-walker-menu.php';
// require get_template_directory() . '/inc/acf-home-fields.php'; // Removed as we use acf-json/home.json
require get_template_directory() . '/inc/acf-banner-fields.php';

<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blogrock
 */

// Default settings.
require_once get_template_directory() . '/inc/default.php';

// Custom Post Types.
//require_once get_template_directory() . '/inc/cpt.php';

// Theme functions.
require_once get_template_directory() . '/inc/theme-functions.php';

// Custom Menu Walker.
require_once get_template_directory() . '/inc/classes/class-custom-walker-nav-menu.php';

// Custom widget 'Recent Posts From Specific Category'.
require_once get_template_directory() . '/inc/classes/class-widget-recent-posts-from-category.php';

// Theme custom widgets registration.
require_once get_stylesheet_directory() . '/inc/widgets.php';

// Theme sidebars.
require_once get_template_directory() . '/inc/sidebars.php';

// Theme thumbnails.
require_once get_template_directory() . '/inc/thumbnails.php';

// Theme menus.
require_once get_template_directory() . '/inc/menus.php';

// Theme CSS & JS.
require_once get_template_directory() . '/inc/scripts.php';

// Theme Options – The Customize API.
require_once get_template_directory() . '/inc/customizer.php';

// BaseACFLinkHelper class.
require_once get_template_directory() . '/inc/classes/class-baseacflinkhelper.php';

// ACF Gutenberg Blocks.
require_once get_stylesheet_directory() . '/inc/acf-gutenberg-blocks.php';

// ACF functions paceholders.
require_once get_stylesheet_directory() . '/inc/acf-functions-paceholders.php';
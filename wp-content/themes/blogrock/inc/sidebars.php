<?php
/**
 * Theme sidebars
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 *
 * @package blogrock
 */

/**
 * Registers theme sidebars.
 */
function blogrock_register_sidebars() {
	// Register the 'Default Sidebar'.
	register_sidebar(array(
		'id'            => 'default-sidebar',
		'name'          => esc_html__( 'Default Sidebar', 'blogrock' ),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));
	// Register the 'footer Sidebars'.
	register_sidebar(array(
        'name'          => 'Footer Column 1',
        'id'            => 'footer_col_1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="h6">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => 'Footer Column 2',
        'id'            => 'footer_col_2',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="h6">',
        'after_title'   => '</h3>',
    ));
    register_sidebar(array(
        'name'          => 'Footer Column 3',
        'id'            => 'footer_col_3',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="h6">',
        'after_title'   => '</h3>',
    ));
}

add_action( 'widgets_init', 'blogrock_register_sidebars' );

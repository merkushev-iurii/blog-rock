<?php
/**
 * Theme menus
 *
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 *
 * @package blogrock
 */

/**
 * Add theme menus.
 */
function blogrock_register_nav_menus() {
	register_nav_menus(
		array(
			'primary'       => esc_html__( 'Primary Navigation', 'blogrock' ),
			'footer_menu1'  => esc_html__( 'Footer Navigation 1', 'blogrock' ),
			'footer_menu2'  => esc_html__( 'Footer Navigation 2', 'blogrock' ),
			'footer_menu3'  => esc_html__( 'Footer Navigation 3', 'blogrock' ),
		)
	);
}

add_action( 'after_setup_theme', 'blogrock_register_nav_menus', 0 );

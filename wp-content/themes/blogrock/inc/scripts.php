<?php
/**
 * Theme CSS & JS
 *
 * @link https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 *
 * @package blogrock
 */

/**
 * Enqueue scripts and styles.
 */
function blogrock_scripts_styles() {
	$in_footer = true;

	$theme_obj     = wp_get_theme();
	$theme_version = $theme_obj->get( 'Version' );

	// Comment JS.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Font Awesome.
	wp_register_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css', array(), '6.6.0' );

	// Loads Bootstrap file with functionality specific.
	wp_enqueue_script( 'base-popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array( 'jquery' ), '', $in_footer );
	wp_enqueue_script( 'base-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js', array( 'jquery' ), '', $in_footer );

	
	 //* Slick JS.
	wp_register_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' );
	wp_register_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array( 'jquery' ), '', $in_footer );
	 

	/**
	 * Fancybox.
	 *
	 * @ignore
	 * wp_register_style( 'fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', array(), null );
	 * wp_register_script( 'fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), '', $in_footer );
	 */

	/**
	 * Google Maps JS.
	 *
	 * @ignore
	 * $google_map_api_key = get_field( 'google_map_api_key', 'option' );
	 * wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=' . $google_map_api_key . '&callback=initMap', array(), '', $in_footer );
	 */

	// Main CSS.
	$style_deps = array( 'font-awesome' );

	wp_enqueue_style( 'base-style', get_stylesheet_uri(), $style_deps, $theme_version );

	// Main JS.
	$script_deps = array( 'jquery' );

	wp_enqueue_script( 'base-script', get_template_directory_uri() . '/js/jquery.main.js', $script_deps, $theme_version, $in_footer );

	// Testimonials Block JS.
	wp_register_script( 'testimonials', get_template_directory_uri() . '/blocks/testimonials/testimonials.js', array( 'jquery' ), $theme_version, true );

	/**
	 * Implementation CSS.
	 *
	 * @ignore
	 * wp_enqueue_style( 'base-theme', get_template_directory_uri() . '/theme.css', array() );
	 */
}

add_action( 'wp_enqueue_scripts', 'blogrock_scripts_styles' );

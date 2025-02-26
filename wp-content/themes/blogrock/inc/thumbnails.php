<?php
/**
 * Theme thumbnails
 *
 * @link https://developer.wordpress.org/reference/functions/add_image_size/
 *
 * @package blogrock
 */

/**
 * Registers theme custom image sizes
 * Example: 'add_image_size( 'thumbnail_400x9999', 400, 9999, true );'
 */
function blogrock_thumbnails() {
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'thumbnail_1920', 1920, 9999, false );
	add_image_size( 'thumbnail_1170', 1170, 9999, false );
	add_image_size( 'thumbnail_732', 732, 502, true );
	add_image_size( 'thumbnail_600', 600, 600, true );
	add_image_size( 'thumbnail_570', 570, 343, true );
	add_image_size( 'thumbnail_235', 235, 235, true );
	add_image_size( 'thumbnail_270', 270, 343, true );
	add_image_size( 'portrait', 453, 627, true );
	add_image_size( 'landscape', 610, 452, true );
}

add_action( 'after_setup_theme', 'blogrock_thumbnails' );

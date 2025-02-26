<?php
/**
 * Theme functions
 *
 * @package blogrock
 */

/**
 * Editor color palette.
 *
 * @return void
 */
function blogrock_editor_color_palette() {
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_attr__( 'gray', 'blogrock' ),
				'slug'  => 'gray',
				'color' => '#999',
			),
			array(
				'name'  => esc_attr__( 'black', 'blogrock' ),
				'slug'  => 'black',
				'color' => '#000',
			),
			array(
				'name'  => esc_attr__( 'white', 'blogrock' ),
				'slug'  => 'white',
				'color' => '#fff',
			),
		)
	);
}
// add_action( 'after_setup_theme', 'blogrock_editor_color_palette' );

/**
 * Add editor color palette classes to inline styles.
 *
 * @return void
 */
function blogrock_add_editor_color_palette_classes() {
	$colors = get_theme_support( 'editor-color-palette' );
	if ( is_array( $colors[0] ) && ! empty( $colors[0] ) ) {
		$custom_css = '';
		foreach ( $colors[0] as $color ) {
			$color_slug  = $color['slug'];
			$color_hex   = $color['color'];
			$custom_css .= ".has-$color_slug-color{color:$color_hex}.has-$color_slug-background-color{background-color:$color_hex}";
		}
		wp_add_inline_style( 'base-style', $custom_css );
	}
}
// add_action( 'wp_enqueue_scripts', 'blogrock_add_editor_color_palette_classes', 100 );

/**
 * Background color style.
 *
 * @param string $color Color HEX code.
 *
 * @return string
 */
function get_section_bg_color( $color = '' ) {
	return $color ? ' style="background-color:' . esc_attr( $color ) . ';"' : '';
}

/**
 * Background-image style.
 *
 * @param string $image_url Image URL.
 *
 * @return string
 */
function get_section_bg_image( $image_url = '' ) {
	return $image_url ? ' style="background-image:url(' . esc_attr( $image_url ) . ');"' : '';
}

/**
 * Border-color style.
 *
 * @param string $color Color HEX code.
 *
 * @return string
 */
function get_section_border_color( $color = '' ) {
	return $color ? ' style="border-color:' . esc_attr( $color ) . ';"' : '';
}

/**
 * Color style.
 *
 * @param string $color Color HEX code.
 *
 * @return string
 */
function get_section_color( $color = '' ) {
	return $color ? ' style="color:' . esc_attr( $color ) . ';"' : '';
}

/**
 * Add 'Reusable blocks' admin page.
 *
 * @return void
 */
function blogrock_reusable_blocks_admin_menu() {
	add_menu_page(
		esc_html__( 'Reusable Blocks', 'blogrock' ),
		esc_html__( 'Reusable Blocks', 'blogrock' ),
		'edit_posts',
		'edit.php?post_type=wp_block',
		'',
		'dashicons-editor-table',
		22
	);
}

// add_action( 'admin_menu', 'blogrock_reusable_blocks_admin_menu' );

update_field('show_title', true, get_option('page_for_posts'));

add_theme_support('post-tags');

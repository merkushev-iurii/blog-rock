<?php
/**
 * ACF blocks helper functions.
 *
 * @package blogrock
 */

/**
 * Register ACF blocks from JSON files.
 *
 * @return void
 */
function blogrock_register_acf_blocks() {
	$block_json_files = glob( get_template_directory() . '/blocks/**/block.json' );
	foreach ( $block_json_files as $block_json_file ) {
		register_block_type( $block_json_file );
	}
}
add_action( 'init', 'blogrock_register_acf_blocks' );

add_filter(
	'block_categories_all',
	function ( $categories, $post ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'custom-acf-blocks',
					'title' => esc_html__( 'Custom ACF Blocks', 'blogrock' ),
				),
			)
		);
	},
	99,
	2
);

/**
 * Get Gutenberg block class names.
 *
 * @param array $block                  ACF block data array.
 * @param array $additional_class_names Custom class names.
 *
 * @return string
 */
function get_section_class_names( $block, $additional_class_names ) {
	$align_class = $block['align'] ? 'align' . $block['align'] : '';
	$block_class = ( isset( $block['className'] ) ) ? $block['className'] : '';
	$class_names = array();

	if ( $align_class ) {
		$class_names[] = $align_class;
	}

	if ( $block_class ) {
		$class_names[] = $block_class;
	}

	if ( ! empty( $block['backgroundColor'] ) ) {
		$class_names[] = 'has-background';
		$class_names[] = 'has-' . $block['backgroundColor'] . '-background-color';
	}
	if ( ! empty( $block['textColor'] ) ) {
		$class_names[] = 'has-text-color';
		$class_names[] = 'has-' . $block['textColor'] . '-color';
	}

	$class_names_result = ( $additional_class_names && $class_names ) ? array_merge( $additional_class_names, $class_names ) : $additional_class_names;

	return esc_attr( implode( ' ', $class_names_result ) );
}

/**
 * Get gutenberg block id.
 *
 * @param array $block ACF block data array.
 *
 * @return string
 */
function get_section_id( $block ) {
	$id = $block['id'];

	if ( ! empty( $block['anchor'] ) ) {
		$id = $block['anchor'];
	}

	return esc_attr( $id );
}

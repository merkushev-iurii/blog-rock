<?php
/**
 * Custom post types
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * @package blogrock
 */

add_action( 'init', 'init_custom_post_types' );

/**
 * Get custom post type labels.
 *
 * @param string $singular_name Post singular label.
 * @param string $plural_name Post plural label.
 */
function get_custom_post_type_labels( $singular_name = 'Item', $plural_name = 'Items' ) {
	return array(
		/* translators: post type general name */
		'name'               => sprintf( _x( '%s', 'Post type general name', 'blogrock' ), $singular_name ),
		/* translators: post type singular Name */
		'singular_name'      => sprintf( _x( '%s', 'Post type singular Name', 'blogrock' ), $singular_name ),
		/* translators: posts admin menu link text */
		'menu_name'          => sprintf( _x( '%s', 'Admin Menu text', 'blogrock' ), $plural_name ),
		/* translators: posts add new on toolbar text */
		'name_admin_bar'     => sprintf( _x( '%s', 'Add New on Toolbar', 'blogrock' ), $plural_name ),
		/* translators: add new post link label */
		'add_new'            => sprintf( __( 'Add New %s', 'blogrock' ), $singular_name ),
		/* translators: add new post button label */
		'add_new_item'       => sprintf( __( 'Add New %s', 'blogrock' ), $singular_name ),
		/* translators: new post item label */
		'new_item'           => sprintf( __( 'New %s', 'blogrock' ), $singular_name ),
		/* translators: edit post link text */
		'edit_item'          => sprintf( __( 'Edit %s', 'blogrock' ), $singular_name ),
		/* translators: view post link text */
		'view_item'          => sprintf( __( 'View %s', 'blogrock' ), $singular_name ),
		/* translators: all posts link text */
		'all_items'          => sprintf( __( 'All %s', 'blogrock' ), $plural_name ),
		/* translators: search posts label */
		'search_items'       => sprintf( __( 'Search %s', 'blogrock' ), $plural_name ),
		/* translators: parent post item label */
		'parent_item_colon'  => sprintf( __( 'Parent %s', 'blogrock' ), $plural_name ),
		/* translators: not found posts text */
		'not_found'          => sprintf( __( 'No %s found.', 'blogrock' ), $plural_name ),
		/* translators: trash not found posts text */
		'not_found_in_trash' => sprintf( __( 'No %s found in Trash.', 'blogrock' ), $plural_name ),
		/* translators: update post button text */
		'update_item'        => sprintf( __( 'Update %s', 'blogrock' ), $singular_name ),
	);
}

/**
 * Registers custom post types.
 */
function init_custom_post_types() {
	// Article.
	register_post_type(
		'article',
		array(
			'labels'              => get_custom_post_type_labels( __( 'Article', 'blogrock' ), __( 'Articles', 'blogrock' ) ),
			'description'         => '',
			'menu_icon'           => 'dashicons-admin-post',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'query_var'           => true,
			'rewrite'             => array( 'slug' => 'article' ),
			'capability_type'     => 'post',
			'has_archive'         => true,
			'hierarchical'        => false,
			'menu_position'       => 20,
			'supports'            => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'custom-fields',
				'comments',
				'revisions',
				'page-attributes',
			),
			'exclude_from_search' => false,
			'show_in_rest'        => false,
		)
	);
}

<?php
/**
 * Theme Customizer
 *
 * @link https://developer.wordpress.org/themes/customize-api/
 *
 * @package blogrock
 */

/**
 * Add Customozer settings.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogrock_customize_register( $wp_customize ) {
	// Footer options.
	$wp_customize->add_section(
		'base_theme_footer',
		array(
			'title'    => __( 'Footer', 'blogrock' ),
			'priority' => 100,
		)
	);

	// Footer copyright setting.
	$wp_customize->add_setting(
		'footer_copyright',
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'footer_copyright',
		array(
			'type'    => 'text',
			'section' => 'base_theme_footer',
			'label'   => __( 'Footer copyright', 'blogrock' ),
		)
	);

	// Footer logo.
	$wp_customize->add_setting( 'footer_logo' );
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'footer_logo',
			array(
				'label'     => __( 'Footer logo', 'blogrock' ),
				'section'   => 'base_theme_footer',
				'mime_type' => 'image',
			)
		)
	);
}

add_action( 'customize_register', 'blogrock_customize_register' );

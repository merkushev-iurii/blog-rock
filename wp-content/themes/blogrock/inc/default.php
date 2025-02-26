<?php
/**
 * Default theme settings
 *
 * @package blogrock
 */

/**
 * Dispalys blocking access to robots admin notice.
 */
function blogrock_seo_warning() {
	if ( get_option( 'blog_public' ) ) {
		return;
	}

	echo '<div class="error"><p>';
	printf(
		/* translators: message for the administrator about disabled site indexing. */
		wp_kses( __( 'You are blocking access to robots. You must go to your <a href="%s">Reading</a> settings and uncheck the box for Search Engine Visibility.', 'blogrock' ), array( 'a' => array( 'href' => array() ) ) ),
		esc_url( admin_url( 'options-reading.php' ) )
	);
	echo '</p></div>';
}

add_action( 'admin_notices', 'blogrock_seo_warning' );

/**
 * Theme disable cheks
 */
function theme_disable_cheks() {
	global $themechecks;
	$disabled_checks = array( 'TagCheck', 'Plugin_Territory', 'CustomCheck', 'EditorStyleCheck' );

	foreach ( $themechecks as $key => $check ) {
		if ( is_object( $check ) && in_array( get_class( $check ), $disabled_checks, true ) ) {
			unset( $themechecks[ $key ] );
		}
	}
}

add_action( 'themecheck_checks_loaded', 'theme_disable_cheks' );

/**
 * Theme setup
 */
function blogrock_theme_setup() {
	load_theme_textdomain( 'blogrock', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo' );

	add_theme_support(
		'html5',
		array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	add_theme_support( 'align-wide' );
}

add_action( 'after_setup_theme', 'blogrock_theme_setup' );

/**
 * Add 'accesskey' attribute to custom logo link
 *
 * @param string $html    Custom logo HTML output.
 * @param int    $blog_id ID of the blog to get the custom logo for.
 */
function base_get_custom_logo( $html, $blog_id ) {
	return str_replace( '<a href', '<a accesskey="1" href', $html );
}

add_filter( 'get_custom_logo', 'base_get_custom_logo', 10, 2 );

if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

remove_action( 'wp_head', 'wp_generator' );

/**
 * Add [email]...[/email] shortcode.
 *
 * @param array  $atts     Shortcode attributes.
 * @param string $content Shortcode content.
 */
function shortcode_email( $atts, $content ) {
	return antispambot( $content );
}

add_shortcode( 'email', 'shortcode_email' );

/**
 * Register tag [template-url]
 *
 * @param mixed $text Text string.
 *
 * @return string
 */
function filter_template_url( $text ) {
	if ( is_string( $text ) ) {
		$text = str_replace( '[template-url]', get_template_directory_uri(), $text );
	}
	return $text;
}

add_filter( 'the_content', 'filter_template_url' );
add_filter( 'widget_text', 'filter_template_url' );

/**
 * Register tag [site-url]
 *
 * @param mixed $text Text string.
 *
 * @return string
 */
function filter_site_url( $text ) {
	if ( is_string( $text ) ) {
		$text = str_replace( '[site-url]', home_url(), $text );
	}
	return $text;
}

add_filter( 'the_content', 'filter_site_url' );
add_filter( 'widget_text', 'filter_site_url' );

if ( class_exists( 'acf' ) && ! is_admin() ) {
	add_filter( 'acf/load_value', 'filter_template_url' );
	add_filter( 'acf/load_value', 'filter_site_url' );
}

/**
 * Replace standard wp menu classes
 *
 * @param string $css_classes Menu item CSS classes string.
 *
 * @return string
 */
function change_menu_classes( $css_classes ) {
	return str_replace(
		array(
			'current-menu-item',
			'current-menu-parent',
			'current-menu-ancestor',
		),
		'active',
		$css_classes
	);
}

add_filter( 'nav_menu_css_class', 'change_menu_classes' );

// Allow tags in category description.
$filters = array( 'pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description' );

foreach ( $filters as $filter ) {
	remove_filter( $filter, 'wp_filter_kses' );
}

/**
 * Sanitizes phone number.
 *
 * @param string $phone Phone number.
 *
 * @return string
 */
function clean_phone( $phone ) {
	return preg_replace( '/[^0-9]/', '', $phone );
}

/**
 * Disable comments on pages by default.
 *
 * @param int     $post_ID Post ID.
 * @param WP_Post $post    Post object.
 * @param bool    $update  Whether this is an existing post being updated.
 */
function theme_page_comment_status( $post_ID, $post, $update ) {
	if ( ! $update ) {
		remove_action( 'save_post_page', 'theme_page_comment_status', 10 );
		wp_update_post(
			array(
				'ID'             => $post->ID,
				'comment_status' => 'closed',
			)
		);
		add_action( 'save_post_page', 'theme_page_comment_status', 10, 3 );
	}
}

add_action( 'save_post_page', 'theme_page_comment_status', 10, 3 );

/**
 * Custom excerpt.
 */
function theme_the_excerpt() {
	global $post;

	if ( trim( $post->post_excerpt ) ) {
		the_excerpt();
	} elseif ( strpos( $post->post_content, '<!--more-->' ) !== false ) {
		the_content();
	} else {
		the_excerpt();
	}
}

/**
 * Theme password form.
 *
 * @param string  $output Password form HTML.
 * @param WP_Post $post   Post object.
 *
 * @return string
 */
function theme_get_the_password_form( $output, $post ) {
	$label  = 'pwbox-' . ( empty( $post->ID ) ? wp_rand() : $post->ID );
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
	<p>' . __( 'This content is password protected. To view it please enter your password below:', 'blogrock' ) . '</p>
	<p><label for="' . $label . '">' . __( 'Password:', 'blogrock' ) . '</label> <input name="post_password" id="' . $label . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'blogrock' ) . '" /></p>
	</form>';

	return $output;
}

add_filter( 'the_password_form', 'theme_get_the_password_form', 10, 2 );

/**
 * Adds 'theme_options_view' capability for administrator role.
 */
function basetheme_options_capability() {
	$role = get_role( 'administrator' );
	$role->add_cap( 'theme_options_view' );
}

add_action( 'admin_init', 'basetheme_options_capability' );

// Theme options tab in appearance.
if ( function_exists( 'acf_add_options_sub_page' ) && current_user_can( 'theme_options_view' ) ) {
	acf_add_options_sub_page(
		array(
			'title'  => 'Theme Options',
			'parent' => 'themes.php',
		)
	);
}

// Date archive link.
add_action(
	'admin_init',
	function () {
		add_settings_section(
			'eg_setting_section',
			__( 'Date archive link', 'blogrock' ),
			function () {},
			'reading'
		);
		add_settings_field( 'eg_setting_name', __( 'Type', 'blogrock' ), 'eg_setting_callback_function', 'reading', 'eg_setting_section' );
		register_setting( 'reading', 'eg_date_archive_link_type' );
	}
);

/**
 * Provide select for 'Date archive link' setting.
 */
function eg_setting_callback_function() {
	if ( get_option( 'eg_date_archive_link_type' ) ) {
		$type = get_option( 'eg_date_archive_link_type' );
	} else {
		$type = 'month';
	}
	echo '
	 <select name="eg_date_archive_link_type">
		 <option ' . selected( $type, 'day', false ) . ' value="day">' . esc_html__( 'Day', 'blogrock' ) . '</option>
		 <option ' . selected( $type, 'month', false ) . ' value="month">' . esc_html__( 'Month', 'blogrock' ) . '</option>
		 <option ' . selected( $type, 'year', false ) . ' value="year">' . esc_html__( 'Year', 'blogrock' ) . '</option>
	 </select>
	';
}

/**
 * Date archive link.
 */
function get_date_archive_link() {
	if ( get_option( 'eg_date_archive_link_type' ) === 'year' ) {
		$res = get_year_link( get_the_date( 'Y' ) );
	} elseif ( get_option( 'eg_date_archive_link_type' ) === 'day' ) {
		$res = get_day_link( get_the_date( 'Y' ), get_the_date( 'm' ), get_the_date( 'd' ) );
	} else {
		$res = get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) );
	}

	return $res;
}

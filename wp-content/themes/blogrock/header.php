<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <main id="main">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogrock
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<noscript><div><?php esc_html_e( 'Javascript must be enabled for the correct page display', 'blogrock' ); ?></div></noscript>
		<div class="page-holder">
			<a class="skip-link screen-reader-text" accesskey="s" href="#content"><?php esc_html_e( 'Skip to Content', 'blogrock' ); ?></a>
			<div id="wrapper">
				<header id="header" class="header">
					<div class="container d-flex align-items-center">
						
						<?php if ( has_custom_logo() ) : ?>
							<div class="logo" itemscope itemtype="http://schema.org/Brand">
								<?php the_custom_logo(); ?>
							</div>
						<?php endif; ?>

						<div class="nav-holder">
							<button type="button" class="search-toggle">
								<span class="icon icon-search"></span>
							</button>
							<div class="form-wrap">
								<?php get_search_form(); ?>
							</div>

							<?php if ( has_nav_menu( 'primary' ) ) : ?>
								<button type="button" class="menu-toggle">
									<span class="icon icon-menu"></span>
									<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'blogrock' ); ?></span>
								</button>
								<?php
									wp_nav_menu(
										array(
											'container'            => 'nav',
											'container_class'      => 'primary-nav-wrapper',
											'container_aria_label' =>  esc_html__( 'Primary', 'blogrock' ),
											'theme_location'       => 'primary',
											'menu_id'              => 'header-navigation',
											'menu_class'           => 'header-navigation',
											'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
											'walker'               => new Custom_Walker_Nav_Menu(),
										)
									);
								?>
							<?php endif; ?>
						</div>
					</div>
				</header>
				<main id="main">

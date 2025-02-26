<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogrock
 */

?>
<div class="post">
	<header class="head">
		<h1><?php esc_html_e( 'Not Found', 'blogrock' ); ?></h1>
	</header>
	<div class="content">
		<p><?php esc_html_e( 'Sorry, but you are looking for something that isn\'t here.', 'blogrock' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</div>

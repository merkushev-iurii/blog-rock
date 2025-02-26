<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#404-not-found
 *
 * @package blogrock
 */

get_header();
?>
	<div id="content">
		<div class="container">
			<?php get_template_part( 'template-parts/not-found' ); ?>
		</div>
	</div>
<?php
//get_sidebar();
get_footer();

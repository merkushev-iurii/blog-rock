<?php
/**
 * Page template without sidebar
 *
 * Template Name: Full Width Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package blogrock
 */

get_header();
?>
<div id="content">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
			edit_post_link( __( 'Edit', 'blogrock' ), '<p>', '</p>' );
		endwhile;
		?>
	</div>
</div>
<?php
get_footer();

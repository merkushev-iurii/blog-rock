<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
				if ( get_field('show_page_title') ) :
					the_title( '<div class="title-page"><span>', '</span></div>' );
				endif;
				//the_post_thumbnail( 'thumbnail_1920' );
				the_content();
				edit_post_link( __( 'Edit', 'blogrock' ), '<p>', '</p>' );
				wp_link_pages();
				comments_template();
			endwhile;
			?>
		</div>
	</div>
<?php
//get_sidebar();
get_footer();

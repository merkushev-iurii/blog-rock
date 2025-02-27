<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
				get_template_part( 'template-parts/content-single/content-single', get_post_type() );
				 ?>
				<div class="pager-block">
					<?php get_template_part( 'template-parts/content-single/pager-single', get_post_type() ); ?>
				</div>
				<?php
				comments_template(); ?>
				<?php
			endwhile;
			?>
		</div>
	</div>
<?php
//get_sidebar();
get_footer();

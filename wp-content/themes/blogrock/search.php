<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package blogrock
 */

get_header();
?>
<div class="holder-blog-page-content">
	<div id="content">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<div class="title">
					<h1 class="h3">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'blogrock' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</div>
				<div class="posts-wrapper">
	                <?php while ( have_posts() ) : the_post(); ?>
	                    <?php get_template_part( 'template-parts/content/content', get_post_type() ); ?>
	                <?php endwhile; ?>
	            </div>
				<?php get_template_part( 'template-parts/pager' ); ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/not-found' ); ?>
			<?php endif; ?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();

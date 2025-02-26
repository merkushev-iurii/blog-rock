<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogrock
 */

get_header(); 
?>

<div class="holder-blog-page-content">
    <div id="content">
        <div class="container">
			<div class="title">
				<?php the_archive_title( '<h1 class="h3">', '</h1>' ); ?>
			</div>

            <?php if ( have_posts() ) : ?>
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

<?php get_footer(); ?>

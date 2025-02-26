<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#home-page-display
 *
 * @package blogrock
 */


get_header(); 
?>

<div class="holder-blog-page-content">
    <div id="content">
        <div class="container">
			<?php
				$blog_page_id = get_option('page_for_posts');
				if (get_field('show_page_title', $blog_page_id)) :
				    echo '<h2 class="title-page"><span>' . get_the_title($blog_page_id) . '</span></h2>';
				endif;
			?>
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

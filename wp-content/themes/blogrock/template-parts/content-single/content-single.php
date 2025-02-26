<?php
/**
 * Template part for displaying single post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogrock
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php
		$blog_page_id = get_option('page_for_posts'); 
		if ( get_field('show_page_title', $blog_page_id) ) : 
		    echo '<h2 class="title-page"><span>' . get_the_title($blog_page_id) . '</span></h2>'; 
		endif;
	?>
	<header class="title">
	    <h1><?php the_title(); ?></h1>
	    <div class="share"><span>Share:</span> <?php echo DISPLAY_ULTIMATE_PLUS(); ?></div>
		<?php the_post_thumbnail( 'thumbnail_1170' ); ?>
	</header>
	<div class="content">
		<div class="post-holder">
			<div class="author">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
				<a class="author-name" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php the_author(); ?></a>
			</div>
			<div class="article-meta">
				<span class="date">Added: <a href="<?php echo esc_url( get_date_archive_link() ); ?>" rel="bookmark"><?php echo get_the_date( 'j F Y' ); ?></a></span>
				<span class="comments"><a href="<?php echo esc_url( get_comments_link() ); ?>"> <span class="icon icon-comment"></span> <?php comments_number( '0', '1', '%' ); ?></a></span>
			</div>
			<div class="content-block">
				<?php the_content(); ?>
				<div class="bottom-info">
					<div class="post-tags">
                        <?php the_tags( '', ' ', '' ); ?>
                    </div>
                     <div class="share"><span>Share:</span> <?php echo DISPLAY_ULTIMATE_PLUS(); ?></div>
				</div>
			</div>
		</div>
	</div>
	<?php wp_link_pages(); ?>
</article>

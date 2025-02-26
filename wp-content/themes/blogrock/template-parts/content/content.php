<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blogrock
 */

?>
<article <?php post_class('article'); ?>>
	<div class="column">
		<div class="image-holder">
			<?php the_post_thumbnail( 'thumbnail_235' ); ?>
		</div>
	</div>
	<div class="column">
		<div class="text-holder">
			<header class="title">
				<?php the_title( '<h3 class="h5 title-post"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
				<div class="article-meta">
					<span class="date">Added: <a href="<?php echo esc_url( get_date_archive_link() ); ?>" rel="bookmark"><?php echo get_the_date( 'j F Y' ); ?></a></span>
					<span class="comments"><a href="<?php echo esc_url( get_comments_link() ); ?>"> <span class="icon icon-comment"></span> <?php comments_number( '0', '1', '%' ); ?></a></span>
				</div>
			</header>
			<div class="excerpt">
				<?php theme_the_excerpt(); ?>
			</div>
			<div class="author">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?>
				<a class="author-name" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php the_author(); ?></a>
			</div>
		</div>
	</div>
</article>

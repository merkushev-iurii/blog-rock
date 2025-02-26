<?php
/**
 * Template part with information about the date and author of the post
 *
 * @package blogrock
 */

?>
<p class="meta-info">
	<a href="<?php echo esc_url( get_date_archive_link() ); ?>" rel="bookmark">
		<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
			<?php the_time( 'F jS, Y' ); ?>
		</time>
	</a>
	<?php esc_html_e( 'by', 'blogrock' ); ?>
	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php the_author(); ?></a>
</p>

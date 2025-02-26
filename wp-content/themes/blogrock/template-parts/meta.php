<?php
/**
 * Template part with meta information of the post
 *
 * @package blogrock
 */

?>
<div class="meta">
	<ul>
		<li>
			<?php
			/* translators: %s: post category link. */
			printf( esc_html__( 'Posted in %s', 'blogrock' ), get_the_category_list( ', ' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</li>
		<li><?php comments_popup_link( __( 'No Comments', 'blogrock' ), __( '1 Comment', 'blogrock' ), __( '% Comments', 'blogrock' ) ); ?></li>
		<?php the_tags( __( '<li>Tags: ', 'blogrock' ), ', ', '</li>' ); ?>
		<?php edit_post_link( __( 'Edit', 'blogrock' ), '<li>', '</li>' ); ?>
	</ul>
</div>

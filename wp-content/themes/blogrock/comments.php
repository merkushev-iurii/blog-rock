<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/comment-template/
 *
 * @package blogrock
 */

// Do not delete these lines.
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' === basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die( 'Please do not load this page directly. Thanks!' );
}

if ( post_password_required() ) {
	?>
	<p><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'blogrock' ); ?></p>
	<?php
	return;
}

/**
 * Comment output.
 *
 * @param mixed $comment Comment object.
 * @param mixed $args    Options array.
 * @param mixed $depth   Depth level.
 *
 * @return void
 */
function theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>

	<div class="commentlist-item">
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<?php
			$avatar = get_avatar( $comment, 48 );
			if ( $avatar ) :
				?>
				<div class="avatar-holder"><?php echo $avatar; ?></div>
			<?php endif; ?>

			<div class="commentlist-holder">
				<?php edit_comment_link( __( '(Edit)', 'blogrock' ), '<p class="edit-link">', '</p>' ); ?>

				<p class="meta">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php comment_date( 'F d, Y' ); ?><?php esc_html_e( 'at', 'blogrock' ); ?><?php comment_time( 'g:i a' ); ?></a>, <?php comment_author_link(); ?> <?php esc_html_e( 'said:', 'blogrock' ); ?>
				</p>

				<?php if ( 0 === $comment->comment_approved ) : ?>
					<p><?php esc_html_e( 'Your comment is awaiting moderation.', 'blogrock' ); ?></p>
				<?php else : ?>
					<?php comment_text(); ?>
				<?php endif; ?>

				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'reply_text' => __( 'Reply', 'blogrock' ),
							'before'     => '<p>',
							'after'      => '</p>',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						)
					)
				);
				?>
			</div>
		</div>
	<?php
}

/**
 * Comment end wrapper.
 */
function theme_comment_end() {
	?>
	</div>
	<?php
}
?>

<?php if ( have_comments() ) : ?>
	<div class="section comments" id="comments">
		<h2><?php comments_number( __( 'No Responses', 'blogrock' ), __( 'One Response', 'blogrock' ), __( '% Responses', 'blogrock' ) ); ?> <?php esc_html_e( 'to', 'blogrock' ); ?>&#8220;<?php the_title(); ?>&#8221;</h2>
		<div class="commentlist">
			<?php
			wp_list_comments(
				array(
					'callback'     => 'theme_comment',
					'end-callback' => 'theme_comment_end',
					'style'        => 'div',
				)
			);
			?>
		</div>
		<?php
		$comments_links = paginate_comments_links( array( 'echo' => false ) );
		if ( $comments_links ) :
			?>
			<div class="navigation-comments">
				<?php echo $comments_links; ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if ( comments_open() ) : ?>
	<div class="section respond">
		<?php comment_form(); ?>
	</div>
<?php else : ?>
	<?php if ( is_singular( array( 'post' ) ) ) : ?>
		<p><?php esc_html_e( 'Comments are closed.', 'blogrock' ); ?></p>
	<?php endif; ?>
<?php endif; ?>

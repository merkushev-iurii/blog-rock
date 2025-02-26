<?php
/**
 * Image Text Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 *
 * @package blogrock
 */

$block_id       = get_section_id( $block );
$class_names    = array( 'image-text-section' );
$_title         = get_field( 'title' );
$text           = get_field( 'text' );
$_link          = get_field( 'link' );
$image          = get_field( 'image', false, false );
$image_position = get_field( 'image_position', false, false );
if ( $image_position ) {
	$class_names[] = 'image-position-' . $image_position;
}
if ( $_title || $text || $image || BaseACFLinkHelper::is_link( $_link ) ) :
	?>
	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( get_section_class_names( $block, $class_names ) ); ?>">
		<div class="container">
			<div class="row align-items-center">				
				<?php if ( $_title || $text || BaseACFLinkHelper::is_link( $_link ) ) : ?>
					<div class="col-12 col-md-6">
						<div class="text-holder">
							<?php if ( $_title ) : ?>
								<h2 class="h3 section-title"><?php echo esc_html( $_title ); ?></h2>
							<?php endif; ?>
							<?php echo wp_kses_post( $text ); ?>
							<?php if ( BaseACFLinkHelper::is_link( $_link ) ) : ?>
								<div class="button-holder">
									<?php BaseACFLinkHelper::the_link( $_link, array( 'btn', 'btn-primary' ) ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $image ) : ?>
					<div class="col-12 col-md-6">
						<div class="image-holder">
							<?php echo wp_get_attachment_image( $image, 'full' ); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;

<?php
/**
 * Contact Form Block Template.
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
$class_names    = array( 'contact-form-section' );
$_title         = get_field( 'title' );
$form_code      = get_field( 'form_code' );
$image          = get_field( 'image', false, false );
$image_position = get_field( 'image_position', false, false );
if ( $image_position ) {
	$class_names[] = 'image-position-' . $image_position;
}
if ( $_title || $form_code || $image ) :
	?>
	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( get_section_class_names( $block, $class_names ) ); ?>">
		<div class="container">
			<div class="row align-items-center">
				<?php if ( $_title || $form_code ) : ?>
					<div class="col-12 col-md-6">
						<div class="text-holder">
							<?php if ( $_title ) : ?>
								<h2 class="section-title"><?php echo esc_html( $_title ); ?></h2>
							<?php endif; ?>
							<?php if ( $form_code ) : ?>
								<div class="text">
									<?php echo wp_kses_post( $form_code ); ?>
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

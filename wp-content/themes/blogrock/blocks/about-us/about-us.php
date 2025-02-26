<?php
/**
 * About Us Block Template.
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
$class_names    = array( 'about-section' );
$_title         = get_field( 'title' );
$sub_title      = get_field( 'sub_title' );
$text           = get_field( 'text' );
$link           = get_field( 'link' );
$image          = get_field( 'image', false, false );
$image_type     = get_field( 'image_type', false, false );

if ( $image_type ) {
	$class_names[] = 'image-type-' . $image_type;
}
if ( $image_type ) {
	$crop_size = ($image_type === 'portrait') ? 'portrait' : 'landscape';
}
if ( $_title || $text || $image || BaseACFLinkHelper::is_link( $_link ) ) :
	?>
	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( get_section_class_names( $block, $class_names ) ); ?>">
		<div class="container">
			<div class="row-holder">
				
				<?php if ( $_title || $text || BaseACFLinkHelper::is_link( $link ) ) : ?>
					<div class="column">
						<div class="text-holder">
							<?php if ( $sub_title ) : ?>
								<span class="sub-title"><?php echo esc_html( $sub_title ); ?></span>
							<?php endif; ?>
							<?php if ( $_title ) : ?>
								<h2 class="section-title"><?php echo esc_html( $_title ); ?></h2>
							<?php endif; ?>
							<?php if ( $text ) : ?>
								<div class="text"><?php echo wp_kses_post( $text ); ?></div>
							<?php endif; ?>
							<?php if ( BaseACFLinkHelper::is_link( $link ) ) : ?>
								<div class="button-holder">
									<?php BaseACFLinkHelper::the_link( $link, array( 'btn', 'btn-success' ) ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $image ) : ?>
					<div class="column">
						<div class="image-holder">
							<?php echo wp_get_attachment_image( $image, $crop_size ); ?>
						</div>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</section>
	<?php
endif;

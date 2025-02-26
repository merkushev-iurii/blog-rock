<?php
/**
 * Banner Block Template.
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
$class_names    = array( 'banner-section' );
$_title         = get_field( 'title' );
$link           = get_field( 'link' );
$image          = get_field( 'background_image', false, false);

if ( $_title || $image || BaseACFLinkHelper::is_link( $link ) ) :
	?>
	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( get_section_class_names( $block, $class_names ) ); ?>">
		<div class="container">
			<div class="block"  style="background-image:url('<?php echo wp_get_attachment_image_url( $image, 'full' ); ?>')">
				<?php if ( $_title || BaseACFLinkHelper::is_link( $link ) ) : ?>
					<div class="text-holder">
						<?php if ( $_title ) : ?>
							<h2 class="section-title"><?php echo esc_html( $_title ); ?></h2>
						<?php endif; ?>
						<?php if ( BaseACFLinkHelper::is_link( $link ) ) : ?>
							<div class="button-holder">
								<?php BaseACFLinkHelper::the_link( $link, array( 'btn', 'btn-success' ) ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;

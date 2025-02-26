<?php
/**
 * Hero Block Template.
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
$class_names    = array( 'hero-section' );
$_title         = get_field( 'title' );
$sub_title      = get_field( 'sub_title' );
$text           = get_field( 'text' );
$image          = get_field( 'image', false, false );

if ( $_title || $text || $image || BaseACFLinkHelper::is_link( $_link ) ) :
	?>
	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( get_section_class_names( $block, $class_names ) ); ?>">
		<div class="container">
			<div class="row">
				<?php if ( $_title || $text || BaseACFLinkHelper::is_link( $link ) ) : ?>
					<div class="col-12 col-lg-5">
						<div class="text-holder">
							<?php if ( $sub_title ) : ?>
								<div class="tag"><span><?php echo esc_html( $sub_title ); ?></span></div>
							<?php endif; ?>
							<?php if ( $_title ) : ?>
								<h2 class="section-title"><?php echo esc_html( $_title ); ?></h2>
							<?php endif; ?>
							<?php if ( $text ) : ?>
								<div class="text"><?php echo wp_kses_post( $text ); ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $image ) : ?>
					<div class="col-12 col-lg-7">
						<div class="image-holder">
							<picture>
							    <source srcset="<?php echo wp_get_attachment_image_url( $image, 'thumbnail_600' ); ?>"  media="(max-width: 767px)">
							    <source srcset="<?php echo wp_get_attachment_image_url( $image, 'thumbnail_732' ); ?>">
							    <img src="<?php echo wp_get_attachment_image_url( $image, 'thumbnail_732' ); ?>" alt="">
							</picture>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;

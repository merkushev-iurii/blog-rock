<?php
/**
 * Subscribe Block Template.
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
$class_names    = array( 'subscribe-section' );
$_title         = get_field( 'title' );
$text           = get_field( 'text' );
$form           = get_field( 'form_shortcode' );


if ( $_title || $text || $form ) :
	?>
	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( get_section_class_names( $block, $class_names ) ); ?>">
		<div class="container">
			<?php if ( $_title || $text || $form ) : ?>
				<div class="box-holder">
					<?php if ( $_title ) : ?>
						<h2 class="h3 section-title"><?php echo esc_html( $_title ); ?></h2>
					<?php endif; ?>
					<?php if ( $text ) : ?>
						<div class="text"><?php echo wp_kses_post( $text ); ?></div>
					<?php endif; ?>
					<?php if ( $form ) : ?>
						<div class="form-wrap"><?php echo do_shortcode( $form ); ?></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;

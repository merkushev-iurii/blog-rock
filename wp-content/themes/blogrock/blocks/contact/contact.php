<?php
/**
 * Contact Block Template.
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
$class_names    = array( 'contact-section' );
$_title         = get_field( 'title_section' );

if ( $_title ||  have_rows('list_contacts') ) :
	?>
	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( get_section_class_names( $block, $class_names ) ); ?>" >
		<div class="container">
			<?php if ( $_title ) : ?>
				<h2 class="h4 section-title"><?php echo esc_html( $_title ); ?></h2>
			<?php endif; ?>
			<?php if ( have_rows('list_contacts') ) : ?>
				<div class="list-contacts row">
					<?php while( have_rows('list_contacts') ) : the_row();
						$title = get_sub_field('title');
						$text = get_sub_field('text');
						$icon = get_sub_field('icon'); ?>
							<div class="col-12 col-md-4">
								<div class="block">
									<?php if ( $icon ) : ?>
										<div class="icon">
											<?php echo wp_get_attachment_image( $icon, 'thumbnail' ); ?>
										</div>
									<?php endif; ?>
									<?php if ( $title ) : ?>
										<h3 class="h5 title"><?php echo $title; ?></h2>
									<?php endif; ?>
									<?php if ( $text ) : ?>
										<div class="text"><?php echo wp_kses_post( $text ); ?></div>
									<?php endif; ?>
								</div>
							</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;

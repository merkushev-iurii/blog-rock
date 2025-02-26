<?php
/**
 * Testimonials Block Template.
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
$class_names    = array( 'testimonials-section' );
$title          = get_field( 'title' );
$sub_title      = get_field( 'sub_title' );
$image          = get_field( 'background_image', false, false);

if ( $title || $sub_title || have_rows('list_testimonials') ) :
	?>
	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( get_section_class_names( $block, $class_names ) ); ?>" 
	style="background-image:url('<?php echo wp_get_attachment_image_url( $image, 'full' ); ?>')" >
		<div class="container">
			<div class="row ">
				<div class="col-12 col-md-4">
					<?php if ( $title ) : ?>
						<span class="title"><?php echo esc_html( $title ); ?></span>
					<?php endif; ?>
					<?php if ( $sub_title ) : ?>
						<h2 class="h3 sub-title"><?php echo esc_html( $sub_title ); ?></h2>
					<?php endif; ?>
				</div>
					
				<?php if ( have_rows('list_testimonials') ) : ?>
					<div class="col-12 col-md-8">
						<div class="list-testimonials">
							<?php while( have_rows('list_testimonials') ) : the_row();
								$text = get_sub_field('text');
								$author = get_sub_field('author');
							?>
								<div class="sub-col">
									<blockquote>
										<?php if ( $text ) : ?>
											<p><?php echo wp_kses_post( $text ); ?></p>
										<?php endif; ?>
										<?php if ( $author ) : ?>
											<cite><?php echo wp_kses_post( $author ); ?></cite>
										<?php endif; ?>
									</blockquote>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;

<?php
/**
 * Images Block Template.
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
$class_names    = array( 'images-section' );

if ( have_rows('list_images') ) :
?>
    <section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( get_section_class_names( $block, $class_names ) ); ?>">
        <div class="container">
            <div class="list-images row">
                <?php 
                $index = 1;
                while ( have_rows('list_images') ) : the_row();
                    $image = get_sub_field('image', false, false);

                    if ($image) :
                        $mod = ($index - 1) % 6;

                        if ($mod < 4) {
                            $crop_size = 'thumbnail_270';
                            $col_class = 'col-sm-3 col-6';
                        } else {
                            $crop_size = 'thumbnail_570';
                            $col_class = 'col-12 col-sm-6';
                        }
                ?>
                    <div class="image-holder <?php echo esc_attr($col_class); ?>">
                        <?php echo wp_get_attachment_image($image, $crop_size); ?>
                    </div>
                <?php 
                    endif; 
                    $index++;
                endwhile; 
                ?>
            </div>
        </div>
    </section>
<?php 
endif;



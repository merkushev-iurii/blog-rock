<?php
/**
 * Latest Articles Block Template.
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

$block_id      = get_section_id( $block );
$class_names   = array( 'latest-articles-section' );
$title         = get_field( 'title_section' );
$post_count    = get_field( 'latest_posts' ) ?: 4;
$post_type     = 'post'; 

$args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $post_count,
	'post_status'    => 'publish',
);

$query = new WP_Query( $args );

$total_posts = wp_count_posts( $post_type )->publish;


if ( $query->have_posts() ) :
?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( get_section_class_names( $block, $class_names ) ); ?>">
	<div class="container">
		<?php if ( $title ) : ?>
			<h2 class="h3 title"><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>
		
		<div class="latest-articles row">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="col col-12 col-md-6">
					<article class="article">
						<div class="sub-col">
							<div class="image-holder">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'thumbnail_235' ); ?>
								</a>
							</div>
						</div>
						<div class="sub-col">
							<div class="text-holder">
								<div class="post-tags">
									<?php the_tags( '', ' ', '' ); ?>
								</div>
								<h3 class="h5 article-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="article-meta">
									<span class="date">Added: <a href="<?php echo esc_url( get_date_archive_link() ); ?>" rel="bookmark"><?php echo get_the_date( 'j F Y' ); ?></a></span>
									<span class="comments"><a href="<?php echo esc_url( get_comments_link() ); ?>"> <span class="icon icon-comment"></span> <?php comments_number( '0', '1', '%' ); ?></a></span>
								</div>
								<div class="article-excerpt">
									<?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
								</div>
								<div class="author">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?>
									<a class="author-name" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"><?php the_author(); ?></a>
								</div>
							</div>
						</div>
					</article>
				</div>
			<?php endwhile; ?>
		</div>

		<?php
		if ( $total_posts > $post_count ) :
			?>
			<div class="view-all">
				<a class="btn btn-success" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn">View More Posts</a>
			</div>
		<?php endif; ?>

	</div>
</section>
<?php
endif;
wp_reset_postdata();
?>


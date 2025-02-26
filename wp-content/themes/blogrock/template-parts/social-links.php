<?php
/**
 * The template for displaying 'Social Links' ACF Repeater from theme options
 *
 * @package blogrock
 */

?>
<?php if ( have_rows( 'social_links', 'option' ) ) : ?>
	<nav class="social-links-wrapper" aria-label="<?php esc_html_e( 'Social links', 'blogrock' ); ?>">
		<ul class="social-links">
			<?php
			while ( have_rows( 'social_links', 'option' ) ) :
				the_row();
				$icon      = get_sub_field( 'icon' );
				$link      = get_sub_field( 'link' );
				if ( $icon && $link ) :
					?>
					<li>
						<a href="<?php echo esc_url($link['url']); ?>" 
					       target="<?php echo esc_attr($link['target'] ?: '_self'); ?>" 
					       rel="noreferrer noopener" 
					       title="<?php echo esc_attr($link['title']); ?>">
					       <?php echo wp_get_attachment_image( $icon, 'thumbnail' ); ?>
					       <span class="screen-reader-text"><?php echo esc_html($link['title']); ?></span>
					    </a>
					</li>
					<?php
				endif;
			endwhile;
			?>
		</ul>
	</nav>
<?php endif; ?>

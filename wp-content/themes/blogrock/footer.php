<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogrock
 */

?>

				</main>

				<?php
					$footer_logo      = get_theme_mod( 'footer_logo' );
					$footer_copyright = get_theme_mod( 'footer_copyright' );
					$footer_text      = get_field( 'footer_text', 'option');
				?>

				<footer id="footer" class="footer">
					<div class="container">
						<div class="holder">
							<div class="row">
								<div class="col-12 col-lg-6">
									<?php if ( $footer_logo ) : ?>
										<div class="footer-logo">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
												<?php echo wp_get_attachment_image( $footer_logo, 'medium' ); ?>
											</a>
										</div>
									<?php endif; ?>
									
									<?php if ( $footer_text ) : ?>
										<p class="text"><?php echo esc_html( $footer_text ); ?></p>
									<?php endif; ?>
									
									<?php get_template_part( 'template-parts/social-links' ); ?>
								</div>
								<div class="col-12 col-lg-6">
									<div class="row">
										<div class="col-12 col-lg-4">
								            <?php dynamic_sidebar('footer_col_1'); ?>
								        </div>
								        <div class="col-12 col-lg-4">
								            <?php dynamic_sidebar('footer_col_2'); ?>
								        </div>
								        <div class="col-12 col-lg-4">
								            <?php dynamic_sidebar('footer_col_3'); ?>
								        </div>
									</div>
								</div>
							</div>
						</div>

						<?php if ( $footer_copyright ) : ?>
							<p class="copyright"><?php echo esc_html( str_replace( '[year]', gmdate( 'Y' ), $footer_copyright ) ); ?></p>
						<?php endif; ?>
					</div>

				</footer>
			</div>
			<a class="screen-reader-text" href="#wrapper"><?php esc_html_e( 'Back to top', 'blogrock' ); ?></a>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>

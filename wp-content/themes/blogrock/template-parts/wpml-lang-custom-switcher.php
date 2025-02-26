<?php
/**
 * The template for displaying custom WPML language switcher links
 *
 * @link https://wpml.org/documentation/getting-started-guide/language-setup/language-switcher-options/custom-language-switcher/
 *
 * @package blogrock
 */

?>
<?php
if ( function_exists( 'icl_get_languages' ) ) :
	$languages = icl_get_languages();
	if ( $languages ) :
		?>
	<nav class="language-switcher" aria-label="<?php esc_attr_e( 'Language switcher', 'blogrock' ); ?>">
		<ul class="languages-links">
			<?php foreach ( $languages as $lang ) : ?>
				<li
				<?php
				if ( $lang['active'] ) :
					echo ' class="active";';
				endif;
				?>
				>
					<a href="<?php echo esc_url( $lang['url'] ); ?>" title="<?php echo esc_attr( $lang['native_name'] ); ?>">
						<?php echo esc_html( $lang['code'] ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
		<?php
	endif;
endif;

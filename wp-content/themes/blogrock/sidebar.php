<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogrock
 */

?>
<?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?>
	<aside class="sidebar">
		<?php dynamic_sidebar( 'default-sidebar' ); ?>
	</aside>
<?php endif; ?>

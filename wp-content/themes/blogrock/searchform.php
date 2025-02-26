<?php
/**
 * Template for displaying search form
 *
 * @package blogrock
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'blogrock' ); ?></span>
		<input type="search" class="search-field"
			placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'blogrock' ); ?>"
			value="<?php echo get_search_query(); ?>" name="s"
			title="<?php echo esc_attr_x( 'Search for:', 'label', 'blogrock' ); ?>" />
	</label>
	<input type="submit" class="search-submit"
		value="<?php echo esc_attr_x( 'Search', 'submit button', 'blogrock' ); ?>" />
</form>

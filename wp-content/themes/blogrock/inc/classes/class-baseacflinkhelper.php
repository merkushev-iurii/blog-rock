<?php
/**
 * Contains 'BaseACFLinkHelper' class.
 *
 * @package blogrock
 */

if ( ! class_exists( 'BaseACFLinkHelper' ) ) {
	/**
	 * BaseACFLinkHelper
	 *
	 * Helper class for ACF link field.
	 * Code example:
	 * if ( BaseACFLinkHelper::is_link( $link ) ) BaseACFLinkHelper::the_link( $link, array( 'btn', 'btn-primary' ) );
	 */
	class BaseACFLinkHelper {
		/**
		 * Determines if a variable is an link array.
		 *
		 * @param array $link ACF link field array.
		 * @return boolean
		 */
		public static function is_link( $link ) {
			if ( is_array( $link ) && ! empty( $link['url'] ) && ! empty( $link['title'] ) ) {
				return true;
			}
			return false;
		}

		/**
		 * Returns link HTML code.
		 *
		 * @param array $link    ACF link field array.
		 * @param array $classes Link CSS classes array.
		 * @return string
		 */
		public static function get_link( $link, $classes = array() ) {
			if ( ! self::is_link( $link ) ) {
				return false;
			}

			$_url                   = $link['url'];
			$_title                 = $link['title'];
			$link_attributes        = array();
			$link_attributes_string = '';
			if ( ! empty( $classes ) ) {
				$link_attributes['class'] = implode( ' ', $classes );
			}

			if ( ! empty( $link['target'] ) ) {
				$link_attributes['target'] = '_blank';
				$link_attributes['rel']    = 'noreferrer noopener';
			}

			if ( $link_attributes ) {
				foreach ( $link_attributes as $key => $value ) {
					$link_attributes_string .= ' ' . $key . '="' . esc_attr( $value ) . '"';
				}
			}

			$output = '<a href="' . esc_url( $_url ) . '"' . $link_attributes_string . '>' . esc_html( $_title ) . '</a>';
			return $output;
		}

		/**
		 * Print link HTML code.
		 *
		 * @param array $link    ACF link field array.
		 * @param array $classes Link CSS classes array.
		 */
		public static function the_link( $link, $classes = array() ) {
			echo wp_kses_post( self::get_link( $link, $classes ) );
		}
	}
}

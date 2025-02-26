<?php
/**
 * Part of the template that displays pagination navigation for archive pages
 *
 * @package blogrock
 */

the_posts_pagination(
	array(
		'prev_text' => esc_html__( 'Previous page', 'blogrock' ),
		'next_text' => esc_html__( 'Next page', 'blogrock' ),
	)
);

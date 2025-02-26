<?php
/**
 * Links to previous/next posts
 *
 * @package blogrock
 */

the_post_navigation(
	array(
		'prev_text' => '<span class="nav-subtitle"><span class="icon icon-arrow-left-in"></span>' . esc_html__( 'Previous Article', 'blogrock' ) . '</span> <span class="nav-title">%title</span>',
		'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Article', 'blogrock' ) . '<span class="icon icon-arrow-right-in"></span></span> <span class="nav-title">%title</span>',
	)
);

<?php
/**
 * Load more
 *
 * @package blogrock
 */

/**
 * Load More
 */

function load_more_posts() {
    if (!isset($_POST['page'])) {
        wp_send_json_error('Invalid request');
        wp_die();
    }

    $paged = intval($_POST['page']) + 1;
    $query_args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'paged'          => $paged,
        'posts_per_page' => get_option('posts_per_page'),
    );

    $query = new WP_Query($query_args);

    if ($query->have_posts()) :
        ob_start();
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/content/content', get_post_type());
        endwhile;
        wp_reset_postdata();
        $html = ob_get_clean();
        wp_send_json_success($html);
    else :
        wp_send_json_error('No more posts');
    endif;

    wp_die();
}
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');


function enqueue_load_more_script() {
    wp_enqueue_script('load-more', get_template_directory_uri() . '/js/load-more.js', array('jquery'), null, true);
    wp_localize_script('load-more', 'ajax_params', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_load_more_script');

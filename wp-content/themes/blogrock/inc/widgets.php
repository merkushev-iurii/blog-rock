<?php
/**
 * Theme custom widgets registration.
 *
 * @package blogrock
 */

/**
 * Registers custom widgets.
 *
 * @return void
 */
function blogrock_register_widgets() {
	register_widget( 'Widget_Recent_Posts_From_Category' );
}

add_action( 'widgets_init', 'blogrock_register_widgets' );

class Latest_Posts_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'latest_posts_widget',
            'Custom latest posts', 
            array( 'description' => 'latest 3 posts' ) 
        );
    }

    public function widget( $args, $instance ) {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post_status' => 'publish',
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :
            echo isset($args['before_widget']) ? $args['before_widget'] : '<div class="widget-latest-articles">';
            
            if ( ! empty( $instance['title'] ) ) :
                echo isset($args['before_title']) ? $args['before_title'] : '<h6 class="widget-title">';
                echo apply_filters( 'widget_title', $instance['title'] );
                echo isset($args['after_title']) ? $args['after_title'] : '</h6>';
            endif;

            echo '<ul class="latest-posts-list">';

            while ( $query->have_posts() ) : $query->the_post();
                ?>
                <li class="latest-post">
                    <div class="post-tags">
                        <?php the_tags( '', ' ', '' ); ?>
                    </div>
                    <h4 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </li>
                <?php
            endwhile;

            echo '</ul>';
            echo isset($args['after_widget']) ? $args['after_widget'] : '</div>';

        endif;

        wp_reset_postdata();
    }

    public function form( $instance ) {
        if ( isset( $instance['title'] ) ) :
            $title = $instance['title'];
        else :
            $title = __( 'Latest posts', 'blogrock' );
        endif;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        return $instance;
    }

}

function register_latest_posts_widget() {
    register_widget( 'Latest_Posts_Widget' );
}
add_action( 'widgets_init', 'register_latest_posts_widget' );

<?php
/**
 * Contains 'Widget_Recent_Posts_From_Category' class.
 *
 * @package blogrock
 */

if ( ! class_exists( 'Widget_Recent_Posts_From_Category' ) ) {

	/**
	 * Custom widget 'Recent Posts From Specific Category'.
	 */
	class Widget_Recent_Posts_From_Category extends WP_Widget {
		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'widget_recent_entries_from_category',
				'description' => __( 'The most recent posts from specific category on your site', 'blogrock' ),
			);
			parent::__construct( 'recent-posts-from-category', __( 'Recent Posts From Specific Category', 'blogrock' ), $widget_ops );
			$this->alt_option_name = 'widget_recent_entries_from_category';

			add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
			add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
			add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {
			$cache = wp_cache_get( 'widget_recent_posts_from_category', 'widget' );

			if ( ! is_array( $cache ) ) {
				$cache = array();
			}

			if ( isset( $cache[ $args['widget_id'] ] ) ) {
				echo $cache[ $args['widget_id'] ];

				return;
			}

			ob_start();
			extract( $args );

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Posts', 'blogrock' ) : $instance['title'], $instance, $this->id_base );

			$number = absint( $instance['number'] );
			if ( ! $number ) {
				$number = 10;
			}

			$r = new WP_Query(
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'cat'                 => $instance['cat'],
				)
			);
			if ( $r->have_posts() ) :
				echo $before_widget;
				if ( $title ) {
					echo $before_title . esc_html( $title ) . $after_title;
				}
				?>
				<ul>
					<?php
					while ( $r->have_posts() ) :
						$r->the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php
				echo $after_widget;
				wp_reset_postdata();
			endif;

			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_posts_from_category', $cache, 'widget' );
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance           = $old_instance;
			$instance['title']  = wp_strip_all_tags( $new_instance['title'] );
			$instance['number'] = (int) $new_instance['number'];
			$instance['cat']    = (int) $new_instance['cat'];
			$this->flush_widget_cache();
			$alloptions = wp_cache_get( 'alloptions', 'options' );

			if ( isset( $alloptions['widget_recent_entries_from_category'] ) ) {
				delete_option( 'widget_recent_entries_from_category' );
			}

			return $instance;
		}

		/**
		 * Flush widget cache.
		 *
		 * @return void
		 */
		public function flush_widget_cache() {
			wp_cache_delete( 'widget_recent_posts_from_category', 'widget' );
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
			$cat    = isset( $instance['cat'] ) ? $instance['cat'] : 0;
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<?php esc_html_e( 'Title:', 'blogrock' ); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label>
					<?php
					esc_html_e( 'Category:', 'blogrock' );
					wp_dropdown_categories(
						array(
							'name'     => $this->get_field_name( 'cat' ),
							'selected' => $cat,
						)
					);
					?>
				</label>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
					<?php esc_html_e( 'Number of posts to show:', 'blogrock' ); ?>
				</label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php echo esc_attr( $number ); ?>" size="3" />
			</p>
			<?php
		}
	}

}

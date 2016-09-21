<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/**
 * Modify WP Recent Post widget class
 * 
 */
if ( !class_exists( 'Shadower_WP_Widget_Recent_Posts' ) ) {
	
	class Shadower_WP_Widget_Recent_Posts extends WP_Widget {
		/**
		 * Sets up a new Recent Posts widget instance.
		 *
		 * @since 2.8.0
		 * @access public
		 */
		public function __construct() {
			$widget_ops = array(
				'classname' => 'widget_recent_entries',
				'description' => shadower_wp_kses( __( 'Your site&#8217;s most recent Posts.', 'shadower' ) ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'recent-posts', shadower_wp_kses( __( 'Recent Posts', 'shadower' ) ), $widget_ops );
			$this->alt_option_name = 'widget_recent_entries';
		}
		/**
		 * Outputs the content for the current Recent Posts widget instance.
		 *
		 * @since 2.8.0
		 * @access public
		 *
		 * @param array $args     Display arguments including 'before_title', 'after_title',
		 *                        'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current Recent Posts widget instance.
		 */
		public function widget( $args, $instance ) {
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}
			$title = ( ! empty( $instance['title'] ) ) ? shadower_wp_kses( $instance['title'] ) : shadower_wp_kses( __( 'Recent Posts', 'shadower' ) );
			/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
			$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
			if ( ! $number )
				$number = 5;
			$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
			/**
			 * Filter the arguments for the Recent Posts widget.
			 *
			 * @since 3.4.0
			 *
			 * @see WP_Query::get_posts()
			 *
			 * @param array $args An array of arguments used to retrieve the recent posts.
			 */
			$r = new WP_Query( apply_filters( 'widget_posts_args', array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			) ) );
			if ($r->have_posts()) :
			?>
			<?php echo $args['before_widget']; ?>
			<?php if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			} ?>
			<ul class="post-img-list-box">
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>                          
				<li>
            
                     <?php if ( has_post_thumbnail() ) { ?>
                     
                          <div class="item-thumb">
                               <a class="featured-image" href="<?php echo esc_url( get_permalink() ); ?>" >
                    
								<?php
                                // Display post thumbnail
                                the_post_thumbnail( 'post-thumbnail', array(
                                    'alt'         => esc_attr( get_the_title() ),
                                    'data-retina' => esc_url( wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-retina-thumbnail' )[0] ),
                                    
                                ) ); 
                                ?>
        
                                </a>
                           </div>
                       
                     <?php } ?>

                    <div class="item-info <?php if ( !has_post_thumbnail() ) echo esc_attr( 'no-image' ); ?>">
                        <div class="item-title">
                            <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                        </div>
						
                         <div class="item-date"><?php echo shadower_wp_kses( get_the_date() ); ?></div>
                       
                    </div>
				</li>
			<?php endwhile; ?>
			</ul>
			<?php echo $args['after_widget']; ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
			endif;
		}
		/**
		 * Handles updating the settings for the current Recent Posts widget instance.
		 *
		 * @since 2.8.0
		 * @access public
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            WP_Widget::form().
		 * @param array $old_instance Old settings for this instance.
		 * @return array Updated settings to save.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['number'] = (int) $new_instance['number'];
			$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
			return $instance;
		}
		/**
		 * Outputs the settings form for the Recent Posts widget.
		 *
		 * @since 2.8.0
		 * @access public
		 *
		 * @param array $instance Current settings.
		 */
		public function form( $instance ) {
			$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
			$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
	?>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo shadower_wp_kses( __( 'Title:', 'shadower' ) ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
	
			<p>
                <label for="<?php echo esc_attr($this->get_field_id( 'number' ) ); ?>"><?php echo shadower_wp_kses( __( 'Number of posts to show:', 'shadower' ) ); ?></label>
                <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
            </p>
	
			<p>
                <input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
                <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php echo shadower_wp_kses( __( 'Display post date?', 'shadower' ) ); ?></label>
            </p>
	<?php
		}
	}

	
}

<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/**
 * Widget for displaying Social Media Buttons
 *
 */
if ( !class_exists( 'Shadower_SocialMedia_Buttons_Widget' ) ) {
	
	class Shadower_SocialMedia_Buttons_Widget extends WP_Widget {
	
	
		public function __construct() {
			$widget_ops = array(
				'classname' => 'widget_social_icons',
				'description' => shadower_wp_kses( __( 'Add social media buttons for your site.', 'shadower' ) ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'social_icons', shadower_wp_kses( __( 'Social Media Buttons', 'shadower' ) ), $widget_ops );
		}
		
	
	
		/**
		 * Output the HTML for this widget.
		 *
		 */
		public function widget( $args, $instance ) {
			
			$title  = apply_filters( 'widget_title', !isset( $instance['title'] ) ? shadower_wp_kses( __( 'Follow Us', 'shadower' ) ) : $instance['title'], $instance, $this->id_base );
	
			echo $args['before_widget'];
			?>
			 <?php
			 if ( !empty( $title ) ) {
				echo $args['before_title'] . shadower_wp_kses( $title ) . $args['after_title'];
			 }
			 ?>
			<div class="social-list social-footer">
				<ul>
					<?php shadower_social_buttons(); ?>
				</ul>
	
			</div>
			<?php
	
			echo $args['after_widget'];
	
		}
	
		/**
		 * Deal with the settings when they are saved by the admin.
		 *
		 * Here is where any validation should happen.
		 *
		 */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
	
			return $instance;
		}
	
		/**
		 * Display the form for this widget on the Widgets page of the Admin area.
		 *
		 */
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => shadower_wp_kses( __( 'Follow Us', 'shadower' ) ) ) );
			$title    = sanitize_text_field( $instance['title'] );
			?>
				<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo shadower_wp_kses( __( 'Title:', 'shadower' ) ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
		   
				<p><?php printf( shadower_wp_kses( __( 'Edit your social media buttons by going to <a href="%1$s"><strong>Appearance &raquo; Customize</strong></a>.', 'shadower' ) ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>
	
			<?php
		}
	}

	
}
 
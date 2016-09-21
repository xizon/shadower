<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}



/**
 * Widget for displaying Google Map Section
 *
 */
if ( !class_exists( 'Shadower_Map_Widget' ) ) {
	
	class Shadower_Map_Widget extends WP_Widget {
	
		public function __construct() {
			$widget_ops = array(
				'classname' => 'widget_map_section',
				'description' => shadower_wp_kses( __( 'Add a google map section for your site.', 'shadower' ) ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'map_section', shadower_wp_kses( __( 'Home Section: Google Map', 'shadower' ) ), $widget_ops );
		}
	
	
	
		//Output the HTML for this widget.
		public function widget( $args, $instance ) {
			
			global $default_data;
			$widget_demodata_map = $default_data[ 'sc-home-sections' ][ 'map' ];
			
			$content = isset( $instance['content'] ) ? shadower_wp_kses( $instance['content'] ) : $widget_demodata_map;
			$content = ! empty( $instance['filter'] ) ? do_shortcode( wpautop( $content ) ) : do_shortcode( $content );
			
			echo $args['before_widget'];
			?>
			<?php echo do_shortcode( "{$content}" ); ?>
			<?php
	
			echo $args['after_widget'];
			
			//WP menu title of anchor link
			echo "\n".'<div data-homepage-widgets-title="'.esc_attr__( 'Contact', 'shadower' ).'"></div>'."\n<!-- ".shadower_wp_kses( __( 'End Section', 'shadower' ) )." -->\n\n";
	
		}
	
		//Deal with the settings when they are saved by the admin.
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['content'] = $new_instance['content'];
			$instance['filter'] = ! empty( $new_instance['filter'] );
			return $instance;
		}
	
		//Display the form for this widget on the Widgets page of the Admin area. 
		function form( $instance ) {
			global $default_data;
			$widget_demodata_map = $default_data[ 'sc-home-sections' ][ 'map' ];
			$instance = wp_parse_args( (array) $instance, array( 'content' => '' ) );
			$filter   = isset( $instance['filter'] ) ? $instance['filter'] : 0;
			$content  = $instance['content'];	
		
			?>
	
				<p><label for="<?php echo esc_attr( $this->get_field_id('content') ); ?>"><?php echo shadower_wp_kses( __( 'Content (Support HTML tags):', 'shadower' ) ); ?></label></p>
				
				<?php if ( class_exists( 'UixShortcodes' ) ) { ?>
				<p>
				<a href="javascript:" class="custom-button uix_sc_map-widget_btn" data-target="<?php echo esc_attr( $this->get_field_id('content') ); ?>"><i class="dashicons dashicons-plus"></i><?php echo shadower_wp_kses( __( 'Add new', 'shadower' ) ); ?></a>
				<a href="javascript:" class="custom-button insert-demo-btn" data-demo-id="demo-content-<?php echo esc_attr( $this->get_field_id('content') ); ?>" data-target="<?php echo esc_attr( $this->get_field_id('content') ); ?>"><i class="dashicons dashicons-desktop"></i><?php echo shadower_wp_kses( __( 'Demo content', 'shadower' ) ); ?></a>
				
				</p>
				<?php } ?>
	
				<p>
				   <textarea style="display:none" id="demo-content-<?php echo esc_attr( $this->get_field_id('content') ); ?>"><?php echo $widget_demodata_map; ?></textarea>
				   <textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr( $this->get_field_id('content') ); ?>" name="<?php echo esc_attr( $this->get_field_name('content') ); ?>"><?php echo $content; ?></textarea>
				</p>
				<p style="display:none"><input id="<?php echo esc_attr( $this->get_field_id('filter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('filter') ); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo esc_attr( $this->get_field_id('filter') ); ?>"><?php echo shadower_wp_kses( __( 'Auto Paragraph', 'shadower' ) ); ?></label></p>   
	
			<?php
		}
	}

	
}	 


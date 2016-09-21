<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 * Modify WP Categories widget class
 * 
 */
if ( !class_exists( 'Shadower_WP_Widget_Categories' ) ) {
	
	class Shadower_WP_Widget_Categories extends WP_Widget {
	
		function __construct() {
			$widget_ops = array( 
				'classname' => 'widget_categories', 
				'description' => shadower_wp_kses( __( 'A list or dropdown of categories', 'shadower'  ) )
			);
			parent::__construct( 'categories', shadower_wp_kses( __( 'Categories', 'shadower' ) ), $widget_ops);
		}
	
		function widget( $args, $instance ) {
		 
			$title = apply_filters('widget_title', empty( $instance['title'] ) ? shadower_wp_kses( __( 'Categories', 'shadower'  ) ) : shadower_wp_kses( $instance['title'] ), $instance, $this->id_base);
			$c = ! empty( $instance['count'] ) ? '1' : '0';
			$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
			$d = ! empty( $instance['dropdown'] ) ? '1' : '0';
	
			echo $args['before_widget'];
			if ( $title )
				echo $args['before_title'] . $title . $args['after_title'];
	
			$cat_args = array('orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h );
			if ( $d ) {
				$cat_args['show_option_none'] = shadower_wp_kses( __( 'Select Category', 'shadower' ) );
				wp_dropdown_categories(apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
				
				echo '
				<script>
					var dropdown = document.getElementById("cat");
					function onCatChange() {
						if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
							location.href = "'.home_url().'/?cat="+dropdown.options[dropdown.selectedIndex].value;
						}
					}
					dropdown.onchange = onCatChange;
				</script>
				';
	
			} else {
	
				echo '<ul class="link-list">';
	
				$cat_args['title_li'] = '';
				
				wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
	
				echo '</ul>';
			}
	
			echo $args['after_widget'];
		}
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
			$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
			$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;
	
			return $instance;
		}
	
		function form( $instance ) {
			//Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
			$title = esc_attr( $instance['title'] );
			$count = isset($instance['count']) ? (bool) $instance['count'] :false;
			$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
			$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
	?>
			<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo shadower_wp_kses( __( 'Title:', 'shadower' ) ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
	
			<p>
                <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dropdown' ) ); ?>"<?php checked( $dropdown ); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>"><?php echo shadower_wp_kses( __( 'Display as dropdown', 'shadower'  ) ); ?></label>
                <br />
        
                <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>"<?php checked( $count ); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php echo shadower_wp_kses( __( 'Show post counts', 'shadower'  ) ); ?></label>
                <br />
        
                <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hierarchical' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hierarchical' ) ); ?>"<?php checked( $hierarchical ); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'hierarchical' ) ); ?>"><?php echo shadower_wp_kses( __( 'Show hierarchy', 'shadower'  ) ); ?></label>
            </p>
	<?php	
		
		}
	
	} 

	
}



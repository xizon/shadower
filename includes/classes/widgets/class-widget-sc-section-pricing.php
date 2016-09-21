<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 * Widget for displaying Pricing Section
 *
 */
if ( !class_exists( 'Shadower_Pricing_Widget' ) ) {
	
	class Shadower_Pricing_Widget extends WP_Widget {
	
		public function __construct() {
			$widget_ops = array(
				'classname' => 'widget_pricing_section',
				'description' => shadower_wp_kses( __( 'Add a pricing section for your site.', 'shadower' ) ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'pricing_section', shadower_wp_kses( __( 'Home Section: Pricing', 'shadower' ) ), $widget_ops );
		}
	
	
	
		//Output the HTML for this widget.
		public function widget( $args, $instance ) {
			
			global $default_data;
			$widget_demodata_pricing = $default_data[ 'sc-home-sections' ][ 'pricing' ];
			
	
			$title  = apply_filters( 'widget_title', !isset( $instance['title'] ) ? ''.shadower_wp_kses( __( 'Our Pricing', 'shadower' ) ).'' : $instance['title'], $instance, $this->id_base );
			$title  = !empty( $title ) ? $args['before_title'] . '<div class="widget_section_heading">'.shadower_wp_kses( $title ).'</div><div class="widget_section_hr"></div>' . $args['after_title'] : '';
			$desc = isset( $instance['desc'] ) ? '<div class="widget_section_subheading">'.shadower_wp_kses( $instance['desc'] ).'</div>' : '<div class="widget_section_subheading">'.shadower_wp_kses( __( 'This is a description of the section.', 'shadower' ) ).'</div>';
			$content = isset( $instance['content'] ) ? shadower_wp_kses( $instance['content'] ) : $widget_demodata_pricing;
			$content = ! empty( $instance['filter'] ) ? do_shortcode( wpautop( $content ) ) : do_shortcode( $content );
			
			echo $args['before_widget'];
			?>
			<?php echo do_shortcode( "
	[uix_container parallax='0' class='' width='".Shadower_UixShortcodes_Loader::container_width()."px' height='auto' margin_top='25' margin_bottom='25' margin_left='0' margin_right='0' padding_top='0' padding_bottom='0' padding_left='25' padding_right='25' bgcolor='' layout='center' ]
	{$title}
	{$desc}
	{$content}
	[/uix_container]
			" ); ?>
			<?php
	
			echo $args['after_widget'];
			
			//WP menu title of anchor link
			echo "\n".'<div data-homepage-widgets-title="'.esc_attr__( 'Pricing', 'shadower' ).'"></div>'."\n<!-- ".shadower_wp_kses( __( 'End Section', 'shadower' ) )." -->\n\n";
	
		}
	
		//Deal with the settings when they are saved by the admin.
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			if ( current_user_can( 'unfiltered_html' ) ) {
				$instance['desc'] = $new_instance['desc'];
			} else {
				$instance['desc'] = wp_kses_post( $new_instance['desc'] );
			}
			$instance['content'] = $new_instance['content'];
			$instance['filter'] = ! empty( $new_instance['filter'] );
			return $instance;
		}
	
		//Display the form for this widget on the Widgets page of the Admin area. 
		function form( $instance ) {
			global $default_data;
			$widget_demodata_pricing = $default_data[ 'sc-home-sections' ][ 'pricing' ];
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'desc' => '', 'content' => '' ) );
			$filter   = isset( $instance['filter'] ) ? $instance['filter'] : 0;
			$title    = sanitize_text_field( $instance['title'] );
			$desc     = esc_textarea( $instance['desc'] );
			$content  = $instance['content'];	
		
			?>
	
				<div class="custom-tab-group" id="custom-tab-group-<?php echo $this->id; ?>">
					<ul class="group_control">
						<li><a href="#"><i class="dashicons dashicons-warning"></i><?php echo shadower_wp_kses( __( 'Section Info', 'shadower' ) ); ?></a></li>
						<li><a href="#"><i class="dashicons dashicons-format-aside"></i><?php echo shadower_wp_kses( __( 'Content', 'shadower' ) ); ?></a></li>
					</ul>
					<div class="item">
						<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php echo shadower_wp_kses( __( 'Heading:', 'shadower' ) ); ?></label>
						<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
			 
						<p><label for="<?php echo esc_attr( $this->get_field_id('desc') ); ?>"><?php echo shadower_wp_kses( __( 'Subheading:', 'shadower' ) ); ?></label>
						   <textarea class="widefat" rows="3" cols="20" id="<?php echo esc_attr( $this->get_field_id('desc') ); ?>" name="<?php echo esc_attr( $this->get_field_name('desc') ); ?>"><?php echo $desc; ?></textarea>
						</p> 
					</div>
					<div class="item">
						<p><label for="<?php echo esc_attr( $this->get_field_id('content') ); ?>"><?php echo shadower_wp_kses( __( 'Content (Support HTML tags):', 'shadower' ) ); ?></label></p>
						
						<?php if ( class_exists( 'UixShortcodes' ) ) { ?>
						<p>
						<a href="javascript:" class="custom-button uix_sc_form_pricing_col3-widget_btn" data-target="<?php echo esc_attr( $this->get_field_id('content') ); ?>"><i class="dashicons dashicons-plus"></i><?php echo shadower_wp_kses( __( 'Add new', 'shadower' ) ); ?></a>
						<a href="javascript:" class="custom-button insert-demo-btn" data-demo-id="demo-content-<?php echo esc_attr( $this->get_field_id('content') ); ?>" data-target="<?php echo esc_attr( $this->get_field_id('content') ); ?>"><i class="dashicons dashicons-desktop"></i><?php echo shadower_wp_kses( __( 'Demo content', 'shadower' ) ); ?></a>
						
						</p>
						<?php } ?>
			 
						<p>
						   <textarea style="display:none" id="demo-content-<?php echo esc_attr( $this->get_field_id('content') ); ?>"><?php echo $widget_demodata_pricing; ?></textarea>
						   <textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr( $this->get_field_id('content') ); ?>" name="<?php echo esc_attr( $this->get_field_name('content') ); ?>"><?php echo $content; ?></textarea>
						</p>
						<p style="display:none"><input id="<?php echo esc_attr( $this->get_field_id('filter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('filter') ); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo esc_attr( $this->get_field_id('filter') ); ?>"><?php echo shadower_wp_kses( __( 'Auto Paragraph', 'shadower' ) ); ?></label></p>   
						
					
					</div>
				</div>
				<script type="text/javascript">
				 jQuery(document).ready(function($) {
					$( document ).m_tabs();
				 });
				</script>  
	 
			<?php
		}
	}
	
	
}	 
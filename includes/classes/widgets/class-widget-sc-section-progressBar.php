<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 * Widget for displaying Progress Bar Section
 *
 */
if ( !class_exists( 'Shadower_ProgressBar_Widget' ) ) {
	
	class Shadower_ProgressBar_Widget extends WP_Widget {
	
		public function __construct() {
			$widget_ops = array(
				'classname' => 'widget_progressbar_section',
				'description' => shadower_wp_kses( __( 'Add a progress bar section for your site.', 'shadower' ) ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'progressbar_section', shadower_wp_kses( __( 'Home Section: Progress Bar', 'shadower' ) ), $widget_ops );
		}
	
	
	
		//Output the HTML for this widget.
		public function widget( $args, $instance ) {
			
			global $default_data;
			$widget_demodata_progressbar_1 = $default_data[ 'sc-home-sections' ][ 'progressbar' ][ 'one' ];
			$widget_demodata_progressbar_2 = $default_data[ 'sc-home-sections' ][ 'progressbar' ][ 'two' ];
			$widget_demodata_progressbar_3 = $default_data[ 'sc-home-sections' ][ 'progressbar' ][ 'three' ];
			$widget_demodata_progressbar_4 = $default_data[ 'sc-home-sections' ][ 'progressbar' ][ 'four' ];
	
			$title  = apply_filters( 'widget_title', !isset( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$title  = !empty( $title ) ? $args['before_title'] . '<div class="widget_section_heading">'.shadower_wp_kses( $title ).'</div><div class="widget_section_hr"></div>' . $args['after_title'] : '';
			$desc = isset( $instance['desc'] ) ? '<div class="widget_section_subheading">'.shadower_wp_kses( $instance['desc'] ).'</div>' : '';
			
			$content_1 = isset( $instance['content_1'] ) ? shadower_wp_kses( $instance['content_1'] ) : $widget_demodata_progressbar_1;
			$content_1 = ! empty( $instance['filter'] ) ? wpautop( $content_1 ) : $content_1;
			$content_2 = isset( $instance['content_2'] ) ? shadower_wp_kses( $instance['content_2'] ) : $widget_demodata_progressbar_2;
			$content_2 = ! empty( $instance['filter'] ) ? wpautop( $content_2 ) : $content_2;
			$content_3 = isset( $instance['content_3'] ) ? shadower_wp_kses( $instance['content_3'] ) : $widget_demodata_progressbar_3;
			$content_3 = ! empty( $instance['filter'] ) ? wpautop( $content_3 ) : $content_3;
			$content_4 = isset( $instance['content_4'] ) ? shadower_wp_kses( $instance['content_4'] ) : $widget_demodata_progressbar_4;
			$content_4 = ! empty( $instance['filter'] ) ? wpautop( $content_4 ) : $content_4;
			
			$content_1_counter = ! empty( $content_1 ) ? 1 : 0;
			$content_2_counter = ! empty( $content_2 )  ? 1 : 0;
			$content_3_counter = ! empty( $content_3 )  ? 1 : 0;
			$content_4_counter = ! empty( $content_4 )  ? 1 : 0;
			$grid = $content_1_counter + $content_2_counter + $content_3_counter + $content_4_counter;
	
			$col_grid = 12;
			if ( $grid == 4 ) $col_grid = 3;
			if ( $grid == 3 ) $col_grid = 4;
			if ( $grid == 2 ) $col_grid = 6;
			
			$colwrapper_before = "[uix_column_wrapper top='20' bottom='20' left='0' right='0']";
			$colwrapper_after = "[/uix_column_wrapper]";
			$col_before = "[uix_column grid='{$col_grid}']";
			$col_after = "[/uix_column]";
	
			
			$content_1 = ! empty( $content_1 ) ? $col_before.$content_1.$col_after : '';
			$content_2 = ! empty( $content_2 ) ? $col_before.$content_2.$col_after : '';
			$content_3 = ! empty( $content_3 ) ? $col_before.$content_3.$col_after : '';
			$content_4 = ! empty( $content_4 ) ? $col_before.$content_4.$col_after : '';
		
			$content_all = do_shortcode( $colwrapper_before.$content_1.$content_2.$content_3.$content_4.$colwrapper_after );
			
			//Returns last tag
			$matchCount = preg_match("#(?s)<div class=\"uix-sc-col-{$col_grid}(?!.*<div class=\"uix-sc-col-{$col_grid}).+</div>#", $content_all, $result);
			if ( $matchCount > 0 ) {
				$content_col_last = $result[0];
				$content_col_newlast = str_replace( "<div class=\"uix-sc-col-{$col_grid}", "<div class=\"uix-sc-col-{$col_grid} uix-sc-col-last", $content_col_last );
				$content_all = str_replace( $content_col_last, $content_col_newlast, $content_all );
			} 
			
			
			echo $args['before_widget'];
			
			?>
			<?php 
	
			?>
			<?php echo do_shortcode( "
	[uix_container parallax='0' class='' width='".Shadower_UixShortcodes_Loader::container_width()."px' height='auto' margin_top='25' margin_bottom='25' margin_left='0' margin_right='0' padding_top='0' padding_bottom='0' padding_left='25' padding_right='25' bgcolor='' layout='center' ]
	{$title}
	{$desc}
	{$content_all}
	[/uix_container]
			" ); 
			?>
			<?php
	
			echo $args['after_widget'];
	
			//WP menu title of anchor link
			echo "\n".'<div data-homepage-widgets-title="'.esc_attr__( 'Skills', 'shadower' ).'"></div>'."\n<!-- ".shadower_wp_kses( __( 'End Section', 'shadower' ) )." -->\n\n";
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
			$instance['content_1'] = $new_instance['content_1'];
			$instance['content_2'] = $new_instance['content_2'];
			$instance['content_3'] = $new_instance['content_3'];
			$instance['content_4'] = $new_instance['content_4'];
			$instance['filter'] = ! empty( $new_instance['filter'] );
			return $instance;
		}
	
		//Display the form for this widget on the Widgets page of the Admin area. 
		function form( $instance ) {
			global $default_data;
			$widget_demodata_progressbar_1 = $default_data[ 'sc-home-sections' ][ 'progressbar' ][ 'one' ];
			$widget_demodata_progressbar_2 = $default_data[ 'sc-home-sections' ][ 'progressbar' ][ 'two' ];
			$widget_demodata_progressbar_3 = $default_data[ 'sc-home-sections' ][ 'progressbar' ][ 'three' ];
			$widget_demodata_progressbar_4 = $default_data[ 'sc-home-sections' ][ 'progressbar' ][ 'four' ];
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'desc' => '', 'content_1' => '', 'content_2' => '', 'content_3' => '', 'content_4' => '' ) );
			$filter   = isset( $instance['filter'] ) ? $instance['filter'] : 0;
			$title    = sanitize_text_field( $instance['title'] );
			$desc     = esc_textarea( $instance['desc'] );
			$content_1  = $instance['content_1'];
			$content_2  = $instance['content_2'];
			$content_3  = $instance['content_3'];
			$content_4  = $instance['content_4'];
		
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
						
	
			 
						<p>
						   <div class="label-block">
								<?php if ( class_exists( 'UixShortcodes' ) ) { ?>
								<a href="javascript:" class="custom-button uix_sc_form_bar-widget_btn" data-target="<?php echo esc_attr( $this->get_field_id('content_1') ); ?>"><i class="dashicons dashicons-plus"></i><?php echo shadower_wp_kses( __( 'Add new', 'shadower' ) ); ?></a>
								<a href="javascript:" class="custom-button insert-demo-btn" data-demo-id="demo-content-<?php echo esc_attr( $this->get_field_id('content_1') ); ?>" data-target="<?php echo esc_attr( $this->get_field_id('content_1') ); ?>"><i class="dashicons dashicons-desktop"></i><?php echo shadower_wp_kses( __( 'Demo content', 'shadower' ) ); ?></a>
								<?php } ?>
						   </div>
						   <textarea style="display:none" id="demo-content-<?php echo esc_attr( $this->get_field_id('content_1') ); ?>"><?php echo $widget_demodata_progressbar_1; ?></textarea>
						   <textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr( $this->get_field_id('content_1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('content_1') ); ?>"><?php echo $content_1; ?></textarea>
						  
						   
						</p>
						
						<p>
						   <div class="label-block">
								<?php if ( class_exists( 'UixShortcodes' ) ) { ?>
								<a href="javascript:" class="custom-button uix_sc_form_bar-widget_btn" data-target="<?php echo esc_attr( $this->get_field_id('content_2') ); ?>"><i class="dashicons dashicons-plus"></i><?php echo shadower_wp_kses( __( 'Add new', 'shadower' ) ); ?></a>
								<a href="javascript:" class="custom-button insert-demo-btn" data-demo-id="demo-content-<?php echo esc_attr( $this->get_field_id('content_2') ); ?>" data-target="<?php echo esc_attr( $this->get_field_id('content_2') ); ?>"><i class="dashicons dashicons-desktop"></i><?php echo shadower_wp_kses( __( 'Demo content', 'shadower' ) ); ?></a>
								<?php } ?>
						   </div>
						   <textarea style="display:none" id="demo-content-<?php echo esc_attr( $this->get_field_id('content_2') ); ?>"><?php echo $widget_demodata_progressbar_2; ?></textarea>
						   <textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr( $this->get_field_id('content_2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('content_2') ); ?>"><?php echo $content_2; ?></textarea>
						  
						   
						</p>
						
						<p>
						   <div class="label-block">
								<?php if ( class_exists( 'UixShortcodes' ) ) { ?>
								<a href="javascript:" class="custom-button uix_sc_form_bar-widget_btn" data-target="<?php echo esc_attr( $this->get_field_id('content_3') ); ?>"><i class="dashicons dashicons-plus"></i><?php echo shadower_wp_kses( __( 'Add new', 'shadower' ) ); ?></a>
								<a href="javascript:" class="custom-button insert-demo-btn" data-demo-id="demo-content-<?php echo esc_attr( $this->get_field_id('content_3') ); ?>" data-target="<?php echo esc_attr( $this->get_field_id('content_3') ); ?>"><i class="dashicons dashicons-desktop"></i><?php echo shadower_wp_kses( __( 'Demo content', 'shadower' ) ); ?></a>
								<?php } ?>
						   </div>
						   <textarea style="display:none" id="demo-content-<?php echo esc_attr( $this->get_field_id('content_3') ); ?>"><?php echo $widget_demodata_progressbar_3; ?></textarea>
						   <textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr( $this->get_field_id('content_3') ); ?>" name="<?php echo esc_attr( $this->get_field_name('content_3') ); ?>"><?php echo $content_3; ?></textarea>
						  
						   
						</p>
						
						<p>
						   <div class="label-block">
								<?php if ( class_exists( 'UixShortcodes' ) ) { ?>
								<a href="javascript:" class="custom-button uix_sc_form_bar-widget_btn" data-target="<?php echo esc_attr( $this->get_field_id('content_4') ); ?>"><i class="dashicons dashicons-plus"></i><?php echo shadower_wp_kses( __( 'Add new', 'shadower' ) ); ?></a>
								<a href="javascript:" class="custom-button insert-demo-btn" data-demo-id="demo-content-<?php echo esc_attr( $this->get_field_id('content_4') ); ?>" data-target="<?php echo esc_attr( $this->get_field_id('content_4') ); ?>"><i class="dashicons dashicons-desktop"></i><?php echo shadower_wp_kses( __( 'Demo content', 'shadower' ) ); ?></a>
								<?php } ?>
						   </div>
						   <textarea style="display:none" id="demo-content-<?php echo esc_attr( $this->get_field_id('content_4') ); ?>"><?php echo $widget_demodata_progressbar_4; ?></textarea>
						   <textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr( $this->get_field_id('content_4') ); ?>" name="<?php echo esc_attr( $this->get_field_name('content_4') ); ?>"><?php echo $content_4; ?></textarea>
						 
						   
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


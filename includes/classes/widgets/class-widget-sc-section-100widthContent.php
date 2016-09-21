<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}



/**
 * Widget for displaying 100% Width Content Section
 *
 */
if ( !class_exists( 'Shadower_100Width_Content_Widget' ) ) {
	
	class Shadower_100Width_Content_Widget extends WP_Widget {
	
		public function __construct() {
			$widget_ops = array(
				'classname' => 'widget_100width_content_section',
				'description' => shadower_wp_kses( __( 'Add a 100%-width content section for your site. You can customize parallax background, height and font color for this container.', 'shadower' ) ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( '100width_content_section', shadower_wp_kses( __( 'Home Section: 100% Width Content', 'shadower' ) ), $widget_ops );
		}
	
		//Output the HTML for this widget.
		public function widget( $args, $instance ) {
			
			$title_color  = !empty( $instance['title_color'] ) ? 'style="color: '.esc_attr( $instance['title_color'] ).';"': '';
			$title  = apply_filters( 'widget_title', !isset( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$title  = !empty( $title ) ? $args['before_title'] . '<h3 '.$title_color.'>'.shadower_wp_kses( $title ).'</h3>' . $args['after_title'] : '';
			$desc_color  = !empty( $instance['desc_color'] ) ? 'style="color: '.esc_attr( $instance['desc_color'] ).';"': '';
			
			if ( ! empty( $instance['filter'] ) ) {
				//Automatically add paragraphs
				$desc = isset( $instance['desc'] ) ? '<h4 '.$desc_color.'>'.wpautop( shadower_wp_kses( $instance['desc'] ) ).'</h4>' : '<h4 '.$desc_color.'>'.shadower_wp_kses( __( 'This is a description of the section.', 'shadower' ) ).'</h4>';
			} else {
				$desc = isset( $instance['desc'] ) ? '<h4 '.$desc_color.'>'.shadower_wp_kses( $instance['desc'] ).'</h4>' : '<h4 '.$desc_color.'>'.shadower_wp_kses( __( 'This is a description of the section.', 'shadower' ) ).'</h4>';
			}
			
			
			$image = ! empty( $instance['image'] ) ? esc_url( $instance['image'] ) : '';
			$height = isset( $instance['height'] ) ? absint( $instance['height'] ) : 315;
			$parallax = isset( $instance['parallax'] ) ? esc_attr( $instance['parallax'] ) : 0.4;
			$bg_attachment = isset( $instance['bg_attachment'] ) ? esc_attr( $instance['bg_attachment'] ) : 'fixed';
			
			
			echo $args['before_widget'];
			?>
	 
			<?php echo do_shortcode( "[uix_container parallax='{$parallax}' class='' height='{$height}px' margin_top='25' margin_bottom='25' margin_left='0' margin_right='0' padding_top='0' padding_bottom='0' padding_left='25' padding_right='25' bgimage='{$image}' bgimage_repeat='no-repeat' bgimage_position='left' bgimage_attachment='{$bg_attachment}' bgimage_size='cover' bgcolor='' layout='fullwidth' ]<div style='text-align:center'>
	{$title}
	{$desc}
	</div>
	[/uix_container]"); ?>
			<?php
	
			echo $args['after_widget'];
			
			//WP menu title of anchor link
			echo "\n".'<div data-homepage-widgets-title="'.esc_attr__( 'Parallax Background', 'shadower' ).'"></div>'."\n<!-- ".shadower_wp_kses( __( 'End Section', 'shadower' ) )." -->\n\n";
	
		}
	
		//Deal with the settings when they are saved by the admin.
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['title_color'] = strip_tags( $new_instance['title_color'] );
			if ( current_user_can( 'unfiltered_html' ) ) {
				$instance['desc'] = $new_instance['desc'];
			} else {
				$instance['desc'] = wp_kses_post( $new_instance['desc'] );
			}
			$instance['desc_color'] = strip_tags( $new_instance['desc_color'] );
			$instance['filter'] = ! empty( $new_instance['filter'] );
			$instance['image'] = strip_tags( $new_instance['image'] );
			$instance['height'] = (int) $new_instance['height'];
			$instance['parallax'] = (float) $new_instance['parallax'];
			$instance['bg_attachment'] = $new_instance['bg_attachment'];
			
			
			return $instance;
		}
	
		//Display the form for this widget on the Widgets page of the Admin area. 
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'desc' => '', 'title_color' => '#ffffff', 'desc_color' => '#ffffff', 'image' => '', 'height' => 315, 'parallax' => 0.4, 'bg_attachment' => 'fixed' ) );
			$filter   = isset( $instance['filter'] ) ? $instance['filter'] : 0;
			$title    = sanitize_text_field( $instance['title'] );
			$title_color    = sanitize_text_field( $instance['title_color'] );
			$desc     = esc_textarea( $instance['desc'] );
			$desc_color    = sanitize_text_field( $instance['desc_color'] );
			$image    = $instance['image'];
			$height   = $instance['height'];
			$parallax   = $instance['parallax'];
			$bg_attachment   = $instance['bg_attachment'];
			
			
		
			?>
	
				<div class="custom-tab-group" id="custom-tab-group-<?php echo $this->id; ?>">
					<ul class="group_control">
						<li><a href="#"><i class="dashicons dashicons-format-aside"></i><?php echo shadower_wp_kses( __( 'Text', 'shadower' ) ); ?></a></li>
						<li><a href="#"><i class="dashicons dashicons-admin-generic"></i><?php echo shadower_wp_kses( __( 'Properties', 'shadower' ) ); ?></a></li>
					</ul>
					<div class="item">
							<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php echo shadower_wp_kses( __( 'Title:', 'shadower' ) ); ?></label>
							<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
								<div class="label-block">
									<input type="text" class="widget-color-picker" id="<?php echo esc_attr( $this->get_field_id('title_color') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title_color') ); ?>" value="<?php echo esc_attr( $title_color ); ?>" />
								</div>
							</p>
							
					
							<p><label for="<?php echo esc_attr( $this->get_field_id('desc') ); ?>"><?php echo shadower_wp_kses( __( 'Description:', 'shadower' ) ); ?></label>
							   <textarea class="widefat" rows="3" cols="20" id="<?php echo esc_attr( $this->get_field_id('desc') ); ?>" name="<?php echo esc_attr( $this->get_field_name('desc') ); ?>"><?php echo $desc; ?></textarea>
								<div class="label-block">
									<input type="text" class="widget-color-picker" id="<?php echo esc_attr( $this->get_field_id('desc_color') ); ?>" name="<?php echo esc_attr( $this->get_field_name('desc_color') ); ?>" value="<?php echo esc_attr( $desc_color ); ?>" />
								</div>  
							   
							</p> 
							<p><input id="<?php echo esc_attr( $this->get_field_id('filter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('filter') ); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo esc_attr( $this->get_field_id('filter') ); ?>"><?php echo shadower_wp_kses( __( 'Auto Paragraph', 'shadower' ) ); ?></label>
							</p>   
					</div>
					<div class="item">
	
						<p>
							<?php
							Shadower_UploadMedia::add( array(
								'title'          => '',
								'id'             => esc_attr( $this->get_field_id('image') ),
								'name'           => esc_attr( $this->get_field_name('image') ),
								'value'          => esc_url( $image ),
								'placeholder'    => esc_attr__( 'Image URL', 'shadower' ),
							));
							?>
						</p>
						
						<p>
						   <label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'bg_attachment' ) ); ?>" value="fixed" <?php echo ( $bg_attachment == 'fixed' ) ? 'checked' : ''; ?>> <?php echo shadower_wp_kses( __( 'fixed', 'shadower' ) ); ?></label>
						   <label><input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'bg_attachment' ) ); ?>" value="scroll" <?php echo ( $bg_attachment == 'scroll' ) ? 'checked' : ''; ?>> <?php echo shadower_wp_kses( __( 'scroll', 'shadower' ) ); ?></label>
						   
						</p> 
						
						<p><label for="<?php echo esc_attr( $this->get_field_id('height') ); ?>"><?php echo shadower_wp_kses( __( 'Height:', 'shadower' ) ); ?></label>
						   <input class="tiny-text custom-tiny-text" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="number" step="25" min="0" value="<?php echo $height; ?>" /> px
						</p>
						
						<p><label for="<?php echo esc_attr( $this->get_field_id('parallax') ); ?>"><?php echo shadower_wp_kses( __( 'Parallax:', 'shadower' ) ); ?></label>
						   <input class="tiny-text custom-tiny-text" id="<?php echo $this->get_field_id( 'parallax' ); ?>" name="<?php echo $this->get_field_name( 'parallax' ); ?>" type="number" step="0.1" min="0" value="<?php echo $parallax; ?>" />
						   
						</p> 
					  
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

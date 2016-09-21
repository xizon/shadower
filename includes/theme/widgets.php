<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/*
 * Register and configure each widget.
 * 
 */
if ( !function_exists( 'shadower_widgets_init' ) ) {
	add_action( 'widgets_init', 'shadower_widgets_init' );
	function shadower_widgets_init() {
		
		register_widget( 'Shadower_WP_Widget_Categories' );
		register_widget( 'Shadower_WP_Widget_Recent_Posts' );
		register_widget( 'Shadower_SocialMedia_Buttons_Widget' );
		
		
		register_sidebar( array(
			'name'          => __( 'Primary Sidebar', 'shadower' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Main sidebar that appears on the left.', 'shadower' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title h5 font-uppercase">',
			'after_title'   => '</h3>',
		) );
		
		
		// Homepage Advertising
		register_sidebar( array(
			'name'			=> __( 'Homepage Advertising', 'shadower' ),
			'id'			    => 'homepage-advertising',
			'description'	=> __( 'Widgets in this area are used in footer for homepage.', 'shadower' ),
			'before_widget'	=> '<section class="space-sm space-none-top %2$s"><div class="container t-c">',
			'after_widget'	=> '</div></section>',
			'before_title'	=> '',
			'after_title'	=> '',
		) );	
		
		
		
	}

	
}

//Custom widget categories's count
if ( !function_exists( 'shadower_categories_list_group_filter' ) ) {
	add_filter('wp_list_categories','shadower_categories_list_group_filter');
	function shadower_categories_list_group_filter ($variable) {
	   $variable = str_replace('(', '<span class="cat-item-count"> ', $variable);
	   $variable = str_replace(')', ' </span>', $variable);
	   return $variable;
	}

}



/*
 * Use this hook to add extra fields to the widget form.
 * 
 */
if( !function_exists( 'shadower_spice_get_widget_id' ) ) {
	add_action('in_widget_form', 'shadower_spice_get_widget_id');
	function shadower_spice_get_widget_id( $widget_instance ) {
		
		// Check if the widget is already saved or not. 
		if ($widget_instance->number=="__i__"){
			echo '<p><strong>'.shadower_wp_kses( __( 'Widget ID is: ', 'shadower' ) ).'</strong>'.shadower_wp_kses( __( 'Please save the widget first!', 'shadower' ) ).'</p>';
		} else {
			echo '<p><strong>'.shadower_wp_kses( __( 'Widget ID is: ', 'shadower' ) ).'</strong>'.$widget_instance->id.'</p>';
		}
		
	}

}

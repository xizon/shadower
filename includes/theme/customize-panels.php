<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/*
 *  Wordpress Theme Customizer
 *
 * Each sidebar have its own unique id. If widgets and sidebars are enabled in your theme, then default 'widgets' panel would be created by Wordpress on customizer screen. 
 * Then for each sidebar would be created section placed in 'widgets' panel. That section has id based on sidebar id. And that id looks like this
 * sidebar-widgets-[sidebar-id]
 *
 */
if ( !function_exists( 'shadower_homesection_customizer' ) ) {
	
	add_action( 'customize_register', 'shadower_homesection_customizer', 999 ); // Priority 999 so that we remove options only once they've been added
	function shadower_homesection_customizer( $wp_customize ) {
	
		//$wp_customize->remove_setting( 'custom_uix_portfolio_layout' );
		
		//Custom homepage section
		$wp_customize -> add_panel( 'panel_homepage_widgets', array(
			'priority'       => 10,
			'title'          => __( 'Homepage Settings', 'shadower' ),
			'capability'     => 'edit_theme_options',
		));
		$homepage_section = (object) $wp_customize->get_section( 'sidebar-widgets-homepage-1' );
		$homepage_section -> panel = 'panel_homepage_widgets';
	
	}

}

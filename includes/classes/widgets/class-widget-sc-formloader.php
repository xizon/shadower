<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 * Load some the shortcodes panel for widget
 *
 */
if ( !class_exists( 'Shadower_UixShortcodes_Loader' ) ) {
	
	class Shadower_UixShortcodes_Loader {
		
		 public function __construct() {
			add_action( 'load-widgets.php', array( __CLASS__, 'load_js' ) );
			add_action( 'customize_controls_print_scripts', array( __CLASS__, 'load_forms' ) );
		 }
		 
		public static function load_js(){
			add_action( 'admin_footer', array( __CLASS__, 'load_forms' ) );
		}
	
		 //Callback Uix Shortcodes form you want
		 public static function load_forms() {
			if ( class_exists( 'UixShortcodes' ) ) {
				UixShortcodes::call_form( 'pricing-3-col' );
				UixShortcodes::call_form( 'features-2-col' );
				UixShortcodes::call_form( 'features-3-col' );
				UixShortcodes::call_form( 'team-grid' );	
				UixShortcodes::call_form( 'progress-bar' );
				UixShortcodes::call_form( 'testimonials' );
				UixShortcodes::call_form( 'map' );
			}
		 }
		 
		 //Returns this theme base width of container
		 public static function container_width() {
			 return 980;
		 } 
	 
	}
	
}

$widget_forms = new Shadower_UixShortcodes_Loader;



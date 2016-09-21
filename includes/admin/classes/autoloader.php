<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

if ( !class_exists( 'Shadower_Admin_Classes_AutoLoad' ) ) {
	class Shadower_Admin_Classes_AutoLoad {
		
		
		 public static function init() {
	
			foreach ( glob( UIX_THEME_INC_PATH . "/admin/classes/class-*.php") as $file ) {
				
				if ( is_file( $file ) ) {
					require_once $file;
				}
			}	 
			
	 
		 }
	
		
	}
	
}

// Creating an instance
Shadower_Admin_Classes_AutoLoad::init();

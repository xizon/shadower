<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

if ( !class_exists( 'Shadower_Classes_AutoLoad' ) ) {
	
	class Shadower_Classes_AutoLoad {
		
		const HELPER_DIR  = 'helper';
		const WIDGETS_DIR  = 'widgets';
	
		 public static function init() {
	
			foreach ( glob( UIX_THEME_INC_PATH . "/classes/class-*.php") as $file ) {
				if ( is_file( $file ) ) {
					require_once $file;
				}
			}	 
			
		
			if ( is_dir( dirname (__FILE__) . '/' . self::WIDGETS_DIR ) ) {
				
				foreach ( glob( UIX_THEME_INC_PATH . "/classes/".self::WIDGETS_DIR."/class-*.php") as $file ) {
					if ( is_file( $file ) ) {
						require_once $file;
					}
				}	 	
		
			}		
			
		
			if ( is_dir( dirname (__FILE__) . '/' . self::HELPER_DIR ) ) {
				
				foreach ( glob( UIX_THEME_INC_PATH . "/classes/".self::HELPER_DIR."/class-*.php") as $file ) {
					if ( is_file( $file ) ) {
						require_once $file;
					}
				}	 	
		
			}
			
	 
		 }
	
		
	}

	
}

// Creating an instance
Shadower_Classes_AutoLoad::init();



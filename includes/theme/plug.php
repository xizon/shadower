<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

	
/**
 * Removing buttons from the editor
 *
 * Uix plugins button name: uix_slideshow_btn, uix_shortcode_btn
 *
 */
/*

if ( !function_exists( 'shadower_remove_editor_buttons' ) ) {
	add_filter( 'mce_buttons', 'shadower_remove_editor_buttons', 99 );
	function shadower_remove_editor_buttons( $buttons ) {
		
		  //Find the array key and then unset
		  if ( ( $key = array_search( 'uix_slideshow_btn', $buttons ) ) !== false ) {
			  unset( $buttons[ $key ] );
		  }
		  
		  return $buttons;
		
		
	}
	
}

*/



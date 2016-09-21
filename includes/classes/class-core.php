<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

if ( !class_exists( 'Shadower_Core' ) ) {
	
	class Shadower_Core {
		
	
		/*
		 * Sends an X-PJAX header
		 *
		 */
		public static function is_pjax() {
	
		  return array_key_exists( 'HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'];
	
		}
		
	
		
		/*
		 * Get template ID
		 *
         * [Usage:]
		 
		    echo esc_url( get_permalink( Shadower_Core::get_pageid_from_template( 'blog.php' ) ) );
			
		 *
		 */
		public static function get_pageid_from_template( $template ) {
	        
			$page_id = '';
			$pages = get_pages( array(
				'meta_value' => $template
			) );
			
			foreach( $pages as $page ){
				$page_id = $page->ID;
				break;
			}
	
		   return $page_id;
	
		}
		
		
		/*
		 * The function finds the position of the first occurrence of a string inside another string.
		 *
		 * As strpos may return either FALSE (substring absent) or 0 (substring at start of string), strict versus loose equivalency operators must be used very carefully.
		 *
		 */
		public static function inc_str( $str, $incstr ) {
		
			if ( mb_strlen( strpos( $str, $incstr ), 'UTF8' ) > 0 ) {
				return true;
			} else {
				return false;
			}
	
		}
		
		/*
		 * Check if the user needs a browser update
		 *
		 *
		 */
		public static function is_IE() {
			 
			 if( self::inc_str( $_SERVER[ 'HTTP_USER_AGENT' ], 'MSIE' ) ) { 
				 return true;
			 } else {
				 return false;
			 }
	  
		}
		
		
		/*
		 * Browser Compatibility
		 *
		 * Declare multple X-UA-Compatible meta contents in a single wordpress site for IE compatibility hack.
		 *
		 */
		public static function browser_compatibility() {
			if( self::is_IE() ) {
				echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">\n";
			}
		}
		 
	
		
		/**
		 * Uotput Audio Code (Support Soundcloud)
		 * 
		 */
		public static function output_audio( $url = '', $echo = 1 ) {
			
			$wp_media_suffix = 'mp3|m4a|ogg|wav';
			$md = explode( '|', $wp_media_suffix);
			$soundcloud = true;
			$output = '';
			
			foreach( $md as $v ) {
				if ( strpos( $url, $v ) ) {
					$output = wp_audio_shortcode( array(
													'src'      => $url,
													'loop'     => 0,
													'autoplay' => 0,
													'preload' => 'none'
													) );
					
					if ( $echo == 0 ) {
						$output = 'audio';
					}


					$soundcloud = false;
					break;
				}
				
			}
			
			
			if ( $soundcloud ) {
				$output = wp_oembed_get( $url );
				
				if ( $echo == 0 ) {
					$output = 'soundcloud';
				}
				
			}
			
			return $output;
					
			
		}
	
		
	}

}


<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


if( !function_exists( 'shadower_the_custom_logo_url' ) ) {
	function shadower_the_custom_logo_url() {
		
		//Capture output from the WP custom logo. If you have the WordPress on a lower version of 4.5 to your website, you will use get_theme_mod( 'custom_logo' ).
		if ( function_exists( 'the_custom_logo' ) ) {
			ob_start();
				the_custom_logo();
				$logo_wp = ob_get_contents();
			ob_end_clean();
			
			$pattern = '/<img.+src=\"(.*?)\".+>/i';
			$matchCount = preg_match( $pattern, $logo_wp, $match ); 
			if ( $matchCount > 0 ) {
				$logo_url = esc_url( $match[ 1 ] );
			} else {
				$logo_url = '';
			}
		
		} else {
			$logo_url = esc_url( get_theme_mod( 'theme_extra_custom_logo' ) );
		}
		
		return $logo_url;
	}

}


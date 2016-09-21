<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


if( !function_exists( 'shadower_wp_kses' ) ) {
	function shadower_wp_kses( $html ){
		
		$allowed_tags = wp_kses_allowed_html( 'post' );
		return wp_kses( $html, $allowed_tags );

	}
}


if( !function_exists( 'shadower_filter_allowed_html' ) ) {
	
	add_filter( 'wp_kses_allowed_html', 'shadower_filter_allowed_html', 10, 2 );
	function shadower_filter_allowed_html($allowed, $context){
	    
		if ( is_array( $context ) ) {
			return $allowed;
		}
	 
		if ( $context === 'post' ) {
			
			$allowed[ 'div'] [ 'data-parallax' ] = true;
			$allowed[ 'div'] [ 'data-percent' ] = true;
			$allowed[ 'div'] [ 'data-linewidth' ] = true;
			$allowed[ 'div'] [ 'data-trackcolor' ] = true;
			$allowed[ 'div'] [ 'data-barcolor' ] = true;
			$allowed[ 'div'] [ 'data-units' ] = true;
			$allowed[ 'div'] [ 'data-size' ] = true;
			$allowed[ 'div'] [ 'data-icon' ] = true;
			$allowed[ 'div'] [ 'data-tcolor' ] = true;
			$allowed[ 'div'] [ 'data-effect' ] = true;
			$allowed[ 'div'] [ 'data-classprefix' ] = true;
			$allowed[ 'div'] [ 'data-filter-id' ] = true;
			$allowed[ 'div'] [ 'data-groups' ] = true;
			$allowed[ 'div'] [ 'data-target-pjax' ] = true;
			$allowed[ 'div'] [ 'data-show-type' ] = true;
			$allowed[ 'div'] [ 'data-speed' ] = true;
			$allowed[ 'div'] [ 'data-image-src' ] = true;
			$allowed[ 'div'] [ 'data-height' ] = true;
			$allowed[ 'div'] [ 'data-width' ] = true;
			$allowed[ 'div'] [ 'data-skew' ] = true;
			$allowed[ 'a'] [ 'data-group' ] = true;
			$allowed[ 'a'] [ 'data-target-pjax' ] = true;
			$allowed[ 'a'] [ 'data-homepage-pjax' ] = true;
			$allowed[ 'a'] [ 'data-thumb' ] = true;
			$allowed[ 'a'] [ 'data-thumb-alt' ] = true;
			$allowed[ 'a'] [ 'data-thumbcaption' ] = true;
			$allowed[ 'img'] [ 'data-uix-portfolio-retina' ] = true;
			$allowed[ 'img'] [ 'data-retina' ] = true;
			$allowed[ 'img'] [ 'data-thumb' ] = true;
			$allowed[ 'img'] [ 'data-thumb-alt' ] = true;
			$allowed[ 'img'] [ 'data-thumbcaption' ] = true;
	
		
		}
	 
		return $allowed;
	}

}

 
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


if ( !function_exists( 'shadower_remove_thumbnail_dimensions' ) ) {
	
	add_filter( 'post_thumbnail_html', 'shadower_remove_thumbnail_dimensions', 10, 4 );
	function shadower_remove_thumbnail_dimensions( $html, $post_id, $post_image_id, $post_thumbnail ) {
		
		if ( $post_thumbnail== 'post-thumbnail' || $post_thumbnail== 'post-thumbnail-large' ){
			$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		}
		return $html;
	}
}




if ( !function_exists( 'shadower_remove_thumbnail_str' ) ) {
	
	function shadower_remove_thumbnail_str( $str ) {
		return preg_replace( '/(width|height)=\"\d*\"\s/', "", $str );
	}
}

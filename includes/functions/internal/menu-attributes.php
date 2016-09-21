<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


if ( ! function_exists( 'shadower_add_menu_atts' ) ) {
	
	add_filter( 'nav_menu_link_attributes', 'shadower_add_menu_atts', 10, 3 );
	function shadower_add_menu_atts( $atts, $item, $args ) {
	
		//Check if the item is home link
		if( $item->url != esc_url( home_url( '/' ) ) ) {
			  // add the desired attributes:
			  $atts['data-target-pjax'] = '1';
		}
		
		//Check if current page is front page
		if ( ( is_home() || is_front_page() ) && ( $item->url == esc_url( home_url( '/' ) ) ) ) {
			$atts[ 'data-homepage-pjax' ] = '1';
			$atts[ 'data-target-pjax' ] = '1';
		}
		
		//Whether currently in a homepage template.
		for ( $i = 1; $i < 99; $i++ ) {
			if ( ( is_page_template( 'home-style-'.$i.'.php' ) ) && ( $item->url == esc_url( home_url( '/' ) ) ) ) {
				$atts[ 'data-homepage-pjax' ] = '1';
				$atts[ 'data-target-pjax' ] = '1';
				$atts[ 'href' ] = esc_url( get_permalink( Shadower_Core::get_pageid_from_template( 'home-style-'.$i.'.php' ) ) );
			}	

		}
	
		return $atts;
		
	}
	
}

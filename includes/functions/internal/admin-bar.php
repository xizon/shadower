<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

if ( !function_exists( 'shadower_filter_admin_bar' ) ) {

    add_action( 'get_header', 'shadower_filter_admin_bar' );
	function shadower_filter_admin_bar($content){
	     remove_action( 'wp_head', '_admin_bar_bump_cb' ); 
			
	}
}



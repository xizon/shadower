<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/**
 * [Usage:]
 *
   <?php echo shadower_get_post_views( get_the_ID() ); ?> <?php echo shadower_wp_kses( __( 'views', 'shadower' ) ); ?>

*/
 
if ( !function_exists( 'shadower_get_post_views' ) ) {
	function shadower_get_post_views ($post_id) {
		$count_key = 'views';
		$count = get_post_meta($post_id,$count_key,true);
		if ($count == '' ) {
			delete_post_meta($post_id,$count_key);
			add_post_meta($post_id,$count_key,'0' );
			$count = '0';
		}
		return number_format_i18n($count);
	}

}

if ( !function_exists( 'shadower_set_post_views' ) ) {
	
	add_action( 'get_header','shadower_set_post_views' );
	function shadower_set_post_views () {
		global $post;
		if ( get_the_ID() ){
			$post_id    = get_the_ID();
			$count_key  = 'views';
			$count      = get_post_meta( $post_id, $count_key, true );
			if (is_single() || is_page() ) {
				if ( $count == '' ) {
					delete_post_meta( $post_id, $count_key );
					add_post_meta( $post_id, $count_key, '0' );
				} else {
					update_post_meta( $post_id, $count_key,$count + 1 );
				}
			}
	
		}
	}


}



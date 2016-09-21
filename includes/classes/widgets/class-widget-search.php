<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 * Modify WP Categories widget search
 * 
 */
if ( !class_exists( 'Shadower_WP_Widget_Search' ) ) {
	
	class Shadower_WP_Widget_Search {
		
		public static function init() {
			add_filter( 'get_search_form', array( __CLASS__, 'custom_search_form' ) );
		}
		
		public static function custom_search_form( $form ) {
			$form = '
			<form method="get" id="searchform" class="searchform" action="'.esc_url( home_url( '/' ) ).'" >
				<div class="search-box">
					<label for="s">
						<span class="screen-reader-text">'.shadower_wp_kses( __( 'Search for:', 'shadower' ) ).'</span>
						<input class="controls-custom search-field" id="s" name="s" type="search" value="'.esc_attr( get_search_query() ).'" placeholder="'.esc_attr__( 'Search &hellip;', 'shadower' ).'" />
					 </label> 
					 <i class="fa fa-search wp-search-submit"></i> 
				</div>
			</form>';
			
			return $form;
		}

	}
	
}

Shadower_WP_Widget_Search::init();
 
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/**
 * Default demo data for homepage widget
 *
 */
 
$default_images = array (
     'sc-home-sections' => array (
	     'avatar'       => ( class_exists( 'UixShortcodes' ) ) ? esc_url( UixShortcodes::plug_directory().'assets/images/no-photo.png' ) : '',
		 'marker'       => ( class_exists( 'UixShortcodes' ) ) ? esc_url( UixShortcodes::plug_directory().'assets/images/map/map-location.png' ) : '',
	 ),
);

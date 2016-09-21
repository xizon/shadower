<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 * Enqueue scripts in admin area
 *
 */
if( !function_exists( 'shadower_register_adminscreens_scripts' ) ) {
	
	add_action( 'admin_init', 'shadower_register_adminscreens_scripts' );
	function shadower_register_adminscreens_scripts() {
		
		wp_register_script( UIX_THEME_SLUG . '-admin-screens', UIX_THEME_ADMIN_ASSETS_URL . '/js/admin-screens.js', array( 'jquery' ), UIX_THEME_VERSION, true );
	
	}
	
}

if( !function_exists( 'shadower_enqueue_adminscreens_scripts' ) ) {
	
	add_action( 'admin_enqueue_scripts', 'shadower_enqueue_adminscreens_scripts' );
	function shadower_enqueue_adminscreens_scripts() {
		
		wp_enqueue_script( UIX_THEME_SLUG . '-admin-screens' );
	
	}
	
}


/**
 * Enqueue styles in admin area
 *
 */
if( !function_exists( 'shadower_register_adminscreens_styles' ) ) {
	
	add_action( 'admin_init', 'shadower_register_adminscreens_styles' );
	function shadower_register_adminscreens_styles() {
		
		wp_register_style( UIX_THEME_SLUG . '-admin-screens', UIX_THEME_ADMIN_ASSETS_URL . '/css/admin-screens.css' );
		wp_register_style( 'font-awesome', UIX_THEME_ADMIN_ASSETS_URL . '/icons/fontawesome/font-awesome.css');
	
	}
	
}

if( !function_exists( 'shadower_enqueue_adminscreens_styles' ) ) {
	
	add_action( 'admin_enqueue_scripts', 'shadower_enqueue_adminscreens_styles' );
	function shadower_enqueue_adminscreens_styles() {
		
		wp_enqueue_style( UIX_THEME_SLUG . '-admin-screens' );
		wp_enqueue_style( 'font-awesome' );
	
	}
	
}




/**
 * Enqueue styles in admin area
 *
 */
if( !function_exists( 'shadower_register_adminscreens_styles' ) ) {
	
	add_action( 'admin_init', 'shadower_register_adminscreens_styles' );
	function shadower_register_adminscreens_styles() {
		
		wp_register_style( UIX_THEME_SLUG . '-admin-screens', UIX_THEME_ADMIN_ASSETS_URL . '/css/admin-screens.css' );
		wp_register_style( 'font-awesome', UIX_THEME_ADMIN_ASSETS_URL . '/icons/fontawesome/font-awesome.css');
	
	}
	
}




/*
 * Featured image column
 *
 */
if( !function_exists( 'shadower_custom_featured_image_column_image' ) ) {
	
	add_filter( 'featured_image_column_default_image', 'shadower_custom_featured_image_column_image' );
	function shadower_custom_featured_image_column_image( $image ) {
		if ( !has_post_thumbnail() ) {
			return esc_url( UIX_THEME_ADMIN_ASSETS_URL . '/images/featured-image.png' );
		}
	}
		
}



/*
 * Creates functions for the front-end & admin area image galleries
 *
*/
// Retrieve attachment IDs
if ( !function_exists ( 'get_gallery_ids' ) ) {
	function get_gallery_ids() {
		global $post;
		$id_array = '';
		$postid = $post->ID;
		if( ! isset( $postid ) ) return;
		$attachment_ids = get_post_meta( $postid, '_easy_image_gallery', true );
		$link_images = get_post_meta( $postid, '_easy_image_gallery_link_images', true );
		if ( $attachment_ids ) {
			$attachment_ids = explode( ',', $attachment_ids );
			$id_array = array_filter( $attachment_ids );
		}
		return $id_array;
	}
}

// Get attachment data
if ( !function_exists ( 'get_attachment' ) ) {
	function get_attachment( $attachment_id ) {
		$attachment = get_post( $attachment_id );
		return array(
			'alt'			=> get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption'		=> $attachment->post_excerpt,
			'description'	=> $attachment->post_content,
			'href'			=> esc_url( get_permalink( $attachment->ID ) ),
			'src'			=> $attachment->guid,
			'title'			=> $attachment->post_title
		);
	}
}


// Return gallery images count
if ( !function_exists ( 'gallery_count' ) ) {
	function gallery_count() {
		$images = get_post_meta( get_the_ID(), '_easy_image_gallery', true );
		$images = explode( ',', $images );
		$number = count( $images );
		return $number;
	}
}


// Check if lightbox is enabled
if ( !function_exists ( 'gallery_is_lightbox_enabled' ) ) {
	function gallery_is_lightbox_enabled() {
		$link_images = get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true );
		if ( $link_images == '' ) return 'empty';
		if ( 'on' == $link_images ) return true;
	}
}


/*
 * This theme styles the visual editor to resemble the theme style,
 * specifically font, colors, icons, and column width.
 */
if ( !function_exists ( 'shadower_add_editor_styles' ) ) {
	add_action( 'admin_init', 'shadower_add_editor_styles' );
	function shadower_add_editor_styles() {
		add_editor_style( UIX_THEME_ADMIN_ASSETS_URL . '/css/custom-editor-style.css' );
	}
}



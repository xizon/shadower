<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}



/**
 * Enqueue scripts in the front-end
 *
 */
if( !function_exists( 'shadower_register_scripts' ) ) {
	
	add_action( 'init', 'shadower_register_scripts' );
	function shadower_register_scripts(){
		
		wp_register_script( 'ie-respond', UIX_THEME_URL . '/assets/js/respond.min.js', false, '1.4.2', false );
		wp_register_script( 'modernizr', UIX_THEME_URL . '/assets/js/modernizr.min.js', false, '3.3.1', false );
		wp_register_script( 'jquery-easing', UIX_THEME_URL . '/assets/js/jquery.easing.js', array( 'jquery' ), '1.3', false );
		wp_register_script( 'jquery-mousewheel', UIX_THEME_URL . '/assets/js/jquery.mousewheel.min.js', array( 'jquery' ), '3.1.12', false );
		wp_register_script( 'imagesloaded', UIX_THEME_URL . '/assets/js/imagesloaded.min.js', array( 'jquery' ), '4.1.0', true );	
		wp_register_script( 'prettyPhoto', UIX_THEME_URL . '/assets/js/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.5', true );
		wp_register_script( 'flexslider', UIX_THEME_URL . '/assets/js/jquery.flexslider.min.js', array( 'jquery' ), '2.6.2', true );
		wp_register_script( 'shuffle', UIX_THEME_URL . '/assets/js/jquery.shuffle.js', array( 'jquery' ), '3.1.1', true );
		wp_register_script( 'masonry', UIX_THEME_URL . '/assets/js/masonry.js', array( 'jquery' ), '3.3.2', true );
		wp_register_script( 'bgParallax', UIX_THEME_URL . '/assets/js/jquery.bgParallax.js', array( 'jquery' ), '1.1.3', true );
		wp_register_script( UIX_THEME_SLUG . '-scrollreveal', UIX_THEME_URL . '/assets/js/scrollreveal.min.js', array( 'jquery' ), '3.3.1', true );	
		wp_register_script( UIX_THEME_SLUG . '-waitforimages', UIX_THEME_URL . '/assets/js/jquery.waitforimages.js', array( 'jquery' ), '1.5.0', true );	
		wp_register_script( UIX_THEME_SLUG . '-totop', UIX_THEME_URL . '/assets/js/jquery.ui.totop.min.js', array( 'jquery' ), '1.2', true );
		wp_register_script( UIX_THEME_SLUG . '-sidr', UIX_THEME_URL . '/assets/js/jquery.sidr.min.js', array( 'jquery' ), '2.2.1', true );
		wp_register_script( UIX_THEME_SLUG . '-animsition', UIX_THEME_URL . '/assets/js/animsition.min.js', array( 'jquery' ), '4.0.2', true );		
		wp_register_script( UIX_THEME_SLUG . '-scrolltofixed', UIX_THEME_URL . '/assets/js/jquery.scrolltofixed.min.js', array( 'jquery' ), '1.0.0', true );

	}
}


 
if( !function_exists( 'shadower_enqueue_scripts' ) ) {
	
	add_action( 'wp_enqueue_scripts', 'shadower_enqueue_scripts' );
	function shadower_enqueue_scripts(){
		
	    // Internet Explorer 8 media query support
		wp_enqueue_script( 'ie-respond' );
		wp_script_add_data( 'ie-respond', 'conditional', 'lt IE 9' );
		
		
	    // Add main scripts
		wp_enqueue_script( UIX_THEME_SLUG . '-main', UIX_THEME_URL . '/assets/js/script.js', 
		    array( 
			    'jquery',
				'jquery-easing',
				'jquery-mousewheel',
				'modernizr',
				'imagesloaded',
				'prettyPhoto',
				'flexslider',
				'masonry',
				'bgParallax',
				UIX_THEME_SLUG . '-scrollreveal',
				UIX_THEME_SLUG . '-waitforimages',
				UIX_THEME_SLUG . '-totop',
				UIX_THEME_SLUG . '-sidr',
				UIX_THEME_SLUG . '-animsition',
				UIX_THEME_SLUG . '-scrolltofixed'
			), UIX_THEME_VERSION, true );
		
		
		//Quick Reply is the ability to respond to a message without URL jump.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	

	}
}



/**
 * Enqueue styles in the front-end
 *
 */
if( !function_exists( 'shadower_register_styles' ) ) {
	
	add_action( 'init', 'shadower_register_styles' );
	function shadower_register_styles(){
		
		wp_register_style( 'old-ie', UIX_THEME_URL . '/assets/css/old-ie.css', false, UIX_THEME_VERSION, 'all' );
		wp_register_style( 'font-awesome', UIX_THEME_URL . '/assets/icons/fontawesome/font-awesome.css', false, '4.5.0', 'all' );
		wp_register_style( 'flaticon', UIX_THEME_URL . '/assets/icons/flaticon/flaticon.css', false, '1.0.0', 'all' );	
		wp_register_style( 'bootstrap', UIX_THEME_URL . '/assets/css/bootstrap.min.css', false, '3.3.7', 'all' );
		wp_register_style( 'flexslider', UIX_THEME_URL . '/assets/css/flexslider.css', false, '2.6.2', 'all' );
		wp_register_style( 'prettyPhoto', UIX_THEME_URL . '/assets/css/jquery.prettyPhoto.css', false, '3.1.5', 'all' );
		wp_register_style( UIX_THEME_SLUG . '-flexslider-custom', UIX_THEME_URL . '/assets/css/flexslider-custom.css', false, UIX_THEME_VERSION, 'all' );
		wp_register_style( UIX_THEME_SLUG . '-animsition', UIX_THEME_URL . '/assets/css/animsition.min.css', false, '4.0.2', 'all' );
		wp_register_style( UIX_THEME_SLUG . '-main', UIX_THEME_URL . '/assets/css/main.css', false, UIX_THEME_VERSION, 'all' );
		wp_register_style( UIX_THEME_SLUG . '-main-mobile', UIX_THEME_URL . '/assets/css/jquery.sidr.light.css', false, UIX_THEME_VERSION, 'all' );
		

	}
}


if( !function_exists( 'shadower_enqueue_styles' ) ) {
	
	add_action( 'wp_enqueue_scripts', 'shadower_enqueue_styles' );
	function shadower_enqueue_styles(){
		
		// Add main styles
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'flaticon' );
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'flexslider' );
		wp_enqueue_style( 'prettyPhoto' );
		wp_enqueue_style( UIX_THEME_SLUG . '-flexslider-custom' );
		wp_enqueue_style( UIX_THEME_SLUG . '-animsition' );
		wp_enqueue_style( UIX_THEME_SLUG . '-main' );
		wp_enqueue_style( UIX_THEME_SLUG . '-main-mobile' );
		
		// Load our IE specific stylesheet for a range of older versions
        wp_enqueue_style( 'old-ie' );
        wp_style_add_data( 'old-ie', 'conditional', 'lt IE 10' );
		

	}
}
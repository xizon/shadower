<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}



/**
 * Implement the Custom Header feature.
 *
 */
if ( !function_exists( 'shadower_custom_header_setup' ) ) {

    add_action( 'after_setup_theme', 'shadower_custom_header_setup' );
	function shadower_custom_header_setup() {
	  
	
		add_theme_support( 'custom-header', array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 1440,
			'height'                 => 900,
			'flex-height'            => false,
			'flex-width'             => false,
			'default-text-color'     => '',
			'header-text'            => false,
			'uploads'                => true,
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
			'wp-head-callback'       => 'shadower_header_style',
		) );
	
		//Default custom headers packaged with the theme.
		/*
		register_default_headers( 
			array (
				'1' => array (
							'url' => esc_url( UIX_THEME_ADMIN_ASSETS_URL.'/images/cover-default-bg.jpg' ),
							'thumbnail_url' => esc_url( UIX_THEME_ADMIN_ASSETS_URL.'/images/cover-default-bg.jpg' ),
							'description' => ''
							 ),
		) );
		*/

		
	}
}



/**
 * Styles the header image for your website.
 *
 */

if ( ! function_exists( 'shadower_header_style' ) ) {
	function shadower_header_style() {
		$header_image = get_header_image();
	
		// If no custom options for text are set, let's bail.
		if ( empty( $header_image ) && display_header_text() ) {
			return;
		}
	
		// If we get this far, we have custom styles. Let's do this.
		?>
		<?php if ( ! empty( $header_image ) ) { ?>
			<style type="text/css">
			
				.header-area {
					background-image: url(<?php header_image(); ?>);
					background-repeat: no-repeat;
					background-position: 50% 50%;
					-webkit-background-size: cover;
					-moz-background-size:    cover;
					background-size:         cover;	
				}
			</style>
		<?php } ?>
		<?php
	}
}


/**
 * Enqueues front-end CSS for the header background color.
 *
 */
if ( ! function_exists( 'shadower_header_background_color_css' ) ) {

	add_action( 'wp_enqueue_scripts', 'shadower_header_background_color_css', 11 );
	function shadower_header_background_color_css() {
		$default_color           = 'rgba(255,255,255,0)';
		$header_background_color = get_theme_mod( 'header_background_color', $default_color );
	
		// Don't do anything if the current color is the default.
		if ( $header_background_color === $default_color ) {
			return;
		}
	
		$css = '
			.header-area {
				background-color: %1$s;
			}
	
		';
	
		wp_add_inline_style( UIX_THEME_SLUG . '-main', sprintf( $css, $header_background_color ) );
	}
	
}


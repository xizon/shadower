<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


if ( class_exists( 'Kirki' ) ) {
	
	global $wp_customize;
	
	$shadower_kirki_config_id = 'shadower_kirki_custom';
	


	/*
	*
	* Kirki customizer configuration
	*
	*/
	
	Kirki::add_config( $shadower_kirki_config_id, array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );
	

	
	
	//Function of "Allowing html in text"
	function shadower_kirki_do_not_filter_anything( $value ) {
		return $value;
	}
		
	//Customizer styling
	function shadower_kirki_custom_configuration() {
	  $args = array(
		'logo_image'   => esc_url( UIX_THEME_ADMIN_ASSETS_URL . '/images/customizer-logo.png' ),
		'description'  => '',
		//'color_accent' => '#00bcd4',
		//'color_back'   => '#455a64',
		//'width'        => '20%',
		
	  );
	  return $args;
	}
	add_filter( 'kirki/config', 'shadower_kirki_custom_configuration' );	
			
			
	//This function adds some styles to the WordPress Customizer
	function shadower_kirki_custom_style() {
	
		wp_enqueue_style( 'kirki-customizer-custom-css', UIX_THEME_ADMIN_ASSETS_URL . '/css/kirki-custom.css', null, null );

	}
	if ( $wp_customize ) {
	
		add_action( 'customize_controls_print_styles', 'shadower_kirki_custom_style', 100 );
		
	}
	

	
    /*
     * ------------------------------------------------------------------------------------------------
     */

	
	 
	Kirki::add_section( 'panel-theme-general', array(
		'title'          => shadower_wp_kses( __( 'General', 'shadower' ) ),
		'priority'       => 1,
		'capability'     => 'edit_theme_options',

	) );
	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */
	if ( !function_exists( 'the_custom_logo' ) ) {
		Kirki::add_field( $shadower_kirki_config_id, array(
			'type'        => 'image',
			'settings'    => 'theme_extra_custom_logo',
			'label'       => shadower_wp_kses( __( 'Logo', 'shadower' ) ),
			'description' => shadower_wp_kses( __( 'Upload your site logo to the server. The max height for photos in this theme view is <strong>50</strong> pixels.', 'shadower' ) ),
			'section'     => 'panel-theme-general',
			'default'     => '',
			'priority'    => 10,
		) );
	}


	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'textarea',
		'settings'    => 'custom_copyright',
		'label'       => shadower_wp_kses( __( 'Copyright Info', 'shadower' ) ),
		'description' => shadower_wp_kses( __( 'Add custom copyright info to WordPress footer <br>(Support HTML tags)', 'shadower' ) ),
		'section'     => 'panel-theme-general',
		'default'     => '&copy; '.shadower_wp_kses( __( 'Copyright', 'shadower' ) ).' 2016 &middot; <a href="'.esc_url(home_url('/')).'" title="'.get_bloginfo( 'name' ).'">'.get_bloginfo( 'name' ).'</a> | <a href="'.esc_url( shadower_wp_kses( __( 'https://wordpress.org/', 'shadower' ) ) ).'">'.sprintf( shadower_wp_kses( __( 'Powered by %s', 'shadower' ) ), 'WordPress' ).'</a><br><a href="'.esc_url( __( 'https://uiux.cc/', 'shadower' ) ).'">'.sprintf( __( 'Designed by %s', 'shadower' ), 'UIUX Lab' ).'</a>',
		'priority'    => 10,
		'sanitize_callback' => 'shadower_kirki_do_not_filter_anything',//Allowing html in text
	) );


	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_google_analytics',
		'label'       => shadower_wp_kses( __( 'Google Analytics', 'shadower' ) ),
		'description' => shadower_wp_kses( __( 'Send analytics for your shots and profile to Google Analytics, e.g. UA-00000000-0', 'shadower' ) ),
		'section'     => 'panel-theme-general',
		'default'     => 'UA-70658525-1',
		'priority'    => 10,
	) );
	
	



    /*
     * ------------------------------------------------------------------------------------------------
     */

	
	 
	Kirki::add_section( 'panel-theme-post', array(
		'title'          => shadower_wp_kses( __( 'Blog Settings', 'shadower' ) ),
		'priority'       => 1,
		'capability'     => 'edit_theme_options',

	) );
	

	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_blog_excerpt_words',
		'label'       => shadower_wp_kses( __( 'Limit the Number of Words in Excerpt', 'shadower' ) ),
		'description' => shadower_wp_kses( __( 'If the post has not a custom excerpt or does not contain &lt;!--more--&gt; tag, then it\'ll automatically generate an excerpt with limit number of words.', 'shadower' ) ),
		'section'     => 'panel-theme-post',
		'default'     => 40,
		'priority'    => 10
	) );
	


	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'radio-image',
		'settings'    => 'custom_blog_layout',
		'label'       => shadower_wp_kses( __( 'Blog Layout', 'shadower' ) ),
		'description' => '',
		'section'     => 'panel-theme-post',
		'default'     => 'sidebar',
		'priority'    => 10,
		'choices'     => array(
			'sidebar'   => esc_url( UIX_THEME_ADMIN_ASSETS_URL . '/images/layouts/sidebar.png' ),
			'no-sidebar' => esc_url( UIX_THEME_ADMIN_ASSETS_URL . '/images/layouts/no-sidebar.png' ),
		),
	) );
	
	/*
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'switch',
		'settings'    => 'custom_blog_infinitescroll_list',
		'label'       => shadower_wp_kses( __( 'Add Infinite Scroll to Your Blog', 'shadower' ) ),
		'description' => shadower_wp_kses( __( 'Automatically append the next page of posts (via AJAX) to your page when a user scrolls to the bottom or clicks button of loading from the bottom.', 'shadower' ) ),
		'section'     => 'panel-theme-post',
		'default'     => false,
		'priority'    => 10,
	) );

	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'switch',
		'settings'    => 'custom_blog_infinitescroll_eff',
		'label'       => shadower_wp_kses( __( 'Infinite Scrolling Occurs when You Scroll to The Bottom', 'shadower' ) ),
		'description' => shadower_wp_kses( __( 'Close to the bottom the refresh occurs, and this option acts on posts. When this option is enabled, you will see the effect.', 'shadower' ) ),
		'section'     => 'panel-theme-post',
		'default'     => false,
		'priority'    => 10,
	) );
	*/

	
	
	
    /*
     * ------------------------------------------------------------------------------------------------
     */

	
	 
	Kirki::add_panel( 'panel-theme-styling', array(
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => shadower_wp_kses( __( 'Styling', 'shadower' ) ),
		'description'    => '',
	) );
	
	/**
	 * ----------------------  Add sub section. ----------------------
	 * 
	 */
	
	Kirki::add_section( 'panel-theme-paging', array(
		'title'          => shadower_wp_kses( __( 'Paging Navigation', 'shadower' ) ),
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
		'panel'          => 'panel-theme-styling',
	) );
	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */
	

	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'switch',
		'settings'    => 'custom_pagination',
		'label'       => shadower_wp_kses( __( 'Numeric Pagination', 'shadower' ) ),
		'description' => shadower_wp_kses( __( 'If this option turned on, the post list will use numeric pagination.', 'shadower' ) ),
		'section'     => 'panel-theme-paging',
		'default'     => true,
		'priority'    => 10,
	) );
	
	
	
	
	
	/**
	 * ----------------------  Add sub section. ----------------------
	 * 
	 */
	
    if ( class_exists( 'UixShortcodes' ) ) {
	
		Kirki::add_section( 'panel-theme-map', array(
			'title'          => shadower_wp_kses( __( 'Google Map', 'shadower' ) ),
			'priority'       => 2,
			'capability'     => 'edit_theme_options',
			'panel'          => 'panel-theme-styling',
		) );
		
		/**
		 * Add the configuration.
		 * 
		 * will inherit these options
		 */
		
		
		Kirki::add_field( $shadower_kirki_config_id, array(
			'type'        => 'radio-image',
			'settings'    => 'custom_map_style',
			'label'       => shadower_wp_kses( __( 'Map Style', 'shadower' ) ),
			'description' => shadower_wp_kses( __( 'You can make a search, use the name of a place, city, state, or address, or click the location on the map to get lat long coordinates. &rarr; <a href="//www.latlong.net/" target="_blank">Get Latitude Longitude</a>', 'shadower' ) ),
			'section'     => 'panel-theme-map',
			'default'     => 'normal',
			'priority'    => 10,
			'choices'     => array(
					'normal'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-1.png',
					'gray'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-2.png',
					'black'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-3.png',
					'real'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-4.png',
					'terrain'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-5.png',
					'white'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-6.png',
					'dark-blue'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-7.png',
					'dark-blue-2'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-8.png',
					'blue'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-9.png',
					'flat'   => UixShortcodes::plug_directory() .'assets/images/map/map-style-10.png',
				
			),
		) );
		
		Kirki::add_field( $shadower_kirki_config_id, array(
			'type'        => 'text',
			'settings'    => 'custom_map_name',
			'label'       => shadower_wp_kses( __( 'Place Name', 'shadower' ) ),
			'description' => '',
			'section'     => 'panel-theme-map',
			'default'     => 'SEO San Francisco, CA, Gough Street, San Francisco, CA',
			'priority'    => 10,
		) );
		
		Kirki::add_field( $shadower_kirki_config_id, array(
			'type'        => 'text',
			'settings'    => 'custom_map_latitude',
			'label'       => shadower_wp_kses( __( 'Latitude', 'shadower' ) ),
			'description' => '',
			'section'     => 'panel-theme-map',
			'default'     => '37.7770776',
			'priority'    => 10,
		) );
		
		
		Kirki::add_field( $shadower_kirki_config_id, array(
			'type'        => 'text',
			'settings'    => 'custom_map_longitude',
			'label'       => shadower_wp_kses( __( 'Longitude', 'shadower' ) ),
			'description' => '',
			'section'     => 'panel-theme-map',
			'default'     => '-122.4414289',
			'priority'    => 10,
		) );
	
		
		Kirki::add_field( $shadower_kirki_config_id, array(
			'type'        => 'slider',
			'settings'    => 'custom_map_zoom',
			'label'       => shadower_wp_kses( __( 'Zoom', 'shadower' ) ),
			'description' => '',
			'section'     => 'panel-theme-map',
			'default'     => '14',
			'priority'    => 10,
			'choices' => array(
				'min' => 3,
				'max' => 21,
				'step' => 1,
			),
		) );
		
		
		Kirki::add_field( $shadower_kirki_config_id, array(
			'type'        => 'text',
			'settings'    => 'custom_map_height',
			'label'       => shadower_wp_kses( __( 'Map Height', 'shadower' ) ),
			'description' => shadower_wp_kses( __( 'It default to using a 100% width. The height pixel (px) unit is adjustable.', 'shadower' ) ),
			'section'     => 'panel-theme-map',
			'default'     => '285',
			'priority'    => 10,
		) );
	
		Kirki::add_field( $shadower_kirki_config_id, array(
			'type'        => 'image',
			'settings'    => 'custom_map_marker',
			'label'       => shadower_wp_kses( __( 'Marker', 'shadower' ) ),
			'description' => shadower_wp_kses( __( 'By default, a marker uses a standard image. Markers can display custom images, in which case they are usually referred to as "icons."', 'shadower' ) ),
			'section'     => 'panel-theme-map',
			'default'     => UixShortcodes::plug_directory() .'assets/images/map/map-location.png',
			'priority'    => 10,
		) );

	}

	
	
    /*
     * ------------------------------------------------------------------------------------------------
     */
	
	Kirki::add_panel( 'panel-theme-googlefonts', array(
		'priority'       => 3,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => shadower_wp_kses( __( 'Fonts', 'shadower' ) ),
		'description'    => '',
	) );
	
	
	
	/**
	 * ----------------------  Add google fonts section. ----------------------
	 * 
	 */
	
	Kirki::add_section( 'panel-theme-googlefonts-body', array(
		'title'          => shadower_wp_kses( __( 'Body', 'shadower' ) ),
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
        'panel'          => 'panel-theme-googlefonts',
	) );
	

	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */

	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'     => 'typography',
		'settings' => 'custom_google_font_body_family',
		'label'    => shadower_wp_kses( __( 'Font Family', 'shadower' ) ),
		'section'  => 'panel-theme-googlefonts-body',
		'default'     => array(
			'font-family'    => 'Cardo',
			'variant'        => 'regular',
			'subsets'        => array( 'latin-ext' ),
		),
		'priority'    => 20,
		'output'      => array(
			array(
				'element' => 'body,.font-normal',
			),
		),
	) );


	

	/**
	 * ----------------------  Add google fonts section. ----------------------
	 * 
	 */
	
	Kirki::add_section( 'panel-theme-googlefonts-heading', array(
		'title'          => shadower_wp_kses( __( 'Heading', 'shadower' ) ),
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
        'panel'          => 'panel-theme-googlefonts',
	) );
	

	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */
	 
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'     => 'typography',
		'settings' => 'custom_google_font_heading_family',
		'label'    => shadower_wp_kses( __( 'HTML Headings', 'shadower' ) ),
		'description' => shadower_wp_kses( __( 'With the following tags: h1 , h2 , h3 , h4 , h5 , and h6.', 'shadower' ) ),
		'section'  => 'panel-theme-googlefonts-heading',
		'default'     => array(
			'font-family'    => 'Oswald',
			'variant'        => '700',
			'subsets'        => array( 'latin-ext' ),
		),
		'priority'    => 20,
		'output'      => array(
			array(
				'element' => 'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,.form-merge button[type="submit"],.uix-sc-heading,.uix-sc-subheading',
			),
		),
		
	) );
	
	 


	/**
	 * ----------------------  Add google fonts section. ----------------------
	 * 
	 */
	
	Kirki::add_section( 'panel-theme-googlefonts-menu', array(
		'title'          => shadower_wp_kses( __( 'Menu', 'shadower' ) ),
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
        'panel'          => 'panel-theme-googlefonts',
	) );
	

	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */
	 
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'     => 'typography',
		'settings' => 'custom_google_font_menu_family',
		'label'    => shadower_wp_kses( __( 'Font Family', 'shadower' ) ),
		'section'  => 'panel-theme-googlefonts-menu',
		'default'     => array(
			'font-family'    => 'Oswald',
			'variant'        => 'regular',
			'subsets'        => array( 'latin-ext' ),
		),
		'priority'    => 20,
		'output'      => array(
			array(
				'element' => '.menu-wrapper',
			),
		),
		
		
	) );

 
	
	/**
	 * ----------------------  Add google fonts section. ----------------------
	 * 
	 */
	
	Kirki::add_section( 'panel-theme-googlefonts-brand', array(
		'title'          => shadower_wp_kses( __( 'Brand', 'shadower' ) ),
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
        'panel'          => 'panel-theme-googlefonts',
	) );
	

	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */
	 
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'     => 'typography',
		'settings' => 'custom_google_font_brand_family',
		'label'    => shadower_wp_kses( __( 'Font Family', 'shadower' ) ),
		'section'  => 'panel-theme-googlefonts-brand',
		'default'     => array(
			'font-family'    => 'Cardo',
			'variant'        => '700',
			'subsets'        => array( 'latin-ext' ),
		),
		'priority'    => 20,
		'output'      => array(
			array(
				'element' => '.brand',
			),
		),
		
		
	) );


	
    /*
     * ------------------------------------------------------------------------------------------------
     */

	 
	Kirki::add_section( 'panel-theme-social', array(
		'title'          => shadower_wp_kses( __( 'Social Links', 'shadower' ) ),
		'priority'       => 6,
		'capability'     => 'edit_theme_options',

	) );
	
	/**
	 * Add the configuration.
	 * 
	 * will inherit these options
	 */
	 
	/*Usage*/
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'custom',
		'settings'    => 'custom_usage-social',
		'section'     => 'panel-theme-social',
		'default'     => '<div class="kirki-tipbox">
		'.shadower_wp_kses( __( 'Add social media icons to your website or blog. For example,', 'shadower' ) ).' <code>https://twitter.com/username</code>
		</div>',
		'priority'    => 10,
	) );
	 
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_twitter',
		'label'       => '<i class="fa fa-twitter"></i> ' . shadower_wp_kses( __( 'Twitter', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Twitter Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_facebook',
		'label'       => '<i class="fa fa-facebook"></i> ' . shadower_wp_kses( __( 'Facebook', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Facebook Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_googleplus',
		'label'       => '<i class="fa fa-google-plus"></i> ' . shadower_wp_kses( __( 'Google+', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Google+ Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_medium',
		'label'       => '<i class="fa fa-medium"></i> ' . shadower_wp_kses( __( 'Medium', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Medium Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_producthunt',
		'label'       => '<i class="fa fa-product-hunt"></i> ' . shadower_wp_kses( __( 'Product Hunt', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Product Hunt Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_lastfm',
		'label'       => '<i class="fa fa-lastfm"></i> ' . shadower_wp_kses( __( 'Last.fm', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Last.fm Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_soundcloud',
		'label'       => '<i class="fa fa-soundcloud"></i> ' . shadower_wp_kses( __( 'SoundCloud', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your SoundCloud Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_dropbox',
		'label'       => '<i class="fa fa-dropbox"></i> ' . shadower_wp_kses( __( 'Dropbox', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Dropbox Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_dribbble',
		'label'       => '<i class="fa fa-dribbble"></i> ' . shadower_wp_kses( __( 'Dribbble', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Dribbble Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_pinterest',
		'label'       => '<i class="fa fa-pinterest"></i> ' . shadower_wp_kses( __( 'Pinterest', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Pinterest Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_behance',
		'label'       => '<i class="fa fa-behance"></i> ' . shadower_wp_kses( __( 'Behance', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Behance Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_deviantart',
		'label'       => '<i class="fa fa-deviantart"></i> ' . shadower_wp_kses( __( 'Deviantart', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Deviantart Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_flickr',
		'label'       => '<i class="fa fa-flickr"></i> ' . shadower_wp_kses( __( 'Flickr', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Flickr Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_github',
		'label'       => '<i class="fa fa-github"></i> ' . shadower_wp_kses( __( 'Github', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Github Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_instagram',
		'label'       => '<i class="fa fa-instagram"></i> ' . shadower_wp_kses( __( 'Instagram', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Instagram Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_linkedin',
		'label'       => '<i class="fa fa-linkedin"></i> ' . shadower_wp_kses( __( 'Linkedin', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Linkedin Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_digg',
		'label'       => '<i class="fa fa-digg"></i> ' . shadower_wp_kses( __( 'Digg', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Digg Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_tumblr',
		'label'       => '<i class="fa fa-tumblr"></i> ' . shadower_wp_kses( __( 'Tumblr', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Tumblr Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_youtube',
		'label'       => '<i class="fa fa-youtube"></i> ' . shadower_wp_kses( __( 'Youtube', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Youtube Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_vimeo',
		'label'       => '<i class="fa fa-vimeo-square"></i> ' . shadower_wp_kses( __( 'Vimeo', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Vimeo Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_reddit',
		'label'       => '<i class="fa fa-reddit"></i> ' . shadower_wp_kses( __( 'Reddit', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Reddit Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_weibo',
		'label'       => '<i class="fa fa-weibo"></i> ' . shadower_wp_kses( __( 'Weibo', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Weibo Page URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	
	
	Kirki::add_field( $shadower_kirki_config_id, array(
		'type'        => 'text',
		'settings'    => 'custom_social_web',
		'label'       => '<i class="fa fa-globe"></i> ' . shadower_wp_kses( __( 'Website', 'shadower' ) ),
		'description'        => shadower_wp_kses( __( 'Your Website URL', 'shadower' ) ),
		'section'     => 'panel-theme-social',
		'default'     => '',
		'priority'    => 10,
	) );	
	



}
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/*
 * Display icons linked to social profiles.
 * 
 */
if ( !function_exists( 'shadower_social_buttons' ) ) {
	
	function shadower_social_buttons() {
		
		$social_btn = '';
		$social_property = 'target="_blank"';
		
		$twitter     = get_theme_mod( 'custom_social_twitter' );
		$facebook    = get_theme_mod( 'custom_social_facebook' );
		$googleplus  = get_theme_mod( 'custom_social_googleplus' );
		$medium      = get_theme_mod( 'custom_social_medium' );
		$dribbble    = get_theme_mod( 'custom_social_dribbble' );
		$pinterest   = get_theme_mod( 'custom_social_pinterest' );
		$behance     = get_theme_mod( 'custom_social_behance' );
		$deviantart  = get_theme_mod( 'custom_social_deviantart' );
		$flickr      = get_theme_mod( 'custom_social_flickr' );
		$github      = get_theme_mod( 'custom_social_github' );
		$instagram   = get_theme_mod( 'custom_social_instagram' );
		$linkedin    = get_theme_mod( 'custom_social_linkedin' );
		$digg        = get_theme_mod( 'custom_social_digg' );
		$tumblr      = get_theme_mod( 'custom_social_tumblr' );
		$youtube     = get_theme_mod( 'custom_social_youtube' );
		$vimeo       = get_theme_mod( 'custom_social_vimeo' );
		$reddit      = get_theme_mod( 'custom_social_reddit' );
		$producthunt = get_theme_mod( 'custom_social_producthunt' );
		$lastfm      = get_theme_mod( 'custom_social_lastfm' );
		$soundcloud  = get_theme_mod( 'custom_social_soundcloud' );
		$dropbox     = get_theme_mod( 'custom_social_dropbox' );
		$weibo       = get_theme_mod( 'custom_social_weibo' );
		$web         = get_theme_mod( 'custom_social_web' );
		
		
		
		if ( !empty( $twitter ) )       $social_btn .= '<li><a href="'.$twitter.'" '.$social_property.'><i class="fa fa-twitter"></i></a></li>';
		if ( !empty( $facebook ) )      $social_btn .= '<li><a href="'.$facebook.'" '.$social_property.'><i class="fa fa-facebook"></i></a></li>';
		if ( !empty( $googleplus ) )    $social_btn .= '<li><a href="'.$googleplus.'" '.$social_property.'><i class="fa fa-google-plus"></i></a></li>';
		if ( !empty( $medium ) )        $social_btn .= '<li><a href="'.$medium.'" '.$social_property.'><i class="fa fa-medium"></i></a></li>';
		if ( !empty( $dribbble ) )      $social_btn .= '<li><a href="'.$dribbble.'" '.$social_property.'><i class="fa fa-dribbble"></i></a></li>';
		if ( !empty( $pinterest ) )     $social_btn .= '<li><a href="'.$pinterest.'" '.$social_property.'><i class="fa fa-pinterest"></i></a></li>';
		if ( !empty( $behance) )        $social_btn .= '<li><a href="'.$behance.'" '.$social_property.'><i class="fa fa-behance"></i></a></li>';
		if ( !empty( $deviantart) )     $social_btn .= '<li><a href="'.$deviantart.'" '.$social_property.'><i class="fa fa-deviantart"></i></a></li>';
		if ( !empty( $flickr) )         $social_btn .= '<li><a href="'.$flickr.'" '.$social_property.'><i class="fa fa-flickr"></i></a></li>';
		if ( !empty( $github) )         $social_btn .= '<li><a href="'.$github.'" '.$social_property.'><i class="fa fa-github"></i></a></li>';
		if ( !empty( $instagram) )      $social_btn .= '<li><a href="'.$instagram.'" '.$social_property.'><i class="fa fa-instagram"></i></a></li>';
		if ( !empty( $linkedin) )       $social_btn .= '<li><a href="'.$linkedin.'" '.$social_property.'><i class="fa fa-linkedin"></i></a></li>';
		if ( !empty( $digg) )           $social_btn .= '<li><a href="'.$digg.'" '.$social_property.'><i class="fa fa-digg"></i></a></li>';
		if ( !empty( $tumblr) )         $social_btn .= '<li><a href="'.$tumblr.'" '.$social_property.'><i class="fa fa-tumblr"></i></a></li>';
		if ( !empty( $youtube) )        $social_btn .= '<li><a href="'.$youtube.'" '.$social_property.'><i class="fa fa-youtube"></i></a></li>';
		if ( !empty( $vimeo) )          $social_btn .= '<li><a href="'.$vimeo.'" '.$social_property.'><i class="fa fa-vimeo-square"></i></a></li>';
		if ( !empty( $reddit) )         $social_btn .= '<li><a href="'.$reddit.'" '.$social_property.'><i class="fa fa-reddit"></i></a></li>';
		if ( !empty( $producthunt) )    $social_btn .= '<li><a href="'.$producthunt.'" '.$social_property.'><i class="fa fa-product-hunt"></i></a></li>';
		if ( !empty( $lastfm) )         $social_btn .= '<li><a href="'.$lastfm.'" '.$social_property.'><i class="fa fa-lastfm"></i></a></li>';
		if ( !empty( $soundcloud) )     $social_btn .= '<li><a href="'.$soundcloud.'" '.$social_property.'><i class="fa fa-soundcloud"></i></a></li>';
		if ( !empty( $dropbox) )        $social_btn .= '<li><a href="'.$dropbox.'" '.$social_property.'><i class="fa fa-dropbox"></i></a></li>';
		if ( !empty( $weibo) )          $social_btn .= '<li><a href="'.$weibo.'" '.$social_property.'><i class="fa fa-weibo"></i></a></li>';
		if ( !empty( $web) )            $social_btn .= '<li><a href="'.$web.'" '.$social_property.'><i class="fa fa-globe"></i></a></li>';
		
		echo shadower_wp_kses( $social_btn );
		
	}

}


/*
 * Display Google analytics code.
 * 
 */
if ( !function_exists( 'shadower_google_analytics' ) ) {
	
	add_action( 'wp_enqueue_scripts', 'shadower_google_analytics' );
	function shadower_google_analytics() {
	   wp_add_inline_script( UIX_THEME_SLUG . '-main', 
			'
			(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');
			
			ga(\'create\', \''.esc_attr( get_theme_mod( 'custom_google_analytics' ) ).'\', \'auto\');
			ga(\'send\', \'pageview\');
			' 
		);
	}
	
}


/*
 * The number of posts displayed on your blog
 * 
 */
if ( !function_exists( 'shadower_blog_show' ) ) {
	
	function shadower_blog_show() {
		
		$per = get_option( 'posts_per_page' );
		return $per;
	
	}	
}

/*
 * Returns the blog layout.
 * 
 */
if ( !function_exists( 'shadower_blog_layout' ) ) {
	
	function shadower_blog_layout() {

		return get_theme_mod( 'custom_blog_layout', 'sidebar' );
	
	}	
}


/*
 * Returns the default featured image.
 * 
 */
if ( !function_exists( 'shadower_default_featured_image' ) ) {
	
	function shadower_default_featured_image() {

		return esc_url( UIX_THEME_URL.'/assets/images/default-cover.jpg' );
	
	}	
}


/*
 * Returns share buttons for post
 * 
 */
if ( !function_exists( 'shadower_share_buttons' ) ) {
	
	function shadower_share_buttons( $link = '', $title = '' ) {
	
		return '
		  <a href="https://www.facebook.com/sharer/sharer.php?u='.esc_url( $link ).'" target="_blank" class="ico fb"><i class="fa fa-facebook"></i></a>
		  <a href="https://twitter.com/intent/tweet?url='.esc_url( $link ).'&text='.esc_attr( $title ).'" target="_blank" class="ico tw"><i class="fa fa-twitter"></i></a>
		  <a href="https://plus.google.com/share?url='.esc_url( $link ).'" target="_blank" class="ico gp"><i class="fa fa-google-plus"></i></a>
		  <a href="https://www.pinterest.com/pin/create/button/?url='.esc_url( $link ).'&description='.esc_attr( $title ).'" target="_blank" class="ico pin"><i class="fa fa-pinterest"></i></a>
		  <i class="flaticon flaticon-share-1 ico-share"></i>
		';
	
	}	
}



/**
 * Display custom excerpt
 */
if ( ! function_exists( 'shadower_echo_excerpt' ) ) {
	
	function shadower_echo_excerpt() {
	    
		echo shadower_wp_kses( shadower_excerpt( intval( get_theme_mod( 'custom_blog_excerpt_words', 40 ) ), true ) );
		
	}
	
}

/**
 * Returns title & subheading settings for "custom page"
 *
 */
if ( ! function_exists( 'shadower_page_heading' ) ) {
	
	function shadower_page_heading( $id = '', $type = '', $echo = true ) {
		
		if ( !empty( $id ) && !empty( $type ) ) {
			$heading_case           = get_post_meta( $id, 'cus_page_ex_headingcase', true );
			$heading_letterspacing  = get_post_meta( $id, 'cus_page_ex_letterspacing', true );
			$subheading             = get_post_meta( $id, 'cus_page_ex_subheading', true );
			$heading_styling        = get_post_meta( $id, 'cus_page_ex_headingstyling', true );
			$headingstyling_bg      = get_post_meta( $id, 'cus_page_ex_headingstyling_bg', true );
						
			
			// Check if the custom field has a value.
			if ( empty( $heading_letterspacing ) )       $heading_letterspacing = 0;
			if ( empty( $heading_styling ) )             $heading_styling = 'no-bg';
			if ( empty( $headingstyling_bg ) )           $headingstyling_bg = esc_url( UIX_THEME_ADMIN_ASSETS_URL.'/images/cover-default-bg.jpg' );	
			if ( empty( $heading_case ) ) {
				$text_style = 'style="text-transform:none !important;letter-spacing:normal !important;"';
			} else {
				$text_style = 'style="text-transform:'.esc_attr( $heading_case ).' !important;letter-spacing:'.esc_attr( $heading_letterspacing ).'px !important";';
			}
			
			
			switch ( $type ) {
				case 'text' :
				
				    if ( $echo ) {
						echo shadower_wp_kses( $text_style );
					} else {
						return shadower_wp_kses( $text_style );
					}
					
					break;
				case 'subheading' :
				
				    if ( $echo ) {
						echo shadower_wp_kses( $subheading );
					} else {
						return shadower_wp_kses( $subheading );
					}
	
					break;
				case 'style' :
				
				    if ( $echo ) {
						echo shadower_wp_kses( $heading_styling );
					} else {
						return shadower_wp_kses( $heading_styling );
					}
	
					break;
				case 'heading_bg' :
				
				    if ( $echo ) {
						echo esc_url( $headingstyling_bg );
					} else {
						return esc_url( $headingstyling_bg );
					}
	
					break;
				default:
				
				    if ( $echo ) {
						echo '';
					} else {
						return '';
					}
			}
			
			
		}
	
	}
	
}


/**
 * Returns layout settings for "custom page"
 *
 */
if ( ! function_exists( 'shadower_page_layout' ) ) {
	
	function shadower_page_layout( $id = '', $type = '', $echo = true ) {
		
		if ( !empty( $id ) && !empty( $type ) ) {
			$sidebar                = get_post_meta( $id, 'cus_page_ex_sidebar', true );
			$title_status           = get_post_meta( $id, 'cus_page_ex_title', true );
			
			
			// Check if the custom field has a value.
			if ( empty( $sidebar ) )                $sidebar = 'sidebar';
			if ( empty( $title_status ) )           $title_status = 'show';	
						
			switch ( $type ) {
				case 'sidebar' :
				
				    if ( $echo ) {
						echo shadower_wp_kses( $sidebar );
					} else {
						return shadower_wp_kses( $sidebar );
					}
					
					break;
				case 'title' :
				
				    if ( $echo ) {
						echo shadower_wp_kses( $title_status );
					} else {
						return shadower_wp_kses( $title_status );
					}
	
					break;
				default:
				
				    if ( $echo ) {
						echo '';
					} else {
						return '';
					}
			}
			
			
		}
	
	}
	
}
<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}
 
/**
 * Changing excerpt more
 */
if ( ! function_exists( 'shadower_modify_read_more_link' ) ) {
	
	add_filter( 'the_content_more_link', 'shadower_modify_read_more_link' );
	function shadower_modify_read_more_link( $more ) {
	    
		return '<p><a href="' . esc_url( get_permalink() ) . '" class="link">' .shadower_wp_kses( __( 'Continue Reading', 'shadower' ) ). '</a></p>';
		
	}
	
}




/**
 * Custom excerpts based on wp_trim_words
 *
 * @since	1.0.0
 * @link	http://codex.wordpress.org/Function_Reference/wp_trim_words
 */
if ( ! function_exists( 'shadower_excerpt' ) ) {

	function shadower_excerpt( $length = 150, $readmore = false ) {

		// Get global post
		global $post;

		// Get post data
		$id			    = $post->ID;
		$excerpt	    = $post->post_excerpt;
		$content        = get_the_content( $id );
		$readmore_link = '';
		
		//returns tags @link	http://codex.wordpress.org/Function_Reference/get_the_tags
		$tags = get_the_tags();
		$output_tags = '';
		if ( $tags ) {
			$output_tags .= '<p class="post-tags" itemprop="keywords">';
			foreach ( $tags as $tag ){
				
				$tag_link = get_tag_link( $tag->term_id );
		
				$output_tags .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
				$output_tags .= "{$tag->name}</a>";
				
			}
			$output_tags .= '</p>';
		}

		
		
		//More button
		if ( $readmore == true ) {
			$btn_text	= apply_filters( 'shadower_redmore_text', shadower_wp_kses( __( 'Continue reading', 'shadower' ) ) );
			$btn_link	= '<p><a href="'. esc_url( get_permalink( $id ) ) .'" class="link">'. $btn_text .'</a></p>';
			$readmore_link = apply_filters( 'shadower_redmore_link', $btn_link );
		}
		
	
		if ( $excerpt ) {
			/**
			 * Display custom excerpt
			 *
			 * @since	1.0.0
			 */		
			$output = $excerpt;
			
			if ( shadower_has_ultimate_excerpt( $output, $content ) ) {
				$readmore_link = '';
			}
	
			$output .= $readmore_link;
			
			echo $output;
			
		} elseif ( strpos( $post->post_content, '<!--more-->' ) ) {

			/**
			 * Check for more tag
			 *
			 * @since	1.0.0
			 */			
			the_content();
			
		} else {

			/**
			 * Generate auto excerpt
			 *
			 * @since	1.0.0
			 */
			 
			$wp_media_suffix = 'mp3|m4a|ogg|wav|mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2';
			
			// capture the post content with html
			ob_start();
				the_content();
				$out = ob_get_contents();
			ob_end_clean();
			
			//Determine whether content includes media element
			$fr = 'rame';
			$md = explode( '|', $wp_media_suffix);
			
			//remove wp media
			if ( strpos( $out, 'if'.$fr ) ) {
				$content = preg_replace( '/<if'.$fr.'.*<\/if'.$fr.'>/i', '', $out ); 
			}
			
			 
			//strip shortcodes
			$content = strip_shortcodes( $content );
			
			//Determine whether content includes chinese
			if ( preg_match('/[\p{Han}]/simu', $content ) ) {
				$output = wp_html_excerpt( $content, $length, '...' );
			} else {
				$output = wp_trim_words( $content, $length );
			}
			
			//remove hyperlink for video and audio
			if ( ! strpos( $out, 'if'.$fr ) ) {
				foreach( $md as $v ) {
					if ( strpos( $out, $v ) ) {
						$output = preg_replace( '/(http)(.)*([a-z0-9\-\.\_])+\.('.$wp_media_suffix.')/i', '', $output );
						break;
					}
					
				}
			}
			
			if ( empty( $output ) || shadower_has_ultimate_excerpt( $output, get_the_content( $id ) ) ) {
				$readmore_link = '';
			}
	
	
			$output .= $readmore_link;
			
			echo $output;
			
		}


	}
}


//Detect If the "ultimate excerpt" is empty
if ( ! function_exists( 'shadower_has_ultimate_excerpt' ) ) {

	function shadower_has_ultimate_excerpt( $str1, $str2 ) {

		if ( mb_strlen( wp_strip_all_tags( $str1, true ), 'UTF8' ) >= mb_strlen( wp_strip_all_tags( $str2, true), 'UTF8' )  ) {
			return true;
		} else {
			return false;
		}


	}
}

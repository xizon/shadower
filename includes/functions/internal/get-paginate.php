<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

/**
 * [Usage:]
 *
    if ( get_theme_mod( 'custom_pagination', true ) ) {
        //Use numeric Paginate
        shadower_pagination( 3, '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>', true, $infinitescroll_enable );	 
    } else {
        //Only "next" and "previous" button
        shadower_pagejump( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>', true, $infinitescroll_enable ); 
    }
 *
 */


/**
 * Numbered Pagination
 *
 */
if ( ! function_exists( 'shadower_pagination') ) {

	function shadower_pagination( $show = 3, $custom_prev = '&larr; Previous', $custom_next = 'Next &rarr;', $li = true, $inf_enable = false, $custom_query = '' ) {
		
		
		$GLOBALS[ 'paged_temp' ]  = 1;
		$pagehtml                = '';
		$pageshow                = '';
		$pagehtml_before         = '<ul>'."\n";
		$pagehtml_after          = '</ul>'."\n";


		// Get currect number of pages and define total var
		if ( $custom_query ) {
			$total = $custom_query->max_num_pages;
		} else {
			global $wp_query;
			$total = $wp_query->max_num_pages;
		}
		

		// Display pagination if total var is greater then 1 ( current query is paginated )
		if ( $total > 1 )  {

			// Set current page if not defined
			if ( ! $current_page = get_query_var( 'paged') ) {
				 $current_page = 1;
			 }

			// Get currect format
			if ( get_option( 'permalink_structure') ) {
				$format = 'page/%#%/';
			} else {
				$format = '&paged=%#%';
			}

			// Display pagination
			$paginate = paginate_links(array(
				'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'format'    => $format,
				'current'   => max( 1, get_query_var( 'paged') ),
				'total'     => $total,
				'mid_size'  => 2,
				'end_size'  => $show,//How many numbers on either the start and the end list edges.
				'type'      => 'array',
				'prev_text' => $custom_prev,
				'next_text' => $custom_next,
			) );
			
			if( is_array( $paginate ) ) {
				
				foreach ( $paginate as $page ) {
					
						if ($li === true){
							
							if ( strpos( $page, 'prev') ){
								$pagehtml .= '<li class="previous">'.$page.'</li>'."\n";
							}elseif ( strpos( $page, 'next' ) ){
								$pagehtml .= '<li class="next">'.$page.'</li>'."\n";
							}elseif ( strpos( $page, 'current' ) ){
								$pagehtml .= '<li class="active">'.$page.'</li>'."\n";
							}else{
								$pagehtml .= '<li>'.$page.'</li>'."\n";
							}
							
						}else{
							
							$pagehtml_before = '';
							$pagehtml_after  = '';
							$pagehtml       .= $page;
			
							
						}

	
				}
			
			}
		
			
			$pageshow = $pagehtml_before.$pagehtml.$pagehtml_after;
			
			
		}
		
		echo $pageshow; 
		
		
	}

}


/**
 * Next and previous pagination
 *
 */
if ( ! function_exists( 'shadower_pagejump' ) ) {

	function shadower_pagejump( $custom_prev = '&larr; Previous', $custom_next = 'Next &rarr;', $li = true, $inf_enable = false, $pages = '' ) {

	
		// Set correct paged var
		global $paged;
		

		$pageshow = '';
		
		
		if ( empty( $paged ) ) {
			$paged = 1;
		}

		// Get pages var
		if ( ! $pages ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages ) {
				$pages = 1;
			}
		}

		// Display next/previous pagination
		if ( 1 != $pages ) {
			
			if ($li === true){
                
				$pageshow .= '<ul>'."\n";
				$pageshow .= '<li class="previous">';
				$pageshow .= get_previous_posts_link( $custom_prev );
				$pageshow .= '</li>'."\n";
				$pageshow .= '<li class="next">';
				$pageshow .= get_next_posts_link( $custom_next );
				$pageshow .= '</li>'."\n";
				$pageshow .= '</ul>'."\n";
	

			}else{
				
				$pageshow .= get_previous_posts_link( $custom_prev );
				$pageshow .= get_next_posts_link( $custom_next );
				
			}			
			
		}
		
		echo $pageshow; 
		
		
	}

}

/**
 * Load more button
 *
 */
if ( !function_exists( 'shadower_loadmore' ) ) {

	function shadower_loadmore() {

		echo '<div class="pagination-infinitescroll">'."\n";
		next_posts_link( shadower_wp_kses( __( 'Load More', 'shadower' ) ) );
		echo '</div>'."\n";
		
	}

}


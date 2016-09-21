<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/**
 *
 * [Usage:]
 
		$output_articles = '';
		$output_articles_post = shadower_get_posts( get_option( 'posts_per_page' ), 'new' );
		//$output_articles_post = shadower_get_posts( get_option( 'posts_per_page' ), 'hot' );
		
		if ( isset( $output_articles_post ) ) {
		
			foreach( (array)$output_articles_post as $key=>$value ){
				if ( $value[ 'imageURL' ] == '' ){
					$featured_image = '';
				}else{
					$featured_image = '<img src="'.esc_url( $value[ 'imageURL' ] ).'" class="featured-image"> ';
				}
					$output_articles.='
					<li>
						<a href="'.esc_url( $value[ 'link' ] ).'" title="'.esc_attr( $value[ 'title' ] ).'" >'.shadower_wp_kses( $value[ 'title' ] ).'</a>
					</li>
					';
			}
			echo $output_articles;			
		
		
		}else{
			get_template_part( 'content', 'none' );
		}
 
 
 
 */
 
if ( !function_exists( 'shadower_get_posts' ) ) {
	
	function shadower_get_posts( $limit, $order ){
		global $post;
		$limit = ( $limit == '' || !$limit ) ? 10 : $limit;
		$order_type = 'date';
		if ( $order == 'hot' ) {
			$order_type = 'comment_count';
		}
		if ( $order == 'new' ) {
			$order_type = 'date';
		}
		
		$new_args = array(
		    'orderby'         => $order_type,
			'order'           => 'desc',
			'posts_per_page'  => $limit,
			'post_status'     => 'publish',
		);
		$list = new WP_Query( $new_args );
		if( $list->have_posts() ){
			$out = array();
			$k = 0;
			while( $list->have_posts() ) : $list->the_post();
			        
					//featured image
					$thumbnail_src          =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
					$post_thumbnail_src     =  $thumbnail_src[0];
		
					$out[$k][ 'id' ]         = get_the_ID();
					$out[$k][ 'imageURL' ]   = $post_thumbnail_src;
					$out[$k][ 'title' ]      = get_the_title();
					$out[$k][ 'link' ]       = get_permalink();
					$out[$k][ 'comment' ]    = get_comments_number();
					$out[$k][ 'time' ]       = get_the_date();
					$out[$k][ 'author' ]     = '<a href = "'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.get_the_author_link().'</a>';
				$k++;
			endwhile;
			// Reset the post data
			wp_reset_postdata();
			
		}else{
			$out = null;
		}
	
		return $out;
	}
}


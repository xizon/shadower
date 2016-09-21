<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


if ( !function_exists( 'shadower_add_tag_class' ) ) {
	
	add_filter( "term_links-post_tag", 'shadower_add_tag_class');
	function shadower_add_tag_class($links) {
		return str_replace('<a href="', '<a class="tag-list" target="_blank" href="', $links );
	}


}


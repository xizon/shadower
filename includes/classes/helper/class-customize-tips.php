<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


if ( !class_exists( 'Shadower_Customize_Tips' ) ) {
	
	class Shadower_Customize_Tips {
		
		 public static function init() {
			add_action( 'customize_controls_print_footer_scripts', array( __CLASS__, 'output_js' ) );
			add_action( 'customize_controls_print_styles', array( __CLASS__, 'output_style' ) );
		 }
		 
		 public static function output_js() {
	
			echo '
				<script>
					jQuery(document).ready(function(){  
					
						jQuery(\'.accordion-section:eq(1)\').prepend(\'<span class="get-addon"><a href="https://uiux.cc/?rel='.home_url( '/' ).'" target="_blank">'.esc_html__( 'Theme Available! ', 'shadower' ).'<br> '.esc_html__( 'Take a look more themes from UIUX Lab', 'shadower' ).' &rarr;</a></span>\').hide();
						
					
					});
					
				</script>
	
			';
	 
		 }
		 
		 public static function output_style() {
	
			echo '
			<style>
				
				.get-addon {
					margin: 0;
					display: block;
				}
				
				.get-addon a {
					display: block;
					padding-left: 15px;
					padding-right: 0;
					background: #57C97A;
					color: #FFF;
					font-size: 11px;
					padding: 3px 5px;
					font-weight: bold;
					-moz-transition: .2s ease-in-out;
					-o-transition: .2s ease-in-out;
					-webkit-transition: .2s ease-in-out;
					transition: .2s ease-in-out;
					-webkit-border-radius: 2px; 
					-moz-border-radius: 2px; 
					border-radius: 2px;
					margin: 0;
					
				}
				
				.get-addon a:hover {
					background: #333;
				}
				
			</style>
			';
	 
		 }
		 
	}

}


// Creating an instance
Shadower_Customize_Tips::init();

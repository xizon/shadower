<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

 
/*
 * Creating the Custom Field Box
 * 
 */
if ( !function_exists( 'shadower_page_ex_metaboxes_headingarea' ) ) {
	
	add_action( 'admin_init', 'shadower_page_ex_metaboxes_headingarea' );  
	function shadower_page_ex_metaboxes_headingarea(){  
		add_meta_box( 
			'shadower_page_meta_heading', 
			__( 'Title & Subheading Settings', 'shadower' ), 
			'shadower_page_ex_metaboxes_headingarea_options', 
			'page', 
			'normal', 
			'high'
		);  
	}  

}
   

if ( !function_exists( 'shadower_page_ex_metaboxes_headingarea_options' ) ) {
	
	function shadower_page_ex_metaboxes_headingarea_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce' );
	
?>  
         
         
		<!-- Begin Fields -->
		<table class="form-table custom_metabox">
        

			<tr>
				<th class="custom_metabox_title"><label><?php echo shadower_wp_kses( __( 'Capitalization', 'shadower' ) ); ?></label><p class="custom_metabox_title_desc"><?php echo shadower_wp_kses( __( 'Change the capitalization of the page title & subheading', 'shadower' ) ); ?></p></th>
				<td>
				   
						<label class="custom_radio_text"><input type="radio" name="cus_page_ex_headingcase" value="uppercase" <?php echo ( get_post_meta( $object->ID, 'cus_page_ex_headingcase', true ) == 'uppercase' ) ? esc_attr( 'checked' ) : ''; ?>/><?php echo shadower_wp_kses( __( 'Upper case', 'shadower' ) ); ?></label>
					   <label class="custom_radio_text"><input type="radio" name="cus_page_ex_headingcase" value="lowercase" <?php echo ( get_post_meta( $object->ID, 'cus_page_ex_headingcase', true ) == 'lowercase' ) ? esc_attr( 'checked' ) : ''; ?>/><?php echo shadower_wp_kses( __( 'Lower case', 'shadower' ) ); ?></label>
                       <label class="custom_radio_text"><input type="radio" name="cus_page_ex_headingcase" value="capitalize" <?php echo ( get_post_meta( $object->ID, 'cus_page_ex_headingcase', true ) == 'capitalize' ) ? esc_attr( 'checked' ) : ''; ?>/><?php echo shadower_wp_kses( __( 'Capitalized case', 'shadower' ) ); ?></label>
                       <label class="custom_radio_text"><input type="radio" name="cus_page_ex_headingcase" value="none" <?php echo ( get_post_meta( $object->ID, 'cus_page_ex_headingcase', true ) == 'none'  || empty( get_post_meta( $object->ID, 'cus_page_ex_headingcase', true ) )  ) ? esc_attr( 'checked' ) : ''; ?>/><?php echo shadower_wp_kses( __( 'None', 'shadower' ) ); ?></label>
                       
				</td>
			</tr>
            
        
 			<tr>
				<th class="custom_metabox_title"><label><?php echo shadower_wp_kses( __( 'Subheading', 'shadower' ) ); ?></label><p class="custom_metabox_title_desc"><?php echo shadower_wp_kses( __( 'Enter your page subheading. It could be left blank.', 'shadower' ) ); ?></p></th>
				<td>
				       <textarea rows="3" cols="40" name="cus_page_ex_subheading" id="cus_page_ex_subheading"><?php echo esc_textarea( get_post_meta( $object->ID, 'cus_page_ex_subheading', true ) ); ?></textarea>
                       
				</td>
			</tr>
            
            
        
 			<tr>
				<th class="custom_metabox_title"><label><?php echo shadower_wp_kses( __( 'Letter Spacing', 'shadower' ) ); ?></label><p class="custom_metabox_title_desc"><?php echo shadower_wp_kses( __( 'The space between characters for the page title & subheading.', 'shadower' ) ); ?></p></th>
				<td>
                <input type="text" class="custom_short_text" value="<?php echo ( get_post_meta( $object->ID, 'cus_page_ex_letterspacing', true ) == '' ) ? 0 : esc_attr( get_post_meta( $object->ID, 'cus_page_ex_letterspacing', true ) ); ?>" name="cus_page_ex_letterspacing">px
                
				
				</td>
			</tr>
        
			
     
		</table>
		<!-- End Fields -->
	
    
<?php  
	}  
}



 
if ( !function_exists( 'shadower_page_ex_metaboxes_pageattrs' ) ) {
	
	add_action( 'admin_init', 'shadower_page_ex_metaboxes_pageattrs' );  
	function shadower_page_ex_metaboxes_pageattrs(){  
		add_meta_box( 
			'shadower_page_meta_attr', 
			__( 'Page Settings', 'shadower' ), 
			'shadower_page_ex_metaboxes_pageattrs_options', 
			'page', 
			'normal', 
			'high'
		);  
	}  

}
   

if ( !function_exists( 'shadower_page_ex_metaboxes_pageattrs_options' ) ) {
	
	function shadower_page_ex_metaboxes_pageattrs_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce' );
	
?>  
         
         
		<!-- Begin Fields -->
		<table class="form-table custom_metabox">
            
             <div class="note">
                 <p>
                 <em><?php echo shadower_wp_kses( __( 'Just make sure to select this template file as the <strong>"Default Template"</strong> for this page from the <strong>"Page Attributes"</strong> section. ', 'shadower' ) ); ?></em>
                 </p>
             </div>
        
  			<tr>
				<th class="custom_metabox_title"><label><?php echo shadower_wp_kses( __( 'Page Title Style', 'shadower' ) ); ?></label></th>
				<td>
                
                  <div class="radio custom_radio_selector" data-target-id="cus_page_ex_headingstyling">
                    <span data-value="no-bg" data-toggle-id="cus_page_ex_headingstyling_bg_wrapper" data-toggle="0" class="custom_toggle_selector toggle-radio-options img <?php echo ( get_post_meta( $object->ID, 'cus_page_ex_headingstyling', true ) == 'no-bg' || empty( get_post_meta( $object->ID, 'cus_page_ex_headingstyling', true ) ) ) ? esc_attr( 'active' ) : ''; ?>">
                      <img alt="" src="<?php echo esc_url( UIX_THEME_ADMIN_ASSETS_URL . '/images/page-heading-area/no-background.png' ); ?>">
                    </span>
                  
                    
                    <span data-value="bg" data-toggle-id="cus_page_ex_headingstyling_bg_wrapper" data-toggle="1" class="custom_toggle_selector toggle-radio-options img <?php echo ( get_post_meta( $object->ID, 'cus_page_ex_headingstyling', true ) == 'bg' ) ? esc_attr( 'active' ) : ''; ?>">
                      <img alt="" src="<?php echo esc_url( UIX_THEME_ADMIN_ASSETS_URL . '/images/page-heading-area/background.png' ); ?>">
                    </span>


                    <div id="cus_page_ex_headingstyling_bg_wrapper" style="display: <?php echo ( get_post_meta( $object->ID, 'cus_page_ex_headingstyling', true ) == 'no-bg' || empty( get_post_meta( $object->ID, 'cus_page_ex_headingstyling', true ) ) ) ? esc_attr( 'none' ) : esc_attr( 'block' ); ?>;" >
						<?php
                        Shadower_UploadMedia::add( array(
                            'title'          => '',
							'class'          => 'regular-text',
                            'id'             => esc_attr( 'cus_page_ex_headingstyling_bg' ),
                            'name'           => esc_attr( 'cus_page_ex_headingstyling_bg' ),
                            'value'          => ( get_post_meta( $object->ID, 'cus_page_ex_headingstyling_bg', true ) ) ? esc_url( get_post_meta( $object->ID, 'cus_page_ex_headingstyling_bg', true ) ) : esc_url( UIX_THEME_ADMIN_ASSETS_URL.'/images/cover-default-bg.jpg' ),
                            'placeholder'    => esc_attr__( 'Image URL', 'shadower' ),
                        ));
                        ?>
						
                    </div>
                    
                    
                    
                   
                  </div>
                  <input type="hidden" id="cus_page_ex_headingstyling" name="cus_page_ex_headingstyling" value="<?php echo ( get_post_meta( $object->ID, 'cus_page_ex_headingstyling', true ) ) ? esc_attr( get_post_meta( $object->ID, 'cus_page_ex_headingstyling', true ) ) : esc_attr( 'no-bg' ); ?>">
              
				</td>
			</tr>
     
        
			<tr>
				<th class="custom_metabox_title"><label><?php echo shadower_wp_kses( __( 'Display Page Title', 'shadower' ) ); ?></label></th>
				<td>
				   
                     
						<label class="custom_radio_text"><input type="radio" name="cus_page_ex_title" value="hide" <?php if ( get_post_meta( $object->ID, 'cus_page_ex_title', true ) == 'hide' ){ echo 'checked';}; ?>/><?php echo shadower_wp_kses( __( 'Disable', 'shadower' ) ); ?></label>
					   <label class="custom_radio_text"><input type="radio" name="cus_page_ex_title" value="show" <?php if ( get_post_meta( $object->ID, 'cus_page_ex_title', true ) == 'show' || empty( get_post_meta( $object->ID, 'cus_page_ex_title', true ) ) ){ echo 'checked';}; ?>/><?php echo shadower_wp_kses( __( 'Enable', 'shadower' ) ); ?></label>
				</td>
			</tr>
            
            
            
			<tr>
				<th class="custom_metabox_title"><label><?php echo shadower_wp_kses( __( 'Sidebar', 'shadower' ) ); ?></label></th>
				<td>
                
                  <div class="radio custom_radio_selector" data-target-id="cus_page_ex_sidebar">
                    <span data-value="no-sidebar" class="toggle-radio-options img <?php echo ( get_post_meta( $object->ID, 'cus_page_ex_sidebar', true ) == 'no-sidebar' ) ? esc_attr( 'active' ) : ''; ?>">
                      <img alt="" src="<?php echo esc_url( UIX_THEME_ADMIN_ASSETS_URL . '/images/layouts/no-sidebar.png' ); ?>">
                    </span>
     
                    <span data-value="sidebar" class="toggle-radio-options img <?php echo ( get_post_meta( $object->ID, 'cus_page_ex_sidebar', true ) == 'sidebar' || empty( get_post_meta( $object->ID, 'cus_page_ex_headingstyling', true ) ) ) ? esc_attr( 'active' ) : ''; ?>">
                      <img alt="" src="<?php echo esc_url( UIX_THEME_ADMIN_ASSETS_URL . '/images/layouts/sidebar.png' ); ?>">
                    </span>
                    
                   
                  </div>
                  <input type="hidden" id="cus_page_ex_sidebar" name="cus_page_ex_sidebar" value="<?php echo ( get_post_meta( $object->ID, 'cus_page_ex_sidebar', true ) ) ? esc_attr( get_post_meta( $object->ID, 'cus_page_ex_sidebar', true ) ) : esc_attr( 'sidebar' ); ?>">
                  
                   
			   
				</td>
			</tr>
            
     
     
		</table>
		<!-- End Fields -->
	
<?php  
	}  
}



/*
 * Saving the Custom Data
 * 
 */ 
if ( !function_exists( 'shadower_page_save_custom_meta_box' ) ) {
	
	add_action( 'save_post', 'shadower_page_save_custom_meta_box', 10, 3);
	function shadower_page_save_custom_meta_box( $post_id, $post, $update ) {
		if ( !isset( $_POST[ 'meta-box-nonce' ] ) || !wp_verify_nonce($_POST[ 'meta-box-nonce' ], basename( __FILE__ ) ) ) return $post_id;
		if( !current_user_can( 'edit_post', $post_id ) )return $post_id;
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
		
		$slug = "page";
		if( $slug != $post->post_type ) return $post_id;
	
		$cus_page_ex_subheading 	         = wp_unslash( $_POST[ 'cus_page_ex_subheading' ] );
		$cus_page_ex_title 	                 = sanitize_text_field( $_POST[ 'cus_page_ex_title' ] );
		$cus_page_ex_sidebar 	             = sanitize_text_field( $_POST[ 'cus_page_ex_sidebar' ] );
		$cus_page_ex_headingstyling 	     = sanitize_text_field( $_POST[ 'cus_page_ex_headingstyling' ] );
		$cus_page_ex_headingstyling_bg 	     = sanitize_text_field( $_POST[ 'cus_page_ex_headingstyling_bg' ] );
		$cus_page_ex_headingcase 	         = sanitize_text_field( $_POST[ 'cus_page_ex_headingcase' ] );
		
		$cus_page_ex_letterspacing 	         = intval( $_POST[ 'cus_page_ex_letterspacing' ] );
		if ( !$cus_page_ex_letterspacing ) {
			$cus_page_ex_letterspacing = 0;
		}	
		
	
		if( isset( $_POST[ 'cus_page_ex_title' ] ) ) update_post_meta($post_id, 'cus_page_ex_title', $cus_page_ex_title );
		if( isset( $_POST[ 'cus_page_ex_sidebar' ] ) ) update_post_meta($post_id, 'cus_page_ex_sidebar', $cus_page_ex_sidebar );
		if( isset( $_POST[ 'cus_page_ex_subheading' ] ) ) update_post_meta($post_id, 'cus_page_ex_subheading', $cus_page_ex_subheading );
		if( isset( $_POST[ 'cus_page_ex_letterspacing' ] ) ) update_post_meta($post_id, 'cus_page_ex_letterspacing', $cus_page_ex_letterspacing );
		if( isset( $_POST[ 'cus_page_ex_headingstyling' ] ) ) update_post_meta($post_id, 'cus_page_ex_headingstyling', $cus_page_ex_headingstyling );
		if( isset( $_POST[ 'cus_page_ex_headingstyling_bg' ] ) ) update_post_meta($post_id, 'cus_page_ex_headingstyling_bg', $cus_page_ex_headingstyling_bg );
		if( isset( $_POST[ 'cus_page_ex_headingcase' ] ) ) update_post_meta($post_id, 'cus_page_ex_headingcase', $cus_page_ex_headingcase );
		
	
	}

}



/*
 * Removing a aeta box for page
 * 
 */ 
if ( !function_exists( 'shadower_page_remove_custom_field_meta_box' ) ) {
	
	add_action( 'do_meta_boxes', 'shadower_page_remove_custom_field_meta_box' );
	function shadower_page_remove_custom_field_meta_box() {
		remove_meta_box( 'postimagediv', 'page', 'side' );
	}
}



if ( !function_exists( 'shadower_page_featured_image_column_remove_post_types' ) ) {
	
	add_filter( 'featured_image_column_post_types', 'shadower_page_featured_image_column_remove_post_types', 11 );
	function shadower_page_featured_image_column_remove_post_types( $post_types ) {
		foreach( $post_types as $key => $post_type ) {
			if ( 'page' === $post_type ) // Post type you'd like removed. Ex: 'post' or 'page'
				unset( $post_types[$key] );
		}
		return $post_types;
	}
}




/*
 * Remove comments metabox of "page" but still allow comments
 *
*/
/*
if ( is_admin() ) {
	if ( !function_exists( 'shadower_remove_meta_boxes' ) ) {
		
		add_action( 'admin_menu', 'shadower_remove_meta_boxes' );
		function shadower_remove_meta_boxes() {
			remove_meta_box( 'commentstatusdiv', 'page', 'normal' );
		
		}
	}
	
}
*/



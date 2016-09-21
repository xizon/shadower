<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


if ( !class_exists( 'Shadower_UploadMedia' ) ) {
	
	class Shadower_UploadMedia {
		
		public static function add( $args ) {
			
			if ( !is_array( $args ) ) return;
			$title            = ( isset( $args[ 'title' ] ) ) ? shadower_wp_kses( $args[ 'title' ] ) : '';
			$value            = ( isset( $args[ 'value' ] ) ) ? esc_url( $args[ 'value' ] ) : '';
			$placeholder      = ( isset( $args[ 'placeholder' ] ) ) ? esc_attr( $args[ 'placeholder' ] ) : '';
			$id               = ( isset( $args[ 'id' ] ) ) ? esc_attr( $args[ 'id' ] ) : '';
			$class            = ( isset( $args[ 'class' ] ) ) ? esc_attr( $args[ 'class' ] ) : 'widefat';
			$name             = ( isset( $args[ 'name' ] ) ) ? esc_attr( $args[ 'name' ] ) : '';
			
			//Enqueue the media scripts
			wp_enqueue_media();
	
			echo '
			<div class="custom-upbtn-container">
				
				<label for="'.$id.'">'.$title.'</label>
				'.( !empty( $id ) ? '<input type="text" id="'.$id.'" class="'.$class.'" name="'.$name.'" value="'.$value.'" placeholder="'.$placeholder.'" />' : '' ).' 
				<a href="javascript:" class="custom-button custom-upbtn upload-media-btn" id="trigger_id_'.$id.'" data-remove-btn="drop_trigger_id_'.$id.'" data-insert-img="'.$id.'" data-insert-preview="'.$id.'_preview"><i class="dashicons dashicons-format-image"></i>'.esc_html__( 'Select an image', 'shadower' ).'</a>
				<a href="javascript:" class="remove-btn" id="drop_trigger_id_'.$id.'" data-insert-img="'.$id.'" data-insert-preview="'.$id.'_preview" style="display:none">'.esc_html__( 'remove image', 'shadower' ).'</a>
				'.( !empty( $value ) ? '<div id="'.$id.'_preview" class="custom-field_img_preview" style="display:block"><img src="'.$value.'" alt=""></div>' : '<div id="'.$id.'_preview" class="custom-field_img_preview"><img src="" alt=""></div>' ).' 
				
			</div>
			'."\n";	
		 
		}
		
	
	}

}



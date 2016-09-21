<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/*
 * Enable comments on contact pages. 
 *
 */
if ( !function_exists( 'shadower_commentopen_contact' ) ) {
	
	add_filter( 'comments_open', 'shadower_commentopen_contact', 10, 2 );
	function shadower_commentopen_contact( $open, $post_id ) {
		$post = get_post( $post_id );
		if ( is_page( Shadower_Core::get_pageid_from_template( 'page-contact.php' ) ) ) {
			if ( $post->comment_status == 'closed' ) {
				$open = true;
				//Update comment status
				$cur_post = array();
				$cur_post[ 'comment_status' ] = 'open';
				wp_update_post( $cur_post );		
	
			}
		}
		return $open;
		
	}
}



/*
* Moving the Comment Text Field to Bottom
*
*/
if ( !function_exists( 'shadower_move_comment_field_to_bottom' ) ) {
	add_filter( 'comment_form_fields', 'shadower_move_comment_field_to_bottom' );
	function shadower_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields[ 'comment' ];
		unset( $fields[ 'comment' ] );
		$fields[ 'comment' ] = $comment_field;
		return $fields;
	}

}


/*
* Custom HTML in comment_form() 
*
*/
if ( !function_exists( 'shadower_custom_comment_form' ) ) {
	
	add_filter( 'comment_form_defaults', 'shadower_custom_comment_form' );
	function shadower_custom_comment_form( $form_options ) {
	
		//Extend WordPress comment form with your own custom fields.
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$required_text = sprintf( ' ' . shadower_wp_kses( __( 'Required fields are marked %s', 'shadower' ) ), '<span class="req-icon">*</span>' );
		$post_id = get_the_ID();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		
		
		
		$fields =  array( 
		
		'author' => '<div class="controls">
						  <input id="author" name="author" type="text" class="float-label required" value="'.esc_attr( $commenter['comment_author'] ).'" '.$aria_req.' />
						  <label for="author">'.shadower_wp_kses( __( 'Name', 'shadower' ) ).'</label>'.( $req ? '<span class="req-icon">*</span>' : '' ).'
					</div>',
					
		'email'  => '<div class="controls">
						  <input id="email" name="email" type="email" class="float-label required email" value="'.esc_attr( $commenter['comment_author_email'] ).'" '.$aria_req.' />
						  <label for="email">'.shadower_wp_kses( __( 'Email', 'shadower' ) ).'</label>'.( $req ? '<span class="req-icon">*</span>' : '' ).'
					 </div>',
					 
		'url'    => '<div class="controls">
						 <input id="url" name="url" type="text" class="float-label" value="'.esc_attr( $commenter['comment_author_url'] ).'" />
						 <label for="url">'.shadower_wp_kses( __( 'Website', 'shadower' ) ).'</label>
					</div>', );
		
		
		$form_options = array( 
		
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			
			'comment_field'        => '<div class="controls">
											<textarea id="comment" class="float-label required" name="comment" '.$aria_req.'></textarea>
											<label for="comment">'.shadower_wp_kses( __( 'Comment', 'shadower' ) ).'</label>'.( $req ? '<span class="req-icon">*</span>' : '' ).'
									   </div>
									   
									   ',
									   
			'must_log_in'          => '<p class="must-log-in">
										   '.shadower_wp_kses( __( 'You must be', 'shadower' ) ).' <a href="'.esc_url( wp_login_url( apply_filters( 'the_permalink',get_permalink( $post_id ) ) ) ).'">'.shadower_wp_kses( __( 'logged in', 'shadower' ) ).'</a> '.shadower_wp_kses( __( 'to post a comment', 'shadower' ) ).'.
									  </p>',
			
			'logged_in_as'         => ''.shadower_wp_kses( __( 'Logged in as', 'shadower' ) ).' <a href="'.esc_url( admin_url( 'profile.php' ) ).'">'.$user_identity.'</a>.
									   <a href="'.esc_url( wp_logout_url( apply_filters( 'the_permalink',get_permalink( $post_id ) ) ) ).'" title="'.shadower_wp_kses( __( 'Log out of this account', 'shadower' ) ).'">'.shadower_wp_kses( __( 'Log out', 'shadower' ) ).'?</a>
									   <hr>
									   ',
									   
			'comment_notes_before' => ( is_page( Shadower_Core::get_pageid_from_template( 'page-contact.php' ) ) ? '' : '<p class="comment-notes">'.shadower_wp_kses( __( 'Your email address will not be published.', 'shadower' ) ).'</p>' ),
			
			/*
			'comment_notes_after'  => '<p class="form-allowed-tags">
											'.shadower_wp_kses( __( 'You may use these', 'shadower' ) ).' <abbr title="'.shadower_wp_kses( __( 'HyperText Markup Language', 'shadower' ) ).'">'.__( 'HTML', 'shadower' ).'</abbr> '.shadower_wp_kses( __( 'tags and attributes', 'shadower' ) ).': <code>'.allowed_tags().'</code>
									  </p>',
			*/
			
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'class_submit'         => 'button button-hover button-border-thin button-size-s button-space-none button-fullwidth button-bg-primary',
			'title_reply'          => ( is_page( Shadower_Core::get_pageid_from_template( 'page-contact.php' ) ) ? '' : shadower_wp_kses( __( 'Leave a Reply', 'shadower' ) ) ),
			'title_reply_to'       => shadower_wp_kses( __( 'Leave a Reply to %s', 'shadower' ) ),
			'cancel_reply_link'    => shadower_wp_kses( __( 'Cancel reply', 'shadower' ) ),
			'label_submit'         => esc_attr__( 'Leave a message', 'shadower' )
		 );
	
		return $form_options;
	}

}

/*
* This solution buffers the comment form html and replaces the <h3 id="reply-title"..> with another tag before printing it.
*
*/
if ( !function_exists( 'shadower_comment_form_before' ) ) {
	add_action( 'comment_form_before', 'shadower_comment_form_before' );
	function shadower_comment_form_before() {
		ob_start();
	}
	
}
if ( !function_exists( 'shadower_comment_form_after' ) ) {
	add_action( 'comment_form_after', 'shadower_comment_form_after' );
	function shadower_comment_form_after() {
		$html = ob_get_clean();
		$html = preg_replace(
			'/<h3 id="reply-title"(.*)>(.*)<\/h3>/',
			'<h3 '.( is_page( Shadower_Core::get_pageid_from_template( 'page-contact.php' ) ) ? 'style="display:none;"' : '' ).' id="reply-title"\1>\2</h3>',
			$html
		);
		echo $html;
	}
	
}




<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 * 
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
 
 
if ( post_password_required() ) {
	return;
}
 
 /**
 * Custom comment output
 */
if ( !function_exists( 'shadower_comment' ) ) {
	
	function shadower_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 

?>

    <!-- comment start -->
    <div <?php comment_class( 'clearfix' ); ?> id="comment-<?php comment_ID() ?>">
    
        <div class="comment-meta" data-comment-link="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
        
            <div class="comment-avatar">
                <?php echo shadower_wp_kses( get_avatar( $comment->comment_author_email, 45 ) ); ?>
            </div>
            
            <div class="comment-text">
                <h5><?php comment_author_link();?></h5>
                <span>
                    <em>
						<?php echo printf( shadower_wp_kses( __( '%1$s at %2$s', 'shadower' ) ), get_comment_date(), get_comment_time() ); ?>
                        <?php echo shadower_wp_kses( edit_comment_link( __( ' | edit', 'shadower' ),'  ','' ) ); ?>
                    </em>
                </span>
            </div>
            
        </div>
        
        <div class="comment-content">
            <div class="comment-body clearfix">
                <?php echo shadower_wp_kses( comment_text() );?>
                <?php echo shadower_wp_kses( comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) );?>
				<?php if ( $comment->comment_approved == '0' ) { ?>
                    <em class="comment-awaiting-moderation"><?php shadower_wp_kses( __( 'Your comment is awaiting moderation.', 'shadower' ) ); ?></em>
                <?php } ?> 
                
            </div>
        </div>
    
                                    
                                    
<?php 
    }
} 
?>




<div class="entry-section comments">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) { ?>
    
		<h4 class="font-uppercase entry-title">
			<?php
			    
				printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'shadower' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h4>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php echo shadower_wp_kses( __( 'Comment navigation', 'shadower' ) ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'shadower' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'shadower' ) ); ?></div>
            </nav><!-- #comment-nav-above -->
		<?php } // check for comment navigation ?>

		
		<?php
            wp_list_comments( array( 
                'style'       => 'div', // <!-- comment end ( </div> tag ) -->
                'short_ping'  => true,
                'avatar_size' => 45,
                'callback'    => 'shadower_comment'
             ) );
        ?>
		

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php echo shadower_wp_kses( __( 'Comment navigation', 'shadower' ) ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'shadower' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'shadower' ) ); ?></div>
            </nav><!-- #comment-nav-below -->
		<?php } // check for comment navigation ?>

	
    
        <?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
            <p class="no-comments"><?php echo shadower_wp_kses( __( 'Comments are closed.', 'shadower' ) ); ?></p>
        <?php } ?>
    
    
    <?php } // have_comments() ?>



</div>
<!-- Comments  end -->


<?php comment_form(); ?>





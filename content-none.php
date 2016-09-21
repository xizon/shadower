<?php
/**
 * Template part for displaying a message that posts cannot be found.
 * 
 */

?>

<h3><?php echo shadower_wp_kses( __( 'Nothing Found', 'shadower' ); ?></h3>
<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
     <p><?php sprintf( shadower_wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'shadower' ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
<?php } elseif ( is_search() ) { ?>
     <p><?php echo shadower_wp_kses( __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'shadower' ) ); ?></p>
<?php } else { ?>
     <p><?php echo shadower_wp_kses( __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'shadower' ) ); ?></p>
<?php } ?>
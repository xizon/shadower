<?php
/**
 * Custom template entries for theme
 * 
 */

?>
<ul class="entry-meta">
    <li>
        <?php
            $time_string = '<time class="post-date" datetime="%1$s">%2$s</time>';
            printf( $time_string,
                esc_attr( get_the_date( 'c' ) ),
                get_the_date()
            );
        ?>
    </li>
    <li>
        <?php 
		
			if ( 'post' == get_post_type() ) {
				echo shadower_wp_kses( __( 'By: ', 'shadower' ) );
				if ( is_singular() || is_multi_author() ) {
					printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
						_x( 'Author', 'Used before post author name.', 'shadower' ),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						get_the_author()
					);
				}
			}	
        ?>
    </li>
    <li>
        <?php 
			echo shadower_wp_kses( get_the_term_list(
					get_the_ID(), 
					'category', 
					'', 
					', ', 
					'' 
			) );
			
        ?>
    </li>
    <li>
		<?php
		    if ( is_singular() && !post_password_required() && ( comments_open() || get_comments_number() ) ) {
				comments_popup_link( 
					shadower_wp_kses( __( 'No Comments', 'shadower' ) ), 
					shadower_wp_kses( __( '1 Comment', 'shadower' ) ),
					shadower_wp_kses( __( '% Comments', 'shadower' ) ) 
				);
			}
        ?>
    </li>
   
</ul>
<!-- .entry-meta end -->

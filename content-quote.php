<?php
/**
 * The template for displaying posts in the Quote post format
 * 
 */
 ?>

<?php  if ( !is_singular() ) {  ?>

     <!-- Topics Item -->
    <div <?php post_class( array( 'topics-item', 'style-1', 'scroll-reveal', 'post-blockquote', ( ( !has_post_thumbnail() ) ? esc_attr( 'no-featured-img' ) : '' ) ) ); ?> id="post-<?php the_ID(); ?>">
        <div class="row">
            <div class="col-md-12 transition">
                  <blockquote>
					<?php       
                        the_content();
                        wp_link_pages( array(
                            'before'      => '<div class="page-links">' . shadower_wp_kses( __( 'Pages: ', 'shadower' ) ) . '',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) );
                      ?>
                 </blockquote>
            
            </div>
 
        </div>
        <!-- .row end -->
 
    </div>
    <!--  .topics-item  end -->
 
<?php } ?>

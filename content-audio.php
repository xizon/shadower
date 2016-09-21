<?php
/**
 * The template for displaying posts in the Audio post format
 * 
 */

$media_url = get_post_meta( get_the_ID(), 'cus_post_ex_audio', true );
?>

<?php  if ( is_singular() ) {  ?>

    <section <?php post_class( array( 'space-none-top' ) ); ?> id="post-<?php the_ID(); ?>">
        <div class="parallax parallax-auto overlay-bg overlay-bg-black overlay-text-white height-50 entry-title-nopa-container" data-speed="0.3" data-image-src="<?php echo esc_url( shadower_default_featured_image() ); ?>">
            <?php echo shadower_wp_kses( '<img src="'.esc_url( shadower_default_featured_image() ).'" class="parallax-img" alt="'.esc_attr( get_the_title() ).'" >' ); ?>
            <div class="pos-vertical-align t-c">
                <div class="container">
                
                     <div class="entry-complex-container">
                         <?php echo Shadower_Core::output_audio( $media_url ); ?>
                       
                     </div>
            

                </div>
                <!-- .container end -->
            </div>
            <!-- .pos-vertical-align  end -->
        </div>
    </section>

    
<?php } else { ?>

    <!-- Topics Item -->
    <div <?php post_class( array( 'topics-item', 'style-1', 'scroll-reveal' ) ); ?> id="post-<?php the_ID(); ?>">
        <div class="row">
        
                <div class="title-style-fieldset">
                     <?php the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                      <h5 class="font-normal">
                          <span>
							<?php
                                echo shadower_wp_kses( get_the_term_list(
                                        get_the_ID(), 
                                        'category', 
                                        '', 
                                        ', ', 
                                        '' 
                                ) );
                            ?>
                          </span>
                      </h5>
                </div>
           
           
                <div class="col-sm-6 topics-item-img <?php if ( Shadower_Core::output_audio( $media_url, 0 ) != 'soundcloud' ) echo esc_attr( 'topics-item-audio' ); ?> transition">
                     <?php echo Shadower_Core::output_audio( $media_url ); ?>
                </div>
                <div class="col-md-6 topics-item-info list-normal table-normal">
                     <?php shadower_echo_excerpt(); ?>
                </div>

                
                <div class="share transition">
                    <?php echo shadower_wp_kses( shadower_share_buttons( get_permalink(), get_the_title() ) ); ?>
                </div>     
                

        </div>
        <!-- .row  end -->
    </div>
    <!--  .topics-item  end -->

<?php } ?>

<?php
/**
 * The template for displaying posts in the Gallery post format
 * 
 */

$attachments = get_gallery_ids(); 
if ( ! $attachments ) {
	return;
}
?>


<?php  if ( is_singular() ) {  ?>
    <section <?php post_class( array( 'space-none-top' ) ); ?> id="post-<?php the_ID(); ?>">
        <div class="parallax parallax-auto overlay-bg overlay-bg-black overlay-text-white height-50 entry-title-nopa-container" data-speed="0.3" data-image-src="<?php echo esc_url( shadower_default_featured_image() ); ?>">
            <?php echo shadower_wp_kses( '<img src="'.esc_url( shadower_default_featured_image() ).'" class="parallax-img" alt="'.esc_attr( get_the_title() ).'" >' ); ?>
            <div class="pos-vertical-align t-c">
                <div class="container">
                  
                        <div class="custom-theme-flexslider entry-complex-container">
                            <div class="custom-theme-slides">
                                <?php if ( is_array( $attachments ) ) { ?>
                                    <?php foreach ( $attachments as $attachment ) :
                                                $img_url	= wp_get_attachment_url( $attachment );
                                                $img_alt	= get_post_meta( $attachment, '_wp_attachment_image_alt', true );
                                                $img_echo	= shadower_remove_thumbnail_str( wp_get_attachment_image( $attachment, 'post-thumbnail-large' ) );
                                    ?>
                                        <?php if ( !empty( $img_echo ) ) { ?>
                                                    <div class="item">
                                                        <?php if (  'on' == gallery_is_lightbox_enabled() ) { ?>
                                                            <a href="<?php echo esc_url( $img_url ); ?>" title="<?php echo esc_attr( $img_alt ); ?>" rel="theme-slider-prettyPhoto[<?php the_ID(); ?>]">
                                                                <?php echo shadower_wp_kses( $img_echo ); ?>
                                                            </a>
                                                        <?php } else { ?>
                                                            <?php echo shadower_wp_kses( $img_echo ); ?>
                                                        <?php } ?>    
                                                    </div>			
                                                        
                                        <?php } ?>
                                    <?php endforeach; ?>
                                <?php } ?>

                            </div>
                            <!-- .custom-theme-slides end -->
                        </div>
                        <!-- .custom-theme-flexslider end -->
            

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
                
                
     
                <div class="col-md-6 topics-item-img transition">

                        <div class="custom-theme-flexslider">
                            <div class="custom-theme-slides">
 
                                <?php if ( has_post_format( 'gallery' ) ) { ?>
									<?php if ( is_array( $attachments ) ) { ?>
                                        <?php foreach ( $attachments as $attachment ) :
                                                    $img_url	= wp_get_attachment_url( $attachment );
                                                    $img_alt	= get_post_meta( $attachment, '_wp_attachment_image_alt', true );
													$img_echo	= shadower_remove_thumbnail_str( wp_get_attachment_image( $attachment, 'post-thumbnail', false, array(
																							'alt' => esc_attr( get_the_title() ),
																							'data-retina' => esc_url( wp_get_attachment_image_src( $attachment, 'post-retina-thumbnail' )[0] ),
																  ) ) );
                                        ?>
                                            <?php if ( !empty( $img_echo ) ) { ?>
                                                        <div class="item">
                                                            <?php if (  'on' == gallery_is_lightbox_enabled() ) { ?>
                                                                <a href="<?php echo esc_url( $img_url ); ?>" title="<?php echo esc_attr( $img_alt ); ?>" rel="theme-slider-prettyPhoto[<?php the_ID(); ?>]">
                                                                    <?php echo shadower_wp_kses( $img_echo ); ?>
                                                                </a>
                                                            <?php } else { ?>
                                                                <?php echo shadower_wp_kses( $img_echo ); ?>
                                                            <?php } ?>    
                                                        </div>			
                                                            
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                <?php } ?>
          
                            </div>
                            <!-- .custom-theme-slides end -->
                        </div>
                        <!-- .custom-theme-flexslider end -->

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

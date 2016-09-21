<?php
/**
 * Template part for displaying posts.
 *
 * 
 */

$thumbnail_url     = ( has_post_thumbnail() ) ? wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) : shadower_default_featured_image();
$thumbnail_echo    = ( has_post_thumbnail() ) ? get_the_post_thumbnail( get_the_ID(), 'post-thumbnail-large', array( 'class' => 'parallax-img' ) ) : '<img src="'.shadower_default_featured_image().'" class="parallax-img" alt="'.esc_attr( get_the_title() ).'" >';
?>

<?php  if ( is_singular() ) {  ?>

    <section <?php post_class( array( 'space-none-top' ) ); ?>  id="post-<?php the_ID(); ?>">
        <div class="parallax parallax-auto overlay-bg overlay-bg-black overlay-text-white height-50 entry-title-container" data-speed="0.3" data-image-src="<?php echo esc_url( $thumbnail_url ); ?>">
            <?php echo shadower_wp_kses( $thumbnail_echo ); ?>
            <div class="pos-vertical-align t-c">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                            <?php the_title( '<h1 class="h2">', '</h1>' ); ?>
                            <?php get_template_part( 'partials', 'entry_meta' ); ?>   
                    </div>
                </div>
                <!-- .row end -->

            </div>
            <!-- .pos-vertical-align  end -->
        </div>
    </section>   
    
<?php } else { ?>

    <!-- Topics Item -->
    <div <?php post_class( array( 'topics-item', 'style-1', 'scroll-reveal', ( ( !has_post_thumbnail() ) ? esc_attr( 'no-featured-img' ) : '' ) ) ); ?> id="post-<?php the_ID(); ?>">
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
                
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="col-sm-6 topics-item-img transition">
                         <a href="<?php the_permalink(); ?>" >
                            <?php
                                the_post_thumbnail( 'post-thumbnail', array(
                                    'alt' => esc_attr( get_the_title() ),
                                    'data-retina' => esc_url( wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-retina-thumbnail' )[0] ),
                                    
                                ) ); 
                            ?>
                         </a> 
                    </div>
                    <div class="col-md-6 topics-item-info list-normal table-normal">
                         <?php shadower_echo_excerpt(); ?>
                    </div>

                <?php } else { ?>
                    <div class="col-md-12 transition">
                        <div class="topics-item-info list-normal">
                                <?php shadower_echo_excerpt(); ?>
                        </div>
                    </div>
                <?php } ?>
                              
                
                
                <div class="share transition">
                    <?php echo shadower_wp_kses( shadower_share_buttons( get_permalink(), get_the_title() ) ); ?>
                </div>     
                

        </div>
        <!-- .row  end -->
    </div>
    <!--  .topics-item  end -->

<?php } ?>

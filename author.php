<?php
/**
 * The template for displaying Author archive pages
 *
 */

get_header(); ?>

    <section class="space-sm">
        <div class="container t-c">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h2>
							<?php
                                /*
                                 * Queue the first post, that way we know what author
                                 * we're dealing with (if that is the case).
                                 *
                                 * We reset this later so we can run the loop properly
                                 * with a call to rewind_posts().
                                 */
                                the_post();
        
                                printf( shadower_wp_kses( __( 'All posts by %s', 'shadower' ) ), get_the_author() );
                            ?>
                        </h2>
						<?php if ( get_the_author_meta( 'description' ) ) : ?>
                            <p class="h5 font-normal"><?php the_author_meta( 'description' ); ?></p>
                        <?php endif; ?>
                        
                    </div>
                </div>
                <!-- .row end -->
        </div>
        <!-- .container end -->

    </section>

    <section class="space-none-top">
        <div class="container">
            <?php if ( shadower_blog_layout() == 'sidebar' ) { ?>
            <div class="row">
                <div class="col-md-9">
            <?php } ?>
            
                
                        <?php 
                            if ( have_posts() ) { 
                            
								/*
								 * Since we called the_post() above, we need to rewind
								 * the loop back to the beginning that way we can run
								 * the loop properly, in full.
								 */
								rewind_posts();
							
                                while ( have_posts() ) : the_post();
                                
                                    get_template_part( 'content', get_post_format() );
                                    
                                endwhile;
                            
                            } else { 
                            
                                get_template_part( 'content', 'none' ); 
                            
                            } 
                         ?>            
                
                              
                        <div class="pagination-container t-c transition">
                            <?php
                                if ( get_theme_mod( 'custom_pagination', true ) ) {
                                    //Use numeric Paginate
                                    shadower_pagination( 3, '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>', true );	 
                                } else {
                                    //Only "next" and "previous" button
                                    shadower_pagejump( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>', true ); 
                                }
                            ?>
                        </div> 
                        <!-- .pagination-container  end -->

            <?php if ( shadower_blog_layout() == 'sidebar' ) { ?>
                </div>
                <!--  .col-md-9  end -->
                <div class="col-md-3">
                
                    <?php get_sidebar(); ?>
                
                </div>
                <!--  .col-md-3  end --> 
            
            </div>
            <!-- .row  end -->
            <?php } ?>
        

            
        </div>
        <!-- .container end -->

    </section>
       

<?php get_footer(); ?>



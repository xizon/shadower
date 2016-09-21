<?php
/**
 * Template Name: Blog SideBar
 *
 * The template for displaying blog pages.
 *
 * 
 */

get_header(); ?>


   
    <section class="space-sm">
        <div class="container t-c">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h2 <?php shadower_page_heading( get_the_ID(), 'text' ); ?>><?php the_title();?></h2>
                        <?php if ( !empty( shadower_page_heading( get_the_ID(), 'subheading', false ) ) ) { ?>
                            <p class="h5 font-normal" <?php shadower_page_heading( get_the_ID(), 'text' ); ?>><?php shadower_page_heading( get_the_ID(), 'subheading' ); ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!-- .row end -->
        </div>
        <!-- .container end -->
    
    </section> 
   
   
    <section class="space-none-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
            
						<?php 
                            $wp_query = new WP_Query( array(
                                            'post_type'      => 'post',
                                            'showposts'      => shadower_blog_show(), 
                                            'paged'          => $paged
                                        )
                            );
                            
                            if ( $wp_query->have_posts() ) { 
                            
                                while ($wp_query->have_posts()) : $wp_query->the_post(); 
                                    get_template_part( 'content', get_post_format() ); 
                                endwhile; 
                                
								// Reset post data to prevent conflicts with the main query 
								wp_reset_postdata();
                            
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

                </div>
                <!--  .col-md-9  end -->
                <div class="col-md-3">
                
                    <?php get_sidebar(); ?>
                
                </div>
                <!--  .col-md-3  end --> 
            
            </div>
            <!-- .row  end -->
    
            
        </div>
        <!-- .container end -->

    </section>
       


<?php get_footer(); ?>




<?php
/**
 * The main template file.
 *
 */

get_header(); ?>


   <!-- Uix Slideshow
    ====================================================== -->
    <?php get_template_part( 'partials', 'uix_slideshow' ); ?>


   <!-- Homepage Section
    ====================================================== -->
    <?php dynamic_sidebar( 'homepage-1' ); ?>
                 
               
   <!-- Post List
    ====================================================== -->
    <section>
        <div class="container">
            <?php if ( shadower_blog_layout() == 'sidebar' ) { ?>
            <div class="row">
                <div class="col-md-9">
            <?php } ?>
            
                
                        <?php 
                            if ( have_posts() ) { 
                            
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
       
    

   <!-- Advertising
    ====================================================== --> 
    <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'homepage-advertising' ) ) { ?>
        <?php
		/*
            printf( shadower_wp_kses( __( 'Replace this widget content by going to <a href="%1$s"><strong>Appearance &raquo; Widgets</strong></a> and dragging widgets into "Homepage Advertising".', 'shadower' ) ), esc_url( admin_url( 'widgets.php' ) ) ); 
		*/
        ?>
    <?php } ?>  
    
        
  
<?php get_footer(); ?>

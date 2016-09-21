<?php
/**
 * The template for displaying Category pages
 *
 */

get_header(); ?>

    <section class="space-sm">
        <div class="container t-c">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h2><?php printf( shadower_wp_kses( __( 'Category Archives: %s', 'shadower' ) ), single_cat_title( '', false ) ); ?></h2>
						<?php
                            // Show an optional term description.
                            $term_description = term_description();
                            if ( ! empty( $term_description ) ) {
                                printf( '<p class="h5 font-normal">%s</p>', shadower_wp_kses( $term_description ) );
                            }
                        ?>  
                        <div class="nav-filters">
                            <ul>
                                <li class="current-cat"><a data-group="all" href="#"><?php echo shadower_wp_kses( __( 'All', 'shadower' ) ); ?></a></li>
								<?php
									wp_list_categories( array(
									
										'show_option_all'    => '',
										'orderby'            => 'id',
										'order'              => 'asc',
										'style'              => 'list',
										'show_count'         => 0,
										'hide_empty'         => 1,
										'use_desc_for_title' => 1,
										'child_of'           => 0,
										'hierarchical'       => 0, 
										'title_li'           => '',
										'show_option_none'   => shadower_wp_kses( __( 'No categories', 'shadower') ), 
										'number'             => null, 
										'echo'               => 1,
										'depth'              => 0, 
										'current_category'   => 0,
										'pad_counts'         => 1,
										'taxonomy'           => 'category',
										'walker'             => new Shadower_Dropdown_Walker_PostList_Category 
									
									) );

                                ?>
                                
                            </ul>
                        </div>
                        <!-- .nav-filters  end -->
                        
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



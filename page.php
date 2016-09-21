<?php
/**
 * The template for displaying all pages.
 * 
 */

get_header(); ?>
     
	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( shadower_page_layout( get_the_ID(), 'title', false ) == 'show' ) { ?>
            
            <?php if ( shadower_page_heading( get_the_ID(), 'style', false ) == 'no-bg' ) { ?>
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
            <?php } else { ?>
                <section class="space-none">
                    <div class="parallax parallax-auto overlay-bg overlay-bg-black overlay-text-white height-40 entry-title-container" data-speed="0.3" data-image-src="<?php shadower_page_heading( get_the_ID(), 'heading_bg' ); ?>">
                        <img class="parallax-img" src="<?php shadower_page_heading( get_the_ID(), 'heading_bg' ); ?>" alt="parallax">
                        <div class="pos-vertical-align t-c">
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
                        <!-- .pos-vertical-align  end -->
                    </div>
                </section>
            <?php } ?>
    
        <?php } ?>
    
    
        <section class="<?php echo ( shadower_page_heading( get_the_ID(), 'style', false ) == 'bg' || shadower_page_layout( get_the_ID(), 'title', false ) != 'show' ) ? esc_attr( 'space-sm' ) : esc_attr( 'space-none-top' ); ?>">
            <div class="container">
                <div class="row">
                
                <?php if ( shadower_page_layout( get_the_ID(), 'sidebar', false ) == 'no-sidebar' ) { ?>
                    <div class="col-md-12 transition">
                <?php } ?>
                
                
                <?php if ( shadower_page_layout( get_the_ID(), 'sidebar', false ) == 'sidebar' ) { ?>
                    <div class="col-md-9">
                <?php } ?>
                
                    
                    <?php 
                        the_content(); 
                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . shadower_wp_kses( __( 'Pages: ', 'shadower' ) ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                        ) );
                    ?> 
                    
                    <?php edit_post_link( esc_html__( 'Edit', 'shadower' ), '<span class="edit-link">', '</span>' ); ?>
                    
					<?php
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    ?>
                    
    
                <?php if ( shadower_page_layout( get_the_ID(), 'sidebar', false ) == 'sidebar' ) { ?>
                    </div>
                    <!--  .col-md-9  end -->
                    <div class="col-md-3">
                    
                        <?php get_sidebar(); ?>
                    
                    </div>
                    <!--  .col-md-3  end --> 
      
                <?php } ?>
                
                
                <?php if ( shadower_page_layout( get_the_ID(), 'sidebar', false ) == 'no-sidebar' ) { ?>
                    </div>
                    <!--  .col-md-12  end --> 
                <?php } ?>
                
                
                </div>
                <!-- .row  end -->   
            </div>
            <!-- .container end -->
        </section>
        
                               
    
    <?php endwhile; ?>  

<?php get_footer(); ?>

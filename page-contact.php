<?php
/**
 * Template Name: Contact
 *
 * The template for displaying contact page.
 *
 * 
 */

get_header(); ?>


	<?php while ( have_posts() ) : the_post(); ?>
            
        <section class="space-none-top">
            
            <div class="entry-title-container">
                        
                <?php
                if ( class_exists( 'UixShortcodes' ) ) {
                    echo do_shortcode( "[uix_map style='".get_theme_mod( 'custom_map_style', 'normal' )."' width='100%' height='".get_theme_mod( 'custom_map_height', '285' )."px' latitude='".get_theme_mod( 'custom_map_latitude', '37.7770776' )."' longitude='".get_theme_mod( 'custom_map_longitude', '-122.4414289' )."' zoom='".get_theme_mod( 'custom_map_zoom', '14' )."' name='".get_theme_mod( 'custom_map_name', 'SEO San Francisco, CA, Gough Street, San Francisco, CA' )."' marker='".get_theme_mod( 'custom_map_marker', UixShortcodes::plug_directory() .'assets/images/map/map-location.png' )."' ]" );
                }
                
                 ?>

            </div>
                                
    

            <div class="container">
                    <div class="row">
                        <div class="col-md-6 transition">
                        
                            <?php the_content(); ?>
                         
                        </div>
                        <!-- .col-md-6 end -->
                        
                        <div class="col-md-6 transition">
                                <?php comment_form(); ?>
                        </div>
                        <!-- .col-md-6 end -->             
                        
                    </div>
                    <!-- .row end -->
                    
            </div>
            <!-- .container end -->
           
        </section>
                            
    
    <?php endwhile; ?>  
    
    

<?php get_footer(); ?>



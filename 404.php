<?php
/**
 * The template for displaying 404 pages (not found).
 * 
 */

get_header(); ?>

    <section class="space-sm">
        <div class="container">
                <div class="row">
                    <div class="col-md-12 relative">
                        
                        <div class="error-container">
                            <h1 class="error">
                                <?php echo shadower_wp_kses( __( 'Error 404', 'shadower' ) ); ?>
                                <span class="error-level-1"><?php echo shadower_wp_kses( __( 'Error 404', 'shadower' ) ); ?></span>
                                <span class="error-level-2"><?php echo shadower_wp_kses( __( 'Error 404', 'shadower' ) ); ?></span>
                            </h1>
                            <p class="error-info"><?php echo shadower_wp_kses( __( 'The page you were looking for wasn\'t found, if you think this might be a mistake drop us a line', 'shadower' ) ); ?></p> 
                        </div>
    
                     
                    </div>
                    <!-- .col-md-12 end -->
                </div>
                <!-- .row end -->
                
        </div>
        <!-- .container end -->
       
    </section>

<?php get_footer(); ?>

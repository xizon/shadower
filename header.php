<?php
/**
 * The header for our theme.
 *
 */

?><!DOCTYPE html>
<html <?php echo language_attributes();?>><head>
	<meta charset="<?php echo bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <?php Shadower_Core::browser_compatibility(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- Menu Toggle
    ============================================= -->   
    <div class="menu-toggle">
        <span class="l1"></span>
        <span class="l2"></span>
        <span class="l3"></span>
    </div>
    <!-- .menu-toggle end -->

     <!-- Loader
    ============================================= -->      
    <div class="loader">
        <!--[if lt IE 10]>
            <span>Loading...</span>
        <![endif]-->
        <svg class="spinner" width="45px" height="45px" viewBox="0 0 52 52">
          <circle class="path" cx="26px" cy="26px" r="20px" fill="none" stroke-width="4px" />
        </svg>
    </div>
    <!-- .loader end -->



    <div class="wrapper animsition">
   
    
        <!-- Header Area
        ============================================= -->      
        <header class="header-area transition">
            
             <div class="header-container transition">

             
                 <div class="container">
                 
                        <div class="brand">
                            <?php 
							$logo_url = shadower_the_custom_logo_url();
							if ( !empty( $logo_url ) ) { 
							?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <img src="<?php echo esc_attr( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
                                </a>                            
							<?php } else { ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <?php bloginfo( 'name' ); ?>
                                </a>
                            <?php } ?>
                            
							<?php if ( get_bloginfo( 'description' ) && empty( $logo_url ) ) { ?>
                                <p class="description"><?php bloginfo( 'description' ); ?></p>
                            <?php } ?>
                                             
                        </div>
                        <!-- .logo end -->
    
                  </div>
                  <!-- .container end -->
                  

             
                <!-- Navigation Start-->
                
                <nav class="menu-wrapper transition">
                        <span class="mobile-brand">
                            <?php if ( !empty( $logo_url ) ) { ?>
                                <img src="<?php echo esc_attr( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />                           
							<?php } else { ?>
                                <img src="<?php echo esc_url( UIX_THEME_URL.'/assets/images/blank.gif' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />               
                            <?php } ?>
                            
                        </span>
                        <div class="social-list social-header">
                            <ul>
                                <?php shadower_social_buttons(); ?>
                            </ul>
                        </div>
                        <div class="menu-left transition">
                        
                              <?php
                              
                                    /*
                                     * Display main menu
                                     *
                                    */    
									if ( has_nav_menu( 'primary' ) ) {
							
										wp_nav_menu(
												array(
													'theme_location'  => 'primary',
													'menu'            => '',
													'container'       => false,
													'container_class' => '',
													'container_id'    => '',
													'menu_class'      => '',
													'menu_id'         => 'primary-menu',
													'echo'            => true,
													'fallback_cb'     => 'shadower_page_menu',
													'before'          => '',
													'after'           => '',
													'link_before'     => '',
													'link_after'      => '',
													'items_wrap'      => '<ul class="menu-main" id="%1$s">%3$s</ul>', 
													'depth'           => 0,
													'walker'          => new Shadower_Dropdown_Walker_Nav_Menu()
												)
											);	
				
				
											function shadower_page_menu() {
												
												echo '<ul class="menu-main">
														 <li class="menu-item mega-menu '.( ( is_home() || is_front_page() ) ? 'current-menu-item' : '' ).'"><a href="'.esc_url( home_url() ).'">' .shadower_wp_kses( __( 'Home', 'shadower' ) ).'</a></li>
													 </ul>                            
												';
											
											}
											
									}
       
                              ?> 
                        
                      
                        </div>
                        
                        <!-- .menu-left end -->
                        <div class="menu-right transition">
                            <?php get_template_part( 'partials', 'search_header' ); ?>
                        </div>
                        <!-- .menu-right end -->
                        
                        
                   
                </nav>
                <!-- .menu-wrapper end -->
                  
                  
                  <div class="clear"></div>
             </div>
        
        </header>
        <div class="header-inner auto-height"></div>
        
        
       <!-- Stage
        ============================================= -->  
        <?php if ( !get_background_image() ) { ?>
            <canvas id="stage"></canvas>  
        <?php } ?>
        
			
			
         
      
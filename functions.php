<?php
/****************************************************************
 * Theme functions and definitions.
 ****************************************************************/
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}
 
 
/**
 * General constant definition ( Do not delete )
 */
define('UIX_THEME_NAME',wp_get_theme());
define('UIX_THEME_VERSION',wp_get_theme()->display( 'Version' ));
define('UIX_THEME_SLUG',wp_get_theme()->get( 'TextDomain' ));
define('UIX_THEME_URL', get_template_directory_uri() );
define('UIX_THEME_ADMIN_ASSETS_URL', get_template_directory_uri(). '/includes/admin/assets' );
define('UIX_THEME_ROOT_PATH', get_template_directory() );
define('UIX_THEME_INC_PATH', get_template_directory() . '/includes');

/**
 * Check the theme requirements
 */
if ( version_compare( PHP_VERSION, '5.3.0' ) < 0 ) {
    wp_die( esc_html__( 'You\'re runing WordPress on outdated PHP version. Please contact your hosting company and updgrade PHP to 5.3 or above. ', 'shadower' ) );
}

/**
 * Basic WP core functions
 */
require_once UIX_THEME_INC_PATH . '/functions/init.php';


/**
 * Default demo data
 */
require_once UIX_THEME_INC_PATH . '/default-data/widgets.php';


/**
 * Load all the theme functions & classes in the directory
 */
require_once UIX_THEME_INC_PATH . '/admin/classes/autoloader.php';
require_once UIX_THEME_INC_PATH . '/admin/admin-init.php';
require_once UIX_THEME_INC_PATH . '/classes/autoloader.php';
require_once UIX_THEME_INC_PATH . '/plugins.php';
require_once UIX_THEME_INC_PATH . '/theme/assets.php';
require_once UIX_THEME_INC_PATH . '/theme/features.php';
require_once UIX_THEME_INC_PATH . '/theme/custom-header.php';
require_once UIX_THEME_INC_PATH . '/theme/plug.php';
require_once UIX_THEME_INC_PATH . '/theme/widgets.php';
require_once UIX_THEME_INC_PATH . '/theme/comment.php';
require_once UIX_THEME_INC_PATH . '/theme/customize-panels.php';
require_once UIX_THEME_INC_PATH . '/theme/customize-controls.php';
require_once UIX_THEME_INC_PATH . '/theme/metaboxes-post.php';
require_once UIX_THEME_INC_PATH . '/theme/metaboxes-page.php';
require_once UIX_THEME_INC_PATH . '/theme/templates.php';


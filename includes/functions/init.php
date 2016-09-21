<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

// Returns security string
require_once UIX_THEME_INC_PATH . '/functions/internal/string.php';

// Returns the optional custom logo URL.
require_once UIX_THEME_INC_PATH . '/functions/internal/brand.php';

// Change the comment reply link to use 'Reply to <Author First Name>'
require_once UIX_THEME_INC_PATH . '/functions/internal/comment-reply.php';

// Remove redundant code of WordPress admin bar in front-end.
require_once UIX_THEME_INC_PATH . '/functions/internal/admin-bar.php';

// Add a filter to add a class to tag link in wordpress
require_once UIX_THEME_INC_PATH . '/functions/internal/post-tag.php';

// Given the count of the posts with that tag.
require_once UIX_THEME_INC_PATH . '/functions/internal/tagcloud.php';

// Remove image dimension attributes
require_once UIX_THEME_INC_PATH . '/functions/internal/thumb.php';

// The total views are displayed in entry meta of each post.
require_once UIX_THEME_INC_PATH . '/functions/internal/post-views.php';

// Support for customizable hottest orlatest posts block. 
require_once UIX_THEME_INC_PATH . '/functions/internal/get-posts.php';

// Support for customizable pagination styles. 
require_once UIX_THEME_INC_PATH . '/functions/internal/get-paginate.php';

// Limit excerpt length by characters & automatic get excerpt
require_once UIX_THEME_INC_PATH . '/functions/internal/get-excerpt.php';

// The following example adds an attribute to specific menu items. Specify the ID of each menu item as an array.
require_once UIX_THEME_INC_PATH . '/functions/internal/menu-attributes.php';

//Initialize the update checker
require_once UIX_THEME_INC_PATH . '/functions/update/automatic-theme-plugin-update.php';

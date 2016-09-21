<?php
/**
 * The template for displaying Search Form in header.
 *
 */

 ?>
<form class="clearfix search-form-show" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-inner-icon">
        <i class="flaticon flaticon-search" id="menu-search-btn"></i>
        <input type="search" class="controls-custom" name="s" id="s" placeholder="<?php esc_attr_e( 'Type search and hit enter', 'shadower' ); ?>" />
    </div>
</form>
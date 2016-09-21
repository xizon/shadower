<?php
/**
 * The sidebar containing the main widget area.
 *
 * 
 */

?>


<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>

    <div class="sidebar-container" role="complementary">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div>
    <!-- .sidebar-container end -->

<?php } ?>
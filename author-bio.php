<?php
/**
 * The template for displaying Author bios
 *
 */
?>

<div class="author-card">
	<div class="author-card-top">
		<div class="text">
			<h3><?php shadower_wp_kses( __( 'Published by ', 'shadower' ) ); ?><?php echo shadower_wp_kses( get_the_author_meta( 'display_name' ) ); ?></h3>
            <?php if ( !empty( get_the_author_meta( 'user_url' ) ) ) { ?>
                <a href="<?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?>" target="_blank">@<?php echo esc_html( get_the_author_meta( 'user_url' ) ); ?></a> 
            <?php } ?>
        </div>
		<div class="pic">
			<?php
                $author_bio_avatar_size = apply_filters( 'shadower_author_bio_avatar_size', 100 );
                echo shadower_wp_kses( get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size ) );
            ?>
        </div>
	</div>

    <div class="author-card-middle">
        <?php the_author_meta( 'description' ); ?>
    </div>

    <a class="author-card-final" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
        <?php echo shadower_wp_kses( __( ' &rarr;', 'shadower' ) ); ?>
    </a>

</div>
<!-- .author-card  end -->

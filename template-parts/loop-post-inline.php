<?php
if( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="post-item inline">
    <?php
    if( has_post_thumbnail() ) {
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
        if( !empty( $thumbnail[0] ) ) {
            echo '<div class="post-item__photo" style="background-image: url(' .esc_url( $thumbnail[0] ). ');">';
                echo '<a href="' .get_permalink(). '" class="link"></a>';
            echo '</div>';
        }
    }
    ?>
    <div class="post-item__text">
        <p class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
        <div class="excerpt"><?php the_excerpt(); ?></div>
        <a href="<?php the_permalink(); ?>" class="button-primary"><?php _e('View', 'meta'); ?></a>
    </div>
</div>
<!-- .post-item -->
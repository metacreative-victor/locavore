<div class="post-item stack">
    <?php
    if( has_post_thumbnail() ) {
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
        if( !empty( $thumbnail[0] ) ) {
            echo '<div class="post-item__photo" style="background-image: url(' .esc_url( $thumbnail[0] ). ');">';
                echo '<a href="' .get_permalink(). '" class="link"></a>';
                echo '<span class="tag-ribbon large">Recipe</span>';
            echo '</div>';
        }
    }
    ?>
    <p class="post-item__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
    <?php the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>" class="button-primary"><?php _e('View', 'meta'); ?></a>
</div>
<!-- .post-item -->
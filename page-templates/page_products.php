<?php
/**
 * Template name: Shop
 */

get_header();
?>

<div class="shop-container">
    <?php get_sidebar('shop'); ?>
    
    <div class="shop-content">
        <?php while( have_posts() ) : the_post(); ?>
            
            <h1 class="text-center"><?php the_title(); ?></h1>
            <?php
            $args = array();
            $args['post_type'] = 'product';
            $args['post_status'] = 'publish';
            $args['posts_per_page'] = 6;
            $the_query = new WP_Query( $args );

            if( $the_query->have_posts() ) {
                echo '<div class="row product-grid">';
                while( $the_query->have_posts() ) {
                    $the_query->the_post();
                    echo '<div class="col-lg-4 col-md-6 col-sm-6">';
                        get_template_part( 'template-parts/loop', 'product' );
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>
            
        <?php endwhile; ?>
    </div>
    <!-- .shop-content -->
</div>
<!-- .shop-container -->

<?php get_template_part( 'template-parts/sections/subscribe' ); ?>

<?php
get_footer();
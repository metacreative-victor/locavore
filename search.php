<?php
get_header();
?>

<div class="shop-container">
    <?php get_sidebar('shop'); ?>
    
    <div class="shop-content">
        <div class="shop-header">
            <h1 class="text-center"><?php _e('Local Produce', 'meta'); ?></h1>
            <p><?php printf( __( 'Search Results for: %s', 'meta' ), '<span class="search-term">' . get_search_query() . '</span>' ); ?></p>
            
        </div>
        <?php
        if( have_posts() ) {
            echo '<div class="row product-grid">';
            while( have_posts() ) {
                the_post();
                echo '<div class="col-lg-4 col-md-6 col-sm-6">';
                    get_template_part( 'template-parts/loop', 'product' );
                echo '</div>';
            }
            echo '</div>';

            woocommerce_pagination();
        }
        ?>
    </div>
    <!-- .shop-content -->
</div>
<!-- .shop-container -->

<?php get_template_part( 'template-parts/sections/subscribe' ); ?>

<?php
get_footer();
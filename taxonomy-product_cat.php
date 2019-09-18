<?php
get_header();
?>

<div class="shop-container">
    <?php get_sidebar('shop'); ?>
    
    <div class="shop-content">
        <h1 class="text-center"><?php single_term_title(); ?></h1>
        <?php if( have_posts() ) : ?>
            <div class="row product-grid">
                <?php while( have_posts() ) : the_post(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <?php get_template_part( 'template-parts/loop', 'product' ); ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <!-- .row -->
        <?php endif; ?>
    </div>
    <!-- .shop-content -->
</div>
<!-- .shop-container -->

<?php get_template_part( 'template-parts/sections/subscribe' ); ?>

<?php
get_footer();
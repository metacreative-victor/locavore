<?php
/**
 * Template name: Shop Layout
 */

get_header();
?>

<div class="shop-container">
    <?php get_sidebar('shop'); ?>
    
    <div class="shop-content">
        <?php while( have_posts() ) : the_post(); ?>
            
            <h1 class="text-center"><?php the_title(); ?></h1>
            <?php the_content(); ?>
            
        <?php endwhile; ?>
    </div>
    <!-- .shop-content -->
</div>
<!-- .shop-container -->

<?php get_template_part( 'template-parts/sections/subscribe' ); ?>

<?php
get_footer();
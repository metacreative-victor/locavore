<?php
/**
 * Template name: Home
 */

get_header();
?>

<?php while( have_posts() ) : the_post(); ?>
    
    <?php get_template_part( 'template-parts/sections/welcome' ); ?>

    <?php get_template_part( 'template-parts/sections/featured-produce' ); ?>

    <?php get_template_part( 'template-parts/sections/how-it-works' ); ?>

    <?php get_template_part( 'template-parts/sections/featured-growers' ); ?>

    <?php get_template_part( 'template-parts/sections/subscribe' ); ?>

    <?php get_template_part( 'template-parts/sections/news' ); ?>
    
<?php endwhile; ?>

<?php
get_footer();
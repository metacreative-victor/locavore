<?php
if( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$args = array();
$args['post_type'] = 'product';
$args['post_status'] = 'publish';
$args['posts_per_page'] = 12;
$args['orderby'] = 'rand';

$the_query = new WP_Query( $args );
if( $the_query->have_posts() ) {
    echo '<section id="featured-produce" class="page-section">';
        echo '<div class="container">';
            echo '<h2 class="section-heading text-center">' .__('Featured Fresh Produce', 'meta'). '</h2>';
            echo '<div class="product-slider">';
                while( $the_query->have_posts() ) {
                    $the_query->the_post();
					$p = wc_get_product( get_the_ID() );
					if( $p->is_in_stock() ) {
						echo '<div class="slide-item">';
							get_template_part( 'template-parts/loop', 'product' );
						echo '</div>';
					}
                }
                wp_reset_postdata();
            echo '</div><!-- .product-slider -->';
        echo '</div><!-- container -->';
        
        if( is_front_page() ) {
            echo '<a href="#" class="button-primary button-wide">' .__('View All', 'meta'). '</a>';
        }
    echo '</section><!-- #featured-produce -->';
}
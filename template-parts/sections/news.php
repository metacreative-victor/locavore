<?php
if( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<section id="news" class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="section-heading"><?php _e('Local News', 'meta'); ?></h2>
                <?php
                $args = array();
                $args['post_type'] = 'post';
                $args['post_status'] = 'publish';
                $args['posts_per_page'] = 1;
                $the_query = new WP_Query( $args );

                if( $the_query->have_posts() ) {
                    while( $the_query->have_posts() ) {
                        $the_query->the_post();
                        get_template_part( 'template-parts/loop', 'post-inline' );
                    }
                    wp_reset_postdata();

                    $cat_news = get_term( 55, 'category' );
                    if( !empty( $cat_news ) ) {
                        echo '<a href="' .esc_url( get_term_link( $cat_news ) ). '" class="more">View all news</a>';
                    }
                }
                ?>
            </div>
            <div class="col-lg-6">
                <h2 class="section-heading"><?php _e('Seasonal Recipes', 'meta'); ?></h2>
                <?php
                $args = array();
                $args['post_type'] = 'recipe';
                $args['post_status'] = 'publish';
                $args['posts_per_page'] = 1;
                $the_query = new WP_Query( $args );

                if( $the_query->have_posts() ) {
                    while( $the_query->have_posts() ) {
                        $the_query->the_post();
                        get_template_part( 'template-parts/loop', 'post-inline' );
                    }
                    wp_reset_postdata();

                    echo '<a href="' .esc_url( get_post_type_archive_link('recipe') ). '" class="more">View all recipes</a>';
                }
                ?>
            </div>
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<!-- #news -->
<?php
/**
 * Template name: Blog
 */

get_header();
?>

<div class="page-container">
    <div class="container">
        <div class="blog-header">
            <h1 class="page-title"><?php _e('Blog', 'meta'); ?></h1>
            <?php get_template_part( 'template-parts/blog-filter' ); ?>
        </div>
        <!-- .blog-header -->

        <?php
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        $args = array();
        $args['post_type'] = array('post', 'recipe');
        $args['posts_per_page'] = get_option( 'posts_per_page' );
        $args['post_status'] = 'publish';
        $args['paged'] = $paged;

        $the_query = new WP_Query( $args );
        if( $the_query->have_posts() ) {
            echo '<div class="row post-grid">';
            while( $the_query->have_posts() ) {
                $the_query->the_post();

                echo '<div class="col-md-4">';
                    get_template_part( 'template-parts/loop', 'post-stack' );
                echo '</div>';
            }
            wp_reset_postdata();
            echo '</div><!-- .row -->';

            sen_paging( $the_query->max_num_pages );
        }
        ?>
    </div>
    <!-- .container -->
</div>
<!-- .page-container -->

<?php
get_footer();
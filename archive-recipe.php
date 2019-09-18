<?php
get_header();
?>

<div class="page-container">
    <div class="container">
        <div class="blog-header">
            <h1 class="page-title">
                <?php
                if( is_category() ) {
                    echo single_cat_title( '', false );
                } elseif( is_tag() ) {
                    echo single_tag_title( '', false );
                } elseif( is_post_type_archive() ) {
                    echo post_type_archive_title( '', false );
                } elseif( is_tax() ) {
                    echo single_term_title( '', false );
                }
                ?>
            </h1>
        </div>
        <!-- .blog-header -->

        <?php
        if( have_posts() ) {
            echo '<div class="row post-grid">';
            while( have_posts() ) {
                the_post();

                echo '<div class="col-md-4">';
                    get_template_part( 'template-parts/loop', 'post-stack' );
                echo '</div>';
            }
            wp_reset_postdata();
            echo '</div><!-- .row -->';
            
            sen_paging();
        }
        ?>
    </div>
    <!-- .container -->
</div>
<!-- .page-container -->

<?php
get_footer();
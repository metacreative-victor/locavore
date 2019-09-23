<?php
get_header();
?>

<div class="page-container">
    <div class="container">
        <div class="blog-header">
            <h1 class="page-title"><?php _e('Our Growers', 'meta'); ?></h1>
            <p>The people who bring you the produce! Almost everything you can imagine is grown right here in the Northern Valleys region by farmers like these ones. Some are artisans working on a small scale and some are large producers who have grown their ideas into big business. All are offering produce which is good, clean and fair – the slow food way.</p>
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
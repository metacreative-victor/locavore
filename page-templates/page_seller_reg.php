<?php
/**
 * Template name: Seller Registration
 */

get_header(); ?>

<?php while( have_posts() ) : the_post(); ?>
	<div class="page-container seller-reg-container">
		<div class="container">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="entry-content">
                <?php the_content(); ?>
			</div>
		</div>
        <!-- .container -->
        <div class="seller-reg-form">
            <?php
            echo wc_get_template( 'myaccount/form-reg.php' );
            ?>

            <h3>Questions?</h3>
            <p>Email us on <a href="mailto:info@nvls.com.au">info@nvls.com.au</a>.</p>
            <p>Or if you prefer to chat call Tamieka on 0419 902 904 or Trish on 0438 860 022</p>
        </div>
        <!-- .seller-reg-form -->
	</div>
	<!-- .page-container -->
<?php endwhile; ?>

<?php
get_footer();
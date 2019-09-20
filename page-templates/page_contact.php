<?php
/**
 * Template name: Contact
 */

get_header(); ?>

<?php while( have_posts() ) : the_post(); ?>
	<div class="page-container contact-container">
		<div class="container">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="entry-content">
                <div class="row">
                    <div class="col-md-6">
                        <?php the_content(); ?>
                    
                        <?php
                        $facebook_url = get_field( 'facebook_url', 'option' );
                        $instagram_url = get_field( 'instagram_url', 'option' );
                        $pinterest_url = get_field( 'pinterest_url', 'option' );
                        ?>

                        <?php if( !empty( $facebook_url ) || !empty( $instagram_url ) || !empty( $pinterest_url ) ) { ?>
                            <ul class="socials">
                                <li><span><?php _e('Follow us', 'meta'); ?></span></li>
                                <?php
                                if( !empty( $facebook_url ) ) {
                                    echo '<li><a href="' .esc_url( $facebook_url ). '" class="facebook"></a></li>';
                                }
                                
                                if( !empty( $instagram_url ) ) {
                                    echo '<li><a href="' .esc_url( $instagram_url ). '" class="instagram"></a></li>';
                                }
                                
                                if( !empty( $pinterest_url ) ) {
                                    echo '<li><a href="' .esc_url( $pinterest_url ). '" class="pinterest"></a></li>';
                                }
                                ?>
                            </ul>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <div id="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3406.114106368962!2d116.09283541455126!3d-31.38341708141512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2bcd3fa40b04406f%3A0x8deb9ef479667b07!2sNorthern%20Valleys%20Locavore%20Store!5e0!3m2!1sen!2s!4v1568899763265!5m2!1sen!2s" width="600" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
                <!-- .row -->
			</div>
		</div>
        <!-- .container -->
        <div class="contact-form">
            <h2><?php _e('Quick Enquiry', 'meta'); ?></h2>
            <?php echo do_shortcode( '[gravityforms id="3" title="false" description="false" ajax="true"]' ); ?>
        </div>
        <!-- .contact-form -->
	</div>
	<!-- .page-container -->
<?php endwhile; ?>

<?php get_template_part( 'template-parts/sections/featured-produce' ); ?>

<?php get_template_part( 'template-parts/sections/subscribe' ); ?>

<?php
get_footer();
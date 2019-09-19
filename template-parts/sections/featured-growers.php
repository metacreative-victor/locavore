<?php
if( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<section id="featured-growers" class="page-section">
    <div class="container">
        <h2 class="section-heading text-center"><?php _e('Featured Growers', 'meta'); ?></h2>
        <div class="row">
            <?php
            $vendors = dokan()->vendor->get_vendors( array(
                'status' => 'approved',
                'number' => 2,
                'featured' => 'yes',
            ));

            if( !empty( $vendors ) ) {
                foreach( $vendors as $vendor ) {
                    $description = get_user_meta( $vendor->get_id(), 'description', true );

                    echo '<div class="col-lg-6">';
                        echo '<div class="post-item inline">';
                            $banner_id = $vendor->get_banner_id();

                            if( empty( $banner_id ) ) {
                                $banner_id = get_field( 'placeholder_photo', 'option' );
                            }
                            
                            if( !empty( $banner_id ) ) {
                                $banner = wp_get_attachment_image_src( $banner_id, 'large' );
                                if( $banner[0] ) {
                                    echo '<div class="post-item__photo" style="background-image: url(' .esc_url( $banner[0] ). ');"></div>';
                                }
                            }
                            
                            echo '<div class="post-item__text">';
                                echo '<p class="title"><a href="' .esc_url( $vendor->get_shop_url() ). '">' .$vendor->get_shop_name(). '</a></p>';
								echo '<p class="description">';
                                if( !empty( $description ) ) {
									echo wp_trim_words( $description, 22, '...' );
                                }
								echo '</p>';
                                echo '<a href="' .esc_url( $vendor->get_shop_url() ). '" class="button-primary">' .__('View', 'meta'). '</a>';
                            echo '</div>';
                        echo '</div><!-- .post-item -->';
                    echo '</div>';
                }
            }
            ?>
        </div>
        <!-- .row -->
    </div>
</section>
<!-- #featured-growers -->
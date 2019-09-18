<?php
if( !defined( 'ABSPATH' ) ) {
	exit;
}

$product_id = get_query_var('_view_id');

if( empty( $product_id ) ) {
    return;
}

$product = wc_get_product( $product_id );
$description = $product->get_short_description();
$ingredients = get_field( 'product_ingredients', $product_id );
$facebook_link = 'https://www.facebook.com/sharer/sharer.php?u='. get_permalink( $product_id );
$pinterest_link = 'http://pinterest.com/pin/create/button/?url=' .get_permalink( $product_id ). '&description='.get_the_title( $product_id );
$author_id = get_post_field( 'post_author', $product_id );
$store = dokan()->vendor->get( $author_id );
$store_address = sen_vendor_address( $store->get_address() );
?>
<h2 class="text-center"><?php echo get_the_title( $product_id ); ?></h2>
<div class="row">
    <div class="col-lg-7">
        <?php
        if( has_post_thumbnail( $product_id ) ) {
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full' );
            if( $thumbnail[0] ) {
                echo '<div class="modal-product__photo" style="background-image: url(' .esc_url( $thumbnail[0] ). ');">';
                    echo '<a href="' .esc_url( $thumbnail[0] ). '" class="zoom"></a>';
                echo '</div>';
            }
        }
        ?>
    </div>
    <div class="col-lg-5">
        <div class="price-ribbon large"><?php echo $product->get_price_html(); ?></div>
        <?php
        if( !empty( $description ) ) {
            echo '<div class="modal-product__description">' .wpautop( $description ). '</div>';
        }
        ?>
        <h3><?php _e('Producer', 'meta'); ?></h3>
        <p><?php echo $store->get_shop_name(); ?> <br><?php echo $store_address; ?></p>
    </div>
</div>
<!-- .row -->

<div class="row">
    <div class="col-lg-7">
        <?php
        if( !empty( $ingredients ) ) {
            echo '<h3>' .__('Ingredients', 'meta'). '</h3>';
            echo wpautop( $ingredients );
        }
        ?>
    </div>

    <div class="col-lg-5">
        <form action="#" method="post" enctype="multipart/form-data" class="form-cart">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <button type="submit" class="button-primary"><?php _e('Add to Basket', 'meta'); ?></button>
            <div class="quantity">
                <label for=""><?php _e('Qty', 'meta'); ?></label>
                <input type="number" name="qty" value="1" step="1" min="1" max="100" required>
            </div>
            <a href="<?php echo wc_get_cart_url(); ?>" class="cart-link"><?php _e('View Cart', 'meta'); ?></a>
        </form>
    </div>
</div>
<!-- .row -->

<div class="row">
    <div class="col-lg-7">
        <h3><?php _e('Rating', 'meta'); ?></h3>
        <?php
        $count = $product->get_review_count();

        if( $count ) {
            echo wc_get_rating_html( $product->get_average_rating() );
        } else {
            echo '<p>' .__('No rating yet.', 'meta'). '</p>';
        }
        ?>
    </div>
    <div class="col-lg-5 text-right">
        <ul class="socials">
            <li><span><?php _e('Share', 'meta'); ?></span></li>
            <li><a href="javascript:void(0)" onclick="meta_sharing('<?php echo $facebook_link; ?>')" class="facebook"></a></li>
            <li><a href="javascript:void(0)" onclick="meta_sharing('<?php echo $pinterest_link; ?>')" class="pinterest"></a></li>
        </ul>
    </div>
</div>
<!-- .row -->
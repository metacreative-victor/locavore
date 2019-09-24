<?php
if( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$p = wc_get_product( get_the_ID() );
$description = $p->get_short_description();
$price_html = $p->get_price_html();
?>
<div class="product-item">
    <?php
    $thumbnail_id = get_field( 'placeholder_photo', 'option' );

    if( has_post_thumbnail() ) {
        $thumbnail_id = get_post_thumbnail_id();
    }

    if( !empty( $thumbnail_id ) ) {
        $thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'large' );
        if( $thumbnail[0] ) {
            echo '<div class="product-item-photo" style="background-image: url(' .esc_url( $thumbnail[0] ). ');">';
                echo '<a href="' .get_permalink(). '" class="link">';
                    if( !empty( $price_html ) ) {
                        echo '<div class="price-ribbon">' .$price_html. '</div>';
                    }
                    if( $p->is_in_stock() ) {
                        $stock_quantity = sprintf( _nx( '%s in stock', '%s in stock', $p->get_stock_quantity(), 'stock quantity', 'meta' ), number_format_i18n( $p->get_stock_quantity() ) );
                        echo '<span class="inventory-ribbon">' .$stock_quantity. '</span>';
                    }
                echo '</a>';
            echo '</div>';       
        }
    }
    ?>
    <p class="product-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
	<div class="description">
		<?php
		if( !empty( $description ) ) {
			echo wpautop( $description );
		}
		?>
	</div>
    <div class="product-item-button">
        <a href="#" class="button-primary button-quickview" data-id="<?php echo get_the_ID(); ?>"><?php _e('Info', 'meta'); ?></a>
        <a href="<?php echo esc_url( $p->add_to_cart_url() ); ?>" class="button-primary"><?php _e('Add to Basket', 'meta'); ?></a>
    </div>
</div>
<!-- .product-item -->
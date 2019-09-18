<?php
if( !defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_ajax__quick_view', 'ajax_quick_view_handle' );
add_action( 'wp_ajax_nopriv__quick_view', 'ajax_quick_view_handle' );
function ajax_quick_view_handle() {
    if( !empty( $_POST['_id'] ) ) {
        $product_id = absint( $_POST['_id'] );
        set_query_var( '_view_id', $product_id );
        get_template_part( 'template-parts/modal', 'product' );
    }

    die();
}

add_action( 'wp_ajax_item_add_cart', 'ajax_item_add_cart_handle' );
add_action( 'wp_ajax_nopriv_item_add_cart', 'ajax_item_add_cart_handle' );
function ajax_item_add_cart_handle() {
    if( !empty( $_POST['_id'] ) && !empty( $_POST['_qty'] ) ) {
        $product_id = absint( $_POST['_id'] );
        $quantity = absint( $_POST['_qty'] );
        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
        $product_status = get_post_status( $product_id );
        $cart_item_data = array();

        if( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity, 0, array(), $cart_item_data ) && 'publish' === $product_status ) {
            wc_add_to_cart_message( array( $product_id => $quantity ), true );
            WC_AJAX::get_refreshed_fragments();
        }
    }

    $data = array(
        'error' => true,
        'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ),
    );

    wp_send_json( $data );
}
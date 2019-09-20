<?php
// DEFINE
define( 'META_THEME_VERSION', '1.0.3' );
define( 'META_THEME_URL', trailingslashit( get_stylesheet_directory_uri() ) );
define( 'META_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );
//  END DEFINE

include_once( META_THEME_DIR. 'inc/custom-post.php');
include_once( META_THEME_DIR. 'inc/shortcodes.php');
include_once( META_THEME_DIR. 'inc/ajax-handle.php');

// ACTIONS
function meta_setup() {
	load_theme_textdomain( 'meta' );
	add_theme_support( 'title-tag' );
    add_theme_support( 'menus' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );

    register_nav_menus(
        array(
            'primary' => 'Primary Menu',
            'secondary' => 'Secondary Menu'
        )
    );
}
add_action( 'after_setup_theme', 'meta_setup' );

function meta_scripts() {
    wp_register_script( 'meta-plugins', META_THEME_URL . 'assets/js/plugins.min.js', array('jquery'), null, true );
    wp_register_script( 'meta-script', META_THEME_URL . 'assets/js/theme.js', array('meta-plugins'), META_THEME_VERSION, true );
    
    wp_enqueue_script( 'meta-plugins' );
    wp_enqueue_script( 'meta-script' );

    wp_localize_script( 'meta-script', 'meta_data', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'homeurl' => home_url('/')
    ));
}
add_action( 'wp_enqueue_scripts', 'meta_scripts' );

function meta_styles() {
    wp_register_style( 'meta-plugins', META_THEME_URL . 'assets/css/plugins.min.css', array(), null, 'screen' );
    wp_register_style( 'meta-style', META_THEME_URL . 'assets/css/theme.css', array(), null, 'screen' );

    wp_enqueue_style( 'meta-plugins' );
    wp_enqueue_style( 'meta-style' );
}
add_action( 'wp_enqueue_scripts', 'meta_styles' );

function meta_options_page() {
    if( function_exists('acf_add_options_page') ) {
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Theme Options', 'meta'),
            'menu_title'    => __('Theme Options', 'meta'),
            'menu_slug'     => 'theme-options',
        ));
    }
}
add_action( 'acf/init', 'meta_options_page' );

function meta_register_sidebar() {
    register_sidebar( array(
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    for( $i = 1; $i <= 2; $i++ ) {
        register_sidebar( array(
            'name' => 'Footer #' .$i,
            'id' => 'footer-' .$i,
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action( 'widgets_init', 'meta_register_sidebar' );
// END ACTIONS

// FILTERS
function meta_upload_mimes( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'meta_upload_mimes' );

function sen_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'sen_excerpt_length', 999 );

function sen_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'sen_excerpt_more' );

function sen_woocommerce_add_to_cart_fragments( $fragments ) {
    $fragments['div.mini-cart'] = '<div class="mini-cart"><a href="' .wc_get_cart_url(). '" class="button-cart"><span class="badge">' .WC()->cart->get_cart_contents_count(). '</span></a></div>';

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'sen_woocommerce_add_to_cart_fragments' );
// END FILTERS

// HELPERS
function sen_vendor_address( $address ) {
    if( isset( $address['zip'] ) ) {
        $address['postcode'] = $address['zip'];
    }
    
    if( isset( $address['street_1'] ) ) {
        $address['address_1'] = $address['street_1'];
    }

    if( isset( $address['street_2'] ) ) {
        $address['address_2'] = $address['street_2'];
    }
    
    return WC()->countries->get_formatted_address( $address, '<br/>' );
}

function sen_paging( $max_num = 0 ) {
    global $wp_query;
    $max_num_pages = $wp_query->max_num_pages;

    if( !empty( $max_num ) ) {
        $max_num_pages = $max_num;
    }

    echo paginate_links( array(
        'base'         => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', htmlspecialchars_decode( get_pagenum_link( 999999999 ) ) ) ) ),
        'format'       => '',
        'current'      => max( 1, get_query_var( 'paged' ) ),
        'total'        => $max_num_pages,
        'prev_text'    => '&larr;',
        'next_text'    => '&rarr;',
        'type'         => 'list',
        'end_size'     => 3,
        'mid_size'     => 3
    ));
}

// Remove become a vendor button after customer sign up
remove_action( 'woocommerce_after_my_account', array( Dokan_Pro::init(), 'dokan_account_migration_button' ) );

// Remove coupons from Vendor dashboard
add_filter( 'dokan_get_dashboard_nav', 'prefix_dokan_add_seller_nav',12 );

function prefix_dokan_add_seller_nav( $urls ) { 
	//unset( $urls['coupons'],$urls['reviews'],$urls['orders'], $urls['reports'],$urls['withdraw'] );
	unset( $urls['coupons'],$urls['reviews'] ); 
	return $urls;
}
add_filter( 'dokan_get_dashboard_settings_nav','wlrs_dashbaord_settings_nav',11);
function wlrs_dashbaord_settings_nav($sub_settins){
	//unset($sub_settins['payment']);
	unset($sub_settins['social']);
	unset($sub_settins['verification']);
	unset($sub_settins['seo']);
return $sub_settins;
}

// Vendor dashboard bank details fields
add_filter( 'dokan_withdraw_methods', 'wp1923_change_whithdraw_callback', 12 );

function wp1923_change_whithdraw_callback( $methods ) {

	$methods['bank']['callback'] = 'wp12232_render_bank_html';
	$methods ['bank']['title'] = __( 'Bank Transfer', 'dokan-lite' ); //title can be changed as per your need

	return $methods;
}

function wp12232_render_bank_html( $store_settings ) {
    $account_name   = isset( $store_settings['payment']['bank']['ac_name'] ) ? $store_settings['payment']['bank']['ac_name'] : '';
    $account_number = isset( $store_settings['payment']['bank']['ac_number'] ) ? $store_settings['payment']['bank']['ac_number'] : '';
    $bank_name      = isset( $store_settings['payment']['bank']['bank_name'] ) ? $store_settings['payment']['bank']['bank_name'] : '';
    $bank_addr      = isset( $store_settings['payment']['bank']['bank_addr'] ) ? $store_settings['payment']['bank']['bank_addr'] : '';
    $routing_number = isset( $store_settings['payment']['bank']['routing_number'] ) ? $store_settings['payment']['bank']['routing_number'] : '';
    $iban           = isset( $store_settings['payment']['bank']['iban'] ) ? $store_settings['payment']['bank']['iban'] : '';
    $swift_code     = isset( $store_settings['payment']['bank']['swift'] ) ? $store_settings['payment']['bank']['swift'] : '';

    // Get new added values like other one
    
    ?>
    <div class="dokan-form-group">
        <div class="dokan-w8">
            <input name="settings[bank][ac_name]" value="<?php echo esc_attr( $account_name ); ?>" class="dokan-form-control" placeholder="<?php esc_attr_e( 'Account name', 'dokan-lite' ); ?>" type="text">
        </div>
    </div>

	<div class="dokan-form-group">
        <div class="dokan-w8">
            <input name="settings[bank][routing_number]" value="<?php echo esc_attr( $routing_number ); ?>" class="dokan-form-control" placeholder="<?php esc_attr_e( 'BSB', 'dokan-lite' ) ?>" type="text">
        </div>
    </div>

    <div class="dokan-form-group">
        <div class="dokan-w8">
            <input name="settings[bank][ac_number]" value="<?php echo esc_attr( $account_number ); ?>" class="dokan-form-control" placeholder="<?php esc_attr_e( 'Your bank account number', 'dokan-lite' ); ?>" type="text">
        </div>
    </div>

    <div class="dokan-form-group">
        <div class="dokan-w8">
            <input name="settings[bank][bank_name]" value="<?php echo esc_attr( $bank_name ); ?>" class="dokan-form-control" placeholder="<?php esc_attr_e( 'Name of your bank', 'dokan-lite' ) ?>" type="text">
        </div>
    </div>

    

    

    <!-- .dokan-form-group -->

    <!-- add whatever you want -->
    <?php
}

//Add Alphabetical sorting option to shop page / WC Product Settings
function sv_alphabetical_woocommerce_shop_ordering( $sort_args ) {
  $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
 
    if ( 'alphabetical' == $orderby_value ) {
        $sort_args['orderby'] = 'title';
        $sort_args['order'] = 'asc';
        $sort_args['meta_key'] = '';
    }
 
    return $sort_args;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'sv_alphabetical_woocommerce_shop_ordering' );

// END HELPERS
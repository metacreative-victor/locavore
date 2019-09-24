<?php
get_header();
?>

<div class="shop-container">
    <?php get_sidebar('shop'); ?>
    
    <div class="shop-content">
        <?php while( have_posts() ) : the_post(); ?>
            <?php
            $product_id = get_the_ID();
            $product = wc_get_product( $product_id );
            $facebook_link = 'https://www.facebook.com/sharer/sharer.php?u='. get_permalink();
            $pinterest_link = 'http://pinterest.com/pin/create/button/?url=' .get_permalink(). '&description='.get_the_title();
            $description = $product->get_short_description();
            $ingredients = get_field( 'product_ingredients' );
            $author_id = get_post_field( 'post_author', $product_id );
            $store = dokan()->vendor->get( $author_id );
            $store_address = sen_vendor_address( $store->get_address() );
            ?>

            <h1 class="text-center"><?php the_title(); ?></h1>
            <div class="row">
                <div class="col-lg-5">
                    <?php
                    if( has_post_thumbnail() ) {
                        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                        if( $thumbnail[0] ) {
                            echo '<div class="single-product__photo" style="background-image: url(' .esc_url( $thumbnail[0] ). ');">';
                                echo '<a href="' .esc_url( $thumbnail[0] ). '" class="zoom"></a>';
                                if( $product->is_in_stock() ) {
                                    $stock_quantity = sprintf( _nx( '%s product left', '%s products left', $product->get_stock_quantity(), 'stock quantity', 'meta' ), number_format_i18n( $product->get_stock_quantity() ) );
                                    echo '<span class="inventory-ribbon">' .$stock_quantity. '</span>';
                                }
                            echo '</div>';
                        }
                    } else {
						$thumbnail_id = get_field( 'placeholder_photo', 'option' );
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'large' );
						
                        if( $thumbnail[0] ) {
                            echo '<div class="single-product__photo" style="background-image: url(' .esc_url( $thumbnail[0] ). ');">';
                                if( $product->is_in_stock() ) {
                                    $stock_quantity = sprintf( _nx( '%s product left', '%s products left', $product->get_stock_quantity(), 'stock quantity', 'meta' ), number_format_i18n( $product->get_stock_quantity() ) );
                                    echo '<span class="inventory-ribbon">' .$stock_quantity. '</span>';
                                }
                            echo '</div>';
                        }
					}
                    ?>
                </div>
                <div class="col-lg-7">
                    <div class="price-ribbon large"><?php echo $product->get_price_html(); ?></div>
                    <?php
                    if( !empty( $description ) ) {
                        echo '<div class="single-product__description">' .wpautop( $description ). '</div>';
                    }
                    ?>
                    
                    <div class="single-product__producer">
						<?php
						global $product;
    					$author = get_user_by('id', $product->post->post_author);
						?>
						<h3><?php _e('Producer', 'meta'); ?></h3>
						<?php printf( '<p><a href="%s">%s</a></p>', dokan_get_store_url( $author->ID ), $store->get_shop_name() ); ?>

                    </div>

                    <div class="single-product__form">
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
            </div>
            <!-- .row -->
            <div class="row">
                <div class="col-lg-5">
                    <div class="single-product__ingredients">
                        <?php
                        if( !empty( $ingredients ) ) {
                            echo '<h3>' .__('Ingredients', 'meta'). '</h3>';
                            echo wpautop( $ingredients );
                        }
                        ?>
                    </div>

                    <div class="single-product__rating">
                        <?php
                        if( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                        ?>
                    </div>

                    <ul class="socials">
                        <li><span><?php _e('Share', 'meta'); ?></span></li>
                        <li><a href="javascript:void(0)" onclick="meta_sharing('<?php echo $facebook_link; ?>')" class="facebook"></a></li>
                        <li><a href="javascript:void(0)" onclick="meta_sharing('<?php echo $pinterest_link; ?>')" class="pinterest"></a></li>
                    </ul>
                </div>
                <div class="col-lg-7">
                    <?php
                    $related_products = wc_get_related_products( $product_id, 2 );
                    
                    if( $related_products ) {
                        echo '<div class="single-product__related">';
                            echo '<h3>' .__('Related Produce', 'meta'). '</h3>';
                            foreach( $related_products as $p ) {
                                $r_author_id = get_post_field( 'post_author', $p );
                                $r_store = dokan()->vendor->get( $r_author_id );
                                echo '<div class="list-product">';
                                    if( has_post_thumbnail( $p ) ) {
                                        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $p ), 'large' );
                                        echo '<div class="list-product__photo" style="background-image: url(' .esc_url( $thumbnail[0] ). ');">';
                                            echo '<a href="' .get_permalink( $p ). '" class="list-product__link"></a>';
                                        echo '</div>';
                                    }
                                    echo '<div class="list-product__content">';
                                        echo '<p class="list-product__content-title"><a href="' .get_permalink( $p ). '">' .get_the_title( $p ). '</a></p>';
                                        echo '<p>' .__('Grower:', 'meta'). ' ' .$r_store->get_shop_name().'</p>';
                                        echo '<a href="' .get_permalink( $p ). '" class="button-primary">' .__('View', 'meta'). '</a>';
                                    echo '</div>';
                                echo '</div><!-- .list-product -->';
                            }
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <!-- .row -->
        <?php endwhile; ?>
    </div>
    <!-- .shop-content -->
</div>
<!-- .shop-container -->

<?php get_template_part( 'template-parts/sections/subscribe' ); ?>

<?php
get_footer();
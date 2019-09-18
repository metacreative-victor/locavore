<?php
if( !defined( 'ABSPATH' ) ) {
	exit;
}

$data = get_field( 'welcome' );

if( !empty( $data['photo'] ) ) {
    $photo = wp_get_attachment_image_src( $data['photo'], 'full' );

    if( !empty( $photo[0] ) ) {
        echo '<section id="welcome" style="background-image: url(' .esc_url( $photo[0] ). ');">';
    }
} else {
    echo '<section id="welcome">';
}
?>

    <div class="container text-center">
        <?php
        if( !empty( $data['heading'] ) ) {
            echo '<h1>' .$data['heading']. '</h1>';
        }

        if( !empty( $data['button'] ) && !empty( $data['button']['url'] ) && !empty( $data['button']['title'] ) ) {
            echo '<a href="' .$data['button']['url']. '" class="button-primary button-lg">' .$data['button']['title']. '</a>';
        }
        ?>
    </div>
    <!-- .container -->

    <?php
    $terms = get_terms( array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
    ));

    if( !empty( $terms ) ) {
        echo '<div class="welcome-menu">';
            echo '<ul class="menu">';
                foreach( $terms as $t ) {
                    echo '<li><a href="' .get_term_link( $t ). '">' .$t->name. '</a></li>';
                }
            echo '</ul>';
        echo '</div>';
    }
    ?>
</section>
<!-- #welcome -->
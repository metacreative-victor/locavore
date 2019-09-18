<?php
if( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$data = get_field( 'how_it_works' );
?>
<section id="how-it-works" class="page-section">
    <div class="container">
        <?php
        if( !empty( $data['heading'] ) ) {
            echo '<h2 class="section-heading text-center">' .$data['heading']. '</h2>';
        }

        if( !empty( $data['items'] ) ) {
            echo '<div class="row">';
                foreach( $data['items'] as $a => $b ) {
                    if( !empty( $b['text'] ) ) {
                        echo '<div class="col-md-4 text-center">';
                            echo '<span class="rounded-circle number-circle">' .($a + 1). '</span>';
                            echo wpautop( $b['text'] );
                        echo '</div>';
                    }
                }
            echo '</div><!-- .row -->';
        }
        ?>
    </div>
    <!-- .container -->
</section>
<!-- #how-it-works -->
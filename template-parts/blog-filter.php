<?php
$cat_1 = get_term( 55, 'category' );
$cat_2 = get_term( 109, 'category' );
$cat_3 = get_term( 110, 'category' );
$active_1 = $active_2 = $active_3 = $active_4 = '';

if( is_category(55) ) { $active_1 = 'active'; }
if( is_post_type_archive('recipe') ) { $active_2 = 'active'; }
if( is_category(109) ) { $active_3 = 'active'; }
if( is_category(110) ) { $active_4 = 'active'; }

echo '<ul class="menu blog-filter">';
    if( !empty( $cat_1 ) ) {
        echo '<li class="' .$active_1. '"><a href="' .esc_url( get_term_link( $cat_1 ) ). '">' .$cat_1->name. '</a></li>';
    }
    echo '<li class="' .$active_2. '"><a href="' .esc_url( get_post_type_archive_link('recipe') ). '">' .__('Recipes', 'meta'). '</a></li>';
    if( !empty( $cat_2 ) ) {
        echo '<li class="' .$active_3. '"><a href="' .esc_url( get_term_link( $cat_2 ) ). '">' .$cat_2->name. '</a></li>';
    }
    if( !empty( $cat_3 ) ) {
        echo '<li class="' .$active_4. '"><a href="' .esc_url( get_term_link( $cat_3 ) ). '">' .$cat_3->name. '</a></li>';
    }
echo '</ul><!-- .blog-filter -->';
?>
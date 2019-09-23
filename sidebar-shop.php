<div class="shop-sidebar">
	<h3 class="shop-sidebar__title"><?php _e('Filter', 'meta'); ?></h3>

	<?php
	$terms = get_terms( array(
		'taxonomy' => 'product_cat',
		'hide_empty' => false,
		'exclude' => array( 15 ),
		'orderby' => 'title',
		'order' => 'ASC'
	));

	if( !empty( $terms ) ) {
		$current_term = null;

		if( is_tax() ) {
			$current_term = get_queried_object();
		}
		
		echo '<ul class="menu menu-filter">';
			foreach( $terms as $term ) {
				$class = '';
				if( $current_term && $current_term->term_id == $term->term_id ) {
					$class = 'active';
				}
				echo '<li class="' .$class. '"><a href="' .esc_url( get_term_link( $term ) ). '">' .$term->name. '</a></li>';
			}
		echo '</ul>';
	}
	?>
</div>
<!-- .shop-sidebar -->
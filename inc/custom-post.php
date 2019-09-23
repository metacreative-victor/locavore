<?php
add_action( 'init', 'sen_register_post_type' );
function sen_register_post_type() {
	register_post_type( 'Recipe', array(
		'label' => __('Recipes', 'sen'),
		'public' => true,
		'labels' => array(
			'name' => __('Recipes', 'sen'),
			'singular_name' => __('Recipes', 'sen'),
			'add_new' => __('Add Recipe', 'sen'),
			'add_new_item' => __('Add Recipe', 'sen'),
			'edit_item' => __('Edit Recipe', 'sen'),
			'new_item' => __('New Recipe', 'sen'),
			'view_item' => __('View Recipe', 'sen'),
			'search_items' => __('Search Recipe', 'sen'),
			'not_found' =>  __('Not found Recipe', 'sen'),
			'not_found_in_trash' => __('Not found Recipes in trash', 'sen')
		),
		'show_ui' => true, 
		'query_var' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'recipes','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-post',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' )
	));

	register_post_type( 'grower', array(
		'label' => __('Growers', 'sen'),
		'public' => true,
		'labels' => array(
			'name' => __('Growers', 'sen'),
			'singular_name' => __('Growers', 'sen'),
			'add_new' => __('Add Grower', 'sen'),
			'add_new_item' => __('Add Grower', 'sen'),
			'edit_item' => __('Edit Grower', 'sen'),
			'new_item' => __('New Grower', 'sen'),
			'view_item' => __('View Grower', 'sen'),
			'search_items' => __('Search Grower', 'sen'),
			'not_found' =>  __('Not found Grower', 'sen'),
			'not_found_in_trash' => __('Not found Growers in trash', 'sen')
		),
		'show_ui' => true, 
		'query_var' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'growers','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-post',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' )
	));
}
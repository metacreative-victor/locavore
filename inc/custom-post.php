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
}
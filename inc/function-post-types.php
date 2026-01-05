<?php
// Register Product Post Type
create_post_type('product', array(
	'name' => 'Products',
	'singular_name' => 'Product',
	'slug' => 'product',
	'icon' => 'dashicons-products',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true
));

// Register Product Taxonomy
create_taxonomy('product_cat', array(
	'name' => 'Product Categories',
    'singular_name' => 'Product Category',
	'object_type' => array('product'),
	'slug' => 'product-category',
    'hierarchical' => true,
    'show_in_rest' => true
));

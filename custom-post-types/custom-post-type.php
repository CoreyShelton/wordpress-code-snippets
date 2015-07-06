<?php 
/**
 * Create custom post type for `Ratings` and `Stories`
 */
add_action( 'init', 'register_cpt_rating' );

function register_cpt_rating() {

    $labels = array( 
        'name' => _x( 'Ratings', 'rating' ),
        'singular_name' => _x( 'Rating', 'rating' ),
        'add_new' => _x( 'Add New Rating', 'rating' ),
        'add_new_item' => _x( 'Add New Rating', 'rating' ),
        'edit_item' => _x( 'Edit Rating', 'rating' ),
        'new_item' => _x( 'New Rating', 'rating' ),
        'view_item' => _x( 'View Rating', 'rating' ),
        'search_items' => _x( 'Search Ratings', 'rating' ),
        'not_found' => _x( 'No ratings found', 'rating' ),
        'not_found_in_trash' => _x( 'No ratings found in Trash', 'rating' ),
        'parent_item_colon' => _x( 'Parent Rating:', 'rating' ),
        'menu_name' => _x( 'Ratings', 'rating' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Atlantic Bay ratings',
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'revisions', 'page-attributes' ),
        //'taxonomies' => array('category', 'post_tag' ),
        'public' => true, // Set to true to view url
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'show_in_nav_menus' => false,
        'publicly_queryable' => true, //was set to false
        'exclude_from_search' => false, //was set to true
        'has_archive' => true, //was set to false
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
}

/**
 * Add/Change icon for Ratings` and `Stories` CPTs
 */
add_action( 'admin_head', 'add_menu_icons_styles' );

function add_menu_icons_styles() {
?>
 
<style>

li#menu-posts-rating .dashicons-admin-post:before, 
li#menu-posts-rating .dashicons-format-standard:before {
  content: '\f155';
}

li#menu-posts-story .dashicons-admin-post:before, 
li#menu-posts-story .dashicons-format-standard:before {
  content: '\f307';
}
</style>
 <?php
}
?>
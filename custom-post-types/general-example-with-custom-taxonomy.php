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

    register_post_type( 'rating', $args );
}

/**
 * Remove specific plugin custom meta boxes for (Rev slider and Ess. Grid Posts)
 * from the `Ratings` and `Stories` CPTs
 */
add_action('add_meta_boxes', 'remove_custom_meta', 40);

function remove_custom_meta() {
    remove_meta_box( 'eg-meta-box', 'rating', 'normal' );
    remove_meta_box( 'mymetabox_revslider_0' , 'rating' , 'normal' );
    remove_meta_box( 'postcustom' , 'rating' , 'normal' );
}

/**
 * Add/Change icon for Ratings` and `Stories` CPTs
 */
add_action( 'admin_head', 'add_menu_icons_styles' );

function add_menu_icons_styles(){
?>
 
<style>
li#menu-posts-rating .dashicons-admin-post:before, 
li#menu-posts-rating .dashicons-format-standard:before {
  content: '\f155';
}
</style>
 <?php
}


/**
 * Create custom taxonomies for `Ratings` and `Stories`
 */
add_action( 'init', 'rating_taxonomies', 0 );
 
function rating_taxonomies() {

    /**
     * Add new `Rating Topics` taxonomy and make it hierarchical like categories
     * 
     * Applies to `Ratings` only
     */

    $rating_topic_labels = array(
        'name' => _x( 'Rating Topics', 'taxonomy general name' ),
        'singular_name' => _x( 'Rating Topic', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Rating Topics' ),
        'all_items' => __( 'All Rating Topics' ),
        'parent_item' => __( 'Parent Topic' ),
        'parent_item_colon' => __( 'Parent Rating Topic:' ),
        'edit_item' => __( 'Edit Rating Topic' ), 
        'update_item' => __( 'Update Rating Topic' ),
        'add_new_item' => __( 'Add New Rating Topic' ),
        'new_item_name' => __( 'New Rating Topic Name' ),
        'menu_name' => __( 'Rating Topics' ),
    ); 	

    // Taxonomy args
    $rating_topic_args = array(
        'hierarchical' => true,
        'labels' => $rating_topic_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'rating-topic' ),
    );


    // Now register all of the taxonomies
    register_taxonomy('rating_topics',array('rating'), $rating_topic_args);
}
?>
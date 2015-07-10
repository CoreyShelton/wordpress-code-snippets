<?php 

/**
 * Plugin Name: Ajax Test
 * Plugin URI: Corey Shelton
 * Description: This is a plugin that allows you to test Ajax functionality in WordPress
 * Version: 1.0.0
 * Author: Corey Shelton
 * Author URI: http://hicoreyshelton.com
 * License: GPL2
 */
 
/**
 * Enqueue JavaScript and localize Wordpress Ajax Object
 */
function ajax_test_enqueue_scripts() {
    wp_enqueue_script( 'test', plugins_url( '/test.js', __FILE__ ), array('jquery'), '1.0', true );
    wp_localize_script( 'test', 'ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nextNonce' => wp_create_nonce( 'rating-nonce' ))
    );
}
add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts' );


/**
 * Create Ajax call
 */
function get_latest() {
    $args = array(
        'posts_per_page'  => 5,
        'category'        => 1,
    );
    
    $posts_array = get_posts($args);
    
    echo '<nav role="navigation">';
    
    echo '<h2>Latest News</h2>';
    
    echo '<ul>';
    
    foreach ($posts_array as $post):
        setup_postdata($post);
        echo '<li><a class="' . esc_attr("ajax-post") . '" href="' . esc_attr(get_page_link($post->ID)) . '" data-postID="'. esc_attr($post->ID) .'">' . $post->post_title . '</a>';
    endforeach;
    
    echo '</ul>';
    
    echo '</nav>';
    
    die();
}
add_action( 'wp_ajax_nopriv_get_latest', 'get_latest' );
add_action( 'wp_ajax_get_latest', 'get_latest' );


/**
 * Get post content based upon the ID being passed via $_GET
 */
function get_post_content () {
    
    $nonce = !empty($_GET['nextNonce']) ? $_GET['nextNonce'] : 0; 
    
    if ($nonce !== 0) :
    
        if (!wp_verify_nonce($nonce, 'rating-nonce')) :
        
            die('Not verfied!');
        
        else:
            $id = $_GET['id'];
    
            header('Content-Type: application/json');
            
            $post_object = get_post($id, ARRAY_A);
            $post_meta = get_post_meta($id);
            
            $array = array($post_object, $post_meta);
            $array = json_encode($array);
            print_r($array); 
            
            die();
        endif;
        
    else :
    
        die('Not permitted!');
    
    endif;
    
}
add_action ( 'wp_ajax_nopriv_get_post_content', 'get_post_content' );
add_action ( 'wp_ajax_get_post_content', 'get_post_content' );


/** 
 * Add Plugin Page
 * @link https://blog.idrsolutions.com/2014/06/wordpress-plugin-part-1/
 */
function ajax_test_init(){
    echo "<h1>Hello World!</h1>";
}

function ajax_test_plugin_setup_menu(){
    add_menu_page( 'Ajax Test Plugin Page', 'Ajax Test Plugin', 'manage_options', 'ajax-test-plugin', 'ajax_test_init' );
}
add_action('admin_menu', 'ajax_test_plugin_setup_menu');

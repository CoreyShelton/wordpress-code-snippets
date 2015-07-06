<?php 

/**
 * Plugin Name: Ajax Test
 * Plugin URI: http://danielpataki.com
 * Description: This is a plugin that allows you to test Ajax functionality in WordPress
 * Version: 1.0.0
 * Author: Daniel Pataki
 * Author URI: http://danielpataki.com
 * License: GPL2
 */
 
add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts' );
function ajax_test_enqueue_scripts() {
    wp_enqueue_script( 'test', plugins_url( '/test.js', __FILE__ ), array('jquery'), '1.0', true );
    wp_localize_script( 'test', 'ajax_object', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nextNonce' => wp_create_nonce( 'rating-nonce' ))
    );
}
/*
	Example URL: http://www.abmg-dev.com/wp-admin/admin-ajax.php?action=get_post_content&nextNonce=10d28ab002&id=1744
*/
add_action ( 'wp_ajax_nopriv_get_post_content', 'get_post_content' );
add_action ( 'wp_ajax_get_post_content', 'get_post_content' );
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
?>
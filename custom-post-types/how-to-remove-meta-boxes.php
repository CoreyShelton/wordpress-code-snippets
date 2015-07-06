<?php 
/**
 * Remove the 'Custom Fields' and 'Post Excerpt' meta boxes from posts
 */
add_action('add_meta_boxes', 'remove_custom_meta', 40);

function remove_custom_meta() {
    remove_meta_box( 'postcustom' , 'post' , 'normal' );
 
}

?>
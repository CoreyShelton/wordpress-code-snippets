# Add Open Graph Meta Information

The following PHP code is meant to be included in the functions.php file

```php
<?php
if ( !function_exists( 'add_opengraph' ) ) {
    function add_opengraph() {
        global $post; 
        if ( empty( $post ) ) {
            return "";
        }
        
        echo "\n<!-- " . get_bloginfo( 'name' ) . " Open Graph Tags -->\n";
        
        echo "<meta property='og:site_name' content='". get_bloginfo( 'name' ) ."'/>\n"; 
        echo "<meta property='og:url' content='" . get_permalink() . "'/>\n"; 

        if ( is_singular() ) { 
            echo "<meta property='og:title' content='" . get_the_title() . "'/>\n"; 
            echo "<meta property='og:type' content='article'/>\n"; 
            
            $content = ( !empty( $post->post_excerpt ) ) ?
                            wp_trim_words( strip_shortcodes( $post->post_excerpt ), 30 ) :
                                wp_trim_words( strip_shortcodes( $post->post_content ), 30 ); 
            if ( empty( $content ) ) {
                $content = "Visit the post for more.";
            }
            echo "<meta property='og:description' content='" . $content . "' />\n";
        } elseif( is_front_page() or is_home() ) { 
            echo "<meta property='og:title' content='" . get_bloginfo( "name" ) . "'/>\n"; 
            echo "<meta property='og:type' content='website'/>\n"; 
        }

        if( has_post_thumbnail( $post->ID ) ) { 
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
            echo "<meta property='og:image' content='" . esc_attr( $thumbnail[0] ) . "'/>\n";
        }
        echo "\n";
    }
}
if ( !defined('WPSEO_VERSION') && !class_exists('NY_OG_Admin')) {
    add_action( 'wp_head', 'add_opengraph', 5 );
}
?>
```

***

*Ref: https://gist.github.com/tojibon/ab5e46f4164e9ff69043*

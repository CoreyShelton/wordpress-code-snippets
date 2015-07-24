# Add An Admin Post/Custom Post Filter

The following describes how to add an admin post or custom post filter to filter the posts by a single custom field ```meta_value```.

***

*PHP*
```php 
/**
 * First create the dropdown
 * make sure to change CHANGE_TO_YOUR_CUSTOM_POST_TYPE to the name of your custom post type
 * 
 * @return void
 */
function cs_admin_posts_filter_restrict_manage_posts(){
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    //only add filter to post type you want
    if ('CHANGE_TO_YOUR_CUSTOM_POST_TYPE' == $type){
        /*
         * Change this to the list of values you want to show in 'label' => 'value' format
         */
        $values = array(
            'LABEL_ONE' => 'meta_value_to_filter_by', 
            'LABEL_TWO' => 'meta_value_to_filter_by', 
            'LABEL_THREE' => 'meta_value_to_filter_by'
        );
        ?>
        <select name="ADMIN_FILTER_FIELD_VALUE">
        <option value=""><?php _e('Filter By', 'your_textdomain_here'); ?></option>
        <?php
            $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
            foreach ($values as $label => $value) {
                printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $value,
                        $value == $current_v? ' selected="selected"':'',
                        $label
                    );
                }
        ?>
        </select>
        <?php
    }
}
add_action( 'restrict_manage_posts', 'cs_admin_posts_filter_restrict_manage_posts' );


/**
 * if submitted filter by post meta
 * 
 * make sure to change CHANGE_TO_META_KEY_YOU_WANT_TO_FILTER_BY to the actual meta key
 * and CHANGE_TO_YOUR_CUSTOM_POST_TYPE to the name of your custom post type
 * @param  (wp_query object) $query
 * 
 * @return Void
 */
function cs_posts_filter( $query ){
    global $pagenow;
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'CHANGE_TO_YOUR_CUSTOM_POST_TYPE' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '') {
        $query->query_vars['meta_key'] = 'CHANGE_TO_META_KEY_YOU_WANT_TO_FILTER_BY';
        $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
    }
}
add_filter( 'parse_query', 'cs_posts_filter' );
```

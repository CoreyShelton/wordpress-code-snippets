### How To Add Admin Top Bar Menu Items

Use the following code to add additional menu items to the admin's top bar menu section

***

```php
/**
 * Get Current User's Role
 *
 * @return current user's role/capabilities
 * @author Corey Shelton
 */
function cs_get_user_role() {
    global $current_user;

    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);

    return $user_role;
}

/**
 * Remove unnecessary links from the admin section for non-admin's
 *
 * @author Corey Shelton
 * @link http://www.paulund.co.uk/how-to-remove-links-from-wordpress-admin-bar
 * @link http://davidwalsh.name/add-submenu-wordpress-admin-bar
 */
function cs_admin_bar_modify() {

    $userRole = cs_get_user_role();

    global $wp_admin_bar;

    // If the user is not an admin then remove all of these links
    //if ( $userRole !== 'administrator') :
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
        $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
        $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
        $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
        $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
        $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
        $wp_admin_bar->remove_menu('updates');          // Remove the updates link
        $wp_admin_bar->remove_menu('new-content');      // Remove the content link
        $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
        
        /*
         * To add a drop down menu with multiple sub-menu items uncomment the following
         *
         * Ref: http://davidwalsh.name/add-submenu-wordpress-admin-bar
         */
        //$menu_id = 'my-custom-top-bar-item';
        //$wp_admin_bar->add_menu(array('id' => $menu_id, 'title' => __('Parent Item'), 'href' => '/'));
        //$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Homepage'), 'id' => 'dwb-home', 'href' => '/', 'meta' => array('target' => '_blank')));
		//$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Drafts'), 'id' => 'dwb-drafts', 'href' => 'edit.php?post_status=draft&post_type=post'));
		//$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Pending Comments'), 'id' => 'dwb-pending', 'href' => 'edit-comments.php?comment_status=moderated'));
        
        // Adds just a single menu item
        $wp_admin_bar->add_menu(array('id' => 'ig-user-lookup', 'title' => __('Lookup User\'s Instagram ID'), 'href' => 'http://www.example.com', 'meta' => array('target' => '_blank')));
    //endif;
}
add_action( 'wp_before_admin_bar_render', 'abm_admin_bar_modify' );
```

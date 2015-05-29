# Remove Unnecessary Links In Admin Panel

Use this code to remove unnecessary links – that are displayed as a default by Wordpress – in your admin panel's top bar for NON-ADMIN users.

*Insert the following code snippets in your themes function.php file.*

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
*/
function cs_admin_bar_modify() {

    $userRole = cs_get_user_role();

    global $wp_admin_bar;
    
    // If the user is not an admin then remove all of these links
    if ( $userRole !== 'administrator') :
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
    endif;
}
add_action( 'wp_before_admin_bar_render', 'cs_admin_bar_modify' );
```

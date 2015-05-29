# Remove Specific Admin Dashboard Meta Boxes

The following code snippets remove specific admin dashboard meta/content widgets from NON-ADMIN users.

The list of Admin Dashboard widgets that you can remove include:
- Right Now Dashboard Widget
- Recent Comments Dashboard Widget
- Incoming Linkgs Dashboard Widget
- Plugins Dashboard Widget
- Quick Press Dashboard Widget
- Recent Drafts Dashboard Widget
- Wordpress Blog Dashboard Widget
- Other Wordpress News Dashboard Widget

*Insert the following code snippets in your themes function.php file.*

For more information you can visit https://codex.wordpress.org/Function_Reference/remove_meta_box

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
* Remove specific meta content boxes From The Admin Bar when logged in user is not an admin
*
* @author Corey Shelton
* @link https://codex.wordpress.org/Function_Reference/remove_meta_box
*/
function cs_remove_dashboard_widgets(){
    $userRole = cs_get_user_role();
    
    if ( $userRole !== 'administrator') : 
        /**
        * Simply uncomment the Dashboard content/meta boxes
        * that you want to remove for non-admin users
        */
        //remove_meta_box('dashboard_right_now', 'dashboard', 'normal');      // Right Now
        //remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');// Recent Comments
        //remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); // Incoming Links
        //remove_meta_box('dashboard_plugins', 'dashboard', 'normal');        // Plugins
        //remove_meta_box('dashboard_quick_press', 'dashboard', 'side');      // Quick Press
        //remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');    // Recent Drafts
        //remove_meta_box('dashboard_primary', 'dashboard', 'side');          // WordPress blog
        //remove_meta_box('dashboard_secondary', 'dashboard', 'side');        // Other WordPress News
     endif;
}
add_action('wp_dashboard_setup', 'cs_remove_dashboard_widgets');
```

# Remove Specific Admin Menu Items For Non-Admin Users

Use this code to remove specific menu items in the admin panel's side-menu from NON-ADMIN users.

*Insert the following code snippets in your themes function.php file.*

For more information you can visit https://codex.wordpress.org/Function_Reference/remove_menu_page

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
* Remove specific menu links From The Admin Menu when logged in user is not an admin
*
* @author Corey Shelton
* @link https://codex.wordpress.org/Function_Reference/remove_menu_page
*/
function cs_remove_menus() {
    $userRole = cs_get_user_role();
    
    if ( $userRole !== 'administrator') :
        /** 
        * Simply uncomment the following menu items that
        * you don't want displayed for non-admin users
        */
        
        //remove_menu_page( 'index.php' );                  //Dashboard
        //remove_menu_page( 'edit.php' );                   //Posts
        //remove_menu_page( 'upload.php' );                 //Media
        //remove_menu_page( 'edit.php?post_type=page' );    //Pages
        //remove_menu_page( 'edit-comments.php' );          //Comments
        //remove_menu_page( 'themes.php' );                 //Appearance
        //remove_menu_page( 'plugins.php' );                //Plugins
        //remove_menu_page( 'users.php' );                  //Users
        //remove_menu_page( 'tools.php' );                  //Tools
        //remove_menu_page( 'options-general.php' );        //Settings  
    endif;
}
add_action( 'admin_menu', 'cs_remove_menus' );
```

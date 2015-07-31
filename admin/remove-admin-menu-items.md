# Admin Menu Remove 
The following allows you to remove most admin menu items such as
- edit.php?post_type=      //Custom Post Type
- admin.php?page=          //Plugin Specific Page - Requires the use of Option 2
- index.php                //Dashboard
- edit.php                 //Posts
- upload.php               //Media
- edit.php?post_type=page  //Pages
- edit-comments.php        //Comments
- themes.php               //Appearance
- plugins.php              //Plugins
- users.php                //Users
- tools.php                //Tools
- options-general.php      //Settings

***

```php
<?php 
	/**
 * Admin Menu Bar Modification
 * Remove the following menu items
 * Option 1
 */
function abm_remove_menus(){  
    remove_menu_page( 'edit-comments.php' );                 // Comments
    remove_menu_page( 'index.php' );                         // Dashboard
    remove_menu_page( 'edit.php' );                          // Posts
    remove_menu_page( 'upload.php' );                        // Media
    remove_menu_page( 'edit.php?post_type=page' );           // Pages
    remove_menu_page( 'themes.php' );                        // Appearance
    remove_menu_page( 'plugins.php' );                       // Plugins
    remove_menu_page( 'users.php' );                         // Users
    remove_menu_page( 'tools.php' );                         // Tools
    remove_menu_page( 'options-general.php' );               // Settings 
    remove_menu_page( 'edit.php?post_type=essential_grid' ); // Example of Custom Post Type        
}
add_action( 'admin_menu', 'abm_remove_menus', 99999 );

/**
 * Admin Menu Bar Modification
 * Remove the following admin menu items
 * Option 2
 *
 * Example Remove: admin.php?page=revslider
 */
function abm_admin_remove_menu_pages() {    
	remove_menu_page( 'themepunch-google-fonts' );
	remove_menu_page( 'ajax-test-plugin' );
	remove_menu_page( 'revslider' );
}
add_action( 'admin_init', 'abm_admin_remove_menu_pages' );
?>
```

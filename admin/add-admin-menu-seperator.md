### How To Add Admin Menu Seperator

Use the following code to add additional admin menu seperators

***

```php
/**
 * Admin Menu Bar Modification
 * Add 2 additional Admin Menu seperators
 */

function abm_add_admin_menu_separator( $position ) {
    global $menu;
    
    $menu[ $position ] = array(
        0	=>	'',
        1	=>	'read',
        2	=>	'separator' . $position,
        3	=>	'',
        4	=>	'wp-menu-separator'
    );        
}
add_action( 'admin_init', 'abm_add_admin_menu_separator' ); 


function abm_set_admin_menu_separator() {
	// Add seperator after Pages and before Comments
    do_action( 'admin_init', 24 ); 
}
add_action( 'admin_menu', 'abm_set_admin_menu_separator' ); 
```
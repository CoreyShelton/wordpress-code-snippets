# Display All Node ID's of the Current Page in the Toolbar

>This example will add all node ID's on the current page to a top-level Toolbar item called "Node ID's". This is for developers who want to find out what the node ID is for a specific node.

> ~ <cite>[Wordpress Codex]</cite>

*Insert the following code snippets in your themes function.php file.*

######Please Note: that I've modified the code so that the nodes will only be displayed to logged in admin users.

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
* Display All Node ID's of the Current Page in the Toolbar
*
* Use 'wp_before_admin_bar_render' hook to also get nodes produced by plugins
* 
* @return  All Node ID's of the Current Page in the Toolbar
* @link https://codex.wordpress.org/Function_Reference/get_nodes
*/
function add_all_node_ids_to_toolbar() {

	global $wp_admin_bar;
	
    $all_toolbar_nodes = $wp_admin_bar->get_nodes();
    
    $userRole = cs_get_user_role();
    
    if ( $userRole == 'administrator') :
        if ( $all_toolbar_nodes ) :
    
            // add a top-level Toolbar item called "Node Id's" to the Toolbar
            $args = array(
                'id'    => 'node_ids',
                'title' => 'Node ID\'s'
            );
        
            $wp_admin_bar->add_node( $args );
    
            // add all current parent node id's to the top-level node.
            foreach ( $all_toolbar_nodes as $node  ) {
                if ( isset($node->parent) && $node->parent ) {
    
                    $args = array(
                        'id'     => 'node_id_'.$node->id, // prefix id with "node_id_" to make it a unique id
                        'title'  => $node->id,
                        'parent' => 'node_ids'
                        // 'href' => $node->href,
                    );
                    // add parent node to node "node_ids"
                    $wp_admin_bar->add_node($args);
                }
            }
    
            // add all current Toolbar items to their parent node or to the top-level node
            foreach ( $all_toolbar_nodes as $node ) {
    
                $args = array(
                    'id'      => 'node_id_'.$node->id, // prefix id with "node_id_" to make it a unique id
                    'title'   => $node->id,
                    // 'href' => $node->href,
                );
    
                if ( isset($node->parent) && $node->parent ) {
                    $args['parent'] = 'node_id_'.$node->parent;
                } else {
                    $args['parent'] = 'node_ids';
                }
    
                $wp_admin_bar->add_node($args);
            }
        
        endif;
    endif;
}
add_action( 'wp_before_admin_bar_render', 'add_all_node_ids_to_toolbar' );
```
[Wordpress Codex]: https://codex.wordpress.org/Function_Reference/get_nodes

# Remove The Admin Tool Bar On The Front-End

The following code snippet removes the Admin bar on the front-end of the website. 
Even if a specific user has the *Show Toolbar when viewing site* checked, the Admin toolbar will still not show up.

*Insert the following code snippet in your themes function.php file.*

***

```php
/**
* Remove Admin Bar On The Front End
*
* @author Corey Shelton
* @link https://codex.wordpress.org/Function_Reference/show_admin_bar
*/
show_admin_bar( false );
```

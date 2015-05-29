# Most Basic Wordpress Loop

The following is the most basic Wordpress loop you can find... but you have to start somewhere.

***

```php
<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		
		// Post Content here
		
	} //end while
} //end if
?>
```

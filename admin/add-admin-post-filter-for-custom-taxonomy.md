```php
/**
 * Display a custom taxonomy dropdown in admin for Mortgage Bankers
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 * @link http://www.sitepoint.com/customized-wordpress-administration-filters/
 */
add_action('restrict_manage_posts', 'custom_taxonomy_filter_post_type_by_taxonomy');
function custom_taxonomy_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'YOUR_CUSTOM_POST_TYPE'; // change to your post type
	$taxonomy  = 'YOUR_CUSTOM_TAXONOMY'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}

/**
 * Filter Client Reviews by 'mortgage_bankers' taxonomy in admin
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 * @link http://www.sitepoint.com/customized-wordpress-administration-filters/
 */
add_filter('parse_query', 'custom_taxonomy_id_to_term_in_query');
function custom_taxonomy_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'YOUR_CUSTOM_POST_TYPE'; // change to your post type
	$taxonomy  = 'YOUR_CUSTOM_TAXONOMY'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
```

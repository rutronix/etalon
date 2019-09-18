<?php

add_filter('manage_posts_columns','posts_columns',5);
add_filter('manage_posts_custom_column','posts_custom_columns',5,2);

function posts_columns($columns) {
	$columns = array (
		'cb' => $columns['cb'],
		'post_thumb' => __('Миниатюра'),
		'title' => __('Title'),
		'date' => __('Date'),
	);
	return $columns;
}

function posts_custom_columns($column_name, $id) {

	if ($column_name === 'post_thumb') {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( array(50,50) );
		} else echo 'No Image';
	}
}

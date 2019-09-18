<?php 

add_action('init', 'register_projects_post_type_and_taxonomy');

//Creating Custom Post types for Projects
function register_projects_post_type_and_taxonomy() {

	$labels = array(
		'name' => _x('Категории проектов', 'taxonomy general name'),
		'singular_name' => _x('Категория проектов', 'taxonomy singular name'),
		'add_new_item' => __('Добавить категорию'),
		'edit_item' => __('Изменить категорию'),
		'new_item' => __('Новая категория'),
		'view_item' => __('Посмотреть категорию'),
		'parent_item' => null,
		'parent_item_colon' => null,
		'all_items' => __('Все категории'),
		'update_item' => __('Обновить'),
		'search_items' => __('Поиск категории'),
		'not_found' => __('Категории не найдены'),
		'not_found_in_trash' => __('Не найдено в корзине')
		);
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'label' => 'Категории проектов',  //Label Displayed in the Admin when creating a new project
		'public' => true,
		//'query_var' => false,
		'rewrite' => array(
			'hierarchical' => true,
			'slug' => 'projects', // This controls the base slug that will display before each term
			//'with_front' => false // Don't display the category prefix before 
		),
		'show_admin_column' => true
	);
	//projects_cat - the name of the taxonomy. Name should be in slug form (no spaces and all lowercase)
	//projects - post type name
	register_taxonomy( 'project_cat', 'projects', $args );


	$labels = array(
		'name' => _x('Проекты', 'post type general name'),
		'singular_name' => _x('Проект', 'post type singular name'),
		'add_new' => _x('Добавить проект', 'Project'),
		'add_new_item' => __('Добавить проект'),
		'edit_item' => __('Изменить проект'),
		'new_item' => __('Новый проект'),
		'all_items' => __('Все проекты'),
		'view_item' => __('Посмотреть проект'),
		'update_item' => __('Посмотреть проект'),
		'search_items' => __('Поиск проектов'),
		'not_found' => __('Проекты не найдены'),
		'not_found_in_trash' => __('Не найдено в корзине'),
		'parent_item_colon' => '',
		'menu_name' => 'Проекты'
		);
	$args = array(
		'labels' => $labels,
		'description' => 'Проекты',
		'show_ui' => true,
		'public' => true,
		'menu_position' => 5,
		'supports' => array('title', 'thumbnail', 'excerpt', 'custom-fields'),
		'rewrite' => array(
			'slug' => 'projects/%project_cat%',
			'with_front' => false
		),
		'query_var' => true,
		'has_archive' => true,
		'taxonomies' => array('project_cat'),
		'menu_icon' => 'dashicons-admin-multisite', //Find the appropriate dashicon here: https://developer.wordpress.org/resource/dashicons/
		);
	register_post_type('projects', $args);
}

add_filter('post_type_archive_link', 'projects_permalink', 10, 2);
add_filter('post_type_link', 'projects_hierarchical_permalink', 1, 2);

function projects_permalink( $permalink, $post_type ){
	// выходим если это не наш тип записи: без холдера %products%
	if( strpos($permalink, '%project_cat%') === FALSE )
		return $permalink;

	// Получаем элементы таксы
	$terms = get_the_terms(get_post(), 'project_cat');
	// если есть элемент заменим холдер
	if( ! is_wp_error($terms) && !empty($terms) && is_object($terms[0]) ) {
		$term_slug = array_pop($terms)->slug;
	}
	else
		$term_slug = '';

	return preg_replace( '#/$#', '', str_replace('%project_cat%', $term_slug, $permalink ) );
}


function projects_hierarchical_permalink( $permalink, $post ){
	if( strpos($permalink, '%project_cat%') === FALSE )
		return $permalink;

	// Получаем элементы таксы
	$terms = get_the_terms($post, 'project_cat');
	$parent = $terms[0]->parent;

	// если есть элемент заменим холдер
	if( ! is_wp_error($terms) && !empty($terms) && is_object($terms[0]) ) {
		$term_slug = array_pop($terms)->slug;
		while( $parent ) {
			$parent_term = get_term($parent, 'project_cat');
			$term_slug = $parent_term->slug . '/' . $term_slug;
			$parent = $parent_term->parent;
		}
	}	
	else 
		$term_slug = '';
		// В $permalink находим %project_cat% и заменяем на $term_slug
	// убираем лишний слэш, если $term_slug будет пустой
	return preg_replace( '#/$#', '', str_replace('%project_cat%', $term_slug, $permalink ) );
}


// смена запроса
add_filter('request', 'action_function_name',1,1 );
function action_function_name( $query ) {
	$cat = 'project_cat';
	if( isset($query[$cat]) ) { //здесь и далее название таксономии
		$str = strrchr($query[$cat],'/');
		$name = str_replace('/','',$str); //удалим слэшы
		$term = get_term_by( 'slug', $name , $cat);
		if( !$term && $name ) {
			$query[$cat] = str_replace($str,'',$query[$cat]);
			$query['post_type'] = 'projects'; //название пользовательского типа записей
			$query['projects'] = $name; //$query['название пользовательского типа записей']
			$query['name'] = $name;
		}
    }

    return $query;
}


// Delete a sidebar in custom projects posts
add_filter( 'starck_sidebar_layout', 'remove_projects_sidebar' );
function remove_projects_sidebar($layout) {
	$layout = 'no-sidebar';
	return $layout;
}
// Отдаем приоритет старанице, если ее адрес совпадает с категорией поста
add_filter('page_rewrite_rules', 'wpse16902_collect_page_rewrite_rules');
function wpse16902_collect_page_rewrite_rules($page_rewrite_rules)
{
	$GLOBALS['wpse16902_page_rewrite_rules'] = $page_rewrite_rules;
	return array();
}

add_filter('rewrite_rules_array', 'wspe16902_prepend_page_rewrite_rules');
function wspe16902_prepend_page_rewrite_rules($rewrite_rules)
{
	return $GLOBALS['wpse16902_page_rewrite_rules'] + $rewrite_rules;
}

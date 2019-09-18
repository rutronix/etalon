<?php
/**
 * HTML markup.
 *
 * @package Starcktheme
 * @since 1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**

 */
function starck_merge_classes( $classes = [], $merged_class = '' ) {

	if ( ! empty( $merged_class ) ) {
		if ( ! is_array( $merged_class ) ) {
			$merged_class = preg_split( '#\s+#', $merged_class );
		}
		// Соединяем классы, если есть второй параметр
		$classes = array_merge( $merged_class, $classes );
	}
	// Apply esc_attr() function to array $classes
	$classes = array_map( 'esc_attr', $classes );

	if ($classes) { echo 'class="' . join( ' ', $classes ) . '"'; };

}


if ( ! function_exists( 'starck_post_classes' ) ) {

	add_filter( 'post_class', 'starck_post_classes' );
	/**
	 * Adds custom classes to the <article> element.
	 * Remove .hentry class from pages to comply with structural data guidelines.
	 */
	function starck_post_classes( $classes ) {

		if ( 'page' == get_post_type() ) {
			$classes = array_diff( $classes, array( 'hentry' ) );
		}

		return $classes;
	}
}


if ( ! function_exists( 'starck_body_classes' ) ) {
	add_filter( 'body_class', 'starck_body_classes' );
	/**
	 * Adds custom classes to the array of body classes.
	 */
	function starck_body_classes( $classes ) {
		global $template;
		$template = basename($template, '.php');
		$template = array_pop(explode('-',$template));
        $classes[] = $template;
		$classes[] = starck_get_layout();
		
		if ( starck_get_option( 'nav_search' ) ) { //вывод кнопки 'поиск' в верхнее меню
			$classes[] = 'nav-search-enabled';
		}

		$footer_widgets = starck_get_option( 'footer_widget_setting' );
		$classes[] = 'active-footer-widgets-' . ( ( '' !== $footer_widgets ) ? absint( $footer_widgets ) : '1');

		return $classes;
	}
}


if ( ! function_exists( 'starck_header_classes' ) ) {
	add_filter( 'starck_add_header_class', 'starck_header_classes' );
	/**
	 * Adds custom classes to the header.
	 */
	function starck_header_classes( $merged_class ) {
		//$classes[] = 'site-header';
		$nav_position =  starck_get_option( 'nav_position_setting' );
		$classes[] = starck_get_option( 'header_bound_setting' );

		$classes[] = 'branding-' . starck_get_option( 'branding_alignment' );
		$classes[] = 'nav-' . $nav_position . (('under' == $nav_position) ? '-header' : '-logo');
		
		return starck_merge_classes($classes, $merged_class);
	}
}


if ( ! function_exists( 'starck_branding_classes' ) ) {
	add_filter( 'starck_add_branding_class', 'starck_branding_classes' );
	/**
	 * Adds custom classes to the branding.	 
	 */
	function starck_branding_classes( $merged_class ) {

		$classes[] = (starck_get_option( 'branding_vertical' ) ? 'align-vertical' : '');
		$classes[] = 'align-' . starck_get_option( 'branding_alignment' );

		return starck_merge_classes($classes, $merged_class);
	}
}


if ( ! function_exists( 'starck_navigation_classes' ) ) {
	add_filter( 'starck_add_navigation_class', 'starck_navigation_classes' );
	/**
	 * Adds custom classes to the navigation. 
	 */
	function starck_navigation_classes( $merged_class ) {

		if ( 'none' !== $nav_position ) {
	
			$nav_position = starck_get_option( 'nav_position_setting' );
			$branding_alignment = starck_get_option( 'branding_alignment' );

			if ( 'inline' !== $nav_position )
				$classes[] = esc_attr( starck_get_option( 'nav_bound_setting' ) ); 

			if ( 'inline' == $nav_position && in_array( $branding_alignment, ['left','right'] ) ) {
				$classes[] = 'float-' . ( ( 'left' === $branding_alignment ) ? 'right' : 'left' );
			}

			$classes[] = $nav_position . (('under' == $nav_position) ? '-header' : '-logo');
			$classes[] = 'align-' . esc_attr( starck_get_option( 'nav_alignment' ) );
		}
		return starck_merge_classes($classes, $merged_class);
	}
}


if ( ! function_exists( 'starck_main_classes' ) ) {
	add_filter( 'starck_add_main_class', 'starck_main_classes' );
	/**
	 * Adds custom classes to the main.
	 */
	function starck_main_classes( $merged_class ) {

		$nav_position = starck_get_option( 'nav_position_setting' );

		$classes[] = starck_get_option( 'main_bound_setting' ); //'bounded', 'wide-full'
		//$classes[] = starck_get_option( 'header_layout_setting' );

		$classes[] = 'nav-' . $nav_position . (('under' == $nav_position) ? '-header' : '-logo');

		// Get the sidebar layout
		$classes[] = starck_get_layout();

		return starck_merge_classes($classes, $merged_class);
	}
}


if ( ! function_exists( 'starck_content_classes' ) ) {
	add_filter( 'starck_add_content_class', 'starck_content_classes' );
	/**
	 * Adds custom classes to the content container.
	 */
	function starck_content_classes( $merged_class ) {
		$classes[] = 'main-content';

		if (is_active_sidebar( 'sidebar' )) {

			$sidebar_layout = starck_get_layout();
			if ('left-sidebar' == $sidebar_layout) {
				$classes[] = 'float-right';
			} else 
			if ('right-sidebar' == $sidebar_layout) {
				$classes[] = 'float-left';
			}
		}

		return starck_merge_classes($classes, $merged_class);
	}
}


if ( ! function_exists( 'starck_sidebar_classes' ) ) {
	add_filter( 'starck_add_sidebar_class', 'starck_sidebar_classes' );
	/**
	 * Adds custom classes to the sidebar.
	 */
	function starck_sidebar_classes( $merged_class ) {
		
		$classes[] = 'main-sidebar';

		return starck_merge_classes($classes, $merged_class);
	}
}


if ( ! function_exists( 'starck_footer_classes' ) ) {
	add_filter( 'starck_add_footer_class', 'starck_footer_classes' );
	/**
	 * Adds custom classes to the footer.
	 */
	function starck_footer_classes( $merged_class ) {
		//$classes[] = 'site-footer';

		$classes[] = starck_get_option( 'footer_bound_setting' );
		//$classes[] = starck_get_option( 'footer_layout_setting' );

		if ( '1' === starck_get_option( 'footer_widget_setting' ) ) {
			$classes[] = 'align-' . esc_attr( starck_get_option( 'footer_alignment' ) );
		}

		return starck_merge_classes($classes, $merged_class);
	}
}
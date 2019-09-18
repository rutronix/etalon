<?php
/**
 * Sets all of our theme defaults.
 *
 * @package Starcktheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'starck_get_defaults' ) ) {
	/**
	 * Set default options
	 *
	 */
	function starck_get_defaults() {
		return apply_filters( 'starck_option_defaults',
			array(
				'header_bound_setting' => 'full-width', //'bounded'
				'top_bar_layout_setting' => false, //true
				//'logo_width' => '',
				'branding_alignment' => 'left', //'left','center','right'
				'branding_vertical' => false,
				'header_widget_setting' => 'enabled', //'disabled'
				'nav_bound_setting' =>  'full-width', //'bounded'
				'nav_position_setting' => 'under', //'inline', 'above', 'below', under, none'
				'nav_alignment' => 'center', //'left', 'right'
				'nav_search_setting' => true, //false
				//'menu_appearence_action' => 'click', //'hover'
				//'menu_appearence_direction' => 'left', //'down'
				'nav_burger' => false, //true, false
				'main_bound_setting' => 'bounded', //full-width'
				'content_header_setting' => 'front-page', //'all-pages', 'disabled'
				'content_header_background' => '',
				'breadcrumbs_setting' => true, //false
				'layout_setting' => 'right-sidebar',
				'blog_layout_setting' => 'right-sidebar',
				'single_layout_setting' => 'right-sidebar',
				'footer_bound_setting' => 'full-width', //'bounded'
				'footer_widget_setting' => '1',
				'footer_alignment' => 'center', //'left', 'right'
				'back_to_top' => true, //false

			)
		);
	}
}

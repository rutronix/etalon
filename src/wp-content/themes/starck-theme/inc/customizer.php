<?php
/**
 * Builds our Customizer controls.
 *
 * @package Starcktheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'starck_sanitize_choices' ) ) {
	/**
	 * Sanitize choices.
	 */
	function starck_sanitize_choices( $input, $setting ) {
		// Ensure input is a slug
		$input = sanitize_key( $input );

		// Get list of choices from the control
		// associated with the setting
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it;
		// otherwise, return the default
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}

if ( ! function_exists( 'starck_sanitize_checkbox' ) ) {
	/**
	 * Sanitize checkbox values.
	 */
	function starck_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
}


if ( ! function_exists( 'starck_customize_register' ) ) {
	add_action( 'customize_register', 'starck_customize_register' );
	/**
	 * Add our base options to the Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function starck_customize_register( $wp_customize ) {
		$defaults = starck_get_defaults();


/*
 * Examples
 *
				'transport'   => 'postMessage' // 'postMessage' - асинхронным запросом с применением JavaScript, 'refresh' - перезагрузкой фрейма без использования JS
 				'section'    => 'colors', // Стандартная секция - Цвета
				'type'      => 'theme_mod', // использовать get_theme_mod() для получения настроек
				'type'      => 'option', // нужно будет использовать функцию get_option() для получения настроек
				'type'     => 'text' // текстовое поле
				'type'     => 'select', // выпадающий список select
				'type'      => 'checkbox' // тип - чекбокс
				'type'     => 'radio', // радио-кнопки
				'choices'  => array( // все значения радио-кнопок
				'normal'    => 'Светлая', // перечисляем в виде массива
				'inverse'   => 'Темная'
				'sanitize_callback'  => 'true_sanitize_copyright', // функция, обрабатывающая значение поля при сохранении
				
			Default Controls:
				WP_Customize_Image_Control
				WP_Customize_Color_Control
				WP_Customize_Media_Control
				WP_Customize_Nav_Menu_Control
				
			)
 *
 */
// Adding a new custom panel in the Theme settings
		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'starck_layout_panel' ) ) {
				$wp_customize->add_panel( 'starck_layout_panel', array(
					'priority' => 25,
					'title' => __( 'Layout', 'starck' ), //Настройки - Макет
				) );
			}
		}

//Header
		$wp_customize->add_section(
			'starck_layout_header',
			array(
				'title' => __( 'Header', 'starck' ),
				'priority' => 20,
				'panel' => 'starck_layout_panel',
			)
		);

		$wp_customize->add_setting(
			'starck_settings[header_bound_setting]',
			array(
				'default' => $defaults['header_bound_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[header_bound_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header container', 'starck' ),
				'section' => 'starck_layout_header',
				'choices' => array(
					'full-width' => __( 'Full-width', 'starck' ),
					'bounded' => __( 'Bounded', 'starck' ),
				),
				'settings' => 'starck_settings[header_bound_setting]',
				'priority' => 5,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[header_widget_setting]',
			array(
				'default' => $defaults['header_widget_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[header_widget_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header widget', 'starck' ),
				'section' => 'starck_layout_header',
				'choices' => array(
					'enabled' => __( 'Enabled', 'starck' ),
					'disabled' => __( 'Disabled', 'starck' ),
				),
				'settings' => 'starck_settings[header_widget_setting]',
				'priority' => 10,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[top_bar_layout_setting]',
			array(
				'default' => $defaults['top_bar_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[top_bar_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar appearence', 'starck' ),
				'section' => 'starck_layout_header',
				'choices' => array(
					true => __( 'Enabled', 'starck' ),
					false => __( 'Disabled', 'starck' ),
				),
				'settings' => 'starck_settings[top_bar_layout_setting]',
				'priority' => 15,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[branding_alignment]',
			array(
				'default' => $defaults['branding_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[branding_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Branding alignment', 'starck' ),
				'section' => 'starck_layout_header',
				'choices' => array(
					'left' => __( 'Left', 'starck' ),
					'center' => __( 'Center', 'starck' ),
					'right' => __( 'Right', 'starck' ),
				),
				'settings' => 'starck_settings[branding_alignment]',
				'priority' => 20,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[branding_vertical]',
			array(
				'default' => $defaults['branding_vertical'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[branding_vertical]',
			array(
				'type' => 'select',
				'label' => __( 'Branding position', 'starck' ),
				'section' => 'starck_layout_header',
				'choices' => array(
					false => __( 'Horizontal', 'starck' ),
					true => __( 'Vertical', 'starck' ),
				),
				'settings' => 'starck_settings[branding_vertical]',
				'priority' => 30,
			)
		);


//Navigation
		$wp_customize->add_section(
			'starck_layout_navigation',
			array(
				'title' => __( 'Navigation', 'starck' ),
				'priority' => 30,
				'panel' => 'starck_layout_panel',
			)
		);

		$wp_customize->add_setting(
			'starck_settings[nav_bound_setting]',
			array(
				'default' => $defaults['nav_bound_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[nav_bound_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation container', 'starck' ),
				'section' => 'starck_layout_navigation',
				'choices' => array(
					'full-width' => __( 'Full-width', 'starck' ),
					'bounded' => __( 'Bounded', 'starck' ),
				),
				'settings' => 'starck_settings[nav_bound_setting]',
				'priority' => 5,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[nav_position_setting]',
			array(
				'default' => $defaults['nav_position_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[nav_position_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Primary menu location', 'starck' ),
				'section' => 'starck_layout_navigation',
				'choices' => array(
					'inline' => __( 'Inline Logo', 'starck' ),
					'above' => __( 'Above Logo', 'starck' ),
					'below' => __( 'Below Logo', 'starck' ),
					'under' => __( 'Under Header', 'starck' ),
					'none' => __( 'Disabled', 'starck' ),
				),
				'settings' => 'starck_settings[nav_position_setting]',
				'priority' => 10,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[nav_alignment]',
			array(
				'default' => $defaults['nav_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[nav_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation alignment', 'starck' ),
				'section' => 'starck_layout_navigation',
				'choices' => array(
					'left' => __( 'Left', 'starck' ),
					'center' => __( 'Center', 'starck' ),
					'right' => __( 'Right', 'starck' ),
				),
				'settings' => 'starck_settings[nav_alignment]',
				'priority' => 20,
			)
		);


		$wp_customize->add_setting(
			'starck_settings[nav_search_setting]',
			array(
				'default' => $defaults['nav_search_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'starck_settings[nav_search_setting]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Search icon in navigation', 'starck' ),
				'section' => 'starck_layout_navigation',
				'settings' => 'starck_settings[nav_search_setting]',
				'priority' => 30,
			)
		);


		$wp_customize->add_setting(
			'starck_settings[nav_burger]',
			array(
				'default' => $defaults['nav_burger'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'starck_settings[nav_burger]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Burger menu on desktop', 'starck' ),
				'section' => 'starck_layout_navigation',
				'settings' => 'starck_settings[nav_burger]',
				'priority' => 40,
			)
		);
				

// Main content
		$wp_customize->add_section(
			'starck_layout_content',
			array(
				'title' =>  __( 'Content', 'starck' ),
				'priority' => 40,
				'panel' => 'starck_layout_panel',
			)
		);

		$wp_customize->add_setting(
			'starck_settings[content_header_setting]',
			array(
				'default' => $defaults['content_header_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[content_header_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Content header appearence', 'starck' ),
				'section' => 'starck_layout_content',
				'choices' => array(
					'front-page' => __( 'Only front page', 'starck' ),
					'all-pages' => __( 'All pages', 'starck' ),
					'disabled' => __( 'Disabled', 'starck' ),
				),
				'settings' => 'starck_settings[content_header_setting]',
				'priority' => 5,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[content_header_background]',
			array(
				'default' => $defaults['content_header_background'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'starck_settings[content_header_background]',
				array(
					'label' => __( 'Header background image', 'starck' ),
					'section' => 'starck_layout_content',
					'settings' => 'starck_settings[content_header_background]',
					'priority' => 7,
				)
			)
		);

		$wp_customize->add_setting(
			'starck_settings[main_bound_setting]',
			array(
				'default' => $defaults['main_bound_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[main_bound_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Main container', 'starck' ),
				'section' => 'starck_layout_content',
				'choices' => array(
					'full-width' => __( 'Full width', 'starck' ),
					'bounded' => __( 'Bounded', 'starck' ),
				),
				'settings' => 'starck_settings[main_bound_setting]',
				'priority' => 10,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[breadcrumbs_setting]',
			array(
				'default' => $defaults['breadcrumbs_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[breadcrumbs_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Breadcrumbs', 'starck' ),
				'section' => 'starck_layout_content',
				'choices' => array(
					true => __( 'Enabled', 'starck' ),
					false => __( 'Disabled', 'starck' ),
				),
				'settings' => 'starck_settings[breadcrumbs_setting]',
				'priority' => 20,
			)
		);


// Sidebar
		$wp_customize->add_section(
			'starck_layout_sidebars',
			array(
				'title' => __( 'Sidebars', 'starck' ),
				'priority' => 50,
				'panel' => 'starck_layout_panel',
			)
		);

		$wp_customize->add_setting(
			'starck_settings[layout_setting]',
			array(
				'default' => $defaults['layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Page Sidebar Layout', 'starck' ),
				'section' => 'starck_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar | Content', 'starck' ),
					'right-sidebar' => __( 'Content | Sidebar', 'starck' ),
					'no-sidebar' => __( 'Only content', 'starck' ),
				),
				'settings' => 'starck_settings[layout_setting]',
				'priority' => 10,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[blog_layout_setting]',
			array(
				'default' => $defaults['blog_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[blog_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Blog Sidebar Layout', 'starck' ),
				'section' => 'starck_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar | Content', 'starck' ),
					'right-sidebar' => __( 'Content | Sidebar', 'starck' ),
					'no-sidebar' => __( 'Only content', 'starck' ),
				),
				'settings' => 'starck_settings[blog_layout_setting]',
				'priority' => 20,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[single_layout_setting]',
			array(
				'default' => $defaults['single_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[single_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Single Post Sidebar Layout', 'starck' ),
				'section' => 'starck_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar | Content', 'starck' ),
					'right-sidebar' => __( 'Content | Sidebar', 'starck' ),
					'no-sidebar' => __( 'Only content', 'starck' ),
				),
				'settings' => 'starck_settings[single_layout_setting]',
				'priority' => 30,
			)
		);
		
// Footer
		$wp_customize->add_section(
			'starck_layout_footer',
			array(
				'title' => __( 'Footer', 'starck' ),
				'priority' => 60,
				'panel' => 'starck_layout_panel',
			)
		);
		
		$wp_customize->add_setting(
			'starck_settings[footer_bound_setting]',
			array(
				'default' => $defaults['footer_bound_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[footer_bound_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer container', 'starck' ),
				'section' => 'starck_layout_footer',
				'choices' => array(
					'full-width' => __( 'Full-width', 'starck' ),
					'bounded' => __( 'Bounded', 'starck' ),
				),
				'settings' => 'starck_settings[footer_bound_setting]',
				'priority' => 5,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[footer_widget_setting]',
			array(
				'default' => $defaults['footer_widget_setting'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
			)
		);

		$wp_customize->add_control(
			'starck_settings[footer_widget_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Widgets', 'starck' ),
				'section' => 'starck_layout_footer',
				'choices' => array(
					'0' =>  __( 'Disable', 'starck' ),
					'1' => '1',
					'2' => '2',
					'3' => '3',

				),
				'settings' => 'starck_settings[footer_widget_setting]',
				'priority' => 10,
			)
		);

		$wp_customize->add_setting(
			'starck_settings[footer_alignment]',
			array(
				'default' => $defaults['footer_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_choices',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'starck_settings[footer_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Footer alignment', 'starck' ),
				'section' => 'starck_layout_footer',
				'choices' => array(
					'left' => __( 'Left','starck' ),
					'center' => __( 'Center','starck' ),
					'right' => __( 'Right','starck' ),
				),
				'settings' => 'starck_settings[footer_alignment]',
				'priority' => 20,
				//'active_callback' => 'starck_is_footer_bar_active',
			)
		);

		$wp_customize->add_setting(
			'starck_settings[back_to_top]',
			array(
				'default' => $defaults['back_to_top'],
				'type' => 'option',
				'sanitize_callback' => 'starck_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'starck_settings[back_to_top]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Back to Top Button', 'starck' ),
				'section' => 'starck_layout_footer',
				'settings' => 'starck_settings[back_to_top]',
				'priority' => 50,
			)
		);

	}
}

if ( ! function_exists( 'starck_customizer_live_preview' ) ) {
	add_action( 'customize_preview_init', 'starck_customizer_live_preview', 100 );
	/**
	 * Add custom live preview scripts
	 */
	function starck_customizer_live_preview() {

		wp_enqueue_script( 'starck-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'inc/js/customizer-live-preview.js', array( 'customize-preview' ), STARCK_VERSION, true );

		wp_localize_script( 'starck-themecustomizer', 'starck_live_preview', array(
			'mobile' => apply_filters( 'starck_mobile_media_query', '(max-width:768px)' ),
			'tablet' => apply_filters( 'starck_tablet_media_query', '(min-width: 769px) and (max-width: 1024px)' ),
			'desktop' => apply_filters( 'starck_desktop_media_query', '(min-width:1025px)' ),
			'contentLeft' => 40,
			'contentRight' => 40,
		) );
	}
}
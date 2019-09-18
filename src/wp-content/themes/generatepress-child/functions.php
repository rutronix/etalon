<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

//echo get_home_url( null, 'wp-admin/', 'https' ); //Example.com: https://example.com/wp-admin/
$home_url = get_stylesheet_directory_uri(); // for a child theme URL //get_home_url();
$main_css_file = '/main.min.css';
if ( !file_exists( $home_url . '/css' . $main_css_file )) $main_css_file = '/main.css';


// STYLES registry
wp_enqueue_style( 'mytheme-styles', $home_url . '/css' . $main_css_file);
wp_enqueue_style( 'vendors-styles', $home_url . '/css/vendors.min.css');
// !!! Check for dublicates of the styles below in css/vendors.css via @import
//wp_enqueue_style( 'magnific-popup', $home_url . '/plugins/magnific-popup/dist/magnific-popup.css');
//wp_enqueue_style( 'font-awesome-styles', $home_url . '/plugins/awesome/css/font-awesome.min.css');

// SCRIPTS registry
add_action( 'mytheme_enqueue_scripts', 'mytheme_scripts_add' );
function mytheme_scripts_add() {
	wp_enqueue_script('my_custom_scripts', $home_url . '/js/custom.js');
	
}

// END ENQUEUE PARENT ACTION

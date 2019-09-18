<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php esc_attr( bloginfo( 'charset' ) ); ?>" />
	<meta name="description" content="Starter web template for Wordpress">
	<meta name="viewport" content="width=device-width" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" href="img/favicon.png">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- Preloader -->
	<div id="dom-preloader" class="preloader"><i class="fa fa-spinner fa-spin"></i></div>
	<?php

	$custom_header = get_custom_header();
	if ( ! empty( $custom_header->attachment_id ) ) {
		$header_img_attr = sprintf(' style="background-image: url(%s)"', $custom_header->url);
		$background_class = 'header-background';
	}

	?>
	<header id="site-header" <?php starck_header_class(['site-header',$background_class]); echo $header_img_attr; ?>>

		<?php if ( 'enabled' === starck_get_option( 'top_bar_layout_setting' ) ) starck_get_top_bar(); ?>

		<!-- header-container -->
		<div id="header-container" class="<?php echo 'container branding-' . starck_get_option( 'branding_alignment' ); ?>">
			<?php
			$nav_position = starck_get_option( 'nav_position_setting' );
			if ( in_array($nav_position, ['above', 'below']) ) {
				// navigation
				starck_get_navigation();
			}
			?>		
			<section id="branding" <?php starck_branding_class('site-branding'); ?>>
				<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				if ( $custom_logo_id ) {
				?>
				<!-- logo -->
	            <div id="branding-logo" class="site-logo">
					<?php the_custom_logo(); ?>
	            </div>
				<?php
				}
				?>
				<!-- header title -->
				<div id="branding-title">
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
					</h1>
					<div class="site-description"><?php bloginfo( 'description' ); ?></div>
				</div>
			</section>

			<section id="header-content"  <?php printf('class="align-%1$s %2$s"',
													( "right" === starck_get_option( 'branding_alignment' ) ? 'left' : 'right'),
													( starck_get_option( 'nav_burger' ) ?  'burger-menu' : '' )
												); ?>>
				<?php 
				if ( starck_get_option( 'header_widget_setting' ) )
					starck_get_header_widget();

				if ( 'inline' == $nav_position )
					starck_get_navigation();
				?>
			</section>
		</div>
		<!-- end header container -->
	</header>

	<?php 
	if ( 'under' == $nav_position ) { 
		starck_get_navigation();
	}
	?>

	<!-- main -->
	<main id="main" <?php starck_main_class('main'); ?> role="main">

		<?php starck_main_header(); ?>
		
		<!-- main container -->
		<div id="main-container" class="container">

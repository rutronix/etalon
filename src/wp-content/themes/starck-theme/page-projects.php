<?php 
/*

 * The template for Projects portfolio
 *
 * @package Starck-theme 

   Template Name: Projects Portfolio
   Template Post Type: page
 */

get_header();

global $post;

$header_class = get_post_meta( $post->ID, 'hide-title', true ) ? 'hidden' : '';
$content = $post->post_content;

?>

	<section id="content" <?php starck_content_class('projects'); ?>>

		<?php starck_breadcrumbs(); ?>
	
		<header class="projects-header">
			<h1 class="projects-title <?php echo $header_class ?>"><?php single_post_title(); ?></h1>
			<?php if ($content) { ?>
				<div class="projects-description"><p><?php echo $content; ?></p></div>
			<?php } ?>
		</header>

		<?php
			// Выводим категории для projects постов
			$args = array(
				'taxonomy' => 'project_cat',
				'title_li'     => '',
				'hierarchical' => 0,
				'orderby' => 'name',
				'show_count' => true,
				'echo' => 0
				//'show_option_all' => 'Все проекты',
			);
			$projects_cat = wp_list_categories($args);
			if ($projects_cat) {
				echo '<ul class="projects-categories">';
				echo $projects_cat;
				echo '</ul>';
			}
		?>

		<?php get_template_part( 'portfolio' ); ?>

	</section>


<?php get_footer(); ?>
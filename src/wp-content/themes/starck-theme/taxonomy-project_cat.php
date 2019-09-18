<?php 
/*

 * The Project taxonomy template to show portfolio
 *
 * @package Starck-theme 
 *
 */

get_header();

global $post;

?>

	<section id="content" <?php starck_content_class('projects-category'); ?>>

		<?php starck_breadcrumbs(); ?>
		
		<header class="projects-header">
		</header>

		<?php get_template_part( 'portfolio' ); ?>
		
	</section>


<?php get_footer(); ?>
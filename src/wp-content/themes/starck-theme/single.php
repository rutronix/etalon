<?php 
/*
 * The template for displaying all single posts
 *
 * @package Starck-theme
 */
get_header(); 

?>

<section id="content" <?php starck_content_class('single'); ?>>

	<?php starck_breadcrumbs(); ?>
	
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'entry' ); ?>

		<?php if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) { comments_template( '', true ); } ?>
	<?php endwhile;?>

	<?php get_template_part( 'nav', 'below-single' ); ?>

</section>

<?php starck_get_sidebar();

get_footer(); 
?>
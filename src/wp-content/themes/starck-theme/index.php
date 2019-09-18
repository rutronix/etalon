<?php get_header(); ?>

	<section id="content" <?php starck_content_class('index'); ?>>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
		<?php endwhile;?>

		<?php get_template_part( 'nav', 'below' );
		
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>

	</section>

	<?php starck_get_sidebar(); ?>

<?php get_footer(); ?>
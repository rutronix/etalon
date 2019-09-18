<?php get_header(); ?>

	<section id="content" <?php starck_content_class('blog'); ?>>
	
		<?php starck_breadcrumbs(); ?>
		
		<header class="blog-header">
			<h1 class="blog-header-title <?php echo $header_class ?>"><?php single_term_title(); ?></h1>
			<div class="blog-header-meta"><?php if ( '' != the_archive_description() ) { echo esc_html( the_archive_description() ); } ?></div>
		</header>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
		<?php endwhile; endif; ?>

		<?php get_template_part( 'nav', 'below' ); ?>

	</section>

	<?php starck_get_sidebar(); ?>

<?php get_footer(); ?>
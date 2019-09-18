<?php 

/*
 * The template for displaying search results
 *
 * @author: S.Shabalin
 */

get_header();

?>

	<section id="content" class="search" role="main">

		<?php if ( have_posts() ) : ?>

			<section class="post search-result found">

				<header class="search-header">
					<h1 class="search-title"><?php printf( esc_html__( 'Search Results for: %s', 'starck' ), get_search_query() ); ?></h1>
				</header>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'entry' ); ?>
				<?php endwhile; ?>

				<?php get_template_part( 'nav', 'below' ); ?>

			</section>

		<?php else : ?>

			<section class="post-0 no-result not-found">

				<header class="search-header">
					<h1 class="search-title"><?php esc_html_e( 'Nothing Found', 'starck' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'starck' ); ?></p>
					<?php get_search_form(); ?>
				</div>

			</section>

		<?php endif; ?>

		<div class="goto-back">
			<a href = "#" <?php echo 'onclick="javascript:history.back(); return false;"'?>><i class="fa fa-angle-left"></i><?php esc_html_e( 'Go back', 'starck' ); ?></a>
		</div>

	</section>

	<?php starck_get_sidebar(); ?>

<?php get_footer(); ?>
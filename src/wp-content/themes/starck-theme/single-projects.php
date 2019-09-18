<?php
/*
 * The single template for project
 *
 * @package Starck-theme 

 */
get_header();

global $post;

	?>

	<section id="content" <?php starck_content_class('project'); ?>>

		<?php starck_breadcrumbs(); ?>

		<?php while ( have_posts() ) : the_post();
		$gallery = get_post_meta( $post->ID, 'gallery-image' );
		if ($gallery) {
			the_content();
			?>
			<div class="container">
				<div id="gallery" class="gallery grid">
					<?php 
					foreach ($gallery as $post_id) {
						$post_id = absint($post_id);
						$image = wp_get_attachment_metadata( $post_id );
						$thumb = $image['sizes']['medium']['file'];
						$image_ratio = $image['height']/$image['width']*100;
						$full_image = wp_get_attachment_url($post_id, 'full');
						$title =  get_the_title( $post_id );
						$caption = wp_get_attachment_caption( $post_id );
						?>
						<a id="gallery-image" class="gallery-image" href="<?php echo $full_image ?>">
							<div class="gallery-image-container" style="padding-top: <?php echo $image_ratio.'%' ?>">
								<img class="image lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo $thumb; ?>" data-srcset="<?php echo wp_get_attachment_image_srcset( $post_id, 'medium' ); ?>" alt="Gallery"/>
							</div>
							<div class="gallery-image-details">
								<div><h3><?php echo $title; ?></h3></div>
								<div><?php echo $caption; ?></div>
							</div>
						</a>
						<div class="gallery-caption"><?php echo $caption; ?></div>
						<?php 
						}
					?>				
				</div>
			</div>
			<?php
		} else {
			get_template_part( 'entry', 'content' );
		}
		?>

		<?php endwhile;?>

		<?php get_template_part( 'nav', 'below-single' ); ?>
		<?php if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) { comments_template( '', true ); } ?>

	</section>

<?php get_footer(); ?>
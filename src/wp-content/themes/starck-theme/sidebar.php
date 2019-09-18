<?php if ( ! is_active_sidebar( 'sidebar' ) ) { return; } ?>

<aside id="main-sidebar" <?php starck_sidebar_class(); ?>>

	<div id="primary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</div>

</aside>

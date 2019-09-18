<?php $args = array(
	'prev_text' => sprintf( esc_html__( '%s older', 'starck' ), '<span class="meta-nav"><i class="fa icon arrow-left"></i></span>' ),
	'next_text' => sprintf( esc_html__( 'newer %s', 'starck' ), '<span class="meta-nav"><i class="fa icon arrow-left"></i></span>' )
); ?>
<nav id="posts-nav">
	<?php the_posts_navigation( $args ); ?>
</nav>
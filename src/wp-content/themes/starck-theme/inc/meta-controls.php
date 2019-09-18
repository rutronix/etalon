<?php
/*
Plugin Name: Page Layout Controls
Description: Allows to hide the title of pages and posts and single project portfolio 
			 and build Gallery for posts, projects, pages.
Version: 1.0.3
Author: S.Shabalin
*/

if ( !class_exists( 'starck_meta_controls' ) ) {

	class starck_meta_controls {

		private $hide_title = 'hide-title';
		private $gallery_image = 'gallery-image';
		private $gallery_scroll = 'gallery-autoscroll';
		private $gallery_pagination = 'gallery-pagination';
		private $gallery_caption = 'gallery-caption';
		private $gallery_caption_link = 'gallery-caption-link';
		private $screen = array( 'post', 'page', 'projects' );

		/**
		* PHP 5 Constructor
		*/
		function __construct(){

			add_action( 'add_meta_boxes', array( $this, 'add_section' ) );
			add_action( 'save_post', array( $this, 'save_meta' ) );
			add_action( 'delete_post', array( $this, 'delete_meta' ) );

		} // __construct()



		function add_section(){

			add_meta_box( $this->hide_title, 'Title', array( $this, 'title_metabox_callback' ), $screen, 'side', 'default' );

			add_meta_box( $this->gallery_image, 'Gallery', array( $this, 'gallery_metabox_callback' ), $screen, 'advanced', 'default' );

		}


		function title_metabox_callback( $post ){

			$value = get_post_meta( $post->ID, $this->hide_title, true );

			$checked = '';

			if ( (bool)$value ) { $checked = ' checked="checked"'; }

			wp_nonce_field( $this->hide_title . '_dononce', $this->hide_title . '_noncename' );

			?>
			<label><input type="checkbox" name="<?php echo $this->hide_title; ?>" <?php echo $checked; ?> />Скрыть заголовок</label>
			<?php

		}

		function gallery_metabox_callback( $post ) {

			wp_nonce_field( $this->gallery_image . '_dononce', 			$this->gallery_image . '_noncename' );
			wp_nonce_field( $this->gallery_scroll . '_dononce', 		$this->gallery_scroll . '_noncename' );
			wp_nonce_field( $this->gallery_pagination . '_dononce', 	$this->gallery_pagination . '_noncename' );
			wp_nonce_field( $this->gallery_caption . '_dononce', 		$this->gallery_caption . '_noncename' );
			wp_nonce_field( $this->gallery_caption_link . '_dononce', 	$this->gallery_caption_link . '_noncename' );

			$gallery 				= get_post_meta( $post->ID, $this->gallery_image );
			$gallery_scroll 		= get_post_meta( $post->ID, $this->gallery_scroll, true );
			$gallery_pagination 	= get_post_meta( $post->ID, $this->gallery_pagination, true );
			$gallery_caption 		= get_post_meta( $post->ID, $this->gallery_caption, true );
			$gallery_caption_link 	= get_post_meta( $post->ID, $this->gallery_caption_link, true );

			if ( (bool)$gallery_scroll ) 	{ $scroll_checked = 'checked="checked"'; }
			if ( (bool)$gallery_pagination ){ $pagination_checked = 'checked="checked"'; }

			if ( !empty( $gallery_caption ) ) {
				$gallery_caption = is_array( $gallery_caption ) ? stripslashes_deep( $gallery_caption ) : stripslashes( wp_kses_decode_entities( $gallery_caption ) );
			}

			echo '<div class="postbox-gallery-block">';
			if ( $gallery ) {

				foreach ( $gallery as $value ) {
					$url = wp_get_attachment_image_url(absint($value) );
					echo '<div class="postbox-gallery-image"><img src="' . $url . '" />';
					echo '<a class="gallery-del-image" href="#">x</a>';
					echo '<input type="hidden" name="gallery-image[]" value="' . $value . '">';
					echo '</div>';
				}
			}
			echo '</div>';
			echo '<div><input type="button" id="upload-button" class="button" value="Добавить фото" /></div>';
			echo sprintf('<label class="postbox-gallery-scroll" style="display: %1$s;"><input type="checkbox" name="%2$s" %3$s/>Режим слайдшоу</label>',
							(($gallery) ? 'block' : 'none'),
							$this->gallery_scroll,
							$scroll_checked
						);
			echo sprintf('<label class="postbox-gallery-pagination" style="display: %1$s;"><input type="checkbox" name="%2$s" %3$s/>Индикатор слайдов</label>',
							(($gallery) ? 'block' : 'none'),
							$this->gallery_pagination,
							$pagination_checked
						);
			echo sprintf('<label class="postbox-gallery-caption" for="postbox-gallery-caption">Описание галереи</label>
							<textarea id="postbox-gallery-caption" name="%1$s">%2$s</textarea>',
							$this->gallery_caption,
							$gallery_caption
						);
			echo sprintf('<label class="postbox-gallery-caption-link">Ссылка для перехода
							<input type="text" name="%1$s" value="%2$s"/></label>',
							$this->gallery_caption_link,
							$gallery_caption_link
						);
/*
			//Creating a WYSIWYG Editor
			$gallery_caption = wpautop( $gallery_caption, true);
			wp_editor( $gallery_caption, $this->gallery_caption . '_editor', array(
				'wpautop'		=> true,
				'media_buttons' => false,
				'textarea_name' => $this->gallery_caption,
				'textarea_rows' => 8,
				'teeny'			=> true
			));

*/
		}


		function save_meta( $post_ID ) {

			if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
				||  !(		$_POST[ $this->hide_title . '_noncename' ]
						 && $_POST[ $this->gallery_image . '_noncename' ]
						 && $_POST[ $this->gallery_scroll . '_noncename' ]
						 && $_POST[ $this->gallery_pagination . '_noncename' ]
						 && $_POST[ $this->gallery_caption . '_noncename' ]
						 && $_POST[ $this->gallery_caption_link . '_noncename' ]
					) 
				|| 	!(		wp_verify_nonce( $_POST[ $this->hide_title . '_noncename' ], 			$this->hide_title . '_dononce' )
						 && wp_verify_nonce( $_POST[ $this->gallery_image . '_noncename' ], 		$this->gallery_image . '_dononce' )
						 && wp_verify_nonce( $_POST[ $this->gallery_scroll . '_noncename' ], 		$this->gallery_scroll . '_dononce' )
						 && wp_verify_nonce( $_POST[ $this->gallery_pagination . '_noncename' ],	$this->gallery_pagination . '_dononce' )
						 && wp_verify_nonce( $_POST[ $this->gallery_caption . '_noncename' ],		$this->gallery_caption . '_dononce' )
						 && wp_verify_nonce( $_POST[ $this->gallery_caption_link . '_noncename' ],	$this->gallery_caption_link . '_dononce' )
					) 
				) { return $post_ID; }

			//Update Title meta
			$old = get_post_meta( $post_ID, $this->hide_title, true );
			$new = $_POST[ $this->hide_title ];
			if ( $old != $new ) {
				if ( $new ) { 
					update_post_meta( $post_ID, $this->hide_title, $new ); 
				} else {
					delete_post_meta( $post_ID, $this->hide_title );
				}
			}

			//Update Gallery meta
			(array)$old = [];
			(array)$new = [];
			$old = get_post_meta( $post_ID, $this->gallery_image );
			$new = $_POST[ $this->gallery_image ];

			if ( $old != $new ) {
				if ( $old ) { 
					delete_post_meta( $post_ID, $this->gallery_image ); 
				}
				if ( $new ) {
					for ( $i = 0; $i < count($new); $i++) {
						add_post_meta( $post_ID, $this->gallery_image, $new[$i] ); 
					}
				}
			}

			//Update Gallery autoscroll meta
			(string)$old = '';
			(string)$new = '';
			$old = get_post_meta( $post_ID, $this->gallery_scroll, true );
			$new = $_POST[ $this->gallery_scroll ];

			if ( $old != $new ) {
				if ( $new ) { 
					update_post_meta( $post_ID, $this->gallery_scroll, $new ); 
				} else {
					delete_post_meta( $post_ID, $this->gallery_scroll );
				}
			}

			//Update Gallery pagination meta
			(string)$old = '';
			(string)$new = '';
			$old = get_post_meta( $post_ID, $this->gallery_pagination, true );
			$new = $_POST[ $this->gallery_pagination ];

			if ( $old != $new ) {
				if ( $new ) { 
					update_post_meta( $post_ID, $this->gallery_pagination, $new ); 
				} else {
					delete_post_meta( $post_ID, $this->gallery_pagination );
				}
			}

			//Update Gallery caption meta
			$value = $_POST[ $this->gallery_caption ];
			if ( isset( $value ) ) { 
				update_post_meta( $post_ID, $this->gallery_caption, esc_attr($value) ); 
			} else {
				delete_post_meta( $post_ID, $this->gallery_caption );
			}

			//Update Gallery caption link meta
			$old = get_post_meta( $post_ID, $this->gallery_caption_link, true );
			$new = $_POST[ $this->gallery_caption_link ];

			if ( $old != $new ) {
				if ( $new ) { 
					update_post_meta( $post_ID, $this->gallery_caption_link, esc_url($new) ); 
				} else {
					delete_post_meta( $post_ID, $this->gallery_caption_link );
				}
			}

			return $post_ID;

		} // save_meta




		function delete_meta( $post_ID ){

			delete_post_meta( $post_ID, $this->hide_title );
			delete_post_meta( $post_ID, $this->gallery_image );
			delete_post_meta( $post_ID, $this->gallery_scroll );
			delete_post_meta( $post_ID, $this->gallery_pagination );
			delete_post_meta( $post_ID, $this->gallery_caption );
			delete_post_meta( $post_ID, $this->gallery_caption_link );
			
			return $post_ID;

		} // delete_meta


	} // starck_meta_controls

	$starck_meta_controls = new starck_meta_controls;

}
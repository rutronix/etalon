// gallery-lightbox controls

$( function()
{
	var
		preloader = $(),
		overlay = 'gallery-lightbox-overlay',
		// ACTIVITY INDICATOR
		activityIndicatorOn = function()
		{
			preloader = $( '<div id="gallery-lightbox-preloader" class="preloader"><i class="fa fa-spinner fa-spin"></i></div>' ).appendTo( 'body' );
		},
		activityIndicatorOff = function()
		{
			if(preloader) preloader.remove();
		},


		// OVERLAY

		overlayOn = function()
		{
			$( '<div id="' + overlay + '"></div>' ).appendTo( 'body' );
		},
		overlayOff = function()
		{
			$( '#' + overlay ).remove();
		},


		// CLOSE BUTTON

		closeButtonOn = function( instance )
		{
			$( '<div class="close-button" id="gallery-lightbox-close" title="Закрыть"></div>' )
			.appendTo( 'body' )
			.on( 'click touchend', function() {
				$( this ).remove(); 
				instance.quit_gallerylightbox(); 
				return false;
			});
		},

		closeButtonOff = function() {
			$( '#gallery-lightbox-close' ).remove();
		},


		// NAVIGATION

		navigationOn = function( instance, selector )
		{
			var images = $( selector );
			if( images.length )
			{
				var nav = $( '<div id="gallery-lightbox-nav"></div>' )
					.appendTo( '#gallery-lightbox-container' )
					.on( 'click touchend', function() { return false; });

				for( var i = 0; i < images.length; i++ )
					nav.append( '<div class="nav-dot"></div>' );

				var navItems = nav.find( 'div' )
					.on( 'click touchend', function()
					{
						var $this = $( this );
						if( images.eq( $this.index() ).attr( 'href' ) != $( '#gallery-lightbox' ).attr( 'src' ) )
							instance.switch_gallerylightbox( $this.index() );

						navItems.removeClass( 'active' );
						navItems.eq( $this.index() ).addClass( 'active' );

						return false;
					})
					.on( 'touchend', function() { return false; });
			}
		},
		navigationUpdate = function( selector )
		{
			var items = $( '#gallery-lightbox-nav .nav-dot' );
			items.removeClass( 'active' );
			items.eq( $( selector ).filter( '[href="' + $( '#gallery-lightbox' ).attr( 'src' ) + '"]' ).index( selector ) ).addClass( 'active' );
		},
		navigationOff = function()
		{
			$( '#gallery-lightbox-nav' ).remove();
		},


		// ARROWS

		arrowsOn = function( instance, selector )
		{
			var $arrows = $('<a href="#" class="gallery-lightbox-arrow prev"><i class="fa icon arrow-left"></i></a>'+
							'<a href="#" class="gallery-lightbox-arrow next"><i class="fa icon arrow-right"></i></a>' );

			$arrows.appendTo( 'body' );

			$arrows.on( 'click touchend', function( e )
			{
				e.preventDefault();

				var $this	= $( this ),
					$target	= $( selector + '[href="' + $( '#gallery-lightbox' ).attr( 'src' ) + '"]' ),
					index	= $target.index( selector ),
					direction = null;

				if( $this.hasClass( 'prev' ) )
				{
					direction = 'left';
					index = index - 1; //if the previous image is out of range it will go to the last one automatically
				}
				else
				if( $this.hasClass( 'next' ) )
				{
					direction = 'right';
					index = index + 1;
					if( !$( selector ).eq( index ).length ) index = 0; //if the next image is out of range then go to the first one
				}

				instance.switch_gallerylightbox( index, direction );
				return false;
			});
		},
		arrowsOff = function()
		{
			$( '.gallery-lightbox-arrow' ).remove();
		},


		// CAPTION

		captionOn = function()
		{
			var description = $( 'a[href="' + $( '#gallery-lightbox' ).attr( 'src' ) + '"] img' ).attr( 'alt' );
			if( description.length > 0 )
				$( '<div id="gallery-lightbox-caption">' + description + '</div>' ).appendTo( '#gallery-lightbox-container' );
		},
		captionOff = function()
		{
			$( '#gallery-lightbox-caption' ).remove();
		};


	var el = '#gallery a';
	var gallery = $( el ).gallerylightbox({	
		animationSpeed: 200,   // integer;
		quitOnEnd:      true,  // bool; quit after viewing the last image
		quitOnImgClick: false, // bool; quit when the viewed image is clicked
		quitOnDocClick: true,  // bool; quit when anything but the viewed image is clicked
		onStart:		function() { 
							overlayOn(); 
							activityIndicatorOn();
							closeButtonOn( gallery );
							arrowsOn( gallery, el ); 
							navigationOn( gallery, el );
						},
		onEnd:			function() { 
							overlayOff(); 
							captionOff(); 
							closeButtonOff(); 
							arrowsOff(); 
							navigationOff(); 
						},
		onLoadStart: 	function() { 
							captionOff(); 
						},
		onLoadEnd:	 	function() {
							activityIndicatorOff(); 
							captionOn(); 
							navigationUpdate( el );
						}
	});


});
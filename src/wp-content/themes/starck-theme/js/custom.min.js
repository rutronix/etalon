/*
 * Custom scripts library
 *
 * @version 1.0.5
 */
 
document.addEventListener("DOMContentLoaded", function() {

	// Adding class after full DOM loading for applying CSS animation
	$('#main-header').addClass('visible');

	$.when( $('#dom-preloader').find('i').removeClass('fa-spin').end().delay(500).fadeOut('slow') )
	.done( function() { 
		$('body').fadeIn();
		$('#dom-preloader').remove(); 
	});		
/*
// inView.js
	inView('.someSelector')
		.on('enter', el => {
			el.style.opacity =1;
		})
		.on('exit', el => {
			el.style.opacity = 0.5;
		});	
*/

	$(window).scroll(function() {
		addVisibleClass(document.body.querySelectorAll('article')); //viewport.js
		addVisibleClass(document.body.querySelectorAll('#copyright'));

		$('.back-to-top').topBtnToggle({
			scrollTrigger: 400,
			//debug: true,
		});

		if ( $('body').has('.parallax').length ) {
			// init parallax for background
			$('.parallax').bgParallax({
				bgpositionY: 50, //it must be the same background-position value in css 
				speed: 0.5,
			});
		}
	});

	var burger = $('#nav-menu').on('click', function (e) {
		burger.toggleClass('active');
		$('#menu-top').toggleClass('active');
		$('#scroll-up').toggleClass('hidden');
	});
	
	$( document ).on( 'keyup', function( e ) {
		if( !burger.hasClass('active') ) return true;
		e.preventDefault();
		if( e.keyCode == 27 ) burger.click();
	});
	
	$('#scroll-up').on('click', function (e) {
		var mc = document.body.querySelector('#main-container');
		mc.scrollIntoView({block: "start", behavior: "smooth"});
		$('#scroll-up').fadeOut(200).remove();
	});

	$('.back-to-top').on('click', function (e) {		
		// 700 - скорость задержки перемещения наверх (в миллисекундах)
		e.preventDefault();
		$('html,body').animate({scrollTop: 0}, 700);		
	});



	if ( $('.jcarousel').has('.header-background').length ) {

		$('[data-jcarousel]').each(function() {
			var el = $(this);
			el.jcarousel(el.data());
		});

		$('.jcarousel')		
			.on('jcarousel:reloadend', function(event, carousel) {
				$(this).jcarousel('target').addClass('active');

			})
			.on('jcarousel:visibleout', 'li', function() {
				$(this).removeClass('active');
			})
			.on('jcarousel:visiblein', 'li', function() {
				$(this).addClass('active');
			})
			.jcarousel({
				wrap: 'circular',
				animation: 1000,
				transitions: Modernizr.csstransitions ? {
					transforms:   Modernizr.csstransforms,
					transforms3d: Modernizr.csstransforms3d,
					easing:       'ease'
				} : false
			})
			.jcarouselSwipe();

			if ( 'true' === $('.jcarousel').attr('data-jcarouselautoscroll') ) {
				$('.jcarousel').jcarouselAutoscroll({
					interval:  5000,
					//autostart: false,
					//target: '-=1',
				});
			}

			if ( $('.jcarousel-wrapper').has('.jcarousel-control').length ) {
			
			$('.jcarousel-control.prev')
				.on('jcarouselcontrol:active', function() {
					$(this).removeClass('inactive');
				})
				.on('jcarouselcontrol:inactive', function() {
					$(this).addClass('inactive');
				})
				.jcarouselControl({
					target: '-=1'
				});

			$('.jcarousel-control.next')
				.on('jcarouselcontrol:active', function() {
					$(this).removeClass('inactive');
				})
				.on('jcarouselcontrol:inactive', function() {
					$(this).addClass('inactive');
				})
				.jcarouselControl({
					target: '+=1'
				});

			$(".jcarousel-wrapper").hover( function() {
				$('.jcarousel-control').fadeIn(700);
			}, function() {
				$('.jcarousel-control').fadeOut(700);
			});

		}

		if ( $('.jcarousel-wrapper').has('.jcarousel-pagination').length && 'true' === $('.jcarousel-pagination').attr('data-jcarouselpagination') ) {
			$('.jcarousel-pagination')
				.on('jcarouselpagination:active', 'a', function() {
					$(this).addClass('active');
				})
				.on('jcarouselpagination:inactive', 'a', function() {
					$(this).removeClass('active');
				})
				.jcarouselPagination();
		} else $('.jcarousel-pagination').remove();
	}

	//Adding an agent to HTML selector
	var deviceAgent = navigator.userAgent.toLowerCase();
	if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
		$("html").addClass("ios");
		$("html").addClass("mobile");
	}
	if (navigator.userAgent.search("MSIE") >= 0) {
		$("html").addClass("ie");
	}
	else if (navigator.userAgent.search("Chrome") >= 0) {
		$("html").addClass("chrome");
	}
	else if (navigator.userAgent.search("Firefox") >= 0) {
		$("html").addClass("firefox");
	}
	else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
		$("html").addClass("safari");
	}
	else if (navigator.userAgent.search("Opera") >= 0) {
		$("html").addClass("opera");
	}

});

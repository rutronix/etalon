(function($){
	$.fn.topBtnToggle=function(options){
		var btn = $.extend({
			scrollTrigger: 400, // порог прокрутки, после которого поялвялется кнопка возврата наверх
			debug: false, // Режим отладки
		},options);
		
		if ( this.length ) {

			var scrollTop = $(window).scrollTop();
			
			if (scrollTop > btn.scrollTrigger) {
				//this.fadeIn(btn.scrollSpeed);
				this.addClass('show');
			} else {
				//this.fadeOut(btn.scrollSpeed);
				this.removeClass('show');
			}
			
			if( btn.debug ) {console.log('scroll Y: '+scrollTop+'px');}
		}
	}
}(jQuery));
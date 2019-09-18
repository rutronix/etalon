// Parallax script
// JQuery Background Image Scroll - параллакс эффект для фона при прокрутке страницы
// https://github.com/Hoffffi/JQuery-Background-Image-Scroll

(function($){
  $.fn.bgParallax = function(options){
    var x=$.extend({
		bgpositionX: 50, // x позиция фонового изображения, от 0 до 100, размерность в %
		bgpositionY: 50, // y позиция (this.css('background-position-y').replace('%', ''))
    direction: "bottom", // направление bottom или top
		debug: false, // Режим отладки
		min: 0, // минимальное положение (в %) на которое может смещаться фон
		max: 100, // максимальное положение (в %) на которое может смещаться фон
		speed: 2, // скорость прокрутки
	},options);

    var a=$(document).height()-$(window).height(),
		b=a-(this.offset().top+this.height());
    this.offset().top<a&&(b=0);
    var c=(this.offset().top+this.height());
	
    if($(window).scrollTop()>b && $(window).scrollTop()<c){
      var d=x.bgpositionY+($(window).scrollTop()-b)/(c-b)*100*x.speed;
      "top"==x.direction&&(d=100-d),d>x.max&&(d=x.max),d<x.min&&(d=x.min);
      if(x.debug)console.log('scroll Y: '+$(window).scrollTop()+'px | background position Y: '+d+'%');
    }
    return this.css({
        backgroundPosition: x.bgpositionX+'% '+d+'%'
    });
  };
}(jQuery));
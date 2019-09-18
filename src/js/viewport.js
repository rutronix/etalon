var isElemVisible = function(el) {

	const { top, height, bottom } = el.getBoundingClientRect(); 
	const screenHeight = document.documentElement.clientHeight;
	var el = el.parentNode;
	do {
		// Check if the element is out of viewport due to a container scrolling
		viewport = el.getBoundingClientRect();
		if (top <= viewport.bottom === false) return false; //below viewport
		if (bottom <= viewport.top) return false; //above viewport
		el = el.parentNode;
	} while (el != document.body);
	// Check its within the document viewport and return moving factor
	return ((screenHeight - top) / height).toFixed(2);
};

var addVisibleClass = function(selectors, offset, modeIn, hideDown) {
	for (var i = 0; i < selectors.length; ++i) {
		var elem = selectors[i];
		if (elem) {
			var factor = isElemVisible(elem); // 1 - fully visible, 0 - element's top is on the bottom of viewport
				//console.log(elem.classList);
				//console.log(factor);
			if (factor > 0) {
				factor -= (offset > 0 && offset <= 1 ) ? offset : 0;
				if  ( factor > 0 && !elem.classList.contains('visible')) elem.classList.add('visible');
				if  (elem.classList.contains('visible') && modeIn === 'fadeIn' && 
					(factor+offset) <= 1 ) {
					var opacity = (factor*(1+offset)+offset*offset).toFixed(2);
					elem.style.opacity = (opacity <= 1) ? opacity : 1;
				} else if (elem.classList.contains('visible') && modeIn !== 'fadeIn') {
					elem.style.opacity = 1;
				}
			} else 
			if ( hideDown === 'hideOnScrollDown' && elem.classList.contains('visible') ) { 
				elem.classList.remove('visible');
				if (modeIn === 'fadeIn') { elem.style.opacity = 0; }
			}
		}
	}
}

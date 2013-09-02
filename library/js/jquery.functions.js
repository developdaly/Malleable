var $j = jQuery.noConflict();

$j(document).ready(
	function() {

	//Slider
		$j('div#slider').before('<div class="slider-controls">').cycle({ 
		    fx:     'fade', 
		    speed:  300, 
		    timeout: 3000, 
		    pager:  '.slider-controls' 
			});

	}
);
$(document).ready(function() {
	'use strict';

	/* ===== Bootstrap Slider ==== */
	/* Ref: https://github.com/seiyria/bootstrap-slider */

	$("input#ex1").slider();

	$("input#ex2").slider({
		tooltip: 'always'
	});

	$("input#ex3").slider();

	$("input#ex4").slider({
		ticks: [0, 100, 200, 300, 400],
		ticks_labels: ['$0', '$100', '$200', '$300', '$400'],
		ticks_snap_bounds: 30
	});

	$("input.slider-vertical").slider({
    	//reversed : true
    });
});

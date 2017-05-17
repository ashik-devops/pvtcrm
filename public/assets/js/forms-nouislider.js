$(document).ready(function() {
	'use strict';

	/* ===== jQuery Range Slider ==== */
	/* Ref: http://refreshless.com/nouislider/ */

	noUiSlider.create($("#range-1")[0], {
		start: [20, 80],
		connect: true,
		range: {
			'min': 0,
			'max': 100
		}
	});

	noUiSlider.create($("#range-2")[0], {
		start: 40,
		connect: "lower",
		range: {
			'min': 0,
			'max': 100
		}
	});

	noUiSlider.create($('#range-3')[0], {
		start: [ 20, 80 ],
		step: 10,
		margin: 20,
		connect: true,
		direction: 'rtl',
		orientation: 'vertical',

		// Configure tapping, or make the selected range dragable.
		behaviour: 'tap-drag',

		// Support for non-linear ranges by adding intervals.
		range: {
			'min': 0,
			'max': 100
		},
		// Optionaly add pips (Percentage In Point);
		pips: {
			mode: 'steps',
			density: 2
		}
	});
});

$(document).ready(function() {
	'use strict';

	/* ===== X-editable ==== */
	/* Ref: https://github.com/IonDen/ion.rangeSlider */

	$("#range-slider-1").ionRangeSlider({
		hide_min_max: true,
		keyboard: true,
		min: 0,
		max: 5000,
		from: 1000,
		to: 4000,
		type: 'double',
		step: 1,
		prefix: "$",
		grid: true
	});

	$("#range-slider-2").ionRangeSlider({
	grid: true,
	from: 3,
	values: [
		"January", "February", "March",
		"April", "May", "June",
		"July", "August", "September",
		"October", "November", "December"
		]
	});

	$("#range-slider-3").ionRangeSlider({
		min: 0,
		max: 100,
		from: 30,
		from_min: 10,
		from_max: 50,
		from_shadow: true
	});

	$("#range-slider-4").ionRangeSlider({
		min: +moment().subtract(12, "hours").format("X"),
		max: +moment().format("X"),
		from: +moment().subtract(6, "hours").format("X"),
		prettify: function (num) {
			return moment(num, "X").format("MMM Do, hh:mm A");
		}
	});
});

$(document).ready(function() {
	'use strict';

	/* ===== Easy Pie Charts ==== */
	/* Ref: https://github.com/rendro/easy-pie-chart */

	$('.percentage').easyPieChart({
			barColor:'#40babd',
			lineWidth : 5,
			onStep: function(from, to, percent) {
				$(this.el).find('span').text(Math.round(percent));
			}
	});
});

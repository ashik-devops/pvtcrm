$(document).ready(function() {
	'use strict';

	/* ===== Sparkline Inline Charts ==== */
	/* Ref: http://omnipotent.net/jquery.sparkline/#s-docs */

	/* Line Chart */
	/* Docs: http://omnipotent.net/jquery.sparkline/#line */
	$('.sparkline-line').sparkline(
		'html',
		{
			type: 'line',
			defaultPixelsPerValue: 6,
			width: 200,
			height: 80,
			lineColor: '#40babd',
			fillColor: '#74d2d3',
			spotColor: '#75c181',
			minSpotColor: '#75c181',
			maxSpotColor: '#75c181',
			spotRadius: 3,
			highlightSpotColor: '#F8A13F',
			highlightLineColor: '#6f7581',
			lineWidth: 2,

		}
	);

	/* Bar Chart */
	/* Docs: http://omnipotent.net/jquery.sparkline/#line */
	$('.sparkline-bar').sparkline(
		'html',
		{
			type: 'bar',
			width: 200,
			height: 100,
			barColor: '#40babd',
			negBarColor: '#40babd',
			zeroColor: '#40babd',
			barWidth: 15,
			barSpacing: 5

		}
	);

	/* Pie Chart */
	/* Docs: http://omnipotent.net/jquery.sparkline/#pie */
	$('.sparkline-pie').sparkline(
		'html',
		{
			type: 'pie',
			width: 200,
			height: 100,
			sliceColors: ['#6f7581', '#75c181', '#f77b6b', '#F8A13F', '#58bbee'],
			offset: 30,
			borderWidth: 0

		}
	);

	/* Tristate Chart */
	/* Docs: http://omnipotent.net/jquery.sparkline/#tristate */
	$('.sparkline-tristate').sparkline(
		'html',
		{
			type: 'tristate',
			width: 200,
			height: 100,
			posBarColor: '#40babd',
			negBarColor: '#939bab',
			zeroBarColor: '#40babd',
			barWidth: 15,
			barSpacing: 5

		}
	);
});

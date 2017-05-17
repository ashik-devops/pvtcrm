$(document).ready(function() {
	'use strict';

	/* Time Chart */
	var dataSetB = [
		[gd(2015, 6, 1), 353], [gd(2015, 6, 2), 457], [gd(2015, 6, 3), 412],
		[gd(2015, 6, 4), 397], [gd(2015, 6, 5), 388], [gd(2015, 6, 6), 420],
		[gd(2015, 6, 7), 452], [gd(2015, 6, 8), 364], [gd(2015, 6, 9), 411],
		[gd(2015, 6, 10), 213], [gd(2015, 6, 11), 153], [gd(2015, 6, 12), 378],
		[gd(2015, 6, 13), 213], [gd(2015, 6, 14), 419],
	];
	function gd(year, month, day) {
		return new Date(year, month - 1, day).getTime();
	}

	var dataTime = [{label: "Hours", data: dataSetB}];

	var optionSetB = {
		series: {
			bars: {
				show: true,
				barWidth: 24*60*60*1000*0.7, //bar to cover 60% day
				lineWidth: 0,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0.8
					}, {
						opacity: 0.8
					}]
				}

			}
		},
		shadowSize: 0,
		xaxis: {
			color:'#f3f3f3',
			mode: "time",
			tickSize: [2, "day"]
		},
		yaxis:{
			color: '#f3f3f3',
			tickFormatter: function (v, axis) {
				return numeral(v).format('0,0');
			}

		},
		colors: ["#40babd"],
		grid: {
			borderWidth: 0,
			hoverable: true, /* You need to set flot option hoverable to true if you want flot.tooltip plugin to work.*/
			clickable: true,
		},
		legend: {
			show: false
		},
		/* Flot tooltip plugin required */
		tooltip: true,
		tooltipOpts: {
			content: "%x - %y hrs"
		}
	}
	$.plot($("#time-chart"), dataTime, optionSetB);

	/* Type Pie Chart */
	var dataSetF = [
	{label: "Social Media", data: 5, color: "#4796BF"},
	{label: "Mobile App", data: 10, color: "#2F647F"},
	{label: "Marketing", data: 25, color: "#5EC8FF"},
	{label: "Web App", data: 60, color: "#55B4E5"}
	];

	var optionSetF = {
		series: {
			pie: {
				show: true,
				innerRadius: 0.5,
				highlight: {
					opacity: 0.2
				}
			}
		},
		grid: {
			hoverable: true /* You need to set flot option hoverable to true if you want flot.tooltip plugin to work.*/
		},
		legend: {
			show: true
		},
		/* Flot tooltip plugin required */
		tooltip: true,
		tooltipOpts: {
			content: "%s: %p.0%",
			shifts: {
				x: 20,
				y: 0
			}
		}
	}

	$.plot($("#type-chart"), dataSetF, optionSetF);


	/* Sales Chart */
	var dataSetA = [

	[gd(2015, 5, 27), 3503], [gd(2015, 5, 28), 4114], [gd(2015, 5, 29), 3876],
	[gd(2015, 5, 30), 4322], [gd(2015, 5, 31), 3750], [gd(2015, 6, 1), 4118],
	[gd(2015, 6, 2), 4318], [gd(2015, 6, 3), 3821], [gd(2015, 6, 4), 4821],
	[gd(2015, 6, 5), 4618], [gd(2015, 6, 6), 4521], [gd(2015, 6, 7), 4123],
	[gd(2015, 6, 8), 4944], [gd(2015, 6, 9), 4803], [gd(2015, 6, 10), 4700],
	[gd(2015, 6, 11), 4333], [gd(2015, 6, 12), 4567], [gd(2015, 6, 13), 4760],

	];
	function gd(year, month, day) {
		return new Date(year, month - 1, day).getTime();
	}

	var dataSales = [{label: "Sales", data: dataSetA, points: { symbol: "circle"}}]

	var optionSetA = {
		series: {
			lines: {
				show: true,
				lineWidth: 1.5,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0.1
					}, {
						opacity: 0.4
					}]
				}
			},
			points: {
				radius: 2,
				fill: true,
				show: true
			}
		},
		shadowSize: 0,
		xaxis: {
			color:'#f3f3f3',
			font: {
				color: "grey"
			},

			mode: "time",
			tickSize: [3, "day"],
			tickLength: 10,

		},
		yaxis:{
			color: '#f3f3f3',
			font: {
				color: 'grey',
			},

			tickFormatter: function (v, axis) {
				return numeral(v).format('0,0.00');
			}

		},
		colors: ["#75c181"],
		grid: {
			borderWidth: 0,
			hoverable: true, /* You need to set flot option hoverable to true if you want flot.tooltip plugin to work.*/
			clickable: true,
			backgroundColor: {colors: ["#EDF5FF", "#ffffff"] }
		},
		legend: {
			show: false
		},
		/* Flot tooltip plugin required */
		tooltip: true,
		tooltipOpts: {
			content: "%x - $%y"
		}
	}
	$.plot($("#sales-chart"), dataSales, optionSetA);


	/* jQuery map */
	$('#world-map').vectorMap({
		map: 'world_mill_en',
		backgroundColor: "none",
		regionStyle: {
			initial: {
				fill: '#B8E9EE',
				"fill-opacity": 1,
				stroke: 'none',
				"stroke-width": 0,
				"stroke-opacity": 1
			},
			hover: {
				"fill-opacity": 0.9,
				cursor: 'pointer'
			},
		},
		markerStyle: {
			initial: {
				fill: '#FB866A',
				"fill-opacity": 0.9,
				"stroke-width": 2,
				"stroke-opacity": 0.3,
				stroke: '#FB866A',
				r: 5
			},
			hover: {
				fill: '#EC573A',
				"fill-opacity": 1,
				stroke: '#FB866A',
				"stroke-width": 4,
				"stroke-opacity": 0.4,
				cursor: 'pointer'
			},
			selected: {
				fill: '#FB866A'
			},
		},

		markers: [
		{latLng: [51.463700, -2.588313], name: 'Bristol'},
		{latLng: [40.717801, -74.003720], name: 'New York'},
		{latLng: [37.770044, -122.466440], name: 'San Francisco'},
		{latLng: [51.518304, -0.126323], name: 'London'},
		{latLng: [39.914323, 116.391941], name: 'Beijing'},
		{latLng: [22.287112, 114.172508], name: 'Hongkong'},
		{latLng: [1.3, 103.8], name: 'Singapore'},
		{latLng: [48.856579, 2.350302], name: 'Paris'},
		{latLng: [40.425389, -3.703571], name: 'Madrid'},
		{latLng: [43.652612, -79.381497], name: 'Toronto'},
		{latLng: [52.519995, 13.412085], name: 'Berlin'},
		{latLng: [45.507482, 12.282149], name: 'Venice'},
		{latLng: [35.675493, 139.820245], name: 'Toyko'},
		{latLng: [41.009382, 28.979214], name: 'Istanbul'},
		{latLng: [-33.861823, 151.179091], name: 'Sydney'},
		{latLng: [630.048637, 31.236491], name: 'Cairo'},
		]
	});
});

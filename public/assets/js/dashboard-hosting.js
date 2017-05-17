$(document).ready(function() {
	'use strict';

	/* ===== CPU Chart ==== */

	/* Generate data starts */
	var fakeData = [];
	var dataSetA
	var totalPoints = 30;
	var updateInterval = 2000;
	var now = new Date().getTime();


	function GetData() {
		fakeData.shift();

		while (fakeData.length < totalPoints) {
			var y = Math.random() * 100;
			var temp = [now += updateInterval, y];

			fakeData.push(temp);
		}
	}
	/* Generate data ends */

	var optionSetA = {
		series: {
			lines: {
				show: true,
				lineWidth: 1.2,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0.4
					}, {
						opacity: 0.4
					}]
				}
			}
		},
		colors: ["#75c181"],
		shadowSize: 0,
		xaxis: {
			color:'#f3f3f3',
			mode: "time",
			tickSize: [2, "second"],
			tickFormatter: function (v, axis) {
				var date = new Date(v);

				if (date.getSeconds() % 20 == 0) {
					var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
					var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
					var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();

					return hours + ":" + minutes + ":" + seconds;
				} else {
					return "";
				}
			}
		},
		yaxis: {
			color:'#f3f3f3',
			min: 0,
			max: 100,
			tickSize: 5,
			tickFormatter: function (v, axis) {
				if (v % 10 == 0) {
					return v + "%";
				} else {
					return "";
				}
			}
		},
		grid: {
			borderWidth: 0,
			hoverable: true,
			hoverable: true, /* You need to set flot option hoverable to true if you want flot.tooltip plugin to work.*/
			clickable: true
		},
		legend: {
			labelBoxBorderColor: "#fff"
		}
	};


	GetData();

	dataSetA = [
	{ label: "CPU", data: fakeData }
	];

	$.plot($("#cpu-chart"), dataSetA, optionSetA);

	function update() {
		GetData();

		$.plot($("#cpu-chart"), dataSetA, optionSetA)
		setTimeout(update, updateInterval);
	}

	update();


	/* ===== Load Average Charts ==== */
	/* Easy Pie Charts */
	/* Ref: https://github.com/rendro/easy-pie-chart */

	$('#pie-1').easyPieChart({
		barColor:'#58bbee',
		trackColor: '#f5f5f5',
		scaleColor: false,
		lineWidth : 10,
		animate: 2000,
		onStep: function(from, to, percent) {
			$(this.el).find('span').text(Math.round(percent));
		}
	});

	$('#pie-2').easyPieChart({
		barColor:'#f8a13f',
		trackColor: '#f5f5f5',
		scaleColor: false,
		lineWidth : 10,
		animate: 2000,
		onStep: function(from, to, percent) {
			$(this.el).find('span').text(Math.round(percent));
		}
	});
	$('#pie-3').easyPieChart({
		barColor:'#f77b6b',
		trackColor: '#f5f5f5',
		scaleColor: false,
		lineWidth : 10,
		animate: 2000,
		onStep: function(from, to, percent) {
			$(this.el).find('span').text(Math.round(percent));
		}
	});


	/* ===== Memory Chart ==== */

	var dataSetB1 = [[1445126400000,  458], [1445130000000,  457], [1445133600000,  459], [1445137200000,  462], [1445140800000,  460], [1445144400000,  457], [1445148000000,  458], [1445151600000,  461], [1445155200000,  460]];
	var dataSetB2 = [[1445126400000,  152], [1445130000000,  152], [1445133600000,  153], [1445137200000,  152], [1445140800000,  152], [1445144400000,  152], [1445148000000,  152], [1445151600000,  152], [1445155200000,  150]];


	var optionSetB = {
		series: {
			lines: {
				show: true,
				lineWidth: 2,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0.9
					}, {
						opacity: 0.3
					}]
				}
			}
		},
		shadowSize: 0,
		xaxis: {
			color:'#f3f3f3',
			mode: "time",
			timeformat: "%I:%M", // HH:MM am/pm
			tickSize: [1, "hour"], // tick every hour
		},
		yaxis:{
			color: '#f3f3f3',
			tickFormatter: function (v, axis) {
				return v + " MB";
			}
		},
		colors: ["#58bbee", "#f77b6b"],
		grid: {
			borderWidth: 0,
			hoverable: true, /* You need to set flot option hoverable to true if you want flot.tooltip plugin to work.*/
			clickable: true
		},
		legend: {
			show: true
		},
		/* Flot tooltip plugin required */
		tooltip: true,
		tooltipOpts: {
			content: "%x - %y"
		}
	}
	$.plot($("#memory-chart"), [{label:"Free", data: dataSetB1}, {label:"Used", data: dataSetB2}], optionSetB);


	/* ===== Disk Chart ==== */
	var dataSetC1 = [[1445126400000,  100], [1445130000000,  100], [1445133600000,  100], [1445137200000,  100], [1445140800000,  100], [1445144400000, 100], [1445148000000, 100], [1445151600000,  100], [1445155200000,  100]];

	var dataSetC2 = [[1445126400000,  45], [1445130000000,  56], [1445133600000,  54], [1445137200000,  65], [1445140800000,  67], [1445144400000,  63], [1445148000000,  62], [1445151600000,  57], [1445155200000,  56]];


	var optionSetC = {
		series: {
			lines: {
				show: true,
				lineWidth: 0,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0.2
					}, {
						opacity: 0.9
					}]
				}
			}
		},
		shadowSize: 0,
		xaxis: {
			color:'#f3f3f3',
			mode: "time",
			timeformat: "%I:%M", // HH:MM
			tickSize: [1, "hour"], // tick every hour
		},
		yaxis:{
			color: '#f3f3f3',
			tickFormatter: function (v, axis) {
				return v + " GB";
			}
		},
		colors: ["#75c181", "#40babd"],
		grid: {
			borderWidth: 0,
			hoverable: true, /* You need to set flot option hoverable to true if you want flot.tooltip plugin to work.*/
			clickable: true
		},
		legend: {
			show: true
		},
		/* Flot tooltip plugin required */
		tooltip: true,
		tooltipOpts: {
			content: "%x - %y"
		}
	}
	$.plot($("#disk-chart"), [{label:"Free", data: dataSetC1}, {label:"Used", data: dataSetC2}], optionSetC);



	/* ===== Server Requests Chart ==== */

	var dataSetD1 = [[1445126400000,  59], [1445130000000,  66], [1445133600000,  65], [1445137200000, 73], [1445140800000,  74], [1445144400000,  70], [1445148000000,  69], [1445151600000,  68], [1445155200000,  72]];
	var dataSetD2 = [[1445126400000,  43], [1445130000000,  47], [1445133600000,  53], [1445137200000, 49], [1445140800000,  58], [1445144400000,  42], [1445148000000,  46], [1445151600000,  52], [1445155200000,  55]];
	var dataSetD3 = [[1445126400000,  22], [1445130000000,  26], [1445133600000,  25], [1445137200000,  29], [1445140800000,  23], [1445144400000,  28], [1445148000000,  20], [1445151600000,  29], [1445155200000,  35]];
	var dataSetD4 = [[1445126400000,  12], [1445130000000,  14], [1445133600000,  16], [1445137200000,  18], [1445140800000,  13], [1445144400000,  19], [1445148000000,  15], [1445151600000,  11], [1445155200000,  9]];

	var optionSetD = {
		series: {
			lines: {
				show: true,
				lineWidth: 2,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0.4
					}, {
						opacity: 0.4
					}, {
						opacity: 0.4
					},
					{
						opacity: 0.4
					}
					]
				}
			}
		},
		shadowSize: 0,
		xaxis: {
			color:'#f3f3f3',
			mode: "time",
			timeformat: "%H:%M", // HH:MM am/pm
			tickSize: [1, "hour"], // tick every hour
		},
		yaxis:{
			color: '#f3f3f3',
		},
		colors: ["#40babd", "#DF82C3", "#58bbee", '#6C7A95'],
		grid: {
			borderWidth: 0,
			hoverable: true, /* You need to set flot option hoverable to true if you want flot.tooltip plugin to work.*/
			clickable: true
		},
		legend: {
			show: true
		},
		/* Flot tooltip plugin required */
		tooltip: true,
		tooltipOpts: {
			content: "%x - %y"
		}
	};

	$.plot($("#requests-chart"), [{label:"Server 1", data: dataSetD1}, {label:"Server 2", data: dataSetD2}, {label:"Server 3", data: dataSetD3}, {label:"Server 4", data: dataSetD4}], optionSetD);
});

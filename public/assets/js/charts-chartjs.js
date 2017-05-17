$(document).ready(function() {
	'use strict';

    /* ===== Chart.js ==== */
    /* Ref: https://github.com/nnnick/Chart.js */

	/* Random number generator for demo purpose */
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	/* Line Chart */
	var lineChartData = {
		labels : ["January","February","March","April","May","June","July"],
		datasets : [
			{
				label: "My First dataset",
				fillColor : "rgba(117,193,129,0.2)",
				strokeColor : "rgba(117,193,129,1)",
				pointColor : "rgba(117,193,129,1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(117,193,129,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			},
			{
				label: "My Second dataset",
				fillColor : "rgba(56,203,203,0.2)",
				strokeColor : "rgba(56,203,203,1)",
				pointColor : "rgba(56,203,203,1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(56,203,203,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			}
		]

	};

	/* Bar Chart */
	var barChartData = {
		labels : ["January","February","March","April","May","June","July"],
		datasets : [
			{
				fillColor : "rgba(88,187,238,0.5)",
				strokeColor : "rgba(88,187,238,0.8)",
				highlightFill: "rgba(88,187,238,0.75)",
				highlightStroke: "rgba(88,187,238,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			},
			{
				fillColor : "rgba(117,193,129,0.5)",
				strokeColor : "rgba(117,193,129,0.8)",
				highlightFill : "rgba(117,193,129,0.75)",
				highlightStroke : "rgba(117,193,129,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			}
		]

	};

	/* Pie Chart */
	var pieData = [
		{
			value: 250,
			color:"rgba(56,203,203,0.2)",
			highlight: "rgba(56,203,203,0.25)",
			label: "Team A"
		},
		{
			value: 100,
			color: "rgba(56,203,203,0.4)",
			highlight: "rgba(56,203,203,0.45)",
			label: "Team B"
		},
		{
			value: 100,
			color: "rgba(56,203,203,0.6)",
			highlight: "rgba(56,203,203,0.6.5)",
			label: "Team C"
		},
		{
			value: 40,
			color: "rgba(56,203,203,0.8)",
			highlight: "rgba(56,203,203,0.85)",
			label: "Team D"
		},
		{
			value: 120,
			color: "rgba(56,203,203,0.9)",
			highlight: "rgba(56,203,203,0.95)",
			label: "Team E"
		}

	];

	/* Doughnut Chart */
	var doughnutData = [
			{
				value: 100,
				color:"rgba(117,193,129,0.2)",
				highlight: "rgba(117,193,129,0.25)",
				label: "Group A"
			},
			{
				value: 250,
				color: "rgba(117,193,129,0.4)",
				highlight: "rgba(117,193,129,0.45)",
				label: "Group B"
			},
			{
				value: 100,
				color: "rgba(117,193,129,0.6)",
				highlight: "rgba(117,193,129,0.65)",
				label: "Group C"
			},
			{
				value: 40,
				color: "rgba(117,193,129,0.8)",
				highlight: "rgba(117,193,129,0.85)",
				label: "Group D"
			},
			{
				value: 120,
				color: "rgba(117,193,129,0.95)",
				highlight: "rgba(117,193,129,1)",
				label: "Group E"
			}

		];

	/* Polar Chart */
	var polarData = [
		{
			value: 300,
			color:"rgba(88,187,238,0.2)",
            highlight: "rgba(88,187,238,0.3)",
			label: "Set A"
		},
		{
			value: 50,
			color:"rgba(88,187,238,0.4)",
            highlight: "rgba(88,187,238,0.5)",
			label: "Set B"
		},
		{
			value: 100,
			color:"rgba(88,187,238,0.6)",
            highlight: "rgba(88,187,238,0.7)",
			label: "Set C"
		},
		{
			value: 40,
			color:"rgba(88,187,238,0.8)",
            highlight: "rgba(88,187,238,0.9)",
			label: "Set D"
		}

	];

	/* Radar Chart */
	var radarChartData = {
		labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
		datasets: [
			{
				label: "My First dataset",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: [65,59,90,81,56,55,40]
			},
			{
				label: "My Second dataset",
				fillColor: "rgba(56,203,203,0.2)",
				strokeColor: "rgba(56,203,203,1)",
				pointColor: "rgba(56,203,203,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(56,203,203,1)",
				data: [28,48,40,19,96,27,100]
			}
		]
	};

	window.onload = function(){
    	/* Line Chart */
		var ctxLine = document.getElementById("line-chart-canvas").getContext("2d");
		window.myLine = new Chart(ctxLine).Line(lineChartData, {
    		scaleFontColor: "#b7bcc6",
			responsive: true,
			maintainAspectRatio: false
		});

		/* Bar Chart */
		var ctxBar = document.getElementById("bar-chart-canvas").getContext("2d");
		window.myBar = new Chart(ctxBar).Bar(barChartData, {
    		scaleFontColor: "#b7bcc6",
			responsive : true,
			maintainAspectRatio: false

		});

		/* Pie Chart */
		var ctxPie = document.getElementById("pie-chart-canvas").getContext("2d");
		window.myPie = new Chart(ctxPie).Pie(pieData, {
    		responsive : true,
            maintainAspectRatio: false
		});

		/* Doughnut Chart */
		var ctxDoughnut = document.getElementById("doughnut-chart-canvas").getContext("2d");
        window.myDoughnut = new Chart(ctxDoughnut).Doughnut(doughnutData, {
            responsive : true,
            maintainAspectRatio: false
        });

		/* Polar Chart */
		var ctxPolar = document.getElementById("polar-chart-canvas").getContext("2d");
		window.myPolarArea = new Chart(ctxPolar).PolarArea(polarData, {
			responsive:true,
			maintainAspectRatio: false
		});

		/* Radar Chart */
		window.myRadar = new Chart(document.getElementById("radar-chart-canvas").getContext("2d")).Radar(radarChartData,                     {
			responsive: true,
			maintainAspectRatio: false
		});
	};
});

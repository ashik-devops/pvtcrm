$(document).ready(function() {
	'use strict';

	/* ======= ChartJS ====== */
	/* Ref: http://www.chartjs.org/ */

	/* Line Chart */
	var lineChartData = {
		labels : ["Mar 16", "Mar 17", "Mar 18","Mar 19","Mar 20","Mar 21", "Mar 22"],
		datasets : [
		{
			label: "Total Sessions",
			fillColor : "rgba(64,186,189,0.3)",
			strokeColor : "rgba(64,186,189,0.7)",
			pointColor : "rgba(64,186,189,0.4)",
			pointStrokeColor : "rgba(256,256,256,0.5)",
			pointHighlightFill : "#fff",
			pointHighlightStroke : "rgba(64,186,189,1)",
			data : [25145, 24583, 32456, 34890, 28763, 19234, 20016],

		},
		{
			label: "Unique Visitors",
			fillColor : "rgba(54,180,83, 0.3)",
			strokeColor : "rgba(54,180,83, 0.7)",
			pointColor : "rgba(54,180,83, 0.4)",
			pointStrokeColor : "rgba(256,256,256,0.5)",
			pointHighlightFill : "#fff",
			pointHighlightStroke : "rgba(54,180,83, 1)",
			data : [12600, 13244, 16673, 16325, 17689, 16732, 15324]
		}
		]
	};

	/* Bar Chart 1*/
	var barChartData = {
		labels : ["18-24","25-34","35-44","45-54","65+"],
		datasets: [
		{
			label: "Female",
			fillColor: "rgba(234, 83, 149, 0.8)",
			strokeColor: "rgba(234, 83, 149, 0.8)",
			highlightFill: "rgba(234, 83, 149, 1)",
			highlightStroke: "rgba(234, 83, 149, 1)",
			data : [130000, 200000, 400000, 250000, 22000]
		},
		{
			label: "Male",
			fillColor: "rgba(88, 187, 238, 0.8)",
			strokeColor: "rgba(88, 187, 238, 0.8)",
			highlightFill : "rgba(88, 187, 238, 1)",
			highlightStroke : "rgba(88, 187, 238, 1)",
			data : [150000, 130000, 380000, 180000, 12000]
		}
		]
	};


	/* Pie Chart */
	var pieData = [
	{
		value: 65,
		color: "rgba(88, 187, 238, 1)",
		highlight: "rgba(88, 187, 238,0.9)",
		label: "Returning Visitor",

	},
	{
		value: 35,
		color:"rgba(131, 193, 105, 1)",
		highlight: "rgba(131, 193, 105, 0.9)",
		label: "New Visitor"
	}

	];

	/* Doughnut Chart */
	var doughnutData = [
	{
		value: 45,
		color: "rgba(63, 183, 183, 0.9)",
		highlight: "rgba(63, 183, 183,1)",
		label: "Referral",

	},
	{
		value: 15,
		color:"rgba(107, 116, 125, 0.9)",
		highlight: "rgba(107, 116, 125,1)",
		label: "Direct"
	},
	{
		value: 30,
		color:"rgba(251, 134, 106, 0.9)",
		highlight: "rgba(251, 134, 106, 1)",
		label: "Social"
	},
	{
		value: 10,
		color:"rgba(248, 161, 63, 0.9)",
		highlight: "rgba(248, 161, 63, 1)",
		label: "Organic Search"
	}

	];


	window.onload = function(){

		/* Line Chart */
		var ctx = document.getElementById("line-chart-canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			scaleShowVerticalLines: false,
			scaleFontColor: "#b7bcc6",
			scaleFontSize: 10,
			responsive: true,
			maintainAspectRatio: false,
			multiTooltipTemplate: function(chart) {
				return numeral(chart.value).format('0,0');
			},
			legendTemplate : "<ul class=\"list-inline <%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
		});
		document.getElementById("line-chart-legend").innerHTML = myLine.generateLegend();

		/* Bar Chart 1*/
		var ctxBar = document.getElementById("bar-chart-canvas").getContext("2d");
		window.myBar= new Chart(ctxBar).Bar(barChartData, {
			scaleFontColor: "#b7bcc6",
			barShowStroke: false,
			responsive: true,
			maintainAspectRatio: false,
			multiTooltipTemplate: function(chart) {
				return numeral(chart.value).format('0,0');
			},
			legendTemplate : "<ul class=\"list-inline <%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

		});
		document.getElementById("bar-chart-legend").innerHTML = myBar.generateLegend();



		/* Pie Chart */
		var ctxPie = document.getElementById("pie-chart-canvas").getContext("2d");
		window.myPie= new Chart(ctxPie).Pie(pieData, {
			responsive: true,
			maintainAspectRatio: false,
			legendTemplate : "<ul class=\"list-inline <%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
			animateRotate : false,
			segmentStrokeWidth : 2,
			/* Need to use numeral.js below to convert number to percentage */
			tooltipTemplate: " <%=label%>: <%= numeral(circumference / 6.283).format('(0[.][00]%)') %>"
		});
		document.getElementById("pie-chart-legend").innerHTML = myPie.generateLegend();

		/* Doughnut Chart */
		var ctxDoughnut = document.getElementById("doughnut-chart-canvas").getContext("2d");
		window.myDoughnut= new Chart(ctxDoughnut).Doughnut(doughnutData, {
			responsive: true,
			maintainAspectRatio: false,
			legendTemplate : "<ul class=\"list-inline <%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
			animateRotate : false,
			segmentStrokeWidth : 2,
			/* Need to use numeral.js below to convert number to percentage */
			tooltipTemplate: " <%=label%>: <%= numeral(circumference / 6.283).format('(0[.][00]%)') %>"
		});
		document.getElementById("doughnut-chart-legend").innerHTML = myDoughnut.generateLegend();
	};

	/* jQuery map */
	var visitorData = {AU:3e3,AT:36,AZ:51,BS:7,BH:21,BW:12,BN:11,BG:44,BF:8,BR:560,KH:11,CM:21,CA:15,CF:2,TD:7,CL:199,CN:5745,CO:283,CD:12,CG:11,CR:35,CI:22,HR:59,CY:22,CZ:195,DK:304,DO:50,EC:61,EG:216,SV:21,GQ:14,EE:19,FI:231,FR:12e3,GA:12,GE:11,DE:3305,GH:18,GR:305,GT:40,HN:15,HK:22,HU:132,IS:12,IN:1430,ID:69,IR:337,IQ:84,IE:600,IL:201,IT:2036,JM:13,JP:539,JO:27,KZ:12,KE:32,KR:986,UNDEFINED:0,KW:110,LA:6,LV:23,LB:39,LY:77,LT:35,LU:52,MK:9,MG:8,MW:5,MY:218,ML:9,MT:7,MR:3,MU:9,MX:1004,MD:5,MN:5,ME:3,MA:91,MZ:10,MM:35,NA:11,NP:15,NL:770,NZ:138,NG:206,NO:413,OM:53,PK:17,PA:27,PG:8,PY:17,PE:15,PH:189,PL:2e3,PT:223,QA:126,RO:158,RU:1476,RW:5,SA:43,SN:12,RS:3850,SI:460,ZA:3540,ES:5e3,LK:48,SZ:3,SE:7,CH:16,TW:5,TZ:20,TR:29,UG:23,UA:3,AE:300,GB:12e3,US:35e3};


	$('#world-map').vectorMap({
		map: 'world_mill_en',
		backgroundColor: "none",
		series: {
			regions: [{
				values: visitorData,
				scale: ["#B8E9EE", "#71D4CE"],
				normalizeFunction: 'polynomial'
			}]
		},
		regionStyle: {
			initial: {
				fill: '#F2F2F2',
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

		onRegionLabelShow: function(e, el, code) {
			el.html('<strong>' + el.html() + '<br/>Visitors:<br/>' + numeral(visitorData[code]).format('(0[,][000])') + '</strong>');
		}
	});
});

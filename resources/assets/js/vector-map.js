$(document).ready(function() {
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
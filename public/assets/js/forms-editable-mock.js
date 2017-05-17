$(document).ready(function() {
	'use strict';

	$.mockjaxSettings.responseTime = 500;
	$.mockjax({
		url: '/post',
		response: function(settings) {
			log(settings, this);
		}
	});

	$.mockjax({
		url: '/error',
		status: 400,
		statusText: 'Bad Request',
		response: function(settings) {
			this.responseText = 'Please enter correct value';
			log(settings, this);
		}
	});

	$.mockjax({
		url: '/status',
		status: 500,
		response: function(settings) {
			this.responseText = 'Internal Server Error';
			log(settings, this);
		}
	});

	$.mockjax({
		url: '/groups',
		response: function(settings) {
			this.responseText = [
			 {value: 0, text: 'Guest'},
			 {value: 1, text: 'Service'},
			 {value: 2, text: 'Customer'},
			 {value: 3, text: 'Operator'},
			 {value: 4, text: 'Support'},
			 {value: 5, text: 'Admin'}
		   ];
		   log(settings, this);
		}
	});

	function log(settings, response) {
		$('#console').val(
			"REQUEST:\n" +
			JSON.stringify(settings, null, 2) +
			"RESPONSE: " + response.status + "\n" +
			JSON.stringify(response.responseText, null, 2) +
			"\n" +
			$('#console').val()
		);
		$('#console').scrollTop(0);
	}
});

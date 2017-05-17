$(document).ready(function() {
	'use strict';

	/* ===== Bootstrap Time Picker ==== */
	/* Ref: https://github.com/jdewit/bootstrap-timepicker */

	$('#datepicker1').datepicker({
		todayBtn: "linked",
		calendarWeeks: true,
		autoclose: true,
		keyboardNavigation: false,
		todayHighlight: true
	});

	$('#datepicker2').datepicker({
		minViewMode: 1,
		todayBtn: "linked",
		autoclose: true,
		keyboardNavigation: false
	});

	$('#datepicker3').datepicker({
		startView: 1,
		todayBtn: "linked",
		autoclose: true,
		keyboardNavigation: false
	});

	$('#datepicker4').datepicker({
		startView: 2,
		todayBtn: "linked",
		autoclose: true,
		keyboardNavigation: false
	});

	$('#datepicker5').datepicker({
		keyboardNavigation: false
	});

	$('#datepicker6').datepicker();
});

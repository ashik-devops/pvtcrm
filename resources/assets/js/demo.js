$(document).ready(function() {
	'use strict';
	var $themeSwitcherListItems = $('#color-options li'),
		$themeSwitcherTriggers = $('#color-options li a');

	/* ======= DEMO THEME CONFIG ====== */
	$('#config-trigger').click(function(e){
		e.preventDefault();
		$("#config-panel").toggleClass('config-panel-open');
	});

	// Close the panel by clicking the close button
	$('#config-close').on('click', function() {
		$('#config-trigger').trigger('click');
	});

	//Toggle Top Alert
	$('#demo-topalert-toggle').on('change', function(){
		if ($(this).is(":checked")) {
			$('#top-alert').slideDown();
		} else {
			$('#top-alert').slideUp();
		}
	});

	//Toggle Footer
	$('#demo-footer-toggle').on('change', function(){
		if ($(this).is(":checked")) {
			$('#footer').show();
		} else {
			$('#footer').hide();
		}
	});

	$themeSwitcherTriggers.on('click', function() {
		var $this = $(this),
			$listItem = $this.closest('li'),
			theme = $this.data('style'),
			$body = $('body');

		$themeSwitcherListItems.removeClass('active');
		$body.removeClass('theme-1 theme-2 theme-3 theme-4');
		$body.addClass(theme);
		$listItem.addClass(theme);
	});
});

$(document).ready(function() {
	'use strict';

	var gridViewToggle = $('#drive-grid-toggle'),
		listViewToggle = $('#drive-list-toggle'),
		gridView = $('.drive-grid-view'),
		listView = $('.drive-list-view');

	listView.hide();

	gridViewToggle.on('click', function() {
		gridViewToggle.toggleClass('active', true);
		listViewToggle.toggleClass('active', false);
		gridView.show();
		listView.hide();
	});

	listViewToggle.on('click', function() {
		gridViewToggle.toggleClass('active', false);
		listViewToggle.toggleClass('active', true);
		listView.show();
		gridView.hide();
	});
});

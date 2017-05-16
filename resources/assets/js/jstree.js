$(document).ready(function() {
	'use strict';

	/* ===== jsTree ==== */
	/* Ref: http://www.jstree.com/ */

	// Bootstrap icons
	$('#jstree-1').jstree({
		'core' : {
			'check_callback' : true
		},
		'plugins' : [ 'types', 'dnd' ],
		'types' : {
			'default' : {
				'icon' : 'fa fa-folder'
			},
			'image' : {
				'icon' : 'fa fa-file-image-o'
			},
			'unkown' : {
				'icon' : 'fa fa-file-o'
			},
			'text' : {
				'icon' : 'fa fa-file-text-o'
			},
			'pdf' : {
				'icon' : 'fa fa-file-pdf-o'
			},
			'word' : {
				'icon' : 'fa fa-file-word-o'
			},
			'ppt' : {
				'icon' : 'fa fa-file-powerpoint-o'
			},
			'excel' : {
				'icon' : 'fa fa-file-excel-o'
			},
			'video' : {
				'icon' : 'fa fa-file-video-o'
			},
			'audio' : {
				'icon' : 'fa fa-file-audio-o'
			},
			'code' : {
				'icon' : 'fa fa-file-code-o'
			},
			'screenshot' : {
				'icon' : 'fa fa-file-picture-o'
			},
			'css' : {
				'icon' : 'fa fa-file-code-o'
			},
			'zip' : {
				'icon' : 'fa fa-file-zip-o'
			}
		}
	});

	$("#jstree-2").jstree({
		'core' : {
			'check_callback' : true
		},
		'plugins' : [ 'types', 'dnd' ],
		"types" : {

			"file" : {
				"icon" : "glyphicon glyphicon-file",
				"valid_children" : []
			}
		}
	});
});

$(document).ready(function() {
	'use strict';

	/* ===== X-editable ==== */
	/* Ref: https://github.com/vitalets/x-editable */

	$.fn.editable.defaults.url = '/post';

	$('#example-username1').editable({
		title: 'Enter username',
	});

	$('#example-username2').editable({
		title: 'Enter username',
		mode: 'inline'
	});

	$('#example-comments').editable({
		title: 'Enter comments',
		rows: 10
	});

	$('#example-status').editable({
		value: 2,
		source: [
		{value: 1, text: 'Active'},
		{value: 2, text: 'Blocked'},
		{value: 3, text: 'Deleted'}
		]
	});

	$('#example-dob1').editable({
		format: 'yyyy-mm-dd',
		viewformat: 'dd/mm/yyyy',
		datepicker: {
			weekStart: 1
		}
	});

	$('#example-last_seen').editable({
		format: 'yyyy-mm-dd hh:ii',
		viewformat: 'dd/mm/yyyy hh:ii',
		datetimepicker: {
			weekStart: 1
		}
	});

	$('#example-dob2').editable({
		format: 'yyyy-mm-dd',
		viewformat: 'dd/mm/yyyy',
		datepicker: {
			firstDay: 1
		}
	});

	$('#example-dob3').editable({
		format: 'YYYY-MM-DD',
		viewformat: 'DD.MM.YYYY',
		template: 'D / MMMM / YYYY',
		combodate: {
			minYear: 2000,
			maxYear: 2015,
			minuteStep: 1
		}
	});

	$('#example-email').editable({
		title: 'Enter email'
	});

	$('#example-options').editable({
		value: [2, 3],
		source: [
		{value: 1, text: 'option1'},
		{value: 2, text: 'option2'},
		{value: 3, text: 'option3'}
		]
	});

	$('#example-country1').editable({
		value: 'ru',
		typeahead: {
			name: 'country',
			local: [
			{value: 'ru', tokens: ['Russia']},
			{value: 'gb', tokens: ['Great Britain']},
			{value: 'us', tokens: ['United States']}
			],
			template: function(item) {
				return item.tokens[0] + ' (' + item.value + ')';
			}
		}
	});

	/* Select 2 example */
	//local source
	$('#example-country2').editable({
		source: [
		{id: 'gb', text: 'Great Britain'},
		{id: 'us', text: 'United States'},
		{id: 'ru', text: 'Russia'}
		],
		select2: {
			multiple: true
		}
	});
	//remote source (simple)
	$('#example-country2').editable({
		source: '/getCountries',
		select2: {
			placeholder: 'Select Country',
			minimumInputLength: 1
		}
	});
	//remote source (advanced)
	$('#example-country2').editable({
		select2: {
			placeholder: 'Select Country',
			allowClear: true,
			minimumInputLength: 3,
			id: function (item) {
				return item.CountryId;
			},
			ajax: {

				dataType: 'json',
				data: function (term, page) {
					return { query: term };
				},
				results: function (data, page) {
					return { results: data };
				}
			},
			formatResult: function (item) {
				return item.CountryName;
			},
			formatSelection: function (item) {
				return item.CountryName;
			},
			initSelection: function (element, callback) {
				return $.get('/getCountryById', { query: element.val() }, function (data) {
					callback(data);
				});
			}
		}
	});


	/* =========== Demo ============== */
	 //enable / disable
	 $('#enable').click(function() {
	 	$('#user .editable').editable('toggleDisabled');
	 });

	//editables
	$('#username').editable({

		type: 'text',
		pk: 1,
		name: 'username',
		title: 'Enter username'
	});

	$('#firstname').editable({
		validate: function(value) {
			if($.trim(value) === '') return 'This field is required';
		}
	});

	$('#sex').editable({
		prepend: "not selected",
		source: [
		{value: 1, text: 'Male'},
		{value: 2, text: 'Female'}
		],
		display: function(value, sourceData) {
			var colors = {"": "gray", 1: "green", 2: "blue"},
			elem = $.grep(sourceData, function(o){return o.value == value;});

			if(elem.length) {
				$(this).text(elem[0].text).css("color", colors[value]);
			} else {
				$(this).empty();
			}
		}
	});

	$('#status').editable();

	$('#group').editable({
		showbuttons: false
	});

	$('#vacation').editable({
		datepicker: {
			todayBtn: 'linked'
		}
	});

	$('#dob').editable();

	$('#event').editable({
		placement: 'right',
		combodate: {
			firstItem: 'name'
		}
	});

	$('#meeting_start').editable({
		format: 'yyyy-mm-dd hh:ii',
		viewformat: 'dd/mm/yyyy hh:ii',
		validate: function(v) {
			if(v && v.getDate() == 10) return 'Day cant be 10!';
		},
		datetimepicker: {
			todayBtn: 'linked',
			weekStart: 1
		}
	});

	$('#comments').editable({
		showbuttons: 'bottom'
	});

	$('#note').editable();
	$('#pencil').click(function(e) {
		e.stopPropagation();
		e.preventDefault();
		$('#note').editable('toggle');
	});

	$('#state').editable({
		source: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
	});

	$('#state2').editable({
		value: 'California',
		typeahead: {
			name: 'state',
			local: ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]
		}
	});

	$('#fruits').editable({
		pk: 1,
		limit: 3,
		source: [
		{value: 1, text: 'banana'},
		{value: 2, text: 'peach'},
		{value: 3, text: 'apple'},
		{value: 4, text: 'watermelon'},
		{value: 5, text: 'orange'}
		]
	});

	$('#tags').editable({
		inputclass: 'input-large',
		select2: {
			tags: ['html', 'javascript', 'css', 'ajax'],
			tokenSeparators: [",", " "]
		}
	});

	var countries = [];
	$.each({"BD": "Bangladesh", "BE": "Belgium", "BF": "Burkina Faso", "BG": "Bulgaria", "BA": "Bosnia and Herzegovina", "BB": "Barbados", "WF": "Wallis and Futuna", "BL": "Saint Bartelemey", "BM": "Bermuda", "BN": "Brunei Darussalam", "BO": "Bolivia", "BH": "Bahrain", "BI": "Burundi", "BJ": "Benin", "BT": "Bhutan", "JM": "Jamaica", "BV": "Bouvet Island", "BW": "Botswana", "WS": "Samoa", "BR": "Brazil", "BS": "Bahamas", "JE": "Jersey", "BY": "Belarus", "O1": "Other Country", "LV": "Latvia", "RW": "Rwanda", "RS": "Serbia", "TL": "Timor-Leste", "RE": "Reunion", "LU": "Luxembourg", "TJ": "Tajikistan", "RO": "Romania", "PG": "Papua New Guinea", "GW": "Guinea-Bissau", "GU": "Guam", "GT": "Guatemala", "GS": "South Georgia and the South Sandwich Islands", "GR": "Greece", "GQ": "Equatorial Guinea", "GP": "Guadeloupe", "JP": "Japan", "GY": "Guyana", "GG": "Guernsey", "GF": "French Guiana", "GE": "Georgia", "GD": "Grenada", "GB": "United Kingdom", "GA": "Gabon", "SV": "El Salvador", "GN": "Guinea", "GM": "Gambia", "GL": "Greenland", "GI": "Gibraltar", "GH": "Ghana", "OM": "Oman", "TN": "Tunisia", "JO": "Jordan", "HR": "Croatia", "HT": "Haiti", "HU": "Hungary", "HK": "Hong Kong", "HN": "Honduras", "HM": "Heard Island and McDonald Islands", "VE": "Venezuela", "PR": "Puerto Rico", "PS": "Palestinian Territory", "PW": "Palau", "PT": "Portugal", "SJ": "Svalbard and Jan Mayen", "PY": "Paraguay", "IQ": "Iraq", "PA": "Panama", "PF": "French Polynesia", "BZ": "Belize", "PE": "Peru", "PK": "Pakistan", "PH": "Philippines", "PN": "Pitcairn", "TM": "Turkmenistan", "PL": "Poland", "PM": "Saint Pierre and Miquelon", "ZM": "Zambia", "EH": "Western Sahara", "RU": "Russian Federation", "EE": "Estonia", "EG": "Egypt", "TK": "Tokelau", "ZA": "South Africa", "EC": "Ecuador", "IT": "Italy", "VN": "Vietnam", "SB": "Solomon Islands", "EU": "Europe", "ET": "Ethiopia", "SO": "Somalia", "ZW": "Zimbabwe", "SA": "Saudi Arabia", "ES": "Spain", "ER": "Eritrea", "ME": "Montenegro", "MD": "Moldova, Republic of", "MG": "Madagascar", "MF": "Saint Martin", "MA": "Morocco", "MC": "Monaco", "UZ": "Uzbekistan", "MM": "Myanmar", "ML": "Mali", "MO": "Macao", "MN": "Mongolia", "MH": "Marshall Islands", "MK": "Macedonia", "MU": "Mauritius", "MT": "Malta", "MW": "Malawi", "MV": "Maldives", "MQ": "Martinique", "MP": "Northern Mariana Islands", "MS": "Montserrat", "MR": "Mauritania", "IM": "Isle of Man", "UG": "Uganda", "TZ": "Tanzania, United Republic of", "MY": "Malaysia", "MX": "Mexico", "IL": "Israel", "FR": "France", "IO": "British Indian Ocean Territory", "FX": "France, Metropolitan", "SH": "Saint Helena", "FI": "Finland", "FJ": "Fiji", "FK": "Falkland Islands (Malvinas)", "FM": "Micronesia, Federated States of", "FO": "Faroe Islands", "NI": "Nicaragua", "NL": "Netherlands", "NO": "Norway", "NA": "Namibia", "VU": "Vanuatu", "NC": "New Caledonia", "NE": "Niger", "NF": "Norfolk Island", "NG": "Nigeria", "NZ": "New Zealand", "NP": "Nepal", "NR": "Nauru", "NU": "Niue", "CK": "Cook Islands", "CI": "Cote d'Ivoire", "CH": "Switzerland", "CO": "Colombia", "CN": "China", "CM": "Cameroon", "CL": "Chile", "CC": "Cocos (Keeling) Islands", "CA": "Canada", "CG": "Congo", "CF": "Central African Republic", "CD": "Congo, The Democratic Republic of the", "CZ": "Czech Republic", "CY": "Cyprus", "CX": "Christmas Island", "CR": "Costa Rica", "CV": "Cape Verde", "CU": "Cuba", "SZ": "Swaziland", "SY": "Syrian Arab Republic", "KG": "Kyrgyzstan", "KE": "Kenya", "SR": "Suriname", "KI": "Kiribati", "KH": "Cambodia", "KN": "Saint Kitts and Nevis", "KM": "Comoros", "ST": "Sao Tome and Principe", "SK": "Slovakia", "KR": "Korea, Republic of", "SI": "Slovenia", "KP": "Korea, Democratic People's Republic of", "KW": "Kuwait", "SN": "Senegal", "SM": "San Marino", "SL": "Sierra Leone", "SC": "Seychelles", "KZ": "Kazakhstan", "KY": "Cayman Islands", "SG": "Singapore", "SE": "Sweden", "SD": "Sudan", "DO": "Dominican Republic", "DM": "Dominica", "DJ": "Djibouti", "DK": "Denmark", "VG": "Virgin Islands, British", "DE": "Germany", "YE": "Yemen", "DZ": "Algeria", "US": "United States", "UY": "Uruguay", "YT": "Mayotte", "UM": "United States Minor Outlying Islands", "LB": "Lebanon", "LC": "Saint Lucia", "LA": "Lao People's Democratic Republic", "TV": "Tuvalu", "TW": "Taiwan", "TT": "Trinidad and Tobago", "TR": "Turkey", "LK": "Sri Lanka", "LI": "Liechtenstein", "A1": "Anonymous Proxy", "TO": "Tonga", "LT": "Lithuania", "A2": "Satellite Provider", "LR": "Liberia", "LS": "Lesotho", "TH": "Thailand", "TF": "French Southern Territories", "TG": "Togo", "TD": "Chad", "TC": "Turks and Caicos Islands", "LY": "Libyan Arab Jamahiriya", "VA": "Holy See (Vatican City State)", "VC": "Saint Vincent and the Grenadines", "AE": "United Arab Emirates", "AD": "Andorra", "AG": "Antigua and Barbuda", "AF": "Afghanistan", "AI": "Anguilla", "VI": "Virgin Islands, U.S.", "IS": "Iceland", "IR": "Iran, Islamic Republic of", "AM": "Armenia", "AL": "Albania", "AO": "Angola", "AN": "Netherlands Antilles", "AQ": "Antarctica", "AP": "Asia/Pacific Region", "AS": "American Samoa", "AR": "Argentina", "AU": "Australia", "AT": "Austria", "AW": "Aruba", "IN": "India", "AX": "Aland Islands", "AZ": "Azerbaijan", "IE": "Ireland", "ID": "Indonesia", "UA": "Ukraine", "QA": "Qatar", "MZ": "Mozambique"}, function(k, v) {
		countries.push({id: k, text: v});
	});

	$('#country').editable({
		source: countries,
		select2: {
			width: 200,
			placeholder: 'Select country',
			allowClear: true
		}
	});

	$('#address').editable({
		value: {
			city: "Kyiv",
			street: "Lenina",
			building: "12"
		},
		validate: function(value) {
			if(value.city === '') return 'city is required!';
		},
		display: function(value) {
			if(!value) {
				$(this).empty();
				return;
			}
			var html = '<b>' + $('<div>').text(value.city).html() + '</b>, ' + $('<div>').text(value.street).html() + ' st., bld. ' + $('<div>').text(value.building).html();
			$(this).html(html);
		}
	});

	$('#user .editable').on('hidden', function(e, reason){
		if(reason === 'save' || reason === 'nochange') {
			var $next = $(this).closest('tr').next().find('.editable');
			if($('#autoopen').is(':checked')) {
				setTimeout(function() {
					$next.editable('show');
				}, 300);
			} else {
				$next.focus();
			}
		}
	});

	$('#consoleToggle').click(function() {
		var visible = $('#console').toggle().is(":visible");
		$('#consoleToggle').text(visible ? "Hide Console": "Show Console");
	});
});

$(document).ready(function() {
	'use strict';

	/* Basic Map */
	new GMaps({
		div: '#map-1',
		lat: 51.451573,
		lng: -2.595008,
	});

	/* Map with marker */
	var map2 = new GMaps({
		div: '#map-2',
		lat: 51.451573,
		lng: -2.595008,
	});

	map2.addMarker({
		lat: 51.451573,
		lng: -2.595008,
		title: 'Address',
		infoWindow: {
			content: '<h5 class="subtitle">Your Company Name</h5><p><span class="region">Address line goes here</span><br><span class="postal-code">Postcode</span><br><span class="country-name">Country</span></p>'
		}

	});

	/* Map with overlay */
	var map3 = new GMaps({
		div: '#map-3',
		lat: -12.043333,
		lng: -77.028333,
	});

	map3.drawOverlay({
	  lat: -12.043333,
	  lng: -77.028333,
	  content: '<div class="map-overlay"><address><strong>Twitter, Inc.</strong><br>795 Folsom Ave, Suite 600<br>San Francisco, CA 94107<br><abbr title="Phone">P:</abbr> (123) 456-7890</address></div>'
	});

	/* Map with Polygons */
	var map4 = new GMaps({
		div: '#map-4',
		lat: -12.043333,
		lng: -77.028333,
	});

	var path = [[-12.040397656836609,-77.03373871559225], [-12.040248585302038,-77.03993927003302], [-12.050047116528843,-77.02448169303511],	[-12.044804866577001,-77.02154422636042]];

	var polygon = map4.drawPolygon({
		paths: path, // pre-defined polygon shape
		strokeColor: '#6f7581',
		strokeOpacity: 0.9,
		strokeWeight: 2,
		fillColor: '#6f7581',
		fillOpacity: 0.6
	});

	/* Map Types */
	/* TODO */
	var map5 = new GMaps({
		div: '#map-5',
		lat: -12.043333,
		lng: -77.028333,
		mapType: 'satellite',
		zoom: 17
	});

	/* Map Custom Theme */
	/* TODO */

	var map6 = new GMaps({
		div: '#map-6',
		lat: -12.043333,
		lng: -77.028333,
		options: {
			styles: [{"featureType":"all","elementType":"geometry","stylers":[{"color":"#231f20"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"gamma":0.01},{"lightness":20},{"color":"#d71920"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"saturation":"-100"},{"lightness":"-100"},{"weight":"4.43"},{"gamma":"5.08"},{"color":"#231f20"}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":30},{"saturation":30}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#ede6ce"}]},{"featureType":"landscape","elementType":"labels.text","stylers":[{"color":"#d71920"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"saturation":20}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"lightness":20},{"saturation":-20}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":10},{"saturation":-30}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"saturation":25},{"lightness":25},{"color":"#231f20"}]},{"featureType":"water","elementType":"all","stylers":[{"lightness":-20}]}]
		}
	});

	/* Map Street View */
	var panorama = GMaps.createPanorama({
	  el: '#map-7',
	  lat : 51.454607,
	  lng : -2.628895
	});
});

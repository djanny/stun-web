'use strict';

var jQuery = require('jquery');
var $ = jQuery;
global.jQuery = $;
window.$ = window.jQuery = jQuery;

require('util');
require('jquery.easing');
require('bootstrap');

var L = require('leaflet');
require('leaflet.markercluster');
var wowjs = require('wowjs');
var ltcMap = null;
var restMap = null;
var commonMap = null;

$( document ).ready(function() {
	
	//initGeoLTC();
	//initGeoRest();
	//L.control.locate().addTo(ltcMap);
	
	/*
	ltcMap.on('click', function(ev) {
	    alert(ev.latlng); // ev is an event object (MouseEvent in this case)
	});
	*/
	$('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 60
    });

    $('#topNav').affix({
        offset: {
            top: 200
        }
    });

    $('a.page-scroll').bind('click', function(event) {
        var $ele = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($ele.attr('href')).offset().top - 60)
        }, 1450, 'easeInOutExpo');
        event.preventDefault();
    });
    
    $('.navbar-collapse ul li a').click(function() {
        /* always close responsive nav after click */
        $('.navbar-toggle:visible').click();
    });

    $('#galleryModal').on('show.bs.modal', function (e) {
    	$('#galleryImage').attr("src",$(e.relatedTarget).data("src"));
    });

    $('#del-form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/', //this is the submit URL
            type: 'POST',
            data: $('#del-form').serialize(),
            success: function(data){
                  switch(data) {
                      case 'turnusers_lt':
	          $('#passwords').load('/ #password_table');
                          break;
                      case 'token':
	          $('#tokens').load('/ #token_table');
                          break;
                  }
                  $("#delModal").modal('toggle');
            }
        });
    });

    $('#contact-form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/', //this is the submit URL
            type: 'POST',
            data: $('#contact-form').serialize(),
            success: function(data){
                  $("#alertModal").modal('show');
                  $('#contact-form-message').val("");
                  
            }
        });
    });


    $('#addservice-form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/', //this is the submit URL
            type: 'POST',
            data: $('#addservice-form').serialize(),
            success: function(data){
	$('#tokens-service-url').val("");
	$('#tokens').load('/ #token_table');
	$('#addServiceModal').modal('toggle');
            }
        });
    });

    $('#renewuser-form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/', //this is the submit URL
            type: 'POST',
            data: $('#renewuser-form').serialize(),
            success: function(data){
	$('#passwords').load('/ #password_table');
	$('#renewUserModal').modal('toggle');
            }
        });
    });

    $('#renewservice-form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/', //this is the submit URL
            type: 'POST',
            data: $('#renewservice-form').serialize(),
            success: function(data){
	$('#tokens').load('/ #token_table');
	$('#renewServiceModal').modal('toggle');
            }
        });
    });

    $('#adduser-form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: '/', //this is the submit URL
            type: 'POST',
            data: $('#adduser-form').serialize(),
            success: function(data){
	$('#passwords').load('/ #password_table');
	$('#addUserModal').modal('toggle');
            }
        });
    });

});

$(document).on('click','a[data-toggle=modal], button[data-toggle=modal]', function () {
    // id
    var data_id = '';
    if (typeof $(this).data('id') !== 'undefined') {
      data_id = $(this).data('id');
    }
    $('.row_id').val(data_id);
    // table
    var data_table = '';
    if (typeof $(this).data('table') !== 'undefined') {
      data_table = $(this).data('table');
    }
    $('#table').val(data_table);
    var service_url = '';
    if (typeof $(this).data('service_url') !== 'undefined') {
      service_url = $(this).data('service_url');
    }
    $('.service_url').val(service_url);
  });

(function($) {
    "use strict";
    new wowjs.WOW().init();
})(jQuery);


global.initGeoLeaflet = function() {
	L.Icon.Default.imagePath = '/dev/img/leaflet/';
	ltcMap = L.map('ltc-map-api', {scrollWheelZoom: true,  center: [52.80, 7.5], zoom: 4, maxZoom: 17});
	L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
	    subdomains: ['a','b','c']
	}).addTo(ltcMap);
	
	restMap = L.map('rest-map-api', {scrollWheelZoom: true,  center: [52.80, 7.5], zoom: 4, maxZoom: 17});
	L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
	    subdomains: ['a','b','c']
	}).addTo(restMap);
	
	commonMap = L.map('common-map-api', {scrollWheelZoom: true,  center: [52.80, 7.5], zoom: 4, maxZoom: 17});
	L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
	    subdomains: ['a','b','c']
	}).addTo(commonMap);
}

global.initGeoLTC = function(turnServersJSON) {
	if (turnServersJSON != null) {
		var markers = L.markerClusterGroup({maxClusterRadius: 40, spiderfyOnMaxZoom: false, showCoverageOnHover: false, zoomToBoundsOnClick: false });
		for (var i = 0; i < turnServersJSON.length; i++) {
			var obj = turnServersJSON[i];
			var marker = L.marker(new L.LatLng(obj.position.lat, obj.position.lng), { title: obj.title });
			marker.bindPopup('<h3>' + obj.title +'</h3>' + obj.content);
			markers.addLayer(marker);
		}
		markers.on('clusterclick', function (a) {
			a.layer.spiderfy();
		});
		ltcMap.addLayer(markers);
	}
}

global.initGeoRest = function(turnServersJSON) {
	if (turnServersJSON != null) {
		var markers = L.markerClusterGroup({maxClusterRadius: 40, spiderfyOnMaxZoom: false, showCoverageOnHover: false, zoomToBoundsOnClick: false });
		for (var i = 0; i < turnServersJSON.length; i++) {
			var obj = turnServersJSON[i];
			var marker = L.marker(new L.LatLng(obj.position.lat, obj.position.lng), { title: obj.title });
			marker.bindPopup('<h3>' + obj.title +'</h3>' + obj.content);
			markers.addLayer(marker);
		}
		markers.on('clusterclick', function (a) {
			a.layer.spiderfy();
		});
		restMap.addLayer(markers);
	}
}


global.initGeoCommon = function(turnServersLtcJSON, turnServersRestJSON) {
	var markers = L.markerClusterGroup({maxClusterRadius: 40, spiderfyOnMaxZoom: false, showCoverageOnHover: false, zoomToBoundsOnClick: false });
	if (turnServersLtcJSON != null) {
		for (var i = 0; i < turnServersLtcJSON.length; i++) {
			var obj = turnServersLtcJSON[i];
			var marker = L.marker(new L.LatLng(obj.position.lat, obj.position.lng), { title: obj.title });
			marker.bindPopup('<h3>' + obj.title +'</h3>' + obj.content);
			markers.addLayer(marker);
		}
	}
	if (turnServersRestJSON != null) {
		for (var i = 0; i < turnServersRestJSON.length; i++) {
			var obj = turnServersRestJSON[i];
			var marker = L.marker(new L.LatLng(obj.position.lat, obj.position.lng), { title: obj.title });
			marker.bindPopup('<h3>' + obj.title +'</h3>' + obj.content);
			markers.addLayer(marker);
		}
	}	
	
	markers.on('clusterclick', function (a) {
		a.layer.spiderfy();
	});
	commonMap.addLayer(markers);
}



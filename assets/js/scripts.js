'use strict';

var jQuery = require('jquery');
var $ = jQuery;
global.jQuery = $;
window.$ = window.jQuery = jQuery;

require('util');
require('jquery.easing');
require('bootstrap');
var wowjs = require('wowjs');

(function($) {
    "use strict";

    new wowjs.WOW().init();

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
        //e.preventDefault();
        alert('a'); 
        /*
        $.ajax({
            url: '/', //this is the submit URL
            type: 'POST',
            data: $('#contact-form').serialize(),
            success: function(data){
                  $("#alertModal").modal('show');
                  $('#contact-form-message').val("");
                  
            }
        });
        */
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
    
    
})(jQuery);

global.initMapLTC = function(turnServersJSON) {
    var TURNservers = turnServersJSON;
   
    var myLatLng = {lat: 51.72702830741035, lng: 8.898925500000018};

    var maprest = new google.maps.Map(document.getElementById('rest-map-api'), {
      zoom: 3,
      center: myLatLng,
      styles: [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}]
    });

    function draw() {
      for (var i = 0; i < TURNservers.length; i++) {
        addMarkerWithTimeout(TURNservers[i], i * 200);
      }
    }

    function addMarkerWithTimeout(TURNserver, timeout) {
      window.setTimeout(function() {
        var marker = new google.maps.Marker({
          position: TURNserver.position,
          map: maprest,
          title: TURNserver.title,
          animation: google.maps.Animation.DROP
        });
        marker.addListener('click', function() {
          var infowindow = new google.maps.InfoWindow({
            content: TURNserver.content
          });
          infowindow.open(maprest, marker);
          
        });
      }, timeout);
    }
    draw();
  }

global.initMapREST = function(turnServersJSON) {
    var TURNservers = turnServersJSON;
   
    var myLatLng = {lat: 51.72702830741035, lng: 8.898925500000018};

    var mapltc = new google.maps.Map(document.getElementById('ltc-map-api'), {
      zoom: 3,
      center: myLatLng,
      styles: [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}]
    });

    function draw() {
      for (var i = 0; i < TURNservers.length; i++) {
        addMarkerWithTimeout(TURNservers[i], i * 200);
      }
    }

    function addMarkerWithTimeout(TURNserver, timeout) {
      window.setTimeout(function() {
        var marker = new google.maps.Marker({
          position: TURNserver.position,
          map: mapltc,
          title: TURNserver.title,
          animation: google.maps.Animation.DROP
        });
        marker.addListener('click', function() {
          var infowindow = new google.maps.InfoWindow({
            content: TURNserver.content
          });
          infowindow.open(mapltc, marker);
          
        });
      }, timeout);
    }
    draw();
}

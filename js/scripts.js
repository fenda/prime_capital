(function( root, $, undefined ) {
	"use strict";

	$(function () {
		// properties slider
		if ( $( ".property-slider" ).length ) {
			var propertySlider = $('.property-slider');
			propertySlider.owlCarousel({
				items:1,
				loop:false,
				autoplay:true,
				autoplayTimeout:7000,
				autoplayHoverPause:true,
				nav:true,
				navText:["<i class='fa fa-angle-left' aria-hidden='true'></i>","<i class='fa fa-angle-right' aria-hidden='true'></i>"]
			});
		}
		
		if ( $('.property-slider .owl-stage').children().length < 2 ) {
			$('.property-slider .owl-nav').hide();
		}

		// mobile nav
		$('header .mobile_nav').on('click', function(e){
			e.preventDefault();
			$(this).toggleClass('open');
			$('header .menu').toggleClass('open');
		});

		//header scroll
		var docElem = document.documentElement,
			header = document.querySelector( '.header' ),
			didScroll = false,
			changeHeaderOn = 250;
	 
		function init() {
			window.addEventListener( 'scroll', function() {
				if( !didScroll ) {
					didScroll = true;
					setTimeout( scrollPage, 70 );
				}
			}, false );
		}
	 
		function scrollPage() {
			var sy = scrollY();
			if ( sy >= changeHeaderOn ) {
				$(header).addClass('header--scrolled');
				
			} else {
				$(header).removeClass('header--scrolled');
			}
			didScroll = false;
		}
	 
		function scrollY() {
			return window.pageYOffset || docElem.scrollTop;
		}
		init();

		// slider alternative
		var viewportHeight = $(window).height();
		$('.slider-alternative').css('height', viewportHeight);

	});



} ( this, jQuery ));
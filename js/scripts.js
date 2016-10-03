(function( root, $, undefined ) {
	"use strict";

	$(function () {propertySlider
		var propertySlider = $('.property-slider');
		propertySlider.owlCarousel({
			items:1,
			loop:true,
			autoplay:true,
			autoplayTimeout:7000,
			autoplayHoverPause:true,
			nav:true,
			navText:["<i class='fa fa-angle-left' aria-hidden='true'></i>","<i class='fa fa-angle-right' aria-hidden='true'></i>"]
		});
	});

} ( this, jQuery ));
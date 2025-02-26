jQuery(function() {
	initSlickCarousel();
});


// slick init
function initSlickCarousel() {
	jQuery('.list-testimonials').slick({
		slidesToScroll: 1,
		rows: 0,
		slidesToShow: 2,
		arrows: false,
		autoplay: true,
		responsive: [{
			breakpoint: 1024,
			settings: {
				slidesToShow: 1
			}
		}]
	});
}
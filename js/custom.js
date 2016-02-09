jQuery(document).ready(function () {

	//============================== Style Switcher =========================
	jQuery(document).ready(function () {
		OptionSwitcher.initOptionSwitcher();
    });

    //============================== Slider =========================
	jQuery('#about_banner').flexslider({
		animation: "slide",
		controlNav: true,
		animationSpeed: 600,
		slideshowSpeed: 5000,
		easing: "swing",
		directionNav: true,
		prevText: "",
		nextText: "",
		pauseOnAction: false,
		touch: true,
		start: function () {
			jQuery('.flex-active-slide .about_caption').addClass('show')
		},            //Callback: function(slider) - Fires when the slider loads the first slide
		before: function () {
			jQuery('.flex-active-slide .about_caption').removeClass('show')
		},           //Callback: function(slider) - Fires asynchronously with each slider animation
		after: function (slider) {
			jQuery('.flex-active-slide .about_caption').addClass('show')
		}

	});


	jQuery('#single_banner').flexslider({
		animation: "slide",
		controlNav: true,
		animationSpeed: 600,
		slideshowSpeed: 5000,
		easing: "swing",
		directionNav: false,
		prevText: "",
		nextText: "",
		pauseOnAction: false,
		touch: true,


	});


	if (document.documentElement.clientWidth < 992) {
		jQuery('.carousal_section').flexslider({
			animation: "slide",
			controlNav: true,
			animationSpeed: 600,
			slideshowSpeed: 5000,
			easing: "swing",
			directionNav: false,
			prevText: "",
			nextText: "",
			pauseOnAction: false,
			touch: true,
			minItems: 1,
			maxItems: 1,
			move: 1,
			animationLoop: true,
			direction: "horizontal",
			reverse: false,


		});
	}


	jQuery('.carousal_section').flexslider({
		animation: "slide",
		controlNav: true,
		animationSpeed: 600,
		slideshowSpeed: 5000,
		easing: "swing",
		directionNav: false,
		prevText: "",
		nextText: "",
		pauseOnAction: false,
		touch: true,
		itemWidth: 475,
		minItems: 1,
		maxItems: 2,
		move: 1,
		animationLoop: true,
		direction: "horizontal",
		reverse: false,


	});


	//============================== Tooltip =========================

	$('[data-toggle="tooltip"]').tooltip();


	$("#guiest_id1").selectbox();
	$("#guiest_id2").selectbox();
	$(".option-select").selectbox();


	$('.videoLeft img').click(function () {
		video = '<iframe width="550" height="368" src="' + $(this).attr('data-video') + '"></iframe>';
        $(this).replaceWith(video);
    });

	$('.admission_video img').click(function () {
		video = '<iframe width="769" height="454" src="' + $(this).attr('data-video') + '"></iframe>';
        $(this).replaceWith(video);
    });


	//================================ image popup ==================================

	$('.popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		closeBtnInside: false,
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function (item) {
				return item.el.attr('title') + '';
			}
		}

	});

	//================================ dropdown ==================================

	if ($(window).width() >= 768) {
		$('.inlineMenu li.dropdown').hover(function () {
			$(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn(100);
		}, function () {
			$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
		});
	}

	$(window).resize(function () {
		if ($(window).width() >= 768) {
			$('.inlineMenu li.dropdown').hover(function () {
				$(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn(100);
			}, function () {
				$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
			});
		}
	});


});
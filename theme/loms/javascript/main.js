(function($){
    (function($) {
        "use strict";

		$(document).ready(function() {

            var current_site_url = $(".navbar-area .navbar .navbar-brand").attr("href");

			// Support Moodle MultiLang
			var langValue = $("html").attr("lang");
			$('.multilang').each(function(){
				var currentLangValue = $(this).attr("lang");
				if(langValue != currentLangValue) {
					$(this).addClass('d-none');
				}
			});
			
			if (current_site_url) {
				if (current_site_url != 'http://localhost/moodle/loms/') {
					$('a').each(function () {
						var url = $(this).attr("href");
						if (url.includes("http://localhost/moodle/loms/")) {
							url = url.replace("http://localhost/moodle/loms/", current_site_url);
							$(this).attr('href', url);
						}
					});

					$('img').each(function () {
						var url = $(this).attr("src");
						if (url.includes("http://localhost/moodle/loms/")) {
							url = url.replace("http://localhost/moodle/loms/", current_site_url);
							$(this).attr('src', url);
						}
					});
				}
			}

			if (current_site_url != 'http://localhost:8888/moodle/loms/') {
				$('a').each(function () {
					var url = $(this).attr("href");
					if (url.includes("http://localhost:8888/moodle/loms/")) {
						url = url.replace("http://localhost:8888/moodle/loms/", current_site_url);
						$(this).attr('href', url);
					}
				});

				$('img').each(function () {
					var url = $(this).attr("src");
					if (url.includes("http://localhost:8888/moodle/loms/")) {
						url = url.replace("http://localhost:8888/moodle/loms/", current_site_url);
						$(this).attr('src', url);
					}
				});
			}


			// Sticky, Go To Top JS
			$(window).on('scroll', function() {
				// Header Sticky JS
				if ($(this).scrollTop() >150){  
					$('.navbar-area').addClass("is-sticky");
				}
				else{
					$('.navbar-area').removeClass("is-sticky");
				};

				// Go To Top JS
				var scrolled = $(window).scrollTop();
				if (scrolled > 300) $('.go-top').addClass('active');
				if (scrolled < 300) $('.go-top').removeClass('active');
			});

			// Click Event JS
			$('.go-top').on('click', function() {
				$("html, body").animate({ scrollTop: "0" }, 50);
			});
            
            $("body.role-standard:not(.path-contentbank):not(#page-contentbank) .bottom-region-main-box").each(function() {
                if (!$(this).find(".block").length && !$(this).find(".loms-main").text().trim().length) {
                $(".bottom-region-main-box, .bottom-region-main-box #page-content").css({
                    'padding-top': '0',
                    'margin-top': '0',
                    'padding-bottom': '0px !important',
                });
                $(".loms-main").remove();
                }
            });

            $(".dashbord_nav_list > a:first-child").prepend("<i class='bx bxs-dashboard' ></i>");
            $(".dashbord_nav_list > a:nth-child(2)").prepend("<i class='bx bx-user' ></i>");
            $(".dashbord_nav_list > a:nth-child(3)").prepend("<i class='bx bxs-graduation' ></i>");
            $(".dashbord_nav_list > a:nth-child(4)").prepend("<i class='bx bx-chat' ></i>");
            $(".dashbord_nav_list > a:nth-child(5)").prepend("<i class='bx bx-cog' ></i>");
            $(".dashbord_nav_list > a:nth-child(6)").prepend("<i class='bx bx-log-out' ></i>");
            $(".dashbord_nav_list > a:nth-child(7)").prepend("<i class='bx bx-user-plus' ></i>");
            $(".dashbord_nav_list > a:nth-child(8)").prepend("<i class='bx bx-log-out'></i>");
            $(".dashbord_nav_list > a").each(function() {
            $(this).removeClass("dropdown-item").wrap("<li></li>");
            });
            $(".dashbord_nav_list > li").wrapAll("<ul></ul>");


           // Popup Video JS
			$('.popup-youtube, .popup-vimeo').magnificPopup({
				disableOn: 300,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false,
			});

			// Mean Menu
			$('.mean-menu').meanmenu({
				meanScreenWidth: "991"
			});
			
			$(".popover-region-notifications").click(function() {
				$(".popover-region-notifications").toggleClass('collapsed');
			});

			// Others Option For Responsive JS
			$(".others-option-for-responsive .dot-menu").on("click", function(){
				$(".others-option-for-responsive .container .container").toggleClass("active");
			});

			$(".mobile-responsive-menu .meanmenu-reveal").on("click", function(){
				$(".others-option-for-responsive .container .container").removeClass("active");
			});

        });

		// Top Courses Slide JS
		$('.top-courses-slide').owlCarousel({
			loop: false,
			margin: 15,
			nav: true,
			dots: false,
			autoplay: true,
			smartSpeed: 1000,
			autoplayHoverPause: true,
			navText: [
				"<i class='ri-arrow-left-s-line'></i>",
				"<i class='ri-arrow-right-s-line'></i>",
			],
			responsive: {
				0: {
					items: 1,
				},
				414: {
					items: 1,
				},
				576: {
					items: 2,
				},
				768: {
					items: 2,
				},
				992: {
					items: 4,
				},
				1200: {
					items: 6,
				},
			},
		});
		
		// Selection Courses Slide JS
		$('.selection-courses-slide').owlCarousel({
			loop: false,
			margin: 15,
			nav: true,
			dots: false,
			autoplay: true,
			smartSpeed: 1000,
			autoplayHoverPause: true,
			navText: [
				"<i class='ri-arrow-left-s-line'></i>",
				"<i class='ri-arrow-right-s-line'></i>",
			],
			responsive: {
				0: {
					items: 1,
				},
				414: {
					items: 1,
				},
				576: {
					items: 2,
				},
				768: {
					items: 2,
				},
				992: {
					items: 4,
				},
				1200: {
					items: 6,
				},
			},
		});

		// Instructor Slide JS
		$('.instructor-slide').owlCarousel({
			loop: false,
			margin: 7,
			nav: true,
			dots: false,
			autoplay: true,
			smartSpeed: 1000,
			autoplayHoverPause: true,
			navText: [
				"<i class='ri-arrow-left-s-line'></i>",
				"<i class='ri-arrow-right-s-line'></i>",
			],
			responsive: {
				0: {
					items: 1,
				},
				414: {
					items: 1,
				},
				576: {
					items: 2,
				},
				768: {
					items: 2,
				},
				992: {
					items: 3,
				},
				1200: {
					items: 3,
				},
			},
		});
		
		// Partner Slide JS
		$('.partner-slide').owlCarousel({
			loop: true,
			margin: 30,
			nav: false,
			dots: false,
			autoplay: true,
			autoplayHoverPause: true,
			responsive: {
				0: {
					items: 2,
				},
				414: {
					items: 3,
				},
				576: {
					items: 3,
				},
				768: {
					items: 4,
				},
				992: {
					items: 5,
				},
				1200: {
					items: 6,
				},
			},
		});

		// Testimonials Slider
		$('.testimonials-slide').owlCarousel({
			loop: true,
			margin: 0,
			nav: false,
			mouseDrag: true,
			thumbs: true,
			thumbsPrerendered: true,
			items: 1,
			dots: false,
			autoHeight: true,
			autoplay: true,
			autoplayHoverPause: true,
			navText: [
				"<i class='ri-arrow-left-s-line'></i>",
				"<i class='ri-arrow-right-s-line'></i>",
			],
		});

		// Count Time JS
		function makeTimer() {
			var endTime = new Date("november  30, 2023 17:00:00 PDT");			
			var endTime = (Date.parse(endTime)) / 1000;
			var now = new Date();
			var now = (Date.parse(now) / 1000);
			var timeLeft = endTime - now;
			var days = Math.floor(timeLeft / 86400); 
			var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
			var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
			var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
			if (hours < "10") { hours = "0" + hours; }
			if (minutes < "10") { minutes = "0" + minutes; }
			if (seconds < "10") { seconds = "0" + seconds; }
			$("#days").html(days + "<span>Day</span>");
			$("#hours").html(hours + "<span>Hours</span>");
			$("#minutes").html(minutes + "<span>Minutes</span>");
			$("#seconds").html(seconds + "<span>Seconds</span>");
			
			$("#dayss").html(days + "<span>d</span>");
			$("#hourss").html(hours + "<span>h</span>");
			$("#minutess").html(minutes + "<span>m</span>");
			$("#secondss").html(seconds + "<span>s</span>");
		}
		setInterval(function() { makeTimer(); }, 300);

		// WOW Animation
		if ($('.wow').length) {
			var wow = new WOW({
				boxClass: 'wow',
				animateClass: 'animated', 
				offset: 0, 
				mobile: false, 
				live: true, 
			});
			wow.init();
		}

		// MixItUp Shorting JS
		try {
			var mixer = mixitup('.shorting', {
				controls: {
					toggleDefault: 'none'
				}
			});
		} catch (err) {}

		// Count Show JS
		$(document).ready(function(){
			$(".content").slice(0, 16).show();
			$("#loadMore").on("click", function(e){
			e.preventDefault();
				$(".content:hidden").slice(0, 4).slideDown();
				if($(".content:hidden").length == 0) {
					$("#loadMore").text("No Content").addClass("noContent");
				}
			});
		});
	})(window.jQuery);
}(jQuery));
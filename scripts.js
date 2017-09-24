

(function ($, root, undefined) {
	
	$(function () {
		
		//functionality for pipedrive forms
		$('.pipedriveWebForms').each(function(){
			
			//append a loader to each of these forms (so something is shown as we load)
			var html = '<div class="overlay">';
			html += '<span class="text">Loading Form</span>';
			html += '<i class="icon fa fa-spinner fa-spin fa-3" aria-hidden="true"></i>';	
			html += '</div>';
			
			$(this).prepend(html);
			
			//bind listener to look for the tree modified (so we can cancel our loader)
			$(this).bind('DOMSubtreeModified', function(){
				var $form = $(this);
				var $iframe = $form.find('iframe');
				if($iframe.length != 0){
					
					//after a pause, fade out the overlay
					setTimeout(function(){
						$form.find('.overlay').addClass('inactive');
					}, 1500);
					
				}	
			}); 
		});
		
		
		//toggle functionality for blog categories
		$('.toggle-button').on('click', function(){
			
			var $menu = $(this).siblings('ul.menu');
			if($menu.length != 0){
				$menu.slideToggle('fast');
				$(this).find('.icon').toggleClass('active');
			}
			
		});


        $("a").click(function (e) {
            e.stopPropagation();
        });



        //Additional functionality for blog styling
		function set_blog_heights(){
			var $blogItems = $('.row .blog-article1');
			var maxHeight = 0;
			
			//get max height
			if($blogItems.length != 0){
				
				$blogItems.each(function(){
					var innerHeight = $(this).find('.inner').innerHeight();
					if(innerHeight >= maxHeight){
						maxHeight = innerHeight;
					}
				})
			}
			//set max height
			if(maxHeight != 0){
				$blogItems.each(function(){
					$(this).find('.inner').css('height', 'auto');
					$(this).find('.inner').css('height', maxHeight);
				})
			}
			var $blogItems = $('.row .blog-article2');
			var maxHeight = 0;
			
			//get max height
			if($blogItems.length != 0){
				
				$blogItems.each(function(){
					var innerHeight = $(this).find('.inner').innerHeight();
					if(innerHeight >= maxHeight){
						maxHeight = innerHeight;
					}
				})
			}
			//set max height
			if(maxHeight != 0){
				$blogItems.each(function(){
					$(this).find('.inner').css('height', 'auto');
					$(this).find('.inner').css('height', maxHeight);
				})
			}
			var $blogItems = $('.row .blog-article3');
			var maxHeight = 0;
			
			//get max height
			if($blogItems.length != 0){
				
				$blogItems.each(function(){
					var innerHeight = $(this).find('.inner').innerHeight();
					if(innerHeight >= maxHeight){
						maxHeight = innerHeight;
					}
				})
			}
			//set max height
			if(maxHeight != 0){
				$blogItems.each(function(){
					$(this).find('.inner').css('height', 'auto');
					$(this).find('.inner').css('height', maxHeight);
				})
			}
		}
		set_blog_heights();
	
		//hook into the resize event
		$(window).on('resize', function(){
			set_blog_heights();
		});
		
		

		new Waypoint({
			element: $('.site-content'),
			handler: function(direction) {
				if ( direction == 'down' ) {
					// $('body').addClass('fixed-nav');
					// $( '.site-header' ).css('margin-top', '-120px');
					// $( '.site-header' ).animate({
					// 	'margin-top': 0
					// }, 500);
					$('body').addClass('red-titlebar');
				} else {
					// $( '.site-header' ).animate({
					// 	'margin-top': -120
					// }, 500, function () {
					// 	$( '.site-header' ).css('margin-top', '0');
					// 	$('body').removeClass('fixed-nav');
					// });
					$('body').removeClass('red-titlebar');
				}
			},
			offset: '-100px'
		});

		$('.menu-toggle').click(function() {
			
			if ( $(this).hasClass('open') ) {
				$(this).toggleClass('open');
				$('#mobile-sidebar nav').removeClass('slideInDown').addClass('slideOutDown');
				$('#mobile-sidebar .inner').fadeToggle(300, function() {
					$('#mobile-sidebar').toggleClass('open');
				});
				
			} else {
				$(this).toggleClass('open');
				$('#mobile-sidebar').toggleClass('open');
				$('#mobile-sidebar .inner').fadeToggle(750);
				$('#mobile-sidebar nav').removeClass('slideOutDown').addClass('slideInDown');
			}
		});

		$('#to-top').click(function() {
			$('html,body').animate({
				scrollTop: 0
			}, 1000);
		});

		if ( $('.content-area .testimonials .owl-carousel').length > 0 ) {
			$('.owl-carousel').owlCarousel({
				items: 1,
				loop: true,
				nav: true,
				navText: ['', ''],
				dots: false,
				autoplay: true,
				autoplayHoverPause: true,
				autoplaySpeed: 500,
				navSpeed: 500
			})
		}

		if ( $('.search-icon').length > 0 ) {
			$('.search-icon').click(function() {
				$('.search-box').fadeIn(300);

				$('html,body').animate({
					scrollTop: $('.search-box').offset().top - $('.site-header').outerHeight()
				}, 1000);
			});

			$(document).keyup(function(e) {
				if (e.keyCode == 27) { // escape key maps to keycode `27`
					$('.search-box').fadeOut(300);
				}
			});
		}

		//commented out (interferes with gravity forms pagination)
		// if(window.location.hash) {
			// $('html,body').animate({
				// scrollTop: $('[name=' + window.location.hash.slice(1) +']').offset().top - $('.site-header').outerHeight()
			// }, 1000);
		// }

		$('a[href*="#"]:not([href="#"])').click( function () {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);

				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top - $('.site-header').outerHeight()
					}, 1000);

					return false;
				}
			}
		});



		$("#gotop").click(function(e) {
			$('body,html').animate({scrollTop:0},400);
		});
		$("#gotop").mouseover(function(e) {
			$(this).css("background","url(backtop.png) no-repeat 0px 0px");
		});
		$("#gotop").mouseout(function(e) {
			$(this).css("background","url(backtop.png) no-repeat -70px 0px");
		});
		$(window).scroll(function(e) {
			if($(window).scrollTop()>100)
				$("#gotop").fadeIn(400);
			else
				$("#gotop").fadeOut(400);
		});
		
		
	});
})(jQuery, this);




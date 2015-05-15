$(document).ready(function() {
	/*============================================
	Page Preloader
	==============================================*/
	
	$(window).load(function(){
		//$('#page-loader').fadeOut(500);
                $('#page-loader').slideUp(500);
	})	
        
        $('#start_here_frame').load(function(){
		$('#preview-media2, #preview-media3').fitVids();
		
		setTimeout(function(){
			//openPreview();
			$('#preview-loader2').removeClass('show');
		},1000);
		
	});	
	
	/*============================================
	Background Slider
	==============================================*/
        /*
	var backImages = $('#backgrounds').data('backgrounds').split(',');
	
	$.backstretch(backImages, {
		fade: 500,
		duration: 4000
	});
	*/
	if(!$('#color-overlay').length){$('body').addClass('no-overlay');}
	
	/*============================================
	Navigation Functions
	==============================================*/
	if ($(window).scrollTop()===0){
		$('#main-nav').removeClass('scrolled');
	}
	else{
		$('#main-nav').addClass('scrolled');    
	}
	
	$(window).scroll(function(){
		if ($(window).scrollTop()===0){
			$('#main-nav').removeClass('scrolled');
                        $('#site-nav-wrap').hide();
		}
		else{
			$('#main-nav').addClass('scrolled');    
                        $('#site-nav-wrap').show();
		}
	});
	
	$('#main-nav').css({'top':-100,'opacity':0});
		
	$(window).load(function(){
		$('#main-nav').delay(500).animate({'top':0,'opacity':1},500);
	});	
	/*============================================
	ScrollTo Links
	==============================================*/
	$('a.scrollto').click(function(e){
		$('html,body').scrollTo(this.hash, this.hash, {gap:{y:-120}});
		e.preventDefault();

		if ($('.navbar-collapse').hasClass('in')){
			$('.navbar-collapse').removeClass('in').addClass('collapse');
		}
	});

	/*============================================
	Header Functions
	==============================================*/
	//$('.jumbotron').height($(window).height());
	$('.header-logo').css({'marginTop':$('#main-nav').height()});
	$('.jumbotron .container').addClass('scale-in');
	
	$('.home-slider').flexslider({
		animation: "slide",
		directionNav: false,
		controlNav: false,
		direction: "vertical",
		slideshowSpeed: 3000,
		animationSpeed: 500,
		pauseOnHover:false,
		pauseOnAction:false,
		smoothHeight: true
	});
	
	$(window).scroll( function() {
	   var st = $(this).scrollTop();
	   $('.jumbotron').css({ 'opacity' : (1 - st/250) });
	   //$('.jumbotron .container').css({'top':st});
	});
		
	$(window).load(function(){
		//$('.jumbotron').delay(500).animate({'height':$(window).height()-20},500);
		
		setTimeout(function(){
			$('.jumbotron .container').addClass('in');
		},1000);
	});		
	/*============================================
	About Functions
	==============================================*/
	
	$('#about .collapse').on('show.bs.collapse', function () {
		$(this).prev('.details-btn')
			.find('.fa')
			.removeClass('fa-plus')
			.addClass('fa-minus');
	});
	
	$('#about .collapse').on('hide.bs.collapse', function () {
		$(this).prev('.details-btn')
			.find('.fa')
			.removeClass('fa-minus')
			.addClass('fa-plus');;
	});
	
	$('#about .collapse').on('shown.bs.collapse', function () {
		scrollSpyRefresh();
		waypointsRefresh();
	});
		
	$('#about .collapse').on('hidden.bs.collapse', function () {
		scrollSpyRefresh();
		waypointsRefresh();
	});
	
	/*============================================
	Project thumbs - Masonry
	==============================================*/
	$(window).load(function(){

		$('#projects-container').css({visibility:'visible'});
                
        //$('#projects-container').masonry({
		//	itemSelector: '.project-item',
		//	columnWidth:200,
		//	//isAnimated: true,
		//	//animationOptions: {
		//		//duration: 750,
		//		//easing: 'linear',
		//		//queue: false
		//	//},
		//	isFitWidth: true,
		//	isResizable: true,
		//	gutterWidth: 20
		//});


		scrollSpyRefresh();
		waypointsRefresh();
	});

	/*============================================
	Filter Projects
	==============================================*/
	var filters = [];
	
	$('#filter-works ul').each(function(i){
		filters[i] = {
			name:$(this).data('filter'),
			val : '*'
		};
	});
	
	$('#filter-works a').click(function(e){
		e.preventDefault();
		
		closePreview();
		
		$(this).parents('ul').find('li').removeClass('active');
			
		$(this).parent('li').addClass('active');
			
		//for (var i=0; i<filters.length; i++){
		//	if($(this).data(filters[i].name)){filters[i].val = $(this).data(filters[i].name);}
		//}

		//$('#projects-container').find('.category-videos').fadeOut('slow');
		$('#projects-container').find('.category-videos').remove();
		//var $items = $('#projects-container').find('.category-videos');
		//$('#projects-container').masonry( 'remove', $items );



		getCategoryVideos(this);

		scrollSpyRefresh();
		waypointsRefresh();
	});

	/*============================================
	Project Preview
	==============================================*/
	$(document).on('click', 'article.project-item', function(e){
		e.preventDefault();
		
		if($(this).hasClass('active')){return false;}
		$('.project-item').removeClass('active');
		
		
		var elem =$(this);
		if($(this).hasClass('search-results')){
			$('html,body').scrollTo(0,'#home1',
				{
					gap:{y:-120},
					animation:{
						duration:600
					}
				});
		}else{
			$('html,body').scrollTo(0,'#preview-scroll',
				{
					gap:{y:-120},
					animation:{
						duration:600
					}
			});
		}


		$('#preview-loader').addClass('show');
		
		if($('#project-preview').hasClass('open')){
			closePreview();
			elem.addClass('active');
			setTimeout(function(){
				buildPreview(elem);
			},1000);
		}else{
			elem.addClass('active');
			buildPreview(elem);
		}
	
	});
	
	$('.close-preview').click(function(e){
		e.preventDefault();
		
		closePreview();
	});
	
	function buildPreview(elem){

		var previewElem = $('#project-preview'),
			title = elem.find('.project-title').text(),
			descr = elem.find('.project-description').html();

		/*disabled video title*/
		//previewElem.find('.preview-title').text(title);

		previewElem.find('#preview-details ul').empty();
		elem.find('.project-attributes .newline').each(function(){
			previewElem.find('#preview-details ul').append('<li>'+$(this).html()+'</li>')
		});
		
		previewElem.find('#preview-content').html(descr);
		
		/*----Project with Image-----*/
		if(elem.find('.project-media').data('images')){
			
			var slidesHtml = '<ul class="slides">',
				slides = elem.find('.project-media').data('images').split(',');

			for (var i = 0; i < slides.length; ++i) {
				slidesHtml = slidesHtml + '<li><img src='+slides[i]+' alt=""></li>';
			}
		
			slidesHtml = slidesHtml + '</ul>';
			previewElem.find('#preview-media').addClass('flexslider').html(slidesHtml);
			
			$('#preview-media img').load(function(){
				$('#preview-media.flexslider').flexslider({
					slideshowSpeed: 3000,
					animation: 'slide',
					pauseOnAction: false, 
					pauseOnHover: true, 
					start: function(){
						setTimeout(function(){
							openPreview();
							$('#preview-loader').removeClass('show');
							$(window).trigger('resize');
						},1000)
					}
				});
			});
			
		}

		/*----Project with Video-----*/
		if(elem.find('.project-media').data('video')){

			var media = elem.find('.project-media').data('video');

			if($(elem).hasClass('search-results')){
				openPreview(elem);
				$(".search-results-container .video-from-search").html(media);
				$(".search-results-container .video-from-search").css({display: 'block'});
				$(".search-results-container .video-from-search").css({transform: 'scale(1)'});
				//$(".search-results-container .video-from-search-backing").css({display: 'block'});

				$('.search-results-container .video-from-search iframe').load(function(){
					setTimeout(function(){

						$('#preview-loader').removeClass('show');
					},1000);
				});

			}else {
				previewElem.find('#preview-media').html(media);
				$('#preview-media iframe').load(function () {
					$('#preview-media').fitVids();
					setTimeout(function () {
						openPreview(elem);
						$('#preview-loader').removeClass('show');
					}, 1000);

				});
			}
		}
	}
	
	function openPreview(elem) {
		if($(elem).hasClass('search-results')){
			$(".search-results-container .video-from-search-backing").slideDown(600,function(){
				scrollSpyRefresh();
				waypointsRefresh();
			});
		}else{
			$('#project-preview-wrapper').slideDown(600,function(){
				scrollSpyRefresh();
				waypointsRefresh();
			});
			$('#project-preview').addClass('open');
		}

	}
	
	function closePreview() {

		$('#project-preview-wrapper').slideUp(600,function(){
			if($('#preview-media').hasClass('flexslider')){
				$('#preview-media').removeClass('flexslider')
					.flexslider('destroy');
			}
			
			$('#preview-media').html('');
			scrollSpyRefresh();
			waypointsRefresh();
		});
		$('#project-preview').removeClass('open');
		$('.project-item').removeClass('active');
	}
	
	/*============================================
	Twitter Functions
	==============================================*/
        /*
	var tweetsLength = $('#twitter-slider').data('tweets-length'),
		widgetID = $('#twitter-slider').data('widget-id');
	
	twitterFetcher.fetch(widgetID, 'twitter-slider', tweetsLength, true, false, true, '', false, handleTweets);

	function handleTweets(tweets){
	
		var x = tweets.length,
			n = 0,
			tweetsHtml = '<ul class="slides">';
			
		while(n < x) {
			tweetsHtml += '<li>' + tweets[n] + '</li>';
			n++;
		}
		
		tweetsHtml += '</ul>';
		$('#twitter-slider').html(tweetsHtml);
		
		$('.twitter_reply_icon').html("<i class='fa fa-reply'></i>");
		$('.twitter_retweet_icon').html("<i class='fa fa-retweet'></i>");
		$('.twitter_fav_icon').html("<i class='fa fa-star'></i>");

		$('.twitter_reply_icon').data({'toggle':'tooltip','placement':'bottom'}).attr({'title':'Reply'}).tooltip();
		$('.twitter_retweet_icon').data({'toggle':'tooltip','placement':'bottom'}).attr({'title':'Retweet'}).tooltip();
		$('.twitter_fav_icon').data({'toggle':'tooltip','placement':'bottom'}).attr({'title':'Favorite'}).tooltip();
		$('#twitter-slider').flexslider({
			prevText: '<i class="fa fa-angle-left"></i>',
			nextText: '<i class="fa fa-angle-right"></i>',
			slideshowSpeed: 5000,
			useCSS: true,
			controlNav: false, 
			pauseOnAction: false, 
			pauseOnHover: true,
			smoothHeight: false
		});
		
		
	}
        */
        
        $('#twitter-slider').flexslider({
		prevText: '<i class="fa fa-angle-left"></i>',
		nextText: '<i class="fa fa-angle-right"></i>',
		slideshowSpeed: 5000,
		useCSS: true,
		controlNav: false, 
		pauseOnAction: false, 
		pauseOnHover: true,
		smoothHeight: false
	});
        
	/*============================================
	Testimonials Slider
	==============================================*/
	
		$('#testimonials-slider').flexslider({
			prevText: '<i class="fa fa-angle-left"></i>',
			nextText: '<i class="fa fa-angle-right"></i>',
                        controlNav: false,
			animation: 'slide',
			slideshowSpeed: 5000,
			useCSS: true,
			pauseOnAction: false, 
			pauseOnHover: true,
			smoothHeight: false,
                        slideshow: false,
                        smoothHeight: true
		});
		
	/*============================================
	Resize Functions
	==============================================*/
	$(window).resize(function(){
		$('.jumbotron').height($(window).height()-80);
		$('.header-logo').css({'marginTop':$(window).height()*0.25});
		scrollSpyRefresh();
		waypointsRefresh();
	});

	/*============================================
	Project Loader on IE
	==============================================*/
	$('.no-cssanimations #preview-loader').html('<div class="loader-gif"></div>');
	
	/*============================================
	Tooltips
	==============================================*/
	$("[data-toggle='tooltip']").tooltip();
	
	/*============================================
	Placeholder Detection
	==============================================*/
	if (!Modernizr.input.placeholder) {
		$('#contact-form').addClass('no-placeholder');
	}

	/*============================================
	Scrolling Animations
	==============================================*/
	$('.scrollimation').waypoint(function(){
		$(this).addClass('in');
	},{offset:function(){
			var h = $(window).height();
			if ($('body').height() - $(this).offset().top > h*0.3){
				return h*0.7;
			}else{
				return h;
			}
		}
	});

	/*============================================
	Refresh scrollSpy function
	==============================================*/
	function scrollSpyRefresh(){
		setTimeout(function(){
			$('body').scrollspy('refresh');
		},1000);
	}

	/*============================================
	Refresh waypoints function
	==============================================*/
	function waypointsRefresh(){
		setTimeout(function(){
			$.waypoints('refresh');
		},1000);
	}
        
        $('#cat_menu a').click(function(){
                $('#cat_'+$(this).data('id')).click();
        });

	function getCategoryVideos(that){
		var category_id = $(that).attr('category-id');
		$.ajax({
			url: '/pages/list_category_videos/',
			dataType: 'html',
			type: 'POST',
			data: {category_id: category_id},
			success: function(data)
			{
				var videoTemplate, categoryVideosListTemplate=[], videos, video, videos_qty;
				data = $.parseJSON(data);
				videos = data.videos;
				videos_qty = videos.length;
				for (var index in videos) {
					if (videos.hasOwnProperty(index)) {
						video = videos[index].Video;
						videoTemplate =
							'<article class="project-item web-design apps category'+video.video_id+' y2012 filtered ">'+
						'<a href="#">'+
						'<img class="img-responsive project-thumb" src="'+video.video_img+'"  alt="'+video.video_name+'">'+

						'<div class="details">'+
						'<small>'+video.video_name+'</small>'+
						'</div>'+
						'</a>'+
						'<div class="sr-only">'+
						'<div class="project-media" data-video=\'<iframe src="http://player.vimeo.com/video/'+video.video_id+'?autoplay=1" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>\'></div>'+
						'</div>'+
						'</article>';

					}
					categoryVideosListTemplate.push(videoTemplate);
				}
				categoryVideosListTemplate = categoryVideosListTemplate.slice().join().replace(/,/g , " ");
				categoryVideosListTemplate = '<div class="category-videos">'+categoryVideosListTemplate+'</div>';

				$('.filter-results span').html(videos_qty+'');
				$('.filter-results').slideDown();
				$('#projects-container').append(categoryVideosListTemplate);

				setTimeout(function() {
					$('#projects-container').find('.category-videos .project-item').each(function(){
						$(this).addClass('masonry-brick');
					});
				}, 200);
			}

		});
	}

	$(document).on('keypress', '#search_txt', function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$('#search_link').click();
			$('html,body').scrollTo(0,'#home1',
				{
					gap:{y:-120},
					animation:{
						duration:600
					}
				});
		}
	});

	$(document).on('click', '#search_link', function(){
		sentAjaxData();
	});

	function sentAjaxData(){
		if($('#search_txt').val() != ''){
			var searchParam = $('#search_txt').val();
			$.ajax({
				type:'POST',
				async: true,
				cache: false,
				data:{searchQuery : searchParam},
				url: 'video/search/',
				success: function(data) {
					$('.search-results').html(data);
					$('#search-results').css('display', 'block');
				}
			});
		}
	}

	$(document).on('click', '#main-nav #cat_menu', function(){
		$('.search-results-container').css('display', 'none');
	});

	$(document).on('click', '.search-results-container .close-search-results', function(){
		$('.video-from-search-backing').slideUp(500);
		$('.video-from-search').slideUp(500);
		$('.video-from-search-backing .play.rounded-box.state-paused').click();
		$('#search-results').slideUp(500);

	});

});	
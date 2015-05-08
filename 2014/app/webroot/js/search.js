(function ($) {

    $(document).on('keypress', '#search_txt', function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $('#search_link').click();
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
                }
            });
        }
    }

    var videoSRC;
    $(document).on('click', '.search-results-container a', function(){
        $(".search-results-container .video-from-search").css('display', 'block');
            videoSRC = $(this).find('.details .video-url').attr('video-url');
            videoSRC = videoSRC.split('vimeo.com/')[1];
        $(".search-results-container .video-from-search").html(
        '<iframe height="100%" src="http://player.vimeo.com/video/'+videoSRC+'?autoplay=1" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" ></iframe>'
        );

    });

    $(document).on('click', '#main-nav #cat_menu', function(){
        $('.search-results-container').css('display', 'none');
    });



})(jQuery);


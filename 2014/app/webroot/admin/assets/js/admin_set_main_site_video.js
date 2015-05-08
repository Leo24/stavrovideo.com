$(document).ready(function(){

        $(document).on('click', 'ol#toc input.set-main-video', function(){set_main_video(this)});
        $(document).on('click', '.widget-body input.remove-main-video', function(){remove_main_video(this)});

        function set_main_video(that){
                var video_id = $(that).parent().attr('video_id');
                $.ajax({
                        url: '/2014/admin/setmainvideo/set_main_video/',
                        dataType: 'html',
                        type: 'POST',
                        data: {video_id: video_id},
                        success: function(data)
                        {
                                data = $.parseJSON(data);
                                var video = data.result.Video;
                                $('.main-video').remove();
                                $('.video-list').css('display', 'block').append(
                               '<div class="main-video">'+
                               '<p class="site-main-video"><span>site main video:</span></p>'+
                                '<img src="'+video.video_img+'" title="'+video.video_name+'" alt="'+video.video_name+'" class="thumbnail thumbnail_lg_wide"/>'+
                                '<p><span video_id="'+video.video_id+'">'+video.video_name+'</span></p>'+
                                '<div class="remove-main-video-input">'+
                                '<input class="remove-main-video" type="button" value="Remove Main Video">'+
                                '</div>'+
                                '</div>'
                                );

                                $(that).parents().eq(2).find('ul li').each(function(){
                                     if(($(this).find('input').attr('checked', true)).length != 0){
                                             $(this).find('input').attr('checked', false);
                                     }
                                     if($(this).attr('video_id') == video.video_id){
                                             $(this).find('input').attr('checked', true);
                                     }

                                    });

                                alertify.log( 'Main Video Added Successfully');
                        },
                        beforeSend: function( xhr ) {
                                $('#video_body').css('opacity', '0.2');
                                //$('#layered_ajax_loader').show();
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                                alertify.log( 'There is some error', 'error' );
                        }
                });
        }


        function remove_main_video(that){
                $.ajax({
                        url: '/2014/admin/setmainvideo/remove_main_video/',
                        dataType: 'html',
                        type: 'POST',
                        //data: {param: params},
                        success: function(data)
                        {
                                data = $.parseJSON(data);
                                alertify.log(data.result);
                                $(that).parents().eq(3).find('.video-container-for-main-video li').each(function(){
                                        if(($(this).find('input').attr('checked', true)).length!=0){
                                                $(this).find('input').attr('checked', false);
                                        }
                                });
                                $('.widget-body .main-video').remove();
                                $('.widget-body  .remove-main-video').remove();
                        },
                        beforeSend: function( xhr ) {
                                $('#video_body').css('opacity', '0.2');
                                //$('#layered_ajax_loader').show();
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                                alertify.log( 'Please, set main video before remove it', 'error' );
                        }
                });
        }

});
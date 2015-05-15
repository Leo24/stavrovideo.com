$(document).ready(function(){

    $(function() {
        $( "#sortable" ).sortable({
            placeholder: 'placeholder-video',
            helper: 'clone',
            revert: true,
            stop: function(event, ui){
                changeVideoOrder(event, ui);
            }
        });
    });

    function changeVideoOrder(event, ui){
        var reOrderedVideo = {}, reOrderedVideos  = [];

        $('#sortable li').each(function(){
            reOrderedVideo = {
                line_id:  $(this).attr('line_id'),
                video_order_in_category: $(this).index()
            };
            reOrderedVideos.push(reOrderedVideo);
        });
        $.ajax({
            url: '/admin/videocategories/change_video_order_in_category/',
            dataType: 'html',
            type: 'POST',
            data: {reOrderedVideos: reOrderedVideos },
            success: function(data)
            {
                var reOrderedVideos, line_id, element, element_index;
                data = $.parseJSON(data);
                reOrderedVideos = data.result;
                for (var index in reOrderedVideos) {
                    if (reOrderedVideos.hasOwnProperty(index)) {
                        line_id = reOrderedVideos[index].line_id;
                        element_index = reOrderedVideos[index].video_order_in_category;
                        element = $('#sortable li[line_id='+line_id+']');
                        $(element).index(element_index);
                        $(element).find('span.video-order').text(element_index);
                    }
                    $('#sortable').css('opacity', '1');
                }
            },
            beforeSend: function( xhr ) {
                $('#sortable').css('opacity', '0.2');
                //$('#layered_ajax_loader').show();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alertify.log( 'There is some error', 'error' );
            }
        });


    }

});
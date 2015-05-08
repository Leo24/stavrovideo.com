$(document).ready(function(){
        $(document).on('click', '.pagination li a', function() {
                if(!$(this).parents('li').hasClass('active') && !$(this).parents('li').hasClass('disabled')) {
                        loadVideo($(this).data('page'));
                }
                return false;
        }).on("click", ".add-category .add-category", function(){
                addCategory($(this).parents('tr').data('id'));
        }).on('change', 'select.category-video', function(){
                var self = this;
                changeVideoCategory($(this).parents('tr').data('id'), $(this).find(':selected').attr('value'), self);
                }).on("click", ".select-category .remove-category", function(){
                var self = this;
                removeCategory($(this).parents('tr').data('id'), self);
            });



        //    on('change', '#category-video', function() {
        //        changeVideoCategory($(this).parents('tr').data('id'), $(this).val());
        //}).on('change', '#order_video', function() {
        //        changeVideoOrder($(this).parents('tr').data('id'), $(this).val());
        //}).on('change', '#start_video', function() {
        //        changeVideoStart($(this).parents('tr').data('id'), $(this).is(':checked') );
        //});
        
        function loadVideo(page) {
                $.ajax({
        		url: '/2014/admin/videos/get_video_ajax/'+page,
        		dataType: 'html',
        		type: 'GET',
                        //data: params,
        		success: function(data)
        		{
                                data = $.parseJSON(data);
                                $('#video_body').html(data.html);
                                $('#video_paging').html(data.paging);
                                $('html,body').animate({scrollTop: ($('#video_body').offset().top-50)},'slow');
                                $('#video_body').css('opacity', '1.0');
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
        
        function changeVideoCategory(video, category_id, self) {
                var line_id, attr;
                $(self).children().each(function(){
                        attr = $(this).attr('line_id');
                        if (typeof attr !== typeof undefined && attr !== false) {
                                line_id = attr;
                        }
                });
                if(typeof line_id  === typeof undefined){
                        line_id = 0;
                }
                $.ajax({
        		url: '/2014/admin/videos/change_video_category/'+video,
        		dataType: 'html',
        		type: 'POST',
                        data: { category_id: category_id,
                                line_id: line_id
                        },
        		success: function(data)
        		{
                        data = $.parseJSON(data);
                        $(self).attr('line_id', data.result.line_id);
                        $('#video_body').css('opacity', '1.0');
                                if(data.result) {
                                        alertify.log( 'Action was performed successfully!', 'success' );
                                } else {
                                        alertify.log( 'There is some error', 'error' );
                                }
        		},
                        beforeSend: function( xhr ) {
                                $('#video_body').css('opacity', '0.2');
                                //$('#layered_ajax_loader').show();
                        },
        		error: function(XMLHttpRequest, textStatus, errorThrown){
        		        $('#video_body').css('opacity', '1.0');
        			alertify.log( 'There is some error', 'error' );
        		}
        	});
        }
        
        function changeVideoOrder(video, order) {
                $.ajax({
        		url: '/2014/admin/videos/change_video_order/'+video,
        		dataType: 'html',
        		type: 'POST',
                        data: {order: order},
        		success: function(data)
        		{
                                data = $.parseJSON(data);
                                $('#video_body').css('opacity', '1.0');
                                if(data.result) {
                                        alertify.log( 'Action was performed successfully!', 'success' );
                                } else {
                                        alertify.log( data.error, 'error' );
                                }
        		},
                        beforeSend: function( xhr ) {
                                $('#video_body').css('opacity', '0.2');
                                //$('#layered_ajax_loader').show();
                        },
        		error: function(XMLHttpRequest, textStatus, errorThrown){
        		        $('#video_body').css('opacity', '1.0');
        			alertify.log( 'There is some error', 'error' );
        		}
        	});
        }
        
        function changeVideoStart(video, checked) {
                $.ajax({
        		url: '/2014/admin/videos/change_video_start/'+video,
        		dataType: 'html',
        		type: 'POST',
                        data: {checked: checked},
        		success: function(data)
        		{
                                data = $.parseJSON(data);
                                $('#video_body').css('opacity', '1.0');
                                if(data.result) {
                                        alertify.log( 'Action was performed successfully!', 'success' );
                                        $('#category-video').val(0);
                                } else {
                                        alertify.log( 'There is some error', 'error' );
                                }
        		},
                        beforeSend: function( xhr ) {
                                $('#video_body').css('opacity', '0.2');
                                //$('#layered_ajax_loader').show();
                        },
        		error: function(XMLHttpRequest, textStatus, errorThrown){
        		        $('#video_body').css('opacity', '1.0');
        			alertify.log( 'There is some error', 'error' );
        		}
        	});
        }

        function addCategory(video){
                $.ajax({
                        url: '/2014/admin/videos/get_list_categories/'+video,
                        dataType: 'html',
                        type: 'POST',
                        data: {},
                        success: function(data)
                        {
                                data = $.parseJSON(data);
                                var videoID, category, option, categories;
                                var options = [];
                                videoID = data.video_id;
                                categories = data.categories;
                                for (var index in categories) {
                                        if (categories.hasOwnProperty(index)) {
                                                category = categories[index].Category;
                                                option = '<option value="'+category.categoryId+'">'+category.name+'</option>';
                                                options.push(option);
                                        }
                                }
                                $('#'+videoID+'.select-category-wrapper').append(
                                    '<div class="select-category">'+
                                    '<select class="category-video">' +
                                    '<option selected="selected">Select category</option>'
                                    +options+
                                    '</select>'+
                                    '<button class="remove-category">Remove category</button>'+
                                    '</div>'

                                );
                                $('#video_body').css('opacity', '1');
                        },
                        beforeSend: function( xhr ) {
                                $('#video_body').css('opacity', '0.2');
                                //$('#layered_ajax_loader').show();
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                                $('#video_body').css('opacity', '1.0');
                                alertify.log( 'There is some error', 'error' );
                        }
                });
        }

        function removeCategory(video, self){
                var line_id, attr;
                $(self).parents().eq(0).find('.category-video').each(function(){
                        attr = $(this).attr('line_id');
                        if (typeof attr !== typeof undefined && attr !== false) {
                                line_id = attr;
                        }
                });
                if(typeof line_id  === typeof undefined){
                        line_id = 0;
                }
                $.ajax({
                        url: '/2014/admin/videos/remove_video_category/'+video,
                        dataType: 'html',
                        type: 'POST',
                        data: { line_id: line_id },
                        success: function(data)
                        {
                                data = $.parseJSON(data);
                                if(data.result) {
                                        alertify.log( 'Action was performed successfully!', 'success' );
                                        $(self).parents().eq(0).remove();
                                } else {
                                        alertify.log( 'There is some error', 'error' );
                                }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                                $('#video_body').css('opacity', '1.0');
                                alertify.log( 'There is some error', 'error' );
                        }
                });
        }



});
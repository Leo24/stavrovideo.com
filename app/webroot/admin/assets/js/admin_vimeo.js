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
        }).on("click", ".update-video-list form input", function(){
                    updateVideoList(this);
        }).on("keyup", ".widget-body .search-for-video input.search", function(){
                var self = this;
                findVideo(self);
        });
            //.on("click",".pre-search-list .search-list li", function(){
            //    var self = this;
            //    getSingleVideo(self);
        //});





        //    on('change', '#category-video', function() {
        //        changeVideoCategory($(this).parents('tr').data('id'), $(this).val());
        //}).on('change', '#order_video', function() {
        //        changeVideoOrder($(this).parents('tr').data('id'), $(this).val());
        //}).on('change', '#start_video', function() {
        //        changeVideoStart($(this).parents('tr').data('id'), $(this).is(':checked') );
        //});
        
        function loadVideo(page) {
                $.ajax({
        		url: '/admin/videos/get_video_ajax/'+page,
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
        		url: '/admin/videos/change_video_category/'+video,
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
        		url: '/admin/videos/change_video_order/'+video,
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
        		url: '/admin/videos/change_video_start/'+video,
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
                        url: '/admin/videos/get_list_categories/'+video,
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
                        url: '/admin/videos/remove_video_category/'+video,
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

        function updateVideoList(that){
                $(that).hide();
                $(that).parents().eq(1).find('.update-video-list-load').css('display', 'block');
                $('#light').css('display', 'block');
                $('#fade').css('display', 'block');
                $.ajax({
                        url: '/admin/videos/update_video_list',
                        dataType: 'html',
                        type: 'POST',
                        //data: { updateVideoList: 'updateVideoList' },
                        success: function(data)
                        {
                                data = $.parseJSON(data);
                                if(data.updated) {
                                        $(that).show();
                                        $('#light').css('display', 'none');
                                        $('#fade').css('display', 'none');
                                        //$(that).parents().eq(1).find('.update-video-list-load').css('display', 'none');
                                        alertify.log( data.updated, 'success' );
                                } else if(data.upToDate){
                                        $(that).show();
                                        $('#light').css('display', 'none');
                                        $('#fade').css('display', 'none');
                                        //$(that).parents().eq(1).find('.update-video-list-load').css('display', 'none');
                                        alertify.log( data.upToDate, 'success' );
                                }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                                $('#video_body').css('opacity', '1.0');
                                $(that).show();
                                $('#light').css('display', 'none');
                                $('#fade').css('display', 'none');
                                //$(that).parents().eq(1).find('.update-video-list-load').css('display', 'none');
                                alertify.log( 'There is some error', 'error' );
                        }
                });
        }



        function findVideo(self){
                var searchQuery= $(self).attr('value');
                if(searchQuery.length > 2){
                        $.ajax({
                                url: 'http://stavrovideo.com/admin/videoSearch/preSearchList',
                                dataType: 'html',
                                type: 'POST',
                                data: { searchQuery: searchQuery },
                                success: function(data)

                                {

                                        data = $.parseJSON(data);
                                        $(self).parents().eq(1).find('.pre-search-list').children().remove();
                                        var preSearchResultTemplate = [];

                                        var searchResults = data[0], searchResult;
                                        var length = searchResults.length;
                                        if(length == 0){
                                                preSearchResultTemplate.push(
                                                    '<li><span>No Videos for "'+searchQuery+'"</span></li>');

                                        }else{
                                                for(var i = 0; i < length; i++){
                                                        searchResult = searchResults[i];
                                                        preSearchResultTemplate.push(
                                                            '<li video_id = "'+searchResult.video_id+'"><span><a href="http://stavrovideo.com/admin/videoSearch/getSingleVideo/video/'+searchResult.video_id+'">'+searchResult.video_name+'</a></span></li>');
                                                }
                                        }


                                        preSearchResultTemplate = preSearchResultTemplate.slice().join().replace(/,/g , " ");
                                        $(self).parents().eq(1).find('.pre-search-list').append('<ul class="search-list">'+preSearchResultTemplate+'</ul>');

                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown){
                                //        $('#video_body').css('opacity', '1.0');
                                //        $(that).show();
                                //        $('#light').css('display', 'none');
                                //        $('#fade').css('display', 'none');
                                //        //$(that).parents().eq(1).find('.update-video-list-load').css('display', 'none');
                                //        alertify.log( 'There is some error', 'error' );
                                }
                        });

                }else{
                        $(self).parents().eq(1).find('.pre-search-list').children().remove();
                }

                //return false;
        }

        function getSingleVideo(self){
            var video_id = $(self).attr('video_id');
                $.ajax({
                        url: 'getSingleVideo',
                        dataType: 'html',
                        type: 'POST',
                        data: { video_id: video_id},
                        success: function(data)

                        {

                                data = $.parseJSON(data);


                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                                //        $('#video_body').css('opacity', '1.0');
                                //        $(that).show();
                                //        $('#light').css('display', 'none');
                                //        $('#fade').css('display', 'none');
                                //        //$(that).parents().eq(1).find('.update-video-list-load').css('display', 'none');
                                //        alertify.log( 'There is some error', 'error' );
                        }
                });

        }


});
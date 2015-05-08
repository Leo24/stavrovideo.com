var gb_page = 1;

$(window).bind( 'hashchange', function(e) {
    if($.bbq.getState('tab')){
        if($.bbq.getState('tab') == 'cat'){
            $('.wrap').hide();
            $('#cat_wraper').show();
            $('#admin_menu span a').removeClass('active');
            $('#cat a').addClass('active');
            getVideosList(1);
        }else if($.bbq.getState('tab') == 'gb'){
            $('.wrap').hide();
            $('#gb_wraper').show();
            $('#admin_menu span a').removeClass('active');
            $('#gb a').addClass('active');
            getGBList(1);
        }
    }
    
    getVideosList(1);
    getCategoriesList();
})

$(document).ready(function(){
    $(window).trigger( 'hashchange' );
	$('#left_door, #right_door').css({ width: '109px' });
	//$(".accordion h3:first").addClass("active");
	//$(".accordion .p:not(:first)").hide();
    $(".accordion .p").hide();

	$(".accordion h3").click(function(){
		$(this).next(".p").slideToggle("slow")
		.siblings(".p:visible").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings("h3").removeClass("active");
	});
    
    $('#add_video').click(function(){
        $('#add_video_frm').submit();
        return false;
    });
    
    $(document).on('click', '#pagination a', function(){
        getVideosList($(this).attr('data-page'));
        return false;
    }).on('change', '.video_category', function(){
        changeVideosCat($(this));
        return false;
    }).on('change', 'input[name="clients_video[]"]', function(){
        changeClientVideo($(this));
        return false;
    }).on('change', 'input[name="start_here"]', function(){
        changeStartVideo($(this));
        return false;
    }).on('change', 'input[name="about_us"]', function(){
        changeAboutVideo($(this));
        return false;
    }).on('change', '.video_order', function(){
        changeVideosOrder($(this));
        return false;
    }).on('click', '#admin_menu span a', function(){
        if($(this).parent().attr('id') == 'blog'){
            window.location = $(this).attr('href');
        }else if(!$(this).hasClass('active')){
            $('.wrap').hide();
            $('#'+$(this).parent().attr('id')+'_wraper').show();
            $('#admin_menu span a').removeClass('active');
            $(this).addClass('active');
            getVideosList(1);
            getGBList(1);
        }
    }).on('click', '.del_cat', function(){
        var cat_id = $(this).attr('data-id');
        jConfirm('Are you sure to want delete this category?', '', function(r) {
            if(r){
                delCategory(cat_id);
            }
        });
        return false;
    }).on('click', '#add_cat', function(){
        addCategory();
        return false;
    }).on('click', '.gb_msg_menu a', function(){
        var msg_id = $(this).parent().attr('data-id');
        if($(this).hasClass('proved')){
            getGBListProved(gb_page, msg_id);
        }else if($(this).hasClass('del')){
            jConfirm('Are you sure to want delete this message?', '', function(r) {
                if(r){
                    getGBListDel(msg_id);
                }
            });
        }
        return false;
    });
    
    $( "ul.droptrue" ).sortable({
	   connectWith: "ul",
       stop: function(event, ui) {
        var li = [];
        $('#sortable1 li').each(function(){
            li.push($(this).val());
        });
        console.log('li', li);
        $.ajax({type: "POST",cashe:false,url: "categoryOrder.php",data: {
                    action: 'order',
                    category: li
            },
                success: function(content)
                {
                             
                },beforeSend:function()
                {
                    $('#sortable1').css('opacity', '0.5');	
                    $( "ul.droptrue" ).sortable("disable");										     				
                },complete:function(){
                    $('#sortable1').css('opacity', '1.0');
                    $( "ul.droptrue" ).sortable("enable");
                }
            });
       }
	});
});

function getVideosList(page){
    if($('#videos_list').is(':visible')){
        $.ajax({type: "GET",cashe:false,url: "getVimeoUserVideoAjax.php",data: {
            page: page
    },
        success: function(content)
        {
            $('#videos_list').html(content);
            var the_obj = $('.vm_video .title').ThreeDots({
				max_rows: 1
			});            
        },beforeSend:function()
        {
            $('#videos_list').css('opacity', '0.5');											     				
        },complete:function(){
            $('#videos_list').css('opacity', '1.0');
        }
    });
    }
}

function changeVideosCat(elem){
    $.ajax({type: "POST",cashe:false,url: "setVimeoVideoCat.php",data: {
            video_id: elem.attr('data-video'),
            cat_id: elem.val()
    },
        success: function(content)
        {
                     
        },beforeSend:function()
        {
            $('#v'+elem.attr('data-video')).show();											     				
        },complete:function(){
            $('#v'+elem.attr('data-video')).hide();
        }
    });
}

function changeVideosOrder(elem){
    $.ajax({type: "POST",cashe:false,url: "setVimeoVideoCat.php",data: {
            action: 'order',
            video_id: elem.attr('data-video'),
            num: elem.val()
    },
        success: function(content)
        {
                     
        },beforeSend:function()
        {
            $('#v'+elem.attr('data-video')).show();											     				
        },complete:function(){
            $('#v'+elem.attr('data-video')).hide();
        }
    });
}

function changeClientVideo(elem){
    $.ajax({type: "POST",cashe:false,url: "setVimeoVideoCat.php",data: {
            action: 'client',
            video_id: elem.val(),
            set_video: elem.is(':checked')
    },
        success: function(content)
        {
                     
        },beforeSend:function()
        {
            $('#v'+elem.val()).show();											     				
        },complete:function(){
            $('#v'+elem.val()).hide();
        }
    });
}

function changeStartVideo(elem){
    $.ajax({type: "POST",cashe:false,url: "setVimeoVideoCat.php",data: {
            action: 'start',
            video_id: elem.val(),
            set_video: elem.is(':checked')
    },
        success: function(content)
        {
                     
        },beforeSend:function()
        {
            $('#v'+elem.val()).show();											     				
        },complete:function(){
            $('#v'+elem.val()).hide();
        }
    });
}

function changeAboutVideo(elem){
    $.ajax({type: "POST",cashe:false,url: "setVimeoVideoCat.php",data: {
            action: 'about',
            video_id: elem.val(),
            set_video: elem.is(':checked')
    },
        success: function(content)
        {
                     
        },beforeSend:function()
        {
            $('#v'+elem.val()).show();											     				
        },complete:function(){
            $('#v'+elem.val()).hide();
        }
    });
}

function getCategoriesList(){
    
    $.ajax({type: "GET",cashe:false,url: "categoryOrder.php",data: {
            action: 'get'
    },
        success: function(content)
        {
            $('#sort_cat_wraper').html(content);
            
            
            $( "ul.droptrue" ).sortable({
        	   connectWith: "ul",
               stop: function(event, ui) {
                var li = [];
                $('#sortable1 li').each(function(){
                    li.push($(this).val());
                });
                
                $.ajax({type: "POST",cashe:false,url: "categoryOrder.php",data: {
                            action: 'order',
                            category: li
                    },
                        success: function(content)
                        {
                                     
                        },beforeSend:function()
                        {
                            $('#sortable1').css('opacity', '0.5');	
                            $( "ul.droptrue" ).sortable("disable");										     				
                        },complete:function(){
                            $('#sortable1').css('opacity', '1.0');
                            $( "ul.droptrue" ).sortable("enable");
                        }
                    });
               }
        	});
            
            
        },beforeSend:function()
        {
            $('#sort_cat_wraper').css('opacity', '0.5');											     				
        },complete:function(){
            $('#sort_cat_wraper').css('opacity', '1.0');
        }
    });
}

function delCategory(cat_id){
    
    $.ajax({type: "GET",cashe:false,url: "categoryOrder.php",data: {
            action: 'delete',
            cat_id: cat_id
    },
        success: function(content)
        {
            getCategoriesList();
        },beforeSend:function()
        {
            $('#sort_cat_wraper').css('opacity', '0.5');											     				
        }
    });
}

function addCategory(){
    if($('#cat_name').val() != ""){
        $.ajax({type: "GET",cashe:false,url: "categoryOrder.php",data: {
                action: 'add',
                cat_name: $('#cat_name').val()
        },
            success: function()
            {
                $('#cat_name').val("");
                getCategoriesList();
            }
        });
    }
}

function getGBList(page){
    if($('#gb_list').is(':visible')){
        $.ajax({type: "GET",cashe:false,url: "gb.php",data: {
            action: 'load',
            page: page
    },
        success: function(content)
        {
            $('#gb_list').html(content);
        },beforeSend:function()
        {
            $('#gb_list').css('opacity', '0.5');											     				
        },complete:function(){
            $('#gb_list').css('opacity', '1.0');
        }
    });
    }
    
    return false;
}

function getGBListProved(page, msg_id){
    gb_page = page;
    if($('#gb_list').is(':visible')){
        $.ajax({type: "GET",cashe:false,url: "gb.php",data: {
            action: 'proved',
            msg_id: msg_id
    },
        success: function(content)
        {
            getGBList(page);
        },beforeSend:function()
        {
            $('#gb_list').css('opacity', '0.5');											     				
        },complete:function(){
            //$('#gb_list').css('opacity', '1.0');
        }
    });
    }
    
    return false;
}

function getGBListDel(msg_id){
    if($('#gb_list').is(':visible')){
        $.ajax({type: "GET",cashe:false,url: "gb.php",data: {
            action: 'delete',
            msg_id: msg_id
    },
        success: function(content)
        {
            getGBList(1);
        },beforeSend:function()
        {
            $('#gb_list').css('opacity', '0.5');											     				
        },complete:function(){
            //$('#gb_list').css('opacity', '1.0');
        }
    });
    }
    
    return false;
}
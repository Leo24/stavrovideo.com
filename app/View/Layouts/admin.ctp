<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>StavroVideo - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Bluth Company">
    <link rel="shortcut icon" href="<?=$this->webroot?>admin/assets/ico/favicon.png">
    <link href="<?=$this->webroot?>admin/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=$this->webroot?>admin/assets/css/select2.css" rel="stylesheet">
    <link href="<?=$this->webroot?>admin/assets/css/theme.css" rel="stylesheet">
    <link href="<?=$this->webroot?>admin/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=$this->webroot?>admin/assets/css/alertify.css" rel="stylesheet">
    <link href="<?=$this->webroot?>admin/assets/css/tabs.css" rel="stylesheet">
    <link rel="Favicon Icon" href="favicon.ico">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="<?=$this->webroot?>admin/assets/css/colorpicker.css" rel="stylesheet">
    <link href="<?=$this->webroot?>admin/assets/css/datepicker.css" rel="stylesheet">
    <link href="<?=$this->webroot?>admin/assets/css/timepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

  </head>
  <body>
    <div id="wrap">
      <div id="light" class="white_content">
      <div class="update-video-list-load"></div>
        <p>
           <span>Refreshing List of Videos.</span>
           <span>This may take few minutes.</span>
        </p>
      </div>
    <div id="fade" class="black_overlay"></div>



        <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="logo">
            <img src="<?=$this->webroot?>img/logo3.png" alt ='StavroVideo' style='max-width:70px' />
          </div>
           <a class="btn btn-navbar visible-phone" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
           <a class="btn btn-navbar slide_menu_left visible-tablet">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="top-menu visible-desktop">
            <ul class="pull-left">
           
            </ul>
            <ul class="pull-right">  
              <li><a href="<?=$this->webroot?>admin/logout"><i class="icon-off"></i> Logout</a></li>
            </ul>
          </div>

          <div class="top-menu visible-phone visible-tablet">
            <ul class="pull-right">  
            
              <li><a href="login.html"><i class="icon-off"></i></a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container-fluid">
     
      <!-- Side menu -->  
      <div class="sidebar-nav nav-collapse collapse">
        <div class="user_side clearfix">
         
          <h5>
            <?php echo $user['User']['username'];?>
          </h5>
        </div>
        <div class="accordion" id="accordion2">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F79999" href="<?=$this->webroot?>admin/videos/"><i class="icon-film"></i> <span>Vimeo</span></a>
            </div>
          </div>

          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F79999" href="<?=$this->webroot?>admin/videoSearch/"><i class="icon-film"></i> <span>Vimeo Search</span></a>
            </div>
          </div>

          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F79999" href="<?=$this->webroot?>admin/categories/"><i class="icon-folder-close-alt"></i> <span>Categories</span></a>
            </div>
          </div>

          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F79999" href="<?=$this->webroot?>admin/videocategories/list_categories"><i class="icon-folder-close-alt"></i> <span>Category order</span></a>
            </div>
          </div>

          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F79999" href="<?=$this->webroot?>admin/setmainvideo/set_main_video_list_categories"><i class="icon-film"></i> <span>Set Main Video</span></a>
            </div>
          </div>

          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F79999" href="<?=$this->webroot?>admin/gb/"><i class="icon-comment-alt"></i> <span>Guest book</span></a>
            </div>
          </div>

          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F79999" href="<?=$this->webroot?>admin/contacts/"><i class="icon-user"></i> <span>Contacts</span></a>
            </div>
          </div>

          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F79999" href="<?=$this->webroot?>admin/users/change_password"><i class="icon-lock"></i> <span>My Account</span></a>
            </div>
          </div>

          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F79999" href="<?=$this->webroot?>admin/feedback/contactinfo_index"><i class="icon-lock"></i> <span>Set Contact Us Info</span></a>
            </div>
          </div>

        </div>
      </div>
      <!-- /Side menu -->

      <!-- Main window -->
      <div class="main_container" id="<?=(!empty($main_id) ? $main_id : NULL)?>">
        <div class="row-fluid">
         
         <? if(!empty($page_header)) {?>         
          <h2 class="heading" style="margin-top:20px;">
                <?=$page_header?>
             
          </h2>
        <? } ?>          
        </div>
    
                <?php 
                        echo $content_for_layout; 
                ?>
    
        </div>
    </div><!-- wrap ends-->
    
        
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/bootstrap.js"></script>
    
    
    <script type="text/javascript" src='<?=$this->webroot?>admin/assets/js/sparkline.js'></script>
    <script type="text/javascript" src='<?=$this->webroot?>admin/assets/js/morris.min.js'></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/jquery.dataTables.min.js"></script>   
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/jquery.masonry.min.js"></script>   
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/jquery.imagesloaded.min.js"></script>   
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/jquery.facybox.js"></script>   
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/jquery.alertify.min.js"></script> 
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/jquery.knob.js"></script>
    <script type='text/javascript' src='<?=$this->webroot?>admin/assets/js/fullcalendar.min.js'></script>
    <script type='text/javascript' src='<?=$this->webroot?>admin/assets/js/jquery.gritter.min.js'></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/realm.js"></script>

    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/select2.min.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/jquery.bootstrap.wizard.min.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/admin_vimeo.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/admin_change_video_order_in_category.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/admin_set_main_site_video.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="<?=$this->webroot?>admin/assets/js/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
      <script type="text/javascript">
        tinymce.init({
          selector: "textarea",
          browser_spellcheck : true,
          width : 400,
          height : 200,
          fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
        });
      </script>

      <!--    <script type="text/javascript" src="--><?//=$this->webroot?><!--admin/assets/js/Imtech_SearchOnThisPage.js"></script>-->

  </body>
</html>

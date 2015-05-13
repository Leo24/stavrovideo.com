
		<!--=== PAGE PRELOADER ===-->
		<div id="page-loader"><h1 class='loader-logo'><p><span>StavroVideo</span><span class="page-loader-gif">&nbsp</span><span class="production">PRODUCTION</span></p></h1></div>
		
		<!--=== BACKGROUND ===-->
                <!--                
		<div id="backgrounds" data-backgrounds="assets/back_img_1.jpg,assets/back_img_2.jpg,assets/back_img_3.jpg"></div>
                <div id="color-overlay"></div>
                -->
                <div id="backgrounds" data-backgrounds="assets/white_tiles.png,assets/white_tiles.png"></div>
                
	
		<!-- ==============================================
		MAIN NAV
		=============================================== -->
		<div id="main-nav" class="navbar navbar-fixed-top">
			<div class="container" style="position: relative;">
                                <div class="navbar-header2">
				        <a href="#home" class="logo_href">
                                                <img src="img/logo3.png" />                                                                                                
                                                                                                                                            
                                        </a>
                                        <div class="we_are_container">
                                                <div class="we_are">
                                                        We create memories
                                                </div>
                                                
                                                <div class="we_are_num">
                                                        <a href="#contact" class="scrollto"><? if(isset($contacts[0]['ContactUsInfo']['mobile_phone_number'])){ echo $contacts[0]['ContactUsInfo']['mobile_phone_number'];} ?></a>
                                                </div>    
                                        </div>                                                                            
                                </div>

			
				<div class="navbar-header">
				
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-nav">
						<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button>
					
					<!-- ======= LOGO ========-->
                                        <!--                                        
					<a class="navbar-brand scrollto" href="#home">SHAPES<span> / Creative Studio</span></a>
                                        -->                                        
					<!-- <a class="navbar-brand scrollto ir-logo" href="#home">SHAPES<span> / Creative Studio</span></a> -->
                                                                                
				</div>
                                <!--
				<div id="site-nav-wrap" style="display: none">
        				<div id="site-nav" class="navbar-collapse collapse" style="">
        					<ul class="nav navbar-nav navbar-right">
        						
        					
                                                        <li>
        							<a href="#portfolio" class="scrollto">Portfolio</a>
        						</li>
        						<li>
        							<a href="#contact" class="scrollto">Contact</a>
        						</li>
        					</ul>
        				</div>
                                </div>
                                -->
                                
                                <div class="start_here_wraper">
                                        
                                              <ul class="nav navbar-nav dropdown-scroll">
                                                <li class="dropdown dropdown-scroll">
                                                  <a href="" class="dropdown-toggle " data-toggle="dropdown">Start Here <span class="caret"></span></a>
                                                  <ul id="cat_menu" class="dropdown-menu" role="menu" style="height: 240px; overflow-y: scroll; background-color: black; width: 300px;">
                                              <?php foreach($categories as $category) { ?>
                                                        <li>
        							<a href="#portfolio" data-id="<?=$category['Category']['categoryId']?>" ><?=$category['Category']['name']?></a>
        						</li>
                                                <? } ?>
                                                  </ul>
                                                </li>
                                              </ul>
                                              
                                </div>
                                <!--End navbar-collapse -->
            </div><!--End container -->
		 <div class="search">
				<div class="search-input"><input type="text" class="input_pwd" id="search_txt" placeholder="Search" /></div>
				<div class="search-submit"><a id="search_link" href="#search-results" class="btn_link"></a></div>
		  </div>


		</div><!--End main-nav -->
		
		<!-- ==============================================
		HEADER
		=============================================== -->
		<header id="home1" >
                
                        <div class="container" id="start_here" style="">
				<div id="search-results" class="search-results"></div>

				<div class="row">
				
					<div id="preview-media2" class="col-md-12" style="margin-top: 200px;">
                                                <?
												if(!empty($video_main[0]['Video']['video_url'])){
													$video_url = parse_url($video_main[0]['Video']['video_url']);
												}
												?>
                                                
                                                <iframe id="start_here_frame" src="http://player.vimeo.com/video<?=$video_url['path']?>?autoplay=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                               
                                        </div>
					
				</div>
				
				<div id="preview-content" class="row"></div>
			
			</div>
		
			
		</header><!--End header -->
                
                <!-- ==============================================
		ABOUT
		=============================================== -->

		<!-- ==============================================
		SOCIAL LINKS
		=============================================== -->

		<section id="social-links" class="bg-transparent">

			<div class="container">
				<ul>
                                        <li class="scrollimation fade-up d2">
						<a href="http://vimeo.com/stavrovideo" class="icon"><i class="fa fa-vimeo-square"></i></a>
						<h4>Find us on Vimeo</h4>
					</li>
					<li class="1scrollimation fade-up">
						<a href="https://twitter.com/stavro555" class="icon"><i class="fa fa-twitter-square"></i></a>
						<h4>Follow us on Twitter</h4>
					</li>
					<li class="scrollimation fade-up d1">
						<a href="https://www.facebook.com/StavroVideoProductions" class="icon"><i class="fa fa-facebook-square"></i></a>
						<h4>Like us on Facebook</h4>
					</li>
					<li class="scrollimation fade-up d3">
						<a href="https://www.youtube.com/channel/UCax8hxIBXefgA8aqQ1QgDbA" class="icon"><i class="fa fa-youtube-square"></i></a>
						<h4>Find us YouTube</h4>
					</li>
				</ul>

			</div><!--End container -->

		</section><!--End skills section -->


		<!-- ==============================================
		PORTFOLIO
		=============================================== -->		
		<section  id="portfolio">
		
			<div class="bg-light"><!--Start portfolio header -->
			
				<div class="container">
						
					<div class="section-header scrollimation fade-up">
					
						<div class="section-icon"><i class="fa fa-video-camera"></i></div>
					
						<h1 class="section-title">Videos</h1>
						
					
					
        					<!--==== Portfolio Filters ====-->
        					
        					<div id="filter-works" class="scrollimation fade-in">
        					        <!--   
        						<ul data-filter="category">
        							<li class="active">
        								<a href="#" data-category="*">All Categories</a>
        							</li>
        							<li>
        								<a href="#" data-category=".web-design">Web Design</a>
        							</li>
        							<li>
        								<a href="#" data-category=".apps">Apps</a>
        							</li>
        							<li>
        								<a href="#" data-category=".ui-kits">UI Kits</a>
        							</li>
        						</ul>
                                                        -->
        						
        						<ul data-filter="type" id="cat_btns">
                                                                <?php foreach($categories as $category) { ?>
                                                                        <li>
<!--																			<a href="--><?//= $this->webroot ?><!--pages/display/--><?//= $category['Category']['categoryId'] ?><!--" id="cat_--><?//=$category['Category']['categoryId']?><!--" data-type=".category--><?//=$category['Category']['categoryId']?><!--"> --><?//=$category['Category']['name']?><!--</a>-->

																			<a href="#" id="cat_<?=$category['Category']['categoryId']?>" category-id="<?=$category['Category']['categoryId']?>" data-type=".category<?=$category['Category']['categoryId']?>"><?=$category['Category']['name']?></a>
                							</li>
                                                                <? } ?>
        						</ul>
        						
        					</div><!--End portfolio filters -->
                                        </div><!--End section-header -->
					
					<p class="filter-results text-center"><span></span> Works match criteria</p>
				
				</div><!--End container -->
			</div><!--End portfolio header -->
			
			
			<!--==== Project Preview Panel (DO NOT REMOVE)====-->
			
			<div id="preview-scroll"></div>
			<div id="preview-loader"></div>
			
			<div id="project-preview-wrapper">
			<div id="project-preview">
				
				<div class="container">
				
					<div class="preview-header">
						<h1 class="preview-title"></h1><span class="close-preview"><i class="fa fa-times"></i></span>
					</div>
				
					<div class="row">

						<div id="preview-media" class="col-md-12"></div>

					</div>
				
				</div><!--End container -->
				
			</div><!--End #project-preview panel-->
			</div><!--End #project-preview-wrapper-->
			
			<div class="padding-bottom bg-light"><!--Start Projects Band-->
			
				<div class="container masonry-wrapper">

					<div id="projects-container" class="masonry">


					</div><!-- End #projects-container --> 
					
				</div><!-- End container --> 
				
				<div class="container">
					<br/>
					<p class="lead text-center scrollimation fade-in">We are ready for the next challenge. <span class="primary">Yours!</span></p>
					<p class="text-center scrollimation scale-in"><a class="btn btn-theme btn-lg scrollto" href="#contact">Contact Us</a></p>
					
				</div>
			</div><!--End Projects Band-->
			
		</section><!-- End portfolio section -->
			
		<!-- ==============================================
		TESTIMONIALS
		=============================================== -->	
		<section id="testimonials" class="bg-transparent"  style="border-bottom: none;">
		
			<div class="container scrollimation fade-left">
			
				<div class="quote-icon"><!-- Testimonials Icon -->
					<i class="fa fa-quote-left"></i>
				</div>
				
				<div class="row">
				
					<div class="col-sm-8 col-sm-offset-2">
					
						<div id="testimonials-slider" class="flexslider">
						
							<ul class="slides">
                                                                <?php foreach($comments as $comment) { ?>
        								<li>
        									<p class="testimonial">
                                                                                        <?=nl2br($comment['Gb']['msg'])?>
                                                                                </p>
                                                                                
        									<p class="client"><?=$comment['Gb']['name']?></p>
        								</li>
                                                                <? } ?>
							</ul>
							
						</div><!-- End slider -->
						
					</div><!-- End col -->
					
				</div><!-- End row -->
				
			</div><!-- End container -->
			
		</section><!-- End Testimonials section -->
                <section id="" class="bg-transparent" style="padding-top: 0px;">
                
                        <div class="bg-light"><!--Start portfolio header -->
			
				<div class="container">
                        
                                <div class="row">
                				
                					<!--=== Contact Form ===-->
                                                        <div class="col-sm-3"></div>
                					<form id="comment-form" class="contact-form col-sm-6 scrollimation fade-right" action="<?=$this->webroot?>gb/add" method="post" novalidate>
                						<input type="hidden" name="q_t" value="1" />
                                                                <input type="hidden" name="data[create_time]" value="<?=date('Y-m-d H:i:s')?>" />
                                                                 
                						<h3 class="primary text-center">Write a comment</h3>
                						
                						<div class="form-group">
                						  <label class="control-label" for="contact-name">Name</label>
                						  <div class="controls">
                							<input name="data[name]" placeholder="Your name" class="form-control input-lg requiredField" type="text" data-error-empty="Please enter your name">
                							<i class="fa fa-user"></i>
                						  </div>
                						</div><!-- End name input -->
                						
                						<div class="form-group">
                						  <label class="control-label" for="contact-mail">Email</label>
                						  <div class=" controls">
                							<input name="data[email]"  placeholder="Your email" class="form-control input-lg requiredField" type="email" data-error-empty="Please enter your email" data-error-invalid="Invalid email address">
                							<i class="fa fa-envelope"></i>
                						  </div>
                						</div><!-- End email input -->
                						
                						<div class="form-group">
                						  <label class="control-label" for="contact-message">Message</label>
                							<div class="controls">
                								<textarea name="data[msg]"  placeholder="Your message" class="form-control input-lg requiredField" rows="6" data-error-empty="Please enter your message"></textarea>
                								<i class="fa fa-comment"></i>
                							</div>
                						</div><!-- End textarea -->
                						
                						<p><button name="submit" type="submit" class="btn btn-theme btn-block" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent"><i class="fa fa-location-arrow"></i>Post Comment</button></p>
                						<input type="hidden" name="submitted" id="submitted" value="true" />
                						
                					</form><!-- End contact-form -->
                                                        <div class="col-sm-3"></div>
                                
                		
                		</div>
                        </div>
	               </div>
		</section>

		<!-- ==============================================
		CONTACT
		=============================================== -->	
		<section id="contact" class="padding-bottom bg-light">
		
			<div class="container">
			
				<div class="section-header scrollimation fade-up">
				
					<div class="section-icon"><i class="fa fa-envelope"></i></div>
				
					<h1 class="section-title">Contact</h1>
					
					<p class="section-description lead">Are you ready to start your project? We are here for you.<br/> Visit us, write to us or call us</p>
					
				</div><!--End section-header -->
				
				<div class="row">
				
					<!--=== Contact Form ===-->

					<form id="contact-form" class="contact-form col-sm-6 scrollimation fade-right" action="<?=$this->webroot?>contacts/add" method="post" novalidate>
        					
                                                <input type="hidden" name="q_t" value="1" />
                                                <input type="hidden" name="data[create_date]" value="<?=date('Y-m-d H:i:s')?>" />         					
        						
						<div class="form-group">
						  <label class="control-label" for="contact-name">Name</label>
						  <div class="controls">
							<input id="contact-name" name="data[name]" placeholder="Your name*" class="form-control input-lg requiredField" type="text" data-error-empty="Please enter your name">
							<i class="fa fa-user"></i>
						  </div>
						</div><!-- End name input -->
						
						<div class="form-group">
						  <label class="control-label" for="contact-mail">Email</label>
						  <div class=" controls">
							<input id="contact-mail" name="data[email]" placeholder="Your email*" class="form-control input-lg requiredField" type="email" data-error-empty="Please enter your email" data-error-invalid="Invalid email address">
							<i class="fa fa-envelope"></i>
						  </div>
						</div><!-- End email input -->
                                                
                                                <div class="form-group">
						  <label class="control-label" for="contact-name">Subject</label>
						  <div class="controls">
							<input id="contact-subject" name="data[subject]" placeholder="Message subject*" class="form-control input-lg requiredField" type="text" data-error-empty="Please enter subject">
							<i class="fa fa-pencil"></i>
						  </div>
						</div><!-- End name input -->                                                                                                                
						
						<div class="form-group">
						  <label class="control-label" for="contact-message">Message</label>
							<div class="controls">
								<textarea id="contact-message" name="data[message]"  placeholder="Your message*" class="form-control input-lg requiredField" rows="6" data-error-empty="Please enter your message"></textarea>
								<i class="fa fa-comment"></i>
							</div>
						</div><!-- End textarea -->
						
						<p><button name="submit" type="submit" class="btn btn-theme btn-block" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent"><i class="fa fa-location-arrow"></i>Send Message</button></p>
						<input type="hidden" name="submitted" id="submitted" value="true" />
						
					</form><!-- End contact-form -->
				
					<div class="col-sm-5 col-sm-offset-1 contact-info">
						
						<div class="scrollimation scale-in">
						<h3 class="primary">Find Us</h3>
							<ul class="address">
								<li><? if(isset($contacts[0]['ContactUsInfo']['additional_text'])){ echo $contacts[0]['ContactUsInfo']['additional_text'];} ?></li>
								<li><span><i class="fa fa-mobile-phone fa-fw"></i></span><? if(isset($contacts[0]['ContactUsInfo']['mobile_phone_number'])){ echo $contacts[0]['ContactUsInfo']['mobile_phone_number'];} ?></li>
                                                                <li><span><i class="fa fa-phone fa-fw"></i></span><? if(isset($contacts[0]['ContactUsInfo']['landline_phone_number'])){ echo $contacts[0]['ContactUsInfo']['landline_phone_number'];} ?></li>
							</ul>
						</div>
						
						<div class="map scrollimation scale-in">
							<img class="img-responsive" src="assets/map.png" alt=""/>
							<a class="spot" style="top:45%; left:15%;" data-toggle="tooltip" title="Find Us on Google Maps" href="https://maps.google.com/maps?saddr=34.05332,-118.25067&amp;hl=en&amp;sll=34.05332,-118.25067&amp;sspn=0.141898,0.338173&amp;mra=mift&amp;mrsp=0&amp;sz=12&amp;t=m&amp;z=12" target="_blank"><span></span></a>
						</div>
						
					</div><!-- End contact-info -->
				  
				</div><!-- End row -->
				
			</div><!-- End container -->
			
		</section><!-- End contact section -->


		          <!-- ==============================================
        		TWITTER FEED
        		=============================================== -->
        		<section id="twitter" class="bg-transparent">

        			<div class="container scrollimation fade-right">

        				<div class="twitter-icon"><!-- Twitter Icon -->
        					<i class="fa fa-facebook-square" style="font-size: 30px;"></i>
        				</div>

        				<div class="row">

        					<div class="col-sm-8 col-sm-offset-2">

        						<div id="twitter-slider" class="flexslider" data-widget-id="386017398488186880" data-tweets-length="3">

                                                          <ul class="slides">
                                                                <?
                                                                        $i = 0;
                                                                        foreach($pagefeed['data'] as $post) {
                                                                                if ($post['type'] == 'status' || $post['type'] == 'link' || $post['type'] == 'photo' || $post['type'] == 'video') {
                                                                ?>
                                                                                        <li>
                                                                                                <p class="tweet">
                                                                                                <? if (empty($post['story']) === false) {
                                                                                                        echo $post['story'];
                                                                                                    } elseif (empty($post['message']) === false) {
                                                                                                        echo $post['message'];
                                                                                                    }
                                                                                                ?>
                                                                                                </p>
                                                                                                <p class="timePosted">Posted on <?=date("jS M, Y", (strtotime($post['created_time'])))?></p>
                                                                                        </li>
                                                                <?
                                                                                        $i++;
                                                                                }
                                                                                if ($i == 10) {
                                                                                    break;
                                                                                }
                                                                        }
                                                                ?>
                                                          </ul>

        						</div><!-- End slider -->

        					</div><!-- End col -->

        				</div><!-- End row -->

        			</div><!-- End container -->

        		</section><!-- End Twitter section -->


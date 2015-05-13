<div class="search-results-container">
    <div class="video-from-search-backing">
        <span class="close-preview" style="top: 30px;"><i class="fa fa-times"></i></span>
    </div>
        <div class="video-from-search">
            <span class="close-preview"><i class="fa fa-times"></i></span>
            <div class="fluid-width-video-wrapper"></div>
        </div>
    <span class="close-search-results"><i class="fa fa-times"></i></span>
    <h2>Search results:</h2>
    <ul>
    <?php if(empty($searchResults[0])):?>
     <?php echo "No videos found."?>

    <?php else:?>
    <?php foreach($searchResults as $searchResult):?>
        <li>
        <article class="project-item search-results">
            <a href="#">
                <img class="img-responsive project-thumb" src="<?php echo $searchResult['video_img']?>" alt=""><!--Project thumb -->
                    <div class="details">
                        <small><?php echo $searchResult['video_name']?></small><!--Project Categories -->
<!--                        <span class="video-url" style="display:none;" video-url="--><?php //echo $searchResult['video_url']?><!--">--><?php //echo $searchResult['video_url']?><!--</span>-->

                        <div class="sr-only">
                            <div class="project-media" data-video='<iframe src="http://player.vimeo.com/video/<?php echo $searchResult['video_id']?>?autoplay=1" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'></div>
                        </div>


                    </div>
            </a>
        </article>
        </li>
    <?php endforeach; ?>

    <?php endif;?>
    </ul>
</div>

<div class="search-results-container">
    <div class="video-from-search" style="display:none;">
        <div class="fluid-width-video-wrapper"></div>
    </div>
    <h2>Search results:</h2>
    <ul>
    <?php if(empty($searchResults[0])):?>
     <?php echo "No videos found."?>

    <?php else:?>
    <?php foreach($searchResults as $searchResult):?>
        <li>
        <article class="project-item">
            <a href="#">
                <img class="img-responsive project-thumb" src="<?php echo $searchResult['video_img']?>" alt=""><!--Project thumb -->
                    <div class="details">
                        <h3 class="project-title" style="display: none"><?php echo $searchResult['video_name']?></h3>
                        <small><?php echo $searchResult['video_name']?></small><!--Project Categories -->
                        <span class="video-url" style="display:none;" video-url="<?php echo $searchResult['video_url']?>"><?php echo $searchResult['video_url']?></span>
                    </div>
            </a>
        </article>
        </li>
    <?php endforeach; ?>

    <?php endif;?>
    </ul>
</div>

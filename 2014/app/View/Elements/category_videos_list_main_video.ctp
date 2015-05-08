


<ul class="categories-for-main-video">
    <?  foreach ($categories as $category) { ?>
        <li class="<? if (isset($category['Category']['Videos'])) {
            echo 'current';
        } ?>" category-order="<?= $category['Category']['category_order'] ?>">
            <a href="<?= $this->webroot ?>admin/setmainvideo/category_videos_list/<?= $category['Category']['categoryId'] ?>"
               category-id="<?= $category['Category']['categoryId'] ?>">
                <span><?= $category['Category']['name'] ?></span>
            </a>
        </li>
    <?
    } ?>
</ul>
<?    foreach ($categories as $category) {
    if(isset($category['Category']['Videos'])) { ?>
        <div class="category content<?=' active';?>" category-id="<?= $category['Category']['categoryId'] ?>">
            <ul class="video-container-for-main-video" category-id="<?= $category['Category']['categoryId'] ?>">
                <? foreach ($category['Category']['Videos'] as $video) { ?>
                    <li class="main-video-container" id="<?= $video['Video']['line_id'] ?>" video_id="<?= $video['Video']['video_id'] ?>" category_id="<?= $video['Video']['category_id'] ?>" video_order_in_category = "<?= $video['Video']['video_order_in_category'] ?>" line_id="<?= $video['Video']['line_id'] ?>">
                        <input class="set-main-video" type="checkbox" <?if(isset($mainVideo['Video']['video_id']) && $mainVideo['Video']['video_id'] == $video['Video']['video_id']){echo "checked=\"checked\"";}?>>
                        <img src="<?= $video['Video']['video_img'] ?>" title="<?= $video['Video']['video_name'] ?>" alt="<?= $video['Video']['video_name'] ?>" class="thumbnail thumbnail_lg_wide"/>
                        <div class="video-info">
                            <p class="video-title-set-main-video"><?= $video['Video']['video_name'] ?></p>
                        </div>
                    </li>
                <? } ?>
            </ul>
        </div>

    <?}


}

?>





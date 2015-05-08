    <ul class="categories">
<?  foreach ($categories as $category) { ?>
        <li class="<? if (isset($category['Category']['Videos'])) {
            echo 'current';
        } ?>" category-order="<?= $category['Category']['category_order'] ?>">
            <a href="<?= $this->webroot ?>admin/videocategories/list_categories/<?= $category['Category']['categoryId'] ?>"
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
                       <ul id="sortable" class="video-container" category-id="<?= $category['Category']['categoryId'] ?>">
                           <? foreach ($category['Category']['Videos'] as $video) { ?>
                               <li class="ui-state-default ui-sortable-handle ui-sortable-helper" id="<?= $video['Video']['line_id'] ?>" video_id="<?= $video['Video']['video_id'] ?>" category_id="<?= $video['Video']['category_id'] ?>" video_order_in_category = "<?= $video['Video']['video_order_in_category'] ?>" line_id="<?= $video['Video']['line_id'] ?>">
                                       <img src="<?= $video['Video']['video_img'] ?>" title="<?= $video['Video']['video_name'] ?>" alt="<?= $video['Video']['video_name'] ?>" class="thumbnail thumbnail_lg_wide"/>
                                   <div class="video-info">
                                       <p class="video-title"><?= $video['Video']['video_name'] ?></p>
                                       <p class="video-order">Video order in category:
                                           <span class="video-order"><?= $video['Video']['video_order_in_category'] ?></span>
                                       </p>
                                   </div>
                               </li>
                           <? } ?>
                       </ul>
                </div>

                   <?}


                   }

    ?>


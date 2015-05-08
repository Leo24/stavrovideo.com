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
    }
            foreach ($categories as $category) {
               if(isset($category['Category']['Videos'])) { ?>
                   <div class="category content<?=' active';?>" category-id="<?= $category['Category']['categoryId'] ?>">
                       <ul class="video-container" category-id="<?= $category['Category']['categoryId'] ?>">
                           <? foreach ($category['Category']['Videos'] as $video) { ?>
                               <li>
                                   <div class="container" video_id="<?= $video['Video']['video_id'] ?>"
                                        category_id="<?= $video['Video']['category_id'] ?>">
                                       <img src="<?= $video['Video']['video_img'] ?>" title="<?= $video['Video']['video_name'] ?>" alt="<?= $video['Video']['video_name'] ?>" class="thumbnail thumbnail_lg_wide"/>
                                       <p class="video-title"><?= $video['Video']['video_name'] ?></p>
                                       <p>Video order in category: <input class="video-order-in-category" value="<?= $video['Video']['order_video'] ?>"
                                                 type="number" min="0"></p>
                                   </div>
                               </li>
                           <? } ?>
                       </ul>
                </div>

                   <?}


                   }




//        }



//        $i++;

//  }
    ?>


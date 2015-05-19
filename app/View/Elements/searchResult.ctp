<? foreach($searchResults as $video){ ?>
    <tr data-id="<?=$video['video_id']?>">
        <td>
            <img src="<?=$video['video_img']?>" title="<?=$video['video_name']?>" alt="<?=$video['video_name']?>" class="thumbnail thumbnail_lg_wide" />
        </td>
        <td>
            <?=$video['video_name']?>
        </td>
        <td>
        <div class="select-category-wrapper" id="<?=$video['video_id']?>">

            <? if(isset($video['categories']) && count($video['categories']) != 0 ){ ?>
                <? foreach($video['categories'] as $category){ ?>
            <div class="select-category">
                    <select class="category-video" line_id="<?=$category[0]['Category']['id']?>">
                            <option value="">Select category</option>
                  <? foreach($categories as $categoryFromList) {
                        if(($category[0]['Category']['categoryId'] == $categoryFromList['Category']['categoryId'])==true){ ?>
                            <option selected="selected value="<?=$categoryFromList['Category']['categoryId']?>" ><?=$categoryFromList['Category']['name']?></option>
                        <? }else{ ?>
                            <option value="<?=$categoryFromList['Category']['categoryId']?>"><?=$categoryFromList['Category']['name']?></option>
                        <? }
                    }?>
                    </select>
                <button class="remove-category">Remove category</button>
                </div>

              <? }

         } ?>

        </div>
        <div class="add-category">
            <button class="add-category">Add category</button>
        </div>
        </td>
    </tr>
<? } ?>
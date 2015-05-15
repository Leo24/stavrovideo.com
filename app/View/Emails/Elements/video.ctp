<? foreach($videos->videos->video as $video){
    $video_ids[] = $video->id;
    ?>
    <tr data-id="<?=$video->id?>">
        <td>
            <img src="<?=$video->thumbnail_medium?>" title="<?=$video->title?>" alt="<?=$video->title?>" class="thumbnail thumbnail_lg_wide" />
        </td>
        <td>
            <?=$video->title?>
        </td>
        <td>
        <div class="select-category-wrapper" id="<?=$video->id?>">
            <? if((!empty($video->categories))===true){ ?>

                <? foreach($video->categories as $category){ ?>
            <div class="select-category">
                    <select class="category-video" line_id="<?=$category['Videocategories']['id']?>">
                            <option value="">Select category</option>
                  <? foreach($categories as $categoryFromList) {
                        if(($category['Videocategories']['category_id'] == $categoryFromList['Category']['categoryId'])==true){ ?>
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
        <td>
            <div class="control-group">

                <select style="width: 80px" id="order_video">
                    <? for($i=1; $i<=$videos->videos->total; $i++) { ?>
                        <option value="<?=$i?>" <?=($i == $video->order ? 'selected' : NULL)?> ><?=$i?></option>
                    <? } ?>
                </select>
            </div>
        </td>
        <!--
                <td>
                        <input id="start_video" type="checkbox" <?=($video->category == '0' ? 'checked' : NULL)?>  />
                </td>
                -->
    </tr>
<? } ?>
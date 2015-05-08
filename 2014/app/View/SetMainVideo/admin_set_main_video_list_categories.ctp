<div class="row-fluid">
    <div class="widget widget-padding span12">
        <div class="widget-header">
            <i class="icon-facetime-video"></i>
            <h5>Set Main Video</h5>
            <div class="widget-buttons">
                <a href="#" data-title="Collapse" data-collapsed="false" class="tip collapse">
                    <!--                    <i class="icon-chevron-up"></i>-->
                </a>
            </div>
        </div>
        <div class="widget-body">
            <div class="video-list">
                <div class="main-video">
                    <?if (isset($mainVideo) && $mainVideo['Video']['main_site_video']!=0){ ?>
                        <p class="site-main-video"><span>site main video:</span></p>
                        <img src="<?= $mainVideo['Video']['video_img'] ?>" title="<?= $mainVideo['Video']['video_name'] ?>" alt="<?= $mainVideo['Video']['video_name'] ?>" class="thumbnail thumbnail_lg_wide"/>
                        <p><span video_id="<?=$mainVideo['Video']['id']?>"><?=$mainVideo['Video']['video_name']?></span></p>
                        <div class="remove-main-video-input">
                            <input class="remove-main-video" type="button" value="Remove Main Video">
                        </div>
                    <? } ?>
                </div>
            </div>

            <table>
            <tbody id="set-main-video">
            <ol id="toc">
                <?=$this->element('category_videos_list_main_video', array('category_videos_list_main_video' => $categories)); ?>
            </ol>
            </tbody>
            </table>
            <div class="row-fluid" id="video_paging">
                <!--                --><?//=$this->element('paging', array('page' => (empty($page) ? 1 : $page), 'total_pages' => ceil($videos->videos->total/9), )); ?>
            </div>
        </div> <!-- /widget-body -->
    </div> <!-- /widget -->
</div> <!-- /row-fluid -->

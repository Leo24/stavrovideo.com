<div class="row-fluid">


          <div class="widget widget-padding span12">
            <div class="widget-header">
              <div class="update-video-list">
                <form action="<?=$this->webroot?>admin/videos/update_video_list">
                  <input type="button" value="refresh video list ">
                </form>
<!--                <div class="update-video-list-load" style="display: none;">-->
<!--                  <p><span>Refreshing List of Videos.</span>-->
<!--                      <span>This may take few minutes.</span>-->
<!--                  </p>-->
<!--                </div>-->
              </div>
              <i class="icon-facetime-video"></i>
              <h5>Vimeo Videos</h5>


<!--                <form action="--><?//=$this->webroot?><!--admin/videos/refresh_caregories">-->
<!--                  <input type="submit" value="Refresh caregories">-->
<!--                </form>-->


              <div class="widget-buttons">
                  <a href="#" data-title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
              </div>
            </div>  
            <div class="widget-body">
              <table id="users" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>Video</th>
                    <th>Name</th>
                    <th>Category</th>
                    <!--
                    <th>Start Here</th>
                    -->
                  </tr>
                </thead>
                <tbody id="video_body">
                        <?=$this->element('video', array('videos' => $videos)); ?>
                </tbody>
                
                
              </table>
              <div class="row-fluid" id="video_paging">
              <?=$this->element('paging', array('page' => (empty($page) ? 1 : $page), 'total_pages' => ceil($videos->videos->total/9), )); ?>
              </div>
            </div> <!-- /widget-body -->
          </div> <!-- /widget -->
        </div> <!-- /row-fluid -->

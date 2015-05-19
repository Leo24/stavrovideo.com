<div class="row-fluid">


          <div class="widget widget-padding span12">
            <div class="widget-header">

              <i class="icon-facetime-video"></i>
              <h5>Vimeo Video Search</h5>


              <div class="widget-buttons">
                  <a href="#" data-title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
              </div>
            </div>  
            <div class="widget-body">

                <div class="search-for-video">
                    <form action="<?=$this->webroot?>admin/videoSearch/videosList" method="POST">
                        <input class="search" type="text"  name="searchQuery" placeholder="Search for video..." autocomplete="off">
                        <input class="submit-button" type="submit" value="Search">
                    </form>
                    <div class="pre-search-list"></div>
                </div>
                <? if (isset($searchResults) && count($searchResults) != 0): ?>
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
                <?=$this->element('searchResult', array('searchResults' => $searchResults)); ?>
                </tbody>
                
                
              </table>
                <? endif; ?>
            </div> <!-- /widget-body -->
          </div> <!-- /widget -->
        </div> <!-- /row-fluid -->

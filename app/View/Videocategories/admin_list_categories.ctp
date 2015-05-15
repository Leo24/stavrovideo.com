<div class="row-fluid">
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-facetime-video"></i>
              <h5>Vimeo Videos</h5>
              <div class="widget-buttons">
                  <a href="#" data-title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
              </div>
            </div>  
            <div class="widget-body">
                <tbody id="video_body">
                    <ol id="toc">
                      <?=$this->element('categories', array('categories' => $categories)); ?>
                    </ol>
                </tbody>
              </table>
              <div class="row-fluid" id="video_paging">
<!--                --><?//=$this->element('paging', array('page' => (empty($page) ? 1 : $page), 'total_pages' => ceil($videos->videos->total/9), )); ?>
              </div>
            </div> <!-- /widget-body -->
          </div> <!-- /widget -->
        </div> <!-- /row-fluid -->

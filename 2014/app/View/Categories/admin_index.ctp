<style>
        .table th{
                padding-right: 15px;
        }
</style>
<div class="row-fluid">
           
            <a class="btn btn-box span12" href="<?=$this->webroot?>admin/categories/add/" data-bubble="2" style="color:#0A0"><i class="icon-plus-sign"></i><span>Create new category</span></a>
            </div>
            
<div class="row-fluid">
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-folder-open-alt"></i>
              <h5>Categories</h5>
              <div class="widget-buttons">
                  <a href="#" data-title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
              </div>
            </div>  
            
            

            
            <div class="widget-body">
              <table id="cat_tbl" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Priority</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="">
                        <? foreach($categories as $category){ ?>
                                <tr data-id="<?=$category['Category']['categoryId']?>">
                                        <td>
                                                <?=$category['Category']['name']?>
                                        </td>
                                        <td>
                                                <?=$category['Category']['category_order']?>
                                        </td>
                                        <td>
                                                <div class="btn-group">
                                                        <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                                                        Action
                                                          <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                          <li><a href="<?=$this->webroot?>admin/categories/delete/<?=$category['Category']['categoryId']?>"><i class="icon-trash"></i> Delete</a></li>
                                                          <li><a href="<?=$this->webroot?>admin/categories/edit/<?=$category['Category']['categoryId']?>"><i class="icon-edit"></i> Edit</a></li>
                                                          
                                                        </ul>
                                                </div>
                                        </td>
                                </tr>
                        <? } ?>
                </tbody>
                
                
              </table>
              
            </div> <!-- /widget-body -->
          </div> <!-- /widget -->
        </div> <!-- /row-fluid -->

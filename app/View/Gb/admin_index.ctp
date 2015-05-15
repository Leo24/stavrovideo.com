<style>
        .table th{
                padding-right: 15px;
        }
</style>
<div class="row-fluid">
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-user"></i>
              <h5>Contacts</h5>
              <div class="widget-buttons">
                  <a href="#" data-title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
              </div>
            </div>  
            <div class="widget-body">
              <table id="gb_tbl" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="">
                        <? foreach($comments as $comment){ ?>
                                <tr data-id="<?=$comment['Gb']['id']?>">
                                        <td>
                                                <?=$comment['Gb']['name']?>
                                        </td>
                                        <td>
                                                <?=$comment['Gb']['email']?>
                                        </td>
                                        <td>
                                                <?=nl2br($comment['Gb']['msg'])?>
                                        </td>
                                        <td>
                                                <?=$comment['Gb']['create_time']?>
                                        </td>
                                        <td>
                                                <div class="btn-group">
                                                        <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                                                        Action
                                                          <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                          <li><a href="<?=$this->webroot?>admin/gb/delete/<?=$comment['Gb']['id']?>"><i class="icon-trash"></i> Delete</a></li>
                                                          <li><a href="<?=$this->webroot?>admin/gb/edit/<?=$comment['Gb']['id']?>"><i class="icon-edit"></i> Edit</a></li>
                                                          <? if($comment['Gb']['approved']) { ?>
                                                                <li><a href="<?=$this->webroot?>admin/gb/unapprove/<?=$comment['Gb']['id']?>"><i class="icon-off"></i> Unapprove</a></li>
                                                          <? } else { ?>
                                                                <li><a href="<?=$this->webroot?>admin/gb/approve/<?=$comment['Gb']['id']?>"><i class="icon-ok"></i> Approve</a></li>
                                                          <? } ?>
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

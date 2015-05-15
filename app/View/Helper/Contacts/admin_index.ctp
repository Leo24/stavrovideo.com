<style>
        .table th{
                padding-right: 15px;
        }
</style>
<div class="row-fluid" id="users_page">
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-user"></i>
              <h5>Contacts</h5>
              <div class="widget-buttons">
                  <a href="#" data-title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
              </div>
            </div>  
            <div class="widget-body">
              <table id="users" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="">
                        <? foreach($contacts as $contact){ ?>
                                <tr data-id="<?=$contact['Contact']['id']?>">
                                        <td>
                                                <?=$contact['Contact']['name']?>
                                        </td>
                                        <td>
                                                <?=$contact['Contact']['email']?>
                                        </td>
                                        <td>
                                                <?=$contact['Contact']['subject']?>
                                        </td>
                                        <td>
                                                <?=nl2br($contact['Contact']['message'])?>
                                        </td>
                                        <td>
                                                <?=$contact['Contact']['create_date']?>
                                        </td>
                                        <td>
                                                <div class="btn-group">
                                                        <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                                                        Action
                                                          <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                          <li><a href="<?=$this->webroot?>admin/contacts/delete/<?=$contact['Contact']['id']?>"><i class="icon-trash"></i> Delete</a></li>
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

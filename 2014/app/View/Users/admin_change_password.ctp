<div class="row-fluid">
          <div class="widget widget-padding span12">
            <div class="widget-header"><i class="icon-list-alt"></i><h5>Change current Username and Password</h5></div>
            <form id="register_form1" class="form-horizontal" method="post" action="<?=$this->webroot?>admin/users/change_password/">
                <input type="hidden" name="data[User][username]" value="<?=$user['User']['username']?>" />
              <div class="widget-body" style="min-height:330px;">
                <div class="widget-forms clearfix">
                    <legend>Please fill this form</legend>
                    <div class="control-group ">
                        <label class="control-label">Current Username:</label>
                        <div class="controls"><input type="text" name="data[User][username]"></div>
                    </div>
                    <div class="control-group ">
                        <label class="control-label">Current Password:</label>
                        <div class="controls"><input type="password" name="data[User][password]"></div>
                    </div>
                    <div class="control-group ">
                        <label class="control-label">New Username:</label>
                        <div class="controls"><input type="text" name="data[User][new_username]"></div>
                    </div>
                    <div class="control-group ">
                      <label class="control-label">New Password:</label>
                      <div class="controls"><input type="password" name="data[User][new_password]" id="form_password"></div>
                    </div>

                    <div class="control-group ">
                      <label class="control-label">Confirm New Password:</label>
                      <div class="controls"><input type="password" name="data[User][password_confirm]"></div>
                    </div>
                </div>
              </div>
              <div class="widget-footer">
                <button type="submit" class="pull-left btn btn-info btn-small">Save</button>
              </div>
            </form>
          </div>
</div>
<? if(isset($result)) { ?>
<script>
        $(document).ready(function() {
                <? if($result) { ?>
                        alertify.log( 'Saved successfully!', 'success' );
                <? } else { ?>
                        alertify.log( 'There is some error', 'error' );
                <? } ?>
        });
</script>
<? } ?>
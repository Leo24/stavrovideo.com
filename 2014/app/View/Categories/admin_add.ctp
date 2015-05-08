<div class="row-fluid">
  <div class="widget widget-padding span12">
    <div class="widget-header">
      <i class="icon-list-alt"></i><h5>New Category</h5>
      <div class="widget-buttons">
          <a href="#" data-title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>
      </div>
    </div>
    <div class="widget-body">
      <div class="widget-forms clearfix">
        <form class="form-horizontal" id="edit_gb_frm" action="<?=$this->webroot?>admin/categories/add/" method="post">
          <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
              <input class="span7" type="text" name="data[name]" placeholder="" >
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label">Priority</label>
            <div class="controls">
              <input class="span7" type="text" name="data[category_order]" placeholder="">
            </div>
          </div>
          
          
          
        </form>
      </div>
    </div>
    <div class="widget-footer">
       <button class="btn btn-primary" type="submit" onclick="$('#edit_gb_frm').submit(); return false; ">Save</button>
       <button class="btn" type="button" onclick="document.location='<?=$this->webroot?>admin/categories/'; return false;">Cancel</button>
    </div>
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
<div class="row-fluid">
        <div class="widget widget-padding span12">
                <div class="widget-header"><i class="icon-list-alt"></i><h5>Contact Us Info</h5></div>
                <form id="register_form1" class="form-horizontal" method="post" action="<?=$this->webroot?>admin/feedback/set_contact_info/">
                        <input type="hidden" />
                        <div class="widget-body" style="min-height:330px;">
                                <div class="widget-forms clearfix">
<!--                                        <legend>Please fill this form</legend>-->
                                    <div class="control-group ">
                                        <label class="control-label">Additional Text:</label>
                                        <div class="controls"><input type="text" name="data[ContactUsInfo][additional_text]" value="<? if(isset($contacts[0]['ContactUsInfo']['additional_text'])){ echo $contacts[0]['ContactUsInfo']['additional_text'];} ?>"></div>
                                    </div>
                                        <div class="control-group ">
                                                <label class="control-label">Mobile Phone Number:</label>
                                                <div class="controls"><input type="text" name="data[ContactUsInfo][mobile_phone_number]" value="<? if(isset($contacts[0]['ContactUsInfo']['mobile_phone_number'])){ echo $contacts[0]['ContactUsInfo']['mobile_phone_number'];} ?>"></div>
                                        </div>
                                        <div class="control-group ">
                                                <label class="control-label">Landline Phone Number:</label>
                                                <div class="controls"><input type="text" name="data[ContactUsInfo][landline_phone_number]" value="<? if(isset($contacts[0]['ContactUsInfo']['landline_phone_number'])){ echo $contacts[0]['ContactUsInfo']['landline_phone_number'];} ?>"></div>
                                        </div>
                                        <div class="control-group ">
                                                <label class="control-label">Email</label>
                                                <div class="controls"><input type="text" name="data[ContactUsInfo][email]"  value="<? if(isset($contacts[0]['ContactUsInfo']['mobile_phone_number'])){ echo $contacts[0]['ContactUsInfo']['email'];}?>"></div>
                                        </div>
<!--                                        <div class="control-group ">-->
<!--                                                <label class="control-label">Address:</label>-->
<!--                                                <div class="controls"><input type="text" name="data[ContactUsInfo][address]" value="<? if(isset($contacts[0]['ContactUsInfo']['mobile_phone_number'])){ echo $contacts[0]['ContactUsInfo']['address'];}?>"></div>-->
<!--                                        </div>-->
<!--                                        <div class="control-group ">-->
<!--                                                <label class="control-label">Postcode</label>-->
<!--                                                <div class="controls"><input type="text" name="data[ContactUsInfo][postcode]" value="<? if(isset($contacts[0]['ContactUsInfo']['mobile_phone_number'])){ echo $contacts[0]['ContactUsInfo']['postcode'];}?>"></div>-->
<!--                                        </div>-->

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

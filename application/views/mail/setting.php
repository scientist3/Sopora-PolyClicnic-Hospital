<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default panel-form">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <?php echo form_open_multipart('mail/setting','class="form-inner"') ?>
                            <?php echo form_hidden('id', $setting->id) ?>

                            <div class="form-group row">
                                <label for="protocol" class="col-xs-3 col-form-label"><?php echo display('Protocol') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('protocol', array('sendmail' => 'Send Mail', 'mail' => 'Mail'), $setting->protocol, 'class="form-control" id="protocol" ') ?> 

                                </div>
                            </div>
 

                            <div class="form-group row">
                                <label for="mailpath" class="col-xs-3 col-form-label"><?php echo display('mailpath')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="mailpath" type="text" class="form-control" id="mailpath" placeholder="<?php echo display('mailpath')?>"  value="<?php echo (!empty($setting->mailpath) ? $setting->mailpath : '/usr/sbin/sendmail') ?>">
                                </div>
                            </div>
 
                            <div class="form-group row">
                                <label for="mailtype" class="col-xs-3 col-form-label"><?php echo display('mailtype')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('mailtype', array('html' => 'Html', 'text' => 'Text'), $setting->mailtype, 'class="form-control" id="mailtype" ') ?> 
                                </div>
                            </div>
 
                            <!--Radios-->
                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('validate_email') ?></label>
                                <div class="col-xs-9"> 
                                    <div class="form-check">
                                        <label class="radio-inline"><input type="radio" name="validate_email" value="true" <?php echo (($setting->validate_email == 'true') ? 'checked' : null) ?>><?php echo display('true') ?></label>
                                        <label class="radio-inline"><input type="radio" name="validate_email" value="false" <?php echo (($setting->validate_email == 'false') ? 'checked' : null) ?>><?php echo display('false') ?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('wordwrap') ?></label>
                                <div class="col-xs-9"> 
                                    <div class="form-check">
                                        <label class="radio-inline"><input type="radio" name="wordwrap" value="true" <?php echo (($setting->wordwrap == 'true') ? 'checked' : null) ?>><?php echo display('true') ?></label>
                                        <label class="radio-inline"><input type="radio" name="wordwrap" value="false" <?php echo (($setting->wordwrap == 'false') ? 'checked' : null) ?>><?php echo display('false') ?></label>
                                    </div>
                                </div>
                            </div>
 

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <h3><?php echo display('new_enquiry') ?></h3>
            </div>
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('dashboard_receptionist/enquiry/enquiry/create','class="form-inner"') ?>

                            <div class="form-group row">
                                <label for="name" class="col-xs-3 col-form-label"><?php echo display('full_name')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="name"  type="text" class="form-control" id="name" placeholder="<?php echo display('full_name')?>" value="<?php echo $enquiry->name ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-xs-3 col-form-label"><?php echo display('email') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="email"  type="text" class="form-control" id="email" placeholder="<?php echo display('email') ?>" value="<?php echo $enquiry->email ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-xs-3 col-form-label"><?php echo display('phone') ?> </label>
                                <div class="col-xs-9">
                                    <input name="phone"  type="text" class="form-control" id="phone" placeholder="<?php echo display('phone') ?>" value="<?php echo $enquiry->phone ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="enquiry" class="col-xs-3 col-form-label"><?php echo display('enquiry') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <textarea name="enquiry" class="form-control tinymce"  placeholder="<?php echo display('enquiry') ?>"  rows="7"><?php echo $enquiry->enquiry ?></textarea>
                                </div>
                            </div>

                            <!--Radios-->
                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('status') ?></label>
                                <div class="col-xs-9"> 
                                    <div class="form-check">
                                        <label class="radio-inline"><input type="radio" name="status" value="1" checked><?php echo display('active') ?></label>
                                        <label class="radio-inline"><input type="radio" name="status" value="0"><?php echo display('inactive') ?></label>
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
                </div>
            </div>
        </div>
    </div>

</div>
  
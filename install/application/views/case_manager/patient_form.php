<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("case_manager/patient") ?>"> <i class="fa fa-list"></i>  <?php echo display('patient_list') ?> </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('case_manager/patient/form') ?>

                            <?php echo form_hidden('id',$patient->id); ?>

                            <div class="form-group row">
                                <label for="patient_id" class="col-xs-3 col-form-label"><?php echo display('patient_id') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="patient_id" type="text" class="form-control" id="patient_id" placeholder="<?php echo display('patient_id') ?>" value="<?php echo $patient->patient_id ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="case_manager_id" class="col-xs-3 col-form-label"><?php echo display('case_manager') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('case_manager_id',$case_manager_list , $patient->case_manager_id,'class="form-control" id="case_manager_id"') ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ref_doctor_id" class="col-xs-3 col-form-label"><?php echo display('ref_doctor_name') ?></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('ref_doctor_id',$doctor_list , $patient->ref_doctor_id,'class="form-control" id="ref_doctor_id"') ?>
                                </div>
                            </div>
  
                            <div class="form-group row">
                                <label for="hospital_name" class="col-xs-3 col-form-label"><?php echo display('hospital_name') ?></label>
                                <div class="col-xs-9">
                                    <input name="hospital_name" type="text" class="form-control" id="hospital_name" placeholder="<?php echo display('hospital_name') ?>" value="<?php echo $patient->hospital_name ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="hospital_address" class="col-xs-3 col-form-label"><?php echo display('hospital_address') ?></label>
                                <div class="col-xs-9">
                                    <textarea name="hospital_address" class="form-control"  placeholder="<?php echo display('hospital_address') ?>" maxlength="140" rows="7"><?php echo $patient->hospital_address ?></textarea>
                                </div>
                            </div> 
  
                            <div class="form-group row">
                                <label for="doctor_name" class="col-xs-3 col-form-label"><?php echo display('doctor_name') ?></label>
                                <div class="col-xs-9">
                                    <input name="doctor_name" type="text" class="form-control" id="doctor_name" placeholder="<?php echo display('doctor_name') ?>" value="<?php echo $patient->doctor_name ?>" >
                                </div>
                            </div> 
 
                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('status') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <div class="form-check">
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="1" <?php echo  set_radio('status', '1', TRUE); ?> ><?php echo display('active') ?>
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="status" value="0" <?php echo  set_radio('status', '0'); ?> ><?php echo display('inactive') ?>
                                        </label>
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
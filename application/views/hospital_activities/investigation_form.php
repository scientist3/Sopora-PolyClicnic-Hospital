<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("hospital_activities/investigation") ?>"> <i class="fa fa-list"></i>  <?php echo display('investigation_report') ?> </a>  
                </div>
            </div> 


            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('hospital_activities/investigation/form/'.$investigation->id,'class="form-inner"') ?>

                            <?php echo form_hidden('id',$investigation->id) ?>

                            <div class="form-group row">
                                <label for="patient_id" class="col-xs-3 col-form-label"><?php echo display('patient_id') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="patient_id"  type="text" class="form-control" id="patient_id" placeholder="<?php echo display('patient_id') ?>" value="<?php echo $investigation->patient_id ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-xs-3 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="date" type="text" class="form-control datepicker" id="date" placeholder="<?php echo display('date') ?>" value="<?php echo $investigation->date ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-xs-3 col-form-label"><?php echo display('title') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="title" type="text" class="form-control" id="title" placeholder="<?php echo display('title') ?>" value="<?php echo $investigation->title ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-xs-3 col-form-label"><?php echo display('description') ?></label>
                                <div class="col-xs-9">
                                    <textarea name="description" class="form-control" id="description"  placeholder="<?php echo display('description') ?>" rows="7"><?php echo $investigation->description ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="doctor_id" class="col-xs-3 col-form-label"><?php echo display('doctor_name') ?></label>
                                <div class="col-xs-9">
                                <?php echo form_dropdown('doctor_id', $doctor_list, $investigation->doctor_id, 'class="form-control" id="doctor_id"') ?>
                                </div>
                            </div>


                            <!-- if investigation picture is already uploaded -->
                            <?php if(!empty($investigation->picture)) {  ?>
                            <div class="form-group row">
                                <label for="picturePreview" class="col-xs-3 col-form-label"></label>
                                <div class="col-xs-9">
                                    <img src="<?php echo base_url($investigation->picture) ?>" alt="Picture" class="img-thumbnail" />
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="picture" class="col-xs-3 col-form-label"><?php echo display('picture') ?></label>
                                <div class="col-xs-9">
                                    <input type="file" name="picture" id="picture" value="<?php echo $investigation->picture ?>">
                                    <input type="hidden" name="old_picture" value="<?php echo $investigation->picture ?>">
                                </div>
                            </div>


                            <!--Radio-->
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
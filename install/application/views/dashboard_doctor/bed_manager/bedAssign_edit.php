<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <div class="btn-group">
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_doctor/bed_manager/bed_assign") ?>"> <i class="fa fa-list"></i>  <?php echo display('bed_assign_list') ?> </a> 
                </div>
            </div>

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('dashboard_doctor/bed_manager/bed_assign/edit/'.$bed->serial,'class="form-inner"') ?>

                            <input type="hidden" name="serial" id="serial" value="<?php echo $bed->serial ?>">

                            <div class="form-group row">
                                <label for="patient_id" class="col-xs-3 col-form-label"><?php echo display('patient_id') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="patient_id"  type="text" class="form-control" id="patient_id" placeholder="<?php echo display('patient_id') ?>" value="<?php echo $bed->patient_id ?>" autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bed_id" class="col-xs-3 col-form-label"><?php echo display('bed_type') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('bed_id', $bed_list, $bed->bed_id, 'class="form-control dateChange" id="bed_id"') ?>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="assign_date" class="col-xs-3 col-form-label"><?php echo display('assign_date') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="assign_date"  type="text" class="form-control cdatepicker dateChange" id="assign_date" placeholder="<?php echo display('assign_date') ?>" value="<?php echo $bed->assign_date ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="discharge_date" class="col-xs-3 col-form-label"><?php echo display('discharge_date') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="discharge_date"  type="text" class="form-control cdatepicker dateChange" id="discharge_date" placeholder="<?php echo display('discharge_date') ?>" value="<?php echo $bed->discharge_date ?>" >
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-xs-3 col-form-label"><?php echo display('description') ?></label>
                                <div class="col-xs-9">
                                    <textarea name="description" class="form-control"  placeholder="<?php echo display('description') ?>" rows="7"><?php echo $bed->description ?></textarea>
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



<script type="text/javascript">
$(document).ready(function() {

    //check patient id
    $('#patient_id').keyup(function(){
        var pid = $(this);

        $.ajax({
            url  : '<?= base_url('dashboard_doctor/bed_manager/bed_assign/check_patient/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                patient_id : pid.val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    pid.next().text(data.message).addClass('text-success').removeClass('text-danger');
                } else if (data.status == false) {
                    pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    });


    //check assign_date
    var assign_date    = $('#assign_date');
    var discharge_date = $('#discharge_date');
    var dateChange     = $('.dateChange');
    var bed_id         = $("#bed_id"); 
    var serial         = $("#serial"); 

    dateChange.change(function(){ 
        $.ajax({
            url  : '<?= base_url('dashboard_doctor/bed_manager/bed_assign/check_bed/') ?>',
            type : 'POST',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                assign_date : assign_date.val(), 
                discharge_date : discharge_date.val(), 
                bed_id : bed_id.val(),  
                serial : serial.val(),  
            },
            success : function(data) 
            {
                discharge_date.next().html(data.message);
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    });


    //custom date picker
    $('.cdatepicker').datepicker({
        minDate:0,
        dateFormat: "dd-mm-yy"
    });

});
 
 </script>
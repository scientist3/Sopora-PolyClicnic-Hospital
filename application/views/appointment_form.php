<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("appointment/") ?>"> <i class="fa fa-list"></i>  <?php echo display('appointment_list') ?> </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <?php echo form_open('appointment/create','class="form-inner"') ?> 
                        
                            <!-- patient id -->
                            <div class="form-group row">
                                <label for="patient_id" class="col-xs-3 col-form-label"><?php echo display('patient_id') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="patient_id" autocomplete="off" type="text" class="form-control" id="patient_id" placeholder="<?php echo display('patient_id') ?>" value="<?php echo $appointment->patient_id ?>">
                                    <span></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="department_id" class="col-xs-3 col-form-label"><?php echo display('department_name') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('department_id',$department_list,$appointment->department_id,'class="form-control" id="department_id"') ?>
                                    <span class="doctor_error"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="doctor_id" class="col-xs-3 col-form-label"><?php echo display('doctor_name') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('doctor_id','','','class="form-control" id="doctor_id"') ?>
                                    <div id="available_days"></div>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="date" class="col-xs-3 col-form-label"><?php echo display('appointment_date') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9"> 
                                    <input name="date" type="text" class="datepicker-avaiable-days form-control" id="date" placeholder="<?php echo display('appointment_date') ?>" >
                                </div>
                            </div>
 
 
                            <div class="form-group row">
                                <label for="serial_no" class="col-xs-3 col-form-label"><?php echo display('serial_no') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <div id="serial_preview">
                                        <div type="button" class="btn btn-success disabled btn-sm"> 01</div>
                                        <div type="button" class="btn btn-success disabled btn-sm"> 02</div>
                                        <div type="button" class="btn btn-success disabled btn-sm"> 03</div>...
                                        <div type="button" class="slbtn btn btn-success disabled btn-sm"> N</div>

                                    </div>
                                    <input type="hidden" name="schedule_id" id="schedule_id"/>
                                    <input type="hidden" name="serial_no" id="serial_no"/>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="problem" class="col-xs-3 col-form-label"><?php echo display('problem') ?></label>
                                <div class="col-xs-9">
                                    <textarea name="problem" class="form-control" placeholder="<?php echo display('problem') ?>" maxlength="140" rows="7"></textarea>
                                </div>
                            </div>  

                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('status') ?></label>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    //check patient id
    $('#patient_id').keyup(function(){
        var pid = $(this);

        $.ajax({
            url  : '<?= base_url('appointment/check_patient/') ?>',
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
 
    //department_id
    $("#department_id").change(function(){
        var output = $('.doctor_error'); 
        var doctor_list = $('#doctor_id');
        var available_day = $('#available_day');

        $.ajax({
            url  : '<?= base_url('appointment/doctor_by_department/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                department_id : $(this).val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    doctor_list.html(data.message);
                    available_day.html(data.available_days);
                    output.html('');
                } else if (data.status == false) {
                    doctor_list.html('');
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    doctor_list.html('');
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    }); 


    //doctor_id
    $("#doctor_id").change(function(){
        var doctor_id = $('#doctor_id'); 
        var output = $('#available_days'); 

        $.ajax({
            url  : '<?= base_url('appointment/schedule_day_by_doctor/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                doctor_id : $(this).val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    output.html(data.message).addClass('text-success').removeClass('text-danger');
                } else if (data.status == false) {
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    output.html(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    });


    //date
    $("#date").change(function(){
        var date        = $('#date'); 
        var serial_preview   = $('#serial_preview'); 
        var doctor_id   = $('#doctor_id'); 
        var schedule_id = $("#schedule_id"); 
        var patient_id  = $("#patient_id"); 
 
        $.ajax({
            url  : '<?= base_url('appointment/serial_by_date/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                doctor_id  : doctor_id.val(),
                patient_id : patient_id.val(), 
                date : $(this).val()
            },
            success : function(data) 
            { 
                if (data.status == true) {
                    //set schedule id
                    schedule_id.val(data.schedule_id); 
                    serial_preview.html(data.message);
                } else if (data.status == false) {
                    schedule_id.val('');
                    serial_preview.html(data.message).addClass('text-danger').removeClass('text-success');
                } else {
                    schedule_id.val('');
                    serial_preview.html(data.message).addClass('text-danger').removeClass('text-success');
                }
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    });

    //serial_no 
    $("body").on('click','.serial_no',function(){
        var serial_no = $(this).attr('data-item');
        $("#serial_no").val(serial_no);
        $('.serial_no').removeClass('btn-danger').addClass('btn-success').not(".disabled");
        $(this).removeClass('btn-success').addClass('btn-danger').not(".disabled");
    });

    $( ".datepicker-avaiable-days" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        showButtonPanel: false,
        minDate: 0,  
        // beforeShowDay: DisableDays 
     });


});
</script>


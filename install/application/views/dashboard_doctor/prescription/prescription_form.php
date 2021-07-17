<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_doctor/prescription/prescription") ?>"> <i class="fa fa-list"></i>  <?php echo display('prescription_list') ?> </a>  
                </div>
            </div> 

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 table-responsive">
                        <?php echo form_open('dashboard_doctor/prescription/prescription/create') ?> 

                        <!-- Information -->
                        <table class="table">
                            <thead>
                                <tr>  
                                    <th width="33.33%">
                                        <ul class="list-unstyled">
                                            <li> 
                                                <input type="text" placeholder="<?php echo display('patient_id') ?>" required name="patient_id" id="patient_id" class="invoice-input form-control" value="<?php echo (!empty($patient_id)?$patient_id:null) ?>">
                                                <p class="text-danger  invlid_patient_id"></p>
                                            </li>   
                                            <li> 
                                                <input type="text" placeholder="<?php echo display('patient_name') ?>" class="invoice-input form-control" id="patient_name">
                                            </li>  
                                            <li>  
                                                <input type="text" placeholder="<?php echo display('sex') ?>" class="invoice-input form-control" id="sex">
                                            </li>  
                                            <li>  
                                                <input type="text" placeholder="<?php echo display('date_of_birth') ?>" class="invoice-input form-control datepicker" id="date_of_birth">
                                            </li>  
                                        </ul>
                                    </th>  
                                    <th width="33.33%">
                                        <ul class="list-unstyled">
                                            <li> 
                                                <input type="text" name="weight" placeholder="<?php echo display('weight') ?>" required class="invoice-input form-control">
                                            </li>   
                                            <li> 
                                                <input type="text" name="blood_pressure" placeholder="<?php echo display('blood_pressure') ?>" class="invoice-input form-control">
                                            </li> 
                                            <li> 
                                                <input type="text"  name="reference_by" placeholder="<?php echo display('reference') ?>" class="invoice-input form-control">
                                            </li>  
                                            <li>  
                                                <div class="form-check form-control invoice-input">
                                                    <label class="radio-inline" style="padding:0 10px 0 0 ">Type </label>
                                                    <label class="radio-inline"><input type="radio" name="patient_type" value="New" checked><?php echo display('new') ?></label>
                                                    <label class="radio-inline"><input type="radio" name="patient_type" value="Old"><?php echo display('old') ?></label>
                                                </div> 
                                            </li>    
                                        </ul>
                                    </th>   
                                    <th width="33.33%">
                                        <ul class="list-unstyled">
                                            <li><input type="text" name="appointment_id" value="<?php echo (!empty($appointment_id)?$appointment_id:null) ?>" class="invoice-input form-control" placeholder="<?php echo display('appointment_id') ?>"></li>
                                            <li><input type="text" name="date" required value="<?php echo date('d-m-Y') ?>" class="datepicker invoice-input form-control" placeholder="<?php echo display('date') ?>"></li> 
                                            <li><input type="text" value="<?php echo $website->title; ?>" class="invoice-input form-control" placeholder="<?php echo display('hospital_name') ?>"></li> 
                                            <li><input type="text" value="<?php echo $website->description; ?>" class="invoice-input form-control" placeholder="<?php echo display('address') ?>"></li> 
                                        </ul>
                                    </th> 
                                </tr> 
                                <tr>
                                    <th colspan="2">
                                        <textarea type="text" required placeholder="<?php echo display('chief_complain') ?>" name="chief_complain" class="invoice-input form-control" ></textarea>
                                    </th> 
                                    <th>    
                                        <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm caseStudyBtn" data-toggle="modal" data-target="#myModal"><?php echo display('case_study') ?></button>
                                        <?php echo form_dropdown('insurance_id', $insurance_list, null, 'class="btn btn-sm select2"'); ?>
                                        </div>
                                    </th> 
                                </tr>
                            </thead>
                        </table>

                        

                        <!-- Medicine -->
                        <table class="table table-striped"> 
                            <thead>
                                <tr class="bg-primary">
                                    <th width="160"><?php echo display('medicine_name') ?></th>
                                    <th width="160"><?php echo display('medicine_type') ?></th>
                                    <th><?php echo display('instruction') ?></th>
                                    <th width="80"><?php echo display('days') ?></th>
                                    <th width="160"><?php echo display('add_or_remove') ?></th>  
                                </tr>
                            </thead>
                            <tbody id="medicine">
                                <tr>
                                    <td><input type="text" name="medicine_name[]" autocomplete="off" class="medicine form-control" placeholder="<?php echo display('medicine_name') ?>" ></td>
                                    <td><input type="text" name="medicine_type[]" autocomplete="off" class="form-control" placeholder="<?php echo display('medicine_type') ?>" ></td>
                                    <td><textarea name="medicine_instruction[]" class="form-control" placeholder="<?php echo display('instruction') ?>"></textarea></td> 
                                    <td><input type="text" name="medicine_days[]" autocomplete="off" class="form-control" placeholder="<?php echo display('days') ?>"  ></td> 
                                    <td>
                                      <div class="btn btn-group">
                                        <button type="button" class="btn btn-sm btn-primary MedAddBtn"><?php echo display('add') ?></button>
                                        <button type="button" class="btn btn-sm btn-danger MedRemoveBtn"><?php echo display('remove') ?></button>
                                        </div>
                                    </td>   
                                </tr>  
                            </tbody> 
                        </table> 


                        <!-- diagnosis -->
                        <table class="table table-striped"> 
                            <thead>
                                <tr class="bg-danger">
                                    <th width="230"><?php echo display('diagnosis') ?></th>
                                    <th><?php echo display('instruction') ?></th>
                                    <th width="160"><?php echo display('add_or_remove') ?></th>  
                                </tr>
                            </thead>
                            <tbody id="diagnosis">
                                <tr>
                                    <td><input type="text" name="diagnosis_name[]" autocomplete="off" class="form-control" placeholder="<?php echo display('diagnosis') ?>" ></td>
                                    <td><textarea name="diagnosis_instruction[]" class="form-control" placeholder="<?php echo display('instruction') ?>"></textarea></td> 
                                    <td>
                                      <div class="btn btn-group">
                                        <button type="button" class="btn btn-sm btn-primary DiaAddBtn"><?php echo display('add') ?></button>
                                        <button type="button" class="btn btn-sm btn-danger DiaRemoveBtn"><?php echo display('remove') ?></button>
                                        </div>
                                    </td>   
                                </tr>  
                            </tbody> 
                        </table>  


                        <!-- Fees & Comments -->
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="form-group row">
                                    <label for="visiting_fees" class="col-xs-3 col-form-label"><?php echo display('visiting_fees') ?></label>
                                    <div class="col-xs-9">
                                        <input name="visiting_fees"  type="text" class="form-control" id="visiting_fees" placeholder="<?php echo display('visiting_fees') ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="patient_notes" class="col-xs-3 col-form-label"><?php echo display('patient_notes') ?></label>
                                    <div class="col-xs-9">
                                        <textarea name="patient_notes" class="form-control"  placeholder="<?php echo display('patient_notes') ?>"></textarea>
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

                            </div>
                        </div>

                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo display('case_study') ?></h4>
      </div>
      <div class="modal-body" id="caseStudyOutput">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="<?php echo base_url("dashboard_doctor/prescription/case_study/create") ?>" class="btn btn-primary"><?php echo display('add_patient_case_study') ?></a>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {   
 
    //patient information 
    $('body').on("click", ".caseStudyBtn", function () {

        var patient_id = $("#patient_id").val();

        $.ajax({
            url     : '<?php echo base_url('dashboard_doctor/prescription/prescription/case_study') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'patient_id' : patient_id,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data) {

                    html = "<table class='table table-striped'>"+
                                "<thead>"+
                                    "<tr class='bg-info'>"+
                                        "<td>CASE</td>"+
                                        "<td>STATUS</td>"+ 
                                    "</tr>"+
                                "</thead>"+
                                "<tbody>";

                    $.each(data, function(i, v) {
                        if (i!='id' && i!='status') {
                            var i = i.replace('_', ' ').toUpperCase();
                            html += "<tr><td>"+i+"</td><td>"+v+"</td></tr>";
                        }
                    });

                    html += "</tbody></table>";

                    $("#caseStudyOutput").html(html);
                } else {
                    $("#caseStudyOutput").html("Invalid Patient ID");
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });   
    });

 
    // medicine list
    $('body').on('keyup change click', '.medicine', function(){
        $(this).autocomplete({
            source: [
                <?php 
                    if(!empty($medicine_list)) {
                        for ($i=0; $i<sizeof($medicine_list);$i++) { 
                            echo '"'.(!empty($medicine_list[$i])?$medicine_list[$i]:null).'",'; 
                        }
                    } 
                ?>
            ]
        });
    });    



    //#------------------------------------
    //   STARTS OF MEDICINE 
    //#------------------------------------    
    //add row
    $('body').on('click','.MedAddBtn' ,function() {
        var itemData = $(this).parent().parent().parent(); 
        $('#medicine').append("<tr>"+itemData.html()+"</tr>");
        $('#medicine tr:last-child').find(':input').val('');
    });
    //remove row
    $('body').on('click','.MedRemoveBtn' ,function() {
        $(this).parent().parent().parent().remove();
    });

    //#------------------------------------
    //   STARTS OF DIAGNOSIS 
    //#------------------------------------    
    //add row
    $('body').on('click','.DiaAddBtn' ,function() {
        var itemData = $(this).parent().parent().parent(); 
        $('#diagnosis').append("<tr>"+itemData.html()+"</tr>"); 
        $('#diagnosis tr:last-child').find(':input').val('');
    });
    //remove row
    $('body').on('click','.DiaRemoveBtn' ,function() {
        $(this).parent().parent().parent().remove();
    });


    //#------------------------------------
    //   ENDS OF PATIENT INFORMATION
    //#------------------------------------

    $(window).on('load', function(){
        var patient_id = '<?php echo $this->input->get('pid') ?>';
        if(patient_id.length > 0)
        patientInfo(patient_id);
    });

    $('body').on('keyup change', '#patient_id', function() {
        var patient_id = $(this).val();
        patientInfo(patient_id);
    });

    function patientInfo(patient_id)
    { 
        if(patient_id.length > 0)
        $.ajax({
            url     : '<?php echo base_url('dashboard_doctor/prescription/prescription/patient') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'patient_id' : patient_id,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $(".invlid_patient_id").text('');
                    $("#patient_name").val(data.name);
                    $("#sex").val(data.sex);
                    $("#date_of_birth").val(data.date_of_birth);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    } 

});
</script>
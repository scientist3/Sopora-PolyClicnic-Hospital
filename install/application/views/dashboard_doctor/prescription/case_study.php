<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_doctor/prescription/case_study/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient_case_study') ?> </a>  
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('patient_id') ?></th>
                            <th><?php echo display('food_allergies') ?></th>
                            <th><?php echo display('tendency_bleed') ?></th>
                            <th><?php echo display('heart_disease') ?></th>
                            <th><?php echo display('high_blood_pressure') ?></th>
                            <th><?php echo display('diabetic') ?></th>
                            <th><?php echo display('surgery') ?></th>
                            <th><?php echo display('accident') ?></th>
                            <th><?php echo display('others') ?></th>
                            <th><?php echo display('family_medical_history') ?></th>
                            <th><?php echo display('current_medication') ?></th>
                            <th><?php echo display('female_pregnancy') ?></th>
                            <th><?php echo display('breast_feeding') ?></th>
                            <th><?php echo display('health_insurance') ?></th>
                            <th><?php echo display('low_income') ?></th>
                            <th><?php echo display('reference') ?></th>
                            <th><?php echo display('status') ?></th> 
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($case_studys)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($case_studys as $case_study) { ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $case_study->patient_id; ?></td>
                                    <td><?php echo $case_study->food_allergies; ?></td>
                                    <td><?php echo $case_study->tendency_bleed; ?></td>
                                    <td><?php echo $case_study->heart_disease; ?></td>
                                    <td><?php echo $case_study->high_blood_pressure; ?></td>
                                    <td><?php echo $case_study->diabetic; ?></td>
                                    <td><?php echo $case_study->surgery; ?></td>
                                    <td><?php echo $case_study->accident; ?></td>
                                    <td><?php echo $case_study->others; ?></td>
                                    <td><?php echo $case_study->family_medical_history; ?></td>
                                    <td><?php echo $case_study->current_medication; ?></td>
                                    <td><?php echo $case_study->female_pregnancy; ?></td>
                                    <td><?php echo $case_study->breast_feeding; ?></td>
                                    <td><?php echo $case_study->health_insurance; ?></td>
                                    <td><?php echo $case_study->low_income; ?></td>
                                    <td><?php echo $case_study->reference; ?></td>
                                    <td><?php echo (($case_study->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("dashboard_doctor/prescription/case_study/edit/$case_study->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("dashboard_doctor/prescription/case_study/delete/$case_study->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

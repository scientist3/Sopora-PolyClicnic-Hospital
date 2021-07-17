<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("case_manager/patient/form") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th colspan="4" class="bg-info"><?php echo display('patient_information') ?></th>
                            <th colspan="8"></th>
                        </tr>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('patient_id') ?></th>
                            <th><?php echo display('patient_name') ?></th>
                            <th><?php echo display('mobile') ?></th>
                            <th><?php echo display('case_manager') ?></th>
                            <th><?php echo display('ref_doctor_name') ?></th>
                            <th><?php echo display('hospital_name') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th width="80"><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($patients as $patient) { ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><a href="<?php echo base_url("/case_manager/patient/profile/$patient->id"); ?>"><?php echo $patient->patient_id ?></a></td>
                                    <td><?php echo $patient->patient_name; ?></td>
                                    <td><?php echo $patient->mobile; ?></td>
                                    <td><?php echo $patient->case_manager; ?></td>
                                    <td><?php echo $patient->ref_doctor_name; ?></td>
                                    <td><?php echo $patient->hospital_name; ?></td>
                                    <td><?php echo $patient->date; ?></td> 
                                    <td><?php echo (($patient->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("case_manager/patient/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("case_manager/patient/form/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("case_manager/patient/delete/$patient->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> 
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
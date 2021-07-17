<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_doctor/patient/patient/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('id_no') ?></th>
                            <th><?php echo display('picture') ?></th>
                            <th><?php echo display('first_name') ?></th>
                            <th><?php echo display('last_name') ?></th>
                            <th><?php echo display('email') ?></th>
                            <th><?php echo display('phone') ?></th>
                            <th><?php echo display('mobile') ?></th>
                            <th><?php echo display('address') ?></th>
                            <th><?php echo display('sex') ?></th>
                            <th><?php echo display('blood_group') ?></th>
                            <th><?php echo display('action') ?></th>
                            <th><?php echo display('date_of_birth') ?></th>
                            <th><?php echo display('create_date') ?></th>
                            <th><?php echo display('status') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($patients as $patient) { ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $patient->patient_id; ?></td>
                                    <td><img src="<?php echo base_url($patient->picture); ?>"  width="65" height="50"/></td>
                                    <td><?php echo $patient->firstname; ?></td>
                                    <td><?php echo $patient->lastname; ?></td>
                                    <td><?php echo $patient->email; ?></td>
                                    <td><?php echo $patient->phone; ?></td>
                                    <td><?php echo $patient->mobile; ?></td>
                                    <td><?php echo $patient->address; ?></td>
                                    <td><?php echo $patient->sex; ?></td>
                                    <td><?php echo $patient->blood_group; ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("dashboard_doctor/patient/patient/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("dashboard_doctor/patient/patient/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 

                                        <a href="<?php echo base_url("dashboard_doctor/prescription/prescription/create?pid=$patient->patient_id") ?>" class="btn btn-xs btn-warning" title="Create Prescription"><i class="fa fa-plus"></i></a> 

                                    </td>
                                    <td><?php echo $patient->date_of_birth; ?></td> 
                                    <td><?php echo $patient->create_date; ?></td>
                                    <td><?php echo (($patient->status==1)?display('active'):display('inactive')); ?></td>
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
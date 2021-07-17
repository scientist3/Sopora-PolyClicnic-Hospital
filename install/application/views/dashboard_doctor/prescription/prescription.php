<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_doctor/prescription/prescription/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_prescription') ?> </a>  
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('patient_id') ?></th>
                            <th><?php echo display('appointment_id') ?></th>
                            <th><?php echo display('type') ?>
                            <th><?php echo display('doctor_name') ?></th></th> 
                            <th><?php echo display('visiting_fees') ?></th></th> 
                            <th><?php echo display('date') ?></th>
                            <th width="80"><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!empty($prescription)) {
                            $sl = 1;
                            foreach ($prescription as $value) {
                        ?>
                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td><?php echo $value->patient_id; ?></td>
                                <td><?php echo $value->appointment_id; ?></td>
                                <td><?php echo $value->patient_type; ?></td>
                                <td><?php echo $value->doctor_name; ?></td>
                                <td><?php echo $value->visiting_fees; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($value->date)); ?></td>
                                <td class="center">
                                    <a href="<?php echo base_url("dashboard_doctor/prescription/prescription/view/$value->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 

                                    <a href="<?php echo base_url("dashboard_doctor/prescription/prescription/edit/$value->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                    
                                    <a href="<?php echo base_url("dashboard_doctor/prescription/prescription/delete/$value->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> 
                                </td>
                            </tr>
                        <?php 
                            $sl++;

                            }
                        } 
                        ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

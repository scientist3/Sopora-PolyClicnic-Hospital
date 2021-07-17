<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th colspan="3" class="bg-info"><?php echo display('patient_information') ?></th>
                            <th colspan="8"></th>
                        </tr>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('patient_id') ?></th>
                            <th><?php echo display('patient_name') ?></th>
                            <th><?php echo display('mobile') ?></th>
                            <th><?php echo display('case_manager') ?></th>
                            <th><?php echo display('hospital_name') ?></th>
                            <th width="65"><?php echo display('date') ?></th>
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
                                    <td><a href="<?php echo base_url("dashboard_patient/case_manager/patient/profile/$patient->id"); ?>"><?php echo $patient->patient_id ?></a></td>
                                    <td><?php echo $patient->patient_name; ?></td>
                                    <td><?php echo $patient->mobile; ?></td>
                                    <td><?php echo $patient->case_manager; ?></td>
                                    <td><?php echo $patient->hospital_name; ?></td>
                                    <td><?php echo $patient->date; ?></td> 
                                    <td><?php echo (($patient->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("dashboard_patient/case_manager/patient/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
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
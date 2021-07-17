<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("schedule/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_schedule') ?> </a>  
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr> 
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('doctor_name') ?></th>
                            <th><?php echo display('department_name') ?></th>
                            <th><?php echo display('day') ?></th>
                            <th><?php echo display('start_time') ?></th>
                            <th><?php echo display('end_time') ?></th>
                            <th><?php echo display('per_patient_time') ?></th>
                            <th><?php echo display('serial_visibility_type') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($schedules)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($schedules as $schedule) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $schedule->firstname; ?> <?php echo $schedule->lastname; ?></td>
                                    <td><?php echo $schedule->name; ?></td>
                                    <td><?php echo $schedule->available_days; ?></td>
                                    <td><?php echo $schedule->start_time; ?></td>
                                    <td><?php echo $schedule->end_time; ?></td>
                                    <td><?php echo $schedule->per_patient_time; ?></td>
                                    <td><?php echo (($schedule->serial_visibility_type==1)?display('sequential'):display('timestamp')); ?></td>
                                    <td><?php echo (($schedule->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("schedule/edit/$schedule->schedule_id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("schedule/delete/$schedule->schedule_id") ?>" onclick="return confirm('<?php echo display('are_you_sure') ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> 
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
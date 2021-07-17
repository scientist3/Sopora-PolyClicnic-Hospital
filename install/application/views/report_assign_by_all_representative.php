<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default">
            <div class="panel-body">

                <form class="form-inline" action="<?php echo base_url('report/assign_by_all_representative') ?>">

                    <div class="form-group">
                        <label class="sr-only" for="user_id">Type</label>
                        <?php echo form_dropdown('user_id',$user_list,$user->user_id,' class="form-control" id="user_id"'); ?>
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                        <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo $user->start_date ?>">
                    </div>  
                    <div class="form-group">
                        <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                        <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo $user->end_date ?>">
                    </div>  

                    <button type="submit" class="btn btn-success"><?php echo display('filter') ?></button>

                </form>

            </div>
        </div>
    </div>


    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default">
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('appointment_id') ?></th>
                            <th><?php echo display('patient_id') ?></th>
                            <th><?php echo display('department') ?></th>
                            <th><?php echo display('doctor_name') ?></th>
                            <th><?php echo display('serial_no') ?></th>
                            <th><?php echo display('problem') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('status') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($appointments)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($appointments as $appointment) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $appointment->appointment_id; ?></td>
                                    <td><?php echo $appointment->patient_id; ?></td>
                                    <td><?php echo $appointment->name; ?></td>
                                    <td><?php echo $appointment->firstname.' '.$appointment->lastname; ?></td>
                                    <td><?php echo $appointment->serial_no; ?></td>
                                    <td><?php echo $appointment->problem; ?></td>
                                    <td><?php echo $appointment->date; ?></td>
                                    <td><?php echo (($appointment->status==1)?display('active'):display('inactive')); ?></td> 
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
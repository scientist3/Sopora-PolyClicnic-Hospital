<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("doctor/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_doctor') ?> </a>  
                </div>
            </div> 

            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('picture') ?></th>
                            <th><?php echo display('first_name') ?></th>
                            <th><?php echo display('last_name') ?></th>
                            <th><?php echo display('department') ?></th>
                            <th><?php echo display('email') ?></th> 
                            <th><?php echo display('mobile') ?></th> 
                            <th><?php echo display('phone') ?></th> 
                            <th><?php echo display('action') ?></th> 
                            <th><?php echo display('address') ?></th>
                            <th><?php echo display('sex') ?></th> 
                            <th><?php echo display('blood_group') ?></th> 
                            <th><?php echo display('date_of_birth') ?></th> 
                            <th><?php echo display('user_role') ?></th> 
                            <th><?php echo display('create_date') ?></th> 
                            <th><?php echo display('status') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($doctors)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($doctors as $doctor) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><img src="<?php echo base_url($doctor->picture); ?>" alt="" width="65" height="50"/></td>
                                    <td><?php echo $doctor->firstname; ?></td>
                                    <td><?php echo $doctor->lastname; ?></td>
                                    <td><?php echo $doctor->name; ?></td>
                                    <td><?php echo $doctor->email; ?></td>
                                    <td><?php echo $doctor->mobile; ?></td>
                                    <td><?php echo $doctor->phone; ?></td>
                                    <td>
                                        <div class="action-btn">
                                        <a href="<?php echo base_url("doctor/profile/$doctor->user_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("doctor/edit/$doctor->user_id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("doctor/delete/$doctor->user_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?> ')"><i class="fa fa-trash"></i></a>
                                        </div> 
                                    </td>
                                    <td><?php echo $doctor->address; ?></td>
                                    <td><?php echo $doctor->sex; ?></td>
                                    <td><?php echo $doctor->blood_group; ?></td>
                                    <td><?php echo $doctor->date_of_birth; ?></td>
                                    <td><?php echo (($doctor->user_role == 2)?display('doctor'):null) ?></td> 
                                    <td><?php echo $doctor->create_date; ?></td>
                                    <td><?php echo (($doctor->status==1)?display('active'):display('inactive')); ?></td>
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

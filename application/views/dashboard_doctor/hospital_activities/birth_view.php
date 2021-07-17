<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_doctor/hospital_activities/birth/form") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_birth_report') ?> </a> 
                </div>
            </div> 
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('patient_id') ?></th>
                            <th><?php echo display('title') ?></th>
                            <th><?php echo display('description') ?></th>
                            <th><?php echo display('doctor_name') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($births)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($births as $birth) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $birth->patient_id; ?></td>
                                    <td><?php echo $birth->title; ?></td>
                                    <td><?php echo character_limiter($birth->description, 60); ?></td>
                                    <td><?php echo $birth->doctor_name; ?></td>
                                    <td><?php echo (($birth->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center" width="80">
                                        <a href="<?php echo base_url("dashboard_doctor/hospital_activities/birth/details/$birth->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
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

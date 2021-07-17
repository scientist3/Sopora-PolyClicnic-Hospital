<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("hospital_activities/death/form") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_death_report') ?> </a> 
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
                        <?php if (!empty($deaths)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($deaths as $death) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $death->patient_id; ?></td>
                                    <td><?php echo $death->title; ?></td>
                                    <td><?php echo character_limiter($death->description, 60); ?></td>
                                    <td><?php echo $death->doctor_name; ?></td>
                                    <td><?php echo (($death->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center" width="80">
                                        <a href="<?php echo base_url("hospital_activities/death/details/$death->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("hospital_activities/death/form/$death->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("hospital_activities/death/delete/$death->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
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

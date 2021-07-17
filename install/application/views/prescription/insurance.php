<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("prescription/insurance/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_insurance') ?> </a>  
                </div>
            </div>
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('insurance_name') ?></th>
                            <th><?php echo display('description') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($insurances)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($insurances as $insurance) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $insurance->name; ?></td>
                                    <td><?php echo character_limiter($insurance->description, 60); ?></td>
                                    <td><?php echo (($insurance->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("prescription/insurance/edit/$insurance->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("prescription/insurance/delete/$insurance->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
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

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("hospital_activities/medicine/form") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_medicine') ?> </a> 
                </div>
            </div> 

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('medicine_name') ?></th>
                            <th><?php echo display('category_name') ?></th>
                            <th><?php echo display('description') ?></th>
                            <th><?php echo display('price') ?></th>
                            <th><?php echo display('manufactured_by') ?></th>
                            <th><?php echo display('status') ?></th> 
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($medicines)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($medicines as $medicine) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $medicine->name; ?></td>
                                    <td><?php echo $medicine->category; ?></td>
                                    <td><?php echo character_limiter(strip_tags($medicine->description),50); ?></td>
                                    <td><?php echo $medicine->price; ?></td>
                                    <td><?php echo $medicine->manufactured_by; ?></td>
                                    <td><?php echo (($medicine->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center" width="80">
                                        <a href="<?php echo base_url("hospital_activities/medicine/details/$medicine->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("hospital_activities/medicine/form/$medicine->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("hospital_activities/medicine/delete/$medicine->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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
 
 
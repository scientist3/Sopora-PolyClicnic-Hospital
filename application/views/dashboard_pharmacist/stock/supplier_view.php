<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_pharmacist/hospital_activities/stock/addSupplier") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_supplier') ?> </a> 
                </div>
            </div> 

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('name') ?></th>
                            <th><?php echo display('address') ?></th>
                            <th><?php echo display('company') ?></th>
                            <th><?php echo display('phone') ?></th>
                            <th><?php echo display('status') ?></th> 
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($supplier)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($supplier as $suppliers) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $suppliers->name; ?></td>
                                    <td><?php echo $suppliers->address; ?></td>
                                    <td><?php echo $suppliers->company; ?></td>
                                    <td><?php echo $suppliers->phone; ?></td>
                                    
                                    <td><?php echo (($suppliers->status==1)?display('active'):display('inactive')); ?></td>
                                    
                                    <td class="center" width="80">
                                        <a href="<?php echo base_url("dashboard_pharmacist/hospital_activities/stock/addSupplier/$suppliers->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <?php /* <a href="<?php echo base_url("dashboard_pharmacist/hospital_activities/medicine/delete/$suppliers->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> */?>
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
 
 
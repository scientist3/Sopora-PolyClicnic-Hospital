<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_pharmacist/hospital_activities/stock/purchase") ?>"> <i class="fa fa-plus"></i>  <?php echo display('addPurchase') ?> </a> 
                </div>
            </div> 

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('billNo') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('itemName') ?></th>
                            <th><?php echo display('supplier') ?></th>
                            <th><?php echo display('cash_credit') ?></th>
                            <th><?php echo display('quantity') ?></th>
                            <th><?php echo display('discount') ?></th>
                            <th><?php echo display('amount') ?></th>
                            <th><?php echo display('status') ?></th> 
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($purchase)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($purchase as $p) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $p->billno; ?></td>
                                    <td><?php echo $p->date; ?></td>
                                    <td><?php echo $p->item_id; ?></td>
                                    <td><?php echo $p->supplier_id; ?></td>
                                    <td><?php echo $p->cash_credit; ?></td>
                                    <td><?php echo $p->quantity; ?></td>
                                    <td><?php echo $p->discount; ?></td>
                                    <td><?php echo $p->netValue; ?></td>
                                    
                                    <?php /* <td><?php echo character_limiter(strip_tags($medicine->description),50); ?></td>*/?>
                                    
                                    <td><?php echo (($p->status==1)?display('active'):display('inactive')); ?></td>
                                    
                                    <td class="center" width="80">
                                        <?php /* <a href="<?php echo base_url("dashboard_pharmacist/hospital_activities/medicine/details/$medicine->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("dashboard_pharmacist/hospital_activities/medicine/form/$medicine->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                         */?>
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
 
 
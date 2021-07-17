<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_receptionist/account/account/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_transaction') ?> </a>  
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('user_id') ?></th>
                            <th><?php echo display('transaction_id') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('credit') ?></th>
                            <th><?php echo display('debit') ?></th>
                            <th><?php echo display('balance') ?></th>
                            <th><?php echo display('status') ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($accounts)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($accounts as $account) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $account->user_id; ?></td>
                                    <td><?php echo $account->transaction_id; ?></td>
                                    <td><?php echo $account->date; ?></td>
                                    <td><?php echo $account->credit; ?></td>
                                    <td><?php echo $account->debit; ?></td>
                                    <td><?php echo $account->balance; ?></td>
                                    <td><?php echo (($account->status==1)?"Active":"Inactive"); ?></td>
                                    
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
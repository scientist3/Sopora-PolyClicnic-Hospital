<div class="row">
 
    <!-- debit part --> 
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("account_manager/account/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_account') ?> </a>  
                </div>
            </div> 

            <div class="panel-heading"><h4><?php echo display('debit') ?></h4></div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('account_name') ?></th>
                            <th><?php echo display('description') ?>
                            <th><?php echo display('type') ?></th></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!empty($accounts)) {
                            $sl = 1;
                            foreach ($accounts as $account) {
                                if($account->type == 1) { 
                        ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $account->name; ?></td>
                                    <td><?php echo character_limiter($account->description, 120); ?></td>
                                    <td><?php echo (($account->type==1)?display('debit'):display('credit')); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($account->date)); ?></td>
                                    <td><?php echo (($account->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("account_manager/account/edit/$account->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("account_manager/account/delete/$account->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                        <?php 
                                $sl++;

                                }
                            }
                        } 
                        ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
            
            <div class="panel-heading"><h4><?php echo display('credit') ?></h4></div>
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('account_name') ?></th>
                            <th><?php echo display('description') ?>
                            <th><?php echo display('type') ?></th></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!empty($accounts)) {
                            $sl = 1;
                            foreach ($accounts as $account) {
                                if($account->type == 2) { 
                        ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $account->name; ?></td>
                                    <td><?php echo character_limiter($account->description, 120); ?></td>
                                    <td><?php echo (($account->type==1)?display('debit'):display('credit')); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($account->date)); ?></td>
                                    <td><?php echo (($account->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("account_manager/account/edit/$account->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("account_manager/account/delete/$account->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                        <?php 
                                $sl++;

                                }
                            }
                        } 
                        ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>

</div>

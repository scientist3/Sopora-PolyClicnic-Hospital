<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("account_manager/payment/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_payment') ?> </a>  
                </div>
            </div> 

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('account_name') ?></th>
                            <th><?php echo display('pay_to') ?></th>
                            <th><?php echo display('description') ?>
                            <th><?php echo display('amount') ?></th></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!empty($payments)) {
                            $sl = 1;
                            foreach ($payments as $payment) {
                        ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($payment->date)); ?></td>
                                    <td><?php echo $payment->account_name; ?></td> 
                                    <td><?php echo $payment->pay_to; ?></td> 
                                    <td><?php echo character_limiter($payment->description, 120); ?></td>  
                                    <td><?php echo number_format($payment->amount,2); ?></td>  
                                    <td><?php echo (($payment->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("account_manager/payment/edit/$payment->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("account_manager/payment/delete/$payment->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                        <?php 
                                $sl++;
                            }
                        } 
                        ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

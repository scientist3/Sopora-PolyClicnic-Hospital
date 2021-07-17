<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_accountant/account_manager/payment") ?>"> <i class="fa fa-list"></i>  <?php echo display('payment_list') ?> </a>  
                </div>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('dashboard_accountant/account_manager/payment/create','class="form-inner"') ?>

                            <?php echo form_hidden('id',$payment->id) ?>

                            <div class="form-group row">
                                <label for="date" class="col-xs-3 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="date"  type="text" class="form-control datepicker" id="date" placeholder="<?php echo display('date') ?>" value="<?php echo $payment->date ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="account_name" class="col-xs-3 col-form-label"><?php echo display('account_name') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('account_id', $credit_acc_list , $payment->account_id, ' class="form-control" id="account_name" ');  ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pay_to" class="col-xs-3 col-form-label"><?php echo display('pay_to') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="pay_to"  type="text" class="form-control" id="pay_to" placeholder="<?php echo display('pay_to') ?>" value="<?php echo $payment->pay_to ?>">
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="description" class="col-xs-3 col-form-label"><?php echo display('description') ?></label>
                                <div class="col-xs-9">
                                    <textarea name="description" class="form-control"  placeholder="<?php echo display('description') ?>" rows="7"><?php echo $payment->description ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-xs-3 col-form-label"><?php echo display('amount') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="amount"  type="text" class="form-control" id="amount" placeholder="<?php echo display('amount') ?>" value="<?php echo $payment->amount ?>">
                                </div>
                            </div>                            

                            <!--Radio-->
                            <div class="form-group row">
                                <label class="col-sm-3"><?php echo display('status') ?></label>
                                <div class="col-xs-9"> 
                                    <div class="form-check">
                                        <label class="radio-inline"><input type="radio" name="status" value="1" checked><?php echo display('active') ?></label>
                                        <label class="radio-inline"><input type="radio" name="status" value="0"><?php echo display('inactive') ?></label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('save') ?></button>
                                    </div>
                                </div>
                            </div>

                        <?php echo form_close() ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_accountant/account_manager/invoice/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_invoice') ?> </a>  
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_accountant/account_manager/invoice") ?>"> <i class="fa fa-list"></i>  <?php echo display('invoice_list') ?> </a>  

                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i class="fa fa-print"></i></button> 
                </div>
            </div> 
 
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 table-responsive" id="PrintMe">
                        <?php echo form_open('dashboard_accountant/account_manager/invoice/create') ?> 
                        <table class="table table-striped">
                            <thead>
                                <tr>  
                                    <th width="40%">
                                        <ul class="list-unstyled"> 
                                            <li>
                                                <strong><?php echo display('patient_id') ?></strong>
                                                <span class="invoice-input">
                                                <?php echo $invoice->patient_id ?></span>
                                            </li>   
                                            <li><strong><?php echo display('full_name') ?></strong> 
                                                <span class="invoice-input">
                                                <?php echo $invoice->firstname ?> <?php echo $invoice->lastname ?></span>
                                            </li>  
                                            <li> 
                                            <strong><?php echo display('address') ?>&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                <span class="invoice-input">
                                                <?php echo $invoice->address ?></span>
                                            </li>  
                                        </ul>
                                    </th>  
                                    <th width="20%" class="text-center"> 
                                        <strong style="border:1px solid #ccc;line-height:60px;padding:5px 10px;"><?php echo display('invoice') ?></strong> 
                                    </th>  
                                    <th width="40%">
                                        <h4>
                                            <?php echo display('date') ?> :  
                                            <span class="invoice-input"><?php echo date('d-m-Y', strtotime($invoice->date)); ?></span><br> 
                                            <?php echo $website->title; ?><br> 
                                            <?php echo $website->description; ?>
                                        </h4>
                                    </th> 
                                </tr>
                            </thead>
                        </table>



                        <table id="invoice" class="table table-striped"> 
                            <thead>
                                <tr class="bg-primary">
                                    <th><?php echo display('account_name') ?></th>
                                    <th><?php echo display('description') ?></th>
                                    <th><?php echo display('quantity') ?></th>
                                    <th><?php echo display('price') ?></th>
                                    <th width="160" class="text-center"><?php echo display('subtotal') ?></th>
                                </tr>
                            </thead>
                            
                            <!-- showing data -->
                            <tbody>
                                <?php 
                                if (!empty($invoice_data)) {
                                    foreach ($invoice_data as $value) {
                                ?>
                                <tr>
                                    <td><?php echo $value->name ?></td>
                                    <td><?php echo $value->description ?></td>
                                    <td><?php echo sprintf('%0.2f', $value->quantity) ?></td>
                                    <td><?php echo sprintf('%0.2f', $value->price) ?></td>
                                    <td class="text-center"><?php echo sprintf('%0.2f', $value->subtotal) ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?> 
                            </tbody>
                            <!-- ends of showing data -->

                            <tfoot> 
                                <tr class="bg-info">  
                                    <td colspan="3"></td> 
                                    <th><?php echo display('total') ?></th>  
                                    <th class="text-center"><?php echo sprintf('%0.2f', $invoice->total) ?></th>   
                                </tr>
                                <tr>  
                                    <td colspan="3"></td> 
                                    <th><?php echo display('vat') ?></th>
                                    <th class="text-center"><?php echo sprintf('%0.2f', $invoice->vat) ?></th>    
                                </tr>
                                <tr>  
                                    <td colspan="3"></td> 
                                    <th><?php echo display('discount') ?></th>
                                    <th class="text-center"><?php echo sprintf('%0.2f', $invoice->discount) ?></th>    
                                </tr>
                                <tr class="bg-success">  
                                    <td colspan="3"></td> 
                                    <th><?php echo display('grand_total') ?></th>
                                    <th class="text-center"><?php echo sprintf('%0.2f', $invoice->grand_total) ?></th>    
                                </tr>
                                <tr>  
                                    <td colspan="3"></td> 
                                    <th><?php echo display('paid') ?></th>
                                    <th class="text-center"><?php echo sprintf('%0.2f', $invoice->paid) ?></th>    
                                </tr>
                                <tr class="bg-danger">
                                    <td colspan="3"></td> 
                                    <th><?php echo display('due') ?></th>
                                    <th class="text-center"><?php echo sprintf('%0.2f', $invoice->due) ?></th>    
                                </tr> 
                            </tfoot>
                        </table>  
                        <?php echo form_close() ?>
                    </div>
 
                </div>
            </div>
        </div>
    </div>
</div>

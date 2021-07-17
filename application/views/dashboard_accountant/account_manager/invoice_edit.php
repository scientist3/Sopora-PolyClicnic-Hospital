<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_accountant/account_manager/invoice") ?>"> <i class="fa fa-list"></i>  <?php echo display('invoice_list') ?> </a>  
                </div>
            </div> 

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 table-responsive">
                        <?php echo form_open('dashboard_accountant/account_manager/invoice/edit/'.$invoice->id) ?> 
                        <?php echo form_hidden('id',$invoice->id) ?>
                        <table class="table table-striped">
                            <tfoot>
                                <tr>  
                                    <th width="40%">
                                        <ul class="list-unstyled"> 
                                            <li>
                                                <strong><?php echo display('patient_id') ?></strong>
                                                <input type="text" required name="patient_id" id="patient_id" class="invoice-input" value="<?php echo $invoice->patient_id; ?>">
                                                <p class="text-center text-danger  invlid_patient_id" 
                                                ></p>
                                            </li>   
                                            <li><strong><?php echo display('full_name') ?></strong>
                                                <input type="text" class="invoice-input" id="patient_name" value="<?php echo $invoice->firstname.' '.$invoice->lastname?>">
                                            </li>  
                                            <li> 
                                            <strong><?php echo display('address') ?>&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                <input type="text" class="invoice-input" id="patient_address" value="<?php echo $invoice->address; ?>">
                                            </li>  
                                        </ul>
                                    </th>  
                                    <th width="20%" class="text-center"> 
                                        <strong style="border:1px solid #ccc;line-height:60px;padding:5px 10px;"><?php echo display('invoice') ?></strong> 
                                    </th>  
                                    <th width="40%">
                                        <h4>
                                            <?php echo display('date') ?> :  
                                            <input type="text" name="date" required class="datepicker invoice-input" value="<?php echo date('d-m-Y', strtotime($invoice->date)); ?>"> <br>
                                            <?php echo $website->title; ?><br> 
                                            <?php echo $website->description; ?>
                                        </h4>
                                    </th> 
                                </tr>
                            </tfoot>
                        </table>



                        <table id="invoice" class="table table-striped"> 
                            <thead>
                                <tr class="bg-primary">
                                    <th><?php echo display('account_name') ?></th>
                                    <th><?php echo display('description') ?></th>
                                    <th width="50"><?php echo display('quantity') ?></th>
                                    <th width="120"><?php echo display('price') ?></th>
                                    <th width="120"><?php echo display('subtotal') ?></th>  
                                    <th width="160"><?php echo display('add_or_remove') ?></th>  
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!empty($invoice_data)) { 
                                foreach ($invoice_data as $value) { 
                                ?>
                                <tr>
                                    <td>
                                        <?php echo form_dropdown('account_id[]', $debit_account_list, $value->account_id , 'class="dont-select-me form-control" required'); ?>
                                    </td> 
                                    <td><textarea name="description[]" class="form-control" placeholder="<?php echo display('description') ?>"><?php echo $value->description ?></textarea></td> 
                                    <td><input type="text" name="quantity[]" required autocomplete="off" class="totalCal form-control" placeholder="<?php echo display('quantity') ?>" value="<?php echo $value->quantity ?>" ></td>  
                                    <td><input type="text" name="price[]" required autocomplete="off" class="totalCal form-control" placeholder="<?php echo display('price') ?>" value="<?php echo $value->price ?>"></td>  
                                    <td><input type="text" name="subtotal[]" required readonly autocomplete="off" class="subtotal form-control" placeholder="<?php echo display('subtotal') ?>" value="<?php echo $value->subtotal ?>"></td>   

                                    <td>
                                      <div class="btn btn-group">
                                        <button type="button" class="btn btn-sm btn-primary addBtn"><?php echo display('add') ?></button>
                                        <button type="button" class="btn btn-sm btn-danger removeBtn"><?php echo display('remove') ?></button>
                                        </div>
                                    </td>   
                                </tr>  
                                <?php 
                                } 
                                } 
                                ?>
                            </tbody>
                            <tfoot> 
                                <tr class="bg-info">  
                                    <td colspan="3"></td> 
                                    <th class="text-right"><?php echo display('total') ?></th>  
                                    <th><input type="text" name="total" id="total" class="form-control" readonly required placeholder="<?php echo display('total') ?>"  value="<?php echo $invoice->total ?>"></th>  
                                    <td></td> 
                                </tr>
                                <tr>  
                                    <th colspan="3" class="text-right"><?php echo display('vat') ?></th> 
                                    <td>
                                        <div class="input-group">
                                          <div class="input-group-addon">%</div>
                                          <input type="text" id="vatParcent" required autocomplete="off"  class="form-control" value="0">
                                        </div>
                                    </td> 
                                    <td><input type="text" name="vat" id="vat" required autocomplete="off"  class="vatDiscount paidDue form-control" placeholder="<?php echo display('vat') ?>" value="<?php echo $invoice->vat ?>"></td>  
                                    <td></td> 
                                </tr>
                                <tr>  
                                    <th colspan="3" class="text-right"><?php echo display('discount') ?></th> 
                                    <td>
                                        <div class="input-group">
                                          <div class="input-group-addon">%</div>
                                          <input type="text" id="discountParcent" required autocomplete="off" class=" form-control" value="0">
                                        </div>
                                    </td> 

                                    <td><input type="text" name="discount" required autocomplete="off" id="discount" class="vatDiscount paidDue form-control" placeholder="<?php echo display('discount') ?>"  value="<?php echo $invoice->discount ?>"></td> 
                                    <td></td>  
                                </tr> 
                                <tr class="bg-success">  
                                    <td colspan="3"></td>  
                                    <th class="text-right"><?php echo display('grand_total') ?></th>  
                                    <th><input type="text" name="grand_total" readonly required autocomplete="off"  id="grand_total" class="paidDue form-control" placeholder="<?php echo display('grand_total') ?>" value="<?php echo $invoice->grand_total ?>"></th> 
                                    <td></td>  
                                </tr>
                                <tr>  
                                    <td colspan="3"></td>  
                                    <th class="text-right"><?php echo display('paid') ?></th>
                                    <td><input type="text" name="paid" id="paid" autocomplete="off"  class="paidDue form-control" required placeholder="<?php echo display('paid') ?>"  value="<?php echo $invoice->paid ?>"></td> 
                                    <td></td>  
                                </tr>
                                <tr class="bg-danger">  
                                    <td colspan="3"></td>  
                                    <th class="text-right"><?php echo display('due') ?></th> 
                                    <td><input type="text" name="due" id="due" autocomplete="off" class="paidDue form-control" required placeholder="<?php echo display('due') ?>" value="<?php echo $invoice->due ?>"></td> 
                                    <td></td>  
                                </tr>
                                <tr>  
                                    <td colspan="3">
                                        <div class="form-group row">
                                            <label class="col-sm-3"><?php echo display('status') ?></label>
                                            <div class="col-xs-9"> 
                                                <div class="form-check">
                                                    <label class="radio-inline"><input type="radio" name="status" value="1" checked><?php echo display('active') ?></label>
                                                    <label class="radio-inline"><input type="radio" name="status" value="0"><?php echo display('inactive') ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>  
                                    <td><button type="reset" class="btn btn-info btn-block"><?php echo display('reset') ?></button></td>  
                                    <td><button class="btn btn-success btn-block"><?php echo display('update') ?></button></td>  
                                    <td></td> 
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



<script type="text/javascript">
$(document).ready(function() {   
    //#------------------------------------
    //   STARTS OF DYNAMIC FORM 
    //#------------------------------------     

    // add row
    var body      = $('#invoice > tbody');
    $('body').on('click','.addBtn' ,function() {
        var itemData = $(this).parent().parent().parent().html();
        body.append("<tr>"+itemData+"</tr>"); 

        $('#invoice tbody tr:last-child input').each(function() {   
            $(this).val('');
        }); 

        $('#invoice tbody tr:last-child textarea').each(function() {
            $(this).val('');
        }); 

        $('#invoice tbody tr:last-child select').each(function() {  
            $(this).val('');
        }); 

    });

    //remove row
    $('body').on('click','.removeBtn' ,function() {
        $(this).parent().parent().parent().remove();

        //total   
        var total = 0;  
        $('.subtotal').each(function(){ 
            total  += parseFloat($(this).val());
            $('#total').val(total.toFixed(2));
        }); 

        // vat in parcent
        var vatParcent  = $('#vatParcent').val();   
        $('#vat').val(parseFloat((total * vatParcent) / 100).toFixed(2)); 

        // discount in parcent
        var discountParcent  = $('#discountParcent').val();   
        $('#discount').val(parseFloat((total * discountParcent) / 100).toFixed(2));  

        //vat and discount
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2));

        // paid and due
        var grand_total = $('#grand_total').val();
        var paid        = $('#paid').val();
        $('#due').val((parseFloat(grand_total)-parseFloat(paid)).toFixed(2)); 
    });


    //#------------------------------------
    //   STARTS OF CALCULATION 
    //#------------------------------------

    //calculate total 
    $('body').on('keyup', '.totalCal', function() {
        var totalCal = $(this).parent().parent();
        var quantity  = totalCal.children().next().next().children().val();
        var price  = totalCal.children().next().next().next().children().val(); 
        totalCal.children().next().next().next().next().children().val(
            (quantity*price).toFixed(2));

        /*calculate total invoice*/
        //total   
        var total = 0;
        $('.subtotal').each(function(){ 
            total  += parseFloat($(this).val());
            $('#total').val(total.toFixed(2));
        });  

        // vat in parcent
        var vatParcent  = $('#vatParcent').val();   
        $('#vat').val(parseFloat((total * vatParcent) / 100).toFixed(2));  

        // discount in parcent
        var discountParcent  = $('#discountParcent').val();   
        $('#discount').val(parseFloat((total * discountParcent) / 100).toFixed(2)); 

        //grand total
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2));

        // paid and due
        var grand_total = $('#grand_total').val();
        var paid        = $('#paid').val();
        $('#due').val((parseFloat(grand_total)-parseFloat(paid)).toFixed(2));  
    }); 

    // vat and discount
    $('body').on('change keyup', '.vatDiscount', function() {
        var total       = $('#total').val();
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2)); 
        $("#vatParcent").val(parseFloat((vat/total) * 100).toFixed(2)); 
        $("#discountParcent").val(parseFloat((discount/total) * 100).toFixed(2)); 
    });

    // vat in parcent
    $('body').on('keyup change', '#vatParcent', function() {
        var total       = $('#total').val(); 
        $('#vat').val(parseFloat((total * $(this).val()) / 100).toFixed(2)); 

        // vat in parcent
        var total       = $('#total').val();
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2));

        // paid and due
        var grand_total = $('#grand_total').val();
        var paid        = $('#paid').val();
        $('#due').val((parseFloat(grand_total)-parseFloat(paid)).toFixed(2)); 
    });

    // discount in parcent
    $('body').on('keyup change', '#discountParcent', function() {
        var total      = $('#total').val(); 
        $('#discount').val(parseFloat((total * $(this).val()) / 100).toFixed(2)); 

        // vat in parcent
        var total       = $('#total').val();
        var vat         = $('#vat').val();
        var discount    = $('#discount').val(); 
        $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2));

        // paid and due
        var grand_total = $('#grand_total').val();
        var paid        = $('#paid').val();
        $('#due').val((parseFloat(grand_total)-parseFloat(paid)).toFixed(2));  
    });

    // paid and due
    $('body').on('keyup change', '.paidDue', function() {
        var grand_total = $('#grand_total').val();
        var paid        = $('#paid').val();
        $('#due').val((parseFloat(grand_total)-parseFloat(paid)).toFixed(2)); 
    }); 
 


    //#------------------------------------
    //   PATIENT INFORMATION
    //#------------------------------------

    $('body').on('keyup change', '#patient_id', function() {
        var patient_id = $(this).val();

        if(patient_id.length > 0)
        $.ajax({
            url     : '<?php echo base_url('dashboard_accountant/account_manager/invoice/patient') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'patient_id' : patient_id,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $(".invlid_patient_id").text('');
                    $("#patient_name").val(data.patient_name);
                    $("#patient_address").val(data.patient_address);
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });

});

 

/*-----------------------------------------------*/
/*   LOAD VAT/DISCOUNT PERCENT AUTOMATICALLY     */
/*-----------------------------------------------*/

$(window).on('load', function() {
    var total       = $('#total').val();
    var vat         = $('#vat').val();
    var discount    = $('#discount').val(); 
    $("#grand_total").val(((parseFloat(total)+parseFloat(vat))-(parseFloat(discount))).toFixed(2)); 
    $("#vatParcent").val(parseFloat((vat/total) * 100).toFixed(2)); 
    $("#discountParcent").val(parseFloat((discount/total) * 100).toFixed(2)); 
});
</script>
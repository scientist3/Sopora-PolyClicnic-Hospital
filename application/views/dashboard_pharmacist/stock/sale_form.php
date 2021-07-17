<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_pharmacist/hospital_activities/stock/listSale") ?>"> <i class="fa fa-list"></i>  <?php echo display('list_sale') ?> </a>  
                </div>
            </div> 

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 table-responsive">
                        <!-- FormSale Start -->
                        <?php echo form_open('dashboard_pharmacist/hospital_activities/stock/sale') ?> 
                        <table class="table table-striped">
                            <tfoot>
                                <tr>  
                                    <th width="40%">
                                        <ul class="list-unstyled"> 
                                            <li>
                                                <strong><?php echo display('patient_id') ?></strong>
                                                <input type="text"  name="patient_id" id="patient_id" class="invoice-input">
                                                <p class="text-center text-danger  invlid_patient_id"></p>
                                            </li>   
                                            <li><strong><?php echo display('full_name') ?></strong>
                                                <input type="text" class="invoice-input" id="patient_name" name="pName">
                                            </li>  
                                            <li> 
                                            <strong><?php echo display('address') ?>&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                <input type="text" class="invoice-input" id="patient_address" name="pAddress">
                                            </li>  
                                        </ul>
                                    </th>  
                                    <th width="20%" class="text-center"> 
                                        <strong style="border:1px solid #ccc;line-height:60px;padding:5px 10px;"><?php echo display('invoice') ?></strong> 
                                    </th>  
                                    <th width="40%">
                                        <h4>
                                            <?php echo display('date') ?> :  
                                            <input type="text" name="date" required value="<?php echo date('d-m-Y') ?>" class="datepicker invoice-input" ><br> 
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
                                    <th width="260"><?php echo display('itemName') ?></th>
                                    <th width="*"><?php echo display('description') ?></th>
                                    <th width="120"><?php echo display('quantity') ?></th>
                                    <th width="120"><?php echo display('price') ?></th>
                                    <th width="120"><?php echo display('subtotal') ?></th>  
                                    <th width="160"><?php echo display('add_or_remove') ?></th>  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php //echo form_dropdown('itemName[]', $medicine_list, '', 'class="itemName dont-select-me form-control" required'); ?>
                                        <div class="form-group row">
			                                <label for="itemName" class="col-xs-3 col-form-label"><?php echo display('itemName')?> <i class="text-danger">*</i></label>
			                                <div class="col-xs-9">
			                                    <?php echo form_dropdown('itemName[]', $medicine_list, /*$purchase->item_id*/'', 'class="itemName form-control dont-select-me " id="itemName" required') ?>
			                                </div>
			                            </div>
                                    </td> 
                                    <td><textarea name="description[]" class="form-control" placeholder="<?php echo display('description') ?>"></textarea></td> 

                                    <td>
                                    	<input type="text" name="quantity[]" required autocomplete="off" class="totalCal form-control" placeholder="<?php echo display('quantity') ?>"  >
                                    	
                                    	<input type="text" name="existing_quantity" placeholder="Available Stock" class="form-control" readonly>
                                    </td>  
                                    <td><input type="text" name="price[]" required readonly autocomplete="off" class="totalCal form-control" placeholder="<?php echo display('price') ?>"><span id='pricePerTablet'></span></td>  
                                    <td><input type="text" name="subtotal[]" required readonly autocomplete="off" class="subtotal form-control" placeholder="<?php echo display('subtotal') ?>" value="0.00"></td>   

                                    <td>
                                      <div class="btn btn-group">
                                        <button type="button" class="btn btn-sm btn-primary addBtn"><?php echo display('add') ?></button>
                                        <button type="button" class="btn btn-sm btn-danger removeBtn"><?php echo display('remove') ?></button>
                                        </div>
                                    </td>   
                                </tr>  
                            </tbody>
                            <tfoot> 
                                <tr class="bg-info">  
                                    <td colspan="3"></td> 
                                    <th class="text-right"><?php echo display('total') ?></th>  
                                    <th><input type="text" name="total" id="total" class="form-control" readonly required placeholder="<?php echo display('total') ?>"  value="0.00"></th>  
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
                                    <td><input type="text" name="vat" id="vat" required autocomplete="off"  class="vatDiscount paidDue form-control" placeholder="<?php echo display('vat') ?>" value="0.00"></td>  
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

                                    <td><input type="text" name="discount" required autocomplete="off" id="discount" class="vatDiscount paidDue form-control" placeholder="<?php echo display('discount') ?>"  value="0.00"></td> 
                                    <td></td>  
                                </tr> 
                                <tr class="bg-success">  
                                    <td colspan="3"></td>  
                                    <th class="text-right"><?php echo display('grand_total') ?></th>  
                                    <th><input type="text" name="grand_total" readonly required autocomplete="off"  id="grand_total" class="paidDue form-control" placeholder="<?php echo display('grand_total') ?>" value="0.00"></th> 
                                    <td></td>  
                                </tr>
                                <tr>  
                                    <td colspan="3"></td>  
                                    <th class="text-right"><?php echo display('paid') ?></th>
                                    <td><input type="text" name="paid" id="paid" autocomplete="off"  class="paidDue form-control" required placeholder="<?php echo display('paid') ?>"  value="0.00"></td> 
                                    <td></td>  
                                </tr>
                                <tr class="bg-danger">  
                                    <td colspan="3"></td>  
                                    <th class="text-right"><?php echo display('due') ?></th> 
                                    <td><input type="text" name="due" id="due" autocomplete="off" class="paidDue form-control" required placeholder="<?php echo display('due') ?>" value="0.00"></td> 
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
                                    <td><button class="btn btn-success btn-block"><?php echo display('save') ?></button></td>  
                                    <td></td> 
                                </tr>
                            </tfoot>
                        </table>  
                        <?php echo form_close() ?>
                        <!-- FormSale End -->
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

    //add row
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

    //calculate total id=Quantity
    $('body').on('keyup', '.totalCal', function() {
        var totalCal   = $(this).parent().parent();// Points To Row;
        var quantity   = totalCal.children().next().next().children().val();
        var exQuantity = totalCal.children().next().next().children().next().val();
        var price      = totalCal.children().next().next().next().children().val(); 
        totalCal.children().next().next().next().next().children().val((quantity*price).toFixed(2));
        
        if(parseInt(quantity)>parseInt(exQuantity)){
        	alert("We Dont Have That Much Items Left");
        	//totalCal.children().next().next().children()[0].val('');
        	var x= totalCal.children().next().next().children("input:first");
        	console.log(x);
        	x.val('');
        	totalCal.children().next().next().next().next().children().val('0.00');
        	//return;
        }
        //alert(quantity+'|'+exQuantity);

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
    //   ENDS OF PATIENT INFORMATION
    //#------------------------------------

    $('body').on('keyup change', '#patient_id', function() {
        var patient_id = $(this).val();
        //alert(patient_id);
        if(patient_id.length > 0)
        {$.ajax({
            url     : '<?php echo base_url('dashboard_pharmacist/hospital_activities/stock/patient') ?>',
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
                alert('failed[AjaxCallFailedExceptionPatientId]!');
            } 
        });
    	}
    });

    $('body').on('change','.itemName',function(){
    	var totalCal = $(this).parent().parent().parent().parent();// Points To TableRow tr

        console.log(totalCal);
    	var item_id= $(this).val();
    	//alert(item_id);
    	//totalCal.children().next().next().next().children().val(item_id);
    	
    	$.ajax({
	            url  : '<?= base_url('dashboard_pharmacist/hospital_activities/stock/medicineDetails') ?>',
	            type : 'post',
	            dataType : 'JSON',
	            data : {
	                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
	                item_id : $(this).val()
	            },
	            success : function(data) 
	            {
	                var unitTpe='';
	                var ppt='';
	                var spanText=totalCal.children().next().next().next().children().next();
	                var exQuantity=totalCal.children().next().next().children().next();
	                console.log(exQuantity);
	            	if(data.medicineDet.unit==1){
	                	unitTpe='Bottle';
	                	ppt=data.medicineDet.mrp;
	                	exQuantity.val(/*'Stock : '+*/data.medicineDet.quantity);
	                	spanText.text('PricePerUnit'/*+data.medicineDet.mrp*/);
	                	


	                }else if (data.medicineDet.unit==2) {
	                	unitTpe='Strip';
	                	var ppt=parseFloat(data.medicineDet.mrp/data.medicineDet.tabletsPerStrip).toFixed(2);
	                	exQuantity.val(/*'Stock : '+*/data.medicineDet.quantity);
	                	//spanText.text("mrp:"+data.medicineDet.mrp+"pricePrTab: "+ppt+" tabPerStrp: "+data.medicineDet.tabletsPerStrip);
	                	spanText.text("PricePerTablet");
	                }
	                //alert(unitTpe);
	            	totalCal.children().next().next().next().children().val(ppt);
	                //alert(data.medicineDet.name);
	                /*
	                $('#batchNo').val(data.medicineDet.batchNo);
	                var unitTpe='';
	                if(data.medicineDet.unit==1){
	                	unitTpe='Bottle'
	                }else if (data.medicineDet.unit==2) {
	                	unitTpe='Strip'
	                }
	                //alert(unitTpe);

	                //$('#unit').val(2);
	                //$('#tabletsPerStrip').val(data.medicineDet.tabletsPerStrip);
	                $('#existing_quantity').html('Existing : '+data.medicineDet.quantity).addClass('text-success').removeClass('text-danger');
	                $('#existing_quantity_input').val(data.medicineDet.quantity);
	                //$('#manufac_date').val(data.medicineDet.manufac_date);
	                $('#mrp').val(data.medicineDet.mrp);
	                $('#purchaseValue').val(data.medicineDet.purchaseValue);
	                $('#taxPercentage').val(data.medicineDet.taxPercentage);
	                
	                */

	                
	                /* if (data.status == true) {
	                    outputfee.val(data.message);//.addClass('text-success').removeClass('text-danger');
	                } else if (data.status == false) {
	                    outputfee.html(data.message).addClass('text-danger').removeClass('text-success');
	                } else {
	                    outputfee.html(data.message).addClass('text-danger').removeClass('text-success');
	                } */
	            }, 
	            error : function()
	            {
	                alert('Failed:[ ExceptionMedicineDetailsNotFound ]');
	            }	
	   		});

    });

});
</script>
<div class="row">
    <!--  form area -->
    <div class="col-sm-12"> 
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_pharmacist/hospital_activities/stock/purchase_list") ?>"> <i class="fa fa-list"></i>  <?php echo display('purchase_list') ?> </a>  
                </div>
            </div>


            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('dashboard_pharmacist/hospital_activities/stock/purchase/'.$purchase->id,'class="form-inner"') ?>

                            <?php echo form_hidden('id', $purchase->id) ?>

                            <div class="form-group row">
                                <label for="date" class="col-xs-3 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="date" class="datepicker form-control" type="text" placeholder="<?php echo display('date') ?>" id="date"  value="<?php echo $purchase->date ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cashType" class="col-xs-3 col-form-label" ><?= display('cashType') ?></label>
                                <div class="col-xs-9">
                                <?php
                                    $Unit = array(
                                        '1'  => display('cash'),
                                        '2' => display('credit')                                         
                                    );
                                    echo form_dropdown('cashType', $Unit,$purchase->cash_credit, 'class="form-control" id="cashType" ');

                                ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="supplier" class="col-xs-3 col-form-label"><?php echo display('supplier')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('supplier', $supplier_list, $purchase->supplier_id, 'class="form-control" id="supplier"') ?>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="billNo" class="col-xs-3 col-form-label"><?php echo display('billNo')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="billNo"  type="text" class="form-control" id="billNo" placeholder="<?php echo display('billNo')?>" value="<?php echo $purchase->billno ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="itemName" class="col-xs-3 col-form-label"><?php echo display('itemName')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('itemName', $medicine_list, /*$purchase->item_id*/'', 'class="form-control" id="itemName"') ?>
                                </div>
                            </div>

                            

                            
                            <?php /* <div class="form-group row">
                                <label for="batchNo" class="col-xs-3 col-form-label"><?php echo display('batchNo')?></label>
                                <div class="col-xs-9">
                                    <input name="batchNo"  type="text" class="form-control" id="batchNo" placeholder="<?php echo display('batchNo')?>" value="<?php echo $medicine->batchNo ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="unit" class="col-xs-3 col-form-label" ><?= display('unit') ?></label>
                                <div class="col-xs-9">
                                <?php
                                    $Unit = array(
                                        '1'  => display('bottle'),
                                        '2' => display('strip')                                         
                                    );
                                    print_r($Unit);
                                    echo form_dropdown('unit', $Unit,$medicine->unit, 'class="form-control" id="unit" ');

                                ?>
                                </div>
                            </div>
                            
                            <div class="form-group row" hidden="true" id="divTabletsPerStrip">
                                <label for="tabletsPerStrip" class="col-xs-3 col-form-label" ><?= display('tabletsPerStrip') ?><i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                <?php
                                    $Unit = array(
                                        '1'  => '1',
                                        '2'  => '2',
                                        '3'  => '3',
                                        '4'  => '4',
                                        '6'  => '6',
                                        '10'  => '10',
                                        '15'  => '15',
                                        '20'  => '20'                                         
                                    );
                                    echo form_dropdown('tabletsPerStrip', $Unit,$medicine->tabletsPerStrip, 'class="form-control" id="tabletsPerStrip" ');

                                ?>
                                </div>
                            </div>

                            <?php / *
                            <div class="form-group row">
                                <label for="category_id" class="col-xs-3 col-form-label"><?php echo display('category_name')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('category_id', $category_list, $medicine->category_id, 'class="form-control" id="category_id"') ?>
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="description" class="col-xs-3 col-form-label"><?php echo display('description') ?> </label>
                                <div class="col-xs-9">
                                    <textarea name="description" class="form-control tinymce"  placeholder="<?php echo display('description') ?>"  rows="7"><?php echo $medicine->description ?></textarea>
                                </div>
                            </div>
 

                             <div class="form-group row">
                                <label for="price" class="col-xs-3 col-form-label"><?php echo display('price')?></label>
                                <div class="col-xs-9">
                                    <input name="price"  type="text" class="form-control" id="price" placeholder="<?php echo display('price')?>" value="<?php echo $medicine->price ?>">
                                </div>
                            </div> 

                            
                            

                            <div class="form-group row">
                                <label for="expiry_date" class="col-xs-3 col-form-label"><?php echo display('expiry_date') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="expiry_date" class="datepicker form-control" type="text" placeholder="<?php echo display('expiry_date') ?>" id="expiry_date"  value="<?php echo $medicine->expiry_date ?>">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="manufac_date" class="col-xs-3 col-form-label"><?php echo display('manufac_date') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="manufac_date" class="datepicker form-control" type="text" placeholder="<?php echo display('manufac_date') ?>" id="manufac_date"  value="<?php echo $medicine->manufac_date ?>">
                                </div>
                            </div> */?>

                            
                            <div class="form-group row">
                                <label for="quantity" class="col-xs-3 col-form-label"><?php echo display('quantity')?> 
                                <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="quantity"  type="text" class="form-control" id="quantity" placeholder="<?php echo display('quantity')?>" value="<?php echo $purchase->quantity ?>">
                                	<div id="existing_quantity"></div>
                                </div>

                            </div>

                            <input name="existing_quantity_input"  type="text" class="form-control" id="existing_quantity_input" placeholder="<?php echo display('quantity')?>" hidden>
                            
                            <div class="form-group row">
                                <label for="mrp" class="col-xs-3 col-form-label"><?php echo display('mrp')?> 
                                <i class="text-danger">*</i> ₹</label>
                                <div class="col-xs-9">
                                    <input name="mrp"  type="text" class="form-control" id="mrp" placeholder="<?php echo display('mrp')?>" value="<?php //echo $purchase->mrp ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="purchaseValue" class="col-xs-3 col-form-label"><?php echo display('purchaseValue')?> 
                                <i class="text-danger">*</i> ₹</label>
                                <div class="col-xs-9">
                                    <input name="purchaseValue"  type="text" class="form-control" id="purchaseValue" placeholder="<?php echo display('purchaseValue')?>" value="<?php //echo $purchase->purchaseValue ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="taxPercentage" class="col-xs-3 col-form-label"><?php echo display('taxPercentage')?> 
                                <i class="text-danger">*</i> %</label>
                                <div class="col-xs-9">
                                    <input name="taxPercentage"  type="text" class="form-control" id="taxPercentage" placeholder="<?php echo display('taxPercentage')?>" value="<?php //echo $purchase->taxPercentage ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="discount" class="col-xs-3 col-form-label"><?php echo display('discount')?> 
                                </label>
                                <div class="col-xs-9">
                                    <input name="discount"  type="text" class="form-control" id="discount" placeholder="<?php echo display('discount')?>" value="<?php echo $purchase->discount ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="netValue" class="col-xs-3 col-form-label"><?php echo display('netValue')?> 
                                </label>
                                <div class="col-xs-9">
                                    <input name="netValue"  type="text" class="form-control" id="netValue" placeholder="<?php echo display('netValue')?>" value="<?php echo $purchase->netValue ?>" readonly>
                                </div>
                            </div>


                            <!--Radios-->
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
       $("#unit").change(function(){
            //var date        = $('#date');
            //alert($(this).val());
            if($(this).val()==2){
                $('#divTabletsPerStrip').show("slide");
            }else{
                $('#divTabletsPerStrip').hide("slide");
            }
       	});
       $("#quantity").change(function(){
            //var date        = $('#date');
            //alert($(this).val());
            //alert($('#mrp').val());
            $('#netValue').val($(this).val()*$('#mrp').val()-$('#discount').val());
       	});
       
       $("#discount").change(function(){
            //var date        = $('#date');
            //alert($(this).val());
            //alert($('#mrp').val());
            $('#netValue').val($('#quantity').val()*$('#mrp').val()-$('#discount').val());
       	});
       

       	/// ---------------------------- Fetches item Details ------------- 
       	$('#itemName').change(function(){
   			//alert($(this).val());
   			var item_id = $('#itemName');
			//alert(item_id.val());
			
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
	                //alert(data.medicineDet.name);
	                
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
	                alert('failed');
	            }	
	   		});
   		});

       	
       	// Problem Occurs When Form Is Loaded With Data For Modification: in case of Strip ,Total Strips are Not Shown
       	if($('#unit').val()==2)
       	{
            $('#divTabletsPerStrip').show("slide");
       	}


       	//doctor_id
    	$("#doctor_id").change(function(){
	        var doctor_id = $('#doctor_id'); 
	        var output = $('#available_days');
	        var outputfee = $('#doctor_cons_fee');
       	});
    });
</script>
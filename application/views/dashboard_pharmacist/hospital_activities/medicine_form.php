<div class="row">
    <!--  form area -->
    <div class="col-sm-12"> 
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_pharmacist/hospital_activities/medicine") ?>"> <i class="fa fa-list"></i>  <?php echo display('medicine_list') ?> </a>  
                </div>
            </div> 


            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('dashboard_pharmacist/hospital_activities/medicine/form/'.$medicine->id,'class="form-inner"') ?>

                            <?php echo form_hidden('id', $medicine->id) ?>

                            <div class="form-group row">
                                <label for="name" class="col-xs-3 col-form-label"><?php echo display('medicine_name')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="name"  type="text" class="form-control" id="name" placeholder="<?php echo display('medicine_name')?>" value="<?php echo $medicine->name ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="manufactured_by" class="col-xs-3 col-form-label"><?php echo display('manufactured_by')?></label>
                                <div class="col-xs-9">
                                    <input name="manufactured_by"  type="text" class="form-control" id="manufactured_by" placeholder="<?php echo display('manufactured_by')?>" value="<?php echo $medicine->manufactured_by ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_id" class="col-xs-3 col-form-label"><?php echo display('category_name')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('category_id', $category_list, $medicine->category_id, 'class="form-control" id="category_id"') ?>
                                </div>
                            </div>

                            <?php /* <div class="form-group row">
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
                            </div> */?>

                            <div class="form-group row">
                                <label for="batchNo" class="col-xs-3 col-form-label"><?php echo display('batchNo')?></label>
                                <div class="col-xs-9">
                                    <input name="batchNo"  type="text" class="form-control" id="batchNo" placeholder="<?php echo display('batchNo')?>" value="<?php echo $medicine->batchNo ?>">
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
                            </div>

                            <div class="form-group row">
                                <label for="unit" class="col-xs-3 col-form-label" ><?= display('unit') ?></label>
                                <div class="col-xs-9">
                                <?php
                                    $Unit = array(
                                        '1'  => display('bottle'),
                                        '2' => display('strip')                                         
                                    );
                                    echo form_dropdown('unit', $Unit,$medicine->unit, 'class="form-control" id="unit" ');

                                ?>
                                </div>
                            </div>
                            <?php //if ($medicine->unit==1){$to='true';}else{$to='false';}?>
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

                            <div class="form-group row">
                                <label for="quantity" class="col-xs-3 col-form-label"><?php echo display('quantity')?> 
                                <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="quantity"  type="text" class="form-control" id="quantity" placeholder="<?php echo display('quantity')?>" value="<?php echo $medicine->quantity ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mrp" class="col-xs-3 col-form-label"><?php echo display('mrp')?> 
                                <i class="text-danger">*</i> ₹</label>
                                <div class="col-xs-9">
                                    <input name="mrp"  type="text" class="form-control" id="mrp" placeholder="<?php echo display('mrp')?>" value="<?php echo $medicine->mrp ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="purchaseValue" class="col-xs-3 col-form-label"><?php echo display('purchaseValue')?> 
                                <i class="text-danger">*</i> ₹</label>
                                <div class="col-xs-9">
                                    <input name="purchaseValue"  type="text" class="form-control" id="purchaseValue" placeholder="<?php echo display('purchaseValue')?>" value="<?php echo $medicine->purchaseValue ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="taxPercentage" class="col-xs-3 col-form-label"><?php echo display('taxPercentage')?> 
                                <i class="text-danger">*</i> %</label>
                                <div class="col-xs-9">
                                    <input name="taxPercentage"  type="text" class="form-control" id="taxPercentage" placeholder="<?php echo display('taxPercentage')?>" value="<?php echo $medicine->taxPercentage ?>">
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
       // Problem Occurs When Form Is Loaded With Data For Modification: in case of Strip ,Total Strips are Not Shown
       if($('#unit').val()==2)
       {
            $('#divTabletsPerStrip').show("slide");
       }
    });
</script>
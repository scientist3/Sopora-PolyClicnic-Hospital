<div class="row">
    <!--  form area -->
    <div class="col-sm-12"> 
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_pharmacist/hospital_activities/stock/listSupplier") ?>"> <i class="fa fa-list"></i>  <?php echo display('list_supplier') ?> </a> 
                </div>
            </div> 
            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('dashboard_pharmacist/hospital_activities/stock/addSupplier/'.$supplier->id,'class="form-inner"') ?>

                            <?php echo form_hidden('id', $supplier->id) ?>

                            <div class="form-group row">
                                <label for="name" class="col-xs-3 col-form-label"><?php echo display('name') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="name"  type="text" class="form-control" id="name" placeholder="<?php echo display('name') ?>" value="<?php echo $supplier->name ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-xs-3 col-form-label"><?php echo display('address') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="address"  type="text" class="form-control" id="address" placeholder="<?php echo display('address') ?>" value="<?php echo $supplier->address ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-xs-3 col-form-label"><?php echo display('phone') ?></label>
                                <div class="col-xs-9">
                                    <input name="phone" class="form-control" type="text" placeholder="<?php echo display('phone') ?>" id="phone"  value="<?php echo $supplier->phone ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company" class="col-xs-3 col-form-label"><?php echo display('company') ?></label>
                                <div class="col-xs-9">
                                    <input name="company" class="form-control" type="text" placeholder="<?php echo display('company') ?>" id="company"  value="<?php echo $supplier->company ?>">
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
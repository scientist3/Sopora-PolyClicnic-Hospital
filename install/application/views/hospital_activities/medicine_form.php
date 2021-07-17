<div class="row">
    <!--  form area -->
    <div class="col-sm-12"> 
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("hospital_activities/medicine") ?>"> <i class="fa fa-list"></i>  <?php echo display('medicine_list') ?> </a>  
                </div>
            </div> 


            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('hospital_activities/medicine/form/'.$medicine->id,'class="form-inner"') ?>

                            <?php echo form_hidden('id', $medicine->id) ?>

                            <div class="form-group row">
                                <label for="name" class="col-xs-3 col-form-label"><?php echo display('medicine_name')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="name"  type="text" class="form-control" id="name" placeholder="<?php echo display('medicine_name')?>" value="<?php echo $medicine->name ?>">
                                </div>
                            </div>

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
                                <label for="manufactured_by" class="col-xs-3 col-form-label"><?php echo display('manufactured_by')?></label>
                                <div class="col-xs-9">
                                    <input name="manufactured_by"  type="text" class="form-control" id="manufactured_by" placeholder="<?php echo display('manufactured_by')?>" value="<?php echo $medicine->manufactured_by ?>">
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
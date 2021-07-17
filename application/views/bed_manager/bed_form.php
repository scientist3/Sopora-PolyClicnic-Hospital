<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <div class="btn-group">
                    <a class="btn btn-primary" href="<?php echo base_url("bed_manager/bed") ?>"> <i class="fa fa-list"></i>  <?php echo display('bed_list') ?> </a> 
                </div>
            </div>

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('bed_manager/bed/form/'.$bed->id,'class="form-inner"') ?>

                            <?php echo form_hidden('id',$bed->id) ?>

                            <div class="form-group row">
                                <label for="type" class="col-xs-3 col-form-label"><?php echo display('bed_type') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="type"  type="text" class="form-control" id="type" placeholder="<?php echo display('bed_type') ?>" value="<?php echo $bed->type ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-xs-3 col-form-label"><?php echo display('description') ?></label>
                                <div class="col-xs-9">
                                    <textarea name="description" class="form-control"  placeholder="<?php echo display('description') ?>" rows="7"><?php echo $bed->description ?></textarea>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="limit" class="col-xs-3 col-form-label"><?php echo display('bed_limit') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="limit"  type="number" class="form-control" id="limit" placeholder="<?php echo display('bed_limit') ?>" value="<?php echo $bed->limit ?>" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="charge" class="col-xs-3 col-form-label"><?php echo display('charge') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="charge"  type="text" class="form-control" id="charge" placeholder="<?php echo display('charge') ?>" value="<?php echo $bed->charge ?>">
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
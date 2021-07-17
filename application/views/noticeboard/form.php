<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("noticeboard/notice") ?>"> <i class="fa fa-list"></i>  <?php echo display('notice_list') ?> </a> 
                </div>
            </div>

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('noticeboard/notice/form/'.$notice->id,'class="form-inner"') ?>

                            <?php echo form_hidden('id', $notice->id) ?>

                            <div class="form-group row">
                                <label for="title" class="col-xs-3 col-form-label"><?php echo display('title')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="title"  type="text" class="form-control" id="title" placeholder="<?php echo display('title')?>" value="<?php echo $notice->title ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-xs-3 col-form-label"><?php echo display('description') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <textarea name="description" class="form-control tinymce"  placeholder="<?php echo display('description') ?>"  rows="7"><?php echo $notice->description ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="start_date" class="col-xs-3 col-form-label"><?php echo display('start_date')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="start_date"  type="text" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date')?>" value="<?php echo $notice->start_date ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="end_date" class="col-xs-3 col-form-label"><?php echo display('end_date') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="end_date"  type="text" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date')?>" value="<?php echo $notice->end_date ?>">
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
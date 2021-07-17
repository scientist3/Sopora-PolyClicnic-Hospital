<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">

            <div class="panel-heading">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("messages/message") ?>"> <i class="fa fa-inbox"></i>  <?php echo display('inbox') ?> </a>
                    <a class="btn btn-info" href="<?php echo base_url("messages/message/sent") ?>"> <i class="fa fa-share"></i>  <?php echo display('sent') ?> </a>
                </div> 
            </div>

            <div class="panel-body  panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open('messages/message/new_message/','class="form-inner"') ?>

                            <div class="form-group row">
                                <label for="receiver_id" class="col-xs-3 col-form-label"><?php echo display('receiver_name')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('receiver_id', $user_list, $message->receiver_id ,'class="form-control" id="receiver_id"') ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="subject" class="col-xs-3 col-form-label"><?php echo display('subject')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="subject"  type="text" class="form-control" id="subject" placeholder="<?php echo display('subject')?>" value="<?php echo $message->subject ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message" class="col-xs-3 col-form-label"><?php echo display('message') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <textarea name="message" class="form-control tinymce"  placeholder="<?php echo display('message') ?>"  rows="7"><?php echo $message->message ?></textarea>
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
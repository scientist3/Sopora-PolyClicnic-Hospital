<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 

            <div class="panel-body  panel-form">
                <div class="row">
                    <div id="output" class="hide alert"></div>

                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('mail/email','class="form-inner" id="mailForm" ') ?>

                            <div class="form-group row">
                                <label for="to" class="col-xs-3 col-form-label"><?php echo display('receiver_name')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="to"  type="text" class="form-control" id="to" placeholder="<?php echo display('email')?>" value="<?php echo $email->to ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="subject" class="col-xs-3 col-form-label"><?php echo display('subject')?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="subject"  type="text" class="form-control" id="subject" placeholder="<?php echo display('subject')?>" value="<?php echo $email->subject ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message" class="col-xs-3 col-form-label"><?php echo display('message') ?> <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <textarea name="message" class="form-control tinymce"  placeholder="<?php echo display('message') ?>"  rows="7"><?php echo $email->message ?></textarea>
                                </div>
                            </div>  

                            <div class="form-group row">
                                <label for="attach_file" class="col-xs-3 col-form-label"><?php echo display('attach_file') ?></label>
                                <div class="col-xs-9">
                                    <input type="file" name="attach_file" id="attach_file">

                                    <input type="hidden" name="hidden_attach_file" id="hidden_attach_file" value="<?php echo $email->hidden_attach_file ?>">

                                    <p id="upload-progress" class="hide alert"></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                                        <div class="or"></div>
                                        <button class="ui positive button"><?php echo display('send') ?></button>
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


<script type="text/javascript">
$(function(){
    var browseFile = $('#attach_file');
    var form       = $('#mailForm');
    var progress   = $("#upload-progress");
    var hiddenFile = $("#hidden_attach_file");
    var output     = $("#output");
    browseFile.on('change',function(e)
    {
        e.preventDefault(); 
        uploadData = new FormData(form[0]);

        $.ajax({
            url      : '<?php echo base_url('mail/email/do_upload') ?>',
            type     : form.attr('method'),
            dataType : 'json',
            cache    : false,
            contentType : false,
            processData : false,
            data     : uploadData, 
            beforeSend  : function() 
            {
                hiddenFile.val('');
                progress.removeClass('hide').html('<i class="fa fa-cog fa-spin"></i> Loading..');
            },
            success  : function(data) 
            { 
                progress.addClass('hide');
                if (data.status == false) {
                    output.html(data.exception).addClass('alert-danger').removeClass('hide').removeClass('alert-info');
                } else if (data.status == true ) {
                    output.html(data.message).addClass('alert-info').removeClass('hide').removeClass('alert-danger');
                    hiddenFile.val(data.filepath);
                }  
            }, 
            error    : function() 
            {
                progress.addClass('hide');
                output.addClass('hide');
                alert('failed!');
            }   
        });
    });



});
</script>
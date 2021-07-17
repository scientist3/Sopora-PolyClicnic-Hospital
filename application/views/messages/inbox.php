<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <div class="panel-heading">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("messages/message/new_message") ?>"> <i class="fa fa-send-o"></i>  <?php echo display('new_message') ?> </a>
                    <a class="btn btn-primary" href="<?php echo base_url("messages/message/sent") ?>"> <i class="fa fa-share"></i>  <?php echo display('sent') ?> </a>
                </div>
            </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('sender') ?></th>
                            <th><?php echo display('subject') ?></th>
                            <th><?php echo display('message') ?></th>
                            <th><?php echo display('date') ?></th> 
                            <th><?php echo display('status') ?></th> 
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($messages)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($messages as $message) { ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $message->sender_name; ?></td>
                                    <td><?php echo $message->subject; ?></td>
                                    <td><?php echo character_limiter(strip_tags($message->message),50); ?></td>
                                    <td><?php echo date('d M Y h:i:s a', strtotime($message->datetime)); ?></td>  
                                    <td><?php echo (($message->receiver_status == 0) ? "<i class='label label-warning'>not seen</label>" : "<i class='label label-success'>seen</label>"); ?></td>
                                    <td class="center" width="80">
                                        <a href="<?php echo base_url("messages/message/inbox_information/$message->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("messages/message/delete/$message->id/$message->sender_id/$message->receiver_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
 
 
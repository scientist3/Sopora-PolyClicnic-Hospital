<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <h3><?php echo display('noticeboard') ?></h3>
            </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('title') ?></th>
                            <th><?php echo display('description') ?></th>
                            <th><?php echo display('start_date') ?></th>
                            <th><?php echo display('end_date') ?></th>
                            <th><?php echo display('assign_by') ?></th>
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($notices)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($notices as $notice) { ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $notice->title; ?></td>
                                    <td><?php echo character_limiter(strip_tags($notice->description),50); ?></td>
                                    <td><?php echo $notice->start_date; ?></td> 
                                    <td><?php echo $notice->end_date; ?></td> 
                                    <td><?php echo $notice->assign_by; ?></td> 
                                    <td class="center">
                                        <a href="<?php echo base_url("dashboard_doctor/noticeboard/notice/details/$notice->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
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




    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <div class="panel-heading">
                <h3><?php echo display('inbox') ?></h3>
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
                                        <a href="<?php echo base_url("dashboard_doctor/messages/message/inbox_information/$message->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("dashboard_doctor/messages/message/delete/$message->id/$message->sender_id/$message->receiver_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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
 
 
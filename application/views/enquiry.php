<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('email') ?></th>
                            <th><?php echo display('full_name') ?></th>
                            <th><?php echo display('phone') ?></th>
                            <th><?php echo display('enquiry') ?></th>
                            <th><?php echo display('read_unread') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($enquirys)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($enquirys as $enquiry) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $enquiry->email; ?></td>
                                    <td><?php echo $enquiry->name; ?></td>
                                    <td><?php echo $enquiry->phone; ?></td>
                                    <td><?php echo character_limiter(strip_tags($enquiry->enquiry),50); ?></td>
                                    <td><?php echo (!empty($enquiry->checked)?"<i class='fa fa-check text-success'></i>":"<i class='fa fa-times text-danger'></i>"); ?></td>
                                    <td><?php echo $enquiry->created_date; ?></td> 
                                    <td class="center">
                                        <a href="<?php echo base_url("enquiry/view/$enquiry->enquiry_id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("enquiry/delete/$enquiry->enquiry_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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
 
 
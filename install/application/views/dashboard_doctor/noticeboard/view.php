<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <h3><?php echo display('noticeboard') ?> </h3>  
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
</div>
 
 
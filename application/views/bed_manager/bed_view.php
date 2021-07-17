<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("bed_manager/bed/form") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_bed') ?> </a>  
                </div>
            </div>

            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('bed_type') ?></th>
                            <th><?php echo display('description') ?></th>
                            <th><?php echo display('bed_limit') ?></th>
                            <th><?php echo display('charge') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($beds)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($beds as $bed) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $bed->type; ?></td>
                                    <td><?php echo character_limiter($bed->description, 60); ?></td>
                                    <td><?php echo $bed->limit; ?></td>
                                    <td><?php echo number_format($bed->charge,2); ?></td>
                                    <td><?php echo (($bed->status==1)?display('active'):display('inactive')); ?></td>
                                    <td class="center">
                                        <a href="<?php echo base_url("bed_manager/bed/form/$bed->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("bed_manager/bed/delete/$bed->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> 
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

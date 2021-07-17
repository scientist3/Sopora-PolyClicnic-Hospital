<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <h3><?php echo display('bed_list') ?> </h3>
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

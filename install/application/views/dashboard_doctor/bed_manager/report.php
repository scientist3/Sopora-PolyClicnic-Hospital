<div class="row">

    <div class="col-sm-12">
        <div  class="panel panel-default">
            <div class="panel-body"> 

                <form class="form-inline" action="<?php echo base_url('dashboard_doctor/bed_manager/report/index') ?>">

                    <div class="form-group">
                        <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                        <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo $date->start_date ?>">
                    </div> 

                    <div class="form-group">
                        <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                        <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo $date->end_date ?>">
                    </div>  

                    <button type="submit" class="btn btn-success"><?php echo display('filter') ?></button>

                </form>

            </div>
        </div>
    </div>
 


    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="bmReport">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th><?php echo display('assign_date') ?></th>
                            <th><?php echo display('bed_type') ?></th>
                            <th><?php echo display('bed_limit') ?></th>
                            <th><?php echo display('charge') ?></th>
                            <th><?php echo display('allocated') ?></th>
                            <th><?php echo display('amount') ?></th>
                            <th><?php echo display('free_now') ?></th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th></th> 
                            <th></th> 
                            <th></th> 
                            <th></th> 
                            <th class="text-center"></th> 
                            <th class="text-center"></th> 
                            <th class="text-center"></th> 
                            <th></th> 
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php if (!empty($result)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($result as $value) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $value->assign_date; ?></td>
                                    <td><?php echo $value->type; ?></td>
                                    <td><?php echo $value->limit; ?></td>
                                    <td><?php echo $value->charge; ?></td>
                                    <td><a href="<?php echo base_url() ?>dashboard_doctor/bed_manager/report/details?assign_date=<?php echo $value->assign_date; ?>&bed_id=<?php echo $value->bed_id; ?>" title="Click Me!"><?php echo $value->allocated; ?></a></td>
                                    <td><?php echo number_format($value->charge * $value->allocated, 2); ?></td>
                                    <td>
                                        <?php echo ($value->limit - $value->allocated); ?></td>
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


<script type="text/javascript">
$(document).ready(function() {

    $('#bmReport').DataTable( {
        responsive: true, 
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[10, 25, 50, 100, 150, 200, -1], [10, 25, 50, 100, 150, 200, "All"]], 
        buttons: [ {extend: 'copy', className: 'btn-sm'}, 
        {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, 
        {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'}, 
        {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, 
        {extend: 'print', className: 'btn-sm'} ], 

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1:typeof i === 'number' ? i : 0;
            };   

            //----------- Total over this page-----------
            bedCapacity = api.column(3, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);            

            charge = api.column(4, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
         
            amount = api.column(6, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
         
            free = api.column(7, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                },0);
 
            //---------ends of Total over this page----------
            // Update footer
            $( api.column(4).footer()).html(charge.toFixed(2)); 
            $( api.column(5).footer()).html((bedCapacity-free).toFixed(2)); 
            $( api.column(6).footer()).html(amount.toFixed(2)); 
        } 
    });
});
</script>

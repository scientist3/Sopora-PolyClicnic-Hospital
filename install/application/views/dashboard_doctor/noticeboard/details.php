<div class="row">
    <!--  table area -->
    <div class="col-sm-12" id="PrintMe">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <h3 class="heading"><?php echo (!empty($title) ? $title : null) ?></h3>
            </div> 

            <div class="panel-body">
                <?php echo $notice->description ?>
            </div>

            <div class="panel-footer">
                <div class="col-md-offset-8 col-sm-offset-6">
                <dl class="dl-horizontal">
                    <dt><?php echo display('assign_by') ?></dt><dd><?php echo $notice->assign_by ?></dd>
                    <dt><?php echo display('start_date') ?></dt><dd><?php echo date('d M Y', strtotime($notice->start_date)) ?></dd>
                    <dt><?php echo display('end_date') ?></dt><dd><?php echo date('d M Y', strtotime($notice->end_date)) ?></dd>
                </dl>
                </div>
            </div>


        </div>
    </div>
</div>
 
  



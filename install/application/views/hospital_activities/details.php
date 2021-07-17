<div class="row">
    <!--  table area -->
    <div class="col-sm-12" id="PrintMe">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading no-print">
                <div class="btn-group">  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button>
                </div>
            </div> 

            <div class="panel-heading">
                <h3 class="heading"><?php echo (!empty($title) ? $title: null)?></h3>
            </div>
            <div class="panel-body">
                <?php if(!empty($details->picture)){  ?>
                    <a href="<?php echo base_url($details->picture) ?>" target="_blank"><img src="<?php echo base_url($details->picture) ?>" width="200"></a>
                <?php } ?>
                <div class="caption">
                    <h3 class="heading"><?php echo $details->title ?></h3>
                    <p><?php echo $details->description ?></p>
                </div>
            </div>
            <div class="panel-footer">
                <dl class="dl-horizontal">
                    <?php if (!empty($details->patient_id)) { ?>
                        <dt><?php echo display('patient_id') ?></dt>
                        <dd><?php echo $details->patient_id ?></dd>
                    <?php } ?>


                    <?php if (!empty($details->doctor_name)) { ?>
                        <dt><?php echo display('doctor_name') ?></dt>
                        <dd><?php echo $details->doctor_name ?></dd>
                    <?php } ?>

                    <?php if (!empty($details->patient_id)) { ?>
                        <dt><?php echo display('date') ?></dt>
                        <dd><?php echo date('d M Y', strtotime($details->date)) ?></dd>
                    <?php } ?>
                </dl>
            </div>
        </div>
    </div>


</div>
 

  



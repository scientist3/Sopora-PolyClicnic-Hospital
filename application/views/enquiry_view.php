<div class="row">
    <!--  table area -->
    <div class="col-sm-12" id="PrintMe">
 
        <div class="panel panel-default thumbnail">

            <div class="panel-heading no-print">
                <div class="btn-group">
                    <a class="btn btn-primary" href="<?php echo base_url("enquiry") ?>"> <i class="fa fa-list"></i>  <?php echo display('enquiry_list') ?> </a> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button>
                </div>
            </div>

            <div class="panel-body">
                <h3 class="heading text-center"><?php echo (!empty($title) ? $title : null) ?></h3>
                <dl class="dl-horizontal">
                    <dt><?php echo display('full_name') ?></dt><dd><?= $enquiry->name ?></dd>
                    <dt><?php echo display('email') ?></dt><dd><?= $enquiry->email ?></dd>
                    <dt><?php echo display('phone') ?></dt><dd><?= $enquiry->phone ?></dd>
                    <dt><?php echo display('read_unread') ?></dt><dd><?php echo (!empty($enquiry->checked)?"<span class='label label-success'>Yes</label>":"<span class='label label-danger'>No</label>"); ?></dd>
                    <dt><?php echo display('ip_address') ?></dt><dd><?= $enquiry->ip_address ?></dd>
                    <dt><?php echo display('user_agent') ?></dt><dd><?= $enquiry->user_agent ?></dd>
                    <dt><?php echo display('checked_by') ?></dt><dd><?= $enquiry->firstname." ".$enquiry->lastname ?></dd>
                    <dt><?php echo display('enquiry_date') ?></dt><dd><?= $enquiry->created_date ?></dd>

                    <dt><?php echo display('enquiry') ?></dt><dd><?= $enquiry->enquiry ?></dd>
                </dl> 
            </div> 
        </div>
    </div> 

</div>
 
 








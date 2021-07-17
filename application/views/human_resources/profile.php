<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading no-print">
                <div class="btn-group">
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button>
                </div>
            </div> 

            <div class="panel-body">  
                <div class="row">
                    <div class="col-sm-12" align="center">  
                        <h1><?php echo display('employee_information') ?></h1>
                    <br>
                    </div>

                    <div class="col-sm-4" align="center"> 
                        <img alt="Picture" src="<?php echo (!empty($profile->picture) ? base_url($profile->picture) : base_url("assets/images/no-img.png")) ?>" class="img-thumbnail img-responsive">
                        <h3><?php echo $profile->fullname ?></h3>
                    </div> 

                    <div class="col-sm-8"> 
                        <dl class="dl-horizontal">
                            <dt><?php echo display('user_type') ?></dt><dd><?php echo ucfirst($userRoles[$profile->user_role]) ?></dd> 
                            <dt><?php echo display('email') ?></dt><dd><?php echo $profile->email ?></dd> 
                            <dt><?php echo display('mobile') ?></dt><dd><?php echo $profile->mobile ?></dd> 
                            <dt><?php echo display('sex') ?></dt><dd><?php echo $profile->sex ?></dd> 
                            <dt><?php echo display('address') ?></dt><dd><?php echo $profile->address ?></dd> 
                            <dt><?php echo display('create_date') ?></dt><dd><?php echo date('d M Y',strtotime($profile->create_date)) ?></dd>
                            <dt><?php echo display('status') ?></dt><dd><?php echo (($profile->status==1)?display('active'):display('inactive')); ?></dd> 
                        </dl> 
                    </div>
                </div>  

            </div> 

            <div class="panel-footer">
                <div class="text-center">
                    <strong><?php echo $this->session->userdata('title') ?></strong>
                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                </div>
            </div>
        </div>
    </div>


</div>

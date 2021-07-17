<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("dashboard_accountant/patient/patient") ?>"> <i class="fa fa-list"></i>  <?php echo display('patient_list') ?> </a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 

            <div class="panel-body"> 
                <div class="row">
                    <div class="col-sm-12" align="center">  
                        <h1><?php echo display('patient_information') ?></h1>
                    <br>
                    </div>

                    <div class="col-sm-3" align="center"> 
                        <img alt="Picture" src="<?php echo (!empty($profile->picture)?base_url($profile->picture):base_url("assets/images/no-img.png")) ?>" class="img-thumbnail img-responsive">
                        <h3><?php echo "$profile->firstname $profile->lastname " ?></h3>
                    </div> 

                    <div class="col-sm-9"> 
                        <dl class="dl-horizontal">
                            <dt><?php echo display('patient_id') ?></dt><dd><?php echo $profile->patient_id ?></dd> 
                            <dt><?php echo display('email') ?></dt><dd><?php echo $profile->email ?></dd> 
                            <dt><?php echo display('date_of_birth') ?></dt><dd><?php echo date('d M Y',strtotime($profile->date_of_birth)) ?></dd> 
                            <dt><?php echo display('age') ?></dt><dd><?php echo date_diff(date_create($profile->date_of_birth), date_create('now'))->y; ?> Years</dd> 
                            <dt><?php echo display('blood_group') ?></dt><dd><?php echo $profile->blood_group ?></dd> 
                            <dt><?php echo display('sex') ?></dt><dd><?php echo $profile->sex ?></dd> 
                            <dt><?php echo display('phone') ?></dt><dd><?php echo $profile->phone ?></dd> 
                            <dt><?php echo display('mobile') ?></dt><dd><?php echo $profile->mobile ?></dd> 
                            <dt><?php echo display('address') ?></dt><dd><?php echo $profile->address ?></dd> 
                            <dt><?php echo display('create_date') ?></dt><dd><?php echo $profile->create_date ?></dd>
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

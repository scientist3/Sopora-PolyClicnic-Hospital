<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail"> 

            <div class="panel-heading no-print">
                 <div class="btn-group">
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-success" ><i class="fa fa-print"></i></button>            
                    <a href="<?php echo base_url('dashboard_patient/home/form') ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
                </div>
            </div>


            <div class="panel-body">  
                <div class="row">
                    <div class="col-sm-12" align="center">  
                    <br>
                    </div>

                    <div class="col-sm-4" align="center"> 
                        <img alt="Picture" src="<?php echo (!empty($user->picture)?base_url($user->picture):base_url("assets/images/no-img.png")) ?>" width="150" height="150">
                        <h3>
                            <?php echo $this->session->userdata('fullname') ?> 
                            (<?php echo display('patient') ?>)
                        </h3>
                    </div> 

                    <div class="col-sm-8"> 
                        <dl class="dl-horizontal">
                        <?php if(!empty($user->patient_id)) { ?>
                            <dt><?php echo display('patient_id') ?></dt><dd><?php echo $user->patient_id ?></dd>
                        <?php } ?>

                        <?php if(!empty($user->email)) { ?>
                            <dt><?php echo display('email') ?></dt><dd><?php echo $user->email ?></dd>
                        <?php } ?>

                        <?php if(!empty($user->mobile)) { ?>
                            <dt><?php echo display('mobile') ?></dt><dd><?php echo $user->mobile ?></dd>
                        <?php } ?>

                        <?php if(!empty($user->phone)) { ?>
                            <dt><?php echo display('phone') ?></dt><dd><?php echo $user->phone ?></dd>
                        <?php } ?>

                        <?php if(!empty($user->blood_group)) { ?>
                            <dt><?php echo display('blood_group') ?></dt><dd><?php echo $user->blood_group ?></dd>
                        <?php } ?>

                        <?php if(!empty($user->date_of_birth)) { ?>
                            <dt><?php echo display('date_of_birth') ?></dt><dd><?php echo $user->date_of_birth ?></dd>
                        <?php } ?> 
   
                        <?php if(!empty($user->sex)) { ?>
                            <dt><?php echo display('sex') ?></dt><dd><?php echo $user->sex ?></dd>
                        <?php } ?> 

                        <?php if(!empty($user->address)) { ?>
                            <dt><?php echo display('address') ?></dt><dd><?php echo $user->address ?></dd>
                        <?php } ?>   
  
                        <?php if(!empty($user->create_date)) { ?>
                            <dt><?php echo display('create_date') ?></dt><dd><?php echo $user->create_date ?></dd>
                        <?php } ?>  
   
                        <?php if(!empty($user->status)) { ?>
                            <dt><?php echo display('status') ?></dt><dd><?php echo (!empty($user->status)?
                            display('active'):display('inactive')) ?></dd>
                        <?php } ?>  
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

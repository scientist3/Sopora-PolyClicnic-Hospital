<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail"> 
        
            <div class="panel-heading no-print">
                 <div class="btn-group">
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-success" ><i class="fa fa-print"></i></button>            
                    <a href="<?php echo base_url('dashboard/form/') ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
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
                            (<?php   
                                $userRoles = array( 
                                    '1' => display('admin'),
                                    '2' => display('doctor'),
                                    '3' => display('accountant'),
                                    '4' => display('laboratorist'),
                                    '5' => display('nurse'),
                                    '6' => display('pharmacist'),
                                    '7' => display('receptionist'),
                                    '8' => display('representative') 
                                ); 
                                echo $userRoles[$user->user_role];
                            ?>)
                        </h3>
                    </div> 

                    <div class="col-sm-8"> 
                        <dl class="dl-horizontal">
                        <?php if(!empty($user->email)) { ?>
                            <dt><?php echo display('email') ?></dt><dd><?php echo $user->email ?></dd>
                        <?php } ?>

                        <?php if(!empty($user->designation)) { ?>
                            <dt><?php echo display('designation') ?></dt><dd><?php echo $user->designation ?></dd>
                        <?php } ?>

                        <?php if(!empty($user->department)) { ?>
                            <dt><?php echo display('department') ?></dt><dd><?php echo $user->department ?></dd>
                        <?php } ?>

                        <?php if(!empty($user->address)) { ?>
                            <dt><?php echo display('address') ?></dt><dd><?php echo $user->address ?></dd>
                        <?php } ?> 

                        <?php if(!empty($user->phone)) { ?>
                            <dt><?php echo display('phone') ?></dt><dd><?php echo $user->phone ?></dd>
                        <?php } ?> 

                        <?php if(!empty($user->mobile)) { ?>
                            <dt><?php echo display('mobile') ?></dt><dd><?php echo $user->mobile ?></dd>
                        <?php } ?> 
   
                        <?php if(!empty($user->sex)) { ?>
                            <dt><?php echo display('sex') ?></dt><dd><?php echo $user->sex ?></dd>
                        <?php } ?> 
  
                        <?php if(!empty($user->education_degree)) { ?>
                            <dt><?php echo display('education_degree') ?></dt><dd><?php echo $user->education_degree ?></dd>
                        <?php } ?> 
  
                        <?php if(!empty($user->create_date)) { ?>
                            <dt><?php echo display('create_date') ?></dt><dd><?php echo $user->create_date ?></dd>
                        <?php } ?>  
  
                        <?php if(!empty($user->update_date)) { ?>
                            <dt><?php echo display('update_date') ?></dt><dd><?php echo $user->update_date ?></dd>
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

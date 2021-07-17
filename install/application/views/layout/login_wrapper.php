<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
//get site_align setting
$settings = $this->db->select("site_align")
    ->get('setting')
    ->row();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= display('login') ?> - <?php echo (!empty($title)?$title:null) ?></title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo (!empty($favicon)?$favicon:null) ?>">

        <!-- Bootstrap --> 
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <?php if (!empty($settings->site_align) && $settings->site_align == "RTL") {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>
        
        <!-- 7 stroke css -->
        <link href="<?php echo base_url(); ?>assets/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>

        <!-- style css -->
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="login-wrapper"> 
            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3><?php echo (!empty($title)?$title:null) ?></h3>
                                <small><strong><?= display('please_login') ?></strong></small>
                            </div>
                        </div>
                        <div class="">
                        <br><br>
                            <!-- alert message -->
                            <?php if ($this->session->flashdata('message') != null) {  ?>
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('message'); ?>
                            </div> 
                            <?php } ?>
                            
                            <?php if ($this->session->flashdata('exception') != null) {  ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('exception'); ?>
                            </div>
                            <?php } ?>
                            
                            <?php if (validation_errors()) {  ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo validation_errors(); ?>
                            </div>
                            <?php } ?> 
                        </div>
                    </div>


                    <div class="panel-body">
                        <?php echo form_open('login','id="loginForm" novalidate'); ?>
                            <div class="form-group">
                                <label class="control-label" for="email"><?= display('email') ?></label>
                                <input type="text" placeholder="<?= display('email') ?>" name="email" id="email" class="form-control"> 
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password"><?= display('password') ?></label>
                                <input type="password"  placeholder="<?= display('password') ?>" name="password" id="password" class="form-control"> 
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="user_role"><?= display('user_role') ?></label>
                                <?php
                                    $userRoles = array(
                                        ''  => display('select_user_role'),
                                        '1' => display('admin'),
                                        '2' => display('doctor'),
                                        '3' => display('accountant'),
                                        '4' => display('laboratorist'),
                                        '5' => display('nurse'),
                                        '6' => display('pharmacist'),
                                        '7' => display('receptionist'),
                                        '8' => display('representative'), 
                                        '9' => display('case_manager'), 
                                        '10' => display('patient') 
                                    );
                                    echo form_dropdown('user_role', $userRoles, $user->user_role, 'class="form-control" id="user_role" ');

                                ?>
                            </div> 
                            <div> 
                                <button  type="submit" class="btn btn-success"><?= display('login') ?></button> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>

        <script type="text/javascript">
        $(document).ready(function() {
            var info = $('table tbody tr');
            info.click(function() {
                var email    = $(this).children().first().text(); 
                var password = $(this).children().first().next().text();
                var user_role = $(this).attr('data-role');  

                $("input[name=email]").val(email);
                $("input[name=password]").val(password);
                $('select option[value='+user_role+']').attr("selected", "selected"); 
            });
        });
        </script>
    </body>
</html>
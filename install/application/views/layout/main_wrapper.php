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
        <title><?= display('dashboard') ?> - <?php echo (!empty($title)?$title:null) ?></title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?= base_url($this->session->userdata('favicon')) ?>">

        <!-- jquery ui css -->
        <link href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Bootstrap --> 
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <?php if (!empty($settings->site_align) && $settings->site_align == "RTL") {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>



        <!-- Font Awesome 4.7.0 -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- semantic css -->
        <link href="<?php echo base_url(); ?>assets/css/semantic.min.css" rel="stylesheet" type="text/css"/> 
        <!-- sliderAccess css -->
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet" type="text/css"/> 
        <!-- slider  -->
        <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/> 
        <!-- DataTables CSS -->
        <link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
  

        <!-- pe-icon-7-stroke -->
        <link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- themify icon css -->
        <link href="<?php echo base_url('assets/css/themify-icons.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- Pace css -->
        <link href="<?php echo base_url('assets/css/flash.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
        <?php if (!empty($settings->site_align) && $settings->site_align == "RTL") {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>


        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>

    </head>

    <body class="hold-transition sidebar-mini">
        <!--div class="se-pre-con"></div-->

        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header"> 

                <?php $logo = $this->session->userdata('logo'); ?>
                <a href="<?php echo base_url('dashboard/home') ?>" class="logo"> <!-- Logo -->
                    <span class="logo-mini">
                        <img src="<?php echo (!empty($logo)?base_url($logo):base_url("assets/images/logo.png")) ?>" alt="">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo (!empty($logo)?base_url($logo):base_url("assets/images/logo.png")) ?>" alt="">
                    </span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
                        <span class="sr-only">Toggle navigation</span>
                        <span class="pe-7s-keypad"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- settings -->
                            <li class="dropdown dropdown-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url('dashboard/profile'); ?>"><i class="pe-7s-users"></i> <?php echo display('profile') ?></a></li>
                                    <li><a href="<?php echo base_url('dashboard/form'); ?>"><i class="pe-7s-settings"></i> <?php echo display('edit_profile') ?></a></li>
                                    <li><a href="<?php echo base_url('logout') ?>"><i class="pe-7s-key"></i> <?php echo display('logout') ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel text-center">
                        <?php $picture = $this->session->userdata('picture'); ?>
                        <div class="image">
                            <img src="<?php echo (!empty($picture)?base_url($picture):base_url("assets/images/no-img.png")) ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="info">
                            <p><?php echo $this->session->userdata('fullname') ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i>
                            <?php   
                                $userRoles = array( 
                                    '1' => display('admin'),
                                    '2' => display('doctor'),
                                    '3' => display('accountant'),
                                    '4' => display('laboratorist'),
                                    '5' => display('nurse'),
                                    '6' => display('pharmacist'),
                                    '7' => display('receptionist'),
                                    '8' => display('representative'), 
                                    '9' => display('case_manager') 
                                ); 
                                echo $userRoles[$this->session->userdata('user_role')];
                            ?></a>
                        </div>
                    </div> 

                    <!-- sidebar menu -->
                    <ul class="sidebar-menu"> 

                        <li class="<?php echo (($this->uri->segment(1) == 'dashboard') ? "active" : null) ?>">
                            <a href="<?php echo base_url('dashboard/home') ?>"><i class="fa fa ti-home"></i> <?php echo display('dashboard') ?></a>
                        </li> 

                        <li class="treeview <?php echo (($this->uri->segment(1) == "department") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-sitemap"></i> <span><?php echo display('department') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("department/create") ?>"><?php echo display('add_department') ?></a></li>
                                <li><a href="<?php echo base_url("department") ?>"><?php echo display('department_list') ?></a></li> 
                            </ul>
                        </li>

                        <li class="treeview <?php echo (($this->uri->segment(1) == "doctor") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-user-md"></i> <span><?php echo display('doctor') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("doctor/create") ?>"><?php echo display('add_doctor') ?></a></li>
                                <li><a href="<?php echo base_url("doctor") ?>"><?php echo display('doctor_list') ?></a></li> 
                            </ul>
                        </li>

                        <li class="treeview <?php echo (($this->uri->segment(1) == "patient") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-wheelchair"></i> <span><?php echo display('patient') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("patient/create") ?>"><?php echo display('add_patient') ?></a></li>
                                <li><a href="<?php echo base_url("patient") ?>"><?php echo display('patient_list') ?></a></li> 
                                <li><a href="<?php echo base_url("patient/document_form") ?>"><?php echo display('add_document') ?></a></li> 
                                <li><a href="<?php echo base_url("patient/document") ?>"><?php echo display('document_list') ?></a></li> 
                            </ul>
                        </li> 
                         

                        <li class="treeview <?php echo (($this->uri->segment(1) == "schedule") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-calendar"></i> <span><?php echo display('schedule') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("schedule/create") ?>"><?php echo display('add_schedule') ?></a></li>
                                <li><a href="<?php echo base_url("schedule") ?>"><?php echo display('schedule_list') ?></a></li> 
                            </ul>
                        </li>

                        <li class="treeview <?php echo (($this->uri->segment(1) == "appointment" || $this->uri->segment(1) == "report") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-pencil-alt"></i> <span><?php echo display('appointment') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("appointment/create") ?>"><?php echo display('add_appointment') ?></a></li>
                                <li><a href="<?php echo base_url("appointment") ?>"><?php echo display('appointment_list') ?></a></li> 


                                <li><a href="<?php echo base_url("report/assign_by_all") ?>"> <?php echo display('assign_by_all') ?> </a></li>
                                <li><a href="<?php echo base_url("report/assign_by_all_doctor") ?>"><?php echo display('assign_by_doctor') ?> </a></li>                    
                                <li><a href="<?php echo base_url("report/assign_by_all_representative") ?>"> <?php echo display('assign_by_representative') ?>  </a></li>
                                <li><a href="<?php echo base_url("report/assign_to_all_doctor") ?>"> <?php echo display('assign_to_doctor') ?></a></li> 

                            </ul>
                        </li> 


  

                        <li class="treeview <?php echo (($this->uri->segment(1) == "prescription") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa ti-book"></i><span><?php echo display('prescription') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("prescription/insurance/create") ?>"><?php echo display('add_insurance') ?></a></li>
                                <li><a href="<?php echo base_url("prescription/insurance") ?>"><?php echo display('insurance_list') ?></a></li> 
                                <li><a href="<?php echo base_url("prescription/case_study/create") ?>"><?php echo display('add_patient_case_study') ?></a></li>
                                <li><a href="<?php echo base_url("prescription/case_study") ?>"><?php echo display('patient_case_study_list') ?></a></li> 
                                <li><a href="<?php echo base_url("prescription/prescription") ?>"><?php echo display('prescription_list') ?></a></li> 
                            </ul>
                        </li>


                        <li class="treeview <?php echo (($this->uri->segment(1) == "account_manager") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-money"></i> <span><?php echo display('account_manager') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("account_manager/account/create") ?>"><?php echo display('add_account') ?></a></li>
                                <li><a href="<?php echo base_url("account_manager/account") ?>"><?php echo display('account_list') ?></a></li> 
                                <li><a href="<?php echo base_url("account_manager/invoice/create") ?>"><?php echo display('add_invoice') ?></a></li>
                                <li><a href="<?php echo base_url("account_manager/invoice") ?>"><?php echo display('invoice_list') ?></a></li> 
                                <li><a href="<?php echo base_url("account_manager/payment/create") ?>"><?php echo display('add_payment') ?></a></li>
                                <li><a href="<?php echo base_url("account_manager/payment") ?>"><?php echo display('payment_list') ?></a></li> 
                                <li><a href="<?php echo base_url("account_manager/report") ?>"><?php echo display('report') ?></a></li>
                                <li><a href="<?php echo base_url("account_manager/report/debit") ?>"><?php echo display('debit_report') ?></a></li> 
                                <li><a href="<?php echo base_url("account_manager/report/credit") ?>"><?php echo display('credit_report') ?></a></li> 
                            </ul>
                        </li>

                        <li class="treeview  <?php echo (($this->uri->segment(1) == "human_resources") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-users"></i> <span><?php echo display('human_resources') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("human_resources/employee/form") ?>"><?php echo display('add_employee') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/accountant") ?>"><?php echo display('accountant_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/laboratorist") ?>"><?php echo display('laboratorist_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/nurse") ?>"><?php echo display('nurse_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/pharmacist") ?>"><?php echo display('pharmacist_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/receptionist") ?>"><?php echo display('receptionist_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/representative") ?>"><?php echo display('representative_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/case_manager") ?>"><?php echo display('case_manager_list') ?></a></li>
                            </ul>
                        </li> 

                        <li class="treeview <?php echo (($this->uri->segment(1) == "bed_manager") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-bed"></i> <span><?php echo display('bed_manager') ?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("bed_manager/bed/form") ?>"><?php echo display('add_bed') ?></a></li> 
                                <li><a href="<?php echo base_url("bed_manager/bed") ?>"><?php echo display('bed_list') ?></a></li> 
                                <li><a href="<?php echo base_url("bed_manager/bed_assign/create") ?>"><?php echo display('bed_assign') ?></a></li> 
                                <li><a href="<?php echo base_url("bed_manager/bed_assign") ?>"><?php echo display('bed_assign_list') ?></a></li> 
                                <li><a href="<?php echo base_url("bed_manager/report") ?>"><?php echo display('report') ?></a></li> 
                            </ul>
                        </li>

                        <li class="treeview <?php echo (($this->uri->segment(1) == "noticeboard") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-bell"></i> <span><?php echo display('noticeboard') ?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("noticeboard/notice/form") ?>"><?php echo display('add_notice') ?></a></li> 
                                <li><a href="<?php echo base_url("noticeboard/notice") ?>"><?php echo display('notice_list') ?></a></li>  
                            </ul>
                        </li>

                        <li class="treeview <?php echo (($this->uri->segment(1) == "case_manager") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-heartbeat"></i> <span><?php echo display('case_manager') ?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("case_manager/patient/form") ?>"><?php echo display('add_patient') ?></a></li> 
                                <li><a href="<?php echo base_url("case_manager/patient") ?>"><?php echo display('patient_list') ?></a></li>  
                            </ul>
                        </li>

                        <li class="treeview <?php echo (($this->uri->segment(1) == "hospital_activities") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-hospital-o"></i> <span><?php echo display('hospital_activities') ?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('hospital_activities/birth/form') ?>"> <?php echo display('add_birth_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/birth/index') ?>"><?php echo display('birth_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/death/form') ?>"> <?php echo display('add_death_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/death/index') ?>"><?php echo display('death_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/operation/form') ?>"> <?php echo display('add_operation_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/operation/index') ?>"><?php echo display('operation_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/investigation/form') ?>"> <?php echo display('add_investigation_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/investigation/index') ?>"><?php echo display('investigation_report') ?></a></li>


                                <li><a href="<?php echo base_url('hospital_activities/category/form') ?>"> <?php echo display('add_medicine_category') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/category/index') ?>"><?php echo display('medicine_category_list') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/medicine/form') ?>"> <?php echo display('add_medicine') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/medicine/index') ?>"><?php echo display('medicine_list') ?></a></li>
                            </ul>
                        </li> 

                        <li class="<?php echo (($this->uri->segment(1) == "enquiry") ? "active" : null) ?>">
                            <a href="<?php echo base_url('enquiry') ?>">
                                <i class="fa fa ti-help-alt"></i> <span><?php echo display('enquiry') ?></span> 
                            </a>
                        </li>

                        <li class="treeview <?php echo (($this->uri->segment(1) == "setting" || $this->uri->segment(1) == "language") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-settings"></i> <span><?php echo display('setting') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("setting") ?>"> <?php echo display('app_setting') ?> </a></li> 
                                <li><a href="<?php echo base_url("language") ?>"> <?php echo display('language_setting') ?> </a></li> 
                            </ul>
                        </li>


                        <li class="treeview <?php echo (($this->uri->segment(1) == "messages") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-comments-o"></i> <span><?php echo display('messages') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a> 
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("messages/message/new_message") ?>"> <?php echo display('new_message') ?> </a></li> 
                                <li><a href="<?php echo base_url("messages/message") ?>"> <?php echo display('inbox') ?> </a></li> 
                                <li><a href="<?php echo base_url("messages/message/sent") ?>"><?php echo display('sent') ?> </a></li>
                            </ul>
                        </li>
                         
                        <li class="treeview <?php echo (($this->uri->segment(1) == "mail") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-email"></i> <span><?php echo display('mail') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("mail/email") ?>"><?php echo display('send_mail') ?> </a></li> 
                                <li><a href="<?php echo base_url("mail/setting") ?>"><?php echo display('mail_setting') ?> </a></li>
                            </ul>
                        </li>

                         
     
                    </ul>
                </div> <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">

                    <div class="p-l-30 p-r-30">
                        <div class="header-icon"><i class="pe-7s-world"></i></div>
                        <div class="header-title">
                            <h1><?php echo str_replace('_', ' ', ucfirst($this->uri->segment(1))) ?></h1>
                            <small><?php echo (!empty($title)?$title:null) ?></small> 
                        </div>
                    </div>
                </section>
                <!-- Main content -->
                <div class="content"> 

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
                   


                    <!-- content -->
                    <?php echo (!empty($content)?$content:null) ?>

                </div> <!-- /.content -->
            </div> <!-- /.content-wrapper -->

            <footer class="main-footer">
                <?= ($this->session->userdata('footer_text')!=null?$this->session->userdata('footer_text'):null) ?>
            </footer>
        </div> <!-- ./wrapper -->
 
        <!-- jquery-ui js -->
        <script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script> 
        <!-- bootstrap js -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>  
        <!-- pace js -->
        <script src="<?php echo base_url('assets/js/pace.min.js') ?>" type="text/javascript"></script>  
        <!-- SlimScroll -->
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>  

        <!-- bootstrap timepicker -->
        <script src="<?php echo base_url() ?>assets/js/jquery-ui-sliderAccess.js" type="text/javascript"></script> 
        <script src="<?php echo base_url() ?>assets/js/jquery-ui-timepicker-addon.min.js" type="text/javascript"></script> 
        <!-- select2 js -->
        <script src="<?php echo base_url() ?>assets/js/select2.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url('assets/js/sparkline.min.js') ?>" type="text/javascript"></script> 
        <!-- Counter js -->
        <script src="<?php echo base_url('assets/js/waypoints.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/jquery.counterup.min.js') ?>" type="text/javascript"></script>

        <!-- ChartJs JavaScript -->
        <script src="<?php echo base_url('assets/js/Chart.min.js') ?>" type="text/javascript"></script>
        
        <!-- semantic js -->
        <script src="<?php echo base_url() ?>assets/js/semantic.min.js" type="text/javascript"></script>
        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>
        <!-- tinymce texteditor -->
        <script src="<?php echo base_url() ?>assets/tinymce/tinymce.min.js" type="text/javascript"></script> 

        <!-- Admin Script -->
        <script src="<?php echo base_url('assets/js/frame.js') ?>" type="text/javascript"></script> 

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>
    </body>
</html>
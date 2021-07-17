<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bed_assign extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array(
            'dashboard_nurse/bed_manager/bed_model',
            'dashboard_nurse/bed_manager/bed_assign_model'
        ));
        
        if ($this->session->userdata('isLogIn') == false 
            || $this->session->userdata('user_role') != 5
        ) 
        redirect('login'); 

    }
 
    public function index()
    {
        $data['title'] = display('bed_assign_list');
        #-------------------------------#
        $data['beds'] = $this->bed_assign_model->read();
        $data['content'] = $this->load->view('dashboard_nurse/bed_manager/bedAssign_view',$data,true);
        $this->load->view('dashboard_nurse/main_wrapper',$data);
    } 


}

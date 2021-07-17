<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investigation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array(
            'dashboard_doctor/hospital_activities/investigation_model' 
        )); 
 
        if ($this->session->userdata('isLogIn') == false
            || $this->session->userdata('user_role') != 2) 
            redirect('login'); 

    }
 
    public function index()
    {
        $data['title'] = display('investigation_report');
        #-------------------------------#
        $data['investigations'] = $this->investigation_model->read();
        $data['content'] = $this->load->view('dashboard_doctor/hospital_activities/investigation_view',$data,true);
        $this->load->view('dashboard_doctor/main_wrapper',$data);
    } 


    public function details($id = null)
    {
        $data['title'] = display('investigation_report');
        #-------------------------------#
        $data['details'] = $this->investigation_model->read_by_id($id);
        $data['content'] = $this->load->view('dashboard_doctor/hospital_activities/details', $data, true);
        $this->load->view('dashboard_doctor/main_wrapper',$data);
    } 


}

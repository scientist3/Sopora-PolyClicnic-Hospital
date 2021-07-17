<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_accountant/patient/patient_model'
		));
 
		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 3
		) 
		redirect('login'); 
		
	}
 
	public function index()
	{  
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read();
		$data['content'] = $this->load->view('dashboard_accountant/patient/patient',$data,true);
		$this->load->view('dashboard_accountant/main_wrapper',$data);
	} 
 

	public function profile($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['content'] = $this->load->view('dashboard_accountant/patient/patient_profile',$data,true);
		$this->load->view('dashboard_accountant/main_wrapper',$data);
	}
 
   
}

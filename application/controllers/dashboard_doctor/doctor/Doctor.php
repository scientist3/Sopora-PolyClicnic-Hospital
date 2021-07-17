<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_doctor/doctor/doctor_model'  
		));

 
		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 2) 
			redirect('login'); 
	}

 
	public function index()
	{  
		$data['title'] = display('doctor_list');
		$data['doctors'] = $this->doctor_model->read();
		$data['content'] = $this->load->view('dashboard_doctor/doctor/doctor',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	} 
 

	public function profile($user_id = null)
	{ 		 
		$data['title'] = display('doctor_profile');
		#-------------------------------#
		$data['user'] = $this->doctor_model->read_by_id($user_id);
		$data['content'] = $this->load->view('dashboard_doctor/doctor/doctor_profile',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	}
 
}

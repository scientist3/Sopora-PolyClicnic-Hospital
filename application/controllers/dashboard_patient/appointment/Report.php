<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_doctor/doctor/doctor_model', 
			'dashboard_doctor/appointment/report_model' 
		));
  
		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 2) 
			redirect('login'); 
		
	}
 

	public function assign_by_me()
	{    
		$data['title'] = display('appointment_assign_by_me');
		#-------------------------------#
		$data['user'] = (object)$getData = [
			'start_date' => $this->input->get('start_date',true),
			'end_date'	 => $this->input->get('end_date',true),
			'user_id'	 => $this->session->userdata('user_id')
		];
		#-------------------------------#
    	$data['appointments'] = $this->report_model->assign_by_user($getData);
		$data['content'] = $this->load->view('dashboard_doctor/appointment/report_assign_by_me',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	} 
 
	public function assign_to_me()
	{  
		$data['title'] = display('appointment_assign_to_me');
		#-------------------------------#
		$data['user'] = (object)$getData = [
			'start_date' => $this->input->get('start_date',true),
			'end_date'	 => $this->input->get('end_date',true),
			'user_id'	 => $this->session->userdata('user_id')
		];
		#-------------------------------#
    	$data['user_list'] = $this->doctor_model->doctor_list();
    	$data['appointments'] = $this->report_model->assign_to_user($getData);
		$data['content'] = $this->load->view('dashboard_doctor/appointment/report_assign_to_me',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	} 
 
}

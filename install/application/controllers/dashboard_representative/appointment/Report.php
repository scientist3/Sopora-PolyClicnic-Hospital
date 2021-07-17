<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_representative/doctor/doctor_model', 
			'dashboard_representative/appointment/report_model' 
		));
  
		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 8) 
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
		$data['content'] = $this->load->view('dashboard_representative/appointment/report_assign_by_me',$data,true);
		$this->load->view('dashboard_representative/main_wrapper',$data);
	} 
  
 
}

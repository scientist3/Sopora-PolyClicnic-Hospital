<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_doctor/bed_manager/report_model', 
		));

 
		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 2) 
			redirect('login'); 
		
	}
 
	public function index()
	{ 
		$data['title'] = display('report');
		#-------------------------------#

		$data['date'] = (object)$getData = [
			'start_date' => (($this->input->get('start_date') != null) ? $this->input->get('start_date'):date('d-m-Y')),
			'end_date'  => (($this->input->get('end_date') != null) ? $this->input->get('end_date'):date('d-m-Y')) 
		]; 

		#-------------------------------#
    	$data['result'] = $this->report_model->read($getData);
		$data['content'] = $this->load->view('dashboard_doctor/bed_manager/report',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	} 
 

	public function details()
	{ 
		$data['title'] = display('report');
		#-------------------------------#
		$data['date'] = (object)$getData = [
			'bed_id'      => $this->input->get('bed_id',true),
			'assign_date' => $this->input->get('assign_date',true)
		];
		#-------------------------------#
    	$data['beds'] = $this->report_model->details($getData);
		$data['content'] = $this->load->view('dashboard_doctor/bed_manager/report_details',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	} 
 
}

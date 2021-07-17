<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prescription extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 10
		) 
		redirect('login'); 
		
		$this->load->model(array(
			'dashboard_patient/prescription/prescription_model'
		)); 
	}
 
	public function index()
	{
		$data['title'] = display('prescription_list');
		#-------------------------------#
		$data['prescription'] = $this->prescription_model->read();
		$data['content'] = $this->load->view('dashboard_patient/prescription/prescription',$data,true);
		$this->load->view('dashboard_patient/main_wrapper',$data);
	} 

	public function view($id = null) 
	{
		$data['title'] = display('prescription_information');
		#-------------------------------#
		$data['website'] = $this->prescription_model->website();
		$data['prescription'] = $this->prescription_model->single_view($id); 
		$data['content'] = $this->load->view('dashboard_patient/prescription/prescription_view',$data,true);
		$this->load->view('dashboard_patient/main_wrapper',$data);
	}
  
}


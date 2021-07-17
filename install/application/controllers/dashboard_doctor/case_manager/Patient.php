<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_doctor/case_manager/patient_model',
			'dashboard_doctor/case_manager/status_model'
		));

		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 2) 
			redirect('login');
	}
 
	public function index()
	{ 
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read($this->session->userdata('user_id'));
		$data['content'] = $this->load->view('dashboard_doctor/case_manager/patient',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	} 

	public function profile($cm_patient_id = null, $getid = null)
	{ 
		$data['title'] =  display('patient_information');

		$data['profile'] = $this->patient_model->read_by_id($cm_patient_id, $this->session->userdata('user_id'));
		if ($getid!=null) {
			$data['status']    = $this->status_model->read_by_id($getid);
		}
		$data['documents'] = $this->patient_model->document($cm_patient_id);
        $data['statuss'] = $this->status_model->read($cm_patient_id, $this->session->userdata('user_id'));
		$data['content'] = $this->load->view('dashboard_doctor/case_manager/patient_profile',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	} 
}

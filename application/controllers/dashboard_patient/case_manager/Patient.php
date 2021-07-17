<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_patient/case_manager/patient_model',
			'dashboard_patient/case_manager/status_model',
			'dashboard_patient/document/document_model',
		));

		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 10) 
			redirect('login');
	}
 
	public function index()
	{ 
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read($this->session->userdata('user_id'));
		$data['content'] = $this->load->view('dashboard_patient/case_manager/patient',$data,true);
		$this->load->view('dashboard_patient/main_wrapper',$data);
	} 

	public function profile($cm_patient_id = null)
	{ 
		$data['title'] =  display('patient_information');

		$data['profile'] = $this->patient_model->read_by_id($cm_patient_id, $this->session->userdata('user_id'));
		$data['documents'] = $this->document_model->read($this->session->userdata('user_id'));
        $data['statuss'] = $this->status_model->read($cm_patient_id);
		$data['content'] = $this->load->view('dashboard_patient/case_manager/patient_profile',$data,true);
		$this->load->view('dashboard_patient/main_wrapper',$data);
	} 


    public function document_delete($id = null)
    {
    	if ($this->document_model->delete($id)) {

	    	$file = $this->input->get('file');
	    	if (file_exists($file)) {
	    		@unlink($file);
	    	}
    		$this->session->set_flashdata('message', display('save_successfully'));

    	} else {
    		$this->session->set_flashdata('exception', display('please_try_again'));
    	}

    	redirect($_SERVER['HTTP_REFERER']);
    }


}

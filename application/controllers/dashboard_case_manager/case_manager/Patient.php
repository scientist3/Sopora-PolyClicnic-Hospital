<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_case_manager/case_manager/patient_model',
			'dashboard_case_manager/case_manager/status_model'
		));

		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 9) 
			redirect('login');
	}
 
	public function index()
	{ 
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read($this->session->userdata('user_id'));
		$data['content'] = $this->load->view('dashboard_case_manager/case_manager/patient',$data,true);
		$this->load->view('dashboard_case_manager/main_wrapper',$data);
	} 

	public function profile($cm_patient_id = null, $getid = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
        $this->form_validation->set_rules('description', display('description'),'required|trim');
        $this->form_validation->set_rules('critical_status', display('status') ,'required');
        /*-------------STORE DATA------------*/
        $datetime = $this->input->post('datetime');

        $data['status'] = (object)$postData = array( 
            'id'              => $this->input->post('id'),
            'cm_patient_id'   => $this->input->post('cm_patient_id'),
            'description'     => $this->input->post('description'),
            'critical_status' => $this->input->post('critical_status'),
        );
        if ($this->input->post('id') == null) {
        	$postData['datetime'] = date('Y-m-d H:i:s');
        }  

		#-------------------------------#
        if ($this->form_validation->run()) { 

            /*-----------CREATE A NEW RECORD-----------*/
        	if (($this->input->post('id')==null)) {

                if ($this->status_model->create($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('save_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
            } else {
                if ($this->status_model->update($postData)) {
                    #set success message
                    $this->session->set_flashdata('message', display('update_successfully'));
                } else {
                    #set exception message
                    $this->session->set_flashdata('exception',display('please_try_again'));
                }
            }

            redirect("dashboard_case_manager/case_manager/patient/profile/$cm_patient_id"); 

        } else { 
			$data['profile'] = $this->patient_model->read_by_id($cm_patient_id, $this->session->userdata('user_id'));
			if ($getid!=null) {
				$data['status']    = $this->status_model->read_by_id($getid);
			}

            $data['documents'] = $this->patient_model->document($cm_patient_id);
	        $data['statuss'] = $this->status_model->read($cm_patient_id);
			$data['content'] = $this->load->view('dashboard_case_manager/case_manager/patient_profile',$data,true);
			$this->load->view('dashboard_case_manager/main_wrapper',$data);
        } 
 

	} 
}

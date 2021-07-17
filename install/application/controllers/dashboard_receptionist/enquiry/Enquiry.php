<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_receptionist/enquiry/enquiry_model'
		));

		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 7 
		) 
		redirect('login'); 
	}
 
 	public function create()
	{
		$data['title'] = display('new_enquiry');
		#-------------------------------#
		$this->form_validation->set_rules('name',display('full_name'),'required|max_length[50]');
		$this->form_validation->set_rules('email',display('email')  ,'required|max_length[100]|valid_email');
		$this->form_validation->set_rules('phone',display('phone')  ,'max_length[20]');
		$this->form_validation->set_rules('enquiry',display('enquiry') ,'required');
		#-------------------------------#
		$data['enquiry'] = (object)$postData = array( 
			'email' 	 => $this->input->post('email',true),
			'phone' 	 => $this->input->post('phone',true),
			'name' 		 => $this->input->post('name',true),
			'enquiry' 	 => $this->input->post('enquiry',true),
			'ip_address' => $this->input->ip_address(),
			'user_agent' => $this->input->user_agent(),
			'created_date' => date('Y-m-d H:i:s'),
			'status'     => 1
		); 		
 	
		#-------------------------------#
		if ($this->form_validation->run() === true) {  

			if ($this->enquiry_model->create($postData)) {
				#set success message
                $this->session->set_flashdata('message', display('submit_successfully'));
			} else {
				#set exception message
                $this->session->set_flashdata('exception',display('please_try_again'));
			} 
            redirect('dashboard_receptionist/enquiry/enquiry/create');

		} else {
			$data['content'] = $this->load->view('dashboard_receptionist/enquiry/enquiry_form',$data,true);
			$this->load->view('dashboard_receptionist/main_wrapper',$data);
		}  
 
	}
  
}

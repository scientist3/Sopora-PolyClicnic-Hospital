<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'mail/setting_model'
		));

		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1
		) 
		redirect('login'); 
	}


	public function index()
	{ 
		$data['title'] = display('mail_setting');
		#-------------------------------#
		$this->form_validation->set_rules('protocol',display('protocol'),'required|max_length[20]');
		$this->form_validation->set_rules('mailpath', display('mailpath') ,'required|max_length[255]');
		$this->form_validation->set_rules('mailtype',display('mailtype'),'required|max_length[20]');
		$this->form_validation->set_rules('validate_email',display('validate_email'),'required|max_length[20]');
		$this->form_validation->set_rules('wordwrap',display('wordwrap'),'required|max_length[20]');
		#-------------------------------#
		$postData = array(
			'id'  		  => $this->input->post('id'),
			'protocol' 	  => $this->input->post('protocol'),
			'mailpath' 	  => $this->input->post('mailpath'),
			'mailtype' 	  => $this->input->post('mailtype'),
			'validate_email' => $this->input->post('validate_email'),
			'wordwrap' 	  => $this->input->post('wordwrap')
		);

		
		$data['setting'] = $this->setting_model->read();
		if (empty($data['setting'])) { 
			$data['setting'] = (object)$postData;
		} 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {
				if ($this->setting_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
			} else {
				if ($this->setting_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				} 
			} 
			redirect('mail/setting');

		} else { 
			$data['content'] = $this->load->view('mail/setting',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}

}

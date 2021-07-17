<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_accountant/account_manager/account_model'
		));
		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 3
		) 
		redirect('login'); 

	}
 
	public function index()
	{
		$data['title'] = display('account_list');
		#-------------------------------#
		$data['accounts'] = $this->account_model->read();
		$data['content'] = $this->load->view('dashboard_accountant/account_manager/account',$data,true);
		$this->load->view('dashboard_accountant/main_wrapper',$data);
	} 

 	public function create()
	{ 
		$data['title'] = display('add_account');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('account_name') ,'required|max_length[100]');
		$this->form_validation->set_rules('type', display('type') ,'required|max_length[20]');
		$this->form_validation->set_rules('description', display('description'),'trim');
		$this->form_validation->set_rules('status', display('status') ,'required');
		#-------------------------------#
		$data['account'] = (object)$postData = [
			'id' 	      => $this->input->post('id',true),
			'name' 		  => $this->input->post('name',true),
			'type' 		  => $this->input->post('type',true),
			'description' => $this->input->post('description',true),
			'date' 		  => date('Y-m-d'),
			'status'      => $this->input->post('status',true)
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {
				if ($this->account_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('dashboard_accountant/account_manager/account/create');
			} else {
				if ($this->account_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('dashboard_accountant/account_manager/account/edit/'.$postData['id']);
			}

		} else {
			$data['content'] = $this->load->view('dashboard_accountant/account_manager/account_form',$data,true);
			$this->load->view('dashboard_accountant/main_wrapper',$data);
		} 
	}

	public function edit($id = null) 
	{
		$data['title'] = display('account_edit');
		#-------------------------------#
		$data['account'] = $this->account_model->read_by_id($id);
		$data['content'] = $this->load->view('dashboard_accountant/account_manager/account_form',$data,true);
		$this->load->view('dashboard_accountant/main_wrapper',$data);
	}
 

	public function delete($id = null) 
	{
		if ($this->account_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('dashboard_accountant/account_manager/account');
	}
  
}

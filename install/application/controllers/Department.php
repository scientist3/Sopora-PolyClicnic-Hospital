<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'department_model'
		));
		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1 
		) 
		redirect('login'); 

	}
 
	public function index()
	{
		$data['title'] = display('department_list');
		#-------------------------------#
		$data['departments'] = $this->department_model->read();
		$data['content'] = $this->load->view('department',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

 	public function create()
	{
		$data['title'] = display('add_department');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('department_name') ,'required|max_length[100]');
		$this->form_validation->set_rules('description', display('description'),'trim');
		$this->form_validation->set_rules('status', display('status') ,'required');
		#-------------------------------#
		$data['department'] = (object)$postData = [
			'dprt_id' 	  => $this->input->post('dprt_id',true),
			'name' 		  => $this->input->post('name',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $dprt_id then insert data
			if (empty($postData['dprt_id'])) {
				if ($this->department_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('department/create');
			} else {
				if ($this->department_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('department/edit/'.$postData['dprt_id']);
			}

		} else {
			$data['content'] = $this->load->view('department_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}

	public function edit($dprt_id = null) 
	{
		$data['title'] = display('department_edit');
		#-------------------------------#
		$data['department'] = $this->department_model->read_by_id($dprt_id);
		$data['content'] = $this->load->view('department_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 

	public function delete($dprt_id = null) 
	{
		if ($this->department_model->delete($dprt_id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('department');
	}
  
}

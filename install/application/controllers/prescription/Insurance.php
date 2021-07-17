<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insurance extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'prescription/insurance_model'
		));
		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1
		) 
		redirect('login'); 

	}
 
	public function index()
	{
		$data['title'] = display('insurance_list');
		#-------------------------------#
		$data['insurances'] = $this->insurance_model->read();
		$data['content'] = $this->load->view('prescription/insurance',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

 	public function create()
	{
		$data['title'] = display('add_insurance');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('insurance_name') ,'required|max_length[100]');
		$this->form_validation->set_rules('description', display('description'),'trim');
		$this->form_validation->set_rules('status', display('status') ,'required');
		#-------------------------------#
		$data['insurance'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'name' 		  => $this->input->post('name',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {
				if ($this->insurance_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('prescription/insurance/create');
			} else {
				if ($this->insurance_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('prescription/insurance/edit/'.$postData['id']);
			}

		} else {
			$data['content'] = $this->load->view('prescription/insurance_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}

	public function edit($id = null) 
	{
		$data['title'] = display('insurance_edit');
		#-------------------------------#
		$data['insurance'] = $this->insurance_model->read_by_id($id);
		$data['content'] = $this->load->view('prescription/insurance_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 

	public function delete($id = null) 
	{
		if ($this->insurance_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('prescription/insurance');
	}
  
}

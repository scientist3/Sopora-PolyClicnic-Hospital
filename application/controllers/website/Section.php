<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'website/section_model'
		)); 

		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1 
		) 
		redirect('login'); 
	}
 

	public function index()
	{
		$data['title'] = display('section');
		#-------------------------------#
		$data['sections'] = $this->section_model->read();
		$data['content'] = $this->load->view('website/pages/section',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

	public function create()
	{
		$data['title'] = display('add_section');
		#-------------------------------# 
		if($this->input->post('id') == null) {
			$is_unique =  '|is_unique[ws_section.name]';
		} else {
			$is_unique =  '';
		}
		$this->form_validation->set_rules('name',display('section_name'), 'required'.$is_unique);
		#-------------------------------#
		$this->form_validation->set_rules('title', display('title'),'max_length[100]');
		$this->form_validation->set_rules('description', display('description'),'trim');
		#-------------------------------#
		$data['section_slag'] = array( 
			'' 	 		 => display('select_option'), 
			'about' 	 => display('about'), 
			'appointment'=> display('appointment'), 
			'blog' 		 => display('blog'),  
			'department' => display('department'), 
			'doctor' 	 => display('doctor'),   
			'service' 	 => display('service'),  
		);
		#-------------------------------#		
		//picture upload
		$picture = $this->fileupload->do_upload(
			'assets_web/images/uploads/',
			'featured_image'
		); 
		//if picture is not uploaded
		if ($picture === false) {
			$this->session->set_flashdata('exception', display('invalid_featured_image'));
		}
		#-------------------------------# 
		$data['section'] = (object)$secData = [
			'id' 			 => $this->input->post('id'),
			'name' 			 => $this->input->post('name'),
			'title' 		 => $this->input->post('title'),
			'description'    => $this->input->post('description'),
			'featured_image' => (!empty($picture)?$picture:$this->input->post('old_image')),
		];
		#-------------------------------#
		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if (empty($secData['id'])) {
				if ($this->section_model->create($secData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('website/section/create');
			} else {
				if ($this->section_model->update($secData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('website/section/edit/'.$secData['id']);
			}
		} else {
			$data['content'] = $this->load->view('website/pages/section_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	} 


	public function edit($id = null) 
	{
		$data['title'] = display('section_edit');
		#-------------------------------#
		$data['section_slag'] = array( 
			'' 	 		 => display('select_option'), 
			'about' 	 => display('about'), 
			'appointment'=> display('appointment'), 
			'blog' 		 => display('blog'),  
			'department' => display('department'), 
			'doctor' 	 => display('doctor'),   
			'service' 	 => display('service'),  
		);
		#-------------------------------#		
		$data['section'] = $this->section_model->read_by_id($id);
		$data['content'] = $this->load->view('website/pages/section_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 

	public function delete($id = null) 
	{
		if ($this->section_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('website/section/');
	}



}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'website/slider_model'
		)); 
 
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1 
		) 
		redirect('login'); 
	}

	public function index()
	{
		$data['title'] = display('slider');
		#-------------------------------#
		$data['sliders'] = $this->slider_model->read();
		$data['content'] = $this->load->view('website/pages/slider',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

	public function create()
	{
		$data['title'] = display('add_slider');
		#-------------------------------# 
		$this->form_validation->set_rules('title', display('title'),'max_length[100]');
		$this->form_validation->set_rules('subtitle', display('subtitle'),'max_length[100]');
		$this->form_validation->set_rules('description', display('description'),'trim');
		$this->form_validation->set_rules('position', display('slide_position'),'trim|numeric|max_length[2]');
		#-------------------------------#		
		//image upload
		$image = $this->fileupload->do_upload(
			'assets_web/images/slider/',
			'image'
		); 
		//if image is not uploaded
		if ($image === false) {
			$this->session->set_flashdata('exception', display('invalid_image'));
		} 
		#-------------------------------# 
		$data['slider'] = (object)$secData = [
			'id' 			 => $this->input->post('id'),
			'title' 		 => $this->input->post('title'),
			'subtitle' 		 => $this->input->post('subtitle'),
			'description'    => $this->input->post('description', false),
			'image' => (!empty($image)?$image:$this->input->post('old_image')),
			'position' 		 => $this->input->post('position'), 
		];
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			if(empty($secData['image'])) {
				$this->session->set_flashdata('exception', display('image_is_required'));
				redirect('website/slider/create');
			}



			#if empty $id then insert data
			if (empty($secData['id'])) {
				if ($this->slider_model->create($secData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('website/slider/create');
			} else {
				if ($this->slider_model->update($secData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('website/slider/edit/'.$secData['id']);
			}
		} else {
			$data['content'] = $this->load->view('website/pages/slider_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	} 

	public function edit($id = null) 
	{
		$data['title'] = display('slider_edit');
		#-------------------------------# 	
		$data['slider'] = $this->slider_model->read_by_id($id);
		$data['content'] = $this->load->view('website/pages/slider_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

	public function delete($id = null) 
	{
		if ($this->slider_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('website/slider/');
	}

}


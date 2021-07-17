<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'website/item_model'
		)); 

		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1 
		) 
		redirect('login'); 
	}
 

	public function index()
	{
		$data['title'] = display("select_item");
		#-------------------------------#
		$data['items'] = $this->item_model->read();
		$data['content'] = $this->load->view('website/pages/item',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

	public function create()
	{
		$data['title'] = display('add_item');
		#-------------------------------#  
		$this->form_validation->set_rules('name', display('menu_name') , 'required|max_length[20]'); 
		$this->form_validation->set_rules('title', display('title') ,'required|max_length[100]');			
		$this->form_validation->set_rules('description',display('description'),'required'); 
		$this->form_validation->set_rules('position', display('position'),'numeric|max_length[2]'); 
		#-------------------------------#		
		//icon_image upload
		$icon_image = $this->fileupload->do_upload(
			'assets_web/images/icon_image/',
			'icon_image'
		);
		// if icon_image is uploaded then resize the icon_image
		if ($icon_image !== false && $icon_image != null) {
			//if not blog post then resize
			if ($this->input->post('name', true) == 'about' || 
				$this->input->post('name', true) == 'blog') {
				$this->fileupload->do_resize(
					$icon_image, 
					640,
					427
				);
			} else {
				$this->fileupload->do_resize(
					$icon_image, 
					64,
					64
				);
			}

		}
		//if icon_image is not uploaded
		if ($icon_image === false) {
			$this->session->set_flashdata('exception', display('invalid_icon_image'));
		}		
		#-------------------------------#
		$data['menu_name'] = array( 
			'' 	 		 => display('select_option'), 
			'about' 	 => display('about'), 
			'appointment'=> display('appointment'), 
			'blog' 		 => display('blog'),  
			'service' 	 => display('service'),  
		);
		#-------------------------------#
		if ($this->input->post('name') == 'blog') {
			$description = $this->input->post('description', true);
		} else {
			$description = strip_tags($this->input->post('description', true));
		}
		#-------------------------------#
		$data['item'] = (object)$itemData = [
			'id' 			 => $this->input->post('id', true),
			'name' 			 => $this->input->post('name', true),
			'title' 		 => $this->input->post('title', true),
			'description'    => $description,
			'position'       => $this->input->post('position', true),
			'counter'        => 0,
			'icon_image'     => (!empty($icon_image)?$icon_image:$this->input->post('old_image')),
			'status'         => $this->input->post('status', true),
			'date'           => date('Y-m-d')
		];
		#-------------------------------#
		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if (empty($itemData['id'])) {
				if ($this->item_model->create($itemData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('website/item/create');
			} else {
				if ($this->item_model->update($itemData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('website/item/edit/'.$itemData['id']);
			}
		} else {
			$data['content'] = $this->load->view('website/pages/item_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	} 


	public function edit($id = null) 
	{ 
		$data['title'] = display('item_edit');
		#-------------------------------#
		$data['menu_name'] = array( 
			'' 	 		 => display('select_option'), 
			'about' 	 => display('about'), 
			'appointment'=> display('appointment'), 
			'blog' 		 => display('blog'),  
			'department' => display('department'),
			'doctor' 	 => display('doctor'), 
			'service' 	 => display('service'),  
		);
		#-------------------------------#		
		$data['item'] = $this->item_model->read_by_id($id);
		$data['content'] = $this->load->view('website/pages/item_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

	public function delete($id = null) 
	{ 
		if ($this->item_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('website/item/');
	}

}

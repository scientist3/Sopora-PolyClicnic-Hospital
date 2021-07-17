<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'website/comment_model'
		));  
	}
 

	public function index()
	{   

		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1 
		) 
		redirect('login'); 


		$data['title'] = display('comments');
		#-------------------------------#
		$data['comments'] = $this->comment_model->read();
		$data['content'] = $this->load->view('website/pages/comment',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

	public function create()
	{   
		$this->form_validation->set_rules('item_id', display('post_id'), 'required|strip_tags|max_length[11]'); 
		$this->form_validation->set_rules('name', display('full_name'), 'required|strip_tags|max_length[50]'); 
		$this->form_validation->set_rules('email',display('email'), 'required|max_length[100]|strip_tags|valid_email'); 
		$this->form_validation->set_rules('comment',display('comments'),'required|strip_tags|max_length[1000]'); 
		#-------------------------------#		
		if ($this->form_validation->run() === true) {

			$commentData = [
				'item_id' 		 => $this->input->post('item_id', true),
				'name' 			 => $this->input->post('name', true),
				'email' 		 => $this->input->post('email', true),
				'comment'        => htmlspecialchars($this->input->post('comment', true)),
				'add_to_website' => 2,
				'date'           => date('Y-m-d h:i:s')
			];

			if ($this->comment_model->create($commentData)) {
				#set success message
				$data['message'] = display('thank_you_for_your_comment');
			} else {
				#set exception message
				$data['exception'] = lang('please_try_again');
			}

		} else {
			#set exception message
			$data['exception'] = validation_errors();
		}  
		echo json_encode($data);
	} 


	public function status() 
	{

		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1 
		) 
		redirect('login'); 


		$this->form_validation->set_rules('id', display('comment_id'), 'required|strip_tags|max_length[11]'); 
		$this->form_validation->set_rules('value',display('comment_status'), 'required|strip_tags|max_length[11]');   
		#-------------------------------#		
		if ($this->form_validation->run() === true) {

			$id = $this->input->post('id', true);
			$value = $this->input->post('value', true);
 
			$this->db->set('add_to_website', $value)
				->where('id', $id)
				->update('ws_comment');

			if ($this->db->affected_rows() > 0) {
				#set success message
				if ($value == 1) {
					$data['message'] = display('comment_added_successfully');
				} else {
					$data['message'] = display('comment_remove_successfully');
				}
			} else {
				#set exception message
				$data['exception'] = display('please_try_again');
			}

		} else {
			#set exception message
			$data['exception'] = validation_errors();
		}  
		echo json_encode($data);
	}

	public function delete($id = null) 
	{

		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1 
		) 
		redirect('login'); 
		
		if ($this->comment_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('website/comment/');
	}
 

}

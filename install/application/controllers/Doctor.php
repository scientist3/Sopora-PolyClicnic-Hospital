<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'doctor_model',
			'department_model'
		));

		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 1)
		redirect('login'); 	
	}

 
	public function index()
	{  
		$data['title'] = display('doctor_list');
		$data['doctors'] = $this->doctor_model->read();
		$data['content'] = $this->load->view('doctor',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 


	public function create()
	{
		$data['title'] = display('add_doctor');
		#-------------------------------#
		$this->form_validation->set_rules('firstname', display('first_name') ,'required|max_length[50]');
		$this->form_validation->set_rules('lastname', display('last_name'),'required|max_length[50]');
		if ($this->input->post('user_id',true) == null) {
			$this->form_validation->set_rules('email', display('email'),'required|max_length[50]|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password', display('password'),'required|max_length[32]|md5');
		}
		$this->form_validation->set_rules('phone', display('phone') ,'max_length[20]');
		$this->form_validation->set_rules('mobile', display('mobile'),'required|max_length[20]');
		$this->form_validation->set_rules('blood_group', display('blood_group'),'max_length[10]');
		$this->form_validation->set_rules('sex', display('sex'),'required|max_length[10]');
		$this->form_validation->set_rules('date_of_birth', display('date_of_birth'),'max_length[10]');
		$this->form_validation->set_rules('address',display('address'),'required|max_length[255]');
		$this->form_validation->set_rules('status',display('status'),'required');
		#-------------------------------#
		//picture upload
		$picture = $this->fileupload->do_upload(
			'assets/images/doctor/',
			'picture'
		);
		// if picture is uploaded then resize the picture
		if ($picture !== false && $picture != null) {
			$this->fileupload->do_resize(
				$picture, 
				293,
				350
			);
		}
		//if picture is not uploaded
		if ($picture === false) {
			$this->session->set_flashdata('exception', display('invalid_picture'));
		}
		#-------------------------------# 
		//when create a user
		if ($this->input->post('user_id',true) == null) {
			$data['doctor'] = (object)$postData = [
				'user_id'      => $this->input->post('user_id',true),
				'firstname'    => $this->input->post('firstname',true),
				'lastname' 	   => $this->input->post('lastname',true),
				'email' 	   => $this->input->post('email',true),
				'password' 	   => md5($this->input->post('password',true)),
				'user_role'    => 2,
				'designation'  => $this->input->post('designation',true),
				'department_id' => $this->input->post('department_id',true),
				'address' 	   => $this->input->post('address',true),
				'phone'   	   => $this->input->post('phone',true),
				'mobile'       => $this->input->post('mobile',true),
				'short_biography' => $this->input->post('short_biography',true),
				'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
				'specialist'   => $this->input->post('specialist',true),
            	'date_of_birth' => date('Y-m-d', strtotime(($this->input->post('date_of_birth',true) != null)? $this->input->post('date_of_birth',true): date('Y-m-d'))),
				'sex' 		   => $this->input->post('sex',true),
				'blood_group'  => $this->input->post('blood_group',true),
				'degree'  	   => $this->input->post('degree',true),
				'created_by'   => $this->session->userdata('user_id'),
				'create_date'  => date('Y-m-d'),
				'status'       => $this->input->post('status',true),
			]; 
		} else { //update a user
			$data['doctor'] = (object)$postData = [
				'user_id'      => $this->input->post('user_id',true),
				'firstname'    => $this->input->post('firstname',true),
				'lastname' 	   => $this->input->post('lastname',true),
				'designation'  => $this->input->post('designation',true),
				'department_id' => $this->input->post('department_id',true),
				'address' 	   => $this->input->post('address',true),
				'phone'   	   => $this->input->post('phone',true),
				'mobile'       => $this->input->post('mobile',true),
				'short_biography' => $this->input->post('short_biography',true),
				'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
				'specialist'   => $this->input->post('specialist',true),
				'date_of_birth' => date('Y-m-d', strtotime($this->input->post('date_of_birth',true))),
				'sex' 		   => $this->input->post('sex',true),
				'blood_group'  => $this->input->post('blood_group',true),
				'degree'  	   => $this->input->post('degree',true),
				'created_by'   => $this->session->userdata('user_id'),
				'create_date'  => date('Y-m-d'),
				'status'       => $this->input->post('status',true),
			]; 
		}
		
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $user_id then insert data
			if (empty($postData['user_id'])) {
				if ($this->doctor_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				//update profile picture
				if ($postData['user_id'] == $this->session->userdata('user_id')) {
					$this->session->set_userdata([
						'picture'   => $postData['picture'],
						'fullname'  => $postData['firstname'].' '.$postData['lastname']
					]); 
				}

				redirect('doctor/create');
			} else {
				if ($this->doctor_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				//update profile picture
				if ($postData['user_id'] == $this->session->userdata('user_id')) {					
					$this->session->set_userdata([
						'picture'   => $postData['picture'],
						'fullname'  => $postData['firstname'].' '.$postData['lastname']
					]); 
				}
				
				redirect('doctor/edit/'.$postData['user_id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('doctor_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}
 

	public function profile($user_id = null)
	{ 		 
		$data['title'] = display('doctor_profile');
		#-------------------------------#
		$data['user'] = $this->doctor_model->read_by_id($user_id);
		$data['content'] = $this->load->view('doctor_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	public function edit($user_id = null) 
	{
		
		$user_role = $this->session->userdata('user_role');
		if ($user_role == 1 && $this->session->userdata('user_id') == $user_id)
			$data['title'] = display('edit_profile');  
		elseif ($user_role == 2)
			$data['title'] = display('edit_profile');  
		else
			$data['title'] = display('edit_doctor');  
		#-------------------------------#
		$data['department_list'] = $this->department_model->department_list(); 
		$data['doctor'] = $this->doctor_model->read_by_id($user_id);
		#-------------------------------#
		if (($data['doctor']->user_id != $this->session->userdata('user_id'))
		&& $this->session->userdata('user_role') != 1)
			redirect('login');
		#-------------------------------#
		$data['content'] = $this->load->view('doctor_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 

	public function delete($user_id = null) 
	{ 
		if ($this->doctor_model->delete($user_id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('doctor');
	}

}

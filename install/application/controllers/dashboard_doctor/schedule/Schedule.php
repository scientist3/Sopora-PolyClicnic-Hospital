<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_doctor/schedule/schedule_model'
		));
		 
 
		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 2) 
			redirect('login'); 

	}
 
	public function index()
	{
		$data['title'] = display('schedule_list');
		$data['schedules'] = $this->schedule_model->read_by_doctor(
			$this->session->userdata('user_id')
		);
		$data['content'] = $this->load->view('dashboard_doctor/schedule//view',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	} 


 	public function create()
	{  
		$data['title'] = display('add_schedule');  
		#-------------------------------#
		$this->form_validation->set_rules('start_time',display('start_time'),'required|max_length[8]');
		$this->form_validation->set_rules('end_time',display('end_time'),'required|max_length[8]');
		$this->form_validation->set_rules('available_days[]',display('available_days'),'required|min_length[1]');
		$this->form_validation->set_rules('per_patient_time',display('per_patient_time'),'required|min_length[1]');
		$this->form_validation->set_rules('serial_visibility_type',display('serial_visibility_type'),'max_length[5]');
		$this->form_validation->set_rules('status',display('status'),'required');
		#-------------------------------# 
		$data['schedule'] = (object)$postData = [
			'schedule_id' 	 => $this->input->post('schedule_id',true),
			'doctor_id' 	 => $this->session->userdata('user_id'),
			'available_days' => $this->input->post('available_days',true),
			'start_time' 	 => $this->input->post('start_time',true),
			'end_time' 	 	 => $this->input->post('end_time',true),
			'per_patient_time' => $this->input->post('per_patient_time',true),
			'serial_visibility_type' => $this->input->post('serial_visibility_type',true),
			'status'         => $this->input->post('status',true)
		];  
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $schedule_id then insert data
			if (empty($postData['schedule_id'])) {
				
				if ($this->schedule_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('dashboard_doctor/schedule/schedule/create');
			} else {
				if ($this->schedule_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('dashboard_doctor/schedule/schedule/edit/'.$postData['schedule_id']);
			}

		} else {
			$data['content'] = $this->load->view('dashboard_doctor/schedule/form',$data,true);
			$this->load->view('dashboard_doctor/main_wrapper',$data);
		} 
	}


	public function edit($schedule_id = null) 
	{ 
		$data['title'] = display('schedule_edit');
		#-------------------------------#
		$doctor_id = $this->session->userdata('user_id');
		$data['schedule'] = $this->schedule_model->read_by_doctor_id($schedule_id, $doctor_id);
		$data['content'] = $this->load->view('dashboard_doctor/schedule/form',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	}


	public function delete($schedule_id = null) 
	{ 
		$doctor_id = $this->session->userdata('user_id');
		if ($this->schedule_model->delete($schedule_id, $user_id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('dashboard_doctor/schedule/schedule/');
	}


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Case_study extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_doctor/prescription/case_study_model'
		));
		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 2
		) 
		redirect('login'); 

	}
 
	public function index()
	{
		$data['title'] = display('patient_case_study_list');
		#-------------------------------#
		$data['case_studys'] = $this->case_study_model->read();
		$data['content'] = $this->load->view('dashboard_doctor/prescription/case_study',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	} 

 	public function create()
	{
		$data['title'] = display('add_patient_case_study');
		#-------------------------------#
		$this->form_validation->set_rules('patient_id', display('patient_id') ,'required|max_length[30]');
		$this->form_validation->set_rules('status', display('status') ,'required');
		#-------------------------------#
		$data['case_study'] = (object)$postData = [
			'id' 	         => $this->input->post('id'), 
			'patient_id'     => $this->input->post('patient_id'), 
			'food_allergies' => $this->input->post('food_allergies'), 
			'tendency_bleed' => $this->input->post('tendency_bleed'), 
			'heart_disease'  => $this->input->post('heart_disease'), 
			'high_blood_pressure' => $this->input->post('high_blood_pressure'), 
			'diabetic' => $this->input->post('diabetic'), 
			'surgery' => $this->input->post('surgery'), 
			'accident' => $this->input->post('accident'), 
			'others' => $this->input->post('others'), 
			'family_medical_history' => $this->input->post('family_medical_history'), 
			'current_medication' => $this->input->post('current_medication'), 
			'female_pregnancy' => $this->input->post('female_pregnancy'), 
			'breast_feeding' => $this->input->post('breast_feeding'), 
			'health_insurance' => $this->input->post('health_insurance'), 
			'low_income' => $this->input->post('low_income'), 
			'reference' => $this->input->post('reference'), 
			'status' => $this->input->post('status')
		]; 
		#-------------------------------#
		if ($this->form_validation->run()) {

			#if empty $id then insert data
			if (empty($postData['id'])) {
				if ($this->case_study_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('dashboard_doctor/prescription/case_study/create');
			} else {
				if ($this->case_study_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('dashboard_doctor/prescription/case_study/edit/'.$postData['id']);
			}

		} else {
			$data['content'] = $this->load->view('dashboard_doctor/prescription/case_study_form',$data,true);
			$this->load->view('dashboard_doctor/main_wrapper',$data);
		} 
	}

	public function edit($id = null) 
	{
		$data['title'] = display('case_study_edit');
		#-------------------------------#
		$data['case_study'] = $this->case_study_model->read_by_id($id);
		$data['content'] = $this->load->view('dashboard_doctor/prescription/case_study_form',$data,true);
		$this->load->view('dashboard_doctor/main_wrapper',$data);
	}
 

	public function delete($id = null) 
	{
		if ($this->case_study_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('dashboard_doctor/prescription/case_study');
	}
  
}

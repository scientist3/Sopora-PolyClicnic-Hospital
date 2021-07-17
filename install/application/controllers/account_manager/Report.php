<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'account_manager/report_model',
			'account_manager/account_model'
		));
		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 1
		) 
		redirect('login'); 


	}
 
	public function index()
	{
		$data['title'] = display('report');
		#-------------------------------#
		$start_date = ($this->input->get('start_date') != '' ? $this->input->get('start_date') : date('d-m-Y'));
		$end_date   = ($this->input->get('end_date') != '' ? $this->input->get('end_date') : date('d-m-Y'));
		#-------------------------------#
		$data['date'] = (object)$reportData = array(
			'start_date' => $start_date,
			'end_date'   => $end_date,
			'patient_id' => $this->input->get('patient_id'), 
			'report_option' => $this->input->get('report_option'), 
		); 

		$data['account_list'] = $this->account_model->debit_acc_list();
		$data['invoice'] = $this->report_model->read($reportData);
		$data['content'] = $this->load->view('account_manager/report', $data, true);
		$this->load->view('layout/main_wrapper',$data);
	} 
 
	public function debit()
	{
		$data['title'] = display('debit_report');
		#-------------------------------#
		$start_date = ($this->input->get('start_date') != '' ? $this->input->get('start_date') : date('d-m-Y'));
		$end_date   = ($this->input->get('end_date') != '' ? $this->input->get('end_date') : date('d-m-Y'));
		#-------------------------------#
		$data['date'] = (object)$reportData = array(
			'report_option' => $this->input->get('report_option'), 
			'account_id' => $this->input->get('account_id'), 
			'patient_id' => $this->input->get('patient_id'), 
			'start_date' => $start_date,
			'end_date'   => $end_date,
		);  

		$data['debit_acc_list']  = $this->account_model->debit_acc_list();
		$data['invoice'] = $this->report_model->debit($reportData);
		$data['content'] = $this->load->view('account_manager/report_debit', $data, true);
		$this->load->view('layout/main_wrapper',$data);
	} 

 
	public function credit()
	{
		$data['title'] = display('credit_report');
		#-------------------------------#
		$start_date = ($this->input->get('start_date') != '' ? $this->input->get('start_date') : date('d-m-Y'));
		$end_date   = ($this->input->get('end_date') != '' ? $this->input->get('end_date') : date('d-m-Y'));
		// #-------------------------------#
		$data['date'] = (object)$reportData = array(
			'report_option' => $this->input->get('report_option'), 
			'account_id' => $this->input->get('account_id'), 
			'pay_to' => $this->input->get('pay_to'), 
			'start_date' => $start_date,
			'end_date'   => $end_date,
		);  

		$data['credit_acc_list'] = $this->account_model->credit_acc_list();
		$data['invoice'] = $this->report_model->credit($reportData);
		$data['content'] = $this->load->view('account_manager/report_credit', $data, true);
		$this->load->view('layout/main_wrapper',$data);
	} 

}

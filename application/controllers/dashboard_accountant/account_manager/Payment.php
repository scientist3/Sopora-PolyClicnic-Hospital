<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_accountant/account_manager/account_model',
			'dashboard_accountant/account_manager/payment_model'
		));
		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 3
		) 
		redirect('login'); 

	}
 
	public function index()
	{
		$data['title'] = display('payment_list');
		#-------------------------------#
		$data['payments'] = $this->payment_model->read();
		$data['content'] = $this->load->view('dashboard_accountant/account_manager/payment',$data,true);
		$this->load->view('dashboard_accountant/main_wrapper',$data);
	} 

 	public function create()
	{ 
		$data['title'] = display('add_payment');
		#-------------------------------#
		$this->form_validation->set_rules('date', display('date') ,'required|max_length[10]');
		$this->form_validation->set_rules('account_id', display('account_name') ,'required|max_length[100]');
		$this->form_validation->set_rules('pay_to', display('pay_to') ,'required|max_length[255]');
		$this->form_validation->set_rules('description', display('description'),'trim');
		$this->form_validation->set_rules('amount', display('amount'),'trim|required');
		$this->form_validation->set_rules('status', display('status') ,'required');
		#-------------------------------#
		$date = $this->input->post('date');
		$data['payment'] = (object)$postData = [
			'id' 	      => $this->input->post('id',true),
			'date' 		  => ($date == ''?date('Y-m-d'):date('Y-m-d', strtotime($date))),
			'account_id'  => $this->input->post('account_id',true),
			'pay_to' 	  => $this->input->post('pay_to',true),
			'description' => $this->input->post('description',true),
			'amount'      => $this->input->post('amount',true),
			'created_id'  => $this->session->userdata('user_id'),
			'status'      => $this->input->post('status',true)
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {
				if ($this->payment_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('dashboard_accountant/account_manager/payment/create');
			} else {
				if ($this->payment_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('dashboard_accountant/account_manager/payment/edit/'.$postData['id']);
			}

		} else {
			$data['credit_acc_list'] = $this->account_model->credit_acc_list();
			$data['content'] = $this->load->view('dashboard_accountant/account_manager/payment_form',$data,true);
			$this->load->view('dashboard_accountant/main_wrapper',$data);
		} 
	}

	public function edit($id = null) 
	{
		$data['title'] = display('payment_edit');
		#-------------------------------#
		$data['credit_acc_list'] = $this->account_model->credit_acc_list();
		$data['payment'] = $this->payment_model->read_by_id($id);
		$data['content'] = $this->load->view('dashboard_accountant/account_manager/payment_form',$data,true);
		$this->load->view('dashboard_accountant/main_wrapper',$data);
	}
 

	public function delete($id = null) 
	{
		if ($this->payment_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('dashboard_accountant/account_manager/payment');
	}
  
}

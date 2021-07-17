<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_accountant/account_manager/account_model',
			'dashboard_accountant/account_manager/invoice_model'
		));
		
		if ($this->session->userdata('isLogIn') == false 
			|| $this->session->userdata('user_role') != 3
		) 
		redirect('login'); 

	}
 
	public function index()
	{
		$data['title'] = display('invoice_list');
		#-------------------------------#
		$data['invoice'] = $this->invoice_model->read();
		$data['content'] = $this->load->view('dashboard_accountant/account_manager/invoice',$data,true);
		$this->load->view('dashboard_accountant/main_wrapper',$data);
	} 

 	public function create()
	{  

		$data['title'] = display('add_invoice');
		#-------------------------------#
		$this->form_validation->set_rules('patient_id', display('patient_id') ,'required|max_length[100]');
		$this->form_validation->set_rules('account_id[]', display('account_name') ,'required|max_length[100]');
		$this->form_validation->set_rules('description[]', display('description'),'trim');
		$this->form_validation->set_rules('quantity[]', display('quantity'),'required|trim');
		$this->form_validation->set_rules('price[]', display('price'),'required|trim');
		$this->form_validation->set_rules('total', display('total'),'required|trim');
		$this->form_validation->set_rules('vat', display('vat'),'required|trim');
		$this->form_validation->set_rules('discount', display('discount'),'required|trim');
		$this->form_validation->set_rules('grand_total', display('grand_total'),'required|trim');
		$this->form_validation->set_rules('paid', display('paid'),'required|trim');
		$this->form_validation->set_rules('due', display('due'),'required|trim');
		$this->form_validation->set_rules('status', display('status'),'required|trim');
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			$invoiceData = array(
				'patient_id' => $this->input->post('patient_id', true),
				'total' 	 => $this->input->post('total', true),
				'vat' 	 	 => $this->input->post('vat', true),
				'discount' 	 => $this->input->post('discount', true),
				'grand_total'=> $this->input->post('grand_total', true),
				'due' 		 => $this->input->post('due', true),
				'paid' 		 => $this->input->post('paid', true),
				'created_id' => $this->session->userdata('user_id'),
				'date'   	 => date('Y-m-d', strtotime($this->input->post('date', true))),
				'status' 	 => $this->input->post('status', true),
			);

			if ($this->invoice_model->create($invoiceData)) {

				#-------------DETAILS-----------#
				$invoice_id  = $this->db->insert_id();
				$account_id  = $this->input->post('account_id', true);
				$description = $this->input->post('description', true);
				$quantity    = $this->input->post('quantity', true);
				$price       = $this->input->post('price', true);
				$subtotal    = $this->input->post('subtotal', true);

				for($i = 0; $i < sizeof($account_id); $i++) {
					$detailsData = array(
						'invoice_id'  => $invoice_id,
						'account_id'  => $account_id[$i],
						'description' => $description[$i],
						'quantity'    => $quantity[$i],
						'price'       => $price[$i],
						'subtotal'    => $subtotal[$i] 
					); 
					$this->invoice_model->create_details($detailsData);
				}
				#-------------------------------#

				#set success message
				$this->session->set_flashdata('message', display('save_successfully'));
				redirect('dashboard_accountant/account_manager/invoice/view/'.$invoice_id);

			} else {
				#set exception message
				$this->session->set_flashdata('exception',display('please_try_again'));
			}
			redirect('dashboard_accountant/account_manager/invoice/create');
			

		} else {
			$data['website'] = $this->invoice_model->website();
			$data['debit_account_list'] = $this->account_model->debit_acc_list();
			$data['content'] = $this->load->view('dashboard_accountant/account_manager/invoice_form',$data,true);
			$this->load->view('dashboard_accountant/main_wrapper',$data);
		} 
	}

	public function view($id = null) 
	{
		$data['title'] = display('invoice_information');
		#-------------------------------#
		$data['website'] = $this->invoice_model->website();
		$data['invoice'] = $this->invoice_model->single_view($id);
		$data['invoice_data'] = $this->invoice_model->invoice_data($id);
		$data['content'] = $this->load->view('dashboard_accountant/account_manager/invoice_view',$data,true);
		$this->load->view('dashboard_accountant/main_wrapper',$data);
	}

	public function edit($id = null) 
	{
		$data['title'] = display('invoice_edit');
		#-------------------------------#
		$this->form_validation->set_rules('patient_id', display('patient_id') ,'required|max_length[100]');
		$this->form_validation->set_rules('account_id[]', display('account_name') ,'required|max_length[100]');
		$this->form_validation->set_rules('description[]', display('description'),'trim');
		$this->form_validation->set_rules('quantity[]', display('quantity'),'required|trim');
		$this->form_validation->set_rules('price[]', display('price'),'required|trim');
		$this->form_validation->set_rules('total', display('total'),'required|trim');
		$this->form_validation->set_rules('vat', display('vat'),'required|trim');
		$this->form_validation->set_rules('discount', display('discount'),'required|trim');
		$this->form_validation->set_rules('grand_total', display('grand_total'),'required|trim');
		$this->form_validation->set_rules('paid', display('paid'),'required|trim');
		$this->form_validation->set_rules('due', display('due'),'required|trim');
		$this->form_validation->set_rules('status', display('status'),'required|trim');
		#-------------------------------# 
		if ($this->form_validation->run() === true) {

			$invoiceData = array(
				'id'         => $this->input->post('id', true),
				'patient_id' => $this->input->post('patient_id', true),
				'total' 	 => $this->input->post('total', true),
				'vat' 	 	 => $this->input->post('vat', true),
				'discount' 	 => $this->input->post('discount', true),
				'grand_total'=> $this->input->post('grand_total', true),
				'due' 		 => $this->input->post('due', true),
				'paid' 		 => $this->input->post('paid', true),
				'created_id' => $this->session->userdata('user_id'),
				'date'   	 => date('Y-m-d', strtotime($this->input->post('date', true))),
				'status' 	 => $this->input->post('status', true),
			);

			if ($this->invoice_model->update($invoiceData)) {

				#-------------DETAILS-----------#
				$invoice_id  = $this->input->post('id', true);
				$account_id  = $this->input->post('account_id', true);
				$description = $this->input->post('description', true);
				$quantity    = $this->input->post('quantity', true);
				$price       = $this->input->post('price', true);
				$subtotal    = $this->input->post('subtotal', true);

				#-------------DELETE OLD DETAILS-----------#
				$this->invoice_model->delete_details($invoice_id);

				for($i = 0; $i < sizeof($account_id); $i++) {
					$detailsData = array(
						'invoice_id'  => $invoice_id,
						'account_id'  => $account_id[$i],
						'description' => $description[$i],
						'quantity'    => $quantity[$i],
						'price'       => $price[$i],
						'subtotal'    => $subtotal[$i] 
					); 
					$this->invoice_model->create_details($detailsData);
				}
				#-------------------------------#

				#set success message
				$this->session->set_flashdata('message', display('update_successfully'));
				redirect('dashboard_accountant/account_manager/invoice/view/'.$invoice_id);

			} else {
				#set exception message
				$this->session->set_flashdata('exception',display('please_try_again'));
			}
			redirect('dashboard_accountant/account_manager/invoice/edit/'.$invoice_id);
			

		} else {
			$data['website'] = $this->invoice_model->website();
			$data['debit_account_list'] = $this->account_model->debit_acc_list();
			$data['invoice'] = $this->invoice_model->single_view($id);
			$data['invoice_data'] = $this->invoice_model->invoice_data($id);
			$data['content'] = $this->load->view('dashboard_accountant/account_manager/invoice_edit',$data,true);
			$this->load->view('dashboard_accountant/main_wrapper',$data);
		} 
	}
 

	public function delete($id = null) 
	{
		if ($this->invoice_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('dashboard_accountant/account_manager/invoice');
	}


	//patient information
	public function patient()
	{
		$patient   = $this->invoice_model->patient();
		if ($patient->num_rows() > 0) {
			$data['status'] = true;
			$data['patient_name'] = $patient->row()->firstname.' '.$patient->row()->lastname; 
			$data['patient_address'] = $patient->row()->address;
		} else {
			$data['status'] = false;
		}
		echo json_encode($data);
	}
 
  
}


<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	public function read($data = null)
	{
		$start_date   = date('Y-m-d',strtotime($data['start_date']));
		$end_date     = date('Y-m-d',strtotime($data['end_date']));
		$patient_id   = $data['patient_id'];
		$report_option = $data['report_option'];

		if ($report_option == 1){
			return $this->db->select("*")
				->from('acm_invoice') 
				->where("acm_invoice.date BETWEEN '$start_date' AND '$end_date'",null,false) 
				->where("acm_invoice.status",1) 
				->order_by('date','asc')
				->get()
				->result();

		} else if ($report_option == 2) {
			return $this->db->select("*")
				->from('acm_invoice') 
				->where("acm_invoice.date BETWEEN '$start_date' AND '$end_date'",null,false) 
				->where("acm_invoice.patient_id",$patient_id) 
				->where("acm_invoice.status",1) 
				->order_by('date','asc')
				->get()
				->result();
		}  
	}

	public function debit($data = null)
	{		
		$report_option = $data['report_option'];
		$account_id    = $data['account_id'];
		$patient_id    = $data['patient_id'];
		$start_date   = date('Y-m-d',strtotime($data['start_date']));
		$end_date     = date('Y-m-d',strtotime($data['end_date']));
		/*------------------------------------*/
		$this->db->select("
			acm_invoice_details.*, 
			acm_invoice.patient_id, 
			acm_invoice.date, 
			acm_account.name as account_name
			");
		$this->db->from('acm_invoice_details'); 
		$this->db->join('acm_invoice', 'acm_invoice.id = acm_invoice_details.invoice_id', 'full');
		$this->db->join('acm_account', 'acm_account.id = acm_invoice_details.account_id');
			/*--------------------------------*/
			if ($report_option == 2) {
				// patient_wise filter
				$this->db->where("acm_invoice.patient_id", $patient_id);
			} else if ($report_option == 3) {
				$this->db->where('acm_invoice_details.account_id', $account_id); 

			}
			/*--------------------------------*/
		$this->db->where("acm_invoice.date BETWEEN '$start_date' AND '$end_date'",null,false); 
		$this->db->where("acm_invoice.status",1); 
		$this->db->order_by('acm_invoice.date','asc');
		$result = $this->db->get();
		return $result->result(); 
	} 

	public function credit($data = null)
	{		
		$report_option = $data['report_option'];
		$account_id    = $data['account_id'];
		$pay_to    	   = $data['pay_to'];
		$start_date    = date('Y-m-d',strtotime($data['start_date']));
		$end_date      = date('Y-m-d',strtotime($data['end_date']));
		/*------------------------------------*/
		$this->db->select("
			acm_payment.*,
			acm_account.name as account_name
			");
		$this->db->from('acm_payment'); 
		$this->db->join('acm_account', 'acm_account.id = acm_payment.account_id');
		/*--------------------------------*/
		if ($report_option == 2) {
			// patient_wise filter
			$this->db->like("acm_payment.pay_to", $pay_to);
		} else if ($report_option == 3) {
			$this->db->where('acm_payment.account_id', $account_id); 

		}
		/*--------------------------------*/
		$this->db->where("acm_payment.date BETWEEN '$start_date' AND '$end_date'",null,false); 
		$this->db->where("acm_payment.status",1); 
		$this->db->order_by('acm_payment.date','asc');
		$result = $this->db->get();
		return $result->result(); 
	} 
}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {

	public function create($data = [])
	{	 
		return $this->db->insert('acm_invoice',$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from('acm_invoice') 
			->order_by('id','desc')
			->get()
			->result();
	} 
 
	public function single_view($id = null)
	{
		return $this->db->select("acm_invoice.*, patient.firstname, patient.lastname, patient.address")
			->from('acm_invoice') 
			->join('patient', 'patient.patient_id = acm_invoice.patient_id', 'full') 
			->where('acm_invoice.id',$id) 
			->get()
			->row();
	} 
 
	public function invoice_data($id = null)
	{
		return $this->db->select("acm_invoice_details.*, acm_account.name")
			->from("acm_invoice_details")  
			->join('acm_account', 'acm_account.id = acm_invoice_details.account_id', 'full')
			->where('acm_invoice_details.invoice_id',$id) 
			->get()
			->result();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update('acm_invoice',$data); 
	} 
 
	public function delete($id = null)
	{ 
		$this->db->where('invoice_id',$id)
			->delete('acm_invoice_details');

		$this->db->where('id',$id)
			->delete('acm_invoice');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	
	
	public function patient()
	{
		return $this->db->select('patient_id, firstname, lastname, address')
			->from('patient')
			->where('patient_id', $this->input->post('patient_id'))
			->get();
	}

	public function website()
	{
		return $this->db->select('title, description')
			->from('setting')
			->get()
			->row();
	}


	public function create_details($data = [])
	{	 
		return $this->db->insert('acm_invoice_details',$data);
	}

	public function delete_details($invoice_id = null)
	{
		return $this->db->where('invoice_id',$invoice_id)
			->delete('acm_invoice_details'); 
	} 

 }

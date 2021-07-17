<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

	public function create($data = [])
	{	 
		return $this->db->insert('acm_payment',$data);
	}
 
	public function read()
	{
		return $this->db->select("acm_payment.*, acm_account.name as account_name")
			->from('acm_payment')
			->join('acm_account', 'acm_payment.account_id = acm_account.id','full')
			->order_by('id','desc')
			->get()
			->result();
	} 
 
	public function read_by_id($id = null)
	{
		return $this->db->select("*")
			->from('acm_payment')
			->where('id',$id)
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update('acm_payment',$data); 
	} 
 
	public function delete($id = null)
	{
		$this->db->where('id',$id)
			->delete('acm_payment');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}  
	
}

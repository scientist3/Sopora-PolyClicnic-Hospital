<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	private $table = 'acm_account';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->order_by('id','desc')
			->get()
			->result();
	} 
 
	public function read_by_id($id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('id',$id)
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 
 
	public function delete($id = null)
	{
		$this->db->where('id',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}  

	public function debit_acc_list()
	{
		$result = $this->db->select('id, name')
			->from('acm_account')
			->where('type', 1)
			->where('status', 1)
			->get();
			
		$list = array();
		if ($result->num_rows() > 0) { 
			$list[''] = display('select_option'); 
			foreach ($result->result() as $value) {
				$list[$value->id] = $value->name;
			}
			return $list;
		} else {
			return false; 
		} 
	}


	public function credit_acc_list()
	{
		$result = $this->db->select('id, name')
			->from('acm_account')
			->where('type', 2)
			->where('status', 1)
			->get();
			
		$list = array();
		if ($result->num_rows() > 0) { 
			$list[''] = display('select_option'); 
			foreach ($result->result() as $value) {
				$list[$value->id] = $value->name;
			}
			return $list;
		} else {
			return false; 
		} 
	}
	
}

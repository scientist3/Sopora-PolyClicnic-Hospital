<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry_model extends CI_Model {
 
	private $table = "enquiry";


	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}


	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->order_by('enquiry_id','desc')
			->get()
			->result();
	} 
 

	public function read_by_id($enquiry_id)
	{	
		return $this->db->select("enquiry.*, user.firstname, user.lastname")
			->from($this->table)
			->join('user','user.user_id = enquiry.checked_by','left')
			->where('enquiry.enquiry_id',$enquiry_id)
			->get()
			->row();
	}

	public function check_exists($enquiry_id)
	{	
		$result = $this->db->select("checked")
			->from("enquiry")
			->where('enquiry_id',$enquiry_id)
			->where('checked', null)
			->get()
			->num_rows();

		if ($result > 0) {
			return true;
		} else {
			return false;
		}
	}
 

 
	public function update($data = [])
	{
		return $this->db->where('enquiry_id',$data['enquiry_id'])
			->update($this->table,$data); 
	} 


	public function delete($enquiry_id = null)
	{
		$this->db->where('enquiry_id',$enquiry_id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

}

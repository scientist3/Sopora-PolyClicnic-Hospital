<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {

	private $table = "patient";
 
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
 
  
}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {

	private $table = "patient";
 
	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}

 
	public function read($patient_id)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('patient_id',$patient_id)
			->get()
			->row();
	} 
  
}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	private $table = 'account';

	/*public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}*/
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			//->where('user_id',$this->session->userdata('user_role'))
			->get()
			->result();
	}
}
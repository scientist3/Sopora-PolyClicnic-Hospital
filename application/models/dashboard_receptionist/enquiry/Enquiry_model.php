<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry_model extends CI_Model {
 
	private $table = "enquiry";


	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
}

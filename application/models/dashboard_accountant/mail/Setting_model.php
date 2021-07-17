<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {
 
	private $table = "mail_setting";
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->get()
			->row();
	} 
	
}

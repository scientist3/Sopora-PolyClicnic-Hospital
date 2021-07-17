<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {
 
	private $table = "setting";

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{	

		// These Details Are Fetched From The "Setting" Table in "Hospital" Database Like
		// Table Columns : setting_id 	title 	description 	email 	phone 	logo 	favicon 	language 	site_align 	footer_text 

		// Actual Contents: 2 	Sopora Polyclicnic 	New Coloney Sopora	hospital@gmail.com 	1234567890 	assets/images/apps/2017-01-14/H.png 	assets/images/icons/2017-02-18/f.ico 	english 	LTR 	2019©Copyright JKED
		
		return $this->db->select("*")
			->from($this->table)
			->get()
			->row();
	} 
	
  	public function update($data = [])
	{
		return $this->db->where('setting_id',$data['setting_id'])
			->update($this->table,$data); 
	} 
}

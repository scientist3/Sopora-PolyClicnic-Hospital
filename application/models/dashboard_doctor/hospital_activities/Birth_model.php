<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Birth_model extends CI_Model {

	private $table = 'ha_birth';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("ha_birth.*, CONCAT_WS(' ', user.firstname, user.lastname) AS doctor_name ")
			->from("ha_birth")
			->join('user', 'user.user_id = ha_birth.doctor_id', 'left')
			->order_by('id','desc')
			->get()
			->result();
	} 
 
	public function read_by_id($id = null)
	{
		return $this->db->select("ha_birth.*, CONCAT_WS(' ', user.firstname, user.lastname) AS doctor_name ")
			->from("ha_birth")
			->join('user', 'user.user_id = ha_birth.doctor_id', 'left')
			->where('ha_birth.id',$id)
			->order_by('id','desc')
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
 
	
 }

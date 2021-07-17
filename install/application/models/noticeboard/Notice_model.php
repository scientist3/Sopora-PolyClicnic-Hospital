<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notice_model extends CI_Model {

	private $table = 'notice';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("notice.*, 
				CONCAT_WS(' ', user.firstname, user.lastname) as assign_by")
			->from("notice")
			->join('user', 'user.user_id = notice.assign_by')
			->order_by('notice.id','desc')
			->get()
			->result();
	} 
 
	public function read_by_id($id = null)
	{ 
		return $this->db->select("notice.*, 
				CONCAT_WS(' ', user.firstname, user.lastname) as assign_by")
			->from("notice")
			->join('user', 'user.user_id = notice.assign_by')
			->where('notice.id',$id)
			->order_by('notice.id','desc')
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

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Representative_model extends CI_Model {

	private $table = "user";
 
	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table) 
			->order_by('user_id','desc')
			->where('user_role',3)
			->get()
			->result();
	} 
 
	public function read_by_id($user_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('user_id',$user_id) 
			->where('user_role',3)
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('user_id',$data['user_id']) 
			->update($this->table,$data); 
	} 
 
	public function delete($user_id = null)
	{
		$this->db->where('user_id',$user_id) 			
			->or_where('user_role',3)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 


	public function representative_list()
	{
		$result = $this->db->select("*")
			->from($this->table)
			->where('user_role', 8)
			->where('status', 1)
			->get()
			->result();

		$list[''] = display('select_representative');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->user_id] = $value->firstname.' '.$value->lastname; 
			}
			return $list;
		} else {
			return false;
		}
	}

  
}

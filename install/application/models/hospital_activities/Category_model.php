<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	private $table = 'ha_category';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->order_by('name','asc')
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

	public function category_list()
	{
		$result = $this->db->select("*")
			->from($this->table)
			->where('status',1)
			->order_by('name', 'asc')
			->get()
			->result();

		$list[''] = display('select_category');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->id] = $value->name; 
			}
			return $list;
		} else {
			return false;
		}
	}
	
 }

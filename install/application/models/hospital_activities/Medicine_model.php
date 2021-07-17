<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Medicine_model extends CI_Model {

	private $table = 'ha_medicine';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("ha_medicine.*, ha_category.name as category")
			->from('ha_medicine')
			->join('ha_category', 'ha_category.id = ha_medicine.category_id', 'left')
			->order_by('ha_medicine.name','asc')
			->get()
			->result();
	} 
 
	public function read_by_id($id = null)
	{
		return $this->db->select("ha_medicine.*, ha_category.name as category")
			->from('ha_medicine')
			->join('ha_category', 'ha_category.id = ha_medicine.category_id', 'left')
			->where('ha_medicine.id',$id)
			->order_by('ha_medicine.name','asc')
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

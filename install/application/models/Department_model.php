<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model {

	private $table = 'department';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->order_by('dprt_id','desc')
			->get()
			->result();
	} 
 
	public function read_by_id($dprt_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('dprt_id',$dprt_id)
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('dprt_id',$data['dprt_id'])
			->update($this->table,$data); 
	} 
 
	public function delete($dprt_id = null)
	{
		$this->db->where('dprt_id',$dprt_id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	public function department_list()
	{
		$result = $this->db->select("*")
			->from($this->table)
			->where('status',1)
			->get()
			->result();

		$list[''] = display('select_department');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->dprt_id] = $value->name; 
			}
			return $list;
		} else {
			return false;
		}
	}
	
 }

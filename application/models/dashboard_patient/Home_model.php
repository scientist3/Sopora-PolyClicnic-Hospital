<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {


	public function profile($id = null)
	{
		return $this->db->select("*")
			->from("patient") 
			->where('id', $id)
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update("patient" ,$data); 
	} 
 
	public function department_list()
	{
		$result = $this->db->select("*")
			->from('department')
			->where('status',1)
			->get()
			->result();

		$list[''] = display('select_doctor');
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

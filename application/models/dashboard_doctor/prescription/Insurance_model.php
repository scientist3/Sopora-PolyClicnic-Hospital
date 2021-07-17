<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Insurance_model extends CI_Model {

	private $table = 'pr_insurance';

	public function insurance_list()
	{
		$result = $this->db->select("*")
			->from($this->table)
			->where('status',1)
			->get()
			->result();

		$list[''] = display('insurance_list');
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

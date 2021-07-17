<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bed_assign_model extends CI_Model {

	private $table = 'bm_bed_assign';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("
				bm_bed_assign.*,
				COUNT(bm_bed_assign.serial) as days, 
				bm_bed.type as bed_name,
				bm_bed.charge,
				CONCAT_WS(' ', firstname, lastname) as assign_by
			")
			->from('bm_bed_assign')
			->join('user', 'user.user_id = bm_bed_assign.assign_by', 'left')
			->join('bm_bed', 'bm_bed.id = bm_bed_assign.bed_id', 'left')
			->group_by(array('serial','patient_id'))
			->order_by('assign_date','desc')
			->get()
			->result();
	} 
 
	public function read_by_serial($serial = null)
	{
		return $this->db->select("
				bm_bed_assign.*, 
				bm_bed.type as bed_name,
				CONCAT_WS(' ', firstname, lastname) as assign_by
			")
			->from('bm_bed_assign')
			->join('user', 'user.user_id = bm_bed_assign.assign_by', 'left')
			->join('bm_bed', 'bm_bed.id = bm_bed_assign.bed_id', 'left')
			->where('bm_bed_assign.serial',$serial)
			->group_by(array('serial','patient_id'))
			->order_by('assign_date','asc')
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 
 
	public function delete($serial = null)
	{
		$this->db->where('serial',$serial)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
 
 }

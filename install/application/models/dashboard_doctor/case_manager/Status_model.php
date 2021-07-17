<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

	private $table = 'cm_status';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
  
	public function read($id = null, $did = null)
	{
		return $this->db->select("
				cm_status.* 
			")
			->from("cm_status") 
			->join('cm_patient', 'cm_patient.id = cm_status.cm_patient_id','left')
			->where('cm_status.cm_patient_id',$id)
			->where('cm_patient.ref_doctor_id',$did)
			->order_by('id','desc')
			->get()
			->result();
	} 
 
	public function read_by_id($id = null)
	{
		return $this->db->select("
				cm_status.* 
			")
			->from("cm_status") 
			->where('cm_status.id',$id)
			->order_by('id','desc')
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 
 
	
 }

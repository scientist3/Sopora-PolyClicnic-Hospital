<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Case_study_model extends CI_Model {

	private $table = 'pr_case_study';

	public function create($data = array())
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->order_by('id','desc')
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
 
	public function update($data = array())
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
 
 
	public function read_by_patient_id($patient_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('patient_id',$patient_id)
			->order_by('id','desc')
			->get()
			->row();
	} 
 }

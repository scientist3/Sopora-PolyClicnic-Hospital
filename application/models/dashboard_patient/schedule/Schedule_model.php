<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model extends CI_Model {

	private $table = "schedule";
 
	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("schedule.*, user.firstname, user.lastname, department.name")
			->from($this->table)
			->join('user','user.user_id = schedule.doctor_id','left')
			->join('department','department.dprt_id = user.department_id','left')
			->order_by('schedule.schedule_id','desc')
			->get()
			->result();
	} 
 
 
	public function read_by_doctor($doctor_id = null)
	{		
		return $this->db->select("schedule.*, user.firstname, user.lastname, department.name")
			->from($this->table)
			->join('user','user.user_id = schedule.doctor_id','left')
			->join('department','department.dprt_id = user.department_id','left')
			->where('schedule.doctor_id',$doctor_id)
			->get() 
			->result();
	} 


	public function read_by_id($schedule_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('schedule_id',$schedule_id)
			->get()
			->row();
	} 

	public function read_by_doctor_id($schedule_id = null, $doctor_id = null)
	{
		return $this->db->select("*")
			->from($this->table)
			->where('schedule_id',$schedule_id)
			->where('doctor_id',$doctor_id)
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('schedule_id',$data['schedule_id'])
			->update($this->table,$data); 
	} 
 
	public function delete($schedule_id = null)
	{
		$this->db->where('schedule_id',$schedule_id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
  
	public function delete_by_doctor($schedule_id = null, $doctor_id = null)
	{
		$this->db->where('schedule_id',$schedule_id)
			->where('doctor_id',$doctor_id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
  

}

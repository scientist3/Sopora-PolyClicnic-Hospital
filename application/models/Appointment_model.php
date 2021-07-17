<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment_model extends CI_Model {

	private $table = 'appointment';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("
				appointment.*, 
				user.firstname, 
				user.lastname,  
				department.name
			")
			->from($this->table)
			->join('user','user.user_id = appointment.doctor_id')
			->join('department','department.dprt_id = appointment.department_id')
			->order_by('appointment.id','desc')
			->get()
			->result();
	} 
 
	public function read_by_id($appointment_id = null)
	{ 
		return $this->db->select("
				appointment.*, 
				appointment.appointment_id, 
				appointment.serial_no, 
				appointment.problem, 
				appointment.date, 
				user.firstname, 
				user.lastname,  
				user.picture,  
				user.degree,  
				department.name as department,
				schedule.available_days,
				schedule.start_time,
				schedule.end_time,
				patient.firstname AS pfirstname,
				patient.lastname AS plastname,
				patient.date_of_birth,
				patient.sex,
				patient.mobile,
				patient.picture,
			")
			->from($this->table)
			->where('appointment.appointment_id',$appointment_id)
			->join('user','user.user_id = appointment.doctor_id','left')
			->join('department','department.dprt_id = appointment.department_id','left')
			->join('patient','patient.patient_id = appointment.patient_id')
			->join('schedule','schedule.schedule_id = appointment.schedule_id','left')
			->order_by('appointment.id','desc')
			->get()
			->row();
	}  
 
	public function delete($appointment_id = null)
	{
		$this->db->where('appointment_id',$appointment_id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
 
	
 }

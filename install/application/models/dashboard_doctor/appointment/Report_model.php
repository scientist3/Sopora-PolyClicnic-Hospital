<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

 
	public function assign_by_all($data = null)
	{ 
		$start_date = date('Y-m-d',strtotime($data['start_date']));
		$end_date   = date('Y-m-d',strtotime($data['end_date']));

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
				department.name,
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
			->from("appointment")
			->join('user','user.user_id = appointment.doctor_id')
			->join('department','department.dprt_id = appointment.department_id')
			->join('patient','patient.patient_id = appointment.patient_id')
			->join('schedule','schedule.schedule_id = appointment.schedule_id')
			->where("appointment.date BETWEEN '$start_date' AND '$end_date'",null,false) 
			->order_by('appointment.id','desc')
			->get()
			->result();
	}  


	public function assign_by_user($data = null)
	{ 
		$start_date = date('Y-m-d',strtotime($data['start_date']));
		$end_date   = date('Y-m-d',strtotime($data['end_date']));
		$user_id    = $data['user_id'];

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
				department.name,
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
			->from("appointment")
			->join('user','user.user_id = appointment.doctor_id')
			->join('department','department.dprt_id = appointment.department_id')
			->join('patient','patient.patient_id = appointment.patient_id')
			->join('schedule','schedule.schedule_id = appointment.schedule_id')
			->where("appointment.date BETWEEN '$start_date' AND '$end_date'",null,false) 
			->where('appointment.created_by',$user_id)
			->order_by('appointment.id','desc')
			->get()
			->result();
	}  
	 

	public function assign_to_user($data = null)
	{ 
		$start_date = date('Y-m-d',strtotime($data['start_date']));
		$end_date   = date('Y-m-d',strtotime($data['end_date']));
		$user_id    = $data['user_id'];

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
				department.name,
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
			->from("appointment")
			->join('user','user.user_id = appointment.doctor_id')
			->join('department','department.dprt_id = appointment.department_id')
			->join('patient','patient.patient_id = appointment.patient_id')
			->join('schedule','schedule.schedule_id = appointment.schedule_id')
			->where("appointment.date BETWEEN '$start_date' AND '$end_date'",null,false) 
			->where('appointment.doctor_id',$user_id)
			->where('user.user_role',2)
			->order_by('appointment.id','desc')
			->get()
			->result();
	}  
	
}

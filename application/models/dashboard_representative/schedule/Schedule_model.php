<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model extends CI_Model {

	private $table = "schedule";

 
	public function read()
	{
		return $this->db->select("schedule.*, user.firstname, user.lastname, department.name")
			->from($this->table)
			->join('user','user.user_id = schedule.doctor_id','left')
			->join('department','department.dprt_id = user.department_id','left')
			->where('schedule.status', 1)
			->order_by('schedule.schedule_id','desc')
			->get()
			->result();
	} 
 


}

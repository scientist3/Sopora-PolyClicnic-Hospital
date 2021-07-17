<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prescription_model extends CI_Model {

	protected $table = 'pr_prescription';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table, $data);
	}
 
	public function read()
	{
		return $this->db->select("pr_prescription.*, CONCAT_WS(' ', user.firstname, user.lastname) AS doctor_name")
			->from('pr_prescription') 
			->join('user', 'user.user_id = pr_prescription.doctor_id', 'left')
			->order_by('id','desc')
			->get()
			->result();
	} 
 
	public function single_view($id = null)
	{		
		return $this->db->select("
				pr_prescription.*, 
				CONCAT_WS(' ', patient.firstname, patient.lastname) AS patient_name,  
				CONCAT_WS(' ', user.firstname, user.lastname) AS doctor_name,  
				user.designation,
				user.address,
				user.specialist,
				department.name as department_name,
				patient.sex,
				patient.date_of_birth,
				pr_insurance.name AS insurance_name
			")
			->from('pr_prescription') 
			->join('patient', 'patient.patient_id = pr_prescription.patient_id', 'left') 
			->join('pr_insurance', 'pr_insurance.id = pr_prescription.insurance_id', 'left') 
			->join('user', 'user.user_id = pr_prescription.doctor_id', 'left') 
			->join('department', 'department.dprt_id = user.department_id', 'left') 
			->where('pr_prescription.id', $id) 
			->get()
			->row();
	} 


	public function website()
	{
		return $this->db->select('title, description, email, phone')
			->from('setting')
			->get()
			->row();
	}
}

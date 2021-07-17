<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {

	private $table = "cm_patient";
 
	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read($uid)
	{ 
		return $this->db->query("
			SELECT 
				cm_patient.*,
				CONCAT_WS(' ', patient.firstname, patient.lastname) as patient_name,
				patient.mobile,
				patient.address,
				CONCAT_WS(' ', user1.firstname, user1.lastname) as ref_doctor_name,
				CONCAT_WS(' ', user2.firstname, user2.lastname) as case_manager
			FROM 
				cm_patient
			LEFT JOIN 
				patient ON patient.patient_id = cm_patient.patient_id
			LEFT JOIN 
				user user1 ON user1.user_id = cm_patient.ref_doctor_id
			LEFT JOIN 
				user user2 ON user2.user_id = cm_patient.case_manager_id
			LEFT JOIN 
				cm_status ON cm_status.cm_patient_id = cm_patient.id
			WHERE 
				patient.id = $uid
			GROUP BY 
				cm_patient.id
			ORDER BY 
				cm_patient.id DESC   
			")->result();
	} 
 
	public function read_by_id($id = null)
	{
		return $this->db->query("
			SELECT
				cm_patient.*,
				CONCAT_WS(' ', patient.firstname, patient.lastname) as patient_name,
				patient.*,
				cm_patient.id as id,
				CONCAT_WS(' ', user1.firstname, user1.lastname) as ref_doctor_name,
				CONCAT_WS(' ', user2.firstname, user2.lastname) as case_manager
			FROM 
				cm_patient
			LEFT JOIN 
				patient ON patient.patient_id = cm_patient.patient_id
			LEFT JOIN 
				user user1 ON user1.user_id = cm_patient.ref_doctor_id
			LEFT JOIN 
				user user2 ON user2.user_id = cm_patient.case_manager_id
			WHERE   
				cm_patient.id = $id
			")->row(); 
	}  
}

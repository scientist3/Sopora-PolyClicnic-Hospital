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
				cm_patient.ref_doctor_id = $uid
			GROUP BY 
				cm_patient.id
			ORDER BY 
				cm_patient.id DESC   
			")->result();
	} 
 
	public function read_by_id($id = null, $uid = null)
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
				cm_patient.ref_doctor_id = $uid AND cm_patient.id = $id
			")->row(); 
	} 
 
	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 

	public function doctor_list()
	{
		$result = $this->db->select("*")
			->from("user")
			->where('user_role',2)
			->where('status',1)
			->get()
			->result();

		$list[''] = display('select_doctor');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->user_id] = $value->firstname.' '.$value->lastname; 
			}
			return $list;
		} else {
			return false;
		}
	}


	public function case_manager_list()
	{
		$result = $this->db->select("*")
			->from("user")
			->where('user_role',9)
			->where('status',1)
			->get()
			->result();

		$list[''] = display('select_doctor');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->user_id] = $value->firstname.' '.$value->lastname; 
			}
			return $list;
		} else {
			return false;
		}
	}


	public function document($id = null)
	{
		return $this->db->query("
			SELECT 
				document.*,
				CONCAT_WS(' ',u1.firstname, u1.lastname) AS doctor_name,
				IF (u2.user_role=10,'Self',CONCAT_WS(' ',u2.firstname, u2.lastname)) AS upload_by
			FROM 
				document
			INNER JOIN 
				cm_patient ON cm_patient.patient_id = document.patient_id
			LEFT JOIN 
				user u1 ON u1.user_id = document.doctor_id
			LEFT JOIN 
				user u2 ON u2.user_id = document.upload_by
			WHERE 
				cm_patient.id = $id
			GROUP BY 
				document.id
			")
			->result(); 
	} 

  
}

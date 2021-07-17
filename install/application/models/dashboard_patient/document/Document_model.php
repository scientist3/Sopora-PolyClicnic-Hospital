<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends CI_Model {

	private $table = "document";
 
	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
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
 

	public function read($id = null)
	{
		return $this->db->query("
			SELECT 
				document.*,
				CONCAT_WS(' ',u1.firstname, u1.lastname) AS doctor_name,
				IF (document.upload_by=0,'Patient',CONCAT_WS(' ',u2.firstname, u2.lastname)) AS upload_by
			FROM 
				document
			INNER JOIN 
				patient ON patient.patient_id = document.patient_id
			INNER JOIN 
				cm_patient ON cm_patient.patient_id = document.patient_id
			LEFT JOIN 
				user u1 ON u1.user_id = document.doctor_id
			LEFT JOIN 
				user u2 ON u2.user_id = document.upload_by
			WHERE 
				patient.id = $id
			GROUP BY 
				document.id
			")
			->result(); 
	} 

	public function delete($id = null)
	{
		return $this->db->where('id', $id)
			->delete($this->table);
	}

}


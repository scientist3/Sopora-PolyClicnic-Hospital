<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends CI_Model {
 
	private $table = "document";

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("
			document.*,
			CONCAT_WS(' ', u1.firstname, u1.lastname) as doctor_name,
			IF (document.upload_by=0 || document.upload_by='', 'Self', CONCAT_WS(' ', u2.firstname, u2.lastname)) as upload_by
			")
			->from("document")
			->join('user u1', 'u1.user_id = document.doctor_id','left')
			->join('user u2', 'u2.user_id = document.upload_by','left')
			->group_by('document.id')
			->get()
			->result();
	} 
 
	public function read_by_patient($id = null)
	{
		return $this->db->select("
			document.*,
			CONCAT_WS(' ', u1.firstname, u1.lastname) as doctor_name,
			IF (document.upload_by=0 || document.upload_by='', 'Self', CONCAT_WS(' ', u2.firstname, u2.lastname)) as upload_by
			")
			->from("document")
			->join('user u1', 'u1.user_id = document.doctor_id','left')
			->join('user u2', 'u2.user_id = document.upload_by','left')
			->join('patient', 'patient.patient_id = document.patient_id','left')
			->where('patient.id', $id)
			->group_by('document.id')
			->get()
			->result();
	} 
	
  	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 

  	public function delete($id = null)
	{
		return $this->db->where('id',$id)
			->delete($this->table); 
	} 
}



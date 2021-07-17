<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bed_assign_model extends CI_Model {

	private $table = 'bm_bed_assign';

	public function read()
	{
		return $this->db->select("
				bm_bed_assign.*,
				COUNT(bm_bed_assign.serial) as days, 
				bm_bed.type as bed_name,
				bm_bed.charge,
				CONCAT_WS(' ', firstname, lastname) as assign_by
			")
			->from('bm_bed_assign')
			->join('user', 'user.user_id = bm_bed_assign.assign_by', 'left')
			->join('bm_bed', 'bm_bed.id = bm_bed_assign.bed_id', 'left')
			->group_by(array('serial','patient_id'))
			->order_by('assign_date','desc')
			->get()
			->result();
	} 

 
 }

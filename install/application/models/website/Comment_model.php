<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model {

	private $table = 'ws_comment';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("ws_comment.*, ws_item.title")
			->from('ws_comment')
			->join('ws_item','ws_item.id = ws_comment.item_id','left') 
			->order_by('ws_comment.id','desc') 
			->order_by('ws_comment.item_id','asc')
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
		$this->db->where('id',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
 

	
 }

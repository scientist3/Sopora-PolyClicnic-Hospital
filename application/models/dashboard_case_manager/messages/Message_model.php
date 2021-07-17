<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {

	private $table = 'message';

	public function create($data = [])
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function inbox($user_id)
	{
		return $this->db->select("message.*, 
				CONCAT_WS(' ', user.firstname, user.lastname) as sender_name")
			->from("message")
			->join('user', 'user.user_id = message.sender_id')
			->where('message.receiver_id', $user_id)
			->where_not_in('message.receiver_status', 2)
			->order_by('message.id','desc')
			->order_by('message.datetime','desc')
			->get()
			->result();
	} 
 
	public function sent($user_id)
	{
		return $this->db->select("message.*, 
				CONCAT_WS(' ', user.firstname, user.lastname) as receiver_name")
			->from("message")
			->join('user', 'user.user_id = message.receiver_id')
			->where('message.sender_id', $user_id)
			->where_not_in('message.sender_status', 2)
			->order_by('message.id','desc')
			->order_by('message.sender_status','asc')
			->get()
			->result();
	} 
 
	public function inbox_information($id = null, $sender_id = null, $receiver_id = null)
	{ 
		return $this->db->select("message.*, 
				CONCAT_WS(' ', user.firstname, user.lastname) as sender_name")
			->from("message")
			->join('user', 'user.user_id = message.sender_id')
			->where('message.receiver_id', $receiver_id)
			->where('message.id', $id)
			->where_not_in('message.receiver_status', 2)
			->order_by('message.id','desc')
			->order_by('message.receiver_status','asc')
			->get()
			->row();
	} 
 
	public function sent_information($id = null, $user_id = null)
	{
		return $this->db->select("message.*, 
				CONCAT_WS(' ', user.firstname, user.lastname) as receiver_name")
			->from("message")
			->join('user', 'user.user_id = message.receiver_id')
			->where('message.sender_id', $user_id)
			->where('message.id', $id)
			->where_not_in('message.sender_status', 2)
			->order_by('message.id','desc')
			->order_by('message.sender_status','asc')
			->get()
			->row();
	} 
 
	public function update($data = [])
	{
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 
 
	public function delete($id = null, $condition = null)
	{
		$this->db->where('id',$id)
			->set($condition, 2)
			->update($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 


	public function user_list($user_id = null)
	{
		$result = $this->db->select("user_id, CONCAT_WS(' ',firstname, lastname) AS fullname ")
			->from("user")
			->where_not_in('user_id', $user_id)
			->where('status',1)
			->order_by('fullname', 'asc')
			->get()
			->result();

		$list[''] = display('select_user');
		if (!empty($result)) {
			foreach ($result as $value) {
				$list[$value->user_id] = $value->fullname; 
			}
			return $list;
		} else {
			return false;
		}
	}


	
}



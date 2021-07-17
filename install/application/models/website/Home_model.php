<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model 
{
	public function sections()
	{
		return $this->db->get('ws_section')->result();
	} 

	public function sliders($id = null)
	{
		return $this->db->where('status',1)
            ->order_by('position','asc') 
            ->order_by('id','asc')
            ->get('ws_slider')
            ->result();
	} 
 
	public function slider_details($id = null)
	{
		return $this->db->select("*") 
			->where('id',$id)
            ->get('ws_slider')
			->row();
	} 

	public function setting()
	{
		return $this->db->select("*")
			->from('ws_setting')
			->limit(1)
			->get()
			->row();
	} 

	public function doctors()
	{
		return $this->db->select('user.firstname, user.lastname, user.picture , department.name as department')
            ->from('user')
            ->join('department','department.dprt_id = user.department_id')
            ->where('user.status',1)
            ->where('user.user_role',2)
            ->get()
            ->result();
	}

	public function departments()
	{
		return $this->db->select('*')
            ->from('department')
            ->where('status',1)
            ->order_by('name','asc')
            ->get()
            ->result();
	}

	public function items()
	{
		return $this->db->select("*")
            ->from('ws_item')
            ->where('status',1)
            ->order_by('position','asc')
            ->order_by('id','desc')
            ->get()
            ->result();
	}

	public function latest_news($limit = null)
	{
		return $this->db->select('id, icon_image, title, description, counter, date')
            ->from('ws_item')
            ->where('name','blog')
            ->where('status',1)
            ->order_by('position','asc')
            ->order_by('id','desc')
            ->order_by('date','desc')
            ->limit((!empty($limit)?$limit:3))
            ->get()
            ->result();
	}  

	public function recent_news($limit = null)
	{
		return $this->db->select('id, icon_image, title, description, counter, date')
            ->from('ws_item')
            ->where('name','blog')
            ->where('status',1)
            ->order_by('id','desc')
            ->order_by('date','desc')
            ->limit((!empty($limit)?$limit:10))
            ->get()
            ->result();
	}  
 
	public function blog_details($id)
	{
		return $this->db->select("*")
            ->from('ws_item') 
			->where('status',1)  
            ->where('id',$id)
            ->order_by('id','desc')
			->get()
			->row();
	}  
 
	public function update_counter($id = null)
	{
		return $this->db->set('counter','counter + 1',false)
                ->where('id',$id)
                ->update('ws_item');
	} 

	public function comments_details($id = null)
	{
		return $this->db->where('item_id',$id)
                ->order_by('date','desc')
                ->get('ws_comment')
                ->result();
	} 

	public function comments()
	{
		return $this->db->select("ws_comment.*, ws_item.title")
			->from('ws_comment')
			->join('ws_item','ws_item.id = ws_comment.item_id','left') 
			->where('ws_comment.add_to_website',1) 
			->order_by('ws_comment.date','desc')
			->get()
			->result();
	} 

 

 
}


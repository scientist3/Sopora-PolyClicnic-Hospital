<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_representative/schedule/schedule_model'
		));
		 
 
		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 8) 
			redirect('login'); 

	}
 
	public function index()
	{
		$data['title'] = display('schedule');
		$data['schedules'] = $this->schedule_model->read();
		$data['content'] = $this->load->view('dashboard_representative/schedule//view',$data,true);
		$this->load->view('dashboard_representative/main_wrapper',$data);
	} 

}
